<?php 
include_once('inc/headerblack.php');
include_once('inc/arrays.php');
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

<title>Login</title>

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

<body class="customer-account-login inner-page">
<div id="page"> 

  
  <!-- Main Container -->
  <section class="main-container col1-layout bounceInUp animated">
    <div class="main container">
  

      <div class="account-login">
        <div class="page-title">
        <br>
          
          <h1>Iniciar Sesión</h1>

        </div>
        <fieldset class="col2-set">
          <legend>Login</legend>

          <div class="col-1 new-users"><strong>Nuevos Usuarios</strong>
            <div class="content">
              <p>Al crear una cuenta podras visualizar tus anteriores pedidos y otros beneficios mas!</p>
              <div class="buttons-set">

              <a href="registro.php"><button class="button create-account">Registrarse</button></a>

              </div>
            </div>
          </div>
          
          <!-- Solo si es user Admin -->
          <form action="ListProd.php" method="post" class=" from-horizontal">

          <div class="col-2 registered-users"><strong>Usuarios Registrados</strong>
            <div class="content">
              <p>Si ya tenes una cuenta, por favor logueate</p>
              <ul class="form-list">
                <li>
                  <label for="email">Email<span class="required">*</span></label>
                  <br>
                  <input type="text" name="email" class="form-control input_user"
                     value="<?=isset($usuario->email)?$usuario->email:'';?>" required>
                </li>
                <li>
                  <label for="pass">Constraseña <span class="required">*</span></label>
                  <br>
                  <input type="password" name="clave" class="form-control input_pass"
                                      required>
                </li>
              </ul>
              <?php

if(!empty($_GET["estado"])){
    $estado = $_GET["estado"];

    if($estado == "error"):
        
        if(!empty($_GET["error"])):
            $error = $_GET["error"];
            
            if(array_key_exists($error,$errores)):
            ?>
         <p class="required"><?= $errores[$error]; ?></p>
            <?php
            endif;

        endif;

    
    endif;
  }
  else{?>
    <p class="required">* Campos Requeridos</p>
<?php }
?>
              
              <div class="buttons-set">
                <button id="send2" name="login" type="submit" class="button login"><span>Login</span></button>
                <a class="forgot-word" href="recuperar_pass.php">Olvidaste tu contraseña?</a> </div>
            </div>
          </div>
                            

          </form>
          
        </fieldset>
      </div>
      <br>
      <br>
      <br>
      <br>
      <br>
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
<?php include_once('inc/footer.php'); ?>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/jquery.mb.YTPlayer.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="js/main.js"></script>

</body>
</html>