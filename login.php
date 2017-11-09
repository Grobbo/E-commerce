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
			
			//var_dump($_POST);
			$us = $_POST["user_name"];
			$query = "SELECT * FROM CUSTOMERS WHERE user_name='$us';";
			$result = $conn->query($query);
			if ($result->num_rows > 0) {
				//var_dump($result);
			    // output data of each row
			    while($row = $result->fetch_assoc()) {
				echo "id: " . $row["id"]. " - User Name: " . $row["user_name"]. " Password: " . $row["user_password"]. "<br>";
			    }
			} else {
			    echo "0 results";
			}

		}
	?>
	
</body>
</html>
