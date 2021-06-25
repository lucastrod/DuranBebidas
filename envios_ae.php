<?php
include_once('inc/headerBlack.php');
?> 

<div class="container-fluid">
      
      <?php $enviosMenu = 'Envios';
      
	include_once('inc/side_bar.php');
	
	
	   if(!in_array('env',$_SESSION['usuario']['secciones'])){ 
				header('Location: index.php');
			}
    
    $envio = new Envio($con);

	if(isset($_GET['edit'])){
        if((!empty($_GET['edit'])) || empty($_GET)){
            $env = $envio->getEnvio($_GET['edit']);
            $titulo = 'Editar Costo';    
        }
        else {
            echo '<script>alert("No hay datos para mostrar");</script>';
            $titulo = 'Error';
        }
    }
    else {
        echo '<script>alert("No hay datos para mostrar");</script>';
        $titulo = 'Error';
    }
   
    
   
    
if(isset($env->id_envio)){
        $action = "envios.php";
}
else {
    echo '<script>alert("No hay datos para mostrar");</script>';
    $action = "";
}
     
?>
	  
	  
        
        <div class="col-sm-9 col-md-10 main">
          
          <!--toggle sidebar button-->
          
          
          <div class="row">

            <div class="col-md-3"></div>
            <div  class="col-md-4">
                <h1 class="page-header text-center subtitulo ml-5">
                    <?=$titulo;?>
                </h1>
            </div>        

          </div>
<?php
if($titulo != 'Error'){?>      
  
<div class="row" style="padding-bottom:25px;">

<div class="col-md-2"></div>

<div class="col-md-6 card my-3 border border-secondary shadow"  style="border-radius: 15px; background: -webkit-linear-gradient(#a98307d5,#5a4c1e);">
        <div class="card-header text-center py-2 m-0 pase" style="border-top-right-radius: 15px;border-top-left-radius: 15px;">
            <img src="images/logo1.png" alt="logo" class="img-fluid" width="70">
        </div>
        <div class="card-body">
            <form action="<?= $action; ?>" method="post" enctype="multipart/form-data">

                <div class="form-group text-center">
                    <label for="nombre" class="col-md-12 control-label text-center" style="color:rgb(243, 234, 234);font-family:Arial;font-size:20px;">Precio</label>
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <input type="text" class="form-control text-center" id="precio" name="precio" placeholder="" value="<?=isset($env->precio)?$env->precio:'';?>" required>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                
            <div class="row" style="margin:25px;">
                <div class="form-group text-center pt-3" style="margin:15px;">
                   
                    <div class="col-md-12"  style="padding:15px;">
                        <button type="submit" class="btn btn-default bg-dark pt-2" name="submit" style="background-color:#A98307;color:rgb(243, 234, 234);font-family:Arial;font-size:17px;">Guardar</button>
                    </div>
                
                </div>

                <input type="hidden" class="form-control" id="id_envio" name="id_envio" placeholder="" value="<?=isset($env->id_envio)?$env->id_envio:'';?>">
            </div>
            </form>
        </div>
    </div>

</div>

<?php }?>
 
          
      </div><!--/row-->
	</div>
</div><!--/.container-->

<?php include('inc/footer.php');?>