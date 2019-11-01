<?php 
	session_start();
	unset($_SESSION["Admin"]);
	require_once("Models/DBConnect.php");
	require_once("Models/Cars.php");
	include("Views/header.php");

	if(isset($_GET['carID'])){
		$car = getCarByID($_GET['carID']);
	}
	else{
		header("Location: index.php");
		die;
	}

	if(isset($_GET['error'])){
		$error = ($_GET['error']);
	}
	else{
		$error = "";
	}

	
 ?>
	
<div class="row">
	<div class="col s12 m10 offset-m1">
		<?php if($error != ""): ?>
			<p><?php echo $error ?></p>
		<?php endif; ?>
		<div class="col s12 m8 offset-m2">
			<div class="card white">
				<div class="card-content black-text">
					<h5>Rent <?php echo $car["CarName"]; ?></h5>
					<hr />
					<div class="row">					
						<div class="col s12 m6">
							<form action="rentalConfirm.php" method="post">

								<input type="hidden" name="carID" value="<?php echo $car["CarID"] ?>">

								<label class="black-text">First Name</label>
								<input type="text" name="FName" required />

								<label class="black-text">Last Name</label>
								<input type="text" name="LName" required/>

								<label class="black-text">Phone Number</label>
								<input type="text" name="PhoneNumber" required/>

								<label class="black-text">Number of Days to Rent</label>
								<input type="number" name="rentalDays" required/>

								<label class="black-text">Create a Rental Password (Be sure to remember this)</label>
								<input type="Password" name="rentalCode" required/>

								<input type = "submit" value="Rent Car" />
							</form>
						</div>
						<div class="col s12 m6">
							<div class="card white">
		        				<div class="card-content black-text">
		        					<h5>Review Car</h5>
		        					<hr />
		        					<img src="images/<?php echo $car["ImageName"]; ?>" height="200px" width="100%" alt="image of car" />
		        					<hr />
									<h5><?php echo $car["CarName"]; ?></h5>
									<p>
										Model: <?php echo $car["ModelType"]; ?> |
										Cost per day: $<?php echo $car["ModelCost"]; ?> 
									</p>
									<p>An extra $.32 will be added per mile.</p>
									<p>Seats: <?php echo $car["Seats"]; ?> </p>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

			
<?php include("Views/footer.php"); ?>