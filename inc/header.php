<!DOCTYPE php>
<?php
session_start();
include('config.php');
require('inc/db_data.php');
include('inc/arrays.php');
include('class/productos.php');
include('class/objeto.php');

$user = new Usuario($con);

if(isset($_POST['login'])){
  $valor = $user->login($_POST);
  if($valor !=Null){
    if($valor == 'Error'){
      header('Location:login.php?estado=error&error=datosErroneos');
    }
  }
}
 
?>
<php lang="zxx" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Duran Bebidas</title>
    
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicons Icon -->

    <title>Duran Bebidas</title>

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS Style -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css" media="all">
    <link rel="stylesheet" type="text/css" href="css/simple-line-icons.css" media="all">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="css/owl.theme.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.bxslider.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.mobile-menu.css">
    <link rel="stylesheet" type="text/css" href="css/revslider.css" >
    <link rel="stylesheet" type="text/css" href="css/style.css" media="all">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,600,600italic,400italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
</head>

<body class="cms-index-index index">
<div id="page">       
  <!-- Header -->
  <header>
    <div class="header-container">
      <div class="header-top">
        <div class="container">
          <div class="row"> 
            <!-- Header Language -->
            <div class="col-xs-7 col-sm-6">
              <div class="block-language-wrapper hidden-xs"> <a role="button" data-target="#" class="block-language " href="#">UBICACION  </a>
              </div>
              <!-- End Header Language --> 
              
              <!-- Header Currency -->
              <div class=" block-currency-wrapper hidden-xs"> <a role="button" data-target="#" class="block-currency" href="#"> TELEFONO </a>
                
              </div>
              <!-- End Header Currency -->
              
              <div class="welcome-msg hidden-xs"> Bienvenido! "Usuario" </div>
            </div>
            <div class="col-xs-5 col-sm-6"> 
              
              <div class="top-cart-contain pull-right"> 
            <!-- Top Cart -->
            <div class="mini-cart">
              <div class="basket dropdown-toggle">
                <a href="carrito.php">  Carrito 
                  <span class="count" id="value">0</span>
                  <span id="value"></span>
                </a>
              </div>
              <div>
                
              </div>
            </div>
            <!-- Top Cart -->
            <div id="ajaxconfig_info" style="display:none"><a href="#/"></a>
              <input value="" type="hidden">
              <input id="enable_module" value="1" type="hidden">
              <input class="effect_to_cart" value="1" type="hidden">
              <input class="title_shopping_cart" value="Go to shopping cart" type="hidden">
            </div>
          </div>
          
          <div class="top-search">
            <div class="block-icon pull-right"> <a data-target=".bs-example-modal-lg" data-toggle="modal" class="search-focus dropdown-toggle links"> <i class="fa fa-search"></i> </a>
              <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button aria-label="Close" data-dismiss="modal" class="close" type="button"><img src="images/interstitial-close.png" alt="close"> </button>
                    </div>
                    <div class="modal-body">
                      <form class="navbar-form">
                        <div id="search">
                          <div class="input-group">
                            <input name="search" placeholder="Search" class="form-control" type="text">
                            <button type="button" class="btn-search"><i class="fa fa-search"></i></button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
              <!-- Header Top Links -->
              <div class="toplinks">
                <div class="links">
                
                  <div class="check"><a title="Checkout" href="checkout.php"><span class="hidden-xs">Checkout</span></a></div>
                  <!-- Header Company -->
                  
                  <!-- End Header Company -->
                  <?php
                  if(empty($_SESSION["usuario"])):
                  ?>
                    <div class="login"><a href="login.php"><span class="hidden-xs">Log In</span></a></div>
                  <?php
                  else:
                  
                  if(!empty($_SESSION['usuario']['secciones'])){?>

                    <ul class="navbar-nav mr-5 pr-6">
                          <span class="nav-link"><?= $_SESSION["usuario"]["nombre"]; ?></span>                                                
                          <div class="login"><a href="panel.php"><span class="hidden-xs">Admin Panel</span></a></div>
                          <div class="login"><a href="logout.php"><span class="hidden-xs">Logout</span></a></div>                    
                        </ul>                    
                  <?php
                  }
                  endif;
                  ?>               
                </div>
              </div>

              <!-- End Header Top Links --> 
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
  <!-- end header --> 

    <!-- Logo -->
    <div class="logo"><a title="DuranBebidas" href="index.php"><img alt="Duran" src="images/logonegro.png"></a></div>
    <!-- End Logo -->
  
    <!-- Navbar -->
  <nav>
    <div class="container">
        <!-- Sections --> 
        <div class="mm-toggle-wrap">
          <div class="mm-toggle"><i class="fa fa-reorder"></i><span class="mm-label">Menu</span> </div>
        </div>

<!--<ul class="nav hidden-xs menu-item menu-item-left">
            <li class="level0 parent drop-menu" ><a href="#"><span style="color:#C2A476;">Vinos</span></a>
              <ul class="level1" style="display: none;">
                  <li class="level1 first"><a href="#"><span>Tinto</span></a></li>
                  <li class="level1 nav-10-2"> <a href="#"> <span>Rosado</span> </a> </li>
                  <li class="level1 nav-10-3"> <a href="#"> <span>Malbec</span> </a> </li>
                  <li class="level1 nav-10-4"> <a href="#"> <span>Cabernet</span> </a> </li>
                  <li class="level1 nav-10-4"> <a href="#"> <span>Blanco</span> </a> </li>
                </ul>  
            </li>
            <li class="level0 parent drop-menu"><a href="#"><span>Espumantes</span> </a>
              <ul class="level1" style="display: none;">
                <li class="level1 first"><a href="#"><span>Brut Nature</span></a></li>
                <li class="level1 nav-10-2"> <a href="#"> <span>Demi Sec</span> </a> </li>
                <li class="level1 nav-10-3"> <a href="#"> <span>Extra Brut</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="#"> <span>Frizze</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="#"> <span>Malbec</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="#"> <span>Pinot Noir</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="#"> <span>Sidra</span> </a> </li>               
              </ul></li>
            <li class="level0 parent drop-menu"><a href="#" class="level-top"><span>Whiskies</span></a>
              <ul class="level1" style="display: none;">
                <li class="level1 first"> <a href="#"> <span>Bourbon</span> </a> </li>
                <li class="level1 nav-10-2"> <a href="#"> <span>Scotch</span> </a> </li>
                <li class="level1 nav-10-3"> <a href="#"> <span>Single Malt</span> </a> </li>               
              </ul></li>
            <li class="level0 parent drop-menu"><a href="#" class="level-top"><span>Cervezas</span></a>
              <ul class="level1" style="display: none;">
                  <li class="level1 first"> <a href="#"> <span>APA</span> </a> </li>
                  <li class="level1 nav-10-2"> <a href="#"> <span>Artesanal</span> </a> </li>
                  <li class="level1 nav-10-3"> <a href="#"> <span>IPA</span> </a> </li>
                  <li class="level1 nav-10-3"> <a href="#"> <span>Lager</span> </a> </li>
                  <li class="level1 nav-10-3"> <a href="#"> <span>Miel</span> </a> </li>
                  <li class="level1 nav-10-3"> <a href="#"> <span>Negra</span> </a> </li>
                  <li class="level1 nav-10-3"> <a href="#"> <span>Roja</span> </a> </li>
                  <li class="level1 nav-10-3"> <a href="#"> <span>Rubia</span> </a> </li>
                </ul></li>
            <li class="level0 parent drop-menu"><a href="#" class="level-top"><span>Licores</span></a>
              <ul class="level1" style="display: none;">
                    <li class="level1 first"> <a href="#"> <span>Baileys</span></a></li>
              </ul></li>
            <li class="level0 parent drop-menu"><a href="#" class="level-top"><span>Aperitivos</span></a>
              <ul class="level1" style="display: none;">
                <li class="level1 first"> <a href="#"> <span>Aperol</span> </a> </li>
                <li class="level1 nav-10-2"> <a href="#"> <span>Bitter</span> </a> </li>
                <li class="level1 nav-10-3"> <a href="#"> <span>Cynar</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="#"> <span>Dr Lemon</span> </a> </li>  
                <li class="level1 nav-10-4"> <a href="#"> <span>Fernet</span> </a> </li>  
                <li class="level1 nav-10-4"> <a href="#"> <span>Vermouth</span> </a> </li>  
              </ul></li>
            </ul>
            <ul class="nav hidden-xs menu-item menu-item-right">         
            <li class="level0 parent drop-menu"><a href="#" class="level-top"><span>Gin</span></a>              
              <ul class="level1" style="display: none;">
                <li class="level1 first"> <a href="#"> <span>Gin Gordons</span> </a> </li>
                <li class="level1 nav-10-2"> <a href="#"> <span>Gin Bombay</span> </a> </li>
                <li class="level1 nav-10-3"> <a href="#"> <span>Gin Beefeter</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="#"> <span>Gin Tanqueray</span> </a> </li>  
              </ul></li>
            <li class="level0 parent drop-menu"><a href="#" class="level-top"><span>Destilados Varios</span></a>
              <ul class="level1" style="display: none;">
                <li class="level1 first"> <a href="#"> <span>Vodka</span> </a> </li>
                <li class="level1 nav-10-2"> <a href="#"> <span>Ron</span> </a> </li>
                <li class="level1 nav-10-3"> <a href="#"> <span>Tequila</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="#"> <span>Cachaca</span> </a> </li>  
              </ul></li>
            
            <li class="level0 parent drop-menu"><a href="#" class="level-top"><span>Sin Alcohol</span></a>
              <ul class="level1" style="display: none;">
                <li class="level1 first"> <a href="#"> <span>Malta</span> </a> </li>
                <li class="level1 nav-10-2"> <a href="#"> <span>Jugos</span> </a> </li>
                <li class="level1 nav-10-3"> <a href="#"> <span>Aguas y Gaseosas</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="#"> <span>Energizantes</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="#"> <span>Granadina</span> </a> </li>  
              </ul></li>
            
            <li class="level0 parent drop-menu"><a href="#" class="level-top"><span>Regaleria</span></a>
              <ul class="level1" style="display: none;">
                <li class="level1 first"> <a href="#"> <span>Estucheria</span> </a> </li>
              </ul></li>
            
            <li class="level0 parent drop-menu"><a href="#" class="level-top"><span>Placeres</span></a>
              <ul class="level1" style="display: none;">
                <li class="level1 first"> <a href="#"> <span>Alimentos</span> </a> </li>
              </ul></li>
          </ul>-->
          <!-- End Sections -->          
    </div>
  </nav>
  <!-- end nav --> 
</body>
</php>


<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script type="text/javascript" src="js/iconoCarrito.js"></script>
