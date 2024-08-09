<?php
// make a session variable
session_start();

// if the session id is not set and auth type is not admin, go to not found
if (!isset($_SESSION['id']) || $_SESSION['authtype'] != "admin") {
    header('Location: ./NotFound.html');
    exit();
}

// access database
$mysqli = require_once "../contexts/database.php";

// try to get user information in database and catch if there is error
try {
    // make a string to get user
    $sql = "SELECT *
        FROM `users`
        WHERE id = ?
            AND authtype = ?";

    // prepare the statement
    $stmt = $mysqli->prepare($sql);

    // bind the parameters to the statement
    $stmt->bind_param('is', $_SESSION['id'], $_SESSION['authtype']);

    // execute the statement
    $stmt->execute();

    // get the result from the statement
    $result = $stmt->get_result();

    // get only one from the executed statement
    $user = $result->fetch_assoc();

    // free data and close statement
    $result->free();
    $stmt->close();
}

// if there is error in query
catch (Exception $e) {
    // close the database
    $mysqli->close();

    // go to not found
    header('Location: ./NotFound.html');
    exit();
}

// if there is no user found, go to not found
if (!$user) {
    // close the database
    $mysqli->close();

    // destroy each data in session
    session_unset();

    // destroy the sessions made
    session_destroy();

    // go to not found
    header('Location: ./NotFound.html');
    exit();
}

// close the database
$mysqli->close();
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../stylesheets/profile-ad.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto Slab' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Rhodium Libre' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Averia Serif Libre' rel='stylesheet'>

</head>

<body>
    <div class="pagead">
        <div class="navbar">
            <div class="subnavbar1">SnapServe</div>
            <div class="subnavbar2">
                <ul>
                    <li><a href="./home-ad.php">Home</a></li>
                    <li><a href="./team-ad.php">Team</a></li>
                    <li><a href="./queueorder-ad.php">Queue Order</a></li>
                    <li><a href="./managemenu-ad.php">Manage Menu</a></li>
                    <li><a href="./history-ad.php">History</a></li>
                </ul>
            </div>
            <!--Profile and notif-->
            <div class="subnavbar3">
                <button class="dropbtn" onclick="myFunction()">
                    <div class="profile">
                        <div class="profileleft">
                            <img src="../images/weui_arrow-filled.svg">
                        </div>
                        <div class="profileright">
                            <img src="../images/iconamoon_profile.svg">
                        </div>
                    </div>
                    <div id="myDropdown" class="dropdown-content">
                        <a href="./profile-ad.php">Profile</a>
                        <a id="sessionbutton">Logout</a>
                    </div>
                </button>
            </div>
            <!--Profile and notif end-->
        </div>
        <div class="profile-line"><a>Profile</a></div>
        <div class="personalinfo">
            <form id="updateUserForm">
                <div class="topinputs">
                    <label class="protext" for="fname">First Name</label><br>
                    <input class="probox" type="text" id="fname" name="input_firstname" value="<?= $user['firstname'] ?>" required>
                </div>

                <br>

                <div class="input">
                    <label class="protext" for="lname">Last Name</label><br>
                    <input class="probox" type="text" id="lname" name="input_lastname" value="<?= $user['lastname'] ?>" required>
                </div>

                <br>

                <div class="botinputs">
                    <label class="protext" for="email">Email</label><br>
                    <input class="probox" type="email" id="email" name="input_email" value="<?= $user['email'] ?>" required>
                </div>

                <div class="subbox">
                    <input class="submission" type="submit">
                </div>
            </form>
        </div>
    </div>
    <script src="../js/navbar-ad.js"></script>
    <script src="../js/profile-ad.js"></script>
</body>

</html>