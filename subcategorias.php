<?php
include_once('inc/header.php');


$categoria = new Categoria($con);

if(isset($_GET['categoria_id'])){
$padre = $_GET['categoria_id'];
}

if(isset($_POST['submit'])){
    
    if($_POST['categoria_id'] > 0){
			$categoria->editCategoria($_POST); 
		   
	}else{
			$categoria->saveCategoria($_POST); 
	}

}	

if(isset($_GET['del'])){
		$categoria->delCategoria($_GET['del']);
}
?> 

<div class="container-fluid">
      
	  <?php $categoriasMenu = 'Categorias';
	  
	  
	   if(!in_array('cat',$_SESSION['usuario']['secciones'])){ 
				header('Location:index.php');
			}
			

	include_once('inc/side_bar.php');
	 
?>
	        
        <div class="col-sm-9 col-md-10 main">
          
          <!--toggle sidebar button-->
          
		   <div class="row">

				<div class="col-4"></div>
		  		<div>
		  				<h1 class="page-header text-center subtitulo ml-4">
            			Subcategorias
          				</h1>
		  		</div>        
		  
			</div>

       
				<a href="categorias_ae.php?padre_id=<?=$padre?>" class="btn btn-md bg-dark float-right mt-3 mb-4 mr-4" style="background-color:#A98307;font-family:Arial;color:white;margin-bottom:8px;">Nueva Subcategoria</a>
		
 
		  
			  <div class="table-responsive">
				<table class="table table-striped" style="table-layout: fixed; width: 99%;">
				  <thead>
					<tr class="bg-dark" style="font-family:Arial;background-color:#A98307;">
                      <th style="width:30%;color:rgb(243, 234, 234);" class="">Nombre</th>
                      <th style="width:30%;color:rgb(243, 234, 234);" class="">Categoria Superior</th>
                      <th class=" pl-0 pr-5" style="color:rgb(243, 234, 234);padding-left:30px">Activo</th>
                      <th style="color:rgb(243, 234, 234);">Acciones</th>
					</tr>
				  </thead>
				  <tbody>
                    <?php 	 
				   $var = isset($_GET['categoria_id'])?$_GET['categoria_id']:'';
				   if(!empty($var)){
						foreach($categoria->getListHijos($var) as $ca){
                  ?>
							<tr>
                              <td style="width:30%;word-wrap: break-word;"><?= utf8_encode($ca['nombre_Cat']);?></td>
                              <td style="width:30%;word-wrap: break-word;padding-left:12px;">
                              <?php 	 
							   $cat = $categoria->getCategoria($ca['padre_id']);
							  
                            ?>
                                <a href="categorias.php?categoria_id=<?=$cat->categoria_id?>"><?=utf8_encode($cat->nombre_Cat);?></a>
                              </td>
							  <td>
                                   <div class="row" style="display:inline-block">

                                      
                                        <div class="col-md-6">

                                            <a href="activar.php?inactivo=0&categoria_id=<?=$ca['categoria_id']?>&padre_id=<?=$ca['padre_id']?>" class=" <?=$ca['inactivo'] == 0 ?'active':''?> list-group-item list-group-item-action text-center pl-2 py-1" style="font-size:16px;width:6px;margin=0px;padding-left:8px;padding-right:20px;border-radius: 20px;height:10px;padding-bottom:25px;padding-top:4px;">Si</a>
                                        </div>

                                       

                                        <div class="col-md-6">

                                        <a href="activar.php?inactivo=1&categoria_id=<?=$ca['categoria_id']?>&padre_id=<?=$ca['padre_id']?>" class=" <?=$ca['inactivo'] == 1 ?'active':''?> list-group-item list-group-item-action text-center  pl-1 pr-4 py-1" style="font-size:16px;width:6px;margin:0px;padding-left:4px;padding-right:25px;border-radius: 20px;height:10px;padding-bottom:25px;padding-top:4px;">No</a>

                                        </div>

                                   </div>
                        
                              </td>

                              <td>
                                  
								 
										<a href="categorias_ae.php?edit=<?=$ca['categoria_id']?>&padre_id=<?=$ca['padre_id']?>"><button type="button" class="btn btn-success" title="Modificar">E</button></a>
								
								  
										<a href="subcategorias.php?del=<?=$ca['categoria_id']?>&categoria_id=<?=$ca['padre_id']?>"><button type="button" class="btn btn-danger" title="Borrar">X</button></a>
							
                              </td>
                              
							</tr>
						<?php }
						}
						elseif(empty('del')){
							echo '<script>alert("No hay datos para mostrar");</script>';
						}?>                
				  </tbody>
				</table>
			  </div>

          
      </div><!--/row-->
	</div>
</div><!--/.container-->

<?php include('inc/footer.php');?>