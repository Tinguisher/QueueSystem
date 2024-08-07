<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// access database
$mysqli = require_once "./database.php";

// make a string to get the popular menus
$sql = "SELECT foods.id,
        foods.image,
        food_categories.name AS categoryName,
        foods.name AS foodName,
        foods.description,
        foods.price,
        COUNT(food_orders.foods_id) AS popularity
    FROM `foods`
    LEFT JOIN food_categories ON foods.food_categories_id = food_categories.id
    LEFT JOIN food_orders ON food_orders.foods_id = foods.id
    LEFT JOIN receipts ON food_orders.receipts_id = receipts.id
        AND receipts.orderDate >= DATE_SUB(NOW(), INTERVAL 1 MONTH)
        AND receipts.orderDate <= NOW()
    GROUP BY foods.id;";

// try to get and catch if there is error
try{
    // prepare the statement
    $stmt = $mysqli -> prepare ($sql);

    // execute the statement
    $stmt -> execute();

    // get the result from the statement
    $result = $stmt -> get_result();

    // get only one from the executed statement
    $popularmenu = $result -> fetch_all( MYSQLI_ASSOC );

    // free data and close statement 
    $result -> free();
    $stmt -> close();
    
    // pass the menu to response
    $response = [
        'status' => "success",
        'message' => "Passed the Popular Menu",
        'menu' => $popularmenu
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

// output the response
exit ( json_encode($response) );

?>