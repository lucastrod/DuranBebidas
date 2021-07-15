<?php
include_once('inc/headerBlack.php');
?>

<html>
     <head></head>
     <body>
         <h3>Pedido N# $id_Venta</h3>
         <hr />
         <p><b>Datos del Cliente:</b></p>
         <p><b>Nombre:</b> $nombre</p>
         <p><b>Telefono:</b> $telefono</p>
         <p><b>Email: </b>$email</p>
         <p><b>Direccion:</b> $direccion</p>
         <hr />    
         <h3>El pedido contiene lo siguiente:</h3>    
         <table name='contact_seller' style='border-collapse:collapse;width: 750px;table-layout: fixed;'> 
             <thead>
                 <tr>
                     <th style='width: 300px;word-wrap: break-word;'>Producto</th>
                     <th style='width: 300px;word-wrap: break-word;'>Cantidad</th>
                     <th style='width: 300px;word-wrap: break-word;'>Precio</th>
                 </tr>     
             </thead>
             <tbody>
                <tr>
                         <td style='width: 300px;word-wrap: break-word;'>   " .$productos[$key]['nombre'] ."</td>
                         <td style='width: 300px;word-wrap: break-word;'>".'   '.$productos [$key]['cantidad']."</td>
                         <td style='width: 300px;word-wrap: break-word;'>$".'   '.$productos [$key]['precio']."</td>
                     </tr>
                  } 
             </tbody>
         </table>
        <p><b>Envío: </b>$$envio </p>
        <p><b>Total: </b>$$total </p>
         <hr />
         
     </body>
</html>