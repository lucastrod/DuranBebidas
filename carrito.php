<?php

include_once('inc/headerBlack.php');

?>
<br>
<br>
<br>
<br>
<br>
<?php

$productos = new Producto($con);

if(isset($_POST['id'])){
$resp = $productos->chequearProducto($_POST['id']);
        

              if($resp != 1){
    
                  echo "<script languaje='JavaScript'>
                  window.location.href='productos.php?estado=error&error=productoNoDisponible&cat=';
                      </script>";
                
              }

$prod = $productos->getProducto($_POST['id']);
}

if(isset($_SESSION['carrito'])){
    if(isset($_POST['id'])){
    $arrayProductos =  $_SESSION['carrito'];
    $encontro = false;
    $numero = 0;
    for($i=0;$i<count($arrayProductos);$i++){
        if($arrayProductos[$i]['Id'] == $_POST['id']){
            $encontro = true;
            $numero = $i;
        }    
    }
   
    if($encontro){
        $arrayProductos[$numero]['Cantidad']+=$_POST['cantidad'];
        $_SESSION['carrito'] = $arrayProductos;
    }
    else{

        $nombre ='';
        $precio ='';
        $imagen ='';
        $stock = 0;

        $nombre = $prod->nombre;
        $precio=!(empty($prod->precio_oferta))?$prod->precio_oferta:$prod->precio;
        $imagen = $prod->producto_id;
        $cantidad = $_POST['cantidad'];
        $stock = $prod->stock;
        $arrayNuevo = array(
                            'Id'=> $_POST['id'],
                            'Nombre'=> $nombre,
                            'Precio'=> $precio,
                            'Imagen'=> $imagen,
                            'Stock' => $stock,
                            'Cantidad'=> $cantidad
        );
        
        array_push($arrayProductos,$arrayNuevo);
        $_SESSION['carrito']= $arrayProductos;
    }
    }

}
else{
    if(isset($_POST['id'])){
        $nombre ='';
        $precio ='';
        $imagen ='';
        $cantidad = 0;
        $stock = 0;

        $nombre = $prod->nombre;
        $precio=!(empty($prod->precio_oferta))?$prod->precio_oferta:$prod->precio;
        $imagen = $prod->producto_id;
        $cantidad = $_POST['cantidad'];
        $stock = $prod->stock;
        $arrayProductos[] = array(
                            'Id'=> $_POST['id'],
                            'Nombre'=> $nombre,
                            'Precio'=> $precio,
                            'Imagen'=> $imagen,
                            'Stock' => $stock,
                            'Cantidad'=> $cantidad
        );
        $_SESSION['carrito']= $arrayProductos;

    }
}

?>

<div class="site-wrap">

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <form action="checkout.php"  class="col-md-12" method="post" enctype="multipart/form-data">
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Producto</th>
                    <th class="product-name">Nombre</th>
                    <th class="product-price">Precio</th>
                    <th class="product-quantity">Cantidad</th>
                    <th class="product-total">Total</th>
                    <th class="product-remove">Borrar</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    $total = 0;
                    $descuento=0;
                    $subtotal=0;
                    if(isset($_SESSION['carrito'])){

                        $arregloCarrito = $_SESSION['carrito'];
                       
                        foreach($arregloCarrito as $row){
                          $subtotal += ($row['Cantidad'] * $row['Precio']);
                ?>
                  <tr style="position: relative;">
                    <td class="product-thumbnail" >
                      <img  src="file_sitio/<?php echo $row['Imagen'];?>/0.png" alt="Image" class="img-fluid" width="30" height="60" >
                    </td>
                    <td class="product-name" style="vertical-align:middle;">
                      <h2 class="h5 text-black" ><?php echo $row['Nombre'];?></h2>
                    </td>
                    <td style="vertical-align:middle;">$<?php echo $row['Precio'];?></td>
                    <td style="vertical-align:middle;">
                      <div style="display:inline-block" > 
                        <div class="input-group" style="margin:0;width : 130px;">                           
                            <select name="cant" style="height:40px;width: 65px; padding:10px;" data-id="<?php echo $row['Id']?>" data-precio="<?php echo $row['Precio']?>" onchange="sumar(this.value);">
                            <?php
                            $totalStock = $row['Stock'];
                            for ($i=1; $i <= $totalStock; $i++) { ?>
                           <?php if ($i == $row['Cantidad'] ){
                            echo "<option value='" . $row['Cantidad'] . "' selected='selected'>" . $row['Cantidad'] . "</option>";
                            }
                            else {
                            echo "<option value='" .$i. "'>" .$i. "</option>";
                            }?>
                            <?php }?>
                            </select>
                        </div>
                      </div>
                    </td>
                    <td style="vertical-align:middle;" class="cant<?php echo $row['Id'];?>">$<?php echo $row['Precio'] * $row['Cantidad'];?></td>
                  
                    <td style="vertical-align:middle;"><a href="#" class="btn btn-danger btn-sm btnEliminar" data-id="<?php echo $row['Id']?>">X</a></td>
                  </tr>
                  <?php }} ?>

                </tbody>
              </table>
            </div>
          
        </div>
        
       
        <!-- <div class="row">
          <div class="col-md-6 pl-5">
            <div class="row justify-content-end">
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Resumen de Compra</h3>
                  </div>
                </div>
                <div class="row mb-3">
                  <div class="col-md-6">            
                    <span class="text">Subtotal</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text">$<span id="subtotal"></span></strong>
                  </div>
                </div>
                <div class="row mb-3" style="font-size: 15px;">
                  <div class="col-md-6">
                    <span class="text">Descuento</span>
                  </div>
                  <div class="col-md-6 text-right" >
                    <strong class="text">$<?php echo $descuento;?></strong>
                  </div>
                </div> 
                <div class="row mb-5" style="font-size: 20px;">
                  <div class="col-md-6">
                    <span class="text-black">Total</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black">$ <span id="total"></span></strong>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-lg py-3 btn-block">Ir a Comprar</button>
                  </div>
                  
                </div>
              </div>
            </div>-->
          
                <div class="row" style="padding-bottom:25px;">
                <?php if (!empty($_GET['login'])){?>
                <div><span id="login" data-id="<?php echo $_GET['login'];?>"></span></div>
                <?php }?>
                  <div class="col-md-8"></div>
                  <div class="col-md-4">
                    <h2 class="h3 text-black">Envio</h2>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding-left:0px;">
                      <label><input type="radio" name="envio" value="0" id="radio2" checked> Retiro en Tienda</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding-left:0px;">
                      <label><input type="radio" name="envio" value="1" required id="radio1" > Envio a Domicilio</label>   
                    </div>
                    <table class="table site-block-order-table mb-5">
                    <tbody>
                    <tr>
                        <td class="text-black font-weight-bold" style="max-width:5px;"><strong>Envio</strong></td>
                        <td class="text-black font-weight-bold"style="max-width:5px;">$<span id="envio"></span></td>
                    </tr>
                    </tbody>
                    </table>
                  </div>
                </div>
                <div class="row" style="padding-bottom:25px;">
                  <div class="col-md-8"></div>
                  <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-lg py-3 btn-block">Finalizar Compra</button>               
                  </div>
                  <div class="col-md-1"></div>
                  
                </div>
          </div> 
          </form>
        </div>      
      </div>
    </div>

  </div>

  <?php include_once('inc/footer.php'); ?>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/carrito.js"></script>
  <script src="js/actualizarEnvio.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="js/validarLogin.js"></script>


