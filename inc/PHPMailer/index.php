<?php
include_once('inc/headerBlack.php');
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function infoVenta($id_Venta,$datos,$productos){


    //Datos Cliente
    $datosCliente=$datos;
    $nombre=$datosCliente-> nombre;
    $telefono=$datosCliente-> telefono;
    $email=$datosCliente-> email;
    $direccion=$datosCliente-> direccion;


    //Datos Venta
    
     $message = // contents of report in $message
     "
     <html>
     <head></head>
     <body>
         <h3>Pedido N# $id_Venta</h3>
         <hr />
         <p>Datos del Cliente:</p>
         <p>Nombre: $nombre</p>
         <p>Telephone: $telefono</p>
         <p>Email: $email</p>
         <p>Direccion: $direccion</p>
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
                         <td>" .$productos[$key]['nombre'] ."</td>
                         <td></td>
                         <td>".$productos [$key]['cantidad']."</td>
                     </tr>";
                  } 
             $message .= "</tbody>
         </table>
         <p>Recuerde confirmar el pedido en el Panel</p> 
         <hr />
         Cordialmente PegasusApp
     </body>
     </html>"; //end of $message


  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'tls';
  $mail->Host = 'smtp.gmail.com';
  $mail->Port = "587";
  $mail->Username = "lucas.castro45@davinci.edu.ar";
  $mail->Password = "39464303";
  $mail->setFrom("lucas.castro45@davinci.edu.ar", 'Nuevo Pedido');
  $mail->addAddress('lucasderiver@gmail.com','Santiago');
  $mail->Subject = "Pedido Confirmado N# ".$id_Venta;
  $mail->Body = $message;
  $mail->isHTML(true);

  if($mail->send())
  return true;
  else
  return false;

}

function confirmarUsuario($email, $nombre, $asunto, $cuerpo){

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = "587";
    $mail->Username = "santiago.linares@davinci.edu.ar";
    $mail->Password = "34585070";
    $mail->setFrom("santiago.linares@davinci.edu.ar", 'Sistema de Usuarios');
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

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = "587";
    $mail->Username = "santiago.linares@davinci.edu.ar";
    $mail->Password = "34585070";
    $mail->setFrom("santiago.linares@davinci.edu.ar", 'Recupero de Password');
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