<?php
require_once("Db.php");
require_once("Response.php");
class Register{
	/**
	*按注册状态返回注册情况
	*@param string $user_name 用户名
	*@param string $password 密码
	*return int
	*/
	/*
	500：注册成功
	501：数据库错误
	502：用户已注册
	503: 数据库连接失败
	*/
	static public function regist($user_name,$password){
		$connect = Db::getInstance()->connect();
		if($connect){ 
			if(self::checkUserAvailability($user_name)){
				$sql = "insert into `user` (username,password) VALUES ('".$user_name."','".$password."')";
			    $result = $connect->query($sql);
				if($result){
					//Response::show(404,'Register Success');
					return 500;
				}else{
					//echo Response::show(405,mysqli_error($connect));
					return 501;
				}
			} else {
				//Response::show(403,'User already exists');
				return 502;
			}
		}else{
			//Response::show(402,'Database Failed');
			return 503;
		}
	}
	
	/**
	*按注册状态返回注册情况
	*@param string $user_name 用户名
	*@param string $password 密码
	*return int
	*/
	private function checkUserAvailability($user_name){
		$connect = Db::getInstance()->connect();
		if($connect){ 
			$sql = "select * from `user` where username='{$user_name}'";
			$result = $connect->query($sql);
			$number = mysqli_fetch_row($result);
			if($number==0){
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
}
?>