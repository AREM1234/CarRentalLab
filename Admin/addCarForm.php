<?php 
	session_start();
	if(!isset($_SESSION["Admin"])){
		header("Location: ../index.php");
		die;
	}
	require_once("../Models/DBConnect.php");
	require_once("../Models/Cars.php");
	include("../Views/header2.php");


	if(isset($_GET['error'])){
		$error = ($_GET['error']);
	}
	else{
		$error = "";
	}

	$models = getCarModels();
	
 ?>
	
<div class="row">
	<div class="col s12 m10 offset-m1">
		<?php if($error != ""): ?>
			<p><?php echo $error ?></p>
		<?php endif; ?>
		<div class="col s12 m8 offset-m2">
			<div class="card white">
				<div class="card-content black-text">
					<h5>Add Car</h5>
					<hr />	
					<form action="addCar.php" method="post" enctype="multipart/form-data">

						<label class="black-text">Car Name</label>
						<input type="text" name="CarName" required />

						<label class="black-text">Seats</label>
						<input type="number" name="Seats" required/>

						<label class="black-text">Starting Mileage</label>
						<input type="text" name="TotalMileage" required/>

						<label class="black-text">Model</label>
						<select name="Model" class="browser-default">
							<?php foreach($models as $model): ?>
								<option value="<?php echo $model['ModelID']; ?>"><?php echo $model['ModelType']; ?></option>
							<?php endforeach; ?>
						</select>

						<label class="black-text">Image</label>
						<input type="file" name="CarImage" required/>

						<input type = "submit" value="Add Car" />
					</form>				
				</div>
			</div>
		</div>
	</div>
</div>

			
<?php include("../Views/footer.php"); ?>