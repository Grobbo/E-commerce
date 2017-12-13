<link rel="stylesheet" type="text/css" href="style.css">

<div class="header" id="header">
<p>HELLO!!!</p>

<?php
	if(!isset($_SESSION)){ 
        session_start(); 
	} 
	if(isset($_SESSION['admin'])){
		echo '<form class="dropdownform" action="php/sign_out.php" method="POST">
		<button type="submit" name="submit">Sign out</button>
		</form>';
		
	}else{
		echo '<form class="dropdownform" action="admin_page.php" method="POST">
		<input type="password" name="password" placeholder="Password">
		<button type="submit" name="sign_in">Log in</button>
		</form>';
	}

?>


</div>


