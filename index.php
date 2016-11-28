<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>星辰图书管理系统</title>
    <!--响应式布局-->
    <!--桌面级CSS-->
    <link type="text/css" rel="stylesheet" href="CSS/index_desktop.css" media="only screen and (min-width:480px)"/>
    <style></style>
    <script type="text/javascript" src="JavaScript/CommonFunction.js"></script>
    <script>
        function changeBorder(id,text){
            var target = window.document.getElementById(id);
            target.style.border = text;
        }
    </script>
</head>

<body>
<div class="Whole">
    <div class="Banner"> <a class="Banner_logo" href="index.php">QQ邮箱</a> </div>
    <div class="Body">
        <div class="Body_Login">
            <form action="index.php" method="post" name="logForm" enctype="multipart/form-data">
                <div id="user_div">
                    <label id="userTips" style="display: block;">支持QQ号/邮箱/手机号登录</label>
                    <div id="userOuter">
                        <input name="user_input" type="text" id="user_input" size="30" maxlength="200" onFocus="changeBorder('user_input','#06F solid 2px')" onBlur="changeBorder('user_input','rgba(153,153,153,0.8) solid 2px')"  onKeyUp="check_hidden('user_input','userTips')" onKeyDown="check_hidden('user_input','userTips')">
                    </div>
                </div>
                <div id="password_div">
                    <label id="passwordTips" style="display: block;">密码</label>
                    <div id="passOuter">
                        <input name="password_input" type="text" id="password_input" size="30" maxlength="200" onFocus="changeBorder('password_input','#06F solid 2px')" onBlur="changeBorder('password_input','rgba(153,153,153,0.8) solid 2px')" onKeyUp="check_hidden('password_input','passwordTips')" onKeyDown="check_hidden('password_input','passwordTips')" >
                    </div>
                </div>
                <div>
                    <input name="submit" type="submit" id="loginButton" value="login">
                </div>
                <div class="OtherButton"> <a href="forget_password.php" class="link" id="forgetpwd" target="_blank">忘了密码？</a>&nbsp; <span class="dotted">|</span> &nbsp;<a href="register.php" class="link" target="_parent">注册新账号</a> &nbsp;<span class="dotted">|</span> &nbsp;<a href="register.php" class="link" target="_blank">意见反馈</a> </div>
            </form>
        </div>
    </div>
    <div class="Bottom"> <a href="http://www.tencent.com" target="_blank">关于WY Studio</a> &nbsp;|&nbsp; <a href="http://www.tencent.com" target="_blank">服务条款</a> &nbsp;|&nbsp; <a href="http://www.tencent.com" target="_blank">联系我们</a> &nbsp;|&nbsp; <a href="http://www.tencent.com" target="_blank">帮助中心</a> &nbsp;|&nbsp; <span class="gray">©1998 - 2015 Wen Yang Studio. All Rights Reserved.</span> </div>
</div>
</body>
</html>

<?php
require_once("SupportedFiles/Login.php");
require_once("SupportedFiles/Db.php");
// 定义变量并设置为空值
$user_id = $password = "";
switch($_POST["submit"]){
    case 'login':
        $user_id = $_POST["user_input"];
        $password = $_POST["password_input"];
        if($user_id==''||$password==''){
            echo "<script>alert('账号/密码不能为空!');</script>";
        } else {
            switch(Login::log_in($user_id,$password)){
                case 400:
                    $url = './main.php';
                    echo ("<script>window.location.href=('".$url."');</script>");
                    break;
                case 401:
                    echo "<script>alert('Login Fail!');</script>";
                    break;
                case 402:
                    echo "<script>alert('Server Error!');</script>";
                    break;
                default:
                    break;
            }
        }
        break;
}
?>
