 <?php

if($_SERVER["REQUEST_METHOD"] == "GET"){
	
	if(array_key_exists('request_type',$_GET)){
		switch($_GET['request_type']){
			case "UPDATE":
				product_json();
				break;
			case "EDIT":
				edit_product($_GET['id'],$_GET['cat'],$_GET['man'],$_GET['desc'],$_GET['price'],$_GET['qty']);
				product_json();	
				break;
			case "DELETE":
				delete_product($_GET['id']);
				product_json();
				break;
			case "GETORDERS":
				getOrders($_GET['search_id']);
				break;
			case "GETSHIPMENTS":
				getShipments();
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

function edit_product($id,$cat,$man,$desc,$price,$qty){
	
	$con = db_connect();

	$sql = "UPDATE PRODUCTS SET category = '$cat',manufacturer = '$man', description = '$desc',price='$price',quantity='$qty'  WHERE id ='$id'";	
	mysqli_query($con,$sql);
	mysqli_close($con);
	
		
}

function delete_product($id){
	$con = db_connect();

	$sql = "DELETE FROM PRODUCTS WHERE id = '$id' ";
	mysqli_query($con,$sql);
	mysqli_close($con);
	
}
function getShipments(){
	$con = db_connect();

	$sql = "SELECT shipment_id,order_date,customer,user_name,first_name,last_name,address FROM CUSTOMERS join SHIPMENTS on id = SHIPMENTS.customer;";
	$result = mysqli_query($con,$sql);
	$row_array = array();
	while($row = mysqli_fetch_array($result)){
		$row_array[] = $row;
	}
	$json = json_encode($row_array);
	print $json;
	mysqli_close($con);
}
function getOrders($shipment_id){
	$con = db_connect();

	//count of each product: SELECT product_id,shipment_id, COUNT(*) FROM ORDERS WHERE shipment_id = 1 GROUP BY product_id;

	$sql = "SELECT product_id,shipment_id, COUNT(*) as quantity FROM ORDERS WHERE shipment_id = '$shipment_id' GROUP BY product_id;";
	$result = mysqli_query($con,$sql);
	$row_array = array();
	while($row = mysqli_fetch_array($result)){
		$row_array[] = $row;
	}
	$json = json_encode($row_array);
	print $json;
	mysqli_close($con);
	
}


?>
