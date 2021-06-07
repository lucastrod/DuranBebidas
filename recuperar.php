<?php

if(!isset($_GET['id']) && !isset($_GET['val'])){
  header("Location:index.php");
  die();
}

include_once('inc/headerBlack.php');
require_once("funciones.php");

$error='';

if(isset($_GET['id']) && isset($_GET['val'])){

    $id_Usuario = $_GET['id'];
    $token = $_GET['val'];

    $existe = $user->validarRecupero($id_Usuario,$token);
    
    if(!$existe){
        $error = 'No existe usuario';
    }
}
?>
<body>
<section class="main-container col1-layout bounceInUp animated">
    <div class="main container">
    <?php if($error !== ''){ ?>
      <body>
        
        <div class="container">
            <div class="form_container">

            <div class="site-wrap">
                <div class="site-section">
                    <div class="container" >
                        <div class="row">
                        <div class="col-md-12 text-center">
                            <span class="icon-check_circle display-3 text-success"></span>
                            <h2 class="display-3 text-black" style="margin-top: 80px;font-size:40px;">Error !</h2>
                            <p class="lead mb-5"><?= $error;?></p>
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
      <div class="col-main text-center">
        <div class="account-login">
          <div class="page-title">
          <br>
          <br>
            <h1>Cambiar Contraseña</h1>
          </div>
          <!--page-title-->
          <form method="POST" action="guardar_pass.php">
            <fieldset class="col2-set">
              <strong><h3>Recupera tu contraseña aquí</h3></strong>
              <div class="content text-center">
              <div class="row" style="margin:15px;">
                <div class="col-md-4"></div>
                <div class="form-group col-md-4">
                    <label for="clave" class="col-md-12 control-label text-center" style="color:black;font-family:Arial;font-size:17px;">Nueva Contraseña</label>
                     <div class="col-md-12">
                        <input type="password" class="form-control text-center" id="clave" name="clave" placeholder="Contraseña" value="" required>
                    </div>
                </div>
                <div class="col-md-4"></div>
                </div>
            
              </div>
              <!--content-->
            
              <button type="submit" name="submit" title="Submit" class="button" style="background-color:#C2A476;"><span style="color:white;">Enviar</span></button>
              
            </fieldset>
            <a href="login.php"><small>« </small>Volver al Login</a>

            <input type="hidden" class="form-control" id="id_usuario" name="id_usuario" placeholder="" value="<?=isset($id_Usuario)?$id_Usuario:'';?>">
            <input type="hidden" class="form-control" id="token" name="token" placeholder="" value="<?=isset($token)?$token:'';?>">
            <!--col2-set-->
          </form>
        </div>
      </div>
      <?php } ?>
      <!--col-main--> 
    </div>
  </section>
</body>


<?php include('inc/footer.php');?>