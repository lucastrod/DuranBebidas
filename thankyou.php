<?php
include_once('inc/headerBlack.php');

if(!empty($_SESSION["usuario"] ["id_usuario"])){
  echo($_SESSION["usuario"] ["id_usuario"]);
  if(!empty($_SESSION['carrito'])){
  $array = $_SESSION['carrito'];
  $total = 0;
  $cantidad = 0;
  $precio = 0;
  foreach ($array as $colum) {
    $cantidad = $colum['Cantidad'];
    $precio = $colum['Precio'];
    $total+= $cantidad * $precio;
  }
  echo($total);


  
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
  <?php //sendMail(); ?>


  <div class="site-wrap">
   

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <span class="icon-check_circle display-3 text-success"></span>
            <h2 class="display-3 text-black">Gracias!</h2>
            <p class="lead mb-5">Su pedido se completó correctamente..</p>
            <p><a href="productos.php" class="btn btn-sm btn-primary">Volver a la tienda</a></p>
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