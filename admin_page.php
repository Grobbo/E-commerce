<html>
<head>
<link rel="stylesheet" type="text/css" href="admin_page.css">
<script src="js/admin_page.js" type="text/javascript"></script>
</head>
<?php

session_start();

$servername = "localhost";
$username = "ecom";
$password = "ecom";
$database = "E_COMMERCE";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Select DB.
mysqli_select_db($conn,$database);

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(array_key_exists('password',$_POST)){
			$query = "SELECT password FROM E_COMMERCE.ADMIN;";
			$pw = $_POST['password'];
			$result = $conn->query($query);
			if ($result->num_rows > 0) {
				$passwd = mysqli_fetch_array($result)['password'];
				if($passwd === $_POST['password']){
					$_SESSION['admin'] = "true";
				} 
			}
			
		}

	}
 
	if(isset($_SESSION['admin'])){
		echo '<form class="dropdownform" action="php/sign_out.php" method="POST">
		<button type="submit" name="submit">Sign out and return to main page</button>
		</form>';
		
	}else{
		echo '<form class="dropdownform" action="admin_page.php" method="POST">
		<input type="password" name="password" placeholder="Password">
		<button type="submit" name="sign_in">Log in</button>
		</form>';
		exit();
	}

?>

<!-- DIN KOD FRÅN HÄR LUDDE -->
<body onload="selectForm('prod_form');getShipments();">


	<br>
	<div class="management">
	<select id="select_form" onchange="selectForm(value)">
		<option value="prod_form" >Add Product</option>		<!--Value matches form id -->
		<option value="edit_prod_form">Edit Product</option>
		
	</select>

	<form id="prod_form" method="post" action="">
		<h3>Add Product</h3>
		Product category<br> <input type="text" class="add_product_text" name="prod_cat"/><br>
		Product manufacturer<br> <input type="text" class="add_product_text" name="prod_man"/><br>
		Product description<br> <input type="text" class="add_product_text" name="prod_desc"/><br>
		Product price<br> <input type="text" class="add_product_text" name="prod_price"/><br>
		Product quantity<br> <input type="text" class="add_product_text" name="prod_quantity"/><br>

		<input type="submit" name="add_product" value="Add Product"/>
		
	</form>

	<form id="edit_prod_form">		
		<p id="edit_prod_result"></p>	<!--placeholder for javascript result -->
	</form>

	</div>
	<div class="statistics">
		<h1>Statistics</h1><br>
		<h3>Shipments:</h3>
		<span id ='shipment_placeholder'></span>
		<button type ='button' onclick='getShipments()'>Refresh Table</button>
		<br>
		<input type='input' id='shipment_id_input' placeholder = 'search orders by id' onkeypress=" if 			(event.keyCode==13) search_orders();"></input>

		<button type='button' onclick='search_orders();'>Search Orders</button>
		<span id ='order_placeholder'></span>
		
	</div>


	


	<?php 
		if(array_key_exists('add_product',$_POST)){
			$con = mysqli_connect('localhost','ecom','ecom');
			if (!$con) {
			    die('Could not connect: ' . mysqli_error($con));
			}
			mysqli_select_db($con,"E_COMMERCE");
			
			$cat = $_POST["prod_cat"];
			$man =	$_POST["prod_man"];
			$desc =	$_POST["prod_desc"];
			$price= $_POST["prod_price"];
			$quantity=$_POST["prod_quantity"];
			$sql = "INSERT INTO E_COMMERCE.PRODUCTS(
				category,
				manufacturer,
				description,
				quantity,
				price)
			VALUES ('$cat','$man','$desc','$quantity','$price');";
			mysqli_query($con,$sql);
	
		}
	?>
</body>
</html>
