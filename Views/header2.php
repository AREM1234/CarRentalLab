<!DOCTYPE html>
<html>
	<head>
	<meta charset="UTF-8">
	<title>Car Rentals</title>
	<link rel="stylesheet" type="text/css" href="..\css\materialize.css">
	</head>
	<body>
		<nav class="white">
			<div class="nav-wrapper">
				<?php if(isset($_SESSION["Admin"])): ?>
					<ul class="left hide-on-med-and-down">
						<li ><a href="index.php" class="black-text">Rented Cars</a></li>
						<li ><a href="allCars.php" class="black-text">All Cars</a></li>
						<li ><a href="addCarForm.php" class="black-text">Add Car</a></li>
						<li ><a href="rentalHistory.php" class="black-text">Rental History</a></li>
					</ul>
					<ul class="right hide-on-med-and-down">
						<li ><a href="logout.php" class="black-text">Logout</a></li>
					</ul>
				<?php else: ?>
					<ul class="left hide-on-med-and-down">
						<li ><a href="../index.php" class="black-text">Rent A Car</a></li>
						<li ><a href="../carReturn.php" class="black-text">Return a Car</a></li>
					</ul>
					<ul class="right hide-on-med-and-down">
						<li ><a href="login.php" class="black-text">Admin Login</a></li>
					</ul>
				<?php endif; ?>
				
			</div>
		</nav>
		<main>