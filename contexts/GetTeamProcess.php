<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// access database
$mysqli = require_once "./database.php";

// try to create and catch if there is error
try{
    // create a sql to get the receipt
    $sql = "SELECT *
    FROM `users`
    WHERE users.authtype IN (SELECT name
        FROM `food_categories`
    );";

    // prepare the statement
    $stmt = $mysqli -> prepare ($sql);

    // execute the statement
    $stmt -> execute();

    // get the result from the statement
    $result = $stmt -> get_result();

    // get only one from the executed statement
    $team = $result -> fetch_all( MYSQLI_ASSOC );

    // free data, close the statement
    $result -> free();
    $stmt -> close();

    // make a success response
    $response = [
        'status' => "success",
        'messgae' => "Successfully got all of the team",
        'team' => $team
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

// return the response as json to the summary-ad.js
exit ( json_encode($response) );

?>