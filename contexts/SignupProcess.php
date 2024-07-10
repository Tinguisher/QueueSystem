<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// if the file is accessed manually and not post
if ($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: ../pages/NotFound.html");
    exit();
}

// get raw input from the form instead of json
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// get post values
$email = $data['input_email'];
$password = $data['input_password'];
$confirm_password = $data['input_confirmpassword'];
$firstname = $data['input_firstname'];
$lastname = $data ['input_lastname'];

// check if there is input of data
if ( empty($email)  || empty($password) || empty($confirm_password) || empty($firstname) || empty($lastname)){
    $response = [
        'status' => "error",
        'message' => "All fields are required"
    ];
    exit( json_encode($response) );
}

// if password and confirm password is not the same
if ( $password !== $confirm_password){
    $response = [
        'status' => "error",
        'message' => "Confirm Password does not match"
    ];
    exit( json_encode($response) );
}

// access database
$mysqli = require "./database.php";

// get the raw input for hashing, password_hash only works from raw inputs
$password = password_hash($data['input_password'], PASSWORD_BCRYPT);

// make a string for sql to be used
$sql = "INSERT INTO `users`(`email`, `password`, `authtype`, `firstname`, `lastname`) VALUES ('". $email ."', '". $password ."', 'user', '". $firstname ."', '". $lastname ."');";

try{
    // try the query for validation
    $mysqli->query($sql);
    
    session_start();                // create a session
    $last_id = $mysqli->insert_id;  // get the last inserted id
    $_SESSION['id'] = $last_id;     // use the last inserted id as session
    $_SESSION['authtype'] = "user"; // set the auth type as user
    
    // make a success signup response
    $response = [
        'status' => "success",
        'message' => "Signup Successful"
    ];
}

// if there is error in query
catch (Exception $e){
    $response = [
        'status' => "error",
        'message' => "Error No: ". $e->getCode() ." - ". $e->getMessage()    // get error code and message
    ];
}

// output the response
exit ( json_encode($response) );

?>