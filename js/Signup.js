// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function(){
    console.log("HTML is done");

    // variables
    const signupform = document.getElementById("signupForm");

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
    signupform.addEventListener('submit', (ev) => {
        // prevent loading of website
        ev.preventDefault();

        // get the data from the form
        const signup = new FormData(signupform);

        // create object for each data in signupform
        const signupobject = {};
        signup.forEach(function(value, key){
            signupobject[key] = value;
        });

        // const signupobject = {
        //     input_name: document.querySelector('input[name=input_name]').value,
        //     input_email: document.querySelector('input[name=input_email]').value,
        //     input_password: document.querySelector('input[name=input_password]').value
        // };

        // make a request to SignupHandle.php
        fetch ('../contexts/Signup.php', {
            method: "POST",
            headers: {
                // state as a json type
                'Content-Type': 'application/json; charset=utf-8'
            },
            // convert js object to json
            body: JSON.stringify(signupobject)
        })
        
        // get response as json 
        .then (response => response.json())
            // get objects from fetch
            .then(data => {
                console.log(data);
                // redirect to dashboard if success
                if (data.status == "success"){
                    window.location.replace('../pages/Dashboard.html')
                }
            })
        // error checker
        .catch (error => console.error(error));

    })

});