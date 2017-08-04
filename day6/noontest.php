<?php 
function li($arrs,$pid=0,$level){
	static $categrey=[];
	foreach($arrs as $arr){
		if($arr['pid']=$pid){
			$arr['level']=$level;
			$categrey[]=$arr;
			li($arrs,$arr['id'],$level+1);
		}
	}
}

?>