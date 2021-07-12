<?php

include_once('inc/headerBlack.php');

$envio = new Envio($con);

if(isset($_POST['km'])){
    
    $valor = 0;

    $km = $_POST['km'];
    
    if ($km < 3) 
    {
        $env = $envio->getEnvio(1);
        $valor = $env->precio;
    }

    if ($km>3 && $km<6) 
    {
        $env = $envio->getEnvio(2);
        $valor = $env->precio;
    } 

    if ($km>6 && $km<10) 
    {
        $env = $envio->getEnvio(3);
        $valor = $env->precio;
    }

    $_SESSION["envio"] = $valor;
    
}

?>