<?php

if($_SERVER["REQUEST_METHOD"] == "GET"){	
	if(array_key_exists('id',$_GET)){
		sql_get_comments($_GET['id']);
	}
}


function sql_get_comments($id){
$con = mysqli_connect('localhost','ecom','ecom');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

	mysqli_select_db($con,"E_COMMERCE");
	
	$sql="SELECT * FROM COMMENTS WHERE product_id='".$id."'";
	$result = mysqli_query($con,$sql);
	
	$row_array = array();
	while($row = mysqli_fetch_array($result)) {
	  $row_array[] = $row;
	}

	$json = json_encode($row_array);
	print $json;
	mysqli_close($con);

}

?>
