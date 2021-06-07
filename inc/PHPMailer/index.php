<?php
include_once('inc/headerBlack.php');
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function infoVenta($id_Venta){

    $compra = new Compra($con);

    $compra->getDetalleVenta($id_Venta);

    console.log($compra);

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
       <p style='font-size:20px;'>Pedido N# </p>
       <hr />
       <p style='font-size:25px;'>El pedido realizado fue el siguiente :</p>
       <img src='https://4.bp.blogspot.com/-rt_1MYMOzTs/VrXIUlYgaqI/AAAAAAAAAaI/c0zaPtl060I/s1600/Image-Upload-Insert-Update-Delete-PHP-MySQL.png' alt='Sending HTML eMail using PHPMailer in PHP' title='Sending HTML eMail using PHPMailer in PHP' style='height:auto; width:100%; max-width:100%;' />
       <p style='font-size:15px; font-family:Verdana, Geneva, sans-serif;'>Atte Pegasus</p>
      </td>
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