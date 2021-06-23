<?php include_once('inc/headerBlack.php');
include_once('funciones.php');

$error='';
$mensaje= '';
if(isset($_POST['submit'])){
if(!empty($_POST['email'])){

  if(!esEmail($_POST['email'])){
    $error = 'Correo electrónico inválido';
  }

  $resp = $user->validarEmail($_POST["email"]);

  if(!$resp){
    $error = 'Correo electrónico inválido';
  }
  else{

    $usuario = $user->getDatos($_POST["email"]);

    if(($usuario->id_usuario) > 0){

    $url = 'https://'.$_SERVER["SERVER_NAME"].'/DuranBebidas/DuranBebidas/recuperar.php?id='.$usuario->id_usuario.'&val='.$usuario->token;

    $asunto = 'Recuperar Password - Duran Bebidas';

    $nombre = $usuario->nombre;
    $email = $usuario->email;

    $cuerpo = "Estimado $nombre: <br/> <br/> Para continuar con el proceso de recuperación de contraseña, es necesario que ingreses al siguiente link  <a href='$url'>Recuperar Contraseña</a>"; 

        if(confirmarPass($email, $nombre, $asunto, $cuerpo)){
    
            $valor = "Para terminar el proceso de recuperar la contraseña debe seguir las instrucciones que le enviamos a la direccion de correo electrónico: $email"; 
            $mensaje.='<div> <span id="mensaje" data-id="'.$valor.'"></span>';
        }
        else{
            Echo 'Falló el envío del email';
        }

    }

  }

}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!-- Favicons Icon -->

<title>Superb premium HTML5 &amp; CSS3 template</title>

<!-- Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS Style -->
<link rel="stylesheet" type="text/css" href="css/internal.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.css" media="all">
<link rel="stylesheet" type="text/css" href="css/simple-line-icons.css" media="all">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
<link rel="stylesheet" type="text/css" href="css/revslider.css" >
<link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="css/owl.theme.css">
<link rel="stylesheet" type="text/css" href="css/flexslider.css">
<link rel="stylesheet" type="text/css" href="css/jquery.mobile-menu.css">

<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,600,600italic,400italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
</head>

<body class=" customer-account-forgotpassword inner-page">
<div id="page"> 
  
  
  <!-- Main Container -->
  <section class="main-container col1-layout bounceInUp animated">
    <div class="main container">
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
                            <h2 class="display-3 text-black" style="margin-top: 80px;font-size:40px;">Se ha registrado su cambio de contraseña Correctamente!</h2>
                            <p class="lead mb-5">Una vez recuperada la contraseña, puede iniciar sesión presionando el boton de abajo</p>
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
      <div class="col-main">
        <div class="account-login">
          <div class="page-title">
          <br>
          <br>
            <h1>Olvidó su contraseña?</h1>
          </div>
          <!--page-title-->
          <form method="POST" action="recuperar_pass.php">
            <fieldset class="col2-set">
              <strong>Recupera tu contraseña aquí</strong>
              <div class="content">
                <p>Por favor ingrese su email. Va a recibir un correo para cambiar su contraseña.</p>
                <ul class="form-list">
                  <li>
                    <label for="email_address">Email<em class="required">*</em></label>
                    <div class="input-box">
                      <input type="text" name="email" alt="email" id="email" class="input-text required-entry validate-email" value="" required>
                      <?php if($error !== ''){ ?>
                        <p class="required" style="color:red;"><?= $error?></p>
                        <?php } ?>
                    </div>
                  </li>
                </ul>
              </div>
              <!--content-->
              
              <p class="required">* Campos requeridos</p>
              <button type="submit" name="submit" title="Submit" class="button" style="background-color:#C2A476;"><span style="color:white;">Enviar</span></button>
              <a href="login.php"><small>« </small>Volver al Login</a>
            </fieldset>
            <!--col2-set-->
          </form>
        </div>
      </div>
      <!--col-main--> 
      <?php } ?>
    </div>
  </section>
  <!-- Main Container End --> 
  
  <!-- Brand logo starts  -->
  <div class="brand-logo wow bounceInUp animated">
    <div class="container">
      <div class="slider-items-products">
        <div id="brand-logo-slider" class="product-flexslider hidden-buttons">
          <div class="slider-items slider-width-col6"> 
            

            
          </div>
        </div>
      </div>
     
    </div>
  </div>
  <!-- Brand logo ends  --> 
  <script src="js/pass.js"></script>
  <?php include_once('inc/footer.php'); ?>

</body>
</html>