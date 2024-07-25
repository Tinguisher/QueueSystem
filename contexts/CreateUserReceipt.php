<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// access database
$mysqli = require_once "./database.php";

// start the session to check if there is any
session_start();

// get the current logged in user
$user_id = $_SESSION['id'];

// try to create and catch if there is error
try{

    // make a string for sql to create a receipt
    $sql_receipts = "INSERT INTO `receipts`(`users_id`, `status`) VALUES (?, 'Pending');";

    // create a starting point of database
    $mysqli -> begin_transaction();

    // prepare the statement and execute the insert for receipts
    $stmt = $mysqli -> prepare ($sql_receipts);
    $stmt -> bind_param ('i', $user_id);
    $stmt -> execute();

    // get the last inserted id
    $receipt_id = $mysqli->insert_id;

    // make a string for sql to get user's cart
    $sql_getUserCart = "SELECT user_carts.id,
        foods.id,
        user_carts.quantity,
        (foods.price * user_carts.quantity) AS price
    FROM `user_carts`, `foods`, `food_categories`
    WHERE user_carts.foods_id = foods.id AND foods.food_categories_id = food_categories.id AND user_carts.users_id = ?
    ORDER BY user_carts.id;";

    // prepare the statement and get the values from database
    $stmt = $mysqli -> prepare ($sql_getUserCart);
    $stmt -> bind_param ('i', $user_id);
    $stmt -> execute();
    $result = $stmt -> get_result();
    $userCart = $result -> fetch_all( MYSQLI_ASSOC );

    foreach ($userCart as $cart) {
        // create sql for every food in the cart
        $sql_foodOrders = "INSERT INTO `food_orders`(`receipts_id`, `foods_id`, `quantity`, `price`, `status`) VALUES (?, ?, ?, ?, 'Pending');";

        // prepare the statement
        $stmt = $mysqli -> prepare ($sql_foodOrders);

        // bind the parameters to the statement
        $stmt -> bind_param ('iiid', $receipt_id, $cart['id'], $cart['quantity'], $cart['price']);

        // execute the statement
        $stmt -> execute();
    }

    // commit all inserts if successful
    $mysqli -> commit();
    
    // pass the response if it is success
    $response = [
        'status' => "success",
        'message' => "Created a new receipt for user order",
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

// free data and close statement and database
$result -> free();
$stmt -> close();
$mysqli -> close();

exit ( json_encode($response) );

?>