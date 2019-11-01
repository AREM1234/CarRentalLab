<?php 
	session_start();
	unset($_SESSION["Admin"]);
	require_once("Models/DBConnect.php");
	require_once("Models/Rentals.php");

	if(isset($_GET['rentalReturn']) && is_numeric($_GET['rentalReturn'])){
		$rentalReturn = getRentalReturnByID($_GET['rentalReturn']);
	}
	else{
		header("Location: index.php");
		die;
		
	}

	$addedCost = $rentalReturn['Mileage'] * .32;

	round($addedCost, 2);

	include("Views/header.php");
?>

	<div class="row">
		<div class="col s12 m10 offset-m1">
			<div class="card white">
				<div class="card-content black-text">
					<h5>Return Complete</h5>
					<hr />
					<p>Thank you <?php echo $rentalReturn["FName"] . " " . $rentalReturn["LName"]; ?> for renting our car.</p>
					<p>Your inital cost was $<?php echo $rentalReturn['InitialCost']; ?></p>
					<p>With <?php echo $rentalReturn['Mileage']; ?> miles added to the car, at a rate of $0.32 per mile your cost increased by $<?php echo $addedCost; ?></p>
					<p>And your total cost is $<?php echo $rentalReturn['TotalCost']; ?></p>					
				</div>
			</div>
		</div>
	</div>

<?php include("Views/footer.php"); ?>