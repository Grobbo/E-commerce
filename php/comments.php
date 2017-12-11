<?php

if($_SERVER["REQUEST_METHOD"] == "GET"){	
	if(array_key_exists('id',$_GET)){
		sql_get_comments($_GET['id']);
	}
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(array_key_exists('comment',$_POST)){
		sql_add_comment($_POST['text'],$_POST['prodid'],$_POST['sid']);
	}
}

function sql_add_comment($text, $prodid, $sid){
	$con = mysqli_connect('localhost','ecom','ecom');
	if (!$con) {
    		die('Could not connect: ' . mysqli_error($con));
	}

	mysqli_select_db($con,"E_COMMERCE");
	
	$sql="INSERT INTO COMMENTS (product_id, super_id,comment_text) VALUES (".$prodid.",".$sid.",'".$text."')";

	if ($con->query($sql) === FALSE) {
        echo "Error: " . $conn->error . "<br/>";
	}
	
	print $prodid;
	mysqli_close($con);


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
	
	if(count($row_array) == 0){
		array_push($row_array,"none","$id");
		$json = json_encode($row_array);
		print $json;
	}else{
	$json = json_encode($row_array);
	print $json;
	}
	

	mysqli_close($con);
	
}

?>
