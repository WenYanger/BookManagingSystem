<?php
require_once("Db.php");
require_once("Response.php");
class Register{
	static public function regist($user_id,$password){
		$connect = Db::getInstance()->connect();
		if($connect){ 
			if(self::checkUserAvailability($user_id)){
				$sql = "insert into User value ('".$user_id."','".$password."')";
			    $result = $connect->query($sql);
				if($result){
					Response::show(404,'Register Success');
					return 404;
				}else{
					Response::show(405,mysqli_error($connect));
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
	static public function checkUserAvailability($user_id){
		$connect = Db::getInstance()->connect();
		if($connect){ 
			$sql = "select * from User where user_id='{$user_id}'";
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