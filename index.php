<html>
<head>
<title>E-commerce site for tools </title>
<link rel="stylesheet" type="text/css" href="items.css">
<script src="js/javascript.js" type="text/javascript"></script>
</head>
<body>

<?php
include "navigationbar.php";
include "php/add_user.php";
?>


 	
	
	<a href="login.php" style="padding-left: 10px;">Login</a>
	<div name="search" id="search" style="padding-top: 10px;">
	Search: <input type="text" onkeypress=" if (event.keyCode==13) search_request();" name="search_string" id="search_string">
	<select name="criteria" id="criteria">
	<option value="category">Category</option>
	<option value="manufacturer">Manufacturer</option>
	</select>
	<button type="submit" onclick="search_request()" >Search</button>
	</div>

	<div class="canvas" name="canvas" id="canvas">
		<p id="test"></p>
	</div>

	
</body>
</html>
