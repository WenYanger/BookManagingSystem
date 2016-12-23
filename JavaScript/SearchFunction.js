// JavaScript Document

// Required 
// <script type="text/javascript" src="JavaScript/PerfectMove.js">
// <script type="text/javascript" src="JavaScript/JQuery/jquery-3.1.1.js">

function show_result(html,rows){
	var height=0;
	var number_of_results=rows;
	while(number_of_results--){
		height+=105;
	}
	height+=30;
	$('#result_content_div').append(html);
	$('#result_content_div').css('height',height);
}
function construct_result(bookname,bookID,status,author,press,presstime){
	var html="";
	html+="<div class='result_content' onMouseOver=\"show_border(this)\" onMouseOut=\"hide_border(this)\">";
	html+="	<div class=\"result_content_top\">"+bookname+"</div>";
	html+="	<div class=\"result_content_text\">"+author+"</div>";
	html+="	<div class=\"result_content_text\">"+press+","+presstime+"</div>";
	html+="	<div class=\"result_content_text\">"+"书籍ID: "+bookID+"</div>";
	html+="	<div class=\"result_content_text\">"+"书籍状态: "+status+"</div>";
	html+="</div>";
	return html;
}
function show_border(target){
	target.style['border']="rgba(255,255,255,0.8) solid 2px";  
}
function hide_border(target){
	target.style['border']="rgba(255,255,255,0) solid 2px"; 
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
			var author='';
			var press='';
			var presstime='';
			//遍历json数据
			$.each(result_json.data,function(index,item){
				
				bookname=item.bookname;
				bookID=item.bookID;
				status=item.status;
				author=item.author;
				press=item.press;
				presstime=item.presstime;
				//输出每个root子对象的名称和值 
				//alert("BookName:"+item.bookname+",BookID:"+item.bookID+",Status:"+item.status); 
				html+=construct_result(bookname,bookID,status,author,press,presstime);
				
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

//处理登录弹框动画

//登陆逻辑
function login(){
	$.ajax({
		type: "POST",
		dataType:"html",
		url:"SupportedFiles/Home_Function.php",
		data:$('#login').serialize(),
		async: true,
		error: function(request) {
			alert("Connection error");
		},
		success: function(data) {
			//$("#commonLayout_appcreshi").parent().html(data);
			/**
				根据data返回值的数字status_code，判断登录情况
				400：登录成功
				401：密码错误
				402：服务器数据库连接失败
				403: 用户未注册
				404: 用户名不合法
			*/
			var result_json = JSON.parse(data); //由JSON字符串转换为JSON对象
			current_user = result_json.username;
			var status_code = result_json.code;
			var user_name = result_json.username;
			switch(status_code){
				case 400:
					login_status = 1;
					$('#user_name1').css('display','none');
					$('#user_name2').css({'display':'block','width':'300px'});
					$('#user_name2').html("欢迎你！"+user_name);
					
					$('#login_content').css('display','none');
					$('#user_content').css('display','block');
					
					//填充用户详细信息
					document.getElementById("li_username").innerHTML=current_user;
					break;
				case 401:
					break;
				case 402:
					break;
				case 403:
					alert('该用户名未注册!');
					break;
				case 404:
					alert('用户名不合法!');
					break;
				default:
					alert(data);
					break;
			}
		}
	});
};

//注册逻辑
function register(){
	$.ajax({
		type: "POST",
		dataType:"html",
		url:"SupportedFiles/Home_Function.php",
		data:$('#register').serialize(),
		async: true,
		error: function(request) {
			alert("Connection error");
		},
		success: function(data) {
			/**
				根据data返回值的数字status_code，判断登录情况
				500：注册成功
				501：数据库错误
				502：用户已注册
				503: 数据库连接失败
				504: 两次输入密码不一致
				505: 输入不合法
			*/
			var result_json = JSON.parse(data); //由JSON字符串转换为JSON对象
			current_user = result_json.username;
			var status_code = result_json.code;
			var user_name = result_json.username;
			switch(status_code){
				case 500:
					alert('注册成功');
					login_status = 1;
					$('#user_name1').css('display','none');
					$('#user_name2').css({'display':'block','width':'300px'});
					$('#user_name2').html("欢迎你！"+user_name);
					
					$('#login_content').css('display','none');
					$('#user_content').css('display','block');
					
					//填充用户详细信息
					document.getElementById("li_username").innerHTML=current_user;
					break;
				case 501:
					alert('数据库错误');
					break;
				case 502:
					alert('用户已注册');
					break;
				case 503:
					alert('数据库连接失败');
					break;
				case 504:
					alert('两次输入密码不一致');
					break;
				case 505:
					alert('输入不合法');
					break;
				default:
					alert(data);
					break;
			}
		}
	});
};

//退出登录
function logout(){
	login_status = 0;
	$('#user_name1').css('display','block');
	$('#user_name2').css({'display':'none'});
	$('#user_name2').html("登录");
	
	$('#login_content').css('display','block');
	$('#user_content').css('display','none');
};