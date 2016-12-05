<?php
require_once("Login.php");
require_once("Register.php");

if($_POST['function_id'] == 'log'){
	//登录逻辑
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
}else if($_POST['function_id'] == 'reg'){
	//注册逻辑
	if(checkAvailablity($_POST['register_username']) && checkAvailablity($_POST['register_password']) && checkAvailablity($_POST['register_confirm_password'])){
		$username = $_POST['register_username'];
		$password = $_POST['register_password'];
		$confirm_password = $_POST['register_confirm_password'];
		if($_POST['register_password'] == $_POST['register_confirm_password']){
			/**
					根据regist返回值，判断注册情况
					500：注册成功
					501：数据库错误
					502：用户已注册
					503: 数据库连接失败
			*/
			switch(Register::regist($username,$password)){
				case 500:
					$result_array = array(
						'code' => 500
					);
					break;
				case 501:
					$result_array = array(
						'code' => 501
					);
					break;
				case 502:
					$result_array = array(
						'code' => 502
					);
					break;
				case 503:
					$result_array = array(
						'code' => 503
					);
					break;
				default:
					break;
			}
		}else{
			$result_array = array(
				'code' => 504,
				'info' => "两次输入密码不一致"
			);
			echo json_encode($result_array);
		}
	}else{
		$result_array = array(
			'code' => 505,
			'info' => "输入不合法"
		);
		echo json_encode($result_array);
	}
}










function checkAvailablity($property){
	if(isset($property) && !empty($property)){
		return true;
	}else{
		return false;
	}
}
?>