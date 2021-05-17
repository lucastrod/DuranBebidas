<?php

session_start();
    
$array =  $_SESSION['carrito'];

for($i=0;$i<count($array);$i++){
    if($array[$i]['Id'] == $_POST['id']){
        $array[$i]['Cantidad'] = $_POST['cantidad'];
        $_SESSION['carrito'] = $array;
        break;
    }
}
?>