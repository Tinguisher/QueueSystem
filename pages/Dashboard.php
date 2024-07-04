<?php
// make a session variable
session_start();

// if there is session already, go to dashboard
if ( !isset($_SESSION['id']) ){
    header('Location: ./Login.html');
    exit();
}

$mysqli = require "../contexts/database.php";
$sql = "SELECT * FROM `user` WHERE id=". $_SESSION['id'];
$result = $mysqli->query($sql);
$user = $result->fetch_assoc();
echo $user['name'];


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
    </head>
    <body>
        <h1>This is Dashboard</h1>
        <input type="button" id="logoutbutton" value="Logout"/>
    </body>
    <script src="../js/Dashboard.js"></script>
</html>