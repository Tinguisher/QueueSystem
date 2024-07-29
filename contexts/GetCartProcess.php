<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// include the functions to be used
require_once './GetCartFunctions.php';

// start the session to check if there is any
session_start();

// if there is session id, get user's cart and if not, get guest's cart
$response = ( isset($_SESSION['id']) ) ? getUserCart() : getGuestCart();

// exit the fetch by returning the $response
exit ( json_encode($response) );

?>