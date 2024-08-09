<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// access database
$mysqli = require_once "./database.php";

// try to get and catch if there is error
try{
    $sql_getCount = "SELECT COUNT(DISTINCT(receipts.id)) AS ongoingCount
        FROM `receipts`
        LEFT JOIN food_orders ON receipts.id = food_orders.receipts_id
        WHERE food_orders.status IN ('Pending', 'In Progress');";

    // prepare the statement
    $stmt = $mysqli -> prepare ($sql_getCount);

    // execute the statement
    $stmt -> execute();

    // get the result from the statement
    $result = $stmt -> get_result();

    // get only one from the executed statement
    $order = $result -> fetch_assoc();

    // get the current orders
    $sql_get_current_orders = "SELECT receipts.id,
        MIN(food_orders.status) AS status,
        SUM(food_orders.quantity)  AS totalItems
    FROM `receipts`
    LEFT JOIN food_orders ON receipts.id = food_orders.receipts_id
    WHERE food_orders.status IN ('Pending', 'In Progress')
    GROUP BY receipts.id
    ORDER BY receipts.id ASC
    LIMIT 5;";

    // prepare the statement
    $stmt = $mysqli -> prepare ($sql_get_current_orders);

    // execute the statement
    $stmt -> execute();

    // get the result from the statement
    $result = $stmt -> get_result();

    // get all values from the executed statement
    $currentOrders = $result -> fetch_all( MYSQLI_ASSOC );

    // free data and close statement
    $result -> free();
    $stmt -> close();

    // make a success response of getting the values from database
    $response = [
        'status' => "success",
        'message' => "Passed the Count and Current Ongoing Orders",
        'ongoingCount' => $order['ongoingCount'],
        'currentOrders' => $currentOrders
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



// return the response as json to home-ad.php
exit ( json_encode($response) );

?>