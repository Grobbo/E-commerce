<?php

session_start();

$servername = "localhost";
$username = "ecom";
$password = "ecom";
$database = "E_COMMERCE";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select DB.
mysqli_select_db($conn,$database);	
	
	if(array_key_exists('sign_in',$_POST)){

		$us = $_POST["user_name"];
		$pw = $_POST["user_password"];
		$query = "SELECT user_password FROM CUSTOMERS WHERE user_name = '$us';";
		
		$result = $conn->query($query);
		if ($result->num_rows > 0) {
			$hashed_password = mysqli_fetch_array($result)['user_password'];
			if (password_verify($pw, $hashed_password)) {
				$_SESSION['u_name'] = $us;
				
				$sql = "SELECT id FROM  CUSTOMERS WHERE user_name = '$us';";
				$res = $conn->query($sql);
				$_SESSION['u_id'] = mysqli_fetch_array($res)['id'];
				//add more parameters to session on demand.
				header("Location: index.php");
				exit();
			}else{
			    header("Location: index.php?=login_failed");
			
			}
		
		} else {
		    header("Location: index.php");
		}

	}

?>
