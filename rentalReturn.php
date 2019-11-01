<?php 
	session_start();
	unset($_SESSION["Admin"]);
	require_once("Models/DBConnect.php");
	require_once("Models/Cars.php");
	require_once("Models/Rentals.php");

	$carName = trim(filter_input(INPUT_POST, "carName", FILTER_SANITIZE_STRING, FILTER_SANITIZE_SPECIAL_CHARS));
	$rentalCode = trim(filter_input(INPUT_POST, "rentalCode", FILTER_SANITIZE_STRING, FILTER_SANITIZE_SPECIAL_CHARS));
	$mileage = trim(filter_input(INPUT_POST, "mileage", FILTER_SANITIZE_NUMBER_INT));

	if(empty($carName) || empty($rentalCode) || empty($mileage)){
		header("Location: carReturn.php?error=Please fill out all fields.");
		die;
	}

	$car = getCarByName($carName);

	if($car['Available'] != 0){
		header("Location: carReturn.php?error=Invalid Car Name or Password.");
		die;
	}

	if($car['CarID'] == ""){
		header("Location: carReturn.php?error=Invalid Car Name or Password.");
		die;
	}

	$rental = getCarsCurrentRental($car['CarID'], $rentalCode);

	if($mileage < $car['TotalMileage']){
		header("Location: carReturn.php?error=Invalid mileage.");
		die;
	}

	$mileageAdded = $mileage - $car['TotalMileage'];

	ChangeCarsMileage($car['CarID'], $mileage);
	
	$totalCost = $rental['InitialCost'] + ($mileageAdded * 0.32);

	round($totalCost, 2);

	$rentalReturn = CreateRentalReturn($rental['RentalID'], $mileageAdded, $totalCost);

	makeAvailable($rental['RentalCar']);

	header("Location: rentalReturnDetails.php?rentalReturn=" . $rentalReturn);

?>
