<?php
// if the user is logged in, add user's cart
function addUserCart($data) {
    // access database
    $mysqli = require_once './database.php';
    
    // get post values
    $user_id = $_SESSION['id'];
    $food_id = $data['input_food_id'];
    $quantity = $data['input_quantity'];
    $drink_id = $data['input_drink_id'];

    // make a string sql to insert data to database
    $sql = "INSERT INTO `user_carts`(`users_id`, `foods_id`, `quantity`, `drinks_id`) VALUES (?, ?, ?, ?);";

    // try to create and catch if there is error
    try{
        // prepare the statement
        $stmt = $mysqli -> prepare ($sql);

        // bind the parameters to the statement
        $stmt -> bind_param ('iiii', $user_id, $food_id, $quantity, $drink_id);

        // execute the statement
        $stmt -> execute();

        // close the statement
        $stmt -> close();

        // make a response of success
        $response = [
            'status' => "success",
            'message' => "Added to User's Cart"
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

    // return the response back to the AddCartProcess.php
    return $response;
}

// if it is guest or the user is not logged in, add session's cart
function addGuestCart($data) {
    // create the cart
    $_SESSION['carts'][] = [
        'food_id' => $data['input_food_id'],
        'quantity' => $data['input_quantity']
    ];
    
    // make a success response
    $response = [
        'status' => "success",
        'message' => "Created Guest's Cart"
    ];

    // return the response back to the AddCartProcess.php
    return $response;
}

?>