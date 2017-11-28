<?php

if($_SERVER["REQUEST_METHOD"] == "GET"){	//lägg till -- if(array_key_exists('search_string',$_GET)){
	
	if(array_key_exists('request_type',$_GET)){
		switch($_GET['request_type']){
			case "UPDATE":
				product_json();
				break;
			case "EDIT":
				echo "EDIT";
				break;
		}

	}
	


}

function db_connect(){
	$con = mysqli_connect('localhost','ecom','ecom');
	if (!$con) {
	    die('Could not connect: ' . mysqli_error($con));
	}
	mysqli_select_db($con,"E_COMMERCE");
	return $con;
}


function product_json(){
	$con = db_connect();
	$result = mysqli_query($con,"SELECT * FROM PRODUCTS");
	$row_array = array();
	while($row = mysqli_fetch_array($result)){
		$row_array[] = $row;
	}
	$json = json_encode($row_array);
	print $json;
	mysqli_close($con);
}

function edit_product($id){
	$con = db_connect();

	$sql = "UPDATE PRODUCTS SET description = 'test' WHERE id ='$id'";	
	mysqli_query($con,$sql);

	//prodct_json()		?
}

function delete_product($id){
	$con = db_connect();

	$sql = "DELETE FROM PRODUCTS WHERE id = '$id' ";
	mysqli_query($con,$sql);

	//product_json()	?
}


?>
