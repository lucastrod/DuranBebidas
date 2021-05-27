<?php
include_once('inc/headerBlack.php');
include_once('funciones.php');


$producto = new Producto($con);
$categoria = new Categoria($con);

;

if(isset($_POST['submit'])){


	$imagen = $_FILES["imagen"];
    if($_POST['producto_id'] > 0){
			$producto->editarProducto($_POST); 
		   
	}else{
			$prod = $producto->saveProducto($_POST);
			mkdir(RUTA_IMAGENES."$prod");
			if($imagen["name"]==''){

				$origen = "images/sin_imagen.png";
				$destino = RUTA_IMAGENES."$prod";
    			copy($origen, $destino."/0.png"); 
			}
			else{
				moverImagen($imagen,$prod);
			} 
	}

}	

if(isset($_GET['del'])){
		$producto->delProducto($_GET['del']);
		$id = $_GET['del'];	
		unlink(RUTA_IMAGENES."$id/0.png");
		rmdir(RUTA_IMAGENES.$_GET['del']);

}

if(!empty($_POST['producto_id'])):
	$id = $_POST['producto_id'];
endif;

if(!empty($_POST['producto_id'])):
	if(!empty($_FILES["imagen"])):
    	$imagen = $_FILES["imagen"];

    	if(!empty($imagen["type"]) && $imagen["type"] != "image/png"):
			header("Location:ListProd.php?estado=error&error=formato");
        	die();
    	endif;

    	//mkdir(RUTA_IMAGENES."$id");
		moverImagen($imagen,$id);
	else:
		echo 'No tengo img';	
	endif;
endif;	


//header("Location:ListProd.php?estado=ok&ok=alta");
?> 

<div class="container-fluid">
      

	        
        <div class="col-sm-9 col-md-10 main">
          
          <!--toggle sidebar button-->

          
		 <div class="row">

			<div class="col-4"></div>
		  	<div>
		  			<h1 class="page-header text-center subtitulo ml-4">
            			Productos
          			</h1>
		  	</div>        
		  
		</div>
	
	<?php $productsMenu = 'Productos';
			

			include_once('inc/side_bar.php');
		
			if(!in_array('produ',$_SESSION['usuario']['secciones'])){
				header('Location: panel.php');
			}
			 
		?>

		<div class="pt-3 col-2">

          <h6> Filtrar por categorias</h6>

          <form id="form" name="form" method="post" action="ordenar.php">

			  <select name="categoria" id="cat" onChange="document.form.submit();">
							  <option value=""></option>
							  <option value="">Todos</option>	
							<?php foreach($categoria->getListCategorias(array('padre_id'=> 0)) as $t){?>
                            <?php if ($t['categoria_id'] == $_GET['cat'] ){
                                $class="selected";
                            }
                            else{
                                $class="";
                            } ?>
                    		<option value="<?=$t['categoria_id']?>" <?=$class?>><?=$t['nombre_Cat']?></option>
						<?php }?>
						<?php foreach($categoria->getListCategorias(array('padre_id'=> 1)) as $t){?>
                            <?php if ($t['categoria_id'] == $_GET['cat'] ){
                                $class="selected";
                            }
                            else{
                                $class="";
                            } ?>
							
                    		<option value="<?=$t['categoria_id']?>&padre_id=1" <?=$class?>><?=$t['nombre_Cat']?></option>
                		<?php }?>
              </select>
          </form>

		  </div>
		
			 <a href="ListProd_ae.php" class="btn btn-md  mt-3 mb-5 mr-4" style="background-color:#A98307;font-family:Arial;color:white;margin-bottom:8px;">Nuevo Producto</a>
		
		
			  <div class="table-responsive">
				<table class="table table-striped" style="table-layout: fixed; width: 99%;">
				  <thead>
					<tr class="bg-dark" style="font-family:Arial;background-color:#A98307;">
					  <th style="width:12%;color:rgb(243, 234, 234);" class="text-center">#</th>
                      <th style="width:12%;color:rgb(243, 234, 234);" class="">Nombre</th>
                      <th style="width:10%;color:rgb(243, 234, 234);" class="">Descripcion</th>
					  <th style="width:10%;color:rgb(243, 234, 234);" class="text-center">Categoria</th>
					  <th style="width:15%;color:rgb(243, 234, 234);" class="">Subcategoria</th>				  
					  <th style="width:10%;color:rgb(243, 234, 234);" class="">Stock</th>
					  <th style="width:10%;color:rgb(243, 234, 234);" class="">Oferta</th>
                      <th style="width:12%;color:rgb(243, 234, 234);padding-left:25px;" class="">Activo</th>
					  <th style="color:rgb(243, 234, 234);">Acciones</th>
					</tr>
				  </thead>
				  <tbody>
                    <?php 	 
                   
						foreach($producto->getListProductos($_GET) as $prod){
							$imagen = chequearImagen($prod['producto_id'])
							?>
				  
							<tr>
							  <td class="text-center"><?php
                                if($imagen):
                            ?>
                                    <div class="row justify-content-center">
                                    
                                            
                                                
                                                    <img src="<?= $imagen; ?>" alt="" class="img-fluid" width="45" height="90">
                                                
                                            
                                        
                                    </div>
                            <?php
                                endif;
                            ?></td>
							  <td style="width:40%;word-wrap: break-word;"><?= utf8_decode(utf8_encode($prod['nombre']));?></td>
                              <td><?= utf8_decode(utf8_encode($prod['descripcion']));?></td>
							  <td class="text-center">
							  
							  <?php

							  	if($prod['padre_id']>0){

									$padre = $categoria->getCategoria($prod['padre_id']);
								
								echo isset($padre->nombre_Cat)?$padre->nombre_Cat:'';
							  	}
							  	else{
									echo utf8_encode($prod['nombre_Cat']);
								  }?>
							   </td>
							  <td style="width:40%;word-wrap: break-word;">
							  
							  <?php
							
							   $ca = $producto->getListCatProd(array('padre_id'=> 1, 'producto_id'=> $prod['producto_id']));
							   foreach($ca as $key => $value){
							
                            ?>
                                <?= utf8_encode($value['nombre_Cat']);?>
							<?php }?>
							  </td>

                              <td><?= $prod['stock'];?></td>
					
							  <?php 
							 	if($prod['oferta']!=0){?>
  								<td><label class="p-3"><input type="checkbox" id="<?php echo $prod['producto_id']?>" value="first_checkbox" checked="checked" data-id="<?php echo $prod['producto_id']?>" data-precio="<?php echo $prod['precio']?>"> </label>
							  		<a title="Editar" href="javascript:void(null)"><img alt="Editar" src="images/lapiz.png" width="10" height="20" onClick="editar(<?php echo $prod['producto_id']?>, <?php echo $prod['precio_oferta']?>,<?php echo $prod['precio']?> );"></a>
							  	</td>
								<?php }
								else{?>
								<td><label class="p-3"><input type="checkbox" id="<?php echo $prod['producto_id']?>" value="first_checkbox" data-id="<?php echo $prod['producto_id']?>" data-precio="<?php echo $prod['precio']?>"> </label></td>
								<?php } ?>
							

							  <td>
                                   <div class="row" style="display:inline-block">
                                   <?php 
                                   if(!empty($_GET['cat'])){
                                    $cat='&cat='.$_GET['cat'].'';
                                   }
                                   else{
                                    $cat = '';
                                   }
								   if(!empty($_GET['padre_id'])){
                                    $padre='&padre_id='.$_GET['padre_id'].'';
                                   }
                                   else{
                                    $padre = '';
                                   }
                                   
                                  ?>
                                        <div class="col-md-6">
                                            <a href="activar.php?inactivo=0&producto_id=<?=$prod['producto_id']?><?=$cat?><?=$padre?>" class=" <?=$prod['inactivo'] == 0 ?'active':''?> list-group-item list-group-item-action text-center pl-2 py-1" style="font-size:16px;width:6px;margin=0px;padding-left:8px;padding-right:20px;border-radius: 20px;height:10px;padding-bottom:25px;padding-top:4px;">Si</a>                                      
                                        </div>
                                        <div class="col-md-6">
                                            <a href="activar.php?inactivo=1&producto_id=<?=$prod['producto_id']?><?=$cat?><?=$padre?>" class=" <?=$prod['inactivo'] == 1 ?'active':''?> list-group-item list-group-item-action text-center  pl-2 pr-4 py-1" style="font-size:16px;width:6px;margin:0px;padding-left:4px;padding-right:25px;border-radius: 20px;height:10px;padding-bottom:25px;padding-top:4px;">No</a>
                                        </div>
                                

                                   </div>
                        
							  </td>

							
							  
							  <td>
                                  
								
								  <a href="ListProd_ae.php?edit=<?=$prod['producto_id']?>"><button type="button" class="btn btn-success" title="Editar">E</button></a>
							
						   
								  <a href="ListProd.php?del=<?=$prod['producto_id']?>"><button type="button" class="btn btn-danger" title="Borrar">X</button></a>
						  
							</td>

						</tr>
						<?php }?>                
				  </tbody>
				</table>
			  </div>

          
      </div><!--/row-->
	</div>
</div><!--/.container-->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="js/oferta.js"></script>

<?php include('inc/footer.php');?>