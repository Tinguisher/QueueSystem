// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function () {

    // get all id, class for global variable
    const sessionbutton = document.getElementById("sessionbutton");
    const sessiontext = document.getElementById("sessiontext");
    const dropdownBtnText = document.getElementById("drop-text");
    const popularmenu = document.getElementById("popularmenu");
    const slides = document.getElementById("slides");

    // if dropdown is clicked
    dropdownBtnText.onclick = function () {
        const list = document.getElementById("list");
        list.classList.toggle("show");
    };

    // if the user is logged in
    if (loggedin) {
        // change the text to logout
        sessiontext.textContent = "Logout";

        // if there is click on logoutbutton
        sessionbutton.addEventListener('click', (ev) => {
            // prevent loading of website
            ev.preventDefault();

            // go to logout
            fetch('../contexts/logout.php')
                .then(response => response.json())
                // get objects from fetch
                .then(data => {
                    // if the status is success
                    if (data.status == "success") {
                        // reload the website
                        window.location.reload();
                    }
                })
                // error checker
                .catch(error => console.error(error));
        });
    }

    // if there is no logged in
    else {
        // change the text to sign in
        sessiontext.textContent = "Sign in";

        // if there is click on logoutbutton
        sessionbutton.addEventListener('click', () => {
            // change the location to login
            window.location = '../pages/login.php';
        });
    }

    // get the menu for the popular
    fetch('../contexts/GetPopularMenu.php')
        // get response as json
        .then(response => response.json())
        // get objects from fetch
        .then(data => {
            // clear the loadings
            popularmenu.innerHTML = "";

            // loop for each menu from server, menu is data.menu and index for current element
            data.menu.forEach((menu, index) => {
                // go to function to create image sliders
                createSliders(menu, index);

                // go to function to create popular menu cards
                createPopularMenuCards(menu);
            });
        })
        // error checker
        .catch(error => {
            // output the error in console
            console.error(error)
            // output the errors from html
            slides.innerHTML = error;
            popularmenu.innerHTML = error;
        });

    // create sliders function getting called from fetch
    createSliders = (menu, index) => {

        // go back to forEach if looped more than 4 times
        if (index > 3) {
            return;
        }

        // get the element template from home.php
        const slideTemplate = document.querySelector("[data-slide-template]");
        const slide = slideTemplate.content.cloneNode(true);

        // get the template children
        const slideDiv = slide.querySelector("[data-slide-div]");
        const slideImg = slide.querySelector("[data-slide-img");

        // place the values and edit div class
        slideDiv.classList.toggle("first", index == 0);
        slideImg.src = `../images/foodCategories/${menu.categoryName}/${menu.image}`;

        // put the slide inside slides
        slides.appendChild(slide);

        // if there is click in the slide image
        slideImg.addEventListener('click', () => {
            // go to popular menus and menu itself
            window.location = `../pages/menu.php?popular=true&menuID=${menu.id}`
        });
    }

    // create Popular Menu Cards called after getting from fetch
    createPopularMenuCards = (menu) => {
        // get the element template from home.php
        const popularMenuTemplate = document.querySelector("[data-popular-menu-template]");
        const card = popularMenuTemplate.content.cloneNode(true).children[0];

        // get the template child that needs value to be displayed
        const foodImage = card.querySelector("[data-food-image]");
        const foodName = card.querySelector("[data-food-name]");
        const foodDescription = card.querySelector("[data-food-description]");
        const foodPrice = card.querySelector("[data-food-price]");

        // place the variables got from fetch to the card
        foodImage.src = `../images/foodCategories/${menu.categoryName}/${menu.image}`;
        foodName.value = menu.foodName;
        foodDescription.textContent = menu.description;
        foodPrice.value = `Php ${Number(menu.price).toLocaleString()}`; // add comma to the menu.price

        // put the card inside popularmenu
        popularmenu.appendChild(card);

        // if there is click in individual card
        card.addEventListener('click', () => {
            // go to popular menus and menu itself
            window.location = `../pages/menu.php?popular=true&menuID=${menu.id}`
        });
    }

    var counter = 1;

    setInterval(function () {
        document.getElementById('radio' + counter).checked = true;
        counter++;
        if (counter > 4) {
            counter = 1;
        }

    }, 5000);
});