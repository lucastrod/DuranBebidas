<?php

/*
$host = 'localhost';
$dbname = 'asdavinc_pw_acn3a_20192_equipo07';
$user = 'asdavinc_pw_n021';
$pass = 'c6ak4wkwab7jmnq9';
$port = '3306';

*/

$host = '127.0.0.1';
$dbname = 'vino';
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