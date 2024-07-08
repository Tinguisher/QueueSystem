<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// if the file is accessed manually and not post
if ($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: ../pages/NotFound.html");
    exit();
}

// check if there is input of data


// TODO IMAGE CHECK IF IT IS IMAGE
if ( empty($_FILES['image_input']) || empty($_POST['price_input'])  || empty($_POST['description_input']) ){
    $response = [
        'status' => "error",
        'message' => "All fields are required"
    ];
    exit( json_encode($response) );
}

$filename = $_FILES['image_input']['name'];




$response = [
    'status' => $_FILES,
    'description' => $_POST['description_input']
];

exit ( json_encode($response) );

?>