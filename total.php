<?php

session_start();

if(isset($_SESSION['carrito'])){
      
        $arrayProductos =  $_SESSION['carrito'];
        $total = 0;
        for($i=0;$i<count($arrayProductos);$i++){
            $total += $arrayProductos[$i]['Precio'] * $arrayProductos[$i]['Cantidad'];
        }
        echo $total;  
}
else{
    echo 0;
} 
?>