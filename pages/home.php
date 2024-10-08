<?php
// check if there is session
include '../contexts/SessionUser.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>SnapServe | Home</title>
    <link rel="stylesheet" href="../stylesheets/home.css">
    <link href='https://fonts.googleapis.com/css?family=Averia Serif Libre' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href='https://fonts.googleapis.com/css?family=Rhodium Libre' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto Slab' rel='stylesheet'>

    <!-- icon at tab -->
    <link rel="icon" type="image/png" href="../images/bacon.png">

</head>

<body>
    <div style="margin-left: 60px; margin-top: 30px; width: 1800px; height: 126px; border-top: 4px solid #000; border-bottom: 4px solid #000; position: absolute">
        <h1 style="font-family: 'Averia Serif Libre'; font-size: 49px; position: absolute; margin-top: 33px;">SnapServe</h1>

        <form id="searchSubmit" style="margin-top: 38px; margin-left: 350px; position: absolute;">
            <input type="text" id="searchInput" placeholder="Search">
            <div id="dropdownSearch"></div>
            <button id="search" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>

        <table style="margin-top: 33px; margin-left: 931px; position: absolute;">
            <tr>
                <td style="width: 138px;"><a href="./home.php" target="_top" style="color:#FF5622;"><b>Home</b></a></td>
                <td style="width: 133px;" id="menn"><a href="./menu.php" target="_top">Menu</a></td>
                <td style="width: 155px;"><a href="./aboutus.php" target="_top">About Us</a></td>
            </tr>
        </table>

        <p id="profilename"><?= $user['name'] ?? "Guest"; ?></p>

        <a href="./menu.php" class="navcrcl" style="margin-top: 37.5px; margin-left: 1746px;">
            <svg style="margin-top: 10px; margin-left:10px" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                <path d="M0 2.8125C0 2.56386 0.0987721 2.3254 0.274587 2.14959C0.450403 1.97377 0.68886 1.875 0.9375 1.875H3.75C3.95912 1.87506 4.16222 1.94503 4.327 2.0738C4.49177 2.20256 4.60877 2.38272 4.65937 2.58562L5.41875 5.625H27.1875C27.3252 5.62513 27.4611 5.65557 27.5857 5.71416C27.7102 5.77275 27.8204 5.85805 27.9082 5.96401C27.9961 6.06996 28.0596 6.19397 28.0941 6.32722C28.1287 6.46047 28.1335 6.59969 28.1081 6.735L25.2956 21.735C25.2554 21.9498 25.1414 22.1439 24.9733 22.2836C24.8052 22.4232 24.5936 22.4998 24.375 22.5H7.5C7.28144 22.4998 7.06981 22.4232 6.90171 22.2836C6.7336 22.1439 6.61959 21.9498 6.57938 21.735L3.76875 6.76313L3.01875 3.75H0.9375C0.68886 3.75 0.450403 3.65123 0.274587 3.47541C0.0987721 3.2996 0 3.06114 0 2.8125ZM5.81625 7.5L8.27812 20.625H23.5969L26.0588 7.5H5.81625ZM9.375 22.5C8.38044 22.5 7.42661 22.8951 6.72335 23.5984C6.02009 24.3016 5.625 25.2554 5.625 26.25C5.625 27.2446 6.02009 28.1984 6.72335 28.9016C7.42661 29.6049 8.38044 30 9.375 30C10.3696 30 11.3234 29.6049 12.0267 28.9016C12.7299 28.1984 13.125 27.2446 13.125 26.25C13.125 25.2554 12.7299 24.3016 12.0267 23.5984C11.3234 22.8951 10.3696 22.5 9.375 22.5ZM22.5 22.5C21.5054 22.5 20.5516 22.8951 19.8484 23.5984C19.1451 24.3016 18.75 25.2554 18.75 26.25C18.75 27.2446 19.1451 28.1984 19.8484 28.9016C20.5516 29.6049 21.5054 30 22.5 30C23.4946 30 24.4484 29.6049 25.1516 28.9016C25.8549 28.1984 26.25 27.2446 26.25 26.25C26.25 25.2554 25.8549 24.3016 25.1516 23.5984C24.4484 22.8951 23.4946 22.5 22.5 22.5ZM9.375 24.375C9.87228 24.375 10.3492 24.5725 10.7008 24.9242C11.0525 25.2758 11.25 25.7527 11.25 26.25C11.25 26.7473 11.0525 27.2242 10.7008 27.5758C10.3492 27.9275 9.87228 28.125 9.375 28.125C8.87772 28.125 8.40081 27.9275 8.04918 27.5758C7.69754 27.2242 7.5 26.7473 7.5 26.25C7.5 25.7527 7.69754 25.2758 8.04918 24.9242C8.40081 24.5725 8.87772 24.375 9.375 24.375ZM22.5 24.375C22.9973 24.375 23.4742 24.5725 23.8258 24.9242C24.1775 25.2758 24.375 25.7527 24.375 26.25C24.375 26.7473 24.1775 27.2242 23.8258 27.5758C23.4742 27.9275 22.9973 28.125 22.5 28.125C22.0027 28.125 21.5258 27.9275 21.1742 27.5758C20.8225 27.2242 20.625 26.7473 20.625 26.25C20.625 25.7527 20.8225 25.2758 21.1742 24.9242C21.5258 24.5725 22.0027 24.375 22.5 24.375Z" fill="#FFF" />
            </svg>
        </a>

        <div class="dropdown" style="margin-top: 37.5px; margin-left:1650px;">
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
                <li id="profileButton" class="dropdown-list-item">
                    <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                        <path d="M5 22.5C5 21.1739 5.52678 19.9021 6.46447 18.9645C7.40215 18.0268 8.67392 17.5 10 17.5H20C21.3261 17.5 22.5979 18.0268 23.5355 18.9645C24.4732 19.9021 25 21.1739 25 22.5C25 23.163 24.7366 23.7989 24.2678 24.2678C23.7989 24.7366 23.163 25 22.5 25H7.5C6.83696 25 6.20107 24.7366 5.73223 24.2678C5.26339 23.7989 5 23.163 5 22.5Z" stroke="#FFF" stroke-width="2" stroke-linejoin="round" />
                        <path d="M15 12.5C17.0711 12.5 18.75 10.8211 18.75 8.75C18.75 6.67893 17.0711 5 15 5C12.9289 5 11.25 6.67893 11.25 8.75C11.25 10.8211 12.9289 12.5 15 12.5Z" stroke="#FFF" stroke-width="2" />
                    </svg>
                    <p>Profile</p>
                </li>
                <li id="orderHistory" class="dropdown-list-item">
                    <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M3 2H5V4H7V6H5V20H19V6H17V4H19V2H21V22H3V2ZM15 4V2H17V4H15ZM13 4H15V6H13V4ZM11 4V2H13V4H11ZM9 4H11V6H9V4ZM9 4V2H7V4H9ZM17 8H7V10H17V8ZM7 12H17V14H7V12ZM17 18V16H13V18H17Z" fill="#FFF" />
                    </svg>
                    <p>Order History</p>
                </li>

                <li id="sessionbutton" class="dropdown-list-item">
                    <svg class="icons" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M5 21C4.45 21 3.97933 20.8043 3.588 20.413C3.19667 20.0217 3.00067 19.5507 3 19V5C3 4.45 3.196 3.97933 3.588 3.588C3.98 3.19667 4.45067 3.00067 5 3H12V5H5V19H12V21H5ZM16 17L14.625 15.55L17.175 13H9V11H17.175L14.625 8.45L16 7L21 12L16 17Z" fill="#FFF" />
                    </svg>
                    <p id="sessiontext">Loading...</p>
                </li>
            </ul>
        </div>
    </div>

    <div class="slider">
        <div id="slides">
            <input type="radio" name="radio-btn" id="radio1">
            <input type="radio" name="radio-btn" id="radio2">
            <input type="radio" name="radio-btn" id="radio3">
            <input type="radio" name="radio-btn" id="radio4">
            <!-- Template for slider images -->
            <template data-slide-template>
                <div class="slide" data-slide-div>
                    <img data-slide-img>
                </div>
            </template>
            <div id="navigation-auto">
                <div class="auto-btn1"></div>
                <div class="auto-btn2"></div>
                <div class="auto-btn3"></div>
                <div class="auto-btn4"></div>
            </div>
            <div id="navigation-manual">
                <label for="radio1" class="manual-btn"></label>
                <label for="radio2" class="manual-btn"></label>
                <label for="radio3" class="manual-btn"></label>
                <label for="radio4" class="manual-btn"></label>
            </div>
        </div>
    </div>

    <div>
        <p id="home">Home</p>
        <p id="lorem">Welcome to</p>
        <p id="dolor">SnapServe! Where<br>fast food meets<br>exceptional service.</p>
        <p id="aliquam">Precision in every bite.</p>
        <p style="width: 826px; height: 38px; background-color: #FF5622; position: absolute; margin-top: 930px; margin-left: 60px; border: 4px solid #000;"></p>
        <img src="../images/Group 36.png" id="logo">
    </div>


    <div>
        <p id="promo">Promos of the Day</p>
        <p id="dish">Dishes that are a special part of your day Dishes that has a special offer</p>

        <div id="promoContainer" style="margin-left: 141px;">
            <h1>Loading Promos</h1>
        </div>

        <!-- Template for the food promos -->
        <template data-food-promo-template>
            <button class="foodpromo"><img style="width: 350px; height: 233px" data-food-image>
                <p class="ali" data-food-details>

                    <br>

                    <br>

                    <svg style="position: absolute; margin-top:2px; margin-left:27px;" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
                        <path d="M4 16H16V18H4V16ZM2 11H12V13H2V11Z" fill="#FF5622" />
                        <path d="M29.9193 16.606L26.9193 9.606C26.8422 9.42616 26.7141 9.27288 26.5507 9.16516C26.3874 9.05745 26.196 9.00002 26.0003 9H23.0003V7C23.0003 6.73478 22.895 6.48043 22.7074 6.29289C22.5199 6.10536 22.2656 6 22.0003 6H6.00033V8H21.0003V20.556C20.5449 20.8209 20.1464 21.1732 19.8275 21.5926C19.5087 22.0121 19.2758 22.4903 19.1423 23H12.8583C12.6149 22.0573 12.0361 21.2358 11.2303 20.6894C10.4245 20.143 9.44715 19.9092 8.48133 20.0319C7.51552 20.1546 6.6276 20.6253 5.98401 21.3558C5.34042 22.0863 4.98535 23.0264 4.98535 24C4.98535 24.9736 5.34042 25.9137 5.98401 26.6442C6.6276 27.3747 7.51552 27.8454 8.48133 27.9681C9.44715 28.0908 10.4245 27.857 11.2303 27.3106C12.0361 26.7642 12.6149 25.9427 12.8583 25H19.1423C19.3599 25.8582 19.8574 26.6194 20.5561 27.1632C21.2549 27.7069 22.115 28.0021 23.0003 28.0021C23.8857 28.0021 24.7458 27.7069 25.4446 27.1632C26.1433 26.6194 26.6408 25.8582 26.8583 25H29.0003C29.2656 25 29.5199 24.8946 29.7074 24.7071C29.895 24.5196 30.0003 24.2652 30.0003 24V17C30.0003 16.8645 29.9727 16.7305 29.9193 16.606ZM9.00033 26C8.60477 26 8.21809 25.8827 7.88919 25.6629C7.5603 25.4432 7.30395 25.1308 7.15258 24.7654C7.0012 24.3999 6.96159 23.9978 7.03876 23.6098C7.11593 23.2219 7.30642 22.8655 7.58612 22.5858C7.86583 22.3061 8.22219 22.1156 8.61015 22.0384C8.99812 21.9613 9.40025 22.0009 9.7657 22.1522C10.1312 22.3036 10.4435 22.56 10.6633 22.8889C10.883 23.2178 11.0003 23.6044 11.0003 24C11.0003 24.5304 10.7896 25.0391 10.4145 25.4142C10.0395 25.7893 9.53077 26 9.00033 26ZM23.0003 11H25.3403L27.4843 16H23.0003V11ZM23.0003 26C22.6048 26 22.2181 25.8827 21.8892 25.6629C21.5603 25.4432 21.304 25.1308 21.1526 24.7654C21.0012 24.3999 20.9616 23.9978 21.0388 23.6098C21.1159 23.2219 21.3064 22.8655 21.5861 22.5858C21.8658 22.3061 22.2222 22.1156 22.6102 22.0384C22.9981 21.9613 23.4002 22.0009 23.7657 22.1522C24.1312 22.3036 24.4435 22.56 24.6633 22.8889C24.883 23.2178 25.0003 23.6044 25.0003 24C25.0003 24.5304 24.7896 25.0391 24.4145 25.4142C24.0395 25.7893 23.5308 26 23.0003 26ZM28.0003 23H26.8583C26.6381 22.1434 26.1398 21.3842 25.4416 20.8413C24.7434 20.2983 23.8848 20.0025 23.0003 20V18H28.0003V23Z" fill="#FF5622" />
                    </svg>
                </p>
                <p class="free" style="margin-top: 92px;margin-left: 187px;">20 Php</p>
            </button>
        </template>

        <a href="./menu.php" target="_top">
            <button class="btn btn-background-slide" style="margin-top: 250px; margin-left: 135px;">See all Promotions</button>
        </a>
    </div>

    <div>
        <img src="../images/gray.png" id="gray" style="position: absolute; z-index: -1;">
        <p id="foods">Foods that are HOT right now!</p>
        <p id="pop">Popular Menu</p>
        <p id="dishes">Dishes that are perfectly cooked to cater <br> your taste buds, craves and needs.</p>
        <div>
            <div id="popularmenu" style="top: 400px; position: relative;">
                <h1>Loading...</h1>
            </div>
            <template data-popular-menu-template>
                <div class="men1" style="margin-top: 70px; margin-left: 180px; display: inline-block">
                    <img style="position: absolute; height:251px; width:251px" data-food-image>
                    <input type="text" class="menName" readonly data-food-name>
                    <p class="men2" data-food-description></p>
                    <input type="text" class="dollar" readonly data-food-price>
                    <a class="navcrcl" style="margin-top: 180px; margin-left:600px;">
                        <svg style="margin-top: 10px; margin-left:10px" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                            <path d="M0 2.8125C0 2.56386 0.0987721 2.3254 0.274587 2.14959C0.450403 1.97377 0.68886 1.875 0.9375 1.875H3.75C3.95912 1.87506 4.16222 1.94503 4.327 2.0738C4.49177 2.20256 4.60877 2.38272 4.65937 2.58562L5.41875 5.625H27.1875C27.3252 5.62513 27.4611 5.65557 27.5857 5.71416C27.7102 5.77275 27.8204 5.85805 27.9082 5.96401C27.9961 6.06996 28.0596 6.19397 28.0941 6.32722C28.1287 6.46047 28.1335 6.59969 28.1081 6.735L25.2956 21.735C25.2554 21.9498 25.1414 22.1439 24.9733 22.2836C24.8052 22.4232 24.5936 22.4998 24.375 22.5H7.5C7.28144 22.4998 7.06981 22.4232 6.90171 22.2836C6.7336 22.1439 6.61959 21.9498 6.57938 21.735L3.76875 6.76313L3.01875 3.75H0.9375C0.68886 3.75 0.450403 3.65123 0.274587 3.47541C0.0987721 3.2996 0 3.06114 0 2.8125ZM5.81625 7.5L8.27812 20.625H23.5969L26.0588 7.5H5.81625ZM9.375 22.5C8.38044 22.5 7.42661 22.8951 6.72335 23.5984C6.02009 24.3016 5.625 25.2554 5.625 26.25C5.625 27.2446 6.02009 28.1984 6.72335 28.9016C7.42661 29.6049 8.38044 30 9.375 30C10.3696 30 11.3234 29.6049 12.0267 28.9016C12.7299 28.1984 13.125 27.2446 13.125 26.25C13.125 25.2554 12.7299 24.3016 12.0267 23.5984C11.3234 22.8951 10.3696 22.5 9.375 22.5ZM22.5 22.5C21.5054 22.5 20.5516 22.8951 19.8484 23.5984C19.1451 24.3016 18.75 25.2554 18.75 26.25C18.75 27.2446 19.1451 28.1984 19.8484 28.9016C20.5516 29.6049 21.5054 30 22.5 30C23.4946 30 24.4484 29.6049 25.1516 28.9016C25.8549 28.1984 26.25 27.2446 26.25 26.25C26.25 25.2554 25.8549 24.3016 25.1516 23.5984C24.4484 22.8951 23.4946 22.5 22.5 22.5ZM9.375 24.375C9.87228 24.375 10.3492 24.5725 10.7008 24.9242C11.0525 25.2758 11.25 25.7527 11.25 26.25C11.25 26.7473 11.0525 27.2242 10.7008 27.5758C10.3492 27.9275 9.87228 28.125 9.375 28.125C8.87772 28.125 8.40081 27.9275 8.04918 27.5758C7.69754 27.2242 7.5 26.7473 7.5 26.25C7.5 25.7527 7.69754 25.2758 8.04918 24.9242C8.40081 24.5725 8.87772 24.375 9.375 24.375ZM22.5 24.375C22.9973 24.375 23.4742 24.5725 23.8258 24.9242C24.1775 25.2758 24.375 25.7527 24.375 26.25C24.375 26.7473 24.1775 27.2242 23.8258 27.5758C23.4742 27.9275 22.9973 28.125 22.5 28.125C22.0027 28.125 21.5258 27.9275 21.1742 27.5758C20.8225 27.2242 20.625 26.7473 20.625 26.25C20.625 25.7527 20.8225 25.2758 21.1742 24.9242C21.5258 24.5725 22.0027 24.375 22.5 24.375Z" fill="#FFFFFF" />
                        </svg>
                    </a>
                </div>
            </template>

            <div>
                <p style="position: absolute; width: 289px; height: 4px; background: #000; margin-top: 500px; margin-left: 53px;"></p>
                <p style="position: absolute; width: 289px; height: 4px; background: #000; margin-top: 500px; margin-left: 417px;"></p>
                <svg style="position: absolute; margin-top:480px; margin-left:360px;" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <path d="M26.6671 3.33325L22.8338 7.16659C21.9176 8.10123 21.4045 9.35782 21.4045 10.6666C21.4045 11.9753 21.9176 13.2319 22.8338 14.1666L25.8338 17.1666C26.7684 18.0827 28.025 18.5959 29.3338 18.5959C30.6425 18.5959 31.8991 18.0827 32.8338 17.1666L36.6671 13.3333M25.0004 24.9999L5.50043 5.49992C4.83524 6.15168 4.30678 6.92961 3.94601 7.78817C3.58524 8.64673 3.39941 9.56864 3.39941 10.4999C3.39941 11.4312 3.58524 12.3531 3.94601 13.2117C4.30678 14.0702 4.83524 14.8482 5.50043 15.4999L17.6671 27.6666C18.8338 28.8333 21.0004 28.8333 22.3338 27.6666L25.0004 24.9999ZM25.0004 24.9999L36.6671 36.6666M3.50043 36.3332L14.1671 25.8333M31.6671 8.33325L20.0004 19.9999" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

                <a href="./menu.php?popular=true" target="_top">
                    <button id="show">Show All</button>
                </a>

                <p style="position: absolute; width: 289px; height: 4px; background: #000; margin-top: 500px; margin-left: 1211px;"></p>
                <p style="position: absolute; width: 289px; height: 4px; background: #000; margin-top: 500px; margin-left: 1575px;"></p>
                <svg style="position: absolute; margin-top:480px; margin-left:1518px;" xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <path d="M26.6671 3.33325L22.8338 7.16659C21.9176 8.10123 21.4045 9.35782 21.4045 10.6666C21.4045 11.9753 21.9176 13.2319 22.8338 14.1666L25.8338 17.1666C26.7684 18.0827 28.025 18.5959 29.3338 18.5959C30.6425 18.5959 31.8991 18.0827 32.8338 17.1666L36.6671 13.3333M25.0004 24.9999L5.50043 5.49992C4.83524 6.15168 4.30678 6.92961 3.94601 7.78817C3.58524 8.64673 3.39941 9.56864 3.39941 10.4999C3.39941 11.4312 3.58524 12.3531 3.94601 13.2117C4.30678 14.0702 4.83524 14.8482 5.50043 15.4999L17.6671 27.6666C18.8338 28.8333 21.0004 28.8333 22.3338 27.6666L25.0004 24.9999ZM25.0004 24.9999L36.6671 36.6666M3.50043 36.3332L14.1671 25.8333M31.6671 8.33325L20.0004 19.9999" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>

        </div>

        <script>
            // convert to json to read the boolean, pass if logged in or not
            var loggedin = <?php echo json_encode(isset($_SESSION['id'])); ?>;
        </script>
        <script src="../js/home.js"> </script>
</body>

</html>