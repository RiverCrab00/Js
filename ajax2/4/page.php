<?php
$dsn='mysql:host=localhost;dbname=tb_stu;charset=utf8';
$pdo=new PDO($dsn,'root',123456);
$p=isset($_GET['p'])?$_GET['p']:1;
$pagesize=10;
$start=($p-1)*$pagesize;
$sql="select id,name,sex,age,edu from student order by id limit $start,$pagesize";
$stmt=$pdo->query($sql);
$data=$stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);


 ?>