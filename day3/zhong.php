!<?php 
function getDay($date=""){
	if($date==""){
		$time=time();
	}else{
		$time=strtotime($date);
	}
	$day=date();
}

?>