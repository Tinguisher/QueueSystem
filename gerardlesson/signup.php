<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <h1>This is Signup Page</h1>

        <div id="thisdiv">

        </div>
        <form id="signupform">
            <input type="text" name="input_name" placeholder="Name"/>
            <br> <br>
            <input type="text" name="input_email"placeholder="Email"/>
            <br> <br>
            <input type="password" name="input_password" placeholder="Password"/>
            <br> <br>
            <input type="password" name="input_confirmpassword" placeholder="Confirm Password"/>
            <br> <br>
            <input type="submit" />
        </form>

        <script>

        // create the variable
        const signupform = document.getElementById("signupform");

        // if there is submit on the form
        signupform.addEventListener('submit', (ev) =>{
            // prevents the site to load
            ev.preventDefault();
            
            // signupform as new FormData
            const signupvalue = new FormData(signupform);

            // create fetch for login process of user
            fetch ('./signupprocess.php', {
                method: "POST",
                body: signupvalue
            })
            // get the response as json
            .then (response => response.json())
                // decode the json as variable data
                .then (data => {
                    console.log(data);
                    console.log(data.updateddiv);

                    // replace the id that has 'thisdiv' 
                    document.getElementById('thisdiv').innerHTML = data.updateddiv;

                    var status = data.status;
                    console.log(status);
                })
            
            // if there is error then output it in the console
            .catch (error => console.error(error));
            

        });

        </script>
    </body>
    

</html>