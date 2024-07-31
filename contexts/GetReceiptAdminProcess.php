<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// access database
$mysqli = require_once "./database.php";

// create a sql to get each receipts
$sql = "SELECT receipts.id,
        CONCAT(users.firstname,' ', users.lastname) AS userName,
        COUNT(food_orders.receipts_id) AS items,
        DATE(receipts.orderDate) AS date
    FROM receipts,
        food_orders,
        users
    WHERE receipts.id = food_orders.receipts_id
        AND receipts.users_id = users.id
        AND food_orders.status = 'Completed'
    GROUP BY receipts.id
    ORDER BY date DESC;";

// try to get and catch if there is error
try{
    // prepare the statement
    $stmt = $mysqli -> prepare ($sql);

    // execute the statement
    $stmt -> execute();

    // get the result from the statement
    $result = $stmt -> get_result();

    // get all the values from the receipts
    $receipts = $result -> fetch_all( MYSQLI_ASSOC );

    // free data and close statement
    $result -> free();
    $stmt -> close();

    // create a success response with all of the data of receipts
    $response = [
        'status' => "success",
        'message' => "Passed the message",
        'receipts' => $receipts
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

// return the response as json
exit ( json_encode($response) );

?>