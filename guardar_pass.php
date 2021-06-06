<?php 

if(!isset($_POST['submit'])){
    header("Location:index.php");
    die();
}

include_once('inc/headerBlack.php');
include_once('funciones.php');

$error = '';
if(isset($_POST['submit'])){

    if(isset($_POST['id_usuario']) && isset($_POST['token']) && isset($_POST['clave'])){
        $resp = $user->actualizarClave($_POST['id_usuario'],$_POST['token'], $_POST['clave']);

        if($resp){
            $mensaje = 'Se actualizó correctamente su clave';
        }
        else{
            $error = 'Se produjo un error al actualizar su clave';
        }
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
 <body>
        
        <div class="container">
            <div class="form_container">

            <div class="site-wrap">
                <div class="site-section">
                    <div class="container" >
                        <div class="row">
                        <div class="col-md-12 text-center">
                            <span class="icon-check_circle display-3 text-success"></span>
                            <h2 class="display-3 text-black" style="margin-top: 80px;font-size:40px;">Correcto !</h2>
                            <p class="lead mb-5"><?= $mensaje;?></p>
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
<?php } ?>
</section>

<?php include('inc/footer.php');?>