// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function () {
    // get the global variables to be used
    const ongoingdeliveriestop = document.querySelector(".ongoingdeliveriestop");
    const currentOrderContainer = document.querySelector("[data-current-order-container]");

    // process of getting data
    function fetchData() {
        // get the the orders for the admin to be shown
        fetch('../contexts/GetHomeAdminOrderProcess.php')
            // get response as json
            .then(response => response.json())
            // get objects from fetch
            .then(data => {
                // set the innerhtml for ongoing count
                ongoingdeliveriestop.innerHTML = data.ongoingCount;

                // create row for the current orders
                createCurrentOrders(data.currentOrders);

                // get the data every second
                setTimeout(fetchData, 1000);
            })

            // error checker
            .catch(error => {
                // output the error in console and container
                console.error(error);
                currentOrderContainer = error;

                // get the data every second
                setTimeout(fetchData, 1000);
            });
    }

    // get the data
    fetchData();

    // process of creating current orders
    createCurrentOrders = (currentOrders) => {
        // clear the container of current orders
        currentOrderContainer.innerHTML = "";

        // loop of creating current order rows
        currentOrders.forEach(currentOrder => {
            // get the element template from home-ad.php
            const currentOrderTemplate = document.querySelector("[data-current-order-template]");
            const row = currentOrderTemplate.content.cloneNode(true).children[0];

            // get the template child that data can be inserted
            const receiptID = row.querySelector("[data-receipt-id]");
            const status = row.querySelector("[data-status]");
            const items = row.querySelector("[data-items]");

            // place the data got from the fetch
            receiptID.textContent = currentOrder.id;
            status.textContent = currentOrder.status;
            items.textContent = currentOrder.totalItems;

            // put each made row inside currentOrderContainer
            currentOrderContainer.appendChild(row);

        });
    }
});