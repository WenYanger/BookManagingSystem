<?php
require_once('SupportedFiles/Db.php');
header("Content-Type:text/html;charset=utf-8");
$con = Db::getInstance()->connect();
if($con){
	$sql = "select * from book";
	$con->query("SET NAMES 'UTF8'");

	$result = $con->query($sql);
	$info=mysqli_fetch_array($result,MYSQLI_ASSOC);
	var_dump($info['Author']);
}else{
	echo 'database connect error';
}


?>
