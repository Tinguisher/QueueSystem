<?php
// make a session variable
session_start();

// if there is session already, go to dashboard
if ( isset($_SESSION['id']) ){
    header('Location: ./Dashboard.php');
    exit();
}

?>

<html>
    <head>

    </head>
    <body>
        <h1>This is H1</h1>
        <form id="loginForm">
            <input type="email" name="input_email" placeholder="Email"></input>
            <br> <br>
            <input type="password" name="input_password" placeholder="Password"></input>
            <br> <br>
            <input type="submit"></input>
        </form>
        <a href="./Signup.php">Sign up</a>
        <script src="../js/Login.js"></script>
    </body>
</html>