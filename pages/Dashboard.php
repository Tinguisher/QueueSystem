<?php
// make a session variable
session_start();

// if there is session already, go to dashboard
if ( !isset($_SESSION['id']) ){
    header('Location: ./Login.php');
    exit();
}

$mysqli = require_once "../contexts/database.php";
$sql = "SELECT * FROM `users` WHERE id=". $_SESSION['id'];
$result = $mysqli->query($sql);
$user = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard</title>
    </head>
    <body>
        <h1>This is Dashboard <?php echo $user['firstname'] ." ". $user['lastname'] ?></h1>
        <input type="button" id="logoutbutton" value="Logout"/>
        <input type="button" id="addmenu" value="Add Menu" />
        <input type="button" id="getuser" value="Get all the user" />
        <div id="users">
            <h1> This is users to be input after the button click </h1>
        </div>
    </body>
    <script src="../js/Dashboard.js"></script>
</html>