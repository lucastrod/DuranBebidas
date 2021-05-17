<?php
include_once('inc/header.php');
include_once('funciones.php');

?> 

<div class="container-fluid">
      
      <?php $productsMenu = 'Productos';
	include_once('inc/side_bar.php');
	
	
	   if(!in_array('produ',$_SESSION['usuario']['secciones'])){
				header('Location: panel.php');
			}
	
    $prod = new Producto($con);
    $categoria = new Categoria($con);
    
	
	if(isset($_GET['edit'])){
        if((!empty($_GET['edit']))){
            $producto = $prod->getProducto($_GET['edit']);
            $titulo = 'Editar Producto';
            $prod = $_GET['edit'];
            $get = '?edit='.$_GET['edit'];

            $imagen = chequearImagen($prod);
        }
        else{
            $titulo = 'Nuevo Producto';
            $imagen = null;
            $get = '';
            $prod = '';
        }
    }
    else{
            $titulo = 'Nuevo Producto';
            $imagen = null;
            $get = '';
            $prod = '';
    }
	?>
	  
	  
        
        <div class="col-sm-9 col-md-10 main container">
          
          <!--toggle sidebar button-->
          
          
	      <div class="row">

            <div class="col-md-3"></div>
            <div class="col-md-4">
                <h1 class="page-header text-center subtitulo ml-5">
                    <?=$titulo;?>
                </h1>
            </div>        

          </div>




    <div class="row">

        <div class="col-md-2"></div>

        <div class="col-md-6 card my-3 border border-secondary shadow"  style="border-radius: 15px; background: -webkit-linear-gradient(#a98307d5,#5a4c1e);">
        <div class="card-header text-center py-2 m-0 pase" style="border-top-right-radius: 15px;border-top-left-radius: 15px;margin:15px;">
            <img src="images/logo1.png" alt="logo" class="img-fluid" width="70">
        </div>
        <div class="card-body">    
  
            <form action="ListProd.php" method="post" class="from-horizontal" enctype="multipart/form-data">

             <div class="row" style="margin:15px;">
                <div class="form-group col-md-6">
                    <label for="nombre" class="col-md-12 control-label text-center" style="color:rgb(243, 234, 234);font-family:Arial;font-size:17px;">Nombre</label>
                    <div class="col-md-12">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value="<?=isset($producto->nombre)?utf8_decode(utf8_encode($producto->nombre)):'';?>" required>
                    </div>
                </div> 
                 <div class="form-group col-md-6">
                    <label for="apellido" class="col-md-12 control-label  text-center" style="color:rgb(243, 234, 234);font-family:Arial;font-size:17px;">Stock</label>
                     <div class="col-md-12">
                        <input type="text" class="form-control" id="apellido" name="stock" placeholder="" value="<?=isset($producto->stock)?utf8_encode($producto->stock):'';?>" required>
                    </div>
                </div> 

             </div>
                
             <div class="row" style="margin:15px;">

                 <div class="form-group col-md-6">
                    <label for="producto" class="col-md-12 control-label text-center" style="color:rgb(243, 234, 234);font-family:Arial;font-size:17px;">Precio</label>
                     <div class="col-md-12">
                        <input type="text" class="form-control" id="usuario" name="precio" placeholder="" value="<?=isset($producto->precio)?$producto->precio:'';?>" required>
                    </div>
                </div> 
             </div>


                 
             </div>
			


<div class="row" style="margin-top:25px;">
    <div class="form-group col-md-12" style="margin:1px;">
        <label for="tipo" class="col-md-12 control-label text-center" style="color:rgb(243, 234, 234);font-family:Arial;font-size:20px;">Categoria</label>
        <div class="col-md-12 text-center">
        <div id="get" data-id="<?=$get?>"></div>
            <select name="categorias[]" id="catPrinc"  required>
                <?php
                $cat =''; 
                foreach($categoria->getListCategorias(array('padre_id'=> 0)) as $t){?>
                    <option value="<?=$t['categoria_id']?>" id="option" data-id="<?=$t['categoria_id']?>"
                    <?php
             
                        if(isset($producto->categorias)){
                            if(in_array($t['categoria_id'],$producto->categorias)){
                                echo ' selected="selected" ';
                                $cat = $t;
                            }
                        }
                    
                    ?>><?=$t['nombre_Cat']?></option>
                    
                <?php }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group col-md-12" style="margin:1px;">
        <label for="tipo" class="col-md-12 control-label text-center" style="color:rgb(243, 234, 234);font-family:Arial;font-size:20px;">Subcategoria</label>
        <div class="col-md-12 text-center">
            <div id="prod" data-id="<?=$prod?>"></div>
            <select name="categorias[]" id="subcate" required>   
            <?php
            if(!(empty($cat))){
                $ca = $categoria->getListSubcat($cat['categoria_id']);
            }
            else{
                $ca = $categoria->getListSubcat(1);
            }
               foreach($ca as $t){?>
                    <option value="<?=$t['categoria_id']?>" id="option" data-id="<?=$t['categoria_id']?>"
                    <?php
             
                        if(isset($producto->categorias)){
                            if(in_array($t['categoria_id'],$producto->categorias)){
                                echo ' selected="selected" ';
                                $cat = $t;
                            }
                        }
                    
                    ?>><?=$t['nombre_Cat']?></option>
                    
                <?php }
                ?>
            </select>
            
        </div>
    </div>
</div>
    <!--getListCategorias-->

    
             <div class="row" style="margin:15px;">

                 <div class="form-group col-md-12">
                    <label for="producto" class="col-md-12 control-label text-center" style="color:rgb(243, 234, 234);font-family:Arial;font-size:20px;">Descripcion</label>
                     <div class="col-md-12">
                        <textarea required class="form-control" id="descripcion" name="descripcion" rows="4" cols="60" placeholder=""> <?=isset($producto->descripcion)?utf8_decode(utf8_encode($producto->descripcion)):'';?></textarea>
                    </div>
                </div> 
             </div>

			 <div class="row" style="margin:15px;">
             <div class="form-group pt-4 col-md-12 text-center">
                              <label for="imagen" class="d-none col-md-12"  style="color:white;">Imagen</label>
							  <div class="col-md-3"></div>
                              <input type="file" class="form-control-file" name="imagen" id="imagen" aria-describedby="fileHelpId">
                              <small id="fileHelpId" class="form-text col-md-12" style="color:white;">El formato de la imagen debe ser <b>PNG</b></small>
                            </div>

                            <?php
                                if($imagen):
                            ?>
                                    <div class="row justify-content-center">
                                        <div class="col-4 justify-content-center">
                                            <div class="card  justify-content-center">
                                                <div class="card-body " style="width: 80px;margin-left:30px;">
                                                    <img src="<?= $imagen; ?>" alt="" class="img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                endif;
                            ?>
             </div>     
                <div class="form-group text-center pt-3" style="margin:15px;">
                    <div class="col-md-12" style="margin:15px;">
                    <button type="submit" class="btn btn-default  bg-dark" name="submit" style="background-color:#A98307;color:rgb(243, 234, 234);font-family:Arial;font-size:17px;">Guardar</button>
                    </div>
                </div> 
                <input type="hidden" class="form-control" id="producto_id" name="producto_id" placeholder="" value="<?=isset($producto->producto_id)?$producto->producto_id:'';?>">

            </form>
        </div>
    </div>

</div>

          
      </div><!--/row-->
	</div>
</div><!--/.container-->
<br>
<script src="js/cartel.js"></script>
<?php include('inc/footer.php');?>