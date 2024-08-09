<?php
// make a session variable
session_start();

// if there is session
if (isset($_SESSION['id']) || isset($_SESSION['authtype'])) {
	// access database
	$mysqli = require_once "../contexts/database.php";

	// make a string for sql to be used
	$sql = "SELECT CONCAT(firstname,' ', lastname) AS name
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
	<meta charset="utf-8" />
	<title>Snap Serve</title>
	<link rel="stylesheet" href="../stylesheets/orderhistory.css">
	<link href='https://fonts.googleapis.com/css?family=Averia Serif Libre' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">
	<link href='https://fonts.googleapis.com/css?family=Rhodium Libre' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Roboto Slab' rel='stylesheet'>
</head>

<body>


	<div style="margin-left: 60px; margin-top: 30px; width: 1800px; height: 126px; border-top: 4px solid #000; border-bottom: 4px solid #000; position: absolute">
		<h1 style="font-family: 'Averia Serif Libre'; font-size: 49px; position: absolute; margin-top: 33px;">Snap Serve
		</h1>

		<table class="navTable" style="margin-top: 33px; margin-left: 680px; position: absolute;">
			<tr>
				<td style="width: 138px;"><a href="./home.php" target="_top">Home</a></td>
				<td style="width: 133px;"><a href="./menu.php" target="_top">Menu</a></td>
				<td style="width: 155px;"><a href="./aboutus.php" target="_top">About Us</a></td>
				</td>
			</tr>
		</table>
		<a href="menu.html" id="navcrcl" style="margin-top: 37.5px; margin-left: 1746px;">
			<svg style="margin-top: 10px; margin-left:10px" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
				<path d="M12.5 26.25H17.5C17.5 27.625 16.375 28.75 15 28.75C13.625 28.75 12.5 27.625 12.5 26.25ZM26.25 23.75V25H3.75V23.75L6.25 21.25V13.75C6.25 9.875 8.75 6.5 12.5 5.375V5C12.5 3.625 13.625 2.5 15 2.5C16.375 2.5 17.5 3.625 17.5 5V5.375C21.25 6.5 23.75 9.875 23.75 13.75V21.25L26.25 23.75ZM21.25 13.75C21.25 10.25 18.5 7.5 15 7.5C11.5 7.5 8.75 10.25 8.75 13.75V22.5H21.25V13.75Z" fill="#FFFDF1" />
			</svg>
		</a>

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
				<li class="dropdown-list-item"> <svg id="icons" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
						<path d="M5 22.5C5 21.1739 5.52678 19.9021 6.46447 18.9645C7.40215 18.0268 8.67392 17.5 10 17.5H20C21.3261 17.5 22.5979 18.0268 23.5355 18.9645C24.4732 19.9021 25 21.1739 25 22.5C25 23.163 24.7366 23.7989 24.2678 24.2678C23.7989 24.7366 23.163 25 22.5 25H7.5C6.83696 25 6.20107 24.7366 5.73223 24.2678C5.26339 23.7989 5 23.163 5 22.5Z" stroke="#FFF" stroke-width="2" stroke-linejoin="round" />
						<path d="M15 12.5C17.0711 12.5 18.75 10.8211 18.75 8.75C18.75 6.67893 17.0711 5 15 5C12.9289 5 11.25 6.67893 11.25 8.75C11.25 10.8211 12.9289 12.5 15 12.5Z" stroke="#FFF" stroke-width="2" />
					</svg>
					<p>Profile</p>
				</li>
				<li id="orderHistory" class="dropdown-list-item"><svg id="icons" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
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

		<div>
			<p id="headerhistory">Order History</p>
		</div>


		<div id="summaryContainer">
			<h1>Loading...</h1>
		</div>

		<template data-food-template>
			<div class="foodinfo">
				<img class="picture" data-food-image>
				<p class="desc" data-food-name></p><br><br><br><br>
				<p class="desc" data-food-price></p><br><br><br><br>
				<p class="desc" data-food-drink></p><br><br><br><br>
				<p class="desc" data-food-discount></p><br><br><br><br>
				<p class="desc" data-food-date></p><br><br><br><br>
				<hr>
			</div>
		</template>	
	</div>
	<script>
        // convert to json to read the boolean, pass if logged in or not
        var loggedin = <?php echo json_encode(isset($_SESSION['id'])); ?>;
    </script>
	<script defer src="../js/orderhistory.js"></script>
</body>

</html>