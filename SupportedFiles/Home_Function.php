<?php
require_once("Login.php");
require_once("Register.php");

$result_array = array(
	'code' => 0,
	'info' => '',
	'username' =>''
);

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
					504: 两次输入密码不一致
					505: 输入不合法
			*/
			$regist_result=Register::regist($username,$password);
			switch($regist_result){
				case 500:
					sendResult(500,'Regist Success',$_POST['register_username']);
					break;
				case 501:
					sendResult(501,'DataBase Failed');
					break;
				case 502:
					sendResult(502,'User Already Existed');
					break;
				case 503:
					sendResult(503,'Cannot Connect to DataBase');
					break;
				default:
					sendResult($regist_result,'Error');
					break;
			}
		}else{
			sendResult(504,'两次输入密码不一致');
		}
	}else{
		sendResult(505,'输入不合法');
	}
}else if($_POST['function_id'] == 'search'){
	//搜索逻辑
	/**
			根据字符串，进行搜索
			500：注册成功
			501：数据库错误
			502：用户已注册
			503: 数据库连接失败
			504: 两次输入密码不一致
			505: 输入不合法
	*/
	$text=$_POST['search_text'];
	if(!empty($text)){
	}else{
		sendResult(601,'搜索目标字符串不能为空');
	}
}








function sendResult($code, $info, $username=''){
	$result_array['code']=$code;
	$result_array['info']=$info;
	$result_array['username']=$username;
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