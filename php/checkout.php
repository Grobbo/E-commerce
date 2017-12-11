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
	mysqli_begin_transaction($con, MYSQLI_TRANS_START_READ_WRITE);		
	$sql1 = "INSERT INTO SHIPMENTS (order_date,customer) values (NOW(),'$user_id')";
	
	$sql2 = "INSERT INTO ORDERS (product_id,quantity)
					SELECT product_id,quantity FROM SHOPPING_CART WHERE user_id = '$user_id';
			INSERT INTO ORDERS (shipment_id) values ('$shipment_id')";
	$sql3 = "DELETE FROM SHOPPING_CART WHERE user_id = '$user_id';";
	
	mysqli_query($con,$sql1);
	$shipment_id = mysqli_insert_id($con);
	
	
	/*mysqli_query($con,$sql2);
	if(mysqli_affected_rows($con)<=0){//an error occured or no rows affected
		print(mysqli_error($con));
	}else{							//query ok
		print("Hej");
	}
	//mysqli_query($con,$sql3);
	if(!mysqli_commit($con)){
		//print("Transaction failed!");
	}else{
		//print("Success!");
	}
	*/
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