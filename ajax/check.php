<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<input type="text" id="username">
	<span id='msg'></span>
</body>
	<script type="text/javascript">
	var input=document.getElementById('username');
	var span=document.getElementById('msg');
	input.onblur=function(){
		var username=encodeURIComponent(this.value);
		var xhr=new XMLHttpRequest();
		xhr.onreadystatechange=function(){		
			if(xhr.readyState==4&&xhr.status==200){
				if(xhr.responseText=='1'){
					span.innerHTML="<font color='red'>该用户名已经被注册</font>";
				}else{
					span.innerHTML="<font color='green'>该用户名可用</font>";
				}
			}
		}
		xhr.open('get','02check.php?u='+username+'&f='+Math.random());
		xhr.send();
	}
</script>
</html>