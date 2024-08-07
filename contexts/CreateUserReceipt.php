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
    $sql_receipts = "INSERT INTO `receipts`(`users_id`) VALUES (?);";

    // create a starting point of database
    $mysqli -> begin_transaction();

    // prepare the statement and execute the insert for receipts
    $stmt = $mysqli -> prepare ($sql_receipts);
    $stmt -> bind_param ('i', $user_id);
    $stmt -> execute();

    // get the last inserted id
    $receipt_id = $mysqli->insert_id;

    // make a string for sql to get user's cart
    $sql_getUserCart = "SELECT foods.id,
        user_carts.quantity,
        user_carts.drinks_id,
        (foods.price * user_carts.quantity) + drinks.price AS price
    FROM `user_carts`,
        `foods`,
        `food_categories`,
        `drinks`
    WHERE user_carts.foods_id = foods.id
        AND foods.food_categories_id = food_categories.id
        AND drinks.id = user_carts.drinks_id
        AND user_carts.users_id = ?
    ORDER BY user_carts.id;";

    // prepare the statement and get the values from database
    $stmt = $mysqli -> prepare ($sql_getUserCart);
    $stmt -> bind_param ('i', $user_id);
    $stmt -> execute();
    $result = $stmt -> get_result();
    $userCart = $result -> fetch_all( MYSQLI_ASSOC );

    // if there is no cart from the user
    if (!$userCart) {
        // rollback the database
        $mysqli -> rollback();

        // free data and close statement and database
        $result -> free();
        $stmt -> close();
        $mysqli -> close();

        // make a response that there should be atleast one order
        $response = [
            'status' => "error",
            'message' => "Order at least one before payment",
        ];

        // output the response
        exit ( json_encode($response) );
    }

    // loop for each cart of the user
    foreach ($userCart as $cart) {
        // create sql for every food in the cart
        $sql_foodOrders = "INSERT INTO `food_orders`(`receipts_id`, `foods_id`, `quantity`, `drinks_id`, `price`, `status`) VALUES (?, ?, ?, ?, ?, 'Pending');";

        // prepare the statement
        $stmt = $mysqli -> prepare ($sql_foodOrders);

        // bind the parameters to the statement
        $stmt -> bind_param ('iiiid', $receipt_id, $cart['id'], $cart['quantity'], $cart['drinks_id'], $cart['price']);

        // execute the statement
        $stmt -> execute();
    }

    // make a string for sql to delete user's cart
    $sql_deleteUserCart = "DELETE FROM `user_carts` WHERE users_id = ?";
    $stmt = $mysqli -> prepare ($sql_deleteUserCart);
    $stmt -> bind_param ('i', $user_id);
    $stmt -> execute();

    // commit all inserts if successful
    $mysqli -> commit();

    // free data and close statement
    $result -> free();
    $stmt -> close();
    
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

// close the database
$mysqli -> close();

// output the response
exit ( json_encode($response) );

?>