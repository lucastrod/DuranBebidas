<?php
include_once('inc/headerBlack.php');
require_once("funciones.php");

if(isset($_POST['submit'])){

if(!empty($_POST["email"]) && !empty($_POST["password"])){
  
$resp = $user->validarDatos($_POST["email"], $_POST["usuario"]);

if($resp ==''){
    //$user->guardarUsuario($_POST);
    //mostrar cartel de usuario creado

}
else{
    echo $resp;
    //muestro error de usuario existente
}
$email = $_POST["email"];
$password = $_POST["password"];
$usuario = $_POST['usuario'];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$direccion = $_POST["direccion"];

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
                    <label for="password" class="col-md-12 control-label text-center" style="color:black;font-family:Arial;font-size:17px;">Contraseña</label>
                     <div class="col-md-12">
                        <input type="password" class="form-control text-center" id="password" name="password" placeholder="Contraseña" value="" required>
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

