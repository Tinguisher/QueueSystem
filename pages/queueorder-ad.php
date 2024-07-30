<?php



?>


<html>

<head>
    <link rel="stylesheet" href="../stylesheets/queueorder-ad.css">
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
                    <li><a href="./queueorder-ad.php"><span class="queueordertext">Queue Order</span></a></li>
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
                        <a href="../pages/profile-ad.html">Profile</a>
                        <a href="#logout">Logout</a>
                    </div>
                </button>
            </div>
            <!--Profile and notif end-->
        </div>
        <div class="queueorder-line"><a>Queue Order</a></div>
        <div class="innerbox">
            <div class="choosestation">
                <div class="redchoose">Choose Station:</div>
                <div class="choosecat">
                    <div class="catpad">
                        <input type="radio" name="category" id="all" value="" checked>
                        <label class="radlabel" for="all">All</label>
                    </div>
                    <div class="catpad">
                        <input type="radio" id="burger" name="category" value="Burger">
                        <label class="radlabel" for="burger">Burger</label>
                    </div>
                    <div class="catpad">
                        <input type="radio" id="pizza" name="category" value="Pizza">
                        <label class="radlabel" for="pizza">Pizza</label>
                    </div>
                    <div class="catpad">
                        <input type="radio" id="chicken" name="category" value="Chicken">
                        <label class="radlabel" for="chicken">Chicken</label>
                    </div>
                    <div class="catpad">
                        <input type="radio" id="beef" name="category" value="Beef">
                        <label class="radlabel" for="beef">Beef</label>
                    </div>
                    <div>
                        <input type="radio" id="seafood" name="category" value="Seafood">
                        <label class="radlabel" for="seafood">Seafood</label>
                    </div>
                </div>
            </div>
            <div class="tablebox">
                <div class="redbox"></div>
                <div class="tablecontent">
                    <table>
                        <thead>
                            <tr>
                                <th>Receipt ID</th>
                                <th>Food Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody data-queue-order-container>
                            <tr>
                                <td>Loading...</td>
                                <td>Loading...</td>
                                <td>Loading...</td>
                                <td>Loading...</td>
                                <td><input type="button" value="Loading..."></td>
                            </tr>
                        </tbody>
                        <!-- Template for each queueing orders -->
                        <template data-queue-order-template>
                            <tr>
                                <td data-receipt-id></td>
                                <td data-food-name></td>
                                <td data-quantity></td>
                                <td data-price></td>
                                <td><input type="button" data-status></td>
                            </tr>
                        </template>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="../js/navbar-ad.js"></script>
    <script src="../js/queueorder-ad.js"></script>
</body>

</html>