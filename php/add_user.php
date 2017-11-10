<?php
function create_new_user($user_username,$user_password,$f_name,$s_name,$address,$email,$postalcode,$country,$city){
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

$user_password = password_hash($user_password, PASSWORD_DEFAULT);
$query = "INSERT INTO CUSTOMERS(user_name,user_password,first_name,last_name,address,email,postal_code,country,city) VALUES ('$user_username','$user_password','$f_name','$s_name','$address','$email','$postalcode','$country','$city')";
if ($conn->query($query) === FALSE) {
    echo "Error: " . $conn->error . "<br/>";
}	
}
?>
