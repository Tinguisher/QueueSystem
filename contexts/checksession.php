<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// make a session variable
session_start();

// create a logged out status
$response['status'] = "logged out";

// if there is session
if ( isset($_SESSION['id']) ){
    // change the status as logged in
    $response['status'] = "logged in";
}

// return response as json
exit (json_encode($response));

?>