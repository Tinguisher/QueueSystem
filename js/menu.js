// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function () {

    // get all id, class for global variable
    const dropdownBtnText = document.getElementById("drop-text");
    const sessionbutton = document.getElementById("sessionbutton");
    const sessiontext = document.getElementById("sessiontext");
    const regularMenuContainer = document.querySelector("[data-regular-menu-container]");
    const papapapoppop = document.getElementById('papapapoppop');
    const filterInput = document.getElementById("filterInput");
    const filterButtons = document.querySelectorAll('.all1');
    const foodCartContainer = document.querySelector("[data-user-cart-container]");
    const payment = document.getElementById("payment");
    var menuArray = [];
    var filterButtonValue = "";

    // if dropdown is clicked
    dropdownBtnText.onclick = function () {
        const list = document.getElementById("list");
        list.classList.toggle("show");
    };

    // if the user is logged in
    if (loggedin) {
        // change the text to logout
        sessiontext.textContent = "Logout";

        // change the payment text as Review Payment and Address
        payment.textContent = "Review Payment and Address";

        // if there is click on logoutbutton
        sessionbutton.addEventListener('click', () => {
            // logout the user
            logout();
        });

        // if there is click on payment
        payment.addEventListener('click', () => {
            // proceed to creating receipts
            createReceipt();

            // ===========================================================
            // window.location.href = './check.html';
            // ===========================================================
        });
    }

    // if there is no logged in
    else {
        // change the text to sign in
        sessiontext.textContent = "Sign in";

        // change the payment text as Sign in to Review Payment
        payment.textContent = "Sign in to Review Payment";

        // if there is click on Sign in button
        sessionbutton.addEventListener('click', (ev) => {
            // change the location to login
            window.location = '../pages/login.php';
        });

        // if there is click on payment
        payment.addEventListener('click', (ev) => {
            // change the location to login
            window.location = '../pages/login.php';
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

    // process of creating Receipt after clicking payment
    createReceipt = () => {
        // go to CreateUserReceipt.php
        fetch('../contexts/CreateUserReceipt.php')
            // get response as json
            .then(response => response.json())

            // get objects from fetch
            .then(data => {
                // get the fresh user's cart
                getUserCart();

                // if update quantity is not success
                if (data.status == "error") {
                    console.error(data.message);
                }

            })
            // error checker
            .catch(error => console.error(error));
    }

    // ==================================================== //
    //          CREATE A WEBSOCKET FOR THIS???              //
    // ==================================================== //
    // get all the menu
    fetch('../contexts/GetMenuProcess.php')
        // get response as json
        .then(response => response.json())

        // get objects from fetch
        .then(data => {
            // create a card for each menus fetched from database
            createMenuCards(data.menu);

            // go to filtering
            filtering();
        })

        // error checker
        .catch(error => {
            // output the error in console
            console.error(error);
            // output the errors to html
            regularMenuContainer.innerHTML = error;
        });

    // if there is input or change in filter
    filterInput.addEventListener('input', () => {
        // go to filtering
        filtering();
    });

    // loop for every class that has all1
    filterButtons.forEach(filterButton => {
        // if there is click on filterButtons
        filterButton.addEventListener('click', () => {
            // make the filter universal for filtering
            filterButtonValue = filterButton.value;

            // go to filtering
            filtering();
        });
    });

    filtering = () => {
        // convert the filter to lowercase
        const filterInputValue = filterInput.value.toLowerCase();

        // make the card visible or not
        menuArray.forEach(menu => {
            // check if card should be visible or not from the filter
            const cardVisibility = (
                menu.foodName.toLowerCase().includes(filterInputValue) ||
                menu.foodDescription.toLowerCase().includes(filterInputValue)
            ) && menu.foodCategory.includes(filterButtonValue);
            // display: inline-block if visible and display: none if not visible
            menu.element.style.display = cardVisibility ? "inline-block" : "none";
        });
    }

    // create cards for div regularMenuContainer 
    createMenuCards = (menus) => {
        // clear the values from regularMenuContainer
        regularMenuContainer.innerHTML = "";

        // get the menus for filtering
        menuArray = menus.map(menu => {
            // get the element template from menu.php
            const regularMenuTemplate = document.querySelector("[data-regular-menu-template]");
            const card = regularMenuTemplate.content.cloneNode(true).children[0];

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

            // put each made card inside regularMenuContainer
            regularMenuContainer.appendChild(card);

            // create on click listener for each card
            card.addEventListener('click', () => {
                // popup the cart for ordering
                popupCart();

                // create ordering form in popup
                createCartForm(menu);
            });

            // get the name, description, category and card itself for filtering
            return {
                foodName: menu.foodName,
                foodDescription: menu.description,
                foodCategory: menu.categoryName,
                element: card
            };
        });
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

    // create popup Cart form
    createCartForm = (menu) => {
        // get the element template from menu.php
        const menuPopoutTemplate = document.querySelector("[data-menu-popout]");
        const menuForm = menuPopoutTemplate.content.cloneNode(true).children[0];

        // get the template child that needs value to be displayed
        const foodImage = menuForm.querySelector("[data-food-image]");
        const foodName = menuForm.querySelector("[data-food-name]");
        const foodDescription = menuForm.querySelector("[data-food-description]");
        const foodPrice = menuForm.querySelector("[data-food-price]");

        // place the variables got from fetch to the card
        foodImage.src = `../images/foodCategories/${menu.categoryName}/${menu.image}`;
        foodName.textContent = menu.foodName;
        foodDescription.textContent = menu.description;
        foodPrice.textContent = `Php ${Number(menu.price).toLocaleString()}`; // add comma to the cart.price

        // put each made card inside regularMenuContainer
        papapapoppop.appendChild(menuForm);

        // get the clickable buttons, form and changeable order quantity
        const xbtn = menuForm.querySelector("[data-cart-close-form]");
        const decrement = menuForm.querySelector("[data-food-cart-decrement]");
        const increment = menuForm.querySelector("[data-food-cart-increment]");
        const quantity = menuForm.querySelector("[data-food-cart-quantity]");
        const cartForm = menuForm.querySelector("[data-cart-form");

        // if x button is clicked
        xbtn.addEventListener('click', () => {
            // close popup
            popupCart();
        });

        // if "-" button is clicked, decrement, but not if it is 0
        decrement.addEventListener('click', () => {
            if (quantity.textContent < 2) return;
            quantity.textContent--;
            foodPrice.textContent = `Php ${Number(menu.price * quantity.textContent).toLocaleString()}`; // add comma to the menu.price
        });

        // if "+" button is clicked, increment, but not if it is 99
        increment.addEventListener('click', () => {
            if (quantity.textContent > 98) return;
            quantity.textContent++;
            foodPrice.textContent = `Php ${Number(menu.price * quantity.textContent).toLocaleString()}`; // add comma to the menu.price
        });

        // if there is submit in form
        cartForm.addEventListener('submit', (ev) => {
            // prevent the website from loading
            ev.preventDefault();

            // get all the values from the form to variable payload
            const payload = {
                input_food_id: menu.id,
                input_quantity: Number(quantity.textContent),
                // console.log(document.querySelector('input[name="radio"]:checked').value);
            };

            // add the payload to the user's cart
            addToCart(payload);

        });

    }

    // add to the cart process
    addToCart = (payload) => {
        // make a fetch to process when adding a cart
        fetch('../contexts/AddCartProcess.php', {
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
                // if adding cart is success
                if (data.status == "success") {
                    // close popup
                    popupCart();

                    // get the fresh user's cart
                    getUserCart();
                }
            })

            // error checker
            .catch(error => console.error(error));
    }

    // ==================================================== //
    //          CREATE A WEBSOCKET FOR THIS???              //
    // ==================================================== //
    // get the user cart process
    getUserCart = () => {
        fetch('../contexts/GetCartProcess.php')
            // get response as json
            .then(response => response.json())

            // get objects from fetch
            .then(data => {
                // if getting the data is success
                if (data.status == "success") {
                    // clear the cart container
                    foodCartContainer.innerHTML = "";

                    // create a card for each user carts
                    createFoodCartCards(data.carts);
                }
            })
            // error checker
            .catch(error => {
                console.error(error);
                foodCartContainer.innerHTML = error;
            });
    }

    // get the user's cart
    getUserCart();

    // create user's cart
    createFoodCartCards = (carts) => {
        // create a subTotal variable
        let addedSubTotal = 0;
        let calculatedDeliveryFee = 50;

        // loop for every cart by the user
        carts.forEach(cart => {
            // get the element template from menu.php
            const foodCartTemplate = document.querySelector("[data-user-cart-template]");
            const card = foodCartTemplate.content.cloneNode(true).children[0];

            // get the template child that needs value to be displayed
            const foodImage = card.querySelector("[data-food-image]");
            const foodName = card.querySelector("[data-food-name]");
            const foodDescription = card.querySelector("[data-food-description]");
            const foodPrice = card.querySelector("[data-food-price]");
            const decrement = card.querySelector("[data-food-cart-decrement]");
            const increment = card.querySelector("[data-food-cart-increment]");
            const quantity = card.querySelector("[data-food-cart-quantity]");

            // place the variables got from fetch to the card
            foodImage.src = `../images/foodCategories/${cart.categoryName}/${cart.image}`;
            foodName.textContent = cart.foodName;
            foodDescription.textContent = cart.description;
            foodPrice.textContent = `Php ${Number(cart.price).toLocaleString()}`;   // add comma to the cart.price
            quantity.textContent = cart.quantity;

            // if "-" button is clicked, decrement
            decrement.addEventListener('click', () => {
                // remove the element card if current value is 1 and to be decremented
                if (cart.quantity <= 1) card.remove();

                // decrement the textContent
                quantity.textContent--;

                // get the requested decrement quantity
                let requestQuantity = cart.quantity - 1;

                // go to update the user's database cart quantity
                updateFoodQuantity(cart.id, requestQuantity);
            });

            // if "+" button is clicked, increment, but not if it is 99
            increment.addEventListener('click', () => {
                if (cart.quantity > 98) return;
                quantity.textContent++;

                // get the requested increment quantity
                let requestQuantity = cart.quantity + 1;

                // go to update the user's database cart quantity
                updateFoodQuantity(cart.id, requestQuantity);
            });

            // put each made card inside foodCartContainer
            foodCartContainer.appendChild(card);

            // get the cart price for subtotal
            addedSubTotal = addedSubTotal + cart.price;
        });

        // get html element to display totals
        const subTotal = document.getElementById("subTotal");
        const deliveryFee = document.getElementById("deliveryFee");
        const totalPrice = document.getElementById("totalPrice");

        // display the calculated values with commas
        subTotal.textContent = `Php ${Number(addedSubTotal).toLocaleString()}`;
        deliveryFee.textContent = `Php ${Number(calculatedDeliveryFee).toLocaleString()}`;
        totalPrice.textContent = `Php ${Number(addedSubTotal + calculatedDeliveryFee).toLocaleString()}`;
    }

    // update the food quantity in database
    updateFoodQuantity = (cart_id, request_quantity) => {
        // create a payload to be passed in database
        const payload = {
            input_cart_id: Number(cart_id),
            input_quantity: Number(request_quantity)
        };

        // update the quantity in the database
        fetch('../contexts/UpdateCartQuantityProcess.php', {
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
                // get the fresh user's cart
                getUserCart();

                // if update quantity is not success
                if (data.status != "success") {
                    console.error(data.message);
                }
            })

            // error checker
            .catch(error => {
                console.error(error);
                foodCartContainer.innerHTML = error
            });
    }

});


















const wrapper = document.querySelector(".wrapper");
const carousel = document.querySelector(".carousel");
const firstCardWidth = carousel.querySelector(".card").offsetWidth;
const arrowBtns = document.querySelectorAll(".wrapper i");
const carouselChildrens = [...carousel.children];

let isDragging = false,
    isAutoPlay = true,
    startX, startScrollLeft, timeoutId;

// Get the number of cards that can fit in the carousel at once
let cardPerView = Math.round(carousel.offsetWidth / firstCardWidth);

// Insert copies of the last few cards to beginning of carousel for infinite scrolling
carouselChildrens.slice(-cardPerView).reverse().forEach(card => {
    carousel.insertAdjacentHTML("afterbegin", card.outerHTML);
});

// Insert copies of the first few cards to end of carousel for infinite scrolling
carouselChildrens.slice(0, cardPerView).forEach(card => {
    carousel.insertAdjacentHTML("beforeend", card.outerHTML);
});

// Scroll the carousel at appropriate postition to hide first few duplicate cards on Firefox
carousel.classList.add("no-transition");
carousel.scrollLeft = carousel.offsetWidth;
carousel.classList.remove("no-transition");

// Add event listeners for the arrow buttons to scroll the carousel left and right
arrowBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        carousel.scrollLeft += btn.id == "left" ? -firstCardWidth : firstCardWidth;
    });
});

const dragStart = (e) => {
    isDragging = true;
    carousel.classList.add("dragging");
    // Records the initial cursor and scroll position of the carousel
    startX = e.pageX;
    startScrollLeft = carousel.scrollLeft;
}

const dragging = (e) => {
    if (!isDragging) return; // if isDragging is false return from here
    // Updates the scroll position of the carousel based on the cursor movement
    carousel.scrollLeft = startScrollLeft - (e.pageX - startX);
}

const dragStop = () => {
    isDragging = false;
    carousel.classList.remove("dragging");
}

const infiniteScroll = () => {
    // If the carousel is at the beginning, scroll to the end
    if (carousel.scrollLeft === 0) {
        carousel.classList.add("no-transition");
        carousel.scrollLeft = carousel.scrollWidth - (2 * carousel.offsetWidth);
        carousel.classList.remove("no-transition");
    }
    // If the carousel is at the end, scroll to the beginning
    else if (Math.ceil(carousel.scrollLeft) === carousel.scrollWidth - carousel.offsetWidth) {
        carousel.classList.add("no-transition");
        carousel.scrollLeft = carousel.offsetWidth;
        carousel.classList.remove("no-transition");
    }

    // Clear existing timeout & start autoplay if mouse is not hovering over carousel
    clearTimeout(timeoutId);
    if (!wrapper.matches(":hover")) autoPlay();
}

const autoPlay = () => {
    if (window.innerWidth < 800 || !isAutoPlay) return; // Return if window is smaller than 800 or isAutoPlay is false
    // Autoplay the carousel after every 2500 ms
    timeoutId = setTimeout(() => carousel.scrollLeft += firstCardWidth, 2500);
}
autoPlay();

carousel.addEventListener("mousedown", dragStart);
carousel.addEventListener("mousemove", dragging);
document.addEventListener("mouseup", dragStop);
carousel.addEventListener("scroll", infiniteScroll);
wrapper.addEventListener("mouseenter", () => clearTimeout(timeoutId));
wrapper.addEventListener("mouseleave", autoPlay);



const plus = document.querySelector(".plus"),
    minus = document.querySelector(".minus"),
    num = document.querySelector(".num");
let a = 1;
plus.addEventListener("click", () => {
    a++;
    a = (a < 10) ? "0" + a : a;
    num.innerText = a;
});
minus.addEventListener("click", () => {
    if (a > 1) {
        a--;
        a = (a < 10) ? "0" + a : a;
        num.innerText = a;
    }
});