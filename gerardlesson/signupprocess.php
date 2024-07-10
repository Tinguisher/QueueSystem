<?php

// signup process

// if input password does not match to confirm password
if ($_POST['input_password'] !== $_POST['input_confirmpassword']){
    $response = [
        'status' => "error",
        'message' => "Confirm password does not match"
    ];
    // exit and do not continue the code
    exit ( json_encode($response) );
}

// access database
$mysqli = require "./database.php";

// get the inputs from post
$name = $_POST['input_name'];
$email = $_POST['input_email'];
$password = password_hash($_POST['input_password'], PASSWORD_BCRYPT);

// create the sql statement
$sql = "INSERT INTO `users`(`name`, `email`, `password`) VALUES ('". $name ."','". $email ."','". $password ."');";

// try because the code $mysqli->query($sql); will not let you check the error
try {

    // this query is to run in phpmyadmin
    $mysqli->query($sql);

    $div = "<div> <h1> This States that you have made an account</h1> </div>";
    exit ( json_encode([
        'status' => "success, made an account",
        'updateddiv' => $div
    ]));
}

// catch if there is error in executing the sql
catch (Exception $e){
    $response = [
        'status' => "error",
        'message' => "Error No: ". $e->getCode() ." - ". $e->getMessage()    // get error code and message
    ];
    exit ( json_encode($response) );
}

?>