<html>
<head>
<title>E-commerce site for tools </title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<?php
include "php/add_user.php";
?>

 	<div class="dropdown">
	<button class="dropbtn">Tools</button>
		<div class="dropdown-content">
			<a href="#">Hammer</a>
   		 	<a href="#">Drill</a>
   		 	<a href="#">Screwdriver</a>
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
		First Name:<input type="text" name="user_fname" id ="user_fname"/>
		<br/>
		Surname:<input type="text" name="user_sname" id ="user_sname"/>
		<br/>
		<input type="submit" name="add_user" value="ADD USER"/>
		

	</form>

	<?php
		if(array_key_exists('add_user',$_POST)){
			$f_name = $_POST["user_fname"];			
			$s_name = $_POST["user_sname"];			
			create_new_user($f_name,$s_name);
		}
		
	?>

	<a href="login.php">Login</a>
</body>
</html>
