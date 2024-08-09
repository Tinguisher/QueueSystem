// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function () {
    // global variable for usage
    const summaryContainer = document.getElementById("summaryContainer");

    // create new URLSearchParams to get values
    const urlParams = new URLSearchParams(window.location.search);

    // get the value of receiptID in the url
    const userID = urlParams.get("userID");

    // if there is userID in the url
    if (userID) {
        // get the value from the GetReceiptSummary.php
        fetch(`../contexts/GetUserSummary.php?userID=${userID}`)
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

    }

    // if there is no receiptID in the url
    else {
        // redirect to the home.php
        window.location = '../pages/home.php';
    }
});