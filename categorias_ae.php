<?php
include_once('inc/headerBlack.php');
?> 

<div class="container-fluid">
      
      <?php $categoriasMenu = 'Categorias';
      
	include_once('inc/side_bar.php');
	
	
	   if(!in_array('cat',$_SESSION['usuario']['secciones'])){ 
				header('Location: panel.php');
			}
    
    $categoria = new Categoria($con);

	if(isset($_GET['edit'])){
        if((!empty($_GET['edit'])) || empty($_GET)){
            $cat = $categoria->getCategoria($_GET['edit']);

            if(isset($_GET['padre_id'])){
                if($_GET['padre_id'] != 0){
                $titulo = 'Editar Subcategoria';
                }
                else{
                $titulo = 'Editar Categoria';
                }
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
    }
    elseif(isset($_GET['padre_id'])){
        if($_GET['padre_id'] == 1){
        
            $titulo = 'Nueva Subcategoria';
        }    
        else{
            $titulo = 'Nueva Categoria';
        }
    }
    else {
        echo '<script>alert("No hay datos para mostrar");</script>';
        $titulo = 'Error';
    }
   
    
   
    
if(isset($cat->padre_id)){
    if($cat->padre_id > 0){
        $action = "subcategorias.php?categoria_id=".$_GET['padre_id'];
      }
      else{
        $action = "categorias.php";
      }
}
elseif(isset($_GET['padre_id'])){
    if($_GET['padre_id'] == 1){
    
        $action = "subcategorias.php?categoria_id=".$_GET['padre_id'];
    }    
    else{
        $action = "categorias.php";
    }
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
                    <label for="nombre" class="col-md-12 control-label text-center" style="color:rgb(243, 234, 234);font-family:Arial;font-size:20px;">Nombre</label>
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <input type="text" class="form-control text-center" id="nombre_Cat" name="nombre_Cat" placeholder="" value="<?=isset($cat->nombre_Cat)?$cat->nombre_Cat:'';?>" required>
                    </div>
                    <div class="col-md-2"></div>
                </div>
                
    <?php
    if(isset($_GET['padre_id'])){
    if($_GET['padre_id'] != 0){?>

        <div class="form-group">
        <label for="tipo" class="col-md-12 control-label text-center" style="color:rgb(243, 234, 234);font-family:Arial;font-size:20px;padding-top:15px;">Categoria Superior</label>
        <div class="col-md-12 text-center" style="padding-bottom:15px;">
            <select name="padre_id[]" id="padre_id" required>
                <?php foreach($categoria->getListCategorias(array('padre_id'=> 0)) as $t){?>
                    <option value="<?=$t['categoria_id']?>" 
                    <?php
             
                        if(isset($t['padre_id'])){
                            if($_GET['padre_id'] == $t['categoria_id']){
                                echo ' selected="selected" ';
                            }
                        }
                    
                    ?>><?=$t['nombre_Cat']?></option>
                <?php }?>
            </select>
        </div>
        </div>

    <?php }
    }?>
            <div class="row" style="margin:25px;">
                <div class="form-group text-center pt-3" style="margin:15px;">
                   
                    <div class="col-md-12"  style="padding:15px;">
                        <button type="submit" class="btn btn-default bg-dark pt-2" name="submit" style="background-color:#A98307;color:rgb(243, 234, 234);font-family:Arial;font-size:17px;">Guardar</button>
                    </div>
                
                </div>

                <input type="hidden" class="form-control" id="categoria_id" name="categoria_id" placeholder="" value="<?=isset($cat->categoria_id)?$cat->categoria_id:'';?>">
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