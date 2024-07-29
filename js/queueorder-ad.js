// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function () {

    // get all the id, class for global variable
    const QueueOrderContainer = document.querySelector("[data-queue-order-container]");
    var queueArray = [];

    // get the queues from the database
    fetch('../contexts/GetQueueOrderProcess.php')
        // get response as json
        .then(response => response.json())

        // get objects from fetch
        .then(data => {
            // create table for the queues
            createTable(data.queue);
        })

        // error checker
        .catch(error => {
            // output the error in console
            console.error(error);

            // output the errors to html
            QueueOrderContainer.innerHTML = error;
        });

    // create table processes
    createTable = (queues) => {
        // clear the values from the queueOrderContainer
        QueueOrderContainer.innerHTML = "";

        // get values of the queue as a global variable
        queueArray = queues.map( queue => {
            // get the template for queue order and clone it
            const queueOrderTemplate = document.querySelector("[data-queue-order-template]");
            const row = queueOrderTemplate.content.cloneNode(true);

            // get the template child that data can be inserted
            const receiptID = row.querySelector("[data-receipt-id]");
            const foodName = row.querySelector("[data-food-name]");
            const quantity = row.querySelector("[data-quantity]");
            const price = row.querySelector("[data-price]");
            const status = row.querySelector("[data-status]");

            // place the data got from the fetch            
            receiptID.textContent = queue.id;
            foodName.textContent = queue.foodName;
            quantity.textContent = queue.quantity;
            price.textContent = queue.price;
            status.textContent = queue.status;

            // put each made row inside QueueOrderContainer
            QueueOrderContainer.appendChild(row);

            // get the category, and row itself for filtering
            return {
                foodCategory: queue.categoryName,
                element: row
            };
        });


        console.log(queueArray);
    }



});