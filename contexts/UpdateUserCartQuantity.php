<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// access database
$mysqli = require_once "./database.php";

// start the session to check if there is any
session_start();

// get the current logged in user
$user_id = $_SESSION['id'];

$response = [
    'status' => "success",
    'message' => "Successfully updated the amount"
];

exit ( json_encode ($response) );

?>