<?php 
	session_start();
	unset($_SESSION["Admin"]);
	require_once("Models/DBConnect.php");
	require_once("Models/Cars.php");
	
	$FName = trim(filter_input(INPUT_POST, "FName", FILTER_SANITIZE_STRING, FILTER_SANITIZE_SPECIAL_CHARS));
	$LName = trim(filter_input(INPUT_POST, "LName", FILTER_SANITIZE_STRING, FILTER_SANITIZE_SPECIAL_CHARS));
	$PhoneNumber = trim(filter_input(INPUT_POST, "PhoneNumber", FILTER_SANITIZE_STRING));
	$rentalCode = trim(filter_input(INPUT_POST, "rentalCode", FILTER_SANITIZE_STRING));
	$rentalDays = trim(filter_input(INPUT_POST, "rentalDays", FILTER_SANITIZE_NUMBER_INT));
	$carID =  trim(filter_input(INPUT_POST, "carID", FILTER_SANITIZE_NUMBER_INT));

	if(empty($carID) || !is_numeric($carID)){
		header("Location: index.php");
		die;
	}
	else{
		$car = getCarByID($carID);
	}

	if(empty($FName) || empty($LName) || empty($PhoneNumber) || empty($rentalCode) || empty($rentalDays)){
		header("Location: rentalForm.php?carID=" . $carID . "&error=Please fill out all fields.");
		die;
	}

	if(!is_numeric($rentalDays)){
		header("Location: rentalForm.php?carID=" . $carID . "&error=Somthing went wrong please try again.");
		die;
	}

	$initalCost = $car["ModelCost"] * $rentalDays;

	round($initalCost, 2);

	include("Views/header.php");
?>

	<div class="row">
		<div class="col s12 m10 offset-m1">
			<div class="card white">
				<div class="card-content black-text">
					<h5>Rental Confirmation</h5>
					<hr />
					<div class="row">					
						<div class="col s12 m8">
							<div class="card white">
								<div class="card-content black-text">
									<p>Are you sure you want to rent <?php echo $car['CarName']; ?>?</p>
									<p>You will rent it for <?php echo $rentalDays; ?> day(s) with an initial cost of $<?php echo $initalCost; ?> and $0.32 per mile when returned. </p>
									<form action="addRecord.php" method="post">

										<input type="hidden" name="carID" value="<?php echo $carID; ?>" />
										<input type="hidden" name="FName" value="<?php echo $FName; ?>" />
										<input type="hidden" name="LName" value="<?php echo $LName; ?>" />
										<input type="hidden" name="PhoneNumber" value="<?php echo $PhoneNumber; ?>" />
										<input type="hidden" name="rentalCode" value="<?php echo $rentalCode; ?>" />
										<input type="hidden" name="rentalDays" value="<?php echo $rentalDays; ?>" />
										<input type="hidden" name="initalCost" value="<?php echo $initalCost; ?>" />

										<p><button><a href="index.php">Cancel</a></button> | <input type="submit" value = "Place Order" /></p>
									</form>
								</div>
							</div>
						</div>
						<div class="col s12 m4">
							<div class="card white">
			    				<div class="card-content black-text">
			    					<img src="images/<?php echo $car["ImageName"]; ?>" height="200px" width="100%" alt="image of car" />
			    					<hr />
									<h5><?php echo $car["CarName"]; ?></h5>					
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>






<?php include("Views/footer.php"); ?>