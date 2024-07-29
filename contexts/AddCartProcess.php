<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// if the file is accessed manually and not post
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header('Location: ../pages/NotFound.html');
    exit();
}

// get raw input from the form instead of json
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// check if there is input of dat
if (empty($data['input_food_id']) || empty($data['input_quantity'])) {
    $response = [
        'status' => "error",
        'message' => "All fields are required"
    ];
    exit(json_encode($response));
}

// start the session to check if there is any
session_start();

// if there is session id, add user's cart and if not, add guest's cart
$response = ( isset($_SESSION['id']) ) ? getUserCart() : getGuestCart();

// access database
$mysqli = require_once './database.php';

// get post values
$user_id = $_SESSION['id'];
$food_id = $data['input_food_id'];
$quantity = $data['input_quantity'];

// make a string for sql to be used
$sql = "INSERT INTO `user_carts`(`users_id`, `foods_id`, `quantity`) VALUES (? , ?, ?);";

// try to create and catch if there is error
try{
    // prepare the statement
    $stmt = $mysqli -> prepare ($sql);

    // bind the parameters to the statement
    $stmt -> bind_param ('iii', $user_id, $food_id, $quantity);

    // execute the statement
    $stmt -> execute();

    // make a response of success
    $response = [
        'status' => "success",
        'message' => "Added to Cart"
    ];
}

// if there is error in query
catch (Exception $e){
    // make an error response
    $response = [
        'status' => "error",
        'message' => "Error No: ". $e->getCode() ." - ". $e->getMessage()    // get error code and message
    ];
}

// close statement and database
$stmt -> close();
$mysqli -> close();



// !isset($_SESSION['id']) 

exit(json_encode($response));

?>