// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function(){
    console.log("HTML is done");

    // variables
    const logoutbutton = document.getElementById("logoutbutton");

    // check for session
    fetch ('../contexts/checksession.php')
    // get response as json 
    .then (response => response.json())
        // get objects from fetch
        .then (data => {
            // if logged out, go to Login.html
            if (data.status == "logged out"){
                window.location.replace('../pages/Login.html')
            }
        })
    // error checker
    .catch (error => console.error(error));

    // logout on click
    logoutbutton.addEventListener("click", () => {
        // prevent loading of website
        ev.preventDefault();

        // go to logout
        fetch ('../contexts/logout.php')
        .then (response => response.json())
            // get objects from fetch
            .then (data => {
                console.log(data);
            })
        // error checker
        .catch (error => console.error(error));

    })

});