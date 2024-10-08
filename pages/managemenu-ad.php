<?php
// check if session is admin
include '../contexts/SessionAdmin.php';

// close the database
$mysqli->close();

?>
<html>

<head>

    <title>SnapServe | Admin Manage</title>
    <link rel="icon" type="image/png" href="../images/bacon.png">

    <link rel="stylesheet" href="../stylesheets/managemenu-ad.css">
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
                    <li><a href="./team-ad.php">Team</a></li>
                    <li><a href="./queueorder-ad.php">Queue Order</span></a></li>
                    <li><a href="./managemenu-ad.php"><span class="managemenutext">Manage Menu</span></a></li>
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
        <div class="managemenu-line"><a>Manage Menu</a></div>
        <div class="manageoptions">
            <div class="editmenu">
                <div class="editup">
                    <div class="pencil">
                        <img src="../images/pencil.svg">
                    </div>
                </div>
                <div class="mid">
                    <div class="cook-booK">
                        <img src="../images/cookbook.svg">
                    </div>
                </div>
                <div class="editbottom">
                    <div class="editbutton"><a href="./managemenuedit-ad.php"><button>Edit Menu</button></a></div>
                </div>
            </div>
            <div class="addmenu">
                <div class="addup">
                    <div class="plus">
                        <img src="../images/plus.svg">
                    </div>
                </div>
                <div class="mid">
                    <div class="cook-booK">
                        <img src="../images/cookbook.svg">
                    </div>
                </div>
                <div class="addbottom">
                    <div class="addbutton"><a href="./managemenuadd-ad.php"><button>Add Menu</button></a></div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/navbar-ad.js"></script>
</body>

</html>