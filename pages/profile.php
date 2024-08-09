<?php
// make a session variable
session_start();

// if there is session
if (isset($_SESSION['id']) || isset($_SESSION['authtype'])) {
	// access database
	$mysqli = require_once "../contexts/database.php";

	// make a string for sql to be used
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

	// if there is no user found
	if (!$user) {
		// destroy each data in session
		session_unset();

		// destroy the sessions made
		session_destroy();

		// go to home
		header('Location: ./home.php');
		exit();
	}

	// free data and close statement and database
	$result->free();
	$stmt->close();
	$mysqli->close();
}

// if there is no session logged in
else {
	// go to home
	header('Location: ./home.php');
	exit();
}

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../stylesheets/profile.css">
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
                    <li><a href="./home.php">Home</a></li>
                    <li><a href="./menu.php">Menu</a></li>
                    <li><a href="./aboutus.php">About Us</a></li>
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
                    <a href="./profile.php">Profile</a>
                    <a id="sessionbutton">Logout</a>
                    </div>
                </button>
                <a href="./menu.php" class="navcrcl" style=" margin-left: 1746px;">
            <svg style="margin-top: 10px; margin-left:10px" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                <path d="M0 2.8125C0 2.56386 0.0987721 2.3254 0.274587 2.14959C0.450403 1.97377 0.68886 1.875 0.9375 1.875H3.75C3.95912 1.87506 4.16222 1.94503 4.327 2.0738C4.49177 2.20256 4.60877 2.38272 4.65937 2.58562L5.41875 5.625H27.1875C27.3252 5.62513 27.4611 5.65557 27.5857 5.71416C27.7102 5.77275 27.8204 5.85805 27.9082 5.96401C27.9961 6.06996 28.0596 6.19397 28.0941 6.32722C28.1287 6.46047 28.1335 6.59969 28.1081 6.735L25.2956 21.735C25.2554 21.9498 25.1414 22.1439 24.9733 22.2836C24.8052 22.4232 24.5936 22.4998 24.375 22.5H7.5C7.28144 22.4998 7.06981 22.4232 6.90171 22.2836C6.7336 22.1439 6.61959 21.9498 6.57938 21.735L3.76875 6.76313L3.01875 3.75H0.9375C0.68886 3.75 0.450403 3.65123 0.274587 3.47541C0.0987721 3.2996 0 3.06114 0 2.8125ZM5.81625 7.5L8.27812 20.625H23.5969L26.0588 7.5H5.81625ZM9.375 22.5C8.38044 22.5 7.42661 22.8951 6.72335 23.5984C6.02009 24.3016 5.625 25.2554 5.625 26.25C5.625 27.2446 6.02009 28.1984 6.72335 28.9016C7.42661 29.6049 8.38044 30 9.375 30C10.3696 30 11.3234 29.6049 12.0267 28.9016C12.7299 28.1984 13.125 27.2446 13.125 26.25C13.125 25.2554 12.7299 24.3016 12.0267 23.5984C11.3234 22.8951 10.3696 22.5 9.375 22.5ZM22.5 22.5C21.5054 22.5 20.5516 22.8951 19.8484 23.5984C19.1451 24.3016 18.75 25.2554 18.75 26.25C18.75 27.2446 19.1451 28.1984 19.8484 28.9016C20.5516 29.6049 21.5054 30 22.5 30C23.4946 30 24.4484 29.6049 25.1516 28.9016C25.8549 28.1984 26.25 27.2446 26.25 26.25C26.25 25.2554 25.8549 24.3016 25.1516 23.5984C24.4484 22.8951 23.4946 22.5 22.5 22.5ZM9.375 24.375C9.87228 24.375 10.3492 24.5725 10.7008 24.9242C11.0525 25.2758 11.25 25.7527 11.25 26.25C11.25 26.7473 11.0525 27.2242 10.7008 27.5758C10.3492 27.9275 9.87228 28.125 9.375 28.125C8.87772 28.125 8.40081 27.9275 8.04918 27.5758C7.69754 27.2242 7.5 26.7473 7.5 26.25C7.5 25.7527 7.69754 25.2758 8.04918 24.9242C8.40081 24.5725 8.87772 24.375 9.375 24.375ZM22.5 24.375C22.9973 24.375 23.4742 24.5725 23.8258 24.9242C24.1775 25.2758 24.375 25.7527 24.375 26.25C24.375 26.7473 24.1775 27.2242 23.8258 27.5758C23.4742 27.9275 22.9973 28.125 22.5 28.125C22.0027 28.125 21.5258 27.9275 21.1742 27.5758C20.8225 27.2242 20.625 26.7473 20.625 26.25C20.625 25.7527 20.8225 25.2758 21.1742 24.9242C21.5258 24.5725 22.0027 24.375 22.5 24.375Z" fill="#FFF" />
            </svg>
        </a>
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
    <script src="../js/profile.js"></script>
</body>

</html>