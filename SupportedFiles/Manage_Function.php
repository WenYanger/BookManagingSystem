<?php
require_once("Login.php");
require_once("Register.php");
require_once("Db.php");


switch($_POST['function_id']){
	case 'book_reg':
		if(checkAttribute('book_reg')){
			$bookname=$_POST['bookname'];
			$bookSerialNumber=$_POST['bookSerialNumber'];
			$author=$_POST['author'];
			$press=$_POST['press'];
			$pressTime=$_POST['pressTime'];
			$bookID=1;
			$connect = Db::getInstance()->connect();
			if($connect){
				$sql =  "select BookID from `book` where BookName='{$bookname}' order by BookID desc";
				$result = $connect->query($sql);
				if($result){
					$info=mysqli_fetch_array($result,MYSQLI_ASSOC);
					$bookID = $info['BookID'] +1;
				}
				
				$sql =  "insert into `book` (bookname,bookserialid,author,press,presstime,status,bookid)";
				$sql .= " VALUES ('{$bookname}','{$bookSerialNumber}','{$author}','{$press}','{$pressTime}','可借','{$bookID}')";
				$result = $connect->query($sql);
				if($result){
					sendResult(800,'录入成功');
				}else{
					sendResult(803, $sql);
				}
				
			}else{
				sendResult(802,'数据库连接失败');
			}
		}else{
			sendResult(801,'输入不能为空');
		}
		break;
	
	default:
	break;
}

function checkAttribute($type){
	switch($type){
		case 'book_reg':
			if(empty($_POST['bookname'])||empty($_POST['bookSerialNumber'])||empty($_POST['author'])||empty($_POST['press'])||empty($_POST['pressTime'])){
				return false;
			}else{
				return true;
			}
		break;
		default:
		break;
	}
}
function sendResult($code, $info){
	$result_array = array(
		'code' => $code,
		'info' => $info
	);
	echo json_encode($result_array);
}
?>