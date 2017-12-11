<?php
session_start();
?>
<html>
<head>
<title>E-commerce site for tools </title>
<link rel="stylesheet" type="text/css" href="items.css">
<script src="js/search.js" type="text/javascript"></script>
</head>
<body onload="getCurrentCart()">

<?php
include "navigationbar.php";
include "php/add_user.php";
?>

	<div name="search" id="search" style="padding-top: 10px;">
	Search: <input type="text" onkeypress=" if (event.keyCode==13) search_request();" name="search_string" id="search_string">
	<select name="criteria" id="criteria">
	<option value="category">Category</option>
	<option value="manufacturer">Manufacturer</option>
	</select>
	Sorted by:
	<select name="sortBy" id="sortBy">
		<option value="price">Price(Ascending)</option>
		<option value="price desc">Price(Descending)</option>
		<option value="rating desc">Rating</option>
	</select>

	<button type="submit" onclick="search_request()" >Search</button>
	</div>

	<div class="canvas" name="canvas" id="canvas">
	</div>

	
</body>
</html>
