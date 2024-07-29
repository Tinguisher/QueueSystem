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
if ( !isset($data['input_cart_id']) || !isset($data['input_quantity']) ){
    $response = [
        'status' => "error",
        'message' => "Cannot find id or input quantity"
    ];
    exit ( json_encode($response) );
}

// include the functions to be used
require_once './UpdateCartQuantityFunctions.php';

// start the session to check if there is any
session_start();

// if there is session id, update user's cart quantity and if not, update guest's cart quantity
$response = ( isset($_SESSION['id']) ) ? updateUserCart($data) : updateGuestCart($data);

// exit the fetch by returning the $response
exit( json_encode($response) );

?>