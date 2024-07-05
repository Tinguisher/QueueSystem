<?php
// make a session variable
session_start();

// if there is session already, go to dashboard
if ( isset($_SESSION['id']) ){
    header('Location: ./Dashboard.php');
    exit();
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Signup</title>
    </head>
    <body>
        <h1>This is Signup</h1>
        <form id="signupForm">
            <input type="text" name="input_name" placeholder="Name"/>
            <br> <br>
            <input type="email" name="input_email" placeholder="Email"/>
            <br> <br>
            <input type="password" name="input_password" placeholder="Password"/>
            <br> <br>
            <input type="submit"></input>
        </form>
        <a href="./Login.php">Log in</a>
        <script src="../js/Signup.js"></script>
    </body>
</html>