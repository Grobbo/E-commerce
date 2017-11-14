<html>
<head>
<title>E-commerce site for tools </title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
include "php/add_user.php";
include "php/handle_request.php";
?>

 	<div class="dropdown">
	<button class="dropbtn">Tools</button>
		<div class="dropdown-content">
			<a href="index.php?display=all">All</a>
			<a href="index.php?display=hammers">Hammers</a>
   		 	<a href="index.php?display=drills">Drills</a>
   		 	<a href="index.php?display=screwdrivers">Screwdrivers</a>
  		</div class="dropdown">
	</div>
	<div class="dropdown">
	<button class="dropbtn">Devs</button>
                  <div class="dropdown-content">
                	<a href="#">Erik Sundström</a>
                 	<a href="#">Ludvig Isaksson</a>
                </div class="dropdown">
	</div>
	
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
