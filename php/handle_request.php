

<?php
include 'add_user.php';

if($_SERVER["REQUEST_METHOD"] == "GET"){	
	if(array_key_exists('search_string',$_GET)){
		
		sql_search_display($_GET['search_string'],$_GET['criteria'],$_GET['sortBy']);
	}
	if(array_key_exists('display',$_GET)){
		switch($_GET['display']){
		case 'all':
			echo "ALL TOOLS";
			break;
		case 'drills':
			echo "DRILLS";
			break;
		case 'screwdrivers':
			echo "SCREWDRIVERS";
			break;
		case 'hammers':
			echo "HAMMERS";
			break;
		}
	}
}	

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(array_key_exists('signup_form',$_POST)){
		$username = $_POST["user_username"];			
		$password = $_POST["user_password"];
		$f_name = $_POST["user_fname"];			
		$s_name = $_POST["user_sname"];
		$address = $_POST["user_address"];			
		$email = $_POST["user_email"];
		$postalcode = $_POST["user_postal_code"];
		$country = $_POST["user_country"];
		$city = $_POST["user_city"];
		
		create_new_user($username,
				$password,
				$f_name,
				$s_name,
				$address,
				$email,
				$postalcode,
				$country,
				$city);
		header("Location: ../index.php");
	}

}	


function sql_search_display($search_str,$criteria,$sort){
$con = mysqli_connect('localhost','ecom','ecom');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}
	mysqli_select_db($con,"E_COMMERCE");
	
	if($criteria == 'manufacturer'){
		$sql="SELECT * FROM PRODUCTS WHERE manufacturer = '$search_str' ORDER BY $sort;";
		$result = mysqli_query($con,$sql);	
	}
	else if($criteria == 'category'){
		$sql="SELECT * FROM PRODUCTS WHERE category = '$search_str' ORDER BY $sort";
		$result = mysqli_query($con,$sql);	
	}
	else if($criteria == 'hammers'){
		$sql="SELECT * FROM PRODUCTS WHERE category = 'hammer'";
		$result = mysqli_query($con,$sql);	
	}
	else if($criteria == 'all'){
		$sql="SELECT * FROM PRODUCTS";
		$result = mysqli_query($con,$sql);	
	}
	else if($criteria == 'saws'){
		$sql="SELECT * FROM PRODUCTS WHERE category = 'saw'";
		$result = mysqli_query($con,$sql);	
	}
	else if($criteria == 'screwdrivers'){
		$sql="SELECT * FROM PRODUCTS WHERE category = 'screwdriver'";
		$result = mysqli_query($con,$sql);	
	}

	
	$row_array = array();
	while($row = mysqli_fetch_array($result)) {
	  $row_array[] = $row;
	}

	$json = json_encode($row_array);
	print $json;
	mysqli_close($con);

}	
?>
