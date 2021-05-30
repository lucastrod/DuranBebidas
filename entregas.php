<?php
include_once('inc/headerblack.php');
$compra = new Compra($con);
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
				  ?>
          <div class="pt-3 col-2">
	
<h6> Filtrar Pedidos</h6>

<form id="form" name="form" method="post" action="ordenar.php">

	<select name="pedido" id="ped" onChange="document.form.submit();">
					<option value="" <?= empty($_GET['enCurso'])?"selected":''; ?>>Todos</option>
					<option value="si" <?= !empty($_GET['enCurso']) && $_GET['enCurso'] == 'si'?"selected":''; ?>>En curso</option>
					<option value="no"  <?= !empty($_GET['enCurso']) && $_GET['enCurso'] == 'no'?"selected":''; ?>>Finalizados</option>	
	</select>
</form>

</div>
				  
			  <div class="table-responsive">
				<table class="table table-striped" >
				  <thead>
					<tr class="bg-dark" style="font-family:Arial; background-color:#A98307;">
					  <th style="width:10%;color:rgb(243, 234, 234);" class="text-center">Pedido</th>
					  <th style="width:10%;color:rgb(243, 234, 234);" class="text-center">Entrega</th>
					  <th style="width:10%;color:rgb(243, 234, 234);" class="text-center pl-3">Finalizado</th>
					  <th style="width:17%;color:rgb(243, 234, 234);" class="text-center pl-3">Fecha Pedido</th>
					</tr>
				  </thead>
				  <tbody>
					<?php 	 
						foreach($compra->mostrarVenta($_GET) as $com){?>
				  
							<tr>
							  
							  <td class="text-center"><a href="detalleVenta.php?venta_id=<?=$com['id_venta']?>"><?= $com['id_venta'];?></a></td>
							  <td class="text-center"><?= $com['envio']==0?'Retiro en Tienda':'Envio'?></td>
							  <td class="text-center"><input type="checkbox" name="venta" data-id="<?php echo $com['id_venta']?>" data-estado="<?php echo $com['estado']?>" value="first_checkbox" <?= $com['estado']==1?'checked':''?>></td>
							  	<?php $originalDate = $com['fecha'];
								$newDate = date("d/m/Y H:i:s", strtotime($originalDate)); ?>
							  <td class="text-center"><?=$newDate?></td>
							</tr>
							<?php }?>                
				  </tbody>
				</table>
			  </div>
 
          
      </div><!--/row-->
	</div>
</div><!--/.container-->
<script src="js/actualizarVenta.js"></script>
<?php include('inc/footer.php');?>