// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function(){
    console.log("HTML is done");

    // variables
    const loginform = document.getElementById('loginForm');

    // if there is is submit on loginForm
    loginform.addEventListener('submit', (ev) => {
        // prevent loading of website
        ev.preventDefault();

        // get the data from the form
        const login = new FormData(loginform);

        // create object for each data in loginform
        const loginobject = Object.fromEntries(login);

        // make a request to LoginProcess.php
        fetch ('../contexts/LoginProcess.php', {
            method: "POST",
            headers: {
                // state as a json type
                'Content-Type': 'application/json; charset=utf-8'
            },
            // convert js object to json
            body: JSON.stringify(loginobject)
        })

        // get response as json
        .then ( response => response.json() )
            // get objects from fetch
            .then (data => {
                console.log(data);
                // redirect to dashboard if success
                if (data.status == "success"){
                    window.location.replace('../pages/Dashboard.php');
                }
            })
        
        // error checker
        .catch ( error => console.error(error) );

    });
});