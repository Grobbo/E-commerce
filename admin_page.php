<html>
<head>
<link rel="stylesheet" type="text/css" href="admin_page.css">
</head>
<body onload="selectForm()">
<?php
include("navigationbar.php");
?>
	<br>
	<div class="management">
	<select id="select_form" onchange="selectForm()">
		<option value="prod_form">Add Product</option>
		<option value="edit_prod_form">Edit Product</option>
		<option value="blue">Test 2</option>
	</select>

	<form id="prod_form" method="post" action="">
		<h3>Add Product</h3>
		Product category<br> <input type="text" name="prod_cat"/><br>
		Product manufacturer<br> <input type="text" name="prod_man"/><br>
		Product description<br> <input type="text" name="prod_desc"/><br>
		Product price<br> <input type="text" name="prod_price"/><br>
		Product quantity<br> <input type="text" name="prod_quantity"/><br>

		<input type="submit" name="add_product" value="Add Product"/>
		
	</form>

	<form id="edit_prod_form">		
		<h3>Edit a Product!</h3>	<!--change names-->
		Product id<br> <input type="text" name="prod_name"/><br>
		new category<br> <input type="text" name="prod_cat"/><br>
		new manufacturer<br> <input type="text" name="prod_man"/><br>
		new description<br> <input type="text" name="prod_desc"/><br>
		new price<br> <input type="text" name="prod_price"/><br>
		new quantity<br> <input type="text" name="prod_quantity"/><br>

		<input type="submit" name="edit_prod" value="Edit Product"/>
		
	</form>

	</div>
	<div class="statistics">
		<h1>Statistics...</h1><br>
		<h3>Placed Orders:</h3>
		
	</div>


	
	<script>
	function selectForm(){
		var select = document.getElementById("select_form");
		for(var i=0;i<select.options.length;i++){
			if(select.options[i].value == select.value){				
				document.getElementById(select.options[i].value).style.display = "block";
				
			}else{
				document.getElementById(select.options[i].value).style.display = "none";
			}
		}
	}
	</script>

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
