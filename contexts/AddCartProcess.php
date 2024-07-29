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

// include the functions to be used
require_once './AddCartFunctions.php';

// if there is session id, add user's cart and if not, add guest's cart
$response = ( isset($_SESSION['id']) ) ? addUserCart($data) : addGuestCart($data);

// exit the fetch by returning the $response
exit( json_encode($response) );

?>