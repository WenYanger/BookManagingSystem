// JavaScript Document

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
			var usertype = result_json.usertype;
			if(usertype==1){//如果是管理员，则继续处理
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
						alert('密码错误!');
						break;
					case 402:
						alert('服务器数据库连接失败，请咨询管理员!');
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
			}else if(usertype==0){//如果不是管理员，则登录失败
				alert('该账户没有管理员权限!');
			}else{
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
						alert('密码错误!');
						break;
					case 402:
						alert('服务器数据库连接失败，请咨询管理员!');
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

//搜索逻辑
function searchBook(){
	$.ajax({
		type: "POST",
		dataType:"html",
		url:"SupportedFiles/Home_Function.php",
		data:$('#search').serialize(),
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
}

//书籍录入
function book_register(){
	$.ajax({
		type: "POST",
		dataType:"html",
		url:"SupportedFiles/Manage_Function.php",
		data:$('#book_reg').serialize(),
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
			var status_code = result_json.code;
			switch(status_code){
				case 800:
					alert('书籍添加成功');
					break;
				default:
					alert(data);
					break;
			}
		}
	});
}