<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>主页</title>
<!--响应式布局-->
<!--桌面级CSS-->
<link type="text/css" rel="stylesheet" href="CSS/main_desktop.css" media="only screen and (min-width:480px)"/>
<script type="text/javascript" src="JavaScript/PerfectMove.js"></script>
<script>
window.onload = function(){
	var c = document.getElementsByClassName('ContentLeft')[0];
	var d = document.getElementsByClassName('ContentLeft_blur')[0];
	c.onmouseover = function(){
		startMove(this,{'left':0});
		startMove(d,{'left':0});
	}
	c.onmouseout = function(){
		startMove(this,{'left':-250});
		startMove(d,{'left':-250});
	}
	
	var aLi = document.getElementsByTagName('li');
	for(var i = 0; i<aLi.length; i++){
		if(i==aLi.length){i=aLi.length-1;}
		aLi[i].onmouseover = function(){
			if(i==aLi.length){i=aLi.length-1;}
			startMove(this,{'height':60,'padding-top':30});
		}
		aLi[i].onmouseout = function(){
			if(i==aLi.length){i=aLi.length-1;}
			startMove(this,{'height':40,'padding-top':0});
		}
	}
	/*
	var aLi = document.getElementsByTagName('li');
	var tank = new Array({'start':0,'end':1},{'start':2,'end':3},{'start':4,'end':5},{'start':6,'end':7});//存储各具体函数子节点的起始index与结束index
	for(var i = 0; i<aLi.length; i++){
		if(i==aLi.length){i=aLi.length-1;}
		aLi[i].onmouseover = function(){
			if(i==aLi.length){i=aLi.length-1;}
			startMove(this,{'height':200});
			var specFuncs = document.getElementsByClassName('ContentLeft_specificFunction');
			for(var j = tank[i].start; j<=tank[i].end; j++){
				
				var s = specFuncs[j];
				s.style.display = 'block';
				//s.style.opacity = '1';
				startMove(s,{'opacity':100,'margin-top':10});
			}
		}
		aLi[i].onmouseout = function(){
			if(i==aLi.length){i=aLi.length-1;}
			startMove(this,{'height':40});
			var specFuncs = document.getElementsByClassName('ContentLeft_specificFunction');
			for(var j = tank[i].start; j<=tank[i].end; j++){
				var s = specFuncs[j];
				//s.style.opacity = '1';
				startMove(s,{'opacity':0,'margin-top':-10});
			}
		}
	}
	*/
}

</script>
</head>

<body>
<div class="Whole">
  <div class="Banner"> </div>
  <div class="Content">
    <div class="ContentRight">
      <div class="ContentRight_PostBlog">
        <div class="ContentRight_PostBlogLogo"> 
        	<p>写下你的想法：</p>
        </div>
        <div class="ContentRight_PostBlogMain">
        	<form action="main.php" method="post" name="postBlog" enctype="multipart/form-data">
            	<textarea name="blog_input" type="text" id="ContentRight_PostBlogMain_blogInput" size="30" maxlength="200"></textarea>
            </form>
        </div>
      </div>
    </div>
    <div class="ContentLeft">
      <div class="ContentLeft_userDiv">
        <div id="ContentLeft_userPicture"> <img src="image/user_defaultImage.jpg"> </div>
        <div id="ContentLeft_userInfo">
          <p>User</p>
        </div>
      </div>
      <div class="ContentLeft_functionSelectDiv">
        <ul>
          <li><a href="http://www.baidu.com">我的发帖</a>
            <div class="ContentLeft_specificFunction"></div>
            <div class="ContentLeft_specificFunction"></div>
          </li>
          <li><a href="http://www.baidu.com">消息</a>
            <div class="ContentLeft_specificFunction"></div>
            <div class="ContentLeft_specificFunction"></div>
          </li>
          <li><a href="http://www.baidu.com">用户设置</a>
            <div class="ContentLeft_specificFunction"></div>
            <div class="ContentLeft_specificFunction"></div>
          </li>
          <li><a href="http://www.baidu.com">关于我们</a>
            <div class="ContentLeft_specificFunction"></div>
            <div class="ContentLeft_specificFunction"></div>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
</body>
</html>