<?php

if($_SERVER["REQUEST_METHOD"] == "GET"){
	session_start();
	$product_id = $_GET['id'];
	$user_id = $_SESSION['u_id'];
	addToCart($user_id,$product_id);
	getCurrentCart($user_id);
}


function addToCart($user_id,$product_id){
	$con = db_connect();
	$sql = "INSERT INTO SHOPPING_CART (user_id,product_id,quantity) values ('$user_id','$product_id',1)";		//TODO change hardcoded value for quantity
	mysqli_query($con,$sql);
	mysqli_close($con);
}

function getCurrentCart($user_id){
	$con = db_connect();
	$sql = "SELECT * FROM SHOPPING_CART where user_id = '$user_id'";
	$result = mysqli_query($con,$sql);
	$arr = mysqli_fetch_all($result,MYSQLI_BOTH);
	for($i = 0; $i<count($arr);$i++){
		$product_id = $arr[$i]['product_id'];
		$sql = "SELECT * FROM PRODUCTS WHERE id = '$product_id'";
		$result = mysqli_query($con,$sql);
		$product = $result->fetch_assoc();
		$cart[$i]['product'] = $product;
		$cart[$i]['quantity'] = $arr[$i]['quantity'];
	}
	$json = json_encode($cart);
	print $json;
	mysqli_close($con);
	
}


function db_connect(){
	$con = mysqli_connect('localhost','ecom','ecom');
	if (!$con) {
	    die('Could not connect: ' . mysqli_error($con));
	}
	mysqli_select_db($con,"E_COMMERCE");
	return $con;
}

?>