<?php
// make a session variable
session_start();

// // if there is session already, go to home.html
// if ( isset($_SESSION['id']) ){
//     header ('Location: ./home.html');
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='https://fonts.googleapis.com/css?family=Roboto Slab' rel='stylesheet'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="../stylesheets/login.css">
        
        <title>Modern Login Page</title>
    </head>

    <body>
        <div class="container" id="container">
            <div class="form-container sign-up">
                <form id="signupform">
                    <h1 class="h1wc">Create an account</h1>
                    <span class="swc">Discover a world of delicious foods.</span><br><br>
                    <input type="text" name="input_firstname" placeholder="First Name" required>
                    <input type="text" name="input_lastname" placeholder="Last Name" required>
                    <input type="text" name="input_email" placeholder="Email" required>
                    <input type="password" name="input_password" placeholder="Password" required>
                    <input type="password" name="input_confirmpassword" placeholder="Confirm Password" required>
                    <button class="button-signlogin">Sign Up</button>
                </form>
            </div>
            <div class="form-container sign-in">
                <form id="loginform">
                    <h1 class="h1wc">Welcome back!</h1>
                    <span class="swc">Welcome back. Please enter your details.</span><br><br>
                    <label for="email">Email</label>
                    <input type="email" id="email" name="input_email" placeholder="Email" required>
                    <label for="pass">Password</label>
                    <input type="password" id="pass" name="input_password" placeholder="Password" required>
                    <br><br><button type='submit'class="button-signlogin">Sign In</button>
                </form>
            </div>
            <div class="toggle-container">
                <div class="toggle">
                    <div class="toggle-panel toggle-left">
                        <h1>Accidentally here?</h1>
                        <p>Go back to login</p>
                        <button class="hidden" id="login">Login</button>
                    </div>
                    <div class="toggle-panel toggle-right">
                        <h1>Don’t have an account?</h1>
                        <p>Sign up now to enjoy exclusive benefits and faster service!</p>
                        <button class="hidden" id="register">Sign Up?</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="../js/login.js"></script>
    </body>

</html>