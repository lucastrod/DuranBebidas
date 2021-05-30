<?php

include_once('inc/headerblack.php');

$compra = new Compra($con);

$venta = $_POST['id'];
echo($venta);
if($_POST['estado']==1){
    $estado = 0;
}
else{
    $estado = 1;
}

$compra->actualizar($estado,$venta);

?>