<?php 
$username=$_GET['username'];
$password=md5($_GET['password']);
$dsn="mysql:host=localhost;dbname=blog;charset=utf8";
$pdo=new PDO($dsn,'root',123456);
$sql="select*from user where username='{$username}'and password='{$password}'";
$res=$pdo->query($sql);
$data=$res->fetchColumn();

echo $data;
?>