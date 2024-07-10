<?php

// get the values from the post request
// SYNTAX: $_POST['name'] (name from html)
$username = $_POST['input_username'];
$email = $_POST['input_email'];
$password = $_POST['input_password'];
$confirmPassword = $_POST['input_confirmPassword'];

if ($password != $confirmPassword){
    // create response if password does not match
    $response = [
        'status' => "error",
        'message' => "Confirm password does not match"
    ];
    // return the response
    exit ( json_encode ($response) );
}

// HASH THE PASSWORD
$password = password_hash($_POST['input_password'], PASSWORD_BCRYPT);

// connect through the database
$mysqli = require_once './database.php';

$sql = "INSERT INTO `accounts`(`Username`, `Email`, `Password`) VALUES ('". $username ."','". $email ."','". $password ."')";

$response = [
    'status' => "success",
    'message' => "Password Matched"
];


// exit and return the response as json
exit ( json_encode($response) );

?>