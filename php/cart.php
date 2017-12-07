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
	$sql = "INSERT INTO SHOPPING_CART (user_id,product_id,quantity) values ('$user_id','$product_id',1)";		//TODO change hardcoded value for quantity and decrease quantity of product in db...
	mysqli_query($con,$sql);
	mysqli_close($con);
}

function getCurrentCart($user_id){
	$con = db_connect();
	$sql = "SELECT DISTINCT product_id from shopping_cart where user_id = '$user_id';";
	$result = mysqli_query($con,$sql);
	$products = mysqli_fetch_all($result,MYSQLI_ASSOC);		//id of distinct products in cart
	$cart = array();
	for($i = 0; $i<count($products);$i++){
		$prod_id = $products[$i]['product_id'];
		$sql  = "SELECT * from products where id = '$prod_id';";
		$result = mysqli_query($con,$sql);
		$product = $result->fetch_assoc();
		$cart[$i]['product'] = $product;
		
		$sql = "SELECT COUNT(shopping_cart.id) from shopping_cart inner JOIN products on products.id = shopping_cart.product_id and products.id = '$prod_id' and user_id = '$user_id';";
		$result = mysqli_query($con,$sql);
		$numItems = $result->fetch_row()[0];
		$cart[$i]['quantity'] = $numItems;
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