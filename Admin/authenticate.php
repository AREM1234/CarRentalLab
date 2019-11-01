<?php 
	session_start();
	require_once("../Models/DBConnect.php");
	require_once("../Models/Admins.php");

	$adminName = trim(filter_input(INPUT_POST, "adminName", FILTER_SANITIZE_STRING, FILTER_SANITIZE_SPECIAL_CHARS));
	$password = trim(filter_input(INPUT_POST, "Password", FILTER_SANITIZE_STRING, FILTER_SANITIZE_SPECIAL_CHARS));

	if(empty($adminName) || empty($password)){
		header("Location: login.php?error=Please fill out all fields");
		die;
	}

	$admin = Login($adminName, $password);

	$_SESSION["Admin"] = $admin['AdminName'];

	header("Location: index.php");
	
 ?>
	
