<?php 

function CreateCustomer($FName, $LName, $PhoneNumber){


	global $db;

	$query = $db->prepare("INSERT INTO customer (FName, LName, PhoneNumber) 
							VALUES(:FName, :LName, :PhoneNumber)");

	$query->bindParam(':FName', $FName);
	$query->bindParam(':LName', $LName);
	$query->bindParam(':PhoneNumber', $PhoneNumber);

	$query->execute();
	$id = $db->lastInsertId();
	return $id;
}









?>