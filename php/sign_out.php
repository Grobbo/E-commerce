<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(array_key_exists('submit',$_POST)){
		session_start();		
		session_unset();
		session_destroy();
	}
	header("Location: ../index.php");
}

?>
