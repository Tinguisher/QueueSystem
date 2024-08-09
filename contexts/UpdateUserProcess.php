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

// get post values
$firstname = $data['input_firstname'];
$lastname = $data ['input_lastname'];
$email = $data['input_email'];

// check if there is input of data
if ( empty($email) || empty($firstname) || empty($lastname)){
    $response = [
        'status' => "error",
        'message' => "All fields are required"
    ];
    exit( json_encode($response) );
}

// access database
$mysqli = require "./database.php";
session_start();

// try to create and catch if there is error
try{
    $sql = "UPDATE `users`
        SET `email`= ?,
            `firstname`= ?,
            `lastname`= ?
        WHERE id = ?;";

    // prepare the statement
    $stmt = $mysqli -> prepare ($sql);

    // bind the parameters to the statement
    $stmt -> bind_param ('sssi', $email, $firstname, $lastname, $_SESSION['id']);

    // execute the statement
    $stmt -> execute();

    // close the statement
    $stmt -> close();

    // create a success response
    $response = [
        'status' => "success",
        'message' => "Successfully Updated the User"
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

// output the response
exit ( json_encode($response) );

?>