<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){
	session_start();
	$user_id = $_SESSION['u_id'];
	$num_items = $_GET['num_items'];
	//print $num_items;
	checkout($user_id,$num_items);
	
}

function checkout($user_id,$num_items){
	$con = db_connect();
	//mysqli_begin_transaction($con, MYSQLI_TRANS_START_READ_WRITE);		
	
	$sql1 = "INSERT INTO SHIPMENTS (order_date,customer) values (NOW(),'$user_id')";	
	mysqli_query($con,$sql1);						//create new shipment...
	$shipment_id = mysqli_insert_id($con);
	$sql2 = "SELECT product_id FROM SHOPPING_CART WHERE user_id = '$user_id'";
	$result = mysqli_query($con,$sql2);		//all products in shopping cart
	$products = mysqli_fetch_all($result,MYSQLI_ASSOC);	
	
	$sql3 = "INSERT INTO ORDERS (product_id,quantity,shipment_id) values";
	
	for($i=0;$i<count($products);$i++){
		$product_id = intval($products[$i]['product_id']);
		$sql3 .= "('$product_id',1,'$shipment_id'),";
	}
	$sql3 = chop($sql3 , ",");

	mysqli_query($con,$sql3);
	$sql4 = "DELETE FROM SHOPPING_CART WHERE user_id = '$user_id';";
	mysqli_query($con,$sql4);
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