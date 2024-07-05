// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function(){
    console.log("HTML is done");

    // variables
    const logoutbutton = document.getElementById("logoutbutton");

    // logout on click
    logoutbutton.addEventListener("click", (ev) => {
        // prevent loading of website
        ev.preventDefault();

        // go to logout
        fetch ('../contexts/logout.php')
        .then (response => response.json())
            // get objects from fetch
            .then (data => {
                console.log(data);
                if (data.status == "success"){
                    window.location.replace('../pages/Login.php')
                }
            })
        // error checker
        .catch (error => console.error(error));

    });

});