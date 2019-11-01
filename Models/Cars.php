<?php 

function getAvailableCars(){

	global $db;

	$query = "SELECT * FROM cars INNER JOIN models ON cars.CarModel = models.ModelID WHERE Available = 1 ORDER BY CarModel, CarName ASC ";

	$result = $db->query($query);

	if($result->rowCount() == 0){
		$result = "Nothing Found.";
	}
	return $result;

}

function getRentedCars(){

	global $db;

	$query = "SELECT * FROM cars INNER JOIN models ON cars.CarModel = models.ModelID WHERE Available = 0 ORDER BY CarModel, CarName ASC ";

	$result = $db->query($query);

	if($result->rowCount() == 0){
		$result = "Nothing Found.";
	}

	return $result;

}

function getAllCars(){

	global $db;

	$query = "SELECT * FROM cars INNER JOIN models ON cars.CarModel = models.ModelID ORDER BY CarModel, CarName ASC ";

	$result = $db->query($query);
	return $result;

}

function getCarByID($carID){

	global $db;

	$query = $db->prepare("SELECT * FROM cars INNER JOIN models ON cars.CarModel = models.ModelID WHERE CarID = :CarID");

	$query->bindParam(':CarID', $carID);

	$query->execute();

	$result = $query->fetch(PDO::FETCH_ASSOC);

	return $result;

}

function getCarByName($CarName){

	global $db;

	$query = $db->prepare("SELECT * FROM cars WHERE CarName = :CarName");

	$query->bindParam(':CarName', $CarName);

	$query->execute();

	$result = $query->fetch(PDO::FETCH_ASSOC);

	return $result;

}

function makeUnavailable($carID){
	global $db;

	$query = $db->prepare("UPDATE cars SET Available = 0
				WHERE carID = :carID");

	$query->bindParam(':carID', $carID);

	$query->execute();
}

function makeAvailable($carID){
	global $db;

	$query = $db->prepare("UPDATE cars SET Available = 1
				WHERE carID = :carID");

	$query->bindParam(':carID', $carID);

	$query->execute();
}


function ChangeCarsMileage($carID, $NewMileage){
	global $db;

	$query = $db->prepare("UPDATE cars SET TotalMileage = :NewMileage
				WHERE carID = :carID");

	$query->bindParam(':carID', $carID);
	$query->bindParam(':NewMileage', $NewMileage);

	$query->execute();
}

function getCarModels(){

	global $db;

	$query = "SELECT * FROM models;";

	$result = $db->query($query);
	return $result;

}

function addCar($CarName, $Seats, $TotalMileage, $Model, $CarImage){

	global $db;

	$query = $db->prepare("INSERT INTO cars (CarName, Seats, TotalMileage, CarModel, ImageName, Available) 
							VALUES(:CarName, :Seats, :TotalMileage, :Model, :CarImage, 1)");

	$query->bindParam(':CarName', $CarName);
	$query->bindParam(':Seats', $Seats);
	$query->bindParam(':TotalMileage', $TotalMileage);
	$query->bindParam(':Model', $Model);
	$query->bindParam(':CarImage', $CarImage);
	$query->execute();

}






?>