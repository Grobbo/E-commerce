<link rel="stylesheet" type="text/css" href="style.css">

<div class="header" id="header">
		
	<a href="index.php" class="dropbtn">Home</a>
	
	<div class="dropdown">	
	<button class="dropbtn">Tools</button>
		<div class="dropdown-content">
			<a href="javascript:tool_request('all');">All</a>
			<a href="javascript:tool_request('hammers');">Hammers</a>
   		 	<a href="javascript:tool_request('saws');">Saws</a>
   		 	<a href="javascript:tool_request('screwdrivers');">Screwdrivers</a>
  		</div class="dropdown">
	</div>
	<div class="dropdown">
	<button class="dropcart">Shopping Cart</button>
		<div class="dropdown-content">
			<div class="cart_content" id="cart_content">
				placeHolder for Cart...
			</div>
			<br>
			<div class="checkout" id="checkoutDiv">
				
			</div>
		</div class="dropdown">
	</div class="dropdown">
	



<?php
	if(!isset($_SESSION)){ 
        session_start(); 
	} 
	if(isset($_SESSION['u_name'])){
		echo '<form class="dropdownform" action="php/sign_out.php" method="POST">
		<button type="submit" name="submit">Sign out</button>
		</form>';
		
	}else{
		echo '<form class="dropdownform" action="login.php" method="POST">
		<input type="text" name="user_name" placeholder="Username">
		<input type="password" name="user_password" placeholder="Password">
		<button type="submit" name="sign_in">Log in</button>
		</form>
		<form class="dropdownform" action="signup.php">	
		<button type="submit">Register user</button>
		</form>
	';
	}

?>


</div>


