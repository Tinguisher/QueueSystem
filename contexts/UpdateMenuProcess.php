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

// get the values from the post
$foodID = $data['foodID'];
$name = $data['input_name'];
$description = $data['input_description'];
$price = $data['input_price'];
$discount = $data['input_discount'];

// check if there is input of data
if ( empty($name) || empty($description) || !isset($price) || !isset($discount)){
    $response = [
        'status' => "error",
        'message' => "All fields are required"
    ];
    exit ( json_encode($response) );
}

// access database
$mysqli = require_once "./database.php";

// try to create and catch if there is error
try{
    // create an sql to update the food
    $sql = "UPDATE `foods`
    SET `name`= ?,
        `description`= ?,
        `discount`= ?,
        `price`= ?
    WHERE id = ?";

    // prepare the statement
    $stmt = $mysqli -> prepare ($sql);

    // bind the parameters to the statement
    $stmt -> bind_param ('ssidi', $name, $description, $discount, $price, $foodID);

    // execute the statement
    $stmt -> execute();

    // close the statement
    $stmt -> close();

    // create a success response
    $response = [
        'status' => "success",
        'message' => "Updated the Menu Successfully"
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

// return the response to the managemenuedit-ad.js
exit ( json_encode($response) );
?>