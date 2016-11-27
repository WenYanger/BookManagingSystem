// JavaScript Document

//var timer = null;
function startMove(obj, json, fn){
	var flag = true;//假设所有运动都达到目标值
	clearInterval(obj.timer);
	obj.timer = setInterval(function(){
		for(var attr in json){
			//1.计算当前值
			var cur_value = 0;
			if(attr == 'opacity'){
				cur_value = Math.round(parseFloat(getStyle(obj,attr)) * 100);
			} else {
				cur_value = parseInt(getStyle(obj,attr));
			}
			//2.算速度
			var speed = (json[attr] - cur_value)/8;
			speed = speed > 0 ? Math.ceil(speed) : Math.floor(speed);
			//3.检测停止
			if(cur_value != json[attr]){
				flag = false;
			}
			if(attr == 'opacity'){
				obj.style.filter = 'alpha(opacity:'+(cur_value + speed)+')';
				obj.style.opacity = (cur_value + speed)/100;
			}else{
				obj.style[attr] = cur_value + speed +'px';
			}
		}
		if(flag){
			clearInterval(obj.timer);
			if(fn){
				fn();
			}
		}
	},30);
}
function getStyle(obj,attr){
	if(obj.currentStyle){
		return obj.currentStyle[attr]; //IE
	}
	else{
		return getComputedStyle(obj,false)[attr]; //FireFox
	}
}