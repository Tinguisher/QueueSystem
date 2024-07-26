<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// include the functions to be used
require_once './GetCartFunctions.php';

// start the session to check if there is any
session_start();

// if there is session id
if ( isset($_SESSION['id']) ) {
    // get the response from getUserCart at GetCartFunctions.php
    $response = getUserCart();
}

// if there is no session id
else{
    // get the response from getGuestCart at GetCartFunctions.php
    $response = getGuestCart();
}

// exit the fetch by returning the $response
exit ( json_encode($response) );

?>