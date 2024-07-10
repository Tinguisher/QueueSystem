<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>


    <body>
        <h1>This is Signup</h1>
        
        <form id="signupform">
            <input type="text" name="input_username" placeholder="Username" />
            <br> <br>
            <input type="email" name="input_email" placeholder="Email" />
            <br> <br>
            <input type="password" name="input_password" placeholder="Password" />
            <br> <br>
            <input type="password" name="input_confirmPassword" placeholder="Confirm Password" />
            <br> <br>
            <input type="submit" />
        </form>



        <script>
            // create a variable
            const signupform = document.getElementById("signupform");

            // if there is submit on signupform
            signupform.addEventListener('submit', (ev) => {
                // this is to stop website from loading
                ev.preventDefault();
                
                // get the inputs from signup
                const signupvalues = new FormData(signupform);
                
                // fetch from indexprocess.php
                fetch ('./indexprocess.php', {
                    // method post if submitting
                    method: "POST",
                    // content to be passed through api
                    body: signupvalues
                })

                // decode responsejson into readable
                .then (response => response.json())

                    // use the decoded json as variable data
                    .then (data => {
                        console.log(data.message);

                        
                    })

                .catch (error => console.error(error));


                console.log("tite");





            })

        </script>



    </body>
</html>