<?php
// check if session is admin
include '../contexts/SessionAdmin.php';
// try to get and catch if there is error
try{
    // get the current number of orders today
    $sql_get_quota = "SELECT COUNT(DISTINCT receipts.id) AS number
    FROM `receipts`
    LEFT JOIN food_orders ON receipts.id = food_orders.receipts_id
    WHERE receipts.id IN (
        SELECT receipts.id
        FROM food_orders, `receipts`
        WHERE receipts.id = food_orders.receipts_id
            AND food_orders.status = 'completed'
            AND DATE(receipts.orderDate) = CURDATE()
        )
        AND receipts.id NOT IN (
            SELECT receipts.id
            FROM food_orders, `receipts`
            WHERE receipts.id = food_orders.receipts_id
                AND food_orders.status <> 'completed'
                AND DATE(receipts.orderDate) = CURDATE()
        );";

    // prepare the statement
    $stmt = $mysqli -> prepare ($sql_get_quota);

    // execute the statement
    $stmt -> execute();

    // get the result from the statement
    $result = $stmt -> get_result();

    // get only one from the executed statement
    $quota = $result -> fetch_assoc();

    // free data and close statement
    $result -> free();
    $stmt -> close();
}

// if there is error in query
catch (Exception $e){
    // make an error response
    echo "Error No: ". $e->getCode() ." - ". $e->getMessage();    // get error code and message
}

// close the database
$mysqli->close();

?>

<html>

<head>

    <style>
        @keyframes anim {
            100% {
                /* 440 divide by half since 50% */
                stroke-dashoffset: 220;
            }
        }
    </style>

    <link rel="stylesheet" href="../stylesheets/home-ad.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto Slab' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Rhodium Libre' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Averia Serif Libre' rel='stylesheet'>
    <script defer src="../js/home-ad.js"></script>

</head>

<body>
    <div class="pageadd">
        <div class="navbar">
            <div class="subnavbar1">SnapServe</div>
            <div class="subnavbar2">
                <ul>
                    <li><a href="./home-ad.php"><span class="hometext">Home</span></a></li>
                    <li><a href="./team-ad.php">Team</a></li>
                    <li><a href="./queueorder-ad.php">Queue Order</a></li>
                    <li><a href="./managemenu-ad.php">Manage Menu</a></li>
                    <li><a href="./history-ad.php">History</a></li>
                </ul>
            </div>
            <div class="subnavbar3">
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
            </div>
        </div>
        <div class="home-line"><a>Home</a></div><br>
        <div class="urgent">
            <div class="urgentleft">
                <div class="urgentlefttop">
                    <div class="ongoingdeliveries">
                        <!--Ongoing deliveriestoP will take the number of "Ongoing deliveries"-->
                        <div class="ongoingdeliveriestop"></div>
                        <div class="ongoingdeliveriesbottom">Ongoing Deliveries</div>
                    </div>
                    <div class="dailyquota">

                        <!-- Circular Progress Bar Start -->
                        <div class="progress-bar-container">
                            <div class="skill">
                                <div class="outer">
                                    <div class="inner">
                                        <div id="number"></div> <!-- Example text inside the circular bar -->
                                    </div>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" viewBox="0 0 160 160">
                                    <defs>
                                        <linearGradient id="GradientColor">
                                            <stop offset="0%" stop-color="#BD4141" />
                                            <stop offset="100%" stop-color="#BD4141" />
                                        </linearGradient>
                                    </defs>
                                    <circle cx="80" cy="80" r="70" stroke-linecap="round" />
                                </svg>
                            </div>
                        </div>
                        <!-- Circular Progress Bar End -->
                        <div class="dailytxt">
                            <div class="dailynum"><?= $quota['number']; ?>/100</div>
                            <div class="dailyword">Daily Quota</div>
                        </div>
                    </div>
                </div>
                <div class="urgentleftbottom">
                    <!-- <div class="currentvip">
                        <div class="vip"><span class="currenttext"> Current</span><span class="viptext"> VIP</span><span class="vipordertext"> Orders:</span></div><br>
                        <div class="viporderlist">
                            <div class="viporderID"><span class="vipinfoheader">Order ID</span><br>ID<br>ID<br>ID<br>ID<br>ID<br>ID</div>
                            <div class="vipstatus"><span class="vipinfoheader">Status</span><br>Ongoing<br>Ongoing<br>Ongoing<br>Pending<br>Pending<br>Pending</div>
                            <div class="vipetd"><span class="vipinfoheader">ETD</span><br>10mins<br>12 mins<br>15 mins<br>TBD<br>TBD<br>TBD</div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="urgentright">
                <div class="dashboard">
                    <div class="subdash">
                        <div class="dashtext">DASHBOARD</div>
                        <div class="dashgreet">
                            <span class="hello">Hello </span>
                            <span class="name"><?= $user['name'] ?></span>
                        </div>
                    </div>
                </div>
                <div class="currentord">
                    <div class="currentnorm">
                        <div class="norm"> Current Orders:</div><br>
                        <div class="normorderlist">
                            <div class="normorderID"><span class="norminfoheader">Order ID</span><br>ID<br>ID<br>ID<br>ID<br>ID<br>ID</div>
                            <div class="normstatus"><span class="norminfoheader">Status</span><br>Ongoing<br>Ongoing<br>Ongoing<br>Pending<br>Pending<br>Pending</div>
                            <div class="normetd"><span class="infoheader">ETD</span><br>10mins<br>12 mins<br>15 mins<br>TBD<br>TBD<br>TBD</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/navbar-ad.js"></script>
</body>

</html>