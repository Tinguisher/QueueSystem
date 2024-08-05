// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function () {
    // get all id, class for global variable
    const dropdownBtnText = document.getElementById("drop-text");
    const logoutButton = document.getElementById("logoutButton");
    const historyContainer = document.querySelector("[data-history-container]");
    const filterInput = document.getElementById("filterInput");
    const allord = document.getElementById("allord");
    const thisweek = document.getElementById("thisweek");
    const thismon = document.getElementById("thismon");
    var receiptArray = [];
    var filterDate = new Date();
    filterDate.setTime(0);

    // if dropdown is clicked
    dropdownBtnText.onclick = function () {
        const list = document.getElementById("list");
        list.classList.toggle("show");
    };

    // get all of the receipts
    fetch('../contexts/GetReceiptAdminProcess.php')
        // get response as json
        .then(response => response.json())

        // get objects from fetch
        .then(data => {
            // create a row for each row fetched from database
            createReceiptRows(data.receipts);
        })

        // error checker
        .catch(error => {
            // output the error in console
            console.error(error);

            // output the errors to html
            historyContainer.innerHTML = error;
        });
    
    // if there is click on logoutbutton
    logoutButton.addEventListener('click', () => {
        // go to logout.php
        fetch('../contexts/logout.php')
            // get response as json
            .then(response => response.json())

            // get objects from fetch
            .then(data => {
                // if the status is success
                if (data.status == "success") {
                    // redirect to landing page
                    window.location = '../pages/home.php';
                }
            })
            // error checker
            .catch(error => console.error(error));
    });

    // if there is change in search input
    filterInput.addEventListener('input', () => {
        // go to filtering
        filtering();
    });

    // if there is click in all order
    allord.addEventListener('click', () => {
        // get the value of 0 at time
        filterDate.setTime(0);

        // filter the receipt
        filtering();
    });

    // if there is click in this week orders
    thisweek.addEventListener('click', () => {
        // get the value of the first week
        const referenceDate = new Date();
        filterDate = referenceDate;
        filterDate.setDate(referenceDate.getDate() - referenceDate.getDay() + (referenceDate.getDay() === 0 ? -6 : 1));
        filterDate.setHours(0);
        filterDate.setMinutes(0);
        filterDate.setSeconds(0);

        // filter the receipt
        filtering();
    });

    // if there is click in this month orders
    thismon.addEventListener('click', () => {
        // get the value of the first month
        const referenceDate = new Date();
        filterDate = referenceDate;
        filterDate.setDate(1);
        filterDate.setHours(0);
        filterDate.setMinutes(0);
        filterDate.setSeconds(0);

        // filter the receipt
        filtering();
    });

    // filtering process
    filtering = () => {
        // convert the filter to lowercase
        const filterInputValue = filterInput.value.toLowerCase();

        // make the row visible or not
        receiptArray.forEach(row => {
            // check if row should be visible or not from the filter
            const rowVisibility = row.userName.toLowerCase().includes(filterInputValue) && (row.receiptDate > filterDate);

            // display "" if visibile and display:none if not visible
            row.element.style.display = rowVisibility ? "" : "none";
        })
    }

    // process on creating receipts per row
    createReceiptRows = (receipts) => {
        // clear the values from historyContainer
        historyContainer.innerHTML = "";

        // get the receipts for filtering
        receiptArray = receipts.map(receipt => {
            // get the element template from history-ad.php
            const historyTemplate = document.querySelector("[data-history-template]");
            const row = historyTemplate.content.cloneNode(true).children[0];

            // get the template child that data can be inserted
            const receiptID = row.querySelector("[data-receipt-id]");
            const userName = row.querySelector("[data-user-name]");
            const date = row.querySelector("[data-date]");
            const items = row.querySelector("[data-items]");

            // place the data got from the fetch
            receiptID.textContent = receipt.id;
            userName.textContent = receipt.userName;
            date.textContent = receipt.date;
            items.prepend(`${receipt.itemsDone} / ${receipt.totalItems}`);

            // put each made row inside historyContainer
            historyContainer.appendChild(row);

            // get the userName, receiptDate, and row itself for filtering
            return {
                userName: receipt.userName,
                receiptDate: new Date(receipt.date),
                element: row
            }
        });
    }
});