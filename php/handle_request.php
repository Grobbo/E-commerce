<?php

function handle_request(){
	if($_SERVER["REQUEST_METHOD"] == "GET"){	
		if(array_key_exists('search_string',$_GET)){
			echo "$_GET[search_string]" . "<= SEARCHED FOR";
		}
		if(array_key_exists('display',$_GET)){
			switch($_GET['display']){
			case 'all':
				echo "ALL TOOLS";
				break;
			case 'drills':
				echo "DRILLS";
				break;
			case 'screwdrivers':
				echo "SCREWDRIVERS";
				break;
			case 'hammers':
				echo "HAMMERS";
				break;
			}
		}	
	}
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(array_key_exists('sign_up',$_POST)){  // NEED VALIDATION
			$username = $_POST["user_username"];			
			$password = $_POST["user_password"];
			$f_name = $_POST["user_fname"];			
			$s_name = $_POST["user_sname"];
			$address = $_POST["user_address"];			
			$email = $_POST["user_email"];
			$postalcode = $_POST["user_postal_code"];
			$country = $_POST["user_country"];
			$city = $_POST["user_city"];
			
			create_new_user($username,
					$password,
					$f_name,
					$s_name,
					$address,
					$email,
					$postalcode,
					$country,
					$city);
			echo "USER CREATED";
		}
	
	}	
}	
?>
