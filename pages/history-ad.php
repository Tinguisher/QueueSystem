<?php
// check if session is admin
include '../contexts/SessionAdmin.php';

// close the database
$mysqli->close();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>SnapServe | Admin History</title>
    <link rel="icon" type="image/png" href="../images/bacon.png">
    <link rel="stylesheet" href="../stylesheets/history-ad.css">
    <link href='https://fonts.googleapis.com/css?family=Averia Serif Libre' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href='https://fonts.googleapis.com/css?family=Rhodium Libre' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto Slab' rel='stylesheet'>
</head>

<body>


    <div style="margin-left: 60px; margin-top: 30px; width: 1800px; height: 126px; border-top: 4px solid #000; border-bottom: 4px solid #000; position: absolute">
        <h1 style="font-family: 'Averia Serif Libre'; font-size: 49px; position: absolute; margin-top: 33px;">SnapServe
        </h1>

        <table class="navTable" style="margin-top: 33px; margin-left: 390px; position: absolute;">
            <tr>
                <td style="width: 180px;"><a href="./home-ad.php" target="_top">Home</a></td>
                <td style="width: 180px;"><a href="./team-ad.php" target="_top">Team</a></td>
                <td style="width: 215px;"><a href="./queueorder-ad.php" target="_top">Queue Order</a></td>
                <td style="width: 236px;"><a href="./managemenu-ad.php" target="_top">Manage Menu</a></td>
                <td style="width: 160px;"><a href="./history-ad.php" target="_top" style="color: #BD4141;"><b>History</b></a>
                </td>
            </tr>
        </table>

        <p id="profilename"><?= $user['name']; ?></p>

        <div class="dropdown" style="margin-top: 37.5px; margin-left:1650px;" id="dropdownFr">
            <div id="drop-text" class="dropdown-text">
                <span id="span">
                    <svg style="margin-top: 19px; margin-left:6px; position: absolute;" xmlns="http://www.w3.org/2000/svg" width="24" height="12" viewBox="0 0 24 12" fill="none">
                        <g clip-path="url(#clip0_600_133)">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.2884 10.157L5.63137 4.5L7.04537 3.086L11.9954 8.036L16.9454 3.086L18.3594 4.5L12.7024 10.157C12.5148 10.3445 12.2605 10.4498 11.9954 10.4498C11.7302 10.4498 11.4759 10.3445 11.2884 10.157Z" fill="#FFFDF1" />
                        </g>
                        <defs>
                            <clipPath id="clip0_600_133">
                                <rect width="12" height="24" fill="white" transform="matrix(0 1 -1 0 24 0)" />
                            </clipPath>
                        </defs>
                    </svg>
                    <svg style="margin-top: 10px; margin-left: 32px; position:absolute;" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                        <path d="M5 22.5C5 21.1739 5.52678 19.9021 6.46447 18.9645C7.40215 18.0268 8.67392 17.5 10 17.5H20C21.3261 17.5 22.5979 18.0268 23.5355 18.9645C24.4732 19.9021 25 21.1739 25 22.5C25 23.163 24.7366 23.7989 24.2678 24.2678C23.7989 24.7366 23.163 25 22.5 25H7.5C6.83696 25 6.20107 24.7366 5.73223 24.2678C5.26339 23.7989 5 23.163 5 22.5Z" stroke="#FFFDF1" stroke-width="2" stroke-linejoin="round" />
                        <path d="M15 12.5C17.0711 12.5 18.75 10.8211 18.75 8.75C18.75 6.67893 17.0711 5 15 5C12.9289 5 11.25 6.67893 11.25 8.75C11.25 10.8211 12.9289 12.5 15 12.5Z" stroke="#FFFDF1" stroke-width="2" />
                    </svg>
                </span>
            </div>
            <ul id="list" class="dropdown-list">
                <li id="profileDropDown" class="dropdown-list-item"> <svg id="icons" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                        <path d="M5 22.5C5 21.1739 5.52678 19.9021 6.46447 18.9645C7.40215 18.0268 8.67392 17.5 10 17.5H20C21.3261 17.5 22.5979 18.0268 23.5355 18.9645C24.4732 19.9021 25 21.1739 25 22.5C25 23.163 24.7366 23.7989 24.2678 24.2678C23.7989 24.7366 23.163 25 22.5 25H7.5C6.83696 25 6.20107 24.7366 5.73223 24.2678C5.26339 23.7989 5 23.163 5 22.5Z" stroke="#FFF" stroke-width="2" stroke-linejoin="round" />
                        <path d="M15 12.5C17.0711 12.5 18.75 10.8211 18.75 8.75C18.75 6.67893 17.0711 5 15 5C12.9289 5 11.25 6.67893 11.25 8.75C11.25 10.8211 12.9289 12.5 15 12.5Z" stroke="#FFF" stroke-width="2" />
                    </svg>
                    <p>Profile</p>
                </li>
                <li id="logoutButton" class="dropdown-list-item"> <svg id="icons" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M5 21C4.45 21 3.97933 20.8043 3.588 20.413C3.19667 20.0217 3.00067 19.5507 3 19V5C3 4.45 3.196 3.97933 3.588 3.588C3.98 3.19667 4.45067 3.00067 5 3H12V5H5V19H12V21H5ZM16 17L14.625 15.55L17.175 13H9V11H17.175L14.625 8.45L16 7L21 12L16 17Z" fill="#FFF" />
                    </svg>
                    <p>Logout</p>
                </li>
            </ul>
        </div>

        <div>
            <p id="headerhistory">History</p>
        </div>

        <div id="borderline">
            <div>
                <p id="allord">All Orders</p>
                <p id="thisweek">This Week</p>
                <p id="thismon">This Month</p>
                <form style="margin-top: 24px; margin-left: 564px; position: absolute;">
                    <input type="text" id="filterInput" placeholder="Search">
                    <button id="search"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            <!-- <div class="tableDiv"></div> -->
            <!-- <div class="tableDiv1" style="top:100px"> </div> -->
            
            <div  class="tableDiv1"  >
                <table class="table2" style="position: relative; margin-top: 20px; margin-left: 38px; width: 1724px; height: 72px; border-spacing: 0 20px;">
                    
                    <thead>
                        <tr class="spaceUnder">
                            <th class="tdsideL">Order ID</th>
                            <th>Name</th>
                            <!-- <th>Time to Cook</th> -->
                            <th>Total</th>
                            <th>Date</th>
                            <th class="tdsideR">Items</th>
                        </tr>
                    </thead> 
            
                    <tbody data-history-container>
                        <tr class="spaceUnder">
                            <td class="tdsideL">Loading...</td>
                            <td>Loading...</td>
                            <!-- <td>Loading...</td> -->
                            <td>Loading...</td>
                            <td>Loading...</td>
                            <td class="tdsideR">
                                <div class="dropdown"> Loading...
                                    <button class="dropbtn"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                            <path d="M13.5938 4.6875C13.5938 5.46415 14.2233 6.09375 15 6.09375C15.7767 6.09375 16.4062 5.46415 16.4062 4.6875C16.4062 3.91085 15.7767 3.28125 15 3.28125C14.2233 3.28125 13.5938 3.91085 13.5938 4.6875Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M13.5938 15C13.5938 15.7767 14.2233 16.4062 15 16.4062C15.7767 16.4062 16.4062 15.7767 16.4062 15C16.4062 14.2233 15.7767 13.5938 15 13.5938C14.2233 13.5938 13.5938 14.2233 13.5938 15Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M13.5938 25.3125C13.5938 26.0892 14.2233 26.7188 15 26.7188C15.7767 26.7188 16.4062 26.0892 16.4062 25.3125C16.4062 24.5358 15.7767 23.9062 15 23.9062C14.2233 23.9062 13.5938 24.5358 13.5938 25.3125Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                    <div class="dropdown-content">
                                        <a>Summary</a>
                                    </div>
                                </div>
                            </td>
                        </tr>   
                    </tbody>

                    <!-- Template for each history -->
                    <template data-history-template>
                        <tr class="spaceUnder">
                            <td class="tdsideL" data-receipt-id></td>
                            <td data-user-name></td>
                            <!-- <td data-cook-time></td> -->
                            <td data-total-price></td>
                            <td data-date></td>
                            <td class="tdsideR">
                                <div class="dropdown" data-items>
                                    <button class="dropbtn"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                                            <path d="M13.5938 4.6875C13.5938 5.46415 14.2233 6.09375 15 6.09375C15.7767 6.09375 16.4062 5.46415 16.4062 4.6875C16.4062 3.91085 15.7767 3.28125 15 3.28125C14.2233 3.28125 13.5938 3.91085 13.5938 4.6875Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M13.5938 15C13.5938 15.7767 14.2233 16.4062 15 16.4062C15.7767 16.4062 16.4062 15.7767 16.4062 15C16.4062 14.2233 15.7767 13.5938 15 13.5938C14.2233 13.5938 13.5938 14.2233 13.5938 15Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M13.5938 25.3125C13.5938 26.0892 14.2233 26.7188 15 26.7188C15.7767 26.7188 16.4062 26.0892 16.4062 25.3125C16.4062 24.5358 15.7767 23.9062 15 23.9062C14.2233 23.9062 13.5938 24.5358 13.5938 25.3125Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                    <div class="dropdown-content">
                                        <a data-summary-button>Summary</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </template>
                </table>
            </div>
        </div>
    </div>
    <script defer src="../js/history-ad.js"></script>
</body>

</html>