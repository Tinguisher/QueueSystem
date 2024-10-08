// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function () {
    // get all id, class for global variable
    const searchInput = document.getElementById("searchInput");
    const searchSubmit = document.getElementById("searchSubmit");
    const profileButton = document.getElementById("profileButton");
    const sessionbutton = document.getElementById("sessionbutton");
    const sessiontext = document.getElementById("sessiontext");
    const dropdownBtnText = document.getElementById("drop-text");
    const promoContainer = document.getElementById("promoContainer");
    const popularmenu = document.getElementById("popularmenu");
    const slides = document.getElementById("slides");
    const orderHistory = document.getElementById("orderHistory");
    var menuArray = [];
    var menuSearch = [];

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
        sessionbutton.addEventListener('click', () => {
            // logout the user
            logout();
        });

        // if there is click in profile button
        profileButton.addEventListener('click', () => {
            // change the location to profile.php
            window.location = '../pages/profile.php';
        });

        // if there is click in orderhistory
        orderHistory.addEventListener('click', () => {
            // change the location to orderhistory
            window.location = '../pages/orderhistory.php';
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

        // if there is click in profile button
        profileButton.addEventListener('click', () => {
            // change the location to profile.php
            window.location = '../pages/login.php?previousURL=profile.php';
        });

        // if there is click in orderhistory
        orderHistory.addEventListener('click', () => {
            // change the location to login
            window.location = '../pages/login.php?previousURL=orderhistory.php';
        });
    }

    // logout process
    logout = () => {
        // go to logout.php
        fetch('../contexts/logout.php')
            // get response as json
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
    }

    // get the menu for the popular
    fetch('../contexts/GetMenuProcess.php')
        // get response as json
        .then(response => response.json())
        // get objects from fetch
        .then(data => {
            // clear the containers
            popularmenu.innerHTML = "";
            promoContainer.innerHTML = "";

            // get the data.menu as global variable for search
            menuArray = data.menu;

            // loop the menuArray to show at search
            menuSearch = menuArray.map(menu => {
                // get the dropdownsearch container
                const dropdownSearch = document.getElementById("dropdownSearch");
                
                // create a p element with menu name contexts
                const option = document.createElement('p');
                option.textContent = menu.foodName;
                option.style.display = "none";
                option.className = "searchleft";
                dropdownSearch.style = "display:none";
                
                // if there is click in option
                option.addEventListener('click', () => {
                    window.location = `./menu.php?menuID=${menu.id}`
                });
                
                // put the option from search to the div
                dropdownSearch.appendChild(option);

                // return the food element and name for filtering
                return {
                    foodName: menu.foodName,
                    element: option
                }
            });

            // get the array as sorted for searching and for popular
            menuArray.sort((a, b) => b.popularity - a.popularity);

            // loop to creating picture sliders, promos, and popularity
            menuArray.forEach((menu, index) => {
                // go to function to create image sliders
                createSliders(menu, index);

                // go to function to create promos of the day
                createPromoCards(menu);

                // go to function to create popular menu cards
                createPopularMenuCards(menu, index);
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

    // if there is an input of the search bar
    searchInput.addEventListener('input', () => {
        // loop the menu that will be used to search
        menuSearch.forEach (menu => {
            // check if foodName option should be visible or not
            const optionVisibility = searchInput.value ? menu.foodName.toLowerCase().includes(searchInput.value.toLowerCase()) : false;

            // if it is visible, block. If not then none
            menu.element.style.display = optionVisibility ? "block" : "none";
            searchInput.value ? dropdownSearch.style.display = "block": dropdownSearch.style.display = "none";
        });
    });

    // if the user proceed to submit
    searchSubmit.addEventListener('submit', (ev) => {
        // stop the website from reloading
        ev.preventDefault();

        // pass as url to the menu for searching
        window.location = `./menu.php?searchInputURL=${searchInput.value}`
    })
    
    // create sliders function getting called from fetch
    createSliders = (menu, index) => {
        // go back to forEach if looped more than 4 times
        if (index > 3) return;

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

    var promoNumber = 0;
    createPromoCards = (menu) => {
        // if there are 4 or more promo made, return
        if (promoNumber >= 4) return;

        // if there is no discount, return
        if (menu.discount <= 0) return;

        // get the element template from home.php
        const foodPromoTemplate = document.querySelector("[data-food-promo-template]");
        const card = foodPromoTemplate.content.cloneNode(true).children[0];

        // get the template children
        const foodImage = card.querySelector("[data-food-image]");
        const foodDetails = card.querySelector("[data-food-details]");

        // place the values inside the template
        const categoryName = document.createTextNode(menu.categoryName);
        const discountPercent = document.createTextNode(`${menu.discount}% OFF`);
        foodImage.src = `../images/foodCategories/${menu.categoryName}/${menu.image}`;
        foodDetails.prepend(menu.foodName);
        foodDetails.insertBefore(categoryName, foodDetails.children[1]);
        foodDetails.insertBefore(discountPercent, foodDetails.children[2]);

        // put the card inside the promo container
        promoContainer.appendChild(card);

        // if there is click in promo card
        card.addEventListener('click', () => {
            // go to menu itself
            window.location = `../pages/menu.php?menuID=${menu.id}`
        });

        // increment the promo number for create limit to only 4
        promoNumber++;
    }

    // create Popular Menu Cards called after getting from fetch
    createPopularMenuCards = (menu, index) => {
        // go back to forEach if looped more than 8 times
        if (index > 7) return;
        
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
        foodPrice.value = `Php ${Number(menu.discountedPrice).toLocaleString()}`; // add comma to the menu.discountedPrice

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