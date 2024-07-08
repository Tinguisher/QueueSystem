<?php
// make a session variable
session_start();

// if there is session already, go to dashboard
if ( !isset($_SESSION['id']) ){
    header('Location: ./Login.html');
    exit();
}

require_once '../contexts/allusers.php';

$mysqli = require_once "../contexts/database.php";
$sql = "SELECT * FROM `user` WHERE id=". $_SESSION['id'];
$result = $mysqli->query($sql);
$user = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Menu</title>
    </head>
    <body>
        <h1>Hello <?php echo $user['name']?></h1>
        <h4>Add menu</h4>
        <form id="addMenu" enctype="multipart/form-data">
        <!-- <form method="POST" action="../contexts/addmenuprocess.php" enctype="multipart/form-data"> -->
            <input type="file" accept="image/*" name="image_input"/>
            <br> <br>
            <input type="text" name="name_input" placeholder="Name" />
            <br> <br>
            <input type="text" name="price_input" placeholder="Price" />
            <br> <br>
            <input type="text" name="description_input" placeholder="Description" />
            <br> <br>
            <input type="submit" />
        </form>
    </body>
    <script src="../js/Addmenu.js"></script>
</html>