// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function () {
    // get the global variables needed
    const menuContainer = document.getElementById("menuContainer");
    const papapapoppop = document.getElementById("papapapoppop");
    var menuArray = [];

    getMenu = () => {
        // get the menu for the popular
        fetch('../contexts/GetFoodMenu.php')
            // get response as json
            .then(response => response.json())

            // get objects from fetch
            .then(data => {
                // clear the popularmenu container
                menuContainer.innerHTML = "";

                // go to function to create menu cards
                createMenuCards(data.menu);
            })

            // error checker
            .catch(error => {
                // output the error in console
                console.error(error);

                // output the errors from html
                menuContainer.innerHTML = error;
            });
    }

    // get the menu
    getMenu();

    createMenuCards = (menus) => {
        // loop to create the template
        menuArray = menus.map(menu => {
            // get the element template from managemenuedit-ad.php
            const menuTemplate = document.querySelector("[data-menu-template]");
            const card = menuTemplate.content.cloneNode(true).children[0];

            // get the template child that needs value to be displayed
            const foodImage = card.querySelector("[data-food-image]");
            const foodName = card.querySelector("[data-food-name]");
            const foodDescription = card.querySelector("[data-food-description]");
            const foodPrice = card.querySelector("[data-food-price]");

            // place the variables got from fetch to the card
            foodImage.src = `../images/foodCategories/${menu.categoryName}/${menu.image}`;
            foodName.textContent = menu.foodName;
            foodDescription.textContent = menu.description;
            foodPrice.textContent = `₱ ${Number(menu.price).toLocaleString()}`; // add comma to the menu.price

            // create on click listener for each card
            card.addEventListener('click', () => {
                // popup the cart for ordering
                popupCart();

                // create ordering form in popup
                editMenuForm(menu);
            });

            // put each card inside the menu container
            menuContainer.appendChild(card);

            // return each card for category filtering
            return {
                foodCategory: menu.categoryName,
                element: card
            }
        });
    }

    // process for output the editing form
    editMenuForm = (menu) => {
        // get the element template from managemenuedit-ad.php
        const menuPopoutTemplate = document.querySelector("[data-menu-popout]");
        const popoutCard = menuPopoutTemplate.content.cloneNode(true);

        // get the template child that needs value to be displayed
        const foodImage = popoutCard.querySelector("[data-food-image]");
        const foodName = popoutCard.querySelector("[data-food-name]");
        const foodDescription = popoutCard.querySelector("[data-food-description]");
        const foodPrice = popoutCard.querySelector("[data-food-price]");
        const foodDiscount = popoutCard.querySelector("[data-food-discount]");

        // place the variables got from fetch to the card
        foodImage.src = `../images/foodCategories/${menu.categoryName}/${menu.image}`;
        foodName.value = menu.foodName;
        foodDescription.value = menu.description;
        foodPrice.value = (menu.price).toLocaleString(); // add comma to the menu.price
        foodDiscount.value = menu.discount;

        // get the clickable button and form
        const xbtn = popoutCard.querySelector("[data-edit-close-form]");
        const menuForm = popoutCard.querySelector("[data-edit-menu-form]");

        // if x button is clicked
        xbtn.addEventListener('click', () => {
            // close popup
            popupCart();
        });

        // if there is submit in form
        menuForm.addEventListener('submit', (ev) => {
            // prevent the website from loading
            ev.preventDefault();

            // get all the values from the form to variable payload
            const menuFormData = new FormData(menuForm);

            // append the id into menuFormData
            menuFormData.append("foodID", menu.id);

            // create object for each data in menuFormData
            const payload = Object.fromEntries(menuFormData);

            // go to editing menu with the payload
            editMenu(payload);
        });

        // put each made card inside regularMenuContainer
        papapapoppop.appendChild(popoutCard);
    }

    // editing menu process
    editMenu = (payload) => {
        // make a fetch to request for an update of menu
        fetch('../contexts/UpdateMenuProcess.php', {
            method: "POST",
            headers: {
                // state as a json type
                'Content-Type': 'application/json; charset=utf-8'
            },
            // convert js object to json
            body: JSON.stringify(payload)
        })
            // get response as json
            .then(response => response.json())

            // get objects from fetch
            .then(data => {
                // if updating menu is success
                if (data.status == "success") {
                    // close popup
                    popupCart();

                    // get the fresh menu
                    getMenu();
                }
                // if data is not success
                else {
                    // output the error in console
                    console.error(data);
                }
            })

            // error checker
            .catch(error => console.error(error));
    }

    // pop out when ordering
    popupCart = () => {
        // clear the papapapoppop innerHTML
        papapapoppop.innerHTML = "";

        // toggle hidden
        if (papapapoppop.style.opacity == '1') {
            papapapoppop.style.opacity = '0';
            papapapoppop.style.visibility = 'hidden';
            return;
        }

        // toggle visible
        papapapoppop.style.opacity = '1';
        papapapoppop.style.visibility = 'visible';
    }
});