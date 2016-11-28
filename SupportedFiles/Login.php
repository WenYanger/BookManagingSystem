<?php
require_once("SupportedFiles/Db.php");
require_once("SupportedFiles/Response.php");
class Login{
	static public function log_in($user_id,$password){
		$connect = Db::getInstance()->connect();
		if($connect){ 
			$sql = "select * from User where user_id='{$user_id}'";
			$result = $connect->query($sql);
			$info = $result->fetch_array();
			//一定要区分大小写，与数据库中的保持一致
			if($info[password] == $password){
				/*echo "<script>alert('Login Success!');</script>";
				  $url = '../Main.php';
				  echo ("<script>window.open('".$url."');</script>"); 
				  */
				Response::show(400,'Log in Success');
				return 400;
			}else{
				/*echo "<script>alert('Login Failed!');</script>";
				return Response::show(401,"Wrong Password");
				*/
				Response::show(401,'Wrong Password');
				return 401;
			}
		}else{
			/*return Response::show(400,"Database Connection Failed");*/
			Response::show(402,'Database Failed');
			return 402;
		}
	}
}

?>