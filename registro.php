<?php
include_once('inc/headerBlack.php');
require_once("funciones.php");


$error = '';
$mensaje= '';
    if(isset($_POST['submit'])){

    if(empty($_POST["clave"]) || empty($_POST["email"]) || empty($_POST["usuario"]) || empty($_POST["nombre"]) || empty($_POST["apellido"]) || empty($_POST["direccion"]) || empty($_POST["telefono"])){
            $error .= 'datos ';
    }

    if(strcmp($_POST["clave"],$_POST["confirmar_clave"]) !==0){
        $error .= 'claves ';
    }

    $resp = $user->validarDatos($_POST["email"], $_POST["usuario"]);

    if(strpos($resp, 'Usuario') !== false){
        $error.='usuario ';
    }

    if(strpos($resp, 'Email') !== false){
        $error.='email ';
    }

    if($error ==''){

    //mostrar cartel de usuario creado

    $datos=array();
    
    $email = $_POST["email"];
    $clave = $_POST["clave"];
    $usuario = $_POST['usuario'];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];

    $token = generarToken();

    $datos = array(
        'email'=> $email,
        'clave'=> $clave,
        'usuario'=> $usuario,
        'nombre'=> $nombre,
        'apellido'=> $apellido,
        'direccion'=> $direccion,
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
    
            $valor = "Para terminar el proceso de registro debe seguir las instrucciones que le enviamos a la direccion de correo electrónico: $email"; 
            $mensaje.='<div> <span id="mensaje" data-id="'.$valor.'"></span>';
        }
        else{
            Echo 'Falló el envío del email';
        } 

    }

}


}

?>

<div class="container">

<div class="form_container">
<?php if(isset($_POST['submit']) && $error == ''){ ?>
    <body>
        <?= $mensaje;?>
        <div class="container">
            <div class="form_container">

            <div class="site-wrap">
                <div class="site-section">
                    <div class="container" >
                        <div class="row">
                        <div class="col-md-12 text-center">
                            <span class="icon-check_circle display-3 text-success"></span>
                            <h2 class="display-3 text-black" style="margin-top: 80px;font-size:40px;">Se ha registrado Correctamente!</h2>
                            <p class="lead mb-5">Una vez validada la cuenta, puede iniciar sesión presionando el boton de abajo</p>
                        </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group text-center pt-3" style="margin:15px;">
                    <div class="col-md-12" style="margin:15px;">
                    <button  class="btn btn-default  bg-dark"  style="background-color:#A98307;color:rgb(243, 234, 234);font-family:Arial;font-size:17px;margin-bottom:35px;"><a href="login.php" style="color:white;">Iniciar Sesion</a></button>
                    </div>
                </div> 
            </div>
    </div>
        
    </body>
<?php }  
else{?>
<form method="POST" action="registro.php">


            <div class="row" style="margin:15px;">
            <h1  style="display:flex;justify-content:center;font-family:raleway, sans-serif;">Crear Usuario</h1>
                <div class="col-md-2"></div>
                <div class="form-group col-md-4">
                    <label for="nombre" class="col-md-12 control-label text-center" style="color:black;font-family:Arial;font-size:17px;padding-top:30px;">Nombre</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control text-center" id="nombre" name="nombre" placeholder="Ingrese su Nombre" value="" required>
                    </div>
                </div> 
                 <div class="form-group col-md-4">
                    <label for="apellido" class="col-md-12 control-label  text-center" style="color:black;font-family:Arial;font-size:17px;padding-top:30px;">Apellido</label>
                     <div class="col-md-12">
                        <input type="text" class="form-control text-center" id="apellido" name="apellido" placeholder="Ingrese su Apellido" value="" required>
                    </div>
                </div> 
                <div class="col-md-2"></div>
             </div>
                
             <div class="row" style="margin:15px;">
                 <div class="col-md-2"></div>
                 <div class="form-group col-md-4">
                    <label for="usuario" class="col-md-12 control-label text-center" style="color:black;font-family:Arial;font-size:17px;">Usuario</label>
                     <div class="col-md-12">
                        <input type="text" class="form-control text-center" id="usuario" name="usuario" placeholder="Ingrese su Usuario" value="" required>
                        <?php if(strpos($error, 'usuario') !== false){ ?>
                        <p class="required" style="color:red;">*Usuario ya registrado</p>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="email" class="col-md-12 control-label text-center" style="color:black;font-family:Arial;font-size:17px;">Email</label>
                     <div class="col-md-12">
                        <input type="email" class="form-control text-center" id="email" name="email" placeholder="Ingrese su Email" value="" required>
                        <?php if(strpos($error, 'email') !== false){ ?>
                        <p class="required" style="color:red;">*Email ya registrado</p>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-2"></div> 
             </div>

             <div class="row" style="margin:15px;">
                 <div class="col-md-2"></div>
                 <div class="form-group col-md-4">
                    <label for="clave" class="col-md-12 control-label text-center" style="color:black;font-family:Arial;font-size:17px;">Contraseña</label>
                     <div class="col-md-12">
                        <input type="password" class="form-control text-center" id="clave" name="clave" placeholder="Ingrese su Contraseña" value="" required>
                        <?php if(strpos($error, 'claves') !== false){ ?>
                        <p class="required" style="color:red;">*Las contraseñas no coinciden</p>
                        <?php } ?>
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
                 <div class="col-md-2"></div>
                 <div class="form-group col-md-5">
                    <label for="password" class="col-md-12 control-label text-center" style="color:black;font-family:Arial;font-size:17px;">Dirección</label>
                     <div class="col-md-12">
                        <input type="text" class="form-control text-center" id="direccion" name="direccion" placeholder="Ej: Paraguay 5261" value="" required>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="telefono" class="col-md-12 control-label text-center" style="color:black;font-family:Arial;font-size:17px;">Telefono</label>
                     <div class="col-md-12">
                        <input type="number" class="form-control text-center" id="telefono" name="telefono" placeholder="Ingrese su Telefono" value="" required>
                    </div>
                </div>
                <div class="col-md-2"></div> 
             </div>
                <div class="form-group text-center pt-3" style="margin:15px;">
                    <div class="col-md-12" style="margin:15px;">
                    <?php if(strpos($error, 'datos') !== false){ ?>
                    <p class="required" style="color:red;">* Debe completar todos los campos</p>
                    <?php } ?> 
                    <button type="submit" class="btn btn-default  bg-dark" name="submit" style="background-color:#A98307;color:rgb(243, 234, 234);font-family:Arial;font-size:17px;">Registrarse</button>
                    </div>
                </div>
               
                

</form>
<?php } ?>
</div>
</div>
</div>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="js/registro.js"></script>

<?php include('inc/footer.php');?>

