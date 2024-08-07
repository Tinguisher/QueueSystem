<?php
// check if session is admin
include '../contexts/AdminSession.php';

// close the database
$mysqli->close();

?>

<html>
<head>
    <link rel="stylesheet" href="../stylesheets/managemenuedit-ad.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto Slab' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Rhodium Libre' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Averia Serif Libre' rel='stylesheet'>
</head>
<body>
    <div id="wholepage">
        <div class="pageadd">
            <div class="navbar">
                <div class="subnavbar1">SnapServe</div>
                <div class="subnavbar2">
                    <ul>
                        <li><a href="./home-ad.php">Home</a></li>
                        <li><a href="./team-ad.php">Team</a></li>
                        <li><a href="./queueorder-ad.php">Queue Order</a></li>
                        <li><a href="./managemenu-ad.php"><span class="redtext">Manage Menu</span></a></li>
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
            <div class="managemenu-line"><a class="mm-line" href="./managemenu-ad.php">Manage Menu</a>> Edit Menu</div>
            <!-- <div class="innerbox"> -->

            <div class="upperbox">
                <button class="buttonbox" id="buttonboxid">
                    <div class="burgerbox">
                        <svg style="position: absolute; margin-left: -3.5vh" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                            <path d="M6.25 15H23.75M5 18.75H25C25 20.0761 24.4732 21.3479 23.5355 22.2855C22.5979 23.2232 21.3261 23.75 20 23.75H10C8.67392 23.75 7.40215 23.2232 6.46447 22.2855C5.52678 21.3479 5 20.0761 5 18.75ZM15 5C19.7287 5 23.6912 7.66625 24.7325 11.25H5.2675C6.30875 7.66625 10.2713 5 15 5Z" stroke="#BD4141" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Burger
                    </div>
                </button>
                <button class="buttonbox">
                    <div class="pizzabox">
                        <svg style="position: absolute; margin-left: -40px" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                            <path d="M14.9703 0.9375C12.2998 0.942916 9.68607 1.70894 7.43513 3.1459L7.96833 3.91758C10.0718 2.5834 12.5093 1.875 14.9996 1.875C16.5992 1.875 18.1871 2.1668 19.6812 2.7375L20.0504 1.87559C18.4387 1.25542 16.7265 0.937418 14.9996 0.9375H14.9703ZM21.023 2.29219L20.6539 3.1541C23.8355 4.67227 26.273 7.40625 27.4156 10.7402L28.3121 10.4707C27.4683 6.65039 25.0308 3.5918 21.023 2.29219ZM14.9644 2.98828C12.7144 2.99473 10.5054 3.63398 8.60114 4.8334L14.8883 13.916C16.7164 10.6465 18.0933 7.23633 19.2418 3.76172C17.8883 3.2502 16.4468 2.98828 14.9996 2.98828H14.9644ZM16.6871 3.51152L17.8062 4.90957L16.9859 5.56875L15.8668 4.17012L16.6871 3.51152ZM6.56794 3.7459C2.1781 6.10547 1.20896 9.67969 1.00739 13.5938L1.94372 13.6523C2.31813 10.0254 4.18669 6.71484 7.10114 4.51699L6.56794 3.7459ZM13.0191 4.16016C13.4996 4.16016 13.9449 4.28437 14.3023 4.52344C14.6597 4.76191 14.9468 5.15332 14.9468 5.625C14.9468 6.09961 14.6597 6.48633 14.3023 6.72656C13.9449 6.9668 13.4996 7.08984 13.0191 7.08984C12.5386 7.08984 12.0933 6.9668 11.7359 6.72656C11.3785 6.48633 11.0914 6.09961 11.0914 5.625C11.0914 5.15332 11.3785 4.76191 11.7359 4.52344C12.0933 4.28437 12.5386 4.16016 13.0191 4.16016ZM20.2144 4.17832C19.1422 7.65234 17.7711 11.0039 15.9312 14.168L19.9332 12.9727C19.7457 12.6855 19.6402 12.334 19.6402 11.9648C19.6402 11.0859 20.2554 10.2773 21.1285 10.2773C22.0015 10.2773 22.6168 11.0859 22.6168 11.9648C22.6168 12.0352 22.6109 12.1055 22.605 12.1816L26.3492 11.0625C25.3004 8.04492 23.0914 5.56523 20.2144 4.17832ZM13.0191 5.21484C12.7261 5.21484 12.4742 5.29922 12.3218 5.4C12.1695 5.5002 12.1461 5.57871 12.1461 5.625C12.1461 5.67129 12.1695 5.7498 12.3218 5.85C12.4742 5.95312 12.7261 6.03516 13.0191 6.03516C13.3121 6.03516 13.564 5.95312 13.7164 5.85C13.8687 5.7498 13.8922 5.67129 13.8922 5.625C13.8922 5.57871 13.8687 5.5002 13.7164 5.4C13.564 5.29922 13.3121 5.21484 13.0191 5.21484ZM7.73396 5.43281C5.09958 7.43555 3.40681 10.4355 3.05583 13.7227C6.72614 13.7578 10.3883 13.8281 13.9508 14.4023L12.8316 12.7852L11.7476 13.377L11.2437 12.4512L12.2281 11.9121L8.88825 7.10156L7.53474 8.17383L6.87849 7.3418L8.28474 6.22852L7.73396 5.43281ZM21.4215 6.24023L22.1363 7.41797L21.234 7.96875L20.5191 6.79102L21.4215 6.24023ZM15.1812 7.59375L15.6383 8.54297L13.8687 9.38086L13.4117 8.43164L15.1812 7.59375ZM7.23005 8.84766C8.22614 8.84766 8.96442 9.76172 8.96442 10.7812C8.96442 11.8008 8.22614 12.7148 7.23005 12.7148C6.23396 12.7148 5.49567 11.8008 5.49567 10.7812C5.49567 9.76172 6.23396 8.84766 7.23005 8.84766ZM24.691 9.39258L24.9078 11.0098L23.8648 11.1504L23.648 9.5332L24.691 9.39258ZM7.23005 9.90234C6.89606 9.90234 6.55036 10.248 6.55036 10.7812C6.55036 11.3145 6.89606 11.6602 7.23005 11.6602C7.56403 11.6602 7.90974 11.3145 7.90974 10.7812C7.90974 10.248 7.56403 9.90234 7.23005 9.90234ZM21.1285 11.332C20.941 11.332 20.6949 11.5605 20.6949 11.9648C20.6949 12.3691 20.941 12.5977 21.1285 12.5977C21.316 12.5977 21.5621 12.3691 21.5621 11.9648C21.5621 11.5605 21.316 11.332 21.1285 11.332ZM28.6168 11.4844L27.7144 11.748C27.984 12.8086 28.1246 13.9043 28.1246 15C28.1246 17.7598 27.2574 20.4492 25.6402 22.6875L26.3785 23.2676C28.1246 20.8652 29.0621 17.9707 29.0621 15C29.0621 13.8164 28.9156 12.6328 28.6168 11.4844ZM26.648 12.0703L19.3824 14.2441L19.9683 14.6602L19.359 15.5156L18.105 14.625L16.1246 15.2168C18.7672 17.7305 21.8492 19.7695 24.7613 21.9961C26.1558 19.957 26.6011 17.5078 27.0113 15C27.1695 14.0215 26.8883 13.0254 26.648 12.0703ZM0.941182 14.6484C0.935322 14.7656 0.941182 14.8828 0.935322 15C0.637666 19.1191 1.46618 23.127 5.77341 25.6172L6.36286 24.8848C3.51052 22.3945 1.87399 18.791 1.87458 15V14.707L0.941182 14.6484ZM2.99021 14.7773V15C2.99021 16.2891 3.19646 17.5664 3.60251 18.791L4.24646 17.4141L5.20153 17.8594L4.13923 20.1328C4.83884 21.6152 5.83317 22.9336 7.06013 24.0176L13.9449 15.4629L6.38044 14.9883L4.93903 16.4238L4.19372 15.6738L4.96833 14.9004L2.99021 14.7773ZM24.5269 15.5449C24.6617 15.5391 24.7965 15.5566 24.9312 15.6035C25.3531 15.7324 25.6519 16.0781 25.7925 16.4707C25.9332 16.8516 25.9332 17.2852 25.7984 17.7129C25.6695 18.1348 25.4117 18.4922 25.0836 18.7324C24.7437 18.9609 24.3043 19.0781 23.8765 18.9434C23.7242 18.8965 23.5894 18.8203 23.4722 18.7266L23.0152 19.248L21.398 17.8535L22.0894 17.0566L22.939 17.7891C22.8804 17.4785 22.9039 17.1504 23.0035 16.834C23.1383 16.4062 23.3902 16.0547 23.7242 15.8203C23.9586 15.6562 24.2398 15.5508 24.5269 15.5449ZM9.2281 15.8672L10.9683 16.5234L10.5933 17.5078L8.8531 16.8516L9.2281 15.8672ZM15.5972 16.1367L15.9078 21.0938C16.189 21.1523 16.4468 21.2461 16.6754 21.3809C17.0679 21.6094 17.4019 22.002 17.4019 22.5C17.4019 22.998 17.0679 23.3906 16.6754 23.6191C16.4937 23.7246 16.2945 23.8066 16.0836 23.8652L16.2769 26.9414C16.9273 26.8711 17.566 26.748 18.1929 26.5781L18.398 24.873L19.441 25.002L19.2945 26.2148C21.1578 25.5059 22.8101 24.3398 24.1109 22.8281C22.898 21.873 21.4508 21.1934 20.4664 19.9629L20.0445 21.1406L19.0484 20.7891L19.5875 19.2715C17.9351 18.4512 16.9039 17.1973 15.5972 16.1367ZM14.5601 16.3887L7.88044 24.6738C9.94294 26.1914 12.439 27.0117 14.9996 27.0117H15.2222L15.0289 23.9531C14.607 23.9238 14.2203 23.8125 13.898 23.6191C13.5054 23.3906 13.1715 22.998 13.1715 22.5C13.1715 22.002 13.5054 21.6094 13.898 21.3809C14.1734 21.2168 14.5015 21.1113 14.8531 21.0645L14.5601 16.3887ZM24.5562 16.5996C24.4976 16.5937 24.4273 16.6172 24.3336 16.6758C24.2105 16.7637 24.0816 16.9336 24.0113 17.1504C23.9468 17.3672 23.9586 17.5781 24.0054 17.7188C24.0582 17.8594 24.1285 17.918 24.1929 17.9355C24.2633 17.959 24.3511 17.9473 24.4742 17.8652C24.5914 17.7832 24.7261 17.6133 24.7965 17.3965C24.8609 17.1797 24.8492 16.9629 24.8023 16.8281C24.7496 16.6875 24.6793 16.6289 24.6148 16.6055C24.5972 16.5996 24.5797 16.5996 24.5562 16.5996ZM7.37067 18.3516C7.62263 18.3574 7.87458 18.416 8.10895 18.5273C8.94685 18.9316 9.357 19.9395 8.95271 20.7773C8.54841 21.6211 7.50544 21.9316 6.66755 21.5273C5.82849 21.123 5.42185 20.1211 5.82497 19.2773C6.11677 18.6738 6.732 18.3457 7.37067 18.3516ZM7.31794 19.4004C7.08356 19.4062 6.87263 19.5293 6.77302 19.7344C6.63239 20.0332 6.76716 20.4082 7.12458 20.5781C7.482 20.748 7.857 20.6191 8.00349 20.3203C8.14411 20.0273 8.00935 19.6523 7.65192 19.4824C7.5406 19.4238 7.42341 19.4004 7.31794 19.4004ZM15.2867 22.0898C14.9351 22.0898 14.6187 22.1836 14.4312 22.2891C14.2437 22.4004 14.2261 22.4824 14.2261 22.5C14.2261 22.5176 14.2437 22.5996 14.4312 22.7109C14.6187 22.8164 14.9351 22.9102 15.2867 22.9102C15.6383 22.9102 15.9547 22.8164 16.1422 22.7109C16.3297 22.5996 16.3472 22.5176 16.3472 22.5C16.3472 22.4824 16.3297 22.4004 16.1422 22.2891C15.9547 22.1836 15.6383 22.0898 15.2867 22.0898ZM24.984 23.5195C22.7925 26.0859 19.7047 27.709 16.3472 28.0547L16.4058 28.9922C20.1558 29.1855 23.7066 28.3301 25.7222 24.0996L24.984 23.5195ZM10.5758 23.6953L12.2222 23.8477L12.1285 24.9023L10.482 24.75L10.5758 23.6953ZM7.18317 25.541L6.59724 26.2734C8.71247 28.9102 11.8824 29.3027 14.9996 29.0625C15.1168 29.0508 15.234 29.0625 15.3511 29.0566L15.2925 28.1191C15.1929 28.125 15.0992 28.125 14.9996 28.125C12.1871 28.125 9.44489 27.2168 7.18317 25.541Z" fill="#BD4141" />
                        </svg>
                        Pizza
                    </div>
                </button>
                <button class="buttonbox">
                    <div class="chickenbox">
                        <svg style="position: absolute; margin-left: -40px" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                            <path d="M14.4561 15.2344C14.4561 15.6073 14.3079 15.965 14.0442 16.2287C13.7805 16.4925 13.4228 16.6406 13.0498 16.6406C12.6768 16.6406 12.3192 16.4925 12.0554 16.2287C11.7917 15.965 11.6436 15.6073 11.6436 15.2344C11.6436 14.8614 11.7917 14.5037 12.0554 14.24C12.3192 13.9763 12.6768 13.8281 13.0498 13.8281C13.4228 13.8281 13.7805 13.9763 14.0442 14.24C14.3079 14.5037 14.4561 14.8614 14.4561 15.2344Z" fill="#FFF" />
                            <path d="M19.8658 1.875C22.9933 1.94719 24.5252 5.65687 22.5564 7.97062C24.3334 9.40973 25.5453 11.43 25.9783 13.6753L28.4589 24.7987C28.5124 25.0406 28.5349 25.2863 28.5461 25.5L28.5471 25.5234V25.5469C28.5479 26.2435 28.3417 26.9247 27.9545 27.5039C27.5674 28.083 27.0168 28.5341 26.3727 28.7996C25.7287 29.0652 25.0202 29.1333 24.3374 28.9953C23.6545 28.8573 23.0281 28.5195 22.5377 28.0247C22.2108 28.3533 21.8222 28.6141 21.3943 28.7921C20.9663 28.9702 20.5075 29.0621 20.0439 29.0625C19.5803 29.063 19.1212 28.9715 18.6931 28.7934C18.2651 28.6152 17.8766 28.354 17.5502 28.0247C17.2233 28.3533 16.8347 28.6141 16.4068 28.7921C15.9788 28.9702 15.5199 29.0621 15.0564 29.0625C14.5927 29.0629 14.1336 28.9712 13.7055 28.7929C13.2775 28.6146 12.889 28.3532 12.5627 28.0238C12.2334 28.357 11.8404 28.6207 11.4072 28.7991C10.974 28.9776 10.5093 29.0671 10.0408 29.0625C8.26519 29.0503 6.84582 27.7125 6.59269 26.0362C6.33682 26.177 6.04942 26.2506 5.75738 26.25C4.52269 26.25 3.68925 24.9938 4.15425 23.8463L4.98863 21.8531C5.09457 21.6019 5.25675 21.3853 5.45738 21.2184C4.398 20.9353 3.36863 20.4253 2.46582 19.5141C1.99144 19.0387 1.83019 18.4884 1.9005 17.9288C1.94738 17.5584 2.10769 17.1741 2.21363 16.9209L2.2605 16.8066L2.2755 16.7691L2.29425 16.7344C2.88207 15.5681 3.59175 14.6278 4.47582 13.9378C5.22305 13.3564 6.09443 12.9554 7.02207 12.7659C7.04082 12.7069 7.0605 12.6469 7.08113 12.5878C6.76826 12.0724 6.58998 11.4867 6.56269 10.8844C6.52604 10.0751 6.76072 9.27679 7.22948 8.6161C7.69825 7.95542 8.37424 7.47021 9.15019 7.2375C9.45957 7.14375 9.66582 6.8625 9.66582 6.54375V6.53437C9.66582 4.52812 11.2877 2.90625 13.2939 2.90625C13.8189 2.90625 14.3158 3.01875 14.7658 3.21563C15.4783 3.53438 16.3221 3.4125 16.9221 2.90625C17.7112 2.24597 18.7057 1.88131 19.7346 1.875H19.8658ZM6.55332 18.2812H3.88707C4.64269 19.005 5.53425 19.365 6.55332 19.5403V18.2812ZM6.55332 17.3438V15.8063C6.55332 15.4847 6.56832 15.1659 6.59832 14.8509C6.25136 14.9942 5.92555 15.1841 5.62988 15.4153C5.06832 15.8541 4.55738 16.4775 4.0905 17.3438H6.55332ZM24.1389 14.0409C23.7864 12.1933 22.7796 10.5348 21.3032 9.36936C19.8268 8.20395 17.9798 7.60983 16.1008 7.69594C11.8071 7.88062 8.42832 11.4853 8.42832 15.8063V25.5C8.42832 26.4328 9.16894 27.1819 10.0568 27.1875H10.0605C10.3282 27.1887 10.5922 27.1247 10.8296 27.0008C11.0669 26.877 11.2705 26.6972 11.4227 26.4769L11.4246 26.4741C11.9749 25.7053 13.1458 25.6678 13.7074 26.4834C14.0111 26.9128 14.5005 27.1875 15.0564 27.1875C15.3221 27.1862 15.5835 27.1211 15.8187 26.9978C16.054 26.8745 16.2562 26.6965 16.4083 26.4788L16.4121 26.4741C16.9614 25.7053 18.1333 25.6678 18.6949 26.4834C18.9986 26.9128 19.488 27.1875 20.0439 27.1875C20.3096 27.1862 20.571 27.1211 20.8062 26.9978C21.0415 26.8745 21.2437 26.6965 21.3958 26.4788L21.3996 26.4741C21.9489 25.7053 23.1208 25.6678 23.6824 26.4834C23.9861 26.9128 24.4755 27.1875 25.0314 27.1875C25.9314 27.1875 26.6599 26.4656 26.6721 25.5684C26.6671 25.4472 26.6527 25.3265 26.6289 25.2075L24.1418 14.0559L24.1389 14.0409Z" fill="#BD4141" />
                        </svg>
                        Chicken
                    </div>
                </button>
                <button class="buttonbox">
                    <div class="beefbox">
                        <svg style="position: absolute; margin-left: -35px" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                            <path d="M12.1883 22.5C12.1883 22.7486 12.0896 22.9871 11.9137 23.1629C11.7379 23.3387 11.4995 23.4375 11.2508 23.4375H9.37583C9.12719 23.4375 8.88874 23.3387 8.71292 23.1629C8.5371 22.9871 8.43833 22.7486 8.43833 22.5C8.43833 22.2514 8.5371 22.0129 8.71292 21.8371C8.88874 21.6613 9.12719 21.5625 9.37583 21.5625H11.2508C11.4995 21.5625 11.7379 21.6613 11.9137 21.8371C12.0896 22.0129 12.1883 22.2514 12.1883 22.5ZM20.6258 21.5625H18.7508C18.5022 21.5625 18.2637 21.6613 18.0879 21.8371C17.9121 22.0129 17.8133 22.2514 17.8133 22.5C17.8133 22.7486 17.9121 22.9871 18.0879 23.1629C18.2637 23.3387 18.5022 23.4375 18.7508 23.4375H20.6258C20.8745 23.4375 21.1129 23.3387 21.2887 23.1629C21.4646 22.9871 21.5633 22.7486 21.5633 22.5C21.5633 22.2514 21.4646 22.0129 21.2887 21.8371C21.1129 21.6613 20.8745 21.5625 20.6258 21.5625ZM11.7196 15.9375C11.9977 15.9375 12.2696 15.855 12.5009 15.7005C12.7321 15.546 12.9124 15.3264 13.0188 15.0694C13.1252 14.8124 13.1531 14.5297 13.0988 14.2569C13.0446 13.9841 12.9106 13.7335 12.714 13.5369C12.5173 13.3402 12.2667 13.2063 11.9939 13.152C11.7211 13.0978 11.4384 13.1256 11.1814 13.232C10.9245 13.3385 10.7048 13.5187 10.5503 13.75C10.3958 13.9812 10.3133 14.2531 10.3133 14.5312C10.3133 14.9042 10.4615 15.2619 10.7252 15.5256C10.9889 15.7893 11.3466 15.9375 11.7196 15.9375ZM18.2821 15.9375C18.5602 15.9375 18.8321 15.855 19.0634 15.7005C19.2946 15.546 19.4749 15.3264 19.5813 15.0694C19.6877 14.8124 19.7156 14.5297 19.6613 14.2569C19.6071 13.9841 19.4731 13.7335 19.2765 13.5369C19.0798 13.3402 18.8292 13.2063 18.5564 13.152C18.2836 13.0978 18.0009 13.1256 17.7439 13.232C17.487 13.3385 17.2673 13.5187 17.1128 13.75C16.9583 13.9812 16.8758 14.2531 16.8758 14.5312C16.8758 14.9042 17.024 15.2619 17.2877 15.5256C17.5514 15.7893 17.9091 15.9375 18.2821 15.9375ZM28.6403 14.3109C28.4645 14.5262 28.243 14.6997 27.9919 14.8189C27.7408 14.9381 27.4663 14.9999 27.1883 15H23.4383V18.75C24.2254 19.3403 24.8068 20.1633 25.1001 21.1023C25.3935 22.0414 25.3839 23.049 25.0728 23.9823C24.7617 24.9157 24.1648 25.7274 23.3667 26.3027C22.5685 26.878 21.6097 27.1875 20.6258 27.1875H9.37583C8.39201 27.1875 7.43312 26.878 6.635 26.3027C5.83688 25.7274 5.23999 24.9157 4.92888 23.9823C4.61777 23.049 4.60821 22.0414 4.90155 21.1023C5.19489 20.1633 5.77627 19.3403 6.56333 18.75V15H2.81333C2.53757 14.9995 2.2653 14.9383 2.01593 14.8205C1.76656 14.7028 1.54623 14.5315 1.37064 14.3189C1.19505 14.1063 1.06852 13.8575 1.00008 13.5904C0.931634 13.3233 0.922955 13.0443 0.974661 12.7734C1.27526 11.2875 2.07989 9.95111 3.25243 8.99018C4.42497 8.02926 5.89344 7.50285 7.40943 7.5H7.60161C6.97599 6.89017 6.47884 6.16121 6.1395 5.35613C5.80016 4.55106 5.62551 3.68617 5.62583 2.8125C5.62583 2.56386 5.7246 2.3254 5.90042 2.14959C6.07624 1.97377 6.31469 1.875 6.56333 1.875C6.81197 1.875 7.05043 1.97377 7.22624 2.14959C7.40206 2.3254 7.50083 2.56386 7.50083 2.8125C7.50083 4.0557 7.99469 5.24799 8.87377 6.12706C9.75285 7.00614 10.9451 7.5 12.1883 7.5H17.8133C18.4289 7.5 19.0384 7.37875 19.6072 7.14319C20.1759 6.90762 20.6926 6.56234 21.1279 6.12706C21.5632 5.69179 21.9084 5.17504 22.144 4.60633C22.3796 4.03762 22.5008 3.42807 22.5008 2.8125C22.5008 2.56386 22.5996 2.3254 22.7754 2.14959C22.9512 1.97377 23.1897 1.875 23.4383 1.875C23.687 1.875 23.9254 1.97377 24.1012 2.14959C24.2771 2.3254 24.3758 2.56386 24.3758 2.8125C24.3762 3.68617 24.2015 4.55106 23.8622 5.35613C23.5228 6.16121 23.0257 6.89017 22.4001 7.5H22.5922C24.1082 7.50285 25.5767 8.02926 26.7492 8.99018C27.9218 9.95111 28.7264 11.2875 29.027 12.7734C29.0802 13.0424 29.0732 13.3197 29.0063 13.5856C28.9394 13.8515 28.8144 14.0992 28.6403 14.3109ZM8.43833 17.9062C8.74696 17.8441 9.061 17.8127 9.37583 17.8125H20.6258C20.9407 17.8127 21.2547 17.8441 21.5633 17.9062V12.1875C21.5633 11.4416 21.267 10.7262 20.7396 10.1988C20.2121 9.67132 19.4968 9.375 18.7508 9.375H11.2508C10.5049 9.375 9.78954 9.67132 9.26209 10.1988C8.73465 10.7262 8.43833 11.4416 8.43833 12.1875V17.9062ZM6.56333 13.125V12.1875C6.56163 11.173 6.89077 10.1856 7.50083 9.375H7.40708C6.32699 9.37676 5.2805 9.75062 4.4438 10.4336C3.60709 11.1167 3.03129 12.0671 2.81333 13.125H6.56333ZM23.4383 22.5C23.4383 21.7541 23.142 21.0387 22.6146 20.5113C22.0871 19.9838 21.3718 19.6875 20.6258 19.6875H9.37583C8.62991 19.6875 7.91454 19.9838 7.38709 20.5113C6.85965 21.0387 6.56333 21.7541 6.56333 22.5C6.56333 23.2459 6.85965 23.9613 7.38709 24.4887C7.91454 25.0162 8.62991 25.3125 9.37583 25.3125H20.6258C21.3718 25.3125 22.0871 25.0162 22.6146 24.4887C23.142 23.9613 23.4383 23.2459 23.4383 22.5ZM27.1883 13.125C26.9706 12.067 26.3948 11.1164 25.5581 10.4334C24.7213 9.75032 23.6747 9.37654 22.5946 9.375H22.5008C23.1109 10.1856 23.44 11.173 23.4383 12.1875V13.125H27.1883Z" fill="#BD4141" />
                        </svg>
                        Beef
                    </div>
                </button>
                <button class="buttonbox">
                    <div class="seafoodbox">
                        <svg style="position: absolute; margin-left: -35px" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                            <path d="M22.8665 20.178H27.8465V21.678H23.7065C25.2226 22.8542 26.3523 24.4568 26.9505 26.28L25.5305 26.764C24.9367 24.9285 23.7012 23.3685 22.0505 22.37C21.4776 22.8898 20.7509 23.2086 19.9805 23.278L16.8745 25.97H13.0405L9.97047 23.246C9.1706 23.1762 8.40962 22.8699 7.78447 22.366C6.13073 23.3644 4.89289 24.9261 4.29847 26.764L2.87847 26.28C3.47719 24.4571 4.60682 22.8546 6.12247 21.678H1.98047V20.178H6.96847L8.69447 18.824L6.66647 15.514C6.48778 15.5441 6.30746 15.5635 6.12647 15.572C5.58032 15.5809 5.03803 15.479 4.5324 15.2724C4.02676 15.0657 3.56828 14.7587 3.18467 14.3699C2.80105 13.981 2.50028 13.5184 2.30052 13.01C2.10076 12.5016 2.00617 11.958 2.02247 11.412C2.02247 7.25204 5.98047 3.09204 5.98047 3.09204L4.50647 11.986L7.95847 11.984L9.98047 5.97004V11.962C9.89988 13.0495 9.39834 14.0626 8.58247 14.786L10.2905 17.574L10.4585 17.442C11.7668 16.5129 13.3318 16.0138 14.9365 16.0138C16.5412 16.0138 18.1061 16.5129 19.4145 17.442L19.5345 17.536L21.2745 14.706C20.5221 13.9812 20.0641 13.004 19.9885 11.962V5.97004L21.9545 11.984L25.4645 11.986L23.9905 3.09204C23.9905 3.09204 27.9545 7.25204 27.9545 11.412C27.9705 11.9586 27.8755 12.5028 27.6751 13.0116C27.4748 13.5204 27.1733 13.9833 26.7889 14.3722C26.4045 14.7611 25.9451 15.0679 25.4387 15.2742C24.9322 15.4804 24.3892 15.5817 23.8425 15.572C23.6116 15.5646 23.3816 15.5398 23.1545 15.498L21.1345 18.79L22.8145 20.108C22.8405 20.128 22.8445 20.156 22.8665 20.178Z" fill="#BD4141" />
                        </svg>
                        Seafood
                    </div>
                </button>
            </div>

            <div id="menuContainer" class="lowerbox">
                <h1>Loading...</h1>
            </div>
            <!-- This is the template for menus -->
            <template data-menu-template>
                <div class="foodcard1">
                    <div class="cardpic">
                        <img data-food-image>
                    </div>
                    <div class="cardinfo">
                        <h3 data-food-name>Bacon Bliss Burger</h3>
                        <p data-food-description>Juicy beef patty with crispy pork bacon, fresh lettuce, onion, tomato, and a side of golden fries.</p>
                        <h2 data-food-price>₱ 400</h2>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <div id="papapapoppop"></div>

    <template data-menu-popout>
        <form data-edit-menu-form>
            <div class="editcard">
                <div class="editcardpic">
                    <img data-food-image>
                </div>
                <div class="editcardinfo">
                    <div class="exitedit" data-edit-close-form>
                        <img src="../images/ex.svg">
                    </div><br>
                    <input class="foodname" type="text" name="input_name" data-food-name required><br>
                    <textarea class="fooddesc" name="input_description" data-food-description required></textarea><br>
                    <span class="peso">₱<input class="foodprice" type="text" name="input_price" data-food-price required></span>
                    <input class="disc" type="number" name="input_discount" data-food-discount required><span class="percent">%</span><br>
                    <input class="foodsub" type="submit">
                </div>
            </div>
        </form>
    </template>


    <script src="../js/navbar-ad.js"></script>
    <script src="../js/managemenuedit-ad.js"></script>
</body>

</html>