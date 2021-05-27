<?php

include_once('inc/headerBlack.php');

$productos = new Producto($con);

if(isset($_POST['accion'])){

switch ($_POST['accion']){

    case "Agregar":
        if((isset($_POST['id'])) && (isset($_POST['precio_oferta']))){
            $resp = $productos->chequearProducto($_POST['id']);
                    
            
                          if($resp != 1){
                
                              echo "<script languaje='JavaScript'>
                              window.location.href='productos.php?estado=error&error=productoNoDisponible&cat=';
                                  </script>";
                            
                          }
            
            $productos->actualizarOferta($_POST['id'], $_POST['precio_oferta']);
        }
        break;
        
    case "Eliminar":
        if(isset($_POST['id'])){
            $resp = $productos->chequearProducto($_POST['id']);
                    
            
                          if($resp != 1){
                
                              echo "<script languaje='JavaScript'>
                              window.location.href='productos.php?estado=error&error=productoNoDisponible&cat=';
                                  </script>";
                            
                          }
            
            $productos->eliminarOferta($_POST['id']);
        }
        break;
    case "Editar":
        if((isset($_POST['id'])) && (isset($_POST['precio_oferta']))){
            $resp = $productos->chequearProducto($_POST['id']);
                    
            
                          if($resp != 1){
                
                              echo "<script languaje='JavaScript'>
                              window.location.href='productos.php?estado=error&error=productoNoDisponible&cat=';
                                  </script>";
                            
                          }
            
            $productos->actualizarOferta($_POST['id'], $_POST['precio_oferta']);
        }
        break;
}


}


?>