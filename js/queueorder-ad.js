// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function () {
    // get all the id, class for global variable
    const QueueOrderContainer = document.querySelector("[data-queue-order-container]");
    const filterButtons = document.querySelectorAll("input[name='category']");
    var queueArray = [];

    // process to get the queue in database
    function fetchData (){
        // get the queues from the database
        fetch('../contexts/GetQueueOrderProcess.php')
            // get response as json
            .then(response => response.json())

            // get objects from fetch
            .then(data => {
                // create table for the queues
                createTable(data.queue);

                // go to filtering
                filtering();

                // get the data every second
                setTimeout(fetchData, 1000);
            })

            // error checker
            .catch(error => {
                // output the error in console
                console.error(error);

                // output the errors to html
                QueueOrderContainer.innerHTML = error;

                // get the data every second
                setTimeout(fetchData, 1000);
            });
    }

    // call the method to get the queues in databases
    fetchData();

    // loop for every named as category
    filterButtons.forEach(filterButton => {
        // if there is click on filterButtons
        filterButton.addEventListener('click', () => {
            // go to filtering
            filtering();
        });
    });

    // filtering process
    filtering = () => {
        // get the value of the filter button
        const filterButtonValue = document.querySelector('input[name="category"]:checked').value;

        // make the row visible or not
        queueArray.forEach(queue => {
            // check if row should be visible or not from the filter
            const rowVisibility = queue.foodCategory.includes(filterButtonValue);

            // display: "" if visible and display: none if not visible
            queue.element.style.display = rowVisibility ? "" : "none";
        });
    }

    // create table processes
    createTable = (queues) => {
        // clear the values from the queueOrderContainer
        QueueOrderContainer.innerHTML = "";

        // get values of the queue as a global variable
        queueArray = queues.map(queue => {
            // get the template for queue order and clone it
            const queueOrderTemplate = document.querySelector("[data-queue-order-template]");
            const row = queueOrderTemplate.content.cloneNode(true).children[0];

            // get the template child that data can be inserted
            const receiptID = row.querySelector("[data-receipt-id]");
            const foodName = row.querySelector("[data-food-name]");
            const quantity = row.querySelector("[data-quantity]");
            const price = row.querySelector("[data-price]");
            const status = row.querySelector("[data-status]");

            // place the data got from the fetch            
            receiptID.textContent = queue.receiptID;
            foodName.textContent = queue.foodName;
            quantity.textContent = queue.quantity;
            price.textContent = `Php ${Number(queue.price).toLocaleString()}`;   // add comma to the queue.price
            status.value = queue.status;

            // put each made row inside QueueOrderContainer
            QueueOrderContainer.appendChild(row);

            // if there is click in status
            status.addEventListener('click', () => {
                // if the queue status is pending, make the value In progress
                if (queue.status == "Pending") status.value = "In Progress";

                // if the queue status is pending, make the value Completed
                else status.value = "Completed";

                // update the queue status method
                updateQueueStatus(queue.orderID, status.value);
            });

            // get the category, and row itself for filtering
            return {
                foodCategory: queue.categoryName,
                element: row
            };
        });
    }

    // process to update queue status
    updateQueueStatus = (order_id, request_status) => {
        // create a payload to be passed in database
        const payload = {
            input_order_id: order_id,
            input_status: request_status
        }

        // update the status in the database
        fetch('../contexts/UpdateQueueOrderProcess.php', {
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
                fetchData();

                // if update status is not success
                if (data.status != "success") {
                    console.error(data.message);
                }
            })

            // error checker
            .catch(error => {
                console.error(error);
                QueueOrderContainer.innerHTML = error
            });
    }
});