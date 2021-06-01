<?php
include_once('inc/headerBlack.php');
require_once("funciones.php");

if(isset($_POST['submit'])){

if(!empty($_POST["email"]) && !empty($_POST["clave"])){
  
if(strcmp($_POST["clave"],$_POST["confirmar_clave"]) !==0){
    echo 'ERROR, CLAVES NO COINCIDEN';
    exit;
} 

$resp = $user->validarDatos($_POST["email"], $_POST["usuario"]);

if($resp ==''){

    //mostrar cartel de usuario creado


    
    $datos=array();
    
    $email = $_POST["email"];
    $clave = $_POST["clave"];
    $usuario = $_POST['usuario'];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $direccion = $_POST["direccion"];

    $token = generarToken();

    $datos = array(
        'email'=> $email,
        'clave'=> $clave,
        'usuario'=> $usuario,
        'nombre'=> $nombre,
        'apellido'=> $apellido,
        'direccion'=> $direccion,
        'token'=> $token,
        'salt'=>''
    );


    $registro = $user->save($datos);

    if($registro > 0){

    $url = 'https://'.$_SERVER["SERVER_NAME"].'/DuranBebidas/DuranBebidas/validar.php?id='.$registro.'&val='.$token;


    $asunto = 'Activar Cuenta - Sistema de Usuarios';

    $cuerpo = "Estimado $nombre: <br/> <br/> Para continuar con el proceso de registro, es necesario que ingreses al siguiente link  <a href='$url'>Activar Cuenta</a>"; 

        if(confirmarUsuario($email, $nombre, $asunto, $cuerpo)){
            echo "Para terminar el proceso del registro siga las instrucciones que le enviamos a la dirección
            de correo electrónico: $email";
            echo "<br> <a href='login.php'> Iniciar Sesion </a>";
            exit;
        }
        else{
            Echo 'Falló el envío del email';
        } 

    }

}
else{
    echo $resp;
    //muestro error de usuario existente
}


}
}

?>

<div class="container">

<div class="form_container">
<form method="POST" action="registro.php">

            <div class="row" style="margin:15px;">
                <div class="col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="nombre" class="col-md-12 control-label text-center" style="color:black;font-family:Arial;font-size:17px;padding-top:30px;">Nombre</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control text-center" id="nombre" name="nombre" placeholder="Nombre" value="" required>
                    </div>
                </div> 
                 <div class="form-group col-md-4">
                    <label for="apellido" class="col-md-12 control-label  text-center" style="color:black;font-family:Arial;font-size:17px;padding-top:30px;">Apellido</label>
                     <div class="col-md-12">
                        <input type="text" class="form-control text-center" id="apellido" name="apellido" placeholder="Apellido" value="" required>
                    </div>
                </div> 
                <div class="col-md-2"></div>
             </div>
                
             <div class="row" style="margin:15px;">
                 <div class="col-md-2"></div>
                 <div class="form-group col-md-4">
                    <label for="usuario" class="col-md-12 control-label text-center" style="color:black;font-family:Arial;font-size:17px;">Usuario</label>
                     <div class="col-md-12">
                        <input type="text" class="form-control text-center" id="usuario" name="usuario" placeholder="Usuario" value="" required>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="email" class="col-md-12 control-label text-center" style="color:black;font-family:Arial;font-size:17px;">Email</label>
                     <div class="col-md-12">
                        <input type="email" class="form-control text-center" id="email" name="email" placeholder="Email" value="" required>
                    </div>
                </div>
                <div class="col-md-2"></div> 
             </div>

             <div class="row" style="margin:15px;">
                 <div class="col-md-2"></div>
                 <div class="form-group col-md-4">
                    <label for="clave" class="col-md-12 control-label text-center" style="color:black;font-family:Arial;font-size:17px;">Contraseña</label>
                     <div class="col-md-12">
                        <input type="password" class="form-control text-center" id="clave" name="clave" placeholder="Contraseña" value="" required>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="confirmar_clave" class="col-md-12 control-label text-center" style="color:black;font-family:Arial;font-size:17px;">Confirmar Contraseña</label>
                     <div class="col-md-12">
                        <input type="password" class="form-control text-center" id="confirmar_clave" name="confirmar_clave" placeholder="Confirmar Contraseña" value="" required>
                    </div>
                </div>
                <div class="col-md-2"></div> 
             </div>

             <div class="row" style="margin:15px;">
                 <div class="col-md-3"></div>
                 <div class="form-group col-md-6">
                    <label for="password" class="col-md-12 control-label text-center" style="color:black;font-family:Arial;font-size:17px;">Direccion</label>
                     <div class="col-md-12">
                        <input type="text" class="form-control text-center" id="direccion" name="direccion" placeholder="Direccion" value="" required>
                    </div>
                </div>
                <div class="col-md-2"></div> 
             </div>
                <div class="form-group text-center pt-3" style="margin:15px;">
                    <div class="col-md-12" style="margin:15px;">
                    <button type="submit" class="btn btn-default  bg-dark" name="submit" style="background-color:#A98307;color:rgb(243, 234, 234);font-family:Arial;font-size:17px;">Registrarse</button>
                    </div>
                </div> 
                <input type="hidden" class="form-control" id="producto_id" name="producto_id" placeholder="" value="<?=isset($producto->producto_id)?$producto->producto_id:'';?>">

</form>
</div>
</div>

