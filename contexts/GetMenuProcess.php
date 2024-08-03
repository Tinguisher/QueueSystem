<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// access database
$mysqli = require_once "./database.php";

// try to create and catch if there is error
try{
    // make a string to get menu
    $sql_menu = "SELECT foods.id,
    foods.image,
    food_categories.name AS categoryName,
    foods.name AS foodName,
    foods.description,
    foods.price
    FROM `foods`, `food_categories`
    WHERE foods.food_categories_id = food_categories.id
    ORDER BY foodName";

    // prepare the statement
    $stmt = $mysqli -> prepare ($sql_menu);

    // execute the statement
    $stmt -> execute();

    // get the result from the statement
    $result = $stmt -> get_result();

    // get all values from the executed statement
    $menu = $result -> fetch_all( MYSQLI_ASSOC );

    // make a string to get drinks
    $sql_drinks = "SELECT * FROM `drinks`";

    // prepare the statement
    $stmt = $mysqli -> prepare ($sql_drinks);

    // execute the statement
    $stmt -> execute();

    // get the result from the statement
    $result = $stmt -> get_result();

    // get all values from the executed statement
    $drink = $result -> fetch_all( MYSQLI_ASSOC );

    // free data and close statement
    $result -> free();
    $stmt -> close();

    // pass the menu to response
    $response = [
        'status' => "success",
        'message' => "Passed All of the Menu with Drink",
        'menu' => $menu,
        'drink' => $drink
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

// output the response
exit ( json_encode($response) );

?>