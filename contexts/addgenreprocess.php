<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// if the file is accessed manually and not post
if ( $_SERVER['REQUEST_METHOD'] !== "POST" ){
    header('Location: ../pages/NotFound.html');
    exit();
}

// get raw input from the form instead of json
$json = file_get_contents('php://input');
$data = json_decode($json, true);

// check if there is input of dat
if ( empty($data['input_genre']) ){
    $response = [
        'status' => "error",
        'message' => "Genre name is required"
    ];
    exit ( json_encode($response) );
}

$mysqli = require "./database.php";

$qwerty = $data['input_genre'];


$sql ="SELECT * FROM user where id=184";

$result = $mysqli->query($sql);

$user = $result -> fetch_assoc();

exit ( json_encode(['foodimg' => $qwerty]));
?>