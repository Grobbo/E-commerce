<html>
<head>
<title>E-commerce site for tools </title>

</head>
<body>

<?php
include "navigationbar.php";
include "php/add_user.php";
include "php/handle_request.php";
?>

 	
	
	<a href="login.php" style="padding-left: 10px;">Login</a>

	<form action="index.php" method="GET" style="padding-top: 10px;">
	Search: <input type="text" name="search_string">
	<select name="criteria">
	<option value="category">Category</option>
	<option value="manufacturer">Manufacturer</option>
	</select>
	<input type="submit" value="Search">
	</form>

	<?php
		handle_request();
	?>

	<div name="canvas" id="canvas">
	<!-- DISPLAY RESULTS IN THIS DIV -->
	</div>
</body>
</html>
