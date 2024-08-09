// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function () {
    // get the global variables to be used
    const ongoingdeliveriestop = document.querySelector(".ongoingdeliveriestop");

    // get the the orders for the admin to be shown
    fetch('../contexts/GetHomeAdminOrderProcess.php')
        // get response as json
        .then(response => response.json())
        // get objects from fetch
        .then(data => {
            console.log(data);
            ongoingdeliveriestop.innerHTML = data.ongoingCount;
        })

        // error checker
        .catch(error => console.error(error));

});