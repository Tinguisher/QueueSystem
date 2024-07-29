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
                    <li><a href="home-ad.html">Home</a></li>
                    <li><a href="team-ad.html">Team</a></li>
                    <li><a href="queueorder-ad.html"><span class="queueordertext">Queue Order</span></a></li>
                    <li><a href="managemenu-ad.html">Manage Menu</a></li>
                    <li><a href="history-ad.html">History</a></li>
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
                        <input type="radio" checked="checked">
                        <label class="radlabel">All</label>
                    </div>
                    <div class="catpad">
                        <input type="radio">
                        <label class="radlabel">Burger</label>
                    </div>
                    <div class="catpad">
                        <input type="radio">
                        <label class="radlabel">Pizza</label>
                    </div>
                    <div class="catpad">
                        <input type="radio">
                        <label class="radlabel">Chicken</label>
                    </div>
                    <div class="catpad">
                        <input type="radio">
                        <label class="radlabel">Beef</label>
                    </div>
                    <div>
                        <input type="radio">
                        <label class="radlabel">Seafood</label>
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
                                <td>Loading...</td>
                            </tr>
                        </tbody>
                        <!-- Template for each queueing orders -->
                        <template data-queue-order-template>
                            
                                <tr>
                                    <td data-receipt-id></td>
                                    <td data-food-name></td>
                                    <td data-quantity></td>
                                    <td data-price></td>
                                    <td data-status></td>
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