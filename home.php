<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>星辰图书管理系统</title>
<link type="text/css" rel="stylesheet" href="CSS/home_desktop.css" media="only screen and (min-width:480px)"/>
<script type="text/javascript" src="JavaScript/PerfectMove.js"></script>
<script type="text/javascript" src="JavaScript/HomeFunction.js"></script>
<script type="text/javascript" src="JavaScript/JQuery/jquery-3.1.1.js"></script>
<script>

//全局变量
var login_status = 0;
var current_user = "Default User";
var shown = false;
var changed = false;
var optionsShown = false;

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
				$('#login_content').css('display','block');
				startMove(loginContent,{'opacity':100});
			}else{
				shown = false;
				startMove(loginContent,{'opacity':0});
				$('#login_content').css('display','none');
			}
		}else if(login_status == 1){
			var userContent = document.getElementsByClassName('user_content')[0];
			if(shown==false){
				shown = true;
				$('#user_content').css('display','block');
				startMove(userContent,{'opacity':100});
			}else{
				shown = false;
				startMove(userContent,{'opacity':0});
				$('#user_content').css('display','none');
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
			$('#login_content').css('display','none');
			
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
		$('#user_content').css('display','none');
	});
	
	//为search_range添加点击机制
	$('.search_range').click(
		function(){
			if(!optionsShown){
				optionsShown=true;
				$('.search_range_options').css('display','block');
			}else{
				optionsShown=false;
				$('.search_range_options').css('display','none');
			}
		}
	);
	
	//为options添加点击机制
	$('.options').click(
		function(){
			
			var option = this.innerHTML;
			$('.search_range').html(option);
			$('.search_type').val(option);
			
			if(!optionsShown){
				optionsShown=true;
				$('.search_range_options').css('display','block');
			}else{
				optionsShown=false;
				$('.search_range_options').css('display','none');
			}
		}
	);
	
	$('#manager_div_manage').click(
		function(){
			var c = document.getElementById('manager_div_manage_checkdiv');
			var op = $('#manager_div_manage_checkdiv').css('opacity');
			if(op==0){
				startMove(c,{'opacity':100});
			}else{
				startMove(c,{'opacity':0});
			}
		
		}
	);
	
};

document.onkeydown=function(event){
	var e = event || window.event || arguments.callee.caller.arguments[0];
	if(e && e.keyCode==27){ // 按 Esc 
		//要做的事情
	}
             
    if(e && e.keyCode==13){ // enter 键
	 	document.getElementById("search_button").click();
    }
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
            <div class="login_content" id="login_content" style="display: none;">
                <form method="post" id="login">
                    <input type="text" name="username" class="login_content_input" placeholder="支持QQ号/邮箱/手机号登录">
                    <input type="text" name="password" class="login_content_input" placeholder="密码">
                    <input type="text" name="function_id" value="log" style="display:none">
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
                    <input type="text" name="register_username"         class="register_content_input" placeholder="支持QQ号/邮箱/手机号注册">
                    <input type="text" name="register_password"         class="register_content_input" placeholder="密码">
                    <input type="text" name="register_confirm_password" class="register_content_input" placeholder="确认密码">
                    <input type="text" name="function_id" value="reg" style="display:none">
                    <button type="button" class="register_content_submit" id="register_submit" style="background:#BCFFC0;" onClick="register()">注册</button>
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
            	<form method="get" action="search.php">
            		<input type="text" name="search_text" class="search_input">
                    <input type="text" name="search_type" class="search_type" style="display:none">
                	<input type="submit" class="search_button1" id="search_button">
                    <input type="text" name="function_id" value="search" style="display:none">
                </form>
                
            </div>
            <div class="search_range">
            	关键字
            </div>
            <div class="search_range_options">
            	<ul>
                	<li class="options">关键字</li>
                	<li class="options">书名</li>
                    <li class="options">作者</li>
                    <li class="options">书籍类别</li>
                </ul>
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
            <div class="manager_div_manage" id="manager_div_manage">
            	<span class="cha-vers">后台管理</span>
            </div>
            <div class="manager_div_manage_checkdiv" id="manager_div_manage_checkdiv">
                <form method="post" id="manage">
                    <input type="text" placeholder="输入后台密匙" name="manageKey" style=" position:absolute; top:5px; left:5px; height:30px;">
                    <input type="button" value="确定" style="position:absolute; top:5px; left:160px; height:36px; width:55px;" onClick="checkManage()">
                    <input type="text" name="function_id" value="mag" style="display:none">
                </form>
            </div>
            
        </div>
    </div>
    <div class="foot">
    </div>
</body>
</html>
