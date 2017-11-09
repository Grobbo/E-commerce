<html>
<head>
<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>	<div class='login'>
	<form method='POST' name='login_form'>
		Username<br/>
		<input type = 'TEXT' name='user_name'/>
		<br/>
		Password<br/>
		<input type = 'PASSWORD' name='user_password'/>
		<br/><br/>
		<input type='SUBMIT' name='sign_in' value='Sign In'/> 
		
	</form>

		<hr width=80%/>
		<a href="signup.php">Create new account</a>
	</div>

	<?php
	$servername = "localhost";
	$username = "ecom";
	$password = "ecom";

	// Create connection
	$conn = new mysqli($servername, $username, $password);

	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	$sql = "USE E_COMMERCE;";


	if ($conn->query($sql) === FALSE) {
	    echo "Error choosing database: " . $conn->error;
	}

	
		
		if(array_key_exists('sign_in',$_POST)){

			$us = $_POST["user_name"];
			$pw = $_POST["user_password"];
			$query = "SELECT user_password FROM CUSTOMERS WHERE user_name = '$us';";
			
			$result = $conn->query($query);
			if ($result->num_rows > 0) {
				$hashed_password = mysqli_fetch_array($result)['user_password'];
				if (password_verify($pw, $hashed_password)) {
				    echo"verified";
				}else{
				    echo"Not verified"; 
					
				}
			
			} else {
			    echo "0 results";
			}

		}
	?>
	
</body>
</html>
