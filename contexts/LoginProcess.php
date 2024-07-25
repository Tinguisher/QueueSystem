<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// if the file is accessed manually and not post
if ( $_SERVER['REQUEST_METHOD'] !== "POST" ){
    header('Location: ../pages/NotFound.html');
    exit();
}

// get raw input from the form instead of json
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// check if there is input of data
if ( empty($data['input_email']) || empty($data['input_password']) ){
    $response = [
        'status' => "error",
        'message' => "All fields are required"
    ];
    exit ( json_encode($response) );
}

// access database
$mysqli = require_once './database.php';

// make a string for sql to be used
$sql = "SELECT * FROM `users` WHERE email = ?";

// prepare the statement
$stmt = $mysqli -> prepare ($sql);

// bind the parameters to the statement
$stmt -> bind_param ('s', $email);

// get post values
$email = $data['input_email'];
$password = $data['input_password'];

// execute the statement
$stmt -> execute();

// get the result from the statement
$result = $stmt -> get_result();

// get only one from the executed statement
$user = $result -> fetch_assoc();

// free data and close statement and database
$result -> free();
$stmt -> close();
$mysqli -> close();

// if there is no existing user in database
if (!$user){
    $response = [
        'status' => "error",
        'message' => "No existing user, Signup?"
    ];
    exit ( json_encode($response) );
}

// if the password is not the same
if (!password_verify($password, $user['password'])){
    $response = [
        'status' => "error",
        'message' => "Incorrect password",
    ];
    exit ( json_encode($response) );
}

// make a session
session_start();

// get the id and authtype as session identifier
$_SESSION['id'] = $user['id'];
$_SESSION['authtype'] = $user['authtype'];

// make a success signup response
$response = [
    'status' => "success",
    'message' => "Login Successful"
];

// output the response
exit ( json_encode($response) );

?>
