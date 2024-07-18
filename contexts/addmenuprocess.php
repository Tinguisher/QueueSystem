<?php
// all contents to read as json
header('Content-Type: application/json; charset=utf-8');

// if the file is accessed manually and not post
if ($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: ../pages/NotFound.html");
    exit();
}

// check if there is input of data
if ( empty($_FILES['input_image']['name']) || empty($_POST['input_name'])  || empty($_POST['input_price'])  || empty($_POST['input_description']) || empty($_POST['input_category']) ){
    $response = [
        'status' => "error",
        'message' => "All fields are required"
    ];
    exit( json_encode($response) );
}

// create an array for accepting image only
$filetype = ["image/jpg", "image/png", "image/jpeg"];

// check if image uploaded is acceptable filetype
if (!in_array($_FILES['input_image']['type'], $filetype)){
    $response = [
        'status' => "error",
        'message' => "Input jpg, png or jpeg extensions only"
    ];
    exit ( json_encode($response) );
}

// get information of file
$pathinfo = pathinfo($_FILES['input_image']['name']);

// get the filename inside the information of file
$base = $pathinfo['filename'];

// replace special characters by _
$base = preg_replace("/[^\w-]/", "_", $base);

// get the name with extension
$filename = $base . "." . $pathinfo['extension'];

// get the directory folder to be saved
$destination = "../images/foods/". $_POST['input_category'] ."/". $filename;

// rename if has same image name
$i = 1;
while (file_exists($destination)){
    $filename = $base . "($i)." . $pathinfo['extension'];
    $destination = "../images/foods/". $_POST['input_category'] ."/". $filename;
    $i++;
}

// access database
$mysqli = require_once "./database.php";

// get the values from post
$name = $_POST['input_name'];
$price = $_POST['input_price'];
$description = $_POST['input_description'];
$category = $_POST['input_category'];

// make a string for sql to be used
$food_categories_id = "SELECT id FROM `food_categories` WHERE name = ?";
$sql = "INSERT INTO `foods`(`name`, `description`, `price`, `image`, `food_categories_id`) VALUES (?, ?, ?, ?, (". $food_categories_id ."));";

// prepare the statement
$stmt = $mysqli -> prepare ($sql);

// bind the parameters to the statement
$stmt -> bind_param ('ssdss', $name, $description, $price, $filename, $category);

try{
    // insert the image to their destination
    move_uploaded_file($_FILES['input_image']['tmp_name'], $destination);

    // execute the statement
    $stmt -> execute();

    // make a success response
    $response = [
        'status' => "success",
        'message' => "food menu created"
    ];

}

// if there is error in query
catch (Exception $e){
    // make an error response
    $response = [
        'status' => "error",
        'message' => "Error No: ". $e->getCode() ." - ". $e->getMessage()    // get error code and message
    ];
}

// close statement and database
$stmt -> close();
$mysqli -> close();

// output the response
exit ( json_encode($response) );

?>