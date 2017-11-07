<?php
function create_new_user($user_fname,$user_sname){
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

	
$query = "INSERT INTO CUSTOMERS(first_name,last_name,user_name,user_password,address,email,postal_code,country,city) VALUES ('$user_fname','$user_sname','a','b','c','d','e','f','g')";
if ($conn->query($query) === FALSE) {
    echo "Error: " . $conn->error . "<br/>";
}	
}
?>
