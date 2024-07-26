<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// access database
$mysqli = require_once "./database.php";

// start the session to check if there is any
session_start();

// get the current logged in user
$user_id = $_SESSION['id'];

// make a string for sql to be used
$sql = "SELECT 
        user_carts.id,
        foods.image,
        food_categories.name AS categoryName,
        foods.name AS foodName,
        foods.description,
        (foods.price * user_carts.quantity) AS price,
        user_carts.quantity
    FROM `user_carts`, `foods`, `food_categories`
    WHERE user_carts.foods_id = foods.id AND foods.food_categories_id = food_categories.id AND user_carts.users_id = ?
    ORDER BY user_carts.id;";

// try to create and catch if there is error
try {
    // prepare the statement
    $stmt = $mysqli -> prepare ($sql);

    // bind the parameters to the statement
    $stmt -> bind_param ('i', $user_id);

    // execute the statement
    $stmt -> execute();

    // get the result from the statement
    $result = $stmt -> get_result();

    // get all data from the executed statement
    $userCart = $result -> fetch_all( MYSQLI_ASSOC );

    // pass the user's cart to response
    $response = [
        'status' => "success",
        'message' => "Passed All of User's Cart",
        'userCart' => $userCart
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

// free data and close statement and database
$result -> free();
$stmt -> close();
$mysqli -> close();

exit ( json_encode($response) );

?>