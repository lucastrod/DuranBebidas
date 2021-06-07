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
      $resp = $user->consultarExiste($_POST);
      if($resp === 1){
        header('Location:login.php?estado=error&error=sinValidar');
      }
      else{
        header('Location:login.php?estado=error&error=datosErroneos');
      }
    }
  }
}
 
?>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css"> 
  </head>

  <!-- Header -->
  <header>
    <div class="header-container">
      <div class="header-top">
        <div class="container">
          <div class="row"> 
            <!-- Header Language -->
            <div class="col-xs-7 col-sm-6">
              <div class="block-language-wrapper hidden-xs"> <a role="button" data-target="#" class="block-currency " href="contact_us.php"><i class="fa fa-map-marker"></i>  Paraguay 5261, Palermo </a>
              </div>
              <!-- End Header Language --> 
              
              <!-- Header Currency -->
              
              <div class=" block-currency-wrapper hidden-xs"> <a role="button" target="_blank" class="block-currency >" href="https://wa.me/541168463206"> <i class="fa fa-whatsapp" ></i> +54 11 6846-3206  </a>
                
              </div>
              <!-- End Header Currency -->
              
              <div class="welcome-msg hidden-xs"> </div>
            </div>
            <div class="col-xs-5 col-sm-6"> 
              
            <div class="top-cart-contain pull-right"> 
            <!-- Top Cart -->
            <div class="mini-cart">
              <div class="basket dropdown-toggle">
                <a href="carrito.php"><i class="fa fa-shopping-cart"style="font-size:12.5px" ></i> 
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
          

              <!-- Header Top Links -->
              <div class="toplinks">
                <div class="links">
          
                <?php
                  if(empty($_SESSION["usuario"])){
                  ?>
                    <div class="login"><a href="login.php"><span class="hidden-xs">Log In</span></a></div>
                  <?php
                  }
                  else{
                  
                  if(!empty($_SESSION['usuario']['usuario']==='admin')){?>
     
                          <div class="welcome-msg hidden-xs"> Bienvenido!<?= $_SESSION["usuario"]["nombre"]; ?></div>
                          <div class="login"><a href="ListProd.php"><span class="hidden-xs">Admin Panel</span></a></div>
                          <div class="login"><a href="logout.php"><i class="fa fa-sign-out" style="display:flex;font-size:16.5px;justify-content:center; "></i></a></div>   
                                         
                  <?php
                  }
                  else{
                  ?>
                          <div class="welcome-msg hidden-xs">Bienvenido! <?= $_SESSION["usuario"]["nombre"]; ?></div>
                          <div class="login"><a href="logout.php"><i class="fa fa-sign-out" style="display:flex;font-size:16.5px;justify-content:center; "></i></a></div>   
            <?php }
                 } ?>          
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
    <div class="logo">
        <a title="DuranBebidas" href="index.php"><img alt="Duran" src="images/logo1.png"></a>
    </div> 
    <!-- End Logo -->
  
    <!-- Navbar -->
  <nav>
    <div class="container">

        <!-- Sections --> 
      <ul class="nav hidden-xs menu-item" style="z-index: 5;background-color:rgba(0, 0, 0, 0.45);border-color:rgba(0, 0, 0, 0.75);">
            <li class="level0 parent drop-menu" ><a href="productos.php?cat=9"><span>Vinos</span></a>
              <ul class="level1" style="display: none;">
                  <li class="level1 first"><a href="productos.php?cat=34"><span>Cabernet</span></a></li>
                  <li class="level1 nav-10-2"> <a href="productos.php?cat=36"> <span>Malbec</span> </a> </li>
                  <li class="level1 nav-10-3"> <a href="productos.php?cat=38"> <span>Rosado</span> </a> </li>
                  <li class="level1 nav-10-4"> <a href="productos.php?cat=42"> <span>Blanco</span> </a> </li>
                  <li class="level1 nav-10-4"> <a href="productos.php?cat=43"> <span>Tinto</span> </a> </li>
                </ul>  
            </li>
            <li class="level0 parent drop-menu"><a href="productos.php?cat=8"><span>Espumantes</span> </a>
              <ul class="level1" style="display: none;">
                <li class="level1 first"><a href="productos.php?cat=30"><span>Extra Brute</span></a></li>
                <li class="level1 nav-10-2"> <a href="productos.php?cat=31"> <span>Demi Sec</span> </a> </li>
                <li class="level1 nav-10-3"> <a href="productos.php?cat=32"> <span>Brut Natur</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="productos.php?cat=45"> <span>Sidra</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="productos.php?cat=46"> <span>Frizze</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="productos.php?cat=47"> <span>Pinot Noir</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="productos.php?cat=56"> <span>Malbec</span> </a> </li>               
              </ul></li>
            <li class="level0 parent drop-menu"><a href="productos.php?cat=7" class="level-top"><span>Whiskies</span></a>
              <ul class="level1" style="display: none;">
                <li class="level1 first"> <a href="productos.php?cat=27"> <span>Scotch</span> </a> </li>
                <li class="level1 nav-10-2"> <a href="productos.php?cat=28"> <span>Bourbon</span></a> </li>
                <li class="level1 nav-10-3"> <a href="productos.php?cat=29"> <span>Single Malt</span> </a> </li>               
              </ul></li>
            <li class="level0 parent drop-menu"><a href="productos.php?cat=2" class="level-top"><span>Cervezas</span></a>
              <ul class="level1" style="display: none;">
                  <li class="level1 first"> <a href="productos.php?cat=13"> <span>Artesanal</span> </a> </li>
                  <li class="level1 nav-10-3"> <a href="productos.php?cat=48"> <span>Lager</span> </a> </li>
                  <li class="level1 nav-10-3"> <a href="productos.php?cat=49"> <span>Roja</span> </a> </li>
                  <li class="level1 nav-10-3"> <a href="productos.php?cat=50"> <span>IPA</span> </a> </li>
                  <li class="level1 nav-10-3"> <a href="productos.php?cat=51"> <span>Miel</span> </a> </li>
                  <li class="level1 nav-10-2"> <a href="productos.php?cat=52"> <span>Rubia</span> </a> </li>
                  <li class="level1 nav-10-3"> <a href="productos.php?cat=53"> <span>APA</span> </a> </li>
                  <li class="level1 nav-10-3"> <a href="productos.php?cat=54"> <span>Negra</span> </a> </li>
                </ul></li>
            <li class="level0 parent drop-menu"><a href="productos.php?cat=6" class="level-top"><span>Licores</span></a>
              <ul class="level1" style="display: none;">
                    <li class="level1 first"> <a href="productos.php?cat=25"> <span>Baileys</span></a></li>
              </ul></li>
            <li class="level0 parent drop-menu"><a href="productos.php?cat=3" class="level-top"><span>Aperitivos</span></a>
              <ul class="level1" style="display: none;">
                <li class="level1 first"> <a href="productos.php?cat=14"> <span>Fernet</span> </a> </li>
                <li class="level1 nav-10-2"> <a href="productos.php?cat=15"> <span>Bitter</span> </a> </li>
                <li class="level1 nav-10-3"> <a href="productos.php?cat=16"> <span>Vermouth</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="productos.php?cat=17"> <span>Cynar</span> </a> </li>  
                <li class="level1 nav-10-4"> <a href="productos.php?cat=18"> <span>Aperol</span> </a> </li>  
                <li class="level1 nav-10-4"> <a href="productos.php?cat=33"> <span>Dr Lemon</span> </a> </li>  
              </ul></li>
            <li class="level0 parent drop-menu"><a href="productos.php?cat=4" class="level-top"><span>Gin</span></a>              
              <ul class="level1" style="display: none;">
                <li class="level1 first"> <a href="productos.php?cat=19"> <span>Gin Gordons</span> </a> </li>
                <li class="level1 nav-10-2"> <a href="productos.php?cat=20"> <span>Gin Bombay</span> </a> </li>
                <li class="level1 nav-10-3"> <a href="productos.php?cat=21"> <span>Gin Beefeter</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="productos.php?cat=22"> <span>Gin Tanqueray</span> </a> </li>  
              </ul></li>
            <li class="level0 parent drop-menu"><a href="productos.php?cat=5" class="level-top"><span>Destilados</span></a>
              <ul class="level1" style="display: none;">
                <li class="level1 first"> <a href="productos.php?cat=23"> <span>Vodka</span> </a> </li>
                <li class="level1 nav-10-2"> <a href="productos.php?cat=24"> <span>Ron</span> </a> </li>
                <li class="level1 nav-10-3"> <a href="productos.php?cat=26"> <span>Tequila</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="productos.php?cat=55"> <span>Cachaca</span> </a> </li>  
              </ul></li>
            
            <li class="level0 parent drop-menu"><a href="productos.php?cat=1" class="level-top"><span>Sin Alcohol</span></a>
              <ul class="level1" style="display: none;">
                <li class="level1 first"> <a href="productos.php?cat=12"> <span>Malta</span> </a> </li>
                <li class="level1 nav-10-2"> <a href="productos.php?cat=35"> <span>Jugos</span> </a> </li>
                <li class="level1 nav-10-3"> <a href="productos.php?cat=39"> <span>Aguas y Gaseosas</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="productos.php?cat=41"> <span>Energizantes</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="productos.php?cat=44"> <span>Granadina</span> </a> </li>  
              </ul></li>
            
            <li class="level0 parent drop-menu"><a href="productos.php?cat=10" class="level-top"><span>Regaleria</span></a>
              <ul class="level1" style="display: none;">
                <li class="level1 first"> <a href="productos.php?cat=37"> <span>Estucheria</span> </a> </li>
              </ul></li>
            
            <li class="level0 parent drop-menu"><a href="productos.php?cat=11" class="level-top"><span>Placeres</span></a>
              <ul class="level1" style="display: none;">
                <li class="level1 first"> <a href="productos.php?cat=40"> <span>Alimentos</span> </a> </li>
              </ul></li>
            <li class="level0 parent drop-menu"><a href="productos.php?ofertas=1" class="level-top"><span>Ofertas</span></a>
            </li>
      </ul>
          <!-- End Sections -->          
    </div>
  </nav>
  <!-- end nav --> 

</php>
<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
<script type="text/javascript" src="js/iconoCarrito.js"></script>