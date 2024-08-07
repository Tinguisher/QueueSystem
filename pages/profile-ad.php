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
                        <li><a href="./home-ad.html">Home</a></li>
                        <li><a href="./team-ad.html">Team</a></li>
                        <li><a href="./queueorder-ad.html">Queue Order</a></li>
                        <li><a href="./managemenu-ad.html">Manage Menu</a></li>
                        <li><a href="./history-ad.html">History</a></li>
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
                            <a href="#profile">Profile</a>
                            <a href="#logout">Logout</a>
                          </div>
                    </button>
                </div>
                <!--Profile and notif end-->
            </div>
            <div class="profile-line"><a>Profile</a></div>
            <div class="personalinfo">
                <form>
                    <div class="topinputs">
                        <label class="protext" for="fname">First Name</label><br>
                        <input class="probox" type="text" id="fname"  name="fname" placeholder="Kenneth" required>
                    </div>
                
                    <br>
                
                    <div class="input">
                        <label class="protext" for="lname">Last Name</label><br>
                        <input class="probox" type="text" id="lname"  name="lname" placeholder="Binay" required>
                    </div>
                    
                    <br>
                    
                    <div class="botinputs">
                        <label class="protext" for="email">Email</label><br>
                        <input class="probox" type="email" id="email" name="email" placeholder="kenneth@gmail.com">
                    </div>

                    <div class="subbox">
                        <input class="submission" type="submit">
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>