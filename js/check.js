// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function () {
    // get all id, class for global variable
    const dropdownBtnText = document.getElementById("drop-text");
    const profileButton = document.getElementById("profileButton");
    const orderHistory = document.getElementById("orderHistory");
    const sessionbutton = document.getElementById("sessionbutton");
    const sessiontext = document.getElementById("sessiontext");
    const userOrderContainer = document.querySelector("[data-user-order-container]");
    const checkout = document.getElementById("checkout");

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
        // change the location to home
        window.location = '../pages/home.php';
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

    // fetch for the cart
    fetch('../contexts/GetCartProcess.php')
        // get response as json
        .then(response => response.json())

        // get objects from fetch
        .then(data => {
            // if getting the data is success
            if (data.status == "success") {
                // create a row for each user carts
                createUserOrderTable(data.carts);
            }

            // if there is error in fetching
            else {
                userOrderContainer.innerHTML = data.message;
            }
        })
        // error checker
        .catch(error => {
            console.error(error);
            userOrderContainer.innerHTML = error;
        });

    // if there is click in order and proceed to checkout
    checkout.addEventListener('submit', (ev) => {
        // prevent the website from loading
        ev.preventDefault();

        // go to creating receipt
        createReceipt();

        // go to see the user's cart
        window.location = '../pages/mycart.html';
    });

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

    // process of creating the user order table
    createUserOrderTable = (carts) => {
        // clear the container
        userOrderContainer.innerHTML = "";

        // create a subTotal variable
        let addedSubTotal = 0;
        let calculatedDeliveryFee = 20;

        // loop for each data got in the fetch
        carts.forEach(cart => {
            // get the element template from check.php
            const userOrderTemplate = document.querySelector("[data-user-order-template]");
            const row = userOrderTemplate.content.cloneNode(true).children[0];

            // get the template child that needs value to be displayed
            const foodName = row.querySelector("[data-food-name]");
            const foodQuantity = row.querySelector("[data-food-quantity]");
            const foodPrice = row.querySelector("[data-food-price]");

            // place the variables got from fetch to the row
            foodName.textContent = cart.foodName;
            foodQuantity.textContent = cart.quantity;
            foodPrice.textContent = Number(cart.discountedPrice).toLocaleString();   // add comma to the cart.discountedPrice

            // put each row in the container
            userOrderContainer.appendChild(row);

            // get the row price for subtotal
            addedSubTotal = addedSubTotal + cart.discountedPrice;
        })

        // get html element to display totals
        const subTotal = document.getElementById("subTotal");
        const deliveryFee = document.getElementById("deliveryFee");
        const totalPrice = document.getElementById("totalPrice");

        // display the calculated values with commas
        subTotal.textContent = `₱ ${Number(addedSubTotal).toLocaleString()}`;
        deliveryFee.textContent = `₱ ${Number(calculatedDeliveryFee).toLocaleString()}`;
        totalPrice.textContent = `Php ${Number(addedSubTotal + calculatedDeliveryFee).toLocaleString()}`;
    }
});