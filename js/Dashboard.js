// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function(){
    console.log("HTML is done");

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

    // logout button
    document.getElementById("logoutbutton").addEventListener("click", function(ev){
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