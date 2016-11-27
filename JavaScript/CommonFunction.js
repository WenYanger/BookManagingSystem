// JavaScript Document
function check_hidden(id, target){
	var text = window.document.getElementById(target);
	if(check_empty(id)){
		text.style.visibility = "visible";
	} else {
		text.style.visibility = "hidden";
	}
}
function check_empty(id){
	var text = window.document.getElementById(id);
	if(text.value.length > 0){
		return false;
	} else {
		return true;
	}
}
