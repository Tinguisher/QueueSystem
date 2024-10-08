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
	<title>SnapServe | Addmin Summary</title>
    <link rel="icon" type="image/png" href="../images/bacon.png">
	<link rel="stylesheet" href="../stylesheets/summary.css">
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

		<table class="navTable" style="margin-top: 33px; margin-left: 495px; position: absolute;">
			<tr>
				<td style="width: 180px;"><a href="./home-ad.php" target="_top">Home</a></td>
				<td style="width: 215px;"><a href="./queueorder-ad.php" target="_top">Queue Order</a></td>
				<td style="width: 236px;"><a href="./managemenu-ad.php" target="_top">Manage Menu</a></td>
				<td style="width: 160px;"><a href="./history-ad.php" target="_top" style="color: #BD4141;"><b>History</b></a>
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
				<li class="dropdown-list-item">
					<svg id="icons" xmlns="http://www.w3.org/2000/svg" width="22" height="20" viewBox="0 0 22 20" fill="none">
						<path d="M4.45633 10.5251L1.99233 12.9546C1.45233 13.487 1.18233 13.7536 1.08833 13.9794C0.875327 14.4927 1.05833 15.0632 1.52133 15.3336C1.72533 15.4517 2.09233 15.4889 2.82633 15.5632C3.24133 15.6051 3.44833 15.6251 3.62133 15.6889C3.81475 15.7603 3.98959 15.8709 4.13376 16.0129C4.27792 16.155 4.38798 16.3252 4.45633 16.5117C4.52033 16.6832 4.54133 16.887 4.58433 17.2965C4.65833 18.0203 4.69633 18.3822 4.81633 18.5822C5.09033 19.0394 5.66933 19.2184 6.18933 19.0089C6.41933 18.9175 6.68933 18.6517 7.22933 18.1184L11.0003 14.3994L14.7713 18.1184C15.3113 18.6517 15.5813 18.9175 15.8113 19.0089C16.3313 19.2184 16.9103 19.0394 17.1843 18.5822C17.3043 18.3822 17.3413 18.0203 17.4163 17.2965C17.4593 16.887 17.4803 16.6832 17.5443 16.5117C17.6883 16.1289 17.9903 15.8308 18.3793 15.6889C18.5523 15.6251 18.7593 15.6051 19.1743 15.5632C19.9083 15.4889 20.2753 15.4517 20.4793 15.3336C20.9423 15.0632 21.1253 14.4927 20.9123 13.9794C20.8183 13.7536 20.5483 13.487 20.0083 12.9546L17.5443 10.5251M10.1463 5.78508C10.5263 5.1346 10.7163 4.81079 11.0003 4.81079C11.2843 4.81079 11.4743 5.1346 11.8543 5.78508L11.9523 5.9527C12.0603 6.13746 12.1143 6.22889 12.1983 6.28984C12.2833 6.35079 12.3883 6.37365 12.5983 6.41841L12.7883 6.46031C13.5263 6.61936 13.8953 6.69841 13.9833 6.96698C14.0713 7.23651 13.8193 7.51651 13.3163 8.07651L13.1863 8.22127C13.0433 8.38032 12.9713 8.45936 12.9393 8.55841C12.9073 8.65746 12.9183 8.76317 12.9393 8.97555L12.9593 9.16889C13.0353 9.91651 13.0733 10.2908 12.8443 10.4565C12.6143 10.6222 12.2683 10.4708 11.5773 10.1679L11.3993 10.0898C11.2023 10.0041 11.1043 9.96127 11.0003 9.96127C10.8963 9.96127 10.7983 10.0041 10.6013 10.0898L10.4233 10.1679C9.73233 10.4717 9.38633 10.6222 9.15633 10.4565C8.92633 10.2908 8.96533 9.91651 9.04133 9.16889L9.06133 8.97555C9.08233 8.76317 9.09333 8.65746 9.06133 8.55841C9.02933 8.46032 8.95733 8.38032 8.81433 8.22127L8.68433 8.07651C8.18133 7.51651 7.92933 7.23651 8.01733 6.96698C8.10533 6.69841 8.47433 6.61936 9.21233 6.46031L9.40233 6.41841C9.61233 6.37365 9.71733 6.35174 9.80233 6.28984C9.88633 6.22889 9.94033 6.13746 10.0483 5.9527L10.1463 5.78508Z" stroke="#FFF" stroke-width="1.5" />
						<path d="M4.49945 5.18896C3.90022 6.61452 3.83608 8.19339 4.31788 9.65879C4.79967 11.1242 5.79786 12.3863 7.14378 13.2317C8.48969 14.0772 10.1008 14.4543 11.7049 14.2993C13.309 14.1442 14.8077 13.4665 15.9478 12.3807C17.0879 11.2949 17.7995 9.86757 17.9623 8.33986C18.1251 6.81215 17.7292 5.27776 16.8414 3.99593C15.9536 2.71411 14.6284 1.76345 13.0898 1.3046C11.5511 0.845749 9.8933 0.906833 8.39646 1.47753" stroke="#FFF" stroke-width="1.5" stroke-linecap="round" />
					</svg>
					<p>Become a SnapPrime</p>
				</li>
				<li class="dropdown-list-item"> <svg id="icons" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
						<path d="M5 22.5C5 21.1739 5.52678 19.9021 6.46447 18.9645C7.40215 18.0268 8.67392 17.5 10 17.5H20C21.3261 17.5 22.5979 18.0268 23.5355 18.9645C24.4732 19.9021 25 21.1739 25 22.5C25 23.163 24.7366 23.7989 24.2678 24.2678C23.7989 24.7366 23.163 25 22.5 25H7.5C6.83696 25 6.20107 24.7366 5.73223 24.2678C5.26339 23.7989 5 23.163 5 22.5Z" stroke="#FFF" stroke-width="2" stroke-linejoin="round" />
						<path d="M15 12.5C17.0711 12.5 18.75 10.8211 18.75 8.75C18.75 6.67893 17.0711 5 15 5C12.9289 5 11.25 6.67893 11.25 8.75C11.25 10.8211 12.9289 12.5 15 12.5Z" stroke="#FFF" stroke-width="2" />
					</svg>
					<p>Profile</p>
				</li>
				<li class="dropdown-list-item"><svg id="icons" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<path d="M3 2H5V4H7V6H5V20H19V6H17V4H19V2H21V22H3V2ZM15 4V2H17V4H15ZM13 4H15V6H13V4ZM11 4V2H13V4H11ZM9 4H11V6H9V4ZM9 4V2H7V4H9ZM17 8H7V10H17V8ZM7 12H17V14H7V12ZM17 18V16H13V18H17Z" fill="#FFF" />
					</svg>
					<p>Order History</p>
				</li>
				<a href="loginfrfr.html" target="_top">
					<li onclick="() => {window.location.replace ='/loginfrfr.html'}" class="dropdown-list-item"> <svg id="icons" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path d="M5 21C4.45 21 3.97933 20.8043 3.588 20.413C3.19667 20.0217 3.00067 19.5507 3 19V5C3 4.45 3.196 3.97933 3.588 3.588C3.98 3.19667 4.45067 3.00067 5 3H12V5H5V19H12V21H5ZM16 17L14.625 15.55L17.175 13H9V11H17.175L14.625 8.45L16 7L21 12L16 17Z" fill="#FFF" />
						</svg>
						<p>Logout</p>
					</li>
				</a>
			</ul>
		</div>

		<div>
			<p id="headerhistory">History > Summary</p>
		</div>


		<div id="summaryContainer">
			<h1>Loading...</h1>
		</div>

		<template data-food-template>
			<div class="foodinfo">
				<img class="picture" data-food-image>
				<p class="desc" data-food-name></p><br><br><br><br>
				<p class="desc" data-food-time>Time to cook: 20 Mins</p><br><br><br><br>
				<p class="desc" data-food-price></p><br><br><br><br>
				<p class="desc" data-food-drink></p><br><br><br><br>
				<p class="desc" data-food-discount></p><br><br><br><br>
				<hr>
			</div>
		</template>	
	</div>
	<script defer src="../js/summary-ad.js"></script>
</body>

</html>