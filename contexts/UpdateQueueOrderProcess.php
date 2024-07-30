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
if ( !isset($data['input_order_id']) || empty($data['input_status']) ){
    $response = [
        'status' => "error",
        'message' => "Order id and request status is required"
    ];
    exit ( json_encode($response) );
}

// access database
$mysqli = require_once "./database.php";

// get the data requests
$order_id = $data['input_order_id'];
$status = $data['input_status'];

// try to create and catch if there is error
try{
    // create sql to update the status
    $sql = "UPDATE `food_orders`
        SET `status` = ?
        WHERE id = ?;";
    
    // prepare the statement
    $stmt = $mysqli -> prepare ($sql);

    // bind the parameters to the statement
    $stmt -> bind_param ('si', $status, $order_id);

    // execute the statement
    $stmt->execute();

    // close the statement
    $stmt -> close();

    // make a success response
    $response = [
        'status' => "success",
        'message' => "Status updated successfully"
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

// close the database
$mysqli -> close();

// return the response as json back to queueorder-ad.js
exit ( json_encode($response) );

?>