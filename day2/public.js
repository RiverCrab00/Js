
function addEvent(ele,type,fn){
	if(ele.addEventListener){
		ele.addEventListener(type,fn);
	}else{
		ele.attachEvent('on'+type,fn);
	}
}
function removeEvent(ele,type,fn){
	if(ele.removeEventListener){
		ele.removeEventListener(type,fn);
	}else{
		ele.detachEvent('on'+type,fn);
	}
}
function stopMaopao(event){
	if(window.event){
		window.event.cancelBubble=true;
	}else{
		event.stopPropagation();
	}
}
function stopDefault(event){
	if(event){
		event.preventDafault();
	}else{
		window.event.returnValue=false;
	}
}
function getStyle(element,styleName){
	if(element.currentStyle){
		return element.currentStyle[styleName];
	}else{
		return window.getComputedStyle(element)[styleName];
	}
}