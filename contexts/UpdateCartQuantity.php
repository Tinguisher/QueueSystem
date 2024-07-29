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

// start the session to check if there is any
session_start();



// access database
$mysqli = require_once "./database.php";

// start the session to check if there is any
session_start();

// get the current logged in user
$user_id = $_SESSION['id'];

// get the data requests
$cart_id = $data['input_cart_id'];
$quantity = $data['input_quantity'];

// try to create and catch if there is error
try{
    // if requested is 0 or lower, delete
    if ($quantity <= 0){
        // make a string for sql to delete the cart
        $sql = "DELETE FROM `user_carts`
            WHERE id = ? AND `users_id` = ?;"; 

        // prepare the statement
        $stmt = $mysqli -> prepare ($sql);

        // bind the parameters to the statement
        $stmt -> bind_param ('ii', $cart_id, $user_id);
    }

    // if requested is not 0, update
    else{
        // make a string for sql to update the cart quantity
        $sql = "UPDATE `user_carts`
            SET `quantity`= ?
            WHERE id = ? AND `users_id`= ?;";
        
        // prepare the statement
        $stmt = $mysqli -> prepare ($sql);

        // bind the parameters to the statement
        $stmt -> bind_param ('iii', $quantity, $cart_id, $user_id);
    }

    // execute the statement
    $stmt->execute();

    // make a success response
    $response = [
        'status' => "success",
        'message' => "Update Quantity Successful"
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

exit ( json_encode ($response) );

?>