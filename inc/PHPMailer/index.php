<?php
include_once('inc/headerBlack.php');
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function infoVenta($id_Venta,$datos,$productos){

    $user = "lucas.castro45@davinci.edu.ar";
    $pw = "39464303";

    //Datos Cliente
    $datosCliente=$datos;
    $nombre=$datosCliente-> nombre;
    $telefono=$datosCliente-> telefono;
    $email=$datosCliente-> email;
    $calle=$datosCliente-> calle;
    $numero=$datosCliente-> numero;
    $piso_departamento=$datosCliente-> piso_departamento;
    $direccion= $calle.'  '.$numero.'  '.$piso_departamento;

    //Datos Venta
    
     $message = // contents of report in $message
     "
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
         <table name='contact_seller' style='border-collapse:collapse';> 
             <thead>
                 <tr>
                     <th>Producto</th>
                     <th></th>
                     <th>Cantidad</th>
                 </tr>    
             </thead>
             <tbody>";
                 foreach($productos as $key => $value) { 
                     $message .="<tr>
                         <td>   " .$productos[$key]['nombre'] ."</td>
                         <td></td>
                         <td>".'   '.$productos [$key]['cantidad']."</td>
                     </tr>";
                  } 
             $message .= "</tbody>
         </table>
         <p>Recuerde confirmar el pedido en el Panel</p> 
         <hr />
         Saludos PegasusApp
     </body>
     </html>"; //end of $message


  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'tls';
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = "587";
  $mail->Username = $user;
  $mail->Password = $pw;
  $mail->setFrom($user, 'Nuevo Pedido Realizado');
  $mail->addAddress('lucasderiver@gmail.com','Santiago');
  $mail->Subject = "Pedido Confirmado N# ".$id_Venta;
  $mail->Body = $message;
  $mail->isHTML(true);

  if($mail->send())
  return true;
  else
  return false;

}


function infoUsuario($id_Venta,$datos,$productos, $envio, $total){

    $user = "lucas.castro45@davinci.edu.ar";
    $pw = "39464303";

    //Datos Cliente
    $datosCliente=$datos;
    $nombre=$datosCliente-> nombre;
    $telefono=$datosCliente-> telefono;
    $email=$datosCliente-> email;
    $calle=$datosCliente-> calle;
    $numero=$datosCliente-> numero;
    $piso_departamento=$datosCliente-> piso_departamento;
    $direccion= $calle.'  '.$numero.'  '.$piso_departamento;

    //Datos Venta
    
     $message = // contents of report in $message
     "
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
                     <th style='width: 300px;word-wrap: break-word;text-align:left;'>Producto</th>
                     <th style='width: 300px;word-wrap: break-word;text-align:left;'>Cantidad</th>
                     <th style='width: 300px;word-wrap: break-word;text-align:left;'>Precio</th>
                 </tr>     
             </thead>
             <tbody>";
                 foreach($productos as $key => $value) { 
                     $message .=
                     "<tr>
                         <td style='width: 300px;word-wrap: break-word;'>   " .$productos[$key]['nombre'] ."</td>
                         <td style='width: 300px;word-wrap: break-word;'>".'   '.$productos [$key]['cantidad']."</td>
                         <td style='width: 300px;word-wrap: break-word;'>$".'   '.$productos [$key]['precio']."</td>
                     </tr>";
                  } 
             $message .= "</tbody>
         </table>
        <p><b>Envío: </b>$$envio </p>
        <p><b>Total: </b>$$total </p>
         <hr />
         Saludos Duran Bebidas
     </body>
     </html>"; //end of $message


  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'tls';
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = "587";
  $mail->Username = $user;
  $mail->Password = $pw;
  $mail->setFrom($user, 'Nuevo Pedido Realizado');
  $mail->addAddress($email,$nombre);
  $mail->Subject = "Pedido Confirmado N# ".$id_Venta;
  $mail->Body = $message;
  $mail->isHTML(true);

  if($mail->send())
  return true;
  else
  return false;

}

function confirmarUsuario($email, $nombre, $asunto, $cuerpo){
   /*  $user = "Duranalmacendebebidas@gmail.com";
    $pw = "Maracaibocasi"; */
    $user = "usuarios@duranalmacen.com.ar";
    $pw = "Maracaibocasi1";

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.hostinger.com';
    $mail->Port = "587";
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Username = $user;
    $mail->Password = $pw;
    $mail->setFrom($user, 'Sistema de Usuarios');
    $mail->addAddress($email,$nombre);
    $mail->Subject = $asunto;
    $mail->Body = $cuerpo;
    $mail->isHTML(true);

    if($mail->send())
    return true;
    else
    return false;
}

function confirmarPass($email, $nombre, $asunto, $cuerpo){
    $user = "lucas.castro45@davinci.edu.ar";
    $pw = "39464303";


    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = "587";
    $mail->Username = $user;
    $mail->Password = $pw;
    $mail->setFrom($user, 'Recupero de Password');
    $mail->addAddress($email,$nombre);
    $mail->Subject = $asunto;
    $mail->Body = $cuerpo;
    $mail->isHTML(true);

    if($mail->send())
    return true;
    else
    return false;
}


?>