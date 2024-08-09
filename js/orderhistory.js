// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function () {
    // global variable for usage
    const dropdownBtnText = document.getElementById("drop-text");
    const summaryContainer = document.getElementById("summaryContainer");
    const orderHistory = document.getElementById("orderHistory");

    // if dropdown is clicked
    dropdownBtnText.onclick = function () {
        const list = document.getElementById("list");
        list.classList.toggle("show");
    };

    // if there is click in orderhistory
    orderHistory.addEventListener('click', () => {
        // change the location to orderhistory
        window.location = '../pages/orderhistory.php';
    });

    // get the value from the GetReceiptSummary.php
    fetch('../contexts/GetUserSummary.php')
        // get response as json
        .then(response => response.json())

        // get objects from fetch
        .then(data => {
            // if passing of data is success
            if (data.status == "success") {
                // go to creating the summary
                createSummary(data.receipt);
            }

            // if passing of data is not success
            else {
                // redirect to the home.php
                window.location = '../pages/home.php';
            }
        })
        // error checker
        .catch(error => {
            // output the error in console
            console.error(error);

            // redirect to the home.php
            window.location = '../pages/home.php';
        });

    // process of creating a summary
    createSummary = (orders) => {
        // clear the container before putting the fresh orders
        summaryContainer.innerHTML = "";

        // months for conversion
        const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        // create a loop create a template
        orders.forEach(order => {
            // get the element template from summary-ad.php
            const foodTemplate = document.querySelector("[data-food-template]");
            const card = foodTemplate.content.cloneNode(true).children[0];

            // get the template child that needs value to be displayed
            const foodImage = card.querySelector("[data-food-image]");
            const foodName = card.querySelector("[data-food-name]");
            const foodDrink = card.querySelector("[data-food-drink]");
            const foodPrice = card.querySelector("[data-food-price]");
            const foodDiscount = card.querySelector("[data-food-discount]");
            const foodDate = card.querySelector("[data-food-date]");

            // place the variables got from fetch to the card
            foodImage.src = `../images/foodCategories/${order.categoryName}/${order.image}`;
            foodName.textContent = `Food name: ${order.foodName}`;
            foodDrink.textContent = `Additional: ${(order.drinkName == "No") ? "None" : order.drinkName}`;
            foodPrice.textContent = `Price: P ${Number(order.price).toLocaleString()}`;                     // add comma to the order.price
            foodDiscount.textContent = `Discount: ${(order.discount == 0) ? "None" : `${order.discount} %`}`;
            const receiptDate = new Date(order.orderDate);
            const orderDate = months[receiptDate.getMonth()] + ' ' + receiptDate.getDate() + ', ' + receiptDate.getFullYear();
            foodDate.textContent = `Date: ${orderDate}`;

            // put the card inside summary container
            summaryContainer.appendChild(card);
        })
    }
});