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

$sql = "SELECT * FROM `food_categories`";
$result = $mysqli->query($sql);
$food_categories = $result->fetch_all( MYSQLI_ASSOC );


?>

<!DOCTYPE html>
<html>
    <head>
        <title>Add Menu</title>
    </head>
    <body>
        <h1>Hello <?php echo $user['firstname']?></h1>
        <h2>Add Genre / Folder</h2>
        <form id="addGenre">
            <input type="text" name="input_genre" placeholder="Genre" />
            <br> <br>
            <input type="submit" />
        </form>

        <br> <br>
        
        <h2>Add menu</h2>
        <form id="addMenu" enctype="multipart/form-data">
            <input type="file" accept="image/*" name="image_input" required />
            <br> <br>
            <input type="text" name="name_input" placeholder="Name" />
            <br> <br>
            <input type="text" name="price_input" placeholder="Price" />
            <br> <br>
            <input type="text" name="description_input" placeholder="Description" />
            <br> <br>
            <select name="genre">
                <?php
                foreach($food_categories as $food_category){
                    echo '<option>'. $food_category['name'] .'</option>';
                }
                ?>
            </select>
            <input type="submit" />
        </form>
    </body>
    <script src="../js/Addmenu.js"></script>
</html>