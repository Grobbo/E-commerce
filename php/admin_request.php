<?php

if($_SERVER["REQUEST_METHOD"] == "GET"){	//lägg till -- if(array_key_exists('search_string',$_GET)){
	product_json();
}

function product_json(){
	$con = mysqli_connect('localhost','ecom','ecom');
	if (!$con) {
	    die('Could not connect: ' . mysqli_error($con));
	}
	mysqli_select_db($con,"E_COMMERCE");
	$result = mysqli_query($con,"SELECT * FROM PRODUCTS");
	$row_array = array();
	while($row = mysqli_fetch_array($result)){
		$row_array[] = $row;
	}
	$json = json_encode($row_array);
	print $json;
	mysqli_close($con);
}

?>
