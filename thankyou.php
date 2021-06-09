<?php
include_once('inc/headerBlack.php');

if(!empty($_SESSION["usuario"] ["id_usuario"])){

  if(!empty($_SESSION['carrito'])){
  $array = $_SESSION['carrito'];
  $subtotal = 0;
  $total = 0;
  $cantidad = 0;
  $precio = 0;
  $datos = array();
  $productos = array();
  foreach ($array as $colum) {
    $cantidad = $colum['Cantidad'];
    $precio = $colum['Precio'];
    $subtotal+= $cantidad * $precio;
  }
  $total = $subtotal + $_SESSION["usuario"] ["envio"];

  $datos['total'] = $total;
  $datos['id_cliente'] = $_SESSION["usuario"] ["id_usuario"];
  $datos['fecha'] = date("Y-m-d H:i:s");
  $datos['estado'] = 0;
  $datos['envio'] = $_SESSION["usuario"] ["envio"] == 0? 0 : 1;

  $compra = new Compra($con);
  $id_Venta = $compra->guardarVenta($datos);
  
  foreach ($array as $colum) {
    $productos['id_venta'] = $id_Venta;
    $productos['id_producto'] = $colum['Id'];
    $productos['cantidad'] = $colum['Cantidad'];

    $compra->guardarDetalle($productos);

  }
  unset($_SESSION['carrito']);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
   <title>Tienda</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/style.css">
    
  </head>
  <body>

  <?php infoVenta(11);//Enviar Mail aca  Nombre-Apellido-Direccion-Telefono-Envio \\  -
   
 ?>


  <div class="site-wrap">
   

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <span class="icon-check_circle display-3 text-success"></span>
 
            <h2 class="display-3 text-black">Gracias!</h2>
            <p class="lead mb-5">Su pedido se completó correctamente..</p>
            <a href="productos.php"><button class="button login">Volver a la tienda</button></a>
            <br>
            <br>
          </div>
        </div>
      </div>
    </div>

  

  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/main.js"></script>
    
  </body>
</html>
<?php include_once('inc/footer.php'); ?>
