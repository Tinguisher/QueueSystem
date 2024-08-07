<?php
// check if session is admin
include '../contexts/AdminSession.php';

// close the database
$mysqli->close();

?>

<html>

<head>
    <link rel="stylesheet" href="../stylesheets/team-ad.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto Slab' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Rhodium Libre' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Averia Serif Libre' rel='stylesheet'>

</head>

<body>
    <div class="pageadd">
        <div class="navbar">
            <div class="subnavbar1">SnapServe</div>
            <div class="subnavbar2">
                <ul>
                    <li><a href="./home-ad.php">Home</a></li>
                    <li><a href="./team-ad.php"><span class="teamtext">Team</span></a></li>
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
                        <a href="#logout">Logout</a>
                    </div>
                </button>
            </div>
            <!--Profile and notif end-->
        </div>
        <div class="team-line"><a>Team</a></div>
        <div class="innerbox">
            <div class="tablebox">
                <div class="redbox"></div>
                
                <table class="teamtable">
                    <thead>
                        <tr>
                            <th>Worker ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Date Joined</th>
                            <th>Station</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>John</td>
                            <td>Smith</td>
                            <td>01/01/2024</td>
                            <td>Burger</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>John</td>
                            <td>Smith</td>
                            <td>01/01/2024</td>
                            <td>Burger</td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>John</td>
                            <td>Smith</td>
                            <td>01/01/2024</td>
                            <td>Burger</td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="filterbox">
                <div class="redbox"></div>
            </div>
        </div>
    </div>
    <script src="../js/navbar-ad.js"></script>
</body>

</html>