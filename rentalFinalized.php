<?php 
	session_start();
	unset($_SESSION["Admin"]);
	require_once("Models/DBConnect.php");
	require_once("Models/Cars.php");

	if(empty($_GET["carID"])){
		header("Location: index.php");
		die;
	}
	else{
		if(!is_numeric($_GET["carID"])){
			header("Location: index.php");
			die;
		}
		$car = getCarByID($_GET["carID"]);
	}


	include("Views/header.php");

?>


<div class="row">
	<div class="col s12 m10 offset-m1">
		<div class="card white">
			<div class="card-content black-text">
				<h5>Thank you for ordering.</h5>
				<hr />
				<p>You can come pick up your car at any time. Your cars name is <?php echo $car['CarName']; ?></p>
				<p>Make sure to have your cars name and your rental code you created on pickup and return.</p>
				<button><a href="index.php">Home</a></button>
			</div>
		</div>
	</div>
</div>




<?php include("Views/footer.php"); ?>