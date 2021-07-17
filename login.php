<?php 
include_once('inc/headerBlack.php');
include_once('inc/arrays.php');
?>
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
                  <label for="pass">Contraseña <span class="required">*</span></label>
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

</body>
</html>