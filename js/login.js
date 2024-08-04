// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function () {
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
    loginform.addEventListener('submit', (ev) => {
        // prevent website from loading
        ev.preventDefault();

        // get the data from the form
        const login = new FormData(loginform);

        // create object for each data in loginform
        const payload = Object.fromEntries(login);

        // make a request to LoginProcess.php
        fetch('../contexts/LoginProcess.php', {
            method: "POST",
            headers: {
                // state as a json type
                'Content-Type': 'application/json; charset=utf-8'
            },
            // convert js object to json
            body: JSON.stringify(payload)
        })

            // get response as json
            .then(response => response.json())
            // get objects from fetch
            .then(data => {
                // redirect to dashboard if success
                if (data.status == "success") {
                    window.location = '../pages/home.php';
                }

                // if status is not success
                else {
                    // get the p in login form
                    let verification = loginform.querySelector('p');

                    // if there is still no p element
                    if (!verification) {
                        // create a p element and insert it to loginform
                        verification = document.createElement('p');
                        loginform.insertBefore(verification, loginform.children[8]);
                    }

                    // change the textContent of message
                    verification.textContent = data.message;
                }
            })

            // error checker
            .catch(error => console.error(error));
    })

    // if signup button of signup is clicked
    signupform.addEventListener('submit', (ev) => {
        // prevent website from loading
        ev.preventDefault();

        // get the data from the form
        const signup = new FormData(signupform);

        // create object for each data in signupform
        const payload = Object.fromEntries(signup);

        // make a request to signupProcess.php
        fetch('../contexts/SignupProcess.php', {
            method: "POST",
            headers: {
                // state as a json type
                'Content-Type': 'application/json; charset=utf-8'
            },
            // convert js object to json
            body: JSON.stringify(payload)
        })

            // get response as json
            .then(response => response.json())
            // get objects from fetch
            .then(data => {
                // redirect to dashboard if success
                if (data.status == "success") {
                    window.location = '../pages/home.php';
                }

                // if status is not success
                else {
                    // get the p in signup form
                    let verification = signupform.querySelector('p');

                    // if there is still no p element
                    if (!verification) {
                        // create a p element and insert it to signupform
                        verification = document.createElement('p');
                        signupform.insertBefore(verification, signupform.children[9]);
                    }

                    // change the textContent of message
                    verification.textContent = (data.message.includes("1062")) ? "Email already exists, Login?" : data.message;
                }
            })

            // error checker
            .catch(error => console.error(error));
    })
});