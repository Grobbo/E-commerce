<html>
<head>
<title>E-commerce site for tools </title>
<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
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
echo "Connected successfully<br/>";


$sql = "USE e_commerce;";
$sql2 = "INSERT INTO users(user_first_name) VALUES ('RIKE_ERIK')";

if ($conn->query($sql) === TRUE) {
    echo "database chosen correctly<br/>";
} else {
    echo "Error choosing database: " . $conn->error;
}

if ($conn->query($sql2) === TRUE) {
    echo "Table Persons created successfully<br/>";
} else {
    echo "Error creating table: " . $conn->error;
}


?>

 	<div class="dropdown">
	<button class="dropbtn">Könisar</button>
		<div class="dropdown-content">
			 <a href="#">Syfilis</a>
   		 	<a href="#">Gonorre</a>
   		 	<a href="#">Condylom</a>
  		</div class="dropdown">
	</div>
	<div class="dropdown">
	<button class="dropbtn">Devs</button>
                  <div class="dropdown-content">
                	 <a href="#">Erik Sundström</a>
                 	<a href="#">Ludvig Isaksson</a>
                </div class="dropdown">
	</div>

	
</html>
