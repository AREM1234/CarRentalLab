<?php 
	session_start();

	if(!isset($_SESSION["Admin"])){
		header("Location: ../index.php");
		die;
	}

	require_once("../Models/DBConnect.php");
	require_once("../Models/Cars.php");
	include("../Views/header2.php");
	$cars = getRentedCars();
	
 ?>
	
<div class="row">
	<div class="col s12 m10 offset-m1">
		<h5>Rented Cars</h5>
		<hr />
		<div class="row">
			<?php if($cars == "Nothing Found."): ?>
				<h5>No cars are currently rented</h5>
			<?php else: ?>
				<?php foreach($cars as $car): ?>
					<div class="col s12 m4 l3">
						<div class="card white">
	        				<div class="card-content black-text">
	        					<img src="../images/<?php echo $car["ImageName"]; ?>" height="200px" width="100%" alt="image of car" />
	        					<hr />
								<h5><?php echo $car["CarName"]; ?></h5>
								<p>Model: <?php echo $car["ModelType"]; ?></p>
								<p>Total Mileage: <?php echo $car['TotalMileage']; ?> Miles</p>
								<hr />
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</div>
	
<?php include("../Views/footer.php"); ?>