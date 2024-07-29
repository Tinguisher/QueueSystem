<?php
// if the user is logged in, update user's cart quantity
function updateUserCart($data) {
    // access database
    $mysqli = require_once "./database.php";

    // get the current logged in user
    $user_id = $_SESSION['id'];

    // get the data requests
    $cart_id = $data['input_cart_id'];
    $quantity = $data['input_quantity'];

    // try to create and catch if there is error
    try{
        // if requested is 0 or lower, delete
        if ($quantity <= 0){
            // make a string for sql to delete the cart
            $sql = "DELETE FROM `user_carts`
                WHERE id = ? AND `users_id` = ?;"; 

            // prepare the statement
            $stmt = $mysqli -> prepare ($sql);

            // bind the parameters to the statement
            $stmt -> bind_param ('ii', $cart_id, $user_id);
        }

        // if requested is not 0, update
        else{
            // make a string for sql to update the cart quantity
            $sql = "UPDATE `user_carts`
                SET `quantity`= ?
                WHERE id = ? AND `users_id`= ?;";
            
            // prepare the statement
            $stmt = $mysqli -> prepare ($sql);

            // bind the parameters to the statement
            $stmt -> bind_param ('iii', $quantity, $cart_id, $user_id);
        }

        // execute the statement
        $stmt->execute();

        // make a success response
        $response = [
            'status' => "success",
            'message' => "Quantity updated successfully"
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

    // return the response back to the UpdateCartProcess.php
    return $response;
}

// if it is guest or the user is not logged in, update session's cart quantity
function updateGuestCart($data) {
    // get the data requests
    $cart_id = $data['input_cart_id'];
    $quantity = $data['input_quantity'];

    // if requested is 0 or lower, delete
    if ($quantity <= 0){
        // use array splice to delete (array, value offset to delete, quantity to delete)
        array_splice($_SESSION['carts'], $cart_id, 1);
    }

    // if requested is higher than 0, update quantity
    else{
        $_SESSION['carts'][$cart_id]['quantity'] = $quantity;
    }

    $response = [
        'status' => "success",
        'message' => "Update Quantity Successful"
    ];

    // return the response back to the UpdateCartProcess.php
    return $response;
}

?>