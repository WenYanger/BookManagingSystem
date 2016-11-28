<?php
require_once("Db.php");
require_once("Response.php");
class Register{
	static public function regist($user_name,$password){
		$connect = Db::getInstance()->connect();
		if($connect){ 
			if(self::checkUserAvailability($user_name)){
				$sql = "insert into 'user' (username,password) VALUES ('".$user_name."','".$password."')";
			    $result = $connect->query($sql);
				if($result){
					Response::show(404,'Register Success');
					return 404;
				}else{
					echo Response::show(405,mysqli_error($connect));
					return 405;
				}
			} else {
				Response::show(403,'User already exists');
				return 403;
			}
		}else{
			Response::show(402,'Database Failed');
			return 402;
		}
	}
	static public function checkUserAvailability($user_name){
		$connect = Db::getInstance()->connect();
		if($connect){ 
			$sql = "select * from 'user' where username='{$user_name}'";
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