<?php
include_once('inc/headerBlack.php');
require_once("funciones.php");

$mensaje='';

$datos=array();
                    
$email = $_POST["email"];
$clave = $_POST["clave"];
$usuario = $_POST['usuario'];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$calle = $_POST["calle"];
$numero = $_POST["numero"];
$telefono = $_POST["telefono"];
$piso_depto = !empty($_POST["piso_depto"])?$_POST["piso_depto"]:'';
                
$token = generarToken();
                
$datos = array(
    'email'=> $email,
    'clave'=> $clave,
    'usuario'=> strval($usuario),
    'nombre'=> $nombre,
    'apellido'=> $apellido,
    'calle'=> $calle,
    'numero'=> $numero,
    'piso_departamento'=> $piso_depto,
    'telefono'=> $telefono,
    'token'=> $token,
    'salt'=>''
);
                
            
$registro = $user->save($datos);
                
if($registro > 0){
                
$url = 'https://'.$_SERVER["SERVER_NAME"].'/DuranBebidas/validar.php?id='.$registro.'&val='.$token;
        
                
$asunto = 'Activar Cuenta - Duran Bebidas';
                
$cuerpo = "Estimado $nombre: <br/> <br/> Para continuar con el proceso de registro, es necesario que ingreses al siguiente link  <a href='$url'>Activar Cuenta</a>"; 
                
    if(confirmarUsuario($email, $nombre, $asunto, $cuerpo)){
                    
        $mensaje = "Para terminar el proceso de registro debe seguir las instrucciones que le enviamos a la direccion de correo electronico: $email"; 
    }
    else{
            header('Location: registro.php?mail=error');
    }
                
}
?>

