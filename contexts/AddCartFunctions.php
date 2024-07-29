<?php
// if the user is logged in, add user's cart
function addUserCart($data) {
    // access database
    $mysqli = require_once './database.php';
    
    // get post values
    $user_id = $_SESSION['id'];
    $food_id = $data['input_food_id'];
    $quantity = $data['input_quantity'];

    // make a string sql to insert data to database
    $sql = "INSERT INTO `user_carts`(`users_id`, `foods_id`, `quantity`) VALUES (? , ?, ?);";

    // try to create and catch if there is error
    try{
        // prepare the statement
        $stmt = $mysqli -> prepare ($sql);

        // bind the parameters to the statement
        $stmt -> bind_param ('iii', $user_id, $food_id, $quantity);

        // execute the statement
        $stmt -> execute();

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

    // close statement and database
    $stmt -> close();
    $mysqli -> close();

    // return the response back to the AddCartProcess.php
    return $response;
}

// if it is guest or the user is not logged in, add session's cart
function addGuestCart($data) {
    // if there are still no cart
    if ( !isset($_SESSION['carts']) ){
        // manually create the cart
        $_SESSION['carts'][0] = [
            'id' => 0,
            'food_id' => $data['input_food_id'],
            'quantity' => $data['input_quantity']
        ];
    }
    
    // if there is a cart already
    else {
        // create the additional cart to the last array
        $_SESSION['carts'][] = [
            'id' => count($_SESSION['carts']),
            'food_id' => $data['input_food_id'],
            'quantity' => $data['input_quantity']
        ];
    }

    // make a success response
    $response = [
        'status' => "success",
        'message' => "Created Guest's Cart"
    ];

    // return the response back to the AddCartProcess.php
    return $response;
}

?>