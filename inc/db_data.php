<?php


/* $host = '127.0.0.1';
$dbname = 'u164376993_bebidas';
$user = 'u164376993_adminDur4n';
$pass = '|9wF@nb#3Mf';
$port = '3306'; */



$host = '127.0.0.1';
$dbname = 'bebidas';
$user = 'root';
$pass = '';
$port = '3306';

try{
	$con = new PDO("mysql:host=$host;dbname=$dbname;port=$port",$user,$pass);
}catch(PDOException $e){
	  print  "¡Error!: " . $e->getMessage();
      die();
}
?>