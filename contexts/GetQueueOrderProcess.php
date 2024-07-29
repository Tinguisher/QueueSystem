<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// access database
$mysqli = require_once "./database.php";

$sql = "SELECT food_orders.id,
        receipts.id,
        food_categories.name AS categoryName,
        foods.name AS foodName,
        food_orders.quantity,
        food_orders.price,
        food_orders.status
    FROM `food_orders`,
        `foods`,
        `food_categories`,
        `receipts`
    WHERE food_orders.foods_id = foods.id
        AND foods.food_categories_id = food_categories.id
        AND food_orders.receipts_id = receipts.id
    ORDER BY receipts.orderDate;";

// try to create and catch if there is error
try{
    // prepare the statement
    $stmt = $mysqli -> prepare ($sql);

    // execute the statement
    $stmt -> execute();

    // get the result from the statement
    $result = $stmt -> get_result();

    // get all the values from the queue
    $queue = $result -> fetch_all( MYSQLI_ASSOC );

    // create a success reponse
    $response = [
        'status' => "success",
        'message' => "Passed the message",
        'queue' => $queue
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

// return the response as json
exit ( json_encode($response) );

?>