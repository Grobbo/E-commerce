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



	<?php
		if(array_key_exists('sign_up',$_POST)){
			$username = $_POST["user_username"];			
			$password = $_POST["user_password"];
			$f_name = $_POST["user_fname"];			
			$s_name = $_POST["user_sname"];
			$address = $_POST["user_address"];			
			$email = $_POST["user_email"];
			$postalcode = $_POST["user_postal_code"];
			$country = $_POST["user_country"];
			$city = $_POST["user_city"];
			
			create_new_user($username,$password,$f_name,$s_name,$address,$email,$postalcode,$country,$city);
		}
		
	?>
	
	<a href="login.php">Login</a>
</body>
</html>
