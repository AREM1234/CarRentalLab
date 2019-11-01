<?php 
	
	include("../Views/header2.php");

	
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
					<h5>Login</h5>
					<hr />

					<form action="authenticate.php" method="post">

						<label class="black-text">Username</label>
						<input type="text" name="adminName" required />

						<label class="black-text">Password</label>
						<input type="Password" name="Password" required />

						<input type="submit" value="Login" />

					</form>					
				</div>
			</div>
		</div>
	</div>
</div>

			
<?php include("../Views/footer.php"); ?>