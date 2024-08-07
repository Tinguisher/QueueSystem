<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// access database
$mysqli = require_once "./database.php";

// try to create and catch if there is error
try{
    // create a sql to get the receipt
    $sql = "SELECT foods.name AS foodName,
        food_categories.name AS categoryName,
        foods.image,
        food_orders.price,
        drinks.name as drinkName
    FROM `receipts`,
        `food_orders`,
        `foods`,
        `food_categories`,
        `drinks`
    WHERE receipts.id = food_orders.receipts_id
        AND food_orders.foods_id = foods.id
        AND foods.food_categories_id = food_categories.id
        AND food_orders.drinks_id = drinks.id
        AND receipts.id = ?;";

    // prepare the statement
    $stmt = $mysqli -> prepare ($sql);

    // bind the parameters to the statement
    $stmt -> bind_param ('i', $_GET['receiptID']);

    // execute the statement
    $stmt -> execute();

    // get the result from the statement
    $result = $stmt -> get_result();

    // get only one from the executed statement
    $receipt = $result -> fetch_all( MYSQLI_ASSOC );

    // free data, close the statement
    $result -> free();
    $stmt -> close();

    // make a success response
    $response = [
        'status' => "success",
        'messgae' => "Successfully got the data of the receipt summary",
        'receipt' => $receipt
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

// return the response as json to the summary-ad.js
exit ( json_encode($response) );

?>