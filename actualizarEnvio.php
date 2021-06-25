<?php

session_start();

$costoEnvio = $_SESSION["envio"];
$total = 0;
$arrayRet= array(
    "envio"=>$costoEnvio,
    "total"=>$total
);

if(!empty($_SESSION["usuario"])){
if($_POST['activo']==1){
    $_SESSION["usuario"] ["envio"] = $costoEnvio;
    $arrayRet['envio'] = $costoEnvio;
}
else{
    $_SESSION["usuario"] ["envio"] = 0;
    $arrayRet['envio'] = 0;
}

if(isset($_SESSION['carrito'])){
      
    $arrayProductos =  $_SESSION['carrito'];
    for($i=0;$i<count($arrayProductos);$i++){
        $total += $arrayProductos[$i]['Precio'] * $arrayProductos[$i]['Cantidad'];
    }
    $arrayRet['total'] = $total + $arrayRet['envio'];
    
}

echo json_encode($arrayRet);
}

?>