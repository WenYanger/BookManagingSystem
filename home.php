<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>星辰图书管理系统</title>
<link type="text/css" rel="stylesheet" href="CSS/home_desktop.css" media="only screen and (min-width:480px)"/>
<script type="text/javascript" src="JavaScript/PerfectMove.js"></script>
<script type="text/javascript" src="JavaScript/JQuery/jquery-3.1.1.js"></script>
<script>

//全局变量
var login_status = 0;
var current_user = "Default User";
var shown = false;
var changed = false;

function show_register_content(){
	var login_register_outer_content = document.getElementById('login_register_outer_content');
	var register_content = document.getElementById('register_content');
	$('#login_content').css('display','none');
	$('#register_content').css('display','block');
	startMove(login_register_outer_content,{'opacity':100,'height':450});
	startMove(register_content,{'opacity':100});
}

function hide_register_content(){
	var login_register_outer_content = document.getElementById('login_register_outer_content');
	var registerContent = document.getElementById('register_content');
	var loginContent = document.getElementById('login_content');
	changed = true;
	
	startMove(registerContent,{'opacity':0});
	startMove(loginContent,{'opacity':100});
	startMove(login_register_outer_content,{'height':350});
	$('#register_content').css('display','none');
	$('#login_content').css('display','block');
}
	
window.onload = function(){
	
	$('#header_content').click(function(){
		if(login_status == 0){
			var loginContent = document.getElementsByClassName('login_register_outer_content')[0];
			if(shown==false){
				shown = true;
				startMove(loginContent,{'opacity':100});
			}else{
				shown = false;
				startMove(loginContent,{'opacity':0});
			}
		}else if(login_status == 1){
			var userContent = document.getElementsByClassName('user_content')[0];
			if(shown==false){
				shown = true;
				startMove(userContent,{'opacity':100});
			}else{
				shown = false;
				startMove(userContent,{'opacity':0});
			}
		}
	});
	
	//登录前，登录界面悬停显示
	$('#login_register_outer_content').mouseleave(function(){
		if(changed == true){
		}else{
			shown = false;
			var login_content = document.getElementsByClassName('login_register_outer_content')[0];
			startMove(login_content,{'opacity':0});
		}
	});
	$('#login_register_outer_content').mouseenter(function(){
		if(changed == true){
			changed = false;
		}
	});
	
	//登录后，用户信息界面悬停显示
	$('#user_content').mouseleave(function(){
		shown = false;
		var user_content = document.getElementsByClassName('user_content')[0];
		startMove(user_content,{'opacity':0});
	});
	
};
	
	

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
	//退出登录
	function logout(){
		login_status = 0;
		$('#user_name1').css('display','block');
		$('#user_name2').css({'display':'none'});
		$('#user_name2').html("登录");
		
		$('#login_content').css('display','block');
		$('#user_content').css('display','none');
	};
	
</script>
</head>

<body>
    <div class="header"">
    	<div class="header_content" id="header_content">
        	<a class="login"">
            	<span class="cha-vers" id="user_name1" style="display:block;">登录</span>
                <span class="cha-vers" id="user_name2" style="display:none;">登录</span>
            </a>
        </div>
        <div class="login_register_outer_content" id="login_register_outer_content">
            <div class="login_content" id="login_content" style="display: block;">
                <form method="post" id="login">
                    <input type="text" name="username" class="login_content_input" placeholder="支持QQ号/邮箱/手机号登录">
                    <input type="text" name="password" class="login_content_input" placeholder="密码">
                    <!--<input type="submit" name="login_submit" class="login_content_submit" value="登录">-->
                    <button type="button" class="login_content_submit" id="login_submit" onClick="login()">登录</button>
                </form>
                <div class="OtherButton"> 
                    <a href="forget_password.php" class="link" id="forgetpwd" target="_blank">忘了密码？</a>&nbsp; <span class="dotted">|</span> &nbsp;
                    <a href="javascript:show_register_content()" class="link" target="_parent">注册新账号</a> &nbsp;<span class="dotted">|</span> &nbsp;
                    <a href="register.php" class="link" target="_blank">意见反馈</a> 
                </div>
            </div>
            <div class="register_content"  id="register_content" style="display: none;">
            	<span style="position:relative;  color:#FFFFFF; font-size:24px;">星辰快速注册</span>
                <form method="post" id="register">
                    <input type="text" name="username"         class="register_content_input" placeholder="支持QQ号/邮箱/手机号注册">
                    <input type="text" name="password"         class="register_content_input" placeholder="密码">
                    <input type="text" name="confirm_password" class="register_content_input" placeholder="确认密码">
                    <button type="button" class="register_content_submit" id="register_submit" style="background:#BCFFC0;">注册</button>
                    <button type="button" class="register_content_submit" id="register_submit" style="background:#FF7275;" onClick="hide_register_content()">取消</button>
                </form>
            </div>
        </div>
        <div class="user_content" id="user_content" style="display: none;">
            <div class="user_basicInfo">
                <div class="user_image"></div>
                <div class="user_info">
                	<ul>
                    	<li id="li_username"></li>
                        <li></li>
                    </ul>
                </div>
            </div>
            <div class="user_bookInfo">
            	<button type="button" class="logout_button" id="logout_button" onClick="logout()">退出</button>
            </div>
        </div>
       
    </div>
    
    <div class="intro_content">
    	<img src="Image/logo_StarStudio_UESTC.png">
    </div>
    <div class="search_content">
    	<img src="Image/banner_StarStudio_UESTC.png" class="search_bg">
        <div class="search_field">
        	<div class="search_condition">
            	<ul class="search_type">
                	<li class="curr"> 馆藏目录 </li>
                    <li class> 英文搜索 </li>
                    <li class> 中文搜索 </li>
                </ul>
            </div>
            <div class="search_text">
            	<span class="search_button_text">搜索</span>
            	<form method="post" action="SupportedFiles/Home_Function.php">
            		<input type="text" name="search_text" class="search_input">
                	<input type="submit" class="search_button1">
                </form>
                
            </div>
        </div>
    </div>
    <div class="nav_content_div">
    	<div class="nav_content">
        	<div class="nav_content_left">
            	<div class="nav_content_left_content">
                </div>
            </div>
            <div class="nav_content_right">
            	<div class="nav_content_left_content">
                </div>
            </div>
        </div>
    </div>
    <div class="manager_div">
    	<div class="manager">
        	<a href="http://www.uestc.edu.cn" class="manager_div_school">
            	<span class="cha-vers">学校首页</span>
            </a>
            <a href="http://www.uestc.edu.cn" class="manager_div_studio">
            	<span class="cha-vers">星辰工作室</span>
            </a>
            <a href="http://www.uestc.edu.cn" class="manager_div_manage">
            	<span class="cha-vers">后台管理</span>
            </a>
        </div>
    </div>
    <div class="foot">
    </div>
</body>
</html>
