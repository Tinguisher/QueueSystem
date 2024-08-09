// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function () {
    // global variables
    const sessionbutton = document.getElementById("sessionbutton");

    // if there is click on logoutbutton
    sessionbutton.addEventListener('click', () => {
        // go to logout.php
        fetch('../contexts/logout.php')
            // get response as json
            .then(response => response.json())

            // get objects from fetch
            .then(data => {
                // if the status is success
                if (data.status == "success") {
                    // reload the website
                    window.location = '../pages/home.php';
                }
            })
            // error checker
            .catch(error => console.error(error));
    });
});


// /* When the user clicks on the button, 
// toggle between hiding and showing the dropdown content */
var dropdowns = document.getElementsByClassName("dropdown-content");
var i;
var openDropdown = dropdowns[i];
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
    if (!event.target.matches('.dropbtn')) {

        for (i = 0; i < dropdowns.length; i++) {
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}