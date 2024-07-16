<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// access database
$mysqli = require_once "./database.php";

// make a string for sql to be used
$sql = "SELECT foods.id, foods.image,
        food_categories.name AS categoryName,
        foods.name AS foodName,
        foods.description,
        foods.price
    FROM `foods`, `food_categories`
    WHERE foods.food_categories_id = food_categories.id
    LIMIT 8";

// prepare the statement
$stmt = $mysqli -> prepare ($sql);

// execute the statement
$stmt -> execute();

// get the result from the statement
$result = $stmt -> get_result();

// get only one from the executed statement
$popularmenu = $result -> fetch_all( MYSQLI_ASSOC );

// free data and close statement and database
$result -> free();
$stmt -> close();
$mysqli -> close();

// pass the menu to response
$response = [
    'status' => "success",
    'message' => "Passed the Popular Menu",
    'menu' => $popularmenu
];

// output the response
exit ( json_encode($response) );

?>