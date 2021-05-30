<?php
include_once('inc/headerBlack.php');

$compra = new Compra($con);

?>

<div class="container-fluid">
      
        <div class="col-sm-9 col-md-10 main">
          
          <!--toggle sidebar button-->
          
		 <div class="row">

			<div class="col-4"></div>
		  	<div>
		  			<h1 class="page-header text-center subtitulo ml-4" style="font-family:Montserrat,sans-serif">
            			Detalle Pedido
          			</h1>
		  	</div>        
		  
		</div>
 
		<?php $entregaMenu = 'Entregas';
	  		
			  include_once('inc/side_bar.php');
				  ?>
          <div class="pt-3 col-2">

</div>

<div class="table-responsive">
                <div><h4>Datos del Pedido</h4></div>
				<table class="table table-striped" style="table-layout: fixed; width: 99%;">
				  <thead>
					<tr class="bg-dark" style="font-family:Arial;background-color:#A98307;">
                      <th style="width:10%;color:rgb(243, 234, 234);" class="">Pedido</th>
                      <th style="width:12%;color:rgb(243, 234, 234);" class="">Producto</th>
					  <th style="width:15%;color:rgb(243, 234, 234);" class="text-center">Descripcion</th>
					  <th style="width:10%;color:rgb(243, 234, 234);" class="text-center">Cantidad</th>				  
					</tr>
				  </thead>
				  <tbody>
                    <?php 	 
                     $venta = isset($_GET['venta_id'])?$_GET['venta_id']:'';
						foreach($compra->getDetalleVenta($venta) as $vent){
							?>
				  
							<tr>
                              <td><?= $vent['id_venta'];?></td>
							  <td style="width:40%;word-wrap: break-word;"><?= utf8_decode(utf8_encode($vent['nombre']));?></td>
                              <td class="text-center"><?= utf8_decode(utf8_encode($vent['descripcion']));?></td>
                              <td class="text-center"><?= $vent['cantidad'];?></td>
						    </tr>
						<?php }?>                
				  </tbody>
				</table>
                <div><h4>Datos del Cliente</h4></div>
                <table class="table table-striped" style="table-layout: fixed; width: 99%;">
				  <thead>
					<tr class="bg-dark" style="font-family:Arial;background-color:#A98307;">
                      <th style="width:10%;color:rgb(243, 234, 234);" class="">Nombre</th>
                      <th style="width:10%;color:rgb(243, 234, 234);" class="">Apellido</th>
					  <th style="width:10%;color:rgb(243, 234, 234);" class="">Usuario</th>
					  <th style="width:17%;color:rgb(243, 234, 234);" class="">Direccion</th>				  
					</tr>
				  </thead>
				  <tbody>
                    <?php 	 
                     $venta = isset($_GET['venta_id'])?$_GET['venta_id']:'';
						foreach($compra->getCliente($venta) as $client){
							?>
				  
							<tr>
                              <td><?= utf8_decode(utf8_encode($client['nombre']));?></td>
							  <td style="width:40%;word-wrap: break-word;"><?= utf8_decode(utf8_encode($client['apellido']));?></td>
                              <td class=""><?= utf8_decode(utf8_encode($client['usuario']));?></td>
                              <td class=""><?= utf8_decode(utf8_encode($client['direccion']));?></td>
						    </tr>
						<?php }?>                
				  </tbody>
				</table>
</div>
