<?php
// make a session variable
session_start();

// if the session id is not set and auth type is not admin, go to not found
if ( !isset($_SESSION['id']) && $_SESSION['authtype'] != "admin" ) {
    header('Location: ./NotFound.html');
    exit();
}

// access database
$mysqli = require_once "../contexts/database.php";

// try to get user information in database and catch if there is error
try{
    // make a string for sql to be used
    $sql = "SELECT * FROM `users` WHERE id = ? AND authtype = ?";

    // prepare the statement
    $stmt = $mysqli->prepare($sql);

    // bind the parameters to the statement
    $stmt->bind_param('is', $_SESSION['id'], $_SESSION['authtype']);

    // execute the statement
    $stmt->execute();

    // get the result from the statement
    $result = $stmt->get_result();

    // get only one from the executed statement
    $user = $result->fetch_assoc();

    // free data and close statement and database
    $result->free();
    $stmt->close();
    $mysqli->close();

}

// if there is error in query
catch (Exception $e){
    // close the database
    $mysqli->close();

    // go to not found
    header('Location: ./NotFound.html');
    exit();
}

// if there is no user found, go to not found
if (!$user) {
    // go to not found
    header('Location: ./NotFound.html');
    exit();
}

// get the full name
$name = $user['firstname'] . " " . $user['lastname'];

?>