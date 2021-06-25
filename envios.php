<?php
include_once('inc/headerBlack.php');

$envio = new Envio($con);

if(isset($_POST['submit'])){

    if($_POST['id_envio'] > 0){
		
			$envio->editCosto($_POST); 
		   
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
            			Envio
          			</h1>
		  	</div>        
		  
		</div>
		  
		<?php $enviosMenu = 'Envios';
	  
	  
	  if(!in_array('env',$_SESSION['usuario']['secciones'])){ 
			   header('Location:index.php');
		   }
		   

   include_once('inc/side_bar.php');
	
?>		
		 
			  <div class="table-responsive">
				<table class="table table-striped" style="table-layout: fixed; width: 99%;">
				  <thead>
					<tr  class="bg-dark" style="font-family:Arial;background-color:#A98307;">
                      <th style="width:50%;color:rgb(243, 234, 234);" class="text-center">Costo Envio</th>
                      <th style="color:rgb(243, 234, 234);" class="text-center">Acciones</th>
					</tr>
				  </thead>
				  <tbody>
                    <?php 	 
                   
						foreach($envio->getPrecio() as $env){
                  ?>
							<tr>
                                <td class="text-center"><?= $env['precio'];?></td>
                              <td class="text-center">
										<a href="envios_ae.php?edit=<?=$env['id_envio']?>"><button type="button" class="btn btn-success" title="Editar">E</button></a>
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