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

// check if there is input of data
if ( empty($data['input_cart_id']) || !isset($data['input_quantity']) ){
    $response = [
        'status' => "error",
        'message' => "Cannot find id or input quantity"
    ];
    exit ( json_encode($response) );
}

// access database
$mysqli = require_once "./database.php";

// start the session to check if there is any
session_start();

// get the current logged in user
$user_id = $_SESSION['id'];

// try to create and catch if there is error
try{
    // prepare the statement
    $stmt = $mysqli -> prepare ($sql);

    // bind the parameters to the statement
    $stmt -> bind_param ('ssss', $email, $password, $firstname, $lastname);
    
    // execute the statement
    $stmt -> execute();
    
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
    // make an error signup response
    $response = [
        'status' => "error",
        'message' => "Error No: ". $e->getCode() ." - ". $e->getMessage()    // get error code and message
    ];
}


// make a string for sql to update the cart quantity
$sql = "UPDATE `user_carts` SET `quantity`= ? WHERE id = ? AND `users_id`= ?;";



$response = [
    'status' => "success",
    'message' => "Successfully updated the amount",
    'message2' => $data
];

exit ( json_encode ($response) );

?>