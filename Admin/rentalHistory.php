<?php 
	session_start();
	if(!isset($_SESSION["Admin"])){
		header("Location: ../index.php");
		die;
	}
	require_once("../Models/DBConnect.php");
	require_once("../Models/Rentals.php");
	include("../Views/header2.php");
	$rentals = getAllReturnedRentals();
 ?>
	
<div class="row">
	<div class="col s12 m10 offset-m1">
		<h5>Rental History</h5>
		<hr />
		<table>
			<tr>
				<th>Car</th>
				<th>Customer Name</th>
				<th>Days Rented</th>
				<th>Inital Cost</th>
				<th>Mileage</th>
				<th>Mileage Cost</th>
				<th>TotalCost</th>
			</tr>
			<?php foreach($rentals as $rental): ?>
				<tr>
					<td><?php echo $rental["CarName"]; ?></td>
					<td><?php echo $rental['FName'] . " " . $rental['LName']; ?></td>
					<td><?php echo $rental["RentalDays"]; ?></td>
					<td>$<?php echo $rental["InitialCost"]; ?></td>
					<td><?php echo $rental["Mileage"]; ?> Miles</td>
					<td>$<?php echo $rental["Mileage"] * 0.32;; ?></td>
					<td>$<?php echo $rental["TotalCost"]; ?></td>
				</tr>							
			<?php endforeach; ?>

		</table>
	</div>
</div>

			
<?php include("../Views/footer.php"); ?>