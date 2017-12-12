<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(array_key_exists('rating',$_POST)){
		sql_add_rating($_POST['prodid'],$_POST['rating']);
	}
}


function sql_add_rating($prodid,$rating){
$con = mysqli_connect('localhost','ecom','ecom');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
	mysqli_select_db($con,"E_COMMERCE");
	
	$sql="UPDATE `E_COMMERCE`.`PRODUCTS` SET `rating`= `rating` + $rating, `num_ratings`= `num_ratings`+ 1 WHERE `id`='$prodid';";
	
	if ($con->query($sql) === FALSE) {
        echo "Error: " . $conn->error . "<br/>";
	}
	
	$sql="SELECT * FROM PRODUCTS WHERE id='$prodid';";	
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
