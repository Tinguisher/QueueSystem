// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function () {
    // global variable for usage
    const summaryContainer = document.getElementById("summaryContainer");

    // create new URLSearchParams to get values
    const urlParams = new URLSearchParams(window.location.search);

    // get the value of receiptID in the url
    const receiptID = urlParams.get("receiptID");

    // if there is receiptID in the url
    if (receiptID) {
        // get the value from the GetReceiptSummary.php
        fetch(`../contexts/GetReceiptSummary.php?receiptID=${receiptID}`)
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
                    // redirect to the history-ad.php
                    window.location = './history-ad.php';
                }
            })
            // error checker
            .catch(error => {
                // output the error in console
                console.error(error);

                // redirect to the history-ad.php
                window.location = './history-ad.php';
            });

    }

    // if there is no receiptID in the url
    else {
        // redirect to the history-ad.php
        window.location = './history-ad.php';
    }

    // process of creating a summary
    createSummary = (orders) => {
        // clear the container before putting the fresh orders
        summaryContainer.innerHTML = "";

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

            // place the variables got from fetch to the card
            foodImage.src = `../images/foodCategories/${order.categoryName}/${order.image}`;
            foodName.textContent = `Food name: ${order.foodName}`;
            foodDrink.textContent = `Additional: ${(order.drinkName == "No") ? "None" : order.drinkName}`;
            foodPrice.textContent = `Price: P ${Number(order.price).toLocaleString()}`;                     // add comma to the order.price
            foodDiscount.textContent = `Discount: ${(order.discount == 0) ? "None" : `${order.discount} %`}`;

            // put the card inside summary container
            summaryContainer.appendChild(card);
        })
    }
});