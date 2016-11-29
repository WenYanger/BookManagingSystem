<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>星辰图书管理系统</title>
<link type="text/css" rel="stylesheet" href="CSS/home_desktop.css" media="only screen and (min-width:480px)"/>
<script type="text/javascript" src="JavaScript/PerfectMove.js"></script>
<script>
	var shown = false;
	function show_loginContent(){
		var loginContent = document.getElementsByClassName('login_content')[0];
		if(shown==false){
			shown = true;
			startMove(loginContent,{'opacity':100});
		}else{
			shown = false;
			startMove(loginContent,{'opacity':0});
		}
	}
</script>
</head>

<body>
    <div class="header">
    	<div class="header_content">
        	<a class="login" href="javascript:show_loginContent();">
            	<span class="cha-vers">登录</span>
            </a>
        </div>
        <div class="login_content" style="display: block;">
        	<form method="post" action="SupportedFiles/Home_Function.php">
            	<input type="text" name="username" class="login_content_input">
                <input type="text" name="password" class="login_content_input">
                <input type="submit" name="login_submit" class="login_content_submit">
            </form>
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
