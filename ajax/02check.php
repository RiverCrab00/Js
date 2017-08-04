<?php
	header("content-type:text/html;charset=utf8");
	$username=urldecode($_GET['u']);
	if($username=='zhangsan'||$username=='lisi'){
		//用户名已被注册
		echo '1';
	}else{
		//用户名可用
		echo '2';
	}
?>