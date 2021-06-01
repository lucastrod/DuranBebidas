<?php
include_once('inc/headerBlack.php');
require_once("funciones.php");

if(isset($_GET['id']) && isset($_GET['val'])){

    $id_Usuario = $_GET['id'];
    $token = $_GET['val'];

    $mensaje = $user->validarIdToken($id_Usuario,$token);
}
?>
<body>
<div><span id="mensaje" data-id="<?php echo $mensaje;?>"></span></div>
    <div class="container">

            <div class="form_container">

            <div class="site-wrap">
   

    <div class="site-section">
      <div class="container" >
        <div class="row">
          <div class="col-md-12 text-center">
            <span class="icon-check_circle display-3 text-success"></span>
            <h2 class="display-3 text-black" style="margin-top: 80px;font-size:40px;">Bienvenido!</h2>
            <p class="lead mb-5">Puede iniciar sesión presionando el boton de abajo</p>
          </div>
        </div>
      </div>
    </div>

  

  </div>

                <div class="form-group text-center pt-3" style="margin:15px;">
                    <div class="col-md-12" style="margin:15px;">
                    <button  class="btn btn-default  bg-dark"  style="background-color:#A98307;color:rgb(243, 234, 234);font-family:Arial;font-size:17px;"><a href="login.php" style="color:white;">Iniciar Sesion</a></button>
                    </div>
                </div> 
            </div>
    </div>
<div><button><a href="login.php">Iniciar Sesion</a></button></div>    
</body>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">


$(document).ready(function() {
        //value = $('#mensaje').text();
        var mensaje = $('#mensaje').data('id');

    if(mensaje.includes('correctamente'))
    {       
       Swal.fire({
       position: 'center',
       icon: 'success',
       title: mensaje,
       showConfirmButton: false,
       timer: 2500,
       customClass:'modal2'
        });
    }
    else{
        Swal.fire({
       position: 'center',
       icon: 'error',
       title: mensaje,
       showConfirmButton: false,
       timer: 2500,
       customClass:'modal2'
        });
    }

});

</script>

<?php include('inc/footer.php');?>