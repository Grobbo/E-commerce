<?php
function create_new_user($user_fname){
$servername = "localhost";
$username = "ecom";
$password = "ecom";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "USE e_commerce;";


if ($conn->query($sql) === FALSE) {
    echo "Error choosing database: " . $conn->error;
}

	
$query = "INSERT INTO users(user_first_name) VALUES ('$user_fname')";
$conn->query($query);
	
}
?>
