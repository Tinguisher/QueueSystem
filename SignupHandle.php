<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// if the file is accessed manually and not post
if ($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: ./NotFound.html");
    exit;
}

// get raw input from the form instead of json
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// check if there is input of data
if ( empty($data['input_name']) || empty($data['input_email'])  || empty($data['input_password']) ){
    $response = [
        'status' => "error",
        'message' => "All fields are required"
    ];
    exit( json_encode($response) );
}

// access database
$mysqli = require "./database.php";

// get post values with password as hashed
$name = $data['input_name'];
$email = $data['input_email'];
$password = hash('sha256', $data['input_password']);

// sql query to create new user
$sql = "INSERT INTO `user`(`email`, `password`, `name`) VALUES ('". $email ."','". $password ."','". $name ."');";

// try the query
try{
    $mysqli->query($sql);
    $response = [
        'status' => "success",
        'message' => "Signup Successful"
    ];
}

// if there is error in query
catch (Exception $e){
    $response = [
        'status' => "error",
        'message' => "Error No: ".$e->getCode(). " - ". $e->getMessage()    // get error code and message
    ];
}

// output the response
exit ( json_encode($response) );

?>