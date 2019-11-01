<?php 
	session_start();
	if(!isset($_SESSION["Admin"])){
		header("Location: ../index.php");
		die;
	}
	require_once("../Models/DBConnect.php");
	require_once("../Models/Cars.php");

	$CarName = trim(filter_input(INPUT_POST, "CarName", FILTER_SANITIZE_STRING));
	$Seats = trim(filter_input(INPUT_POST, "Seats", FILTER_SANITIZE_STRING));
	$TotalMileage = trim(filter_input(INPUT_POST, "TotalMileage", FILTER_SANITIZE_STRING));
	$Model = trim(filter_input(INPUT_POST, "Model", FILTER_SANITIZE_STRING));

	if(empty($CarName) || empty($Seats) || empty($TotalMileage) || empty($Model)){
		header("Location: addCarForm.php?error=Please Fill Out All Fields");
		die;
	}

	$cars = getAllCars();

	foreach ($cars as $car) {
		if($car['CarName'] === $CarName){
			header("Location: addCarForm.php?error=Car Name must be unique.");
			die;

		}
	}

	$target_dir = "../images/";
	$target_file = $target_dir . basename($_FILES["CarImage"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


    $check = getimagesize($_FILES["CarImage"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
	
	if (file_exists($target_file)) {
	    $uploadOk = 0;
	}

	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    $uploadOk = 0;
	}

	if ($uploadOk == 0) {
	   header("Location: addCarForm.php?error=An Issue occured with your image.");
		die;
	} else {
	    if (move_uploaded_file($_FILES["CarImage"]["tmp_name"], $target_file)) {
	    	$CarImage =  basename($_FILES["CarImage"]["name"]);
	    } 
	    else {
	    	header("Location: addCarForm.php?error=An Issue occured with your image.");
			die;
	    }
	}


	AddCar($CarName, $Seats, $TotalMileage, $Model, $CarImage);

	header("Location: allCars.php");
	
 ?>
	
