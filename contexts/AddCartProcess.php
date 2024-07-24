<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// if the file is accessed manually and not post
if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header('Location: ../pages/NotFound.html');
    exit();
}

// get raw input from the form instead of json
$json = file_get_contents('php://input');
$data = json_decode($json, true);

exit(json_encode($data));

?>