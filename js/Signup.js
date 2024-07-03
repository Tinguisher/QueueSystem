// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function(){

    console.log("HTML is done");

    // check for session
    fetch ('../contexts/checksession.php')
    // get response as json 
    .then (response => response.json())
        // get objects from fetch
        .then (data => {
            // if logged in, go to dashboard
            if (data.status == "logged in"){
                window.location.replace('../pages/Dashboard.html')
            }
        })
    // error checker
    .catch (error => console.error(error));
        
    // if there is submit on signupForm
    document.getElementById("signupForm").addEventListener('submit', function(ev){
        // prevent loading of website
        ev.preventDefault();

        // get the data from the form
        const signup = new FormData(this);

        // convert formdata into object
        const signupjson = {};
        signup.forEach(function(value, key){
            signupjson[key] = value;
        });
        
        // make a request to SignupHandle.php
        fetch ('../contexts/Signup.php', {
            method: "POST",
            headers: {
                // state as a json type
                'Content-Type': 'application/json; charset=utf-8'
            },
            // convert js object to json
            body: JSON.stringify(signupjson)
        })
        
        // get response as json 
        .then (response => response.json())
            // get objects from fetch
            .then(data => {
                console.log(data.status);
            })
        // error checker
        .catch (error => console.error(error));

    })

});