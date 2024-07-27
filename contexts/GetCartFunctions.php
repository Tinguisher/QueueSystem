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
            (foods.price * user_carts.quantity) AS price,
            user_carts.quantity
        FROM `user_carts`, `foods`, `food_categories`
        WHERE user_carts.foods_id = foods.id AND foods.food_categories_id = food_categories.id AND user_carts.users_id = ?
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

        // pass the user's cart to response
        $response = [
            'status' => "success",
            'message' => "Passed All of the User's Cart",
            'carts' => $userCart
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

    // free data and close statement and database
    $result -> free();
    $stmt -> close();
    $mysqli -> close();

    // return the variable response back to the GetCartProcess.php
    return $response;
}

// if it is guest or the user is not logged in, get session's cart
function getGuestCart() {
    // access database
    $mysqli = require_once "./database.php";

    // foreach ($_SESSION['carts'] as $guestCart) {
    //     // make a string sql to get information of cart
    //     $sql = "SELECT 
    //         foods.image,
    //         food_categories.name AS categoryName,
    //         foods.name AS foodName,
    //         foods.description,
    //         (foods.price * ". $guestCart['quantity'] .") AS price,
    //     FROM `foods`, `food_categories`
    //     WHERE foods.food_categories_id = food_categories.id AND foods.id =". $guestCart['id'] .";";

    // }
    

    // try to create and catch if there is error
    try{
        // prepare the statement
        $stmt = $mysqli -> prepare ($sql);

        // bind the parameters to the statement
        $stmt -> bind_param ('i', $_SESSION['quantity']);
    }

    // if there is error in query
    catch (Exception $e){
        // make an error response
        $response = [
            'status' => "error",
            'message' => "Error No: ". $e->getCode() ." - ". $e->getMessage()    // get error code and message
        ];
    }


    // make a success response
    $response = [
        'status' => "success",
        'message' => "Passed All of the Guest's Cart",
        'carts' => $_SESSION['carts']
    ];

    $_SESSION['carts'][0]['id'] = "2";
    // $_SESSION['carts'][0]['image'] = "pep.png";
    // $_SESSION['carts'][0]['categoryName'] = "Pizza";
    // $_SESSION['carts'][0]['foodName'] = "Pepperoni Pizza";
    // $_SESSION['carts'][0]['description'] = "This is pepperoni Pizza hehe";
    // $_SESSION['carts'][0]['price'] = "200";
    $_SESSION['carts'][0]['quantity'] = "4";
    
    
    $_SESSION['carts'][1]['id'] = "3";
    // $_SESSION['carts'][1]['image'] = "bacon.png";
    // $_SESSION['carts'][1]['categoryName'] = "Burger";
    // $_SESSION['carts'][1]['foodName'] = "Big Burger";
    // $_SESSION['carts'][1]['description'] = "This is a BEEG Burger";
    // $_SESSION['carts'][1]['price'] = "201.12";
    $_SESSION['carts'][1]['quantity'] = "5";

    
    

    // return the variable response back to the GetCartProcess.php
    return $response;
}

?>