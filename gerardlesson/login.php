<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <h1>This is Login Page</h1>

        <form id="loginform">
            <input type="text" name="input_email"placeholder="Email"/>
            <br> <br>
            <input type="text" name="input_password" placeholder="Password"/>
            <br> <br>
            <input type="submit" />
        </form>

        <script>

        // create the variable
        const loginform = document.getElementById("loginform");

        // if there is submit on the form
        loginform.addEventListener('submit', (ev) =>{
            // prevents the site to load
            ev.preventDefault();
            
            // loginform as new FormData
            const loginvalue = new FormData(loginform);

            // create fetch for login process of user
            fetch ('./loginprocess.php', {
                method: "POST",
                body: loginvalue
            })
            // get the response as json
            .then (response => response.json())
                // decode the json as variable data
                .then (data => {
                    console.log(data)

                    var status = data.status;
                    console.log(status);
                });
            
            // console.log(loginform);
            // console.log(loginvalue);

        });

        </script>
    </body>
    

</html>