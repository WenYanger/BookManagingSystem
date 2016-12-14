<?php
json();

$result_array = array(
	'row' => 0,
	'code' => 0,
	'message' => '',
	'data' => array()
);

$data_array = array(
	'status' =>'',
	'bookname' =>'',
	'bookID' =>'',
	'bookserialID' =>'',
	'borrower' =>''
);


function json(){
	
	echo json_encode($result_array);
}
function config_resultArray($row, $code, $message, $data = array()){
	$result_array['row']=$row;
	$result_array['code']=$code;
	$result_array['message']=$message;
	$result_array['data']=$data;
}

function config_dataArray($status='',$bookname,$bookID,$bookserialID,$borrower){
	$data_array['stauts']=$status;
	$data_array['bookname']=$bookname;
	$data_array['bookID']=$bookID;
	$data_array['bookserialID']=$bookserialID;
	$data_array['borrower']=$borrower;
}
?>