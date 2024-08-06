<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// initialize the use of session
session_start();

// if there is no carts from the session
if ( empty($_SESSION['carts']) ) {
    // create a response that there are no cart from the guest
    $response = [
        'status' => "success",
        'message' => "There are no carts from the guest"
    ];

    // exit the request by returning response
    exit ( json_encode($response) );
}

// get the current logged in user
$user_id = $_SESSION['id'];

// try to create and catch if there is error
try{
    // access database
    $mysqli = require_once './database.php';

    // create a starting point of database
    $mysqli -> begin_transaction();

    foreach ($_SESSION['carts'] as $sessionCart) {
        // make a string sql to insert data to user_carts
        $sql = "INSERT INTO `user_carts`(`users_id`, `foods_id`, `quantity`, `drinks_id`) VALUES (?, ?, ?, ?);";

        // prepare the statement
        $stmt = $mysqli -> prepare ($sql);

        // bind the parameters to the statement
        $stmt -> bind_param ('iiii', $user_id, $sessionCart['food_id'], $sessionCart['quantity'], $sessionCart['drink_id']);

        // execute the statement
        $stmt -> execute();
    }

    // commit all inserts if successful
    $mysqli -> commit();

    // unset the session carts
    unset($_SESSION['carts']);

    // free data and close statement
    $result -> free();
    $stmt -> close();
    
    // pass the response if it is success
    $response = [
        'status' => "success",
        'message' => "Passed the Guest Cart to User Cart Successfully"
    ];
}

// if there is error in query
catch (Exception $e){
    // rollback the database
    $mysqli -> rollback();
    
    // make an error response
    $response = [
        'status' => "error",
        'message' => "Error No: ". $e->getCode() ." - ". $e->getMessage()    // get error code and message
    ];
}

// close the database
$mysqli -> close();

// exit the request by returning response
exit ( json_encode($response) );

?>