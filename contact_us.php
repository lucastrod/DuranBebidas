<?php include_once('inc/headerblack.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<!--[if IE]>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">

<!-- Favicons Icon -->

<title>Superb premium HTML5 &amp; CSS3 template</title>

<!-- Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS Style -->
<link rel="stylesheet" type="text/css" href="css/internal.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.css" media="all">
<link rel="stylesheet" type="text/css" href="css/simple-line-icons.css" media="all">
<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
<link rel="stylesheet" type="text/css" href="css/revslider.css" >
<link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="css/owl.theme.css">
<link rel="stylesheet" type="text/css" href="css/flexslider.css">
<link rel="stylesheet" type="text/css" href="css/jquery.mobile-menu.css">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css"> 

<!-- Google Fonts -->
<link href='https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,600,600italic,400italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
</head>

<body class="contacts-index-index rtl inner-page">
<div id="page"> 



<!DOCTYPE html>
<html>
  <head>
    <title>Add Map</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }

      /* Optional: Makes the sample page fill the window. */
    

    </style>

    <script>
      let map;

      function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
          center: { lat: -34.397, lng: 150.644 },
          zoom: 8,
        });
      }
    </script>
  </head>
  <body>
<!--     <h3>My Google Maps Demo</h3>
    The div element for the map -->
<!--     <div id="map"></div>
 -->
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
 <!--    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCokftS9CBTuKGKePMOebIaWTo3Yj-z38Q&callback=initMap&libraries=&v=weekly"
      async
    ></script> -->

    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDOzN0dUthH6Cb8QY_anSYgGWRJg82lKeY&callback=initMap"
      async
    ></script> -->


  <!-- Main Container --> 
  <div class="row">

</div>
<br>
  <section class="main-container col2-right-layout">
  
    <div class="main container">

        <section class="col-main col-sm-9">
          <div class="page-title">
          <div class="row">
            <h1>Contactanos!</h1>
          </div>
          <div class="static-contain">
            <fieldset class="group-select">
              <ul>
                <li id="billing-new-address-form">
                  <fieldset>
                    <input type="hidden"  id="billing:address_id">
                    <ul>
                      <li>
                        <div class="customer-name">
                          <div class="input-box name-firstname">
                            <label for="billing:firstname"> Nombre<span class="required">*</span></label>
                            <br>
                            <input type="text" id="billing:firstname" name="" title="First Name" class="input-text ">
                          </div>
                          <div class="input-box name-lastname">
                            <label for="billing:lastname"> Email <span class="required">*</span> </label>
                            <br>
                            <input type="text" id="billing:lastname" name="" title="Last Name" class="input-text">
                          </div>
                        </div>
                      </li>         
                      <li class="">
                        <label for="comment">Comentario<em class="required">*</em></label>
                        <br>
                        <div style="float:none" class="">
                          <textarea name="" id="comment" title="Comment" class="input-text" cols="5" rows="3"></textarea>
                        </div>
                      </li>
                    </ul>
                  </fieldset>
                </li>
                <span class="require"><em class="required">* </em>Campos requeridos</span>
                <div class="buttons-set">
                  <button type="submit" title="Submit" class="button submit"> <span> Enviar </span> </button>
                </div>
              </ul>
            </fieldset>
          </div>
        </section>
        <aside class="col-right sidebar col-sm-3">

          <div class="block block-company">
            <div class="block-title">Datos de contacto</div>
            <div class="block-content">
              <ol id="recently-viewed-items">
                <li><span><i class="fa fa-whatsapp"></i>     WhatsApp</span>+5411999999999</li>
                <li><span><i class="fa fa fa-phone"></i> Teléfono</span>+54119999999</li> 
                <li><span><i class="fa fa-envelope"></i> Correo</span>correo@correo.com</li> 
                <li><span><i class="fa fa-map-marker"></i> Ubicación</span>Calle Falsa 123, CABA</li> 
                <li><span><i class="fa fa-clock-o"></i> Horarios</span>Lunes a Viernes 10:00hs a 18:00hs</li>
              </ol>
            </div>
          </div>
          
        </aside>
      </div>
    </div>
  </section>
  <!-- Main Container End --> 
  
  <!-- Brand logo starts  -->
  <div class="brand-logo wow bounceInUp animated">
    <div class="container">
      <div class="slider-items-products">
        <div id="brand-logo-slider" class="product-flexslider hidden-buttons">
          <div class="slider-items slider-width-col6"> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo3.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo2.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo1.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo4.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo5.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo6.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo1.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo4.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Brand logo ends  --> 
  
  <?php include_once('inc/footer.php');?>

  </body>
</html>