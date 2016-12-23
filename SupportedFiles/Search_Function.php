<?php
require_once("Db.php");


if(@$_POST['function_id'] == 'search'){
	//搜索逻辑
	$str = $_POST['search_text'];
	searchText($str);
}



function searchText($text){
	$connect = Db::getInstance()->connect();
	if($connect){ 
	
		$sql = "select * from `book` where BookName like '%{$text}%'";
		$count_row=0;
		if ($result=mysqli_query($connect,$sql))
		{
			
			$data_array = array();
			// 一条条获取
			while ($row=mysqli_fetch_assoc($result))
			{
				$count_row++;
				
				$row_array = array(
					'status' =>$row['Status'],
					'bookname' =>$row['BookName'],
					'bookID' =>$row['BookID'],
					'bookserialID' =>$row['BookSerialID'],
					'borrower' =>$row['Borrower'],
					'author'=>$row['Author'],
					'press'=>$row['Press'],
					'presstime'=>$row['PressTime']
				);
				
				array_push($data_array,$row_array);
				
			}
			
			$result_array = array(
				'row' => $count_row,
				'code' => 700,
				'message' => 'Success',
				'data' => $data_array
			);
			echo json_encode($result_array,JSON_UNESCAPED_UNICODE);
			
			// 释放结果集合
			mysqli_free_result($result);
		}
		
	}else{
		echo('Connect Failed');
	}
	mysqli_close($connect);
}
	
?>