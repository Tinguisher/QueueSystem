<?php

// create session
session_start();

// destroy the sessions made
session_destroy();

// create response
$response = [
    'status' => "success",
    'message' => "Session destroyed"
];

// return response as json
exit ( json_encode($response) );

?>