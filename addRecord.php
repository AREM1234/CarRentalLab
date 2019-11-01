<?php 
	session_start();
	unset($_SESSION["Admin"]);
	require_once("Models/DBConnect.php");
	require_once("Models/Customers.php");
	require_once("Models/Cars.php");
	require_once("Models/Rentals.php");
	
	$FName = trim(filter_input(INPUT_POST, "FName", FILTER_SANITIZE_STRING, FILTER_SANITIZE_SPECIAL_CHARS));
	$LName = trim(filter_input(INPUT_POST, "LName", FILTER_SANITIZE_STRING, FILTER_SANITIZE_SPECIAL_CHARS));
	$PhoneNumber = trim(filter_input(INPUT_POST, "PhoneNumber", FILTER_SANITIZE_STRING));
	$rentalCode = trim(filter_input(INPUT_POST, "rentalCode", FILTER_SANITIZE_STRING, FILTER_SANITIZE_SPECIAL_CHARS));
	$rentalDays = trim(filter_input(INPUT_POST, "rentalDays", FILTER_SANITIZE_NUMBER_INT));
	$carID =  trim(filter_input(INPUT_POST, "carID", FILTER_SANITIZE_NUMBER_INT));
	$initalCost =  trim(filter_input(INPUT_POST, "initalCost", FILTER_SANITIZE_NUMBER_FLOAT));

	if(empty($carID) || !is_numeric($carID)){
		header("Location: index.php");
		die;
	}
	
	if(empty($FName) || empty($LName) || empty($PhoneNumber) || empty($rentalCode) || empty($rentalDays)){
		header("Location: rentalForm.php?carID=" . $carID . "&error=Please fill out all fields.");
		die;
	}

	if(!is_numeric($rentalDays)){
		header("Location: rentalForm.php?carID=" . $carID . "&error=Somthing went wrong please try again.");
		die;
	}

	$customerID = CreateCustomer($FName, $LName, $PhoneNumber);

	if(!is_numeric($customerID)){
		header("Location: rentalForm.php?carID=" . $carID . "&error=Somthing went wrong please try again.");
		die;
	}

	$rentalID = CreateRental($customerID, $carID, $rentalDays, $initalCost, $rentalCode);

	if(!is_numeric($rentalID)){
		header("Location: rentalForm.php?carID=" . $carID . "&error=Somthing went wrong please try again.");
		die;
	}

	makeUnavailable($carID);

	header("Location: rentalFinalized.php?carID=" . $carID);

?>

	