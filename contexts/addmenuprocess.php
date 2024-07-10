<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// if the file is accessed manually and not post
if ($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: ../pages/NotFound.html");
    exit();
}

// check if there is input of data
if ( empty($_FILES['image_input']['name']) || empty($_POST['price_input'])  || empty($_POST['description_input']) ){
    $response = [
        'status' => "error",
        'message' => "All fields are required"
    ];
    exit( json_encode($response) );
}

// create an array for accepting image only
$filetype = ["image/jpg", "image/png", "image/jpeg"];

// check if image uploaded is acceptable filetype
if (!in_array($_FILES['image_input']['type'], $filetype)){
    $response = [
        'status' => "error",
        'message' => "Input jpg, png or jpeg extensions only"
    ];
    exit ( json_encode($response) );
}

// get information of file
$pathinfo = pathinfo($_FILES["image_input"]["name"]);

// get the filename inside the information of file
$base = $pathinfo["filename"];

// // replace special characters by _
// $base = preg_replace("/[^\w-]/", "_", $base);

// $i = 1;



// while (file_exists($destination)){
//     $filename = $base . "($i)." . $pathinfo["extension"];
//     $destination = $directory . "/" . $filename;
//     $i++;
// }

$response = [
    'status' => $_FILES,
    'description' => $_POST['description_input'],
    'test' => $base,
    'test2' => $_FILES['image_input']['type']
];

exit ( json_encode($response) );

?>