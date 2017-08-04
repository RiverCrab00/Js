<?php
header("content-type:text/html;charset=utf8");

function my_read($path){
	if(is_dir($path)){
		$files=opendir($path);
	while(($file=readdir($files))!==false){
		if($file=='.'||$file=='..'){
			continue;
		}
		echo $file."<br>";
		if(is_dir($path.'/'.$file)){
			my_read($path.'/'.$file);
		}
			
		
	}
}
	
}
$path='../../Js/';
my_read($path);	
?>