<?php
include_once('inc/headerblack.php');

if(isset($_POST['submit'])){ 
	if($_POST['id_usuario'] > 0){
			$user->edit($_POST); 
		   
	}else{
			$user->save($_POST); 
	}
}	


if(isset($_GET['del'])){
		$user->del($_GET['del']);
}
?> 

<div class="container-fluid">
      
        <div class="col-sm-9 col-md-10 main">
          
          <!--toggle sidebar button-->
          
		 <div class="row">

			<div class="col-4"></div>
		  	<div>
		  			<h1 class="page-header text-center subtitulo ml-4" style="font-family:Montserrat,sans-serif">
            			Entregas
          			</h1>
		  	</div>        
		  
		</div>
 
		<?php $entregaMenu = 'Entregas';
	  		
			  include_once('inc/side_bar.php');
		  
			  if(!in_array('ent',$_SESSION['usuario']['secciones'])){ 
				  header('Location:panel.php');
			  }
				  ?>
          
		  
		  <a href="categorias_ae.php?padre_id=0" class="btn btn-md bg-dark float-right mt-3 mb-4 mr-4" style="background-color:#A98307;font-family:Arial;color:white;margin-bottom:8px;">Nuevo Usuario</a>
				  
			  <div class="table-responsive">
				<table class="table table-striped" >
				  <thead>
					<tr class="bg-dark" style="font-family:Arial; background-color:#A98307;">
					  <th style="color:rgb(243, 234, 234);">Email</th>
					  <th style="color:rgb(243, 234, 234);">Usuario</th>
					  <th style="color:rgb(243, 234, 234);" class="text-center">Perfil</th>
					  <th style="color:rgb(243, 234, 234);" class="text-center pl-3">Activo</th>
					  <th style="color:rgb(243, 234, 234);" class="text-center pl-3">Acciones</th>
					</tr>
				  </thead>
				  <tbody>
					<?php 	 
						foreach($user->getList() as $usuario){?>
				  
							<tr>
							  
							 
							  <td><?=$usuario['email'];?></td>
							  <td><?=$usuario['usuario'];?></td>
							  <td class="text-center"><?=isset($usuario['perfiles'])?implode(', ',$usuario['perfiles']):'No tiene perfiles asignados';?></td>
							  <td>
                                   <div class="row">

                                        <div class="col-2">
                                            <a href="activar.php?activo=1&id_usuario=<?=$usuario['id_usuario']?>" class=" <?=$usuario['activo'] == 1 ?'active':''?> list-group-item list-group-item-action text-center pl-2 py-1" style="font-size:16px;">Si</a>
                                        </div>

                                        <div class="col-2">
                                        	<a href="activar.php?activo=0&id_usuario=<?=$usuario['id_usuario']?>" class=" <?=$usuario['activo'] == 0 ?'active':''?> list-group-item list-group-item-action text-center  pl-1 pr-4 py-1" style="font-size:16px;">No</a>
                                        </div>

                                   </div>
                              </td>
							  <td>	  
							  		<div class="col-2 " style="text-align: center">
										<a href="usuarios_ae.php?edit=<?=$usuario['id_usuario']?>"><button type="button" class="btn btn-success" title="Editar">E</button></a>								   
										<a href="usuarios.php?del=<?=$usuario['id_usuario']?>"><button type="button" class="btn btn-danger" title="Borrar">X</button></a>
									</div>
								
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