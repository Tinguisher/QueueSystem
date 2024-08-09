<?php
// check if there is session
include '../contexts/SessionUser.php';
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<title>SnapServe | About Us</title>
	<link rel="stylesheet" href="../stylesheets/aboutus.css">
	<link href='https://fonts.googleapis.com/css?family=Averia Serif Libre' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">
	<link href='https://fonts.googleapis.com/css?family=Rhodium Libre' rel='stylesheet'>
	<link href='https://fonts.googleapis.com/css?family=Roboto Slab' rel='stylesheet'>

	<link rel="icon" type="image/png" href="../images/bacon.png">
</head>

<body>
	<div style="margin-left: 60px; margin-top: 30px; width: 1800px; height: 126px; border-top: 4px solid #000; border-bottom: 4px solid #000; position: absolute">
		<h1 style="font-family: 'Averia Serif Libre'; font-size: 49px; position: absolute; margin-top: 33px;">SnapServe
		</h1>

		<!--search box-->
		<form id="searchSubmit" style="margin-top: 38px; margin-left: 350px; position: absolute;">
			<input type="text" id="searchInput" placeholder="Search">
			<div id="dropdownSearch"></div>
			<button id="search" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
		</form>
		<!--Home menu about-->
		<table style="margin-top: 33px; margin-left: 931px; position: absolute;">
			<tr>
				<td style="width: 138px;"><a href="./home.php" target="_top">Home</a></td>
				<td style="width: 133px;" id="menn"><a href="./menu.php" target="_top">Menu</a></td>
				<td style="width: 155px;">
					<a href="./aboutus.php" target="_top" style="color:#FF5622;">
						<b>About Us</b>
					</a>
				</td>
			</tr>
		</table>

		<p id="profilename"><?= $user['name'] ?? "Guest"; ?></p>

		<!--Logo for cart-->
		<a href="./menu.php" id="navcrcl" style="margin-top: 37.5px; margin-left: 1746px;">
			<svg style="margin-top: 10px; margin-left:10px" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
				<path d="M0 2.8125C0 2.56386 0.0987721 2.3254 0.274587 2.14959C0.450403 1.97377 0.68886 1.875 0.9375 1.875H3.75C3.95912 1.87506 4.16222 1.94503 4.327 2.0738C4.49177 2.20256 4.60877 2.38272 4.65937 2.58562L5.41875 5.625H27.1875C27.3252 5.62513 27.4611 5.65557 27.5857 5.71416C27.7102 5.77275 27.8204 5.85805 27.9082 5.96401C27.9961 6.06996 28.0596 6.19397 28.0941 6.32722C28.1287 6.46047 28.1335 6.59969 28.1081 6.735L25.2956 21.735C25.2554 21.9498 25.1414 22.1439 24.9733 22.2836C24.8052 22.4232 24.5936 22.4998 24.375 22.5H7.5C7.28144 22.4998 7.06981 22.4232 6.90171 22.2836C6.7336 22.1439 6.61959 21.9498 6.57938 21.735L3.76875 6.76313L3.01875 3.75H0.9375C0.68886 3.75 0.450403 3.65123 0.274587 3.47541C0.0987721 3.2996 0 3.06114 0 2.8125ZM5.81625 7.5L8.27812 20.625H23.5969L26.0588 7.5H5.81625ZM9.375 22.5C8.38044 22.5 7.42661 22.8951 6.72335 23.5984C6.02009 24.3016 5.625 25.2554 5.625 26.25C5.625 27.2446 6.02009 28.1984 6.72335 28.9016C7.42661 29.6049 8.38044 30 9.375 30C10.3696 30 11.3234 29.6049 12.0267 28.9016C12.7299 28.1984 13.125 27.2446 13.125 26.25C13.125 25.2554 12.7299 24.3016 12.0267 23.5984C11.3234 22.8951 10.3696 22.5 9.375 22.5ZM22.5 22.5C21.5054 22.5 20.5516 22.8951 19.8484 23.5984C19.1451 24.3016 18.75 25.2554 18.75 26.25C18.75 27.2446 19.1451 28.1984 19.8484 28.9016C20.5516 29.6049 21.5054 30 22.5 30C23.4946 30 24.4484 29.6049 25.1516 28.9016C25.8549 28.1984 26.25 27.2446 26.25 26.25C26.25 25.2554 25.8549 24.3016 25.1516 23.5984C24.4484 22.8951 23.4946 22.5 22.5 22.5ZM9.375 24.375C9.87228 24.375 10.3492 24.5725 10.7008 24.9242C11.0525 25.2758 11.25 25.7527 11.25 26.25C11.25 26.7473 11.0525 27.2242 10.7008 27.5758C10.3492 27.9275 9.87228 28.125 9.375 28.125C8.87772 28.125 8.40081 27.9275 8.04918 27.5758C7.69754 27.2242 7.5 26.7473 7.5 26.25C7.5 25.7527 7.69754 25.2758 8.04918 24.9242C8.40081 24.5725 8.87772 24.375 9.375 24.375ZM22.5 24.375C22.9973 24.375 23.4742 24.5725 23.8258 24.9242C24.1775 25.2758 24.375 25.7527 24.375 26.25C24.375 26.7473 24.1775 27.2242 23.8258 27.5758C23.4742 27.9275 22.9973 28.125 22.5 28.125C22.0027 28.125 21.5258 27.9275 21.1742 27.5758C20.8225 27.2242 20.625 26.7473 20.625 26.25C20.625 25.7527 20.8225 25.2758 21.1742 24.9242C21.5258 24.5725 22.0027 24.375 22.5 24.375Z" fill="#FFFDF1" />
			</svg>
		</a>
		<!--Drop down menu for the profile-->
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
				<li id="profileButton" class="dropdown-list-item"> <svg id="icons" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
						<path d="M5 22.5C5 21.1739 5.52678 19.9021 6.46447 18.9645C7.40215 18.0268 8.67392 17.5 10 17.5H20C21.3261 17.5 22.5979 18.0268 23.5355 18.9645C24.4732 19.9021 25 21.1739 25 22.5C25 23.163 24.7366 23.7989 24.2678 24.2678C23.7989 24.7366 23.163 25 22.5 25H7.5C6.83696 25 6.20107 24.7366 5.73223 24.2678C5.26339 23.7989 5 23.163 5 22.5Z" stroke="#FFFDF1" stroke-width="2" stroke-linejoin="round" />
						<path d="M15 12.5C17.0711 12.5 18.75 10.8211 18.75 8.75C18.75 6.67893 17.0711 5 15 5C12.9289 5 11.25 6.67893 11.25 8.75C11.25 10.8211 12.9289 12.5 15 12.5Z" stroke="#FFFDF1" stroke-width="2" />
					</svg>
					<p>Profile</p>
				</li>
				<li id="orderHistory" class="dropdown-list-item"><svg id="icons" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<path d="M3 2H5V4H7V6H5V20H19V6H17V4H19V2H21V22H3V2ZM15 4V2H17V4H15ZM13 4H15V6H13V4ZM11 4V2H13V4H11ZM9 4H11V6H9V4ZM9 4V2H7V4H9ZM17 8H7V10H17V8ZM7 12H17V14H7V12ZM17 18V16H13V18H17Z" fill=#FFFDF1>
					</svg>
					<p>Order History</p>
				</li>
				<li id="sessionbutton" class="dropdown-list-item">
					<svg class="icons" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
						<path d="M5 21C4.45 21 3.97933 20.8043 3.588 20.413C3.19667 20.0217 3.00067 19.5507 3 19V5C3 4.45 3.196 3.97933 3.588 3.588C3.98 3.19667 4.45067 3.00067 5 3H12V5H5V19H12V21H5ZM16 17L14.625 15.55L17.175 13H9V11H17.175L14.625 8.45L16 7L21 12L16 17Z" fill="#FFFDF1" />
					</svg>
					<p id="sessiontext">Loading...</p>
				</li>
			</ul>
		</div>

	</div>

	<div>
		<div>
			<p id="aboutus">About Us</p>
		</div>
		<div class="aboutSnap">
			<p id="aboutsnap">About Us | SnapServe</p>
		</div>
		<div class="abouttext">
			<p id="abouttext">Welcome to SnapServe, your go-to destination for fast, delicious, and convenient food.<br>
				At SnapServe, we believe that great food should be quick, easy, and enjoyable.<br>
				Our mission is to revolutionize the fast food experience by combining cutting-edge technology with
				mouthwatering meals.</p>
		</div>
	</div>
	<script>
		// convert to json to read the boolean, pass if logged in or not
		var loggedin = <?php echo json_encode(isset($_SESSION['id'])); ?>;
	</script>
	<script src="../js/aboutus.js"> </script>
</body>

</html>