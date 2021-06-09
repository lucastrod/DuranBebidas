<?php
include_once('inc/headerBlack.php');
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function infoVenta($id_Venta){

    $datosCliente = new Compra($con);
    $datosCliente->getClienteComprador($id_Venta);

    //Datos cliente
    $datosCliente-> nombre;

    echo($datosCliente-> nombre);
    //Datos Venta
    

   /*   $query = 'SELECT detalle_venta.id_venta, detalle_venta.id_producto, productos.nombre, productos.descripcion, detalle_venta.cantidad
		FROM detalle_venta
		INNER JOIN productos on (detalle_venta.id_producto = productos.producto_id)
		WHERE detalle_venta.id_venta = '.$venta; */

     // HTML email starts here
   
  $message  = "<html><body>";
   
  $message .= "<table width='100%' bgcolor='#e0e0e0' cellpadding='0' cellspacing='0' border='0'>";
  
  $message .= "<tr><td>";
  
  $message .= "<table align='center' width='100%' border='0' cellpadding='0' cellspacing='0' style='max-width:650px; background-color:#fff; font-family:Verdana, Geneva, sans-serif;'>";
   
  $message .= "<thead>
     <tr height='80'>
      <th colspan='4' style='background-color:#f5f5f5; border-bottom:solid 1px #bdbdbd; font-family:Verdana, Geneva, sans-serif; color:#333; font-size:34px;' >Duran Bebidas</th>
     </tr>
     </thead>";
   
  $message .= "<tbody>
     <tr>
      <td colspan='4' style='padding:15px;'>
       <p style='font-size:20px;'>Pedido N#: $id_Venta </p>
       <hr />
       <p style='font-size:25px;'>El pedido realizado fue el siguiente :</p>
      </td>
     </tr>
     <tr>
        <td>Producto</td>
        <td>Cantidad</td>
     </tr>
     <tr>
     <td colspan='4' style='padding:15px;'>
      <p style='font-size:20px;'>Pedido N# </p>
      <hr />
      <p style='font-size:25px;'>Datos del cliente:</p>
     </td>
     <td>Nombre:$datosCliente-> nombre; Apellido:$datosCliente-> apellido;</td>
     <td>Direccion:$datosCliente-> direccion;</td>
     <td>Telefono:$datosCliente-> telefono;</td>
     <td>Email:$datosCliente-> email;</td>
    </tr>
     
     </tbody>";
   
  $message .= "</table>";
  
  $message .= "</td></tr>";
  $message .= "</table>";
  
  $message .= "</body></html>";
  
  // HTML email ends here

    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->isHTML(true);
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = "true";
    $mail->SMTPSecure = "tls";
    $mail->Port = "587";
    $mail->Username = "lucas.castro45@davinci.edu.ar";
    $mail->Password = "39464303";
    $mail->Subject = "Pedido Confirmado N#";
    //$mail->setFrom("Duranalmacendebebidas@gmail.com");
    //$mail->addAddress("Duranalmacendebebidas@gmail.com");
    $mail->Body = $message;
    
/*     if( $mail->Send() ) {
        echo "Email sent!";
    }else{
        echo "Fracasó todo";
    } */

    try {
        $mail->Send();
    } catch (\Throwable $th) {
        console.log($th) ;
    }
    
    $mail->smtpClose();

    

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