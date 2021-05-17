<?php
include_once('inc/header.php');


$categoria = new Categoria($con);

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
				header('Location:panel.php');
			}
			

	include_once('inc/side_bar.php');
	 
?>
	        
        <div class="col-sm-9 col-md-10 main">
          
          <!--toggle sidebar button-->
          
		 <div class="row">

			<div class="col-4"></div>
		  	<div>
		  			<h1 class="page-header text-center subtitulo ml-4">
            			Categorias
          			</h1>
		  	</div>        
		  
		</div>
		  
		 
			<a href="categorias_ae.php?padre_id=0" class="btn btn-md bg-dark float-right mt-3 mb-4 mr-4" style="background-color:#A98307;font-family:Arial;color:white;margin-bottom:8px;">Nueva Categoria</a>
		
 
		 
			  <div class="table-responsive">
				<table class="table table-striped" style="table-layout: fixed; width: 99%;">
				  <thead>
					<tr  class="bg-dark" style="font-family:Arial;background-color:#A98307;">
                      <th style="width:20%;color:rgb(243, 234, 234);" class="">Categoria</th>
                      <th style="width:50%;color:rgb(243, 234, 234);" class="">Subcategorias</th>
                      <th class=" pl-0 pr-5" style="color:rgb(243, 234, 234);padding-left:30px;width:12%">Activo</th>
                      <th style="color:rgb(243, 234, 234);">Acciones</th>
					</tr>
				  </thead>
				  <tbody>
                    <?php 	 
                   
						foreach($categoria->getListCategorias(array('padre_id'=> 0,'categoria_id' => isset($_GET['categoria_id'])?$_GET['categoria_id']:'')) as $cat){
                  ?>
							<tr>
                              <td style="width:20%;word-wrap: break-word;"><a href="subcategorias.php?categoria_id=<?=$cat['categoria_id']?>"><?= utf8_encode($cat['nombre_Cat']);?></a></td>
                              <td style="width:40%;word-wrap: break-word;">
							  <?php 	 
                                foreach($categoria->getListHijos($cat['categoria_id']) as $ca){
                            ?>
                                <?= utf8_encode($ca['nombre_Cat']);?>
                              
                              <?php }?>
                              </td>
							  <td>
                                   <div class="row" style="display:inline-block">

                                       
                                        <div class="col-md-6">

                                            <a href="activar.php?inactivo=0&categoria_id=<?=$cat['categoria_id']?>" class=" <?=$cat['inactivo'] == 0 ?'active':''?> list-group-item list-group-item-action text-center pl-2 py-1"style="font-size:16px;width:6px;margin=0px;padding-left:8px;padding-right:20px;border-radius: 20px;height:10px;padding-bottom:25px;padding-top:4px;">Si</a>
                                        </div>

                                       

                                        <div class="col-md-6">

                                        <a href="activar.php?inactivo=1&categoria_id=<?=$cat['categoria_id']?>" class=" <?=$cat['inactivo'] == 1 ?'active':''?> list-group-item list-group-item-action text-center  pl-1 pr-4 py-1" style="font-size:16px;width:6px;margin:0px;padding-left:4px;padding-right:25px;border-radius: 20px;height:10px;padding-bottom:25px;padding-top:4px;">No</a>

                                        </div>

                                   </div>
                        
                              </td>

                              <td>

										<a href="categorias_ae.php?edit=<?=$cat['categoria_id']?>&padre_id=0"><button type="button" class="btn btn-success" title="Editar">E</button></a>
								  
								 
										<a href="categorias.php?del=<?=$cat['categoria_id']?>"><button type="button" class="btn btn-danger" title="Borrar">X</button></a>
								
                              </td>
                              
							</tr>
						<?php }?>                
				  </tbody>
				</table>
			  </div>

          
      </div><!--/row-->
	</div>
</div><!--/.container-->

<?php include('inc/footer.php');?>