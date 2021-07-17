<?php
    session_start();

    
    $array =  $_SESSION['carrito'];
    
    for($i=0;$i<count($array);$i++){
        if($array[$i]['Id'] != $_POST['id']){
            $arrayNuevo[] = array(
                'Id'=> $array[$i]['Id'],
                'Nombre'=>$array[$i]['Nombre'],
                'Precio'=> $array[$i]['Precio'],
                'Imagen'=> $array[$i]['Imagen'],
                'Cantidad'=> $array[$i]['Cantidad'],
                'Stock'=> $array[$i]['Stock']
            );

        }
    }
    if(isset($arrayNuevo)){
        $_SESSION['carrito'] = $arrayNuevo;
    }
    else{
        unset($_SESSION['carrito']);
    }
    
?>