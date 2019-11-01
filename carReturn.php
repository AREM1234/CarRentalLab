<?php 
	session_start();
	unset($_SESSION["Admin"]);
	include("Views/header.php");

	if(isset($_GET['error'])){
		$error = ($_GET['error']);
	}
	else{
		$error = "";
	}
?>

	<div class="row">
		<div class="col s12 m6 offset-m3">
			<?php if($error != ""): ?>
				<p><?php echo $error ?></p>
			<?php endif; ?>
			<div class="card white">
				<div class="card-content black-text">
					<h5>Car Return</h5>
					<hr />
					<p>Please enter the cars name, your rental password, and the mileage on the odometer on car.</p>
					<br />
					<form action="rentalReturn.php" method="post">

						<label class="black-text">Car Name</label>
						<input type="text" name="carName" required />

						<label class="black-text">Rental Password</label>
						<input type="password" name="rentalCode" required />

						<label class="black-text">Mileage</label>
						<input type="number" name="mileage" required />

						<input type="submit" value="Return Car" />

					</form>					
				</div>
			</div>
		</div>
	</div>

<?php include("Views/footer.php"); ?>