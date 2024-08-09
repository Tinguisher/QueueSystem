<?php
// if the user is logged in, get user's cart
function getUserCart() {
    // access database
    $mysqli = require_once "./database.php";

    // get the current logged in user
    $user_id = $_SESSION['id'];

    // make a string sql to get information of cart
    $sql = "SELECT 
            user_carts.id,
            foods.image,
            food_categories.name AS categoryName,
            foods.name AS foodName,
            foods.description,
            (((foods.price - (foods.price * (0.01 * foods.discount))) * user_carts.quantity) + drinks.price) AS discountedPrice,
            user_carts.quantity
        FROM `user_carts`,
            `foods`,
            `food_categories`,
            `drinks`
        WHERE user_carts.foods_id = foods.id
            AND foods.food_categories_id = food_categories.id
            AND user_carts.drinks_id = drinks.id
            AND user_carts.users_id = ?
        ORDER BY user_carts.id;";

    // try to create and catch if there is error
    try {
        // prepare the statement
        $stmt = $mysqli -> prepare ($sql);

        // bind the parameters to the statement
        $stmt -> bind_param ('i', $user_id);

        // execute the statement
        $stmt -> execute();

        // get the result from the statement
        $result = $stmt -> get_result();

        // get all data from the executed statement
        $userCart = $result -> fetch_all( MYSQLI_ASSOC );

        // free data and close statement
        $result -> free();
        $stmt -> close();

        // pass the user's cart to response
        $response = [
            'status' => "success",
            'carts' => $userCart
        ];

        // if there is cart from the user, message will be passed all and if not, give no order message
        $response['message'] = $userCart ? "Passed All of the User's Cart" : "There are still no order carts from the user";
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

    // return the variable response back to the GetCartProcess.php
    return $response;
}

// if it is guest or the user is not logged in, get session's cart
function getGuestCart() {
    // if there are no carts from the guest
    if ( empty($_SESSION['carts']) ){
        // unset the session carts
        unset($_SESSION['carts']);

        // make a success response with no carts
        $response = [
            'status' => "success",
            'message' => "There are still no order carts from the guest",
            'carts' => [],
        ];

        // return the variable response back to the GetCartProcess.php
        return $response;
    }

    // access database
    $mysqli = require_once "./database.php";

    // loop to get each data from the carts
    foreach ($_SESSION['carts'] as $index => $sessionCart) {
        // try to create and catch if there is error
        try{
            // make a string sql to get information of cart
            $sql = "SELECT 
                foods.image,
                food_categories.name AS categoryName,
                foods.name AS foodName,
                foods.description,
                (((foods.price - (foods.price * (0.01 * foods.discount))) * ?) + drinks.price) AS discountedPrice
            FROM `foods`,
                `food_categories`,
                `drinks`
            WHERE foods.food_categories_id = food_categories.id
                AND foods.id = ?
                AND drinks.id = ?;";

            // prepare the statement
            $stmt = $mysqli -> prepare ($sql);

            // bind the parameters to the statement
            $stmt -> bind_param ('iii', $sessionCart['quantity'], $sessionCart['food_id'], $sessionCart['drink_id']);

            // execute the statement
            $stmt -> execute();

            // get the result from the statement
            $result = $stmt -> get_result();

            // get only one from the executed statement
            $guestCart['carts'][$index] = $result -> fetch_assoc();

            // free data and close statement
            $result -> free();
            $stmt -> close();

            // get all the remaining values from the session needed in the front end
            $guestCart['carts'][$index]['id'] = $index;
            $guestCart['carts'][$index]['quantity'] = $sessionCart['quantity'];
        }

        // if there is error in query
        catch (Exception $e){
            // close database
            $mysqli -> close();

            // make an error response
            $response = [
                'status' => "error",
                'message' => "Error No: ". $e->getCode() ." - ". $e->getMessage()    // get error code and message
            ];

            // return the error response back to the GetCartProcess.php
            return $response;
        }
        
    }

    // close database
    $mysqli -> close();

    // make a success response
    $response = [
        'status' => "success",
        'message' => "Passed All of the Guest's Cart"
    ];

    // include the guest's cart into the response
    $response = array_merge($response, $guestCart);

    // return the variable response back to the GetCartProcess.php
    return $response;
}

?>