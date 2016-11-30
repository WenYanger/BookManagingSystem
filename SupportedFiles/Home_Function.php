<?php
require_once("Login.php");
if(checkAvailablity($_POST['username']) && checkAvailablity($_POST['password'])){
	$username = $_POST['username'];
	$password = $_POST['password'];
	echo Login::log_in($username,$password);
}else{
	$result_array = array(
		'code' => 404,
		'username' => ""
	);
	echo json_encode($result_array);
}


function checkAvailablity($property){
	if(isset($property) && !empty($property)){
		return true;
	}else{
		return false;
	}
}
?>