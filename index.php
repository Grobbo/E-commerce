<html>
<head>
<title>E-commerce site for tools </title>
<link rel="stylesheet" type="text/css" href="style.css">


<?php
include "php/add_user.php";
?>



 	<div class="dropdown">
	<button class="dropbtn">Könisar</button>
		<div class="dropdown-content">
			 <a href="#">Syfilis</a>
   		 	<a href="#">Gonorre</a>
   		 	<a href="#">Condylom</a>
  		</div class="dropdown">
	</div>
	<div class="dropdown">
	<button class="dropbtn">Devs</button>
                  <div class="dropdown-content">
                	 <a href="#">Erik Sundström</a>
                 	<a href="#">Ludvig Isaksson</a>
                </div class="dropdown">
	</div>

	<form method="POST">
		<input type="submit" name="add_user" value="ADD USER" />
		<input type="text" name="user_fname" id ="user_fname"/>

	</form>

	<?php
		if(array_key_exists('add_user',$_POST)){
			$f_name = $_POST["user_fname"];
			create_new_user($f_name);
		}
		
	?>




</html>
