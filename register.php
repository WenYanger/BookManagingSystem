<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>注册</title>
<!--响应式布局-->
<!--桌面级CSS-->
<link type="text/css" rel="stylesheet" href="CSS/register_desktop.css" media="only screen and (min-width:480px)"/>
<script type="text/javascript" src="JavaScript/CommonFunction.js"></script>
<script>
function changeColor(id,color){
	var text = window.document.getElementById(id);
	text.style.color=color;
}
function changeBorder(id,text){
	var target = window.document.getElementById(id);
	target.style.border = text;
}
</script>
</head>

<body>
<div id="Whole">
  <div id="Content">
    <div id="Banner"> <a id="foot" href="index.php" onMouseOver="changeColor('foot_text','#FFF')" onMouseOut="changeColor('foot_text','#09F')">
      <h1 id="foot_text" style="color=#09F"><</h1>
      </a>
      <div id="banner_text">
        <p>快速注册</p>
      </div>
    </div>
    <form action="register.php" method="post" name="registerForm" enctype="multipart/form-data">
      <div id="user_div">
        <label id="userTips">支持QQ号/邮箱/手机号注册</label>
        <div id="userOuter">
          <input name="user_input" type="text" id="user_input" size="30" maxlength="200" onFocus="changeBorder('user_input','#06F solid 2px')" onBlur="changeBorder('user_input','rgba(153,153,153,0.8) solid 2px')" onKeyUp="check_hidden('user_input','userTips')" onKeyDown="check_hidden('user_input','userTips')">
        </div>
      </div>
      <div id="password_div">
        <label id="passwordTips">密码</label>
        <div id="passOuter">
          <input name="password_input" type="text" id="password_input" size="30" maxlength="200" onFocus="changeBorder('password_input','#06F solid 2px')" onBlur="changeBorder('password_input','rgba(153,153,153,0.8) solid 2px')" onKeyUp="check_hidden('password_input','passwordTips')" onKeyDown="check_hidden('password_input','passwordTips')" >
        </div>
      </div>
      <div id="password_div">
        <label id="passwordTipsConfirm">确认密码</label>
        <div id="passOuter">
          <input name="password_confirm" type="text" id="password_confirm" size="30" maxlength="200" onFocus="changeBorder('password_confirm','#06F solid 2px')" onBlur="changeBorder('password_confirm','rgba(153,153,153,0.8) solid 2px')" onKeyUp="check_hidden('password_confirm','passwordTipsConfirm')" onKeyDown="check_hidden('password_confirm','passwordTipsConfirm')" >
        </div>
      </div>
      <div id="loginButtonDiv">
        <div id="buttonOuter">
          <div id="buttonText">
            <p>注册</p>
          </div>
          <input name="submit" type="submit" id="loginButton" value="register">
        </div>
      </div>
    </form>
  </div>
</div>
</body>
</html>

<?php
require_once("SupportedFiles/Register.php");

switch($_POST["submit"]){
  case 'register':
    $user_id = $_POST["user_input"];
    $password = $_POST["password_input"];
    $password_confirm = $_POST["password_confirm"];
    if($user_id==''||$password==''||$password_confirm==''){
      echo "<script>alert('账号/密码不能为空!');</script>";
    } else {
      switch(Register::regist($user_id,$password)){
        case 402:
          echo "<script>alert('数据库错误!');</script>";
          break;
        case 403:
          echo "<script>alert('该用户已注册!');</script>";
          break;
        case 404:
          echo "<script>alert('注册成功!');</script>";
          break;
        case 405:
          echo "<script>alert('注册失败，服务器故障!');</script>";
          break;
        default:
          echo "<script>alert('未知错误!');</script>";
          break;
      }
	}
    break;
}
?>