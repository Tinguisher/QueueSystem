// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function(){
    console.log("HTML is done");

    // create variables per id for functions
    const container = document.getElementById('container');
    const registerBtn = document.getElementById('register');
    const loginBtn = document.getElementById('login');
    const loginform = document.getElementById('loginform');
    const signupform = document.getElementById('signupform');

    // if user would like to signup
    registerBtn.addEventListener('click', () => {
        container.classList.add("active");
    });

    // if user would like to login
    loginBtn.addEventListener('click', () => {
        container.classList.remove("active");
    });

    // if login sign in is clicked
    loginform.addEventListener('submit', (ev) =>{
        // prevent website from loading
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
                    window.location = '../pages/home.html';
                }
            })
        
        // error checker
        .catch ( error => console.error(error) );
    })

    // if signup button of signup is clicked
    signupform.addEventListener('submit', (ev) =>{
        // prevent website from loading
        ev.preventDefault();

        // get the data from the form
        const signup = new FormData(signupform);

        // create object for each data in signupform
        const signupobject = Object.fromEntries(signup);

        // make a request to signupProcess.php
        fetch ('../contexts/SignupProcess.php', {
            method: "POST",
            headers: {
                // state as a json type
                'Content-Type': 'application/json; charset=utf-8'
            },
            // convert js object to json
            body: JSON.stringify(signupobject)
        })

        // get response as json
        .then ( response => response.json() )
            // get objects from fetch
            .then (data => {
                console.log(data);
                // redirect to dashboard if success
                if (data.status == "success"){
                    window.location = '../pages/home.html';
                }
            })
        
        // error checker
        .catch ( error => console.error(error) );
    })


});
