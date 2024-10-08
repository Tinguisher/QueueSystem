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
	<title>SnapServe | Check Out</title>
	<link rel="stylesheet" href="../stylesheets/check.css">
	<link href='https://fonts.googleapis.com/css?family=Averia Serif Libre' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">
	<link href='https://fonts.googleapis.com/css?family=Rhodium Libre' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Roboto Slab' rel='stylesheet'>
	<link rel="icon" type="image/png" href="../images/bacon.png">
</head>

<body>
	<div style="margin-left: 60px; margin-top: 30px; width: 1800px; height: 126px; border-top: 4px solid #000; border-bottom: 4px solid #000; position: absolute">
		<h1 style="font-family: 'Averia Serif Libre'; font-size: 49px; position: absolute; margin-top: 33px;">Snap Serve</h1>

		<!-- <form style="margin-top: 38px; margin-left: 350px; position: absolute;">
            <input type="text" name="" placeholder="Search">
            <button id="search" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form> -->

		<table style="margin-top: 33px; margin-left: 660px; position: absolute;">
			<tr>
				<td style="width: 150px; text-align: center;"><a href="./home.php" target="_top">Home</a></td>
				<td style="width: 133px;text-align: center;" id="menn"><a href="./menu.php" target="_top" style="color: #FF5622;"><b>Menu</b></a></td>
				<td style="width: 155px;text-align: center;"><a href="./aboutus.php" target="_top">About Us</a></td>
			</tr>
		</table>

		<p id="profilename"><?= $user['name'] ?? "Guest"; ?></p>

		<a href="./menu.php" id="navcrcl" style="margin-top: 37.5px; margin-left: 1746px;">
			<svg style="margin-top: 10px; margin-left:10px" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
				<path d="M0 2.8125C0 2.56386 0.0987721 2.3254 0.274587 2.14959C0.450403 1.97377 0.68886 1.875 0.9375 1.875H3.75C3.95912 1.87506 4.16222 1.94503 4.327 2.0738C4.49177 2.20256 4.60877 2.38272 4.65937 2.58562L5.41875 5.625H27.1875C27.3252 5.62513 27.4611 5.65557 27.5857 5.71416C27.7102 5.77275 27.8204 5.85805 27.9082 5.96401C27.9961 6.06996 28.0596 6.19397 28.0941 6.32722C28.1287 6.46047 28.1335 6.59969 28.1081 6.735L25.2956 21.735C25.2554 21.9498 25.1414 22.1439 24.9733 22.2836C24.8052 22.4232 24.5936 22.4998 24.375 22.5H7.5C7.28144 22.4998 7.06981 22.4232 6.90171 22.2836C6.7336 22.1439 6.61959 21.9498 6.57938 21.735L3.76875 6.76313L3.01875 3.75H0.9375C0.68886 3.75 0.450403 3.65123 0.274587 3.47541C0.0987721 3.2996 0 3.06114 0 2.8125ZM5.81625 7.5L8.27812 20.625H23.5969L26.0588 7.5H5.81625ZM9.375 22.5C8.38044 22.5 7.42661 22.8951 6.72335 23.5984C6.02009 24.3016 5.625 25.2554 5.625 26.25C5.625 27.2446 6.02009 28.1984 6.72335 28.9016C7.42661 29.6049 8.38044 30 9.375 30C10.3696 30 11.3234 29.6049 12.0267 28.9016C12.7299 28.1984 13.125 27.2446 13.125 26.25C13.125 25.2554 12.7299 24.3016 12.0267 23.5984C11.3234 22.8951 10.3696 22.5 9.375 22.5ZM22.5 22.5C21.5054 22.5 20.5516 22.8951 19.8484 23.5984C19.1451 24.3016 18.75 25.2554 18.75 26.25C18.75 27.2446 19.1451 28.1984 19.8484 28.9016C20.5516 29.6049 21.5054 30 22.5 30C23.4946 30 24.4484 29.6049 25.1516 28.9016C25.8549 28.1984 26.25 27.2446 26.25 26.25C26.25 25.2554 25.8549 24.3016 25.1516 23.5984C24.4484 22.8951 23.4946 22.5 22.5 22.5ZM9.375 24.375C9.87228 24.375 10.3492 24.5725 10.7008 24.9242C11.0525 25.2758 11.25 25.7527 11.25 26.25C11.25 26.7473 11.0525 27.2242 10.7008 27.5758C10.3492 27.9275 9.87228 28.125 9.375 28.125C8.87772 28.125 8.40081 27.9275 8.04918 27.5758C7.69754 27.2242 7.5 26.7473 7.5 26.25C7.5 25.7527 7.69754 25.2758 8.04918 24.9242C8.40081 24.5725 8.87772 24.375 9.375 24.375ZM22.5 24.375C22.9973 24.375 23.4742 24.5725 23.8258 24.9242C24.1775 25.2758 24.375 25.7527 24.375 26.25C24.375 26.7473 24.1775 27.2242 23.8258 27.5758C23.4742 27.9275 22.9973 28.125 22.5 28.125C22.0027 28.125 21.5258 27.9275 21.1742 27.5758C20.8225 27.2242 20.625 26.7473 20.625 26.25C20.625 25.7527 20.8225 25.2758 21.1742 24.9242C21.5258 24.5725 22.0027 24.375 22.5 24.375Z" fill="#FFF" />
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
				<!-- <li class="dropdown-list-item">
					<svg class="icons" xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 22 20" fill="none">
						<path d="M4.45633 10.5251L1.99233 12.9546C1.45233 13.487 1.18233 13.7536 1.08833 13.9794C0.875327 14.4927 1.05833 15.0632 1.52133 15.3336C1.72533 15.4517 2.09233 15.4889 2.82633 15.5632C3.24133 15.6051 3.44833 15.6251 3.62133 15.6889C3.81475 15.7603 3.98959 15.8709 4.13376 16.0129C4.27792 16.155 4.38798 16.3252 4.45633 16.5117C4.52033 16.6832 4.54133 16.887 4.58433 17.2965C4.65833 18.0203 4.69633 18.3822 4.81633 18.5822C5.09033 19.0394 5.66933 19.2184 6.18933 19.0089C6.41933 18.9175 6.68933 18.6517 7.22933 18.1184L11.0003 14.3994L14.7713 18.1184C15.3113 18.6517 15.5813 18.9175 15.8113 19.0089C16.3313 19.2184 16.9103 19.0394 17.1843 18.5822C17.3043 18.3822 17.3413 18.0203 17.4163 17.2965C17.4593 16.887 17.4803 16.6832 17.5443 16.5117C17.6883 16.1289 17.9903 15.8308 18.3793 15.6889C18.5523 15.6251 18.7593 15.6051 19.1743 15.5632C19.9083 15.4889 20.2753 15.4517 20.4793 15.3336C20.9423 15.0632 21.1253 14.4927 20.9123 13.9794C20.8183 13.7536 20.5483 13.487 20.0083 12.9546L17.5443 10.5251M10.1463 5.78508C10.5263 5.1346 10.7163 4.81079 11.0003 4.81079C11.2843 4.81079 11.4743 5.1346 11.8543 5.78508L11.9523 5.9527C12.0603 6.13746 12.1143 6.22889 12.1983 6.28984C12.2833 6.35079 12.3883 6.37365 12.5983 6.41841L12.7883 6.46031C13.5263 6.61936 13.8953 6.69841 13.9833 6.96698C14.0713 7.23651 13.8193 7.51651 13.3163 8.07651L13.1863 8.22127C13.0433 8.38032 12.9713 8.45936 12.9393 8.55841C12.9073 8.65746 12.9183 8.76317 12.9393 8.97555L12.9593 9.16889C13.0353 9.91651 13.0733 10.2908 12.8443 10.4565C12.6143 10.6222 12.2683 10.4708 11.5773 10.1679L11.3993 10.0898C11.2023 10.0041 11.1043 9.96127 11.0003 9.96127C10.8963 9.96127 10.7983 10.0041 10.6013 10.0898L10.4233 10.1679C9.73233 10.4717 9.38633 10.6222 9.15633 10.4565C8.92633 10.2908 8.96533 9.91651 9.04133 9.16889L9.06133 8.97555C9.08233 8.76317 9.09333 8.65746 9.06133 8.55841C9.02933 8.46032 8.95733 8.38032 8.81433 8.22127L8.68433 8.07651C8.18133 7.51651 7.92933 7.23651 8.01733 6.96698C8.10533 6.69841 8.47433 6.61936 9.21233 6.46031L9.40233 6.41841C9.61233 6.37365 9.71733 6.35174 9.80233 6.28984C9.88633 6.22889 9.94033 6.13746 10.0483 5.9527L10.1463 5.78508Z" stroke="#FFF" stroke-width="1.5" />
						<path d="M4.49945 5.18896C3.90022 6.61452 3.83608 8.19339 4.31788 9.65879C4.79967 11.1242 5.79786 12.3863 7.14378 13.2317C8.48969 14.0772 10.1008 14.4543 11.7049 14.2993C13.309 14.1442 14.8077 13.4665 15.9478 12.3807C17.0879 11.2949 17.7995 9.86757 17.9623 8.33986C18.1251 6.81215 17.7292 5.27776 16.8414 3.99593C15.9536 2.71411 14.6284 1.76345 13.0898 1.3046C11.5511 0.845749 9.8933 0.906833 8.39646 1.47753" stroke="#FFF" stroke-width="1.5" stroke-linecap="round" />
					</svg>
					<p>Become a SnapPrime</p>
				</li> -->
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
	<div>
		<p id="menu">Check Out</p>
	</div>


	<form id="checkout">
		<div class="deladd">
			<div style="position: absolute; margin-top: 31px; margin-left: 28px;">
				<svg xmlns="http://www.w3.org/2000/svg" width="55" height="55" viewBox="0 0 55 55" fill="none">
					<g clip-path="url(#clip0_844_1140)">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M27.5 4.58301C32.9701 4.58301 38.2161 6.75599 42.0841 10.6239C45.952 14.4919 48.125 19.7379 48.125 25.208C48.125 32.2526 44.2842 38.0184 40.2371 42.1549C38.2151 44.1992 36.0088 46.0526 33.6463 47.6915L32.67 48.3561L32.2117 48.6609L31.3477 49.2109L30.5777 49.6807L29.6244 50.2353C28.9773 50.6046 28.2451 50.7989 27.5 50.7989C26.7549 50.7989 26.0227 50.6046 25.3756 50.2353L24.4223 49.6807L23.2306 48.9474L22.7906 48.6609L21.851 48.0353C19.3023 46.3109 16.9283 44.3414 14.7629 42.1549C10.7158 38.0161 6.875 32.2526 6.875 25.208C6.875 19.7379 9.04798 14.4919 12.9159 10.6239C16.7839 6.75599 22.0299 4.58301 27.5 4.58301ZM27.5 9.16634C23.2455 9.16634 19.1652 10.8564 16.1568 13.8648C13.1484 16.8732 11.4583 20.9535 11.4583 25.208C11.4583 30.5293 14.3733 35.1997 18.0377 38.9488C19.6133 40.5438 21.3163 42.0077 23.1298 43.3259L24.1794 44.073C24.5185 44.3098 24.8447 44.5298 25.1579 44.733L26.0517 45.3059L26.8377 45.7849L27.5 46.1722L28.5427 45.5557L29.3837 45.0286C29.8314 44.7445 30.3103 44.4259 30.8206 44.073L31.8702 43.3259C33.6837 42.0077 35.3867 40.5438 36.9623 38.9488C40.6267 35.202 43.5417 30.5293 43.5417 25.208C43.5417 20.9535 41.8516 16.8732 38.8432 13.8648C35.8348 10.8564 31.7545 9.16634 27.5 9.16634ZM27.5 16.0413C29.9312 16.0413 32.2627 17.0071 33.9818 18.7262C35.7009 20.4453 36.6667 22.7769 36.6667 25.208C36.6667 27.6392 35.7009 29.9707 33.9818 31.6898C32.2627 33.4089 29.9312 34.3747 27.5 34.3747C25.0688 34.3747 22.7373 33.4089 21.0182 31.6898C19.2991 29.9707 18.3333 27.6392 18.3333 25.208C18.3333 22.7769 19.2991 20.4453 21.0182 18.7262C22.7373 17.0071 25.0688 16.0413 27.5 16.0413ZM27.5 20.6247C26.2844 20.6247 25.1186 21.1076 24.2591 21.9671C23.3996 22.8266 22.9167 23.9924 22.9167 25.208C22.9167 26.4236 23.3996 27.5894 24.2591 28.4489C25.1186 29.3085 26.2844 29.7913 27.5 29.7913C28.7156 29.7913 29.8814 29.3085 30.7409 28.4489C31.6004 27.5894 32.0833 26.4236 32.0833 25.208C32.0833 23.9924 31.6004 22.8266 30.7409 21.9671C29.8814 21.1076 28.7156 20.6247 27.5 20.6247Z" fill="black" />
					</g>
					<defs>
						<clipPath id="clip0_844_1140">
							<rect width="55" height="55" fill="white" />
						</clipPath>
					</defs>
				</svg>
			</div>
			<p class="verad">Delivery Address</p>
			<input type="text" name="" placeholder="Address" class="iadd" style="margin-top: 154px;" required>
			<input type="text" name="" placeholder="House/Appartment number" class="iadd" style="margin-top: 231px;" required>
			<input type="text" name="" placeholder="Street" class="iadd" style="margin-top: 308px;" required>
			<input type="text" name="" placeholder="Barangay" class="iadd" style="margin-top: 385px;" required>
			<button class="sub">Submit</button>
		</div>

		<div class="urorder">
			<p id="yodr">Your Order</p>
			<table class="yourorder">
				<thead>
					<tr>
						<th>Food Name</th>
						<th>Qty</th>
						<th>Total</th>
					</tr>
				</thead>

				<!-- container for user orders -->
				<tbody data-user-order-container>
					<tr>
						<td class="foodnm">Loading...</td>
						<td>Loading...</td>
						<td>Loading...</td>
					</tr>
				</tbody>

				<!-- Template for user orders -->
				<template data-user-order-template>
					<tr>
						<td class="foodnm" data-food-name></td>
						<td style="padding: 20px;" data-food-quantity></td>
						<td data-food-price></td>
					</tr>
				</template>
			</table>

			<div class="line">
				<table class="yourorder2">
					<tbody>
						<tr>
							<td class="foodnm2">Subtotal</td>
							<td id="subTotal"></td>
						</tr>
						<tr>
							<td class="foodnm2">Subdelivery</td>
							<td id="deliveryFee"></td>
						</tr>
						<tr>
							<td class="foodnm2">Total</td>
							<td id="totalPrice"></td>
						</tr>
					</tbody>
				</table>
				<button class="btnorder">Order and Proceed to Checkout</button>
			</div>
		</div>

		<!-- <div class="person">
			<p id="prsninfo">Personal Information</p>
			<input type="text" name="" placeholder="Email" class="email">
			<input type="text" name="" placeholder="First Name" class="fname">
			<input type="text" name="" placeholder="Last Name" class="lname">
			<input type="text" name="" placeholder="Mobile Number" class="mobile">
			<button class="savebtn">Save</button>
		</div> -->
	</form>

	<div class="footer">
		<p id="foottitle">SnapServe | <span style="font-size: 20px;font-family: Roboto Slab;">Precision In Every
				Bite</span></p>
		<p class="sectitle" style=" margin-top:67px; margin-left: 744px;">Contact Us</p>
		<p id="no">Number</p>
		<p id="email">Email</p>
		<p class="sectitle" style=" margin-top:67px; margin-left: 1155px;"> Company</p>
		<a class="links" style="margin-top: 125px;  margin-left: 1155px; ">About Us</a>
		<a class="links" style="margin-top: 177px;   margin-left: 1155px;">Become a SnapPrime</a>
		<p class="sectitle" style=" margin-top:67px; margin-left: 1545px;">Links</p>
		<a class="links" style="margin-top: 125px; margin-left: 1545px;">Menu</a>
		<a class="links" style="margin-top: 169px; margin-left: 1545px;">Special Offers</a>
		<div class="bot">
			<p class="part" style="margin-top: 49.5px; margin-left: 82px;">© Copyrights by ARC System Solutions. All
				Rights Reserved.</p>
		</div>
	</div>

	</div>

	<script>
		// convert to json to read the boolean, pass if logged in or not
		var loggedin = <?php echo json_encode(isset($_SESSION['id'])); ?>;
	</script>
	<script defer src="../js/check.js"></script>
</body>

</html>