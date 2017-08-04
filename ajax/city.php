<?php 
$type=$_GET['type'];

$dsn="mysql:host=localhost;dbname=db_province;charset=utf8";
$pdo=new PDO($dsn,"root",'123456');
if($type=='sheng'){
	$sql='select *from province';	
}else if($type=='shi'){
	$sql="select *from city where ProvinceCode={$_GET['pcode']}";
}else if($type=='xian'){
	$sql="select *from areacounty where CityCode={$_GET['ccode']}";
}
$stmt=$pdo->query($sql);
/*var_dump($stmt);
die;*/
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);
 ?>

