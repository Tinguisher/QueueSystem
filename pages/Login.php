<?php
// make a session variable
session_start();

// if there is session already, go to home
if ( isset($_SESSION['id']) ){
    header('Location: ./home.html');
    exit();
}

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
        <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
        
        <title>Snap Serve</title>
    </head>
    <body>
        <div>
            <p style="  position: absolute; margin-left: 763px; margin-top: 15px; width: 1128px;height: 110px; border-top: 4px solid #000; border-bottom: 4px solid #000;"></p>
            <img src="../images/log.png" id="log">
            <p id="snap">Snap Serve</p>
            <p id="bite">Precision in Every Bite</p>
            
            <table style="margin-top: 38px; margin-left: 1118px; position: absolute;">
                <tr>
                <td style="width: 138px;"><a href="home.html" target="_top">Home</a></td>
                <td style="width: 133px;" id="menn"><a href="menu.html" target="_top">Menu</a></td>
                <td style="width: 155px;"><a href="aboutus.html" target="_top">About Us</a></td>
                </tr>
            </table>

            <p id="copy">Copyrights © 2024 <br> SnapServe by ARC System Solutions.<br>All Rights Reserved</p>
        </div>

        <div class="container" id="container">
            <div class="form-container sign-up">
                <form id="signupform">
                    <h1 class="h1wc">Create an account</h1>
                    <span class="swc">Discover a world of delicious foods.</span><br><br>
                    <input type="text" name="input_firstname" placeholder="First Name" required>
                    <input type="text" name="input_lastname" placeholder="Last Name" required>
                    <input type="email" name="input_email" placeholder="Email" required>
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
                    <input type="email" name="input_email" id="email" placeholder="Email">
                    <label for="pass">Password</label>
                    <input type="password" name="input_password" id="pass" placeholder="Password">
                    <br><br><button class="button-signlogin">Sign In</button>
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