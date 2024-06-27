<?php

echo 'Why press me <br>';

// if the file is accessed manually and not post
if ($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: ./NotFound.html");
    exit;
}

// TO DOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO
// if there is input of data
if ( !empty ($_POST) ){
    // access database
    $mysqli = require "./database.php";

    // get post values with password as hashed
    $name = $_POST["input_name"];
    $email = $_POST["input_email"];
    $password = hash('sha256', $_POST["input_password"]);

    // sql query to create new user
    $sql = "INSERT INTO `user`(`email`, `password`, `name`) VALUES ('". $email ."','". $password ."','". $name ."');";

    // run query to website
    $mysqli->query($sql);
}



?>