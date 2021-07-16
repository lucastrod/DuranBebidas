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

  <?php

include_once('inc/headerBlack.php');

if(!empty($_GET["km"])){
  $km=$_GET["km"];
}

?>

<span id="km" data-id="<?=$km?>"></span>

<script type="text/javascript">

$(document).ready(function() {

        var km = $('#km').data('id');

        if(km !=''){
        calcular(km);
        }
          function calcular(km) {
              
                          $.ajax({
                            type:"POST",
                              url:"pasarEnvio.php",
                              data:{
                              km:km,
                              },
                              success:function(resp){
                                $.ajax({
            				              type: "POST",
            				              url: "./refrescarEnvio.php",
            				              data:{
            				              activo:1
            				              },
                                  success:function(resp){
                                    setTimeout("location.href='checkout.php?modif=ok'",0);
                                  }
            				            });
							                }
                          });
             
          }
                          
});
</script>


  <div class="site-wrap">
   

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <span class="icon-check_circle display-3 text-success"></span>
            <h1 class="display-3 text-black">Dirección Guardada!</h1>
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

