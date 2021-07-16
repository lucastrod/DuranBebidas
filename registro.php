<?php
include_once('inc/headerBlack.php');
require_once("funciones.php");

$error = '';
$mensaje= '';
$direccion = '';
$recarga='';
$email = empty($_POST["email"])?'':$_POST["email"];
$clave = empty($_POST["clave"])?'':$_POST["clave"];
$usuario = empty($_POST["usuario"])?'':$_POST["usuario"];
$nombre = empty($_POST["nombre"])?'':$_POST["nombre"];
$calle = empty($_POST["calle"])?'':$_POST["calle"];
$numero = empty($_POST["numero"])?'':$_POST["numero"];
$apellido = empty($_POST["apellido"])?'':$_POST["apellido"];
$telefono = empty($_POST["telefono"])?'':$_POST["telefono"];
$piso_depto = empty($_POST["piso_departamento"])?'':$_POST["piso_departamento"];

if(isset($_POST['submit'])){

    if(empty($_POST["clave"]) || empty($_POST["email"]) || empty($_POST["usuario"]) || empty($_POST["nombre"]) || empty($_POST["apellido"]) || empty($_POST["calle"]) || empty($_POST["numero"])|| empty($_POST["telefono"]) || empty($_POST["confirmar_clave"])){
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

    if(!empty($_POST["calle"]) && !empty($_POST["numero"]) && $error ==''){

            $direccion = $_POST["calle"].' '.$_POST["numero"];
            $direccion.=', CABA';     
    }

    if($error ==''){
        $recarga = 'Si';     
    }

}

?>

<div class="container">

<span id="dir"  data-id="<?=$direccion?>"></span>
<span id="err"  data-id="<?=$error?>"></span>
<span id="ema"  data-id="<?=$email?>"></span>
<span id="cla"  data-id="<?=$clave?>"></span>
<span id="usu"  data-id="<?=$usuario?>"></span>
<span id="nom"  data-id="<?=$nombre?>"></span>
<span id="cal"  data-id="<?=$calle?>"></span>
<span id="num"  data-id="<?=$numero?>"></span>
<span id="tel"  data-id="<?=$telefono?>"></span>
<span id="pis"  data-id="<?=$piso_depto?>"></span>
<span id="ape"  data-id="<?=$apellido?>"></span>
<span id="rec"  data-id="<?=$recarga?>"></span>

<div class="form_container">
<?php if($recarga!=''){ 
?> 
    <body>
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
                 <div class="form-group col-md-3">
                    <label for="password" class="col-md-12 control-label text-center" style="color:black;font-family:Arial;font-size:17px;">Calle</label>
                     <div class="col-md-12">
                        <input type="text" class="form-control text-center" id="calle" name="calle" placeholder="Ej: Paraguay" value="" required>
                        <?php if(!empty($_GET['domicilio'])){ ?>
                        <p class="required" style="color:red;">*Domicilio Invalido</p>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-group col-md-2">
                    <label for="password" class="col-md-12 control-label text-center" style="color:black;font-family:Arial;font-size:17px;">Numero de Puerta</label>
                     <div class="col-md-12">
                        <input type="number" class="form-control text-center" id="numero" name="numero" placeholder="Ej: 5261" value="" required>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="password" class="col-md-12 control-label text-center" style="color:black;font-family:Arial;font-size:17px;">Piso/Departamento</label>
                     <div class="col-md-12">
                        <input type="text" class="form-control text-center" id="piso_departamento" name="piso_departamento" placeholder="Ej: PB, Piso 4 depto C" value="">
                    </div>
                </div>
            </div>
                <div class="row" style="margin:15px;">
                <div class="col-md-2"></div>
                        <div class="form-group col-md-3">
                            <label for="telefono" class="col-md-12 control-label text-center" style="color:black;font-family:Arial;font-size:17px;">Telefono</label>
                            <div class="col-md-12">
                                <input type="number" class="form-control text-center" id="telefono" name="telefono" placeholder="Ingrese su Telefono" value="" required>
                            </div>
                        </div>
                </div> 
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
<script src="js/recarga.js"></script>
<script src="js/VerificarDomicilio.js"></script>

<?php include('inc/footer.php');?>

