<?php 

function CreateRental($RentalCustomer, $RentalCar, $RentalDays, $InitialCost, $RentalCode){


	global $db;

	$hashedRentalCode = password_hash($RentalCode, PASSWORD_DEFAULT);

	$query = $db->prepare("INSERT INTO rentals (RentalCustomer, RentalCar, RentalDays, InitialCost, RentalCode) 
							VALUES(:RentalCustomer, :RentalCar, :RentalDays, :InitialCost, :RentalCode)");

	$query->bindParam(':RentalCustomer', $RentalCustomer);
	$query->bindParam(':RentalCar', $RentalCar);
	$query->bindParam(':RentalDays', $RentalDays);
	$query->bindParam(':InitialCost', $InitialCost);
	$query->bindParam(':RentalCode', $hashedRentalCode);

	$query->execute();
	$id = $db->lastInsertId();
	return $id;
}

function CreateRentalReturn($RentalID, $Mileage, $TotalCost){

	global $db;

	$query = $db->prepare("INSERT INTO rentalreturns (Rental, Mileage, TotalCost) 
							VALUES(:Rental, :Mileage, :TotalCost)");

	$query->bindParam(':Rental', $RentalID);
	$query->bindParam(':Mileage', $Mileage);
	$query->bindParam(':TotalCost', $TotalCost);

	$query->execute();
	$id = $db->lastInsertId();
	return $id;
}


function getRentalReturnByID($ReturnID){

	global $db;

	$query = $db->prepare("SELECT Mileage, TotalCost, Rental, customer.FName, customer.LName, rentals.InitialCost FROM rentalreturns 
						INNER JOIN rentals ON rentalreturns.Rental = rentals.RentalID
						INNER JOIN customer ON rentals.RentalCustomer = customer.CustomerID
						 WHERE ReturnID = :ReturnID");

	$query->bindParam(':ReturnID', $ReturnID);

	$query->execute();

	$result = $query->fetch();

	return $result;
}


function getCarsCurrentRental($CarID, $rentalCode){

	global $db;

	$query = $db->prepare("SELECT RentalCode, RentalCar, InitialCost, RentalID FROM rentals INNER JOIN ( SELECT MAX(RentalID) AS most_recent FROM rentals WHERE RentalCar = :CarID ) ms ON RentalID = most_recent");

	$query->bindParam(':CarID', $CarID);

	$query->execute();

	$result = $query->fetch();

	if(password_verify($rentalCode, $result["RentalCode"])){		
		return $result;
	}
	else{
		header("Location: carReturn.php?error=Invalid Password or Car Name please try again.");
		die;
	}

}

function getAllReturnedRentals(){

	global $db;

	$query = "SELECT RentalID, InitialCost, RentalDays, cars.CarName, customer.FName, customer.LName, rentalreturns.Mileage, rentalreturns.TotalCost 
						 FROM rentals 
						 INNER JOIN cars ON rentals.RentalCar = cars.CarID
						 INNER JOIN customer ON rentals.RentalCustomer = customer.CustomerID
						 INNER JOIN rentalreturns ON rentalreturns.Rental = rentals.RentalID
						 ORDER BY CarName ASC, RentalID DESC";


	$result = $db->query($query);
	return $result;

}





?>