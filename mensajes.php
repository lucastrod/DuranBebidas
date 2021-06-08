<?php
include_once('inc/headerBlack.php');

$mensajes = new Mensaje($con);

if(isset($_POST['submit'])){

    if($_POST['id_mensaje'] > 0){
		
			$mensajes->editMensaje($_POST); 
		   
	}
}	

?> 

<div class="container-fluid">
              
        <div class="col-sm-12 col-md-12 main">
          
          <!--toggle sidebar button-->
          
		 <div class="row">

			<div class="col-4"></div>
		  	<div>
		  			<h1 class="page-header text-center subtitulo ml-4">
            			Mensajes
          			</h1>
		  	</div>        
		  
		</div>
		  
		<?php $mensajesMenu = 'Mensajes';
	  
	  
	  if(!in_array('msj',$_SESSION['usuario']['secciones'])){ 
			   header('Location:index.php');
		   }
		   

   include_once('inc/side_bar.php');
	
?>		
		 
			  <div class="table-responsive">
				<table class="table table-striped" style="table-layout: fixed; width: 99%;">
				  <thead>
					<tr  class="bg-dark" style="font-family:Arial;background-color:#A98307;">
                      <th style="width:30%;color:rgb(243, 234, 234);" class="text-center">Titulo</th>
                      <th style="width:40%;color:rgb(243, 234, 234);" class="text-center">Subtitulo</th>
                      <th style="color:rgb(243, 234, 234);" class="text-center">Acciones</th>
					</tr>
				  </thead>
				  <tbody>
                    <?php 	 
                   
						foreach($mensajes->getMensajes() as $msj){
                  ?>
							<tr>
                                <td class="text-center"><?= $msj['titulo'];?></td>
                                <td class="text-center"><?= $msj['subtitulo'];?></td>
                              <td class="text-center">
										<a href="mensajes_ae.php?edit=<?=$msj['id_mensaje']?>"><button type="button" class="btn btn-success" title="Editar">E</button></a>
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