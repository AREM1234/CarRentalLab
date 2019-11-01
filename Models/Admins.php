<?php 



function Login($AdminName, $Password){

	global $db;

	$query = $db->prepare("SELECT * FROM Admins WHERE AdminName = :AdminName");

	$query->bindParam(':AdminName', $AdminName);

	$query->execute();

	$result = $query->fetch();

	if(password_verify($Password, $result["AdminPassword"])){		
		return $result;
	}
	else{
		header("Location: login.php?error=Invalid Username or Password");
		die;
	}

}





?>