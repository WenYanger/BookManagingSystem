// JavaScript Document

function show_result(html,rows){
	var height=0;
	var number_of_results=rows;
	while(number_of_results--){
		height+=185;
	}
	height+=30;
	$('#result_content_div').append(html);
	$('#result_content_div').css('height',height);
}
function construct_result(bookname,bookID,status){
	var html="";
	html+="<div class='result_content'>";
	html+="	<p>"+bookname+"</p>";
	html+="	<p>"+bookID+"</p>";
	html+="	<p>"+status+"</p>";
	html+="</div>";
	return html;
}

//搜索逻辑
function toSearch(){
	//每次search之前都要先清空原来div的内容
	$('#result_content_div').html('');
	$.ajax({
		type: "POST",
		dataType:"json",
		url:"SupportedFiles/Search_Function.php",
		data:$('#search').serialize(),
		async: true,
		error: function(request) {
			alert("Connection error");
		},
		success: function(data) {
			/**
				根据data返回值的数字status_code，判断登录情况
				700： 搜索成功
			*/
			var result_json = eval(data);
			
			var status_code = result_json.code;
			var rows_number = result_json.row;
			
			var html='';
			var bookname='';
			var bookID='';
			var status='';
			//遍历json数据
			$.each(result_json.data,function(idx,item){
				
				bookname=item.bookname;
				bookID=item.bookID;
				status=item.status;
				//输出每个root子对象的名称和值 
				//alert("BookName:"+item.bookname+",BookID:"+item.bookID+",Status:"+item.status); 
				html+=construct_result(bookname,bookID,status);
				
				
			});
			
			show_result(html,rows_number);
			
			switch(status_code){
				case 700:
					break;
				default:
					alert(data);
					break;
			}
		}
	});
};