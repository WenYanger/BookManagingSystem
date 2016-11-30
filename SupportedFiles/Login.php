<?php
require_once("Db.php");
require_once("Response.php");
class Login{
	static public function log_in($username,$password){
		$connect = Db::getInstance()->connect();
		if($connect){ 
			$sql = "select * from `user` where username='{$username}'";
			$result = $connect->query($sql);
			$info=mysqli_fetch_array($result,MYSQLI_ASSOC);
			//一定要区分大小写，与数据库中的保持一致
			if(@$info["Password"] == $password){
				/*echo "<script>alert('Login Success!');</script>";
				  $url = '../Main.php';
				  echo ("<script>window.open('".$url."');</script>"); 
				  */
				$result_array = array(
					'code' => 400,
					'username' => $info["UserName"]
				);
				echo json_encode($result_array);
				//echo 400;
			}else if(@$info["Password"] == ""){
				echo 403;
			}else{
				/*echo "<script>alert('Login Failed!');</script>";
				return Response::show(401,"Wrong Password");
				*/
				//Response::show(401,'Wrong Password');
				echo 401;
			}
		}else{
			/*return Response::show(400,"Database Connection Failed");*/
			//Response::show(402,'Database Failed');
			echo 402;
		}
	}
}

?>