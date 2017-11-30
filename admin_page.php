<html>
<head>
<link rel="stylesheet" type="text/css" href="admin_page.css">
<script src="js/admin_page.js" type="text/javascript"></script>
</head>
<body onload="selectForm()">
<?php
include("navigationbar.php");
?>
	<br>
	<div class="management">
	<select id="select_form" onchange="selectForm()">
		<option value="prod_form" >Add Product</option>		<!--Value matches form id -->
		<option value="edit_prod_form" onclick="product_request('UPDATE')">Edit Product</option>
		
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
		<h1>Statistics...</h1><br>
		<h3>Placed Orders:</h3>
		
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
