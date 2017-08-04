<?php 
$keyword=$_GET['keyword'];
if($keyword==""){
	$keyword=0;
}
$dsn='mysql:host=localhost;dbname=ajax;charset=utf8';
$pdo=new PDO($dsn,"root",123456);
$sql="select title from record  where title like '%{$keyword}%' order by click desc ";
$stmt=$pdo->query($sql);
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($data);

?>