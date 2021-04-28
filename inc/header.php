<!DOCTYPE html>
<?php
session_start();
include('inc/config.php');
require('inc/db_data.php');
include('inc/arrays.php');
include('class/productos.php');
include('class/objeto.php');


$user = new Usuario($con);

if(isset($_POST['login'])){
  $valor = $user->login($_POST);
  if($valor !=Null){
    if($valor == 'Error en contraseña'){
      header('Location:log.php?estado=error&error=datosErroneos');
    }
    else{
      header('Location:log.php?estado=error&error=datosErroneos');
    }
  }
}
 
?>
<html lang="zxx" class="no-js">
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
              <div class="dropdown block-language-wrapper hidden-xs"> <a role="button" data-toggle="dropdown" data-target="#" class="block-language dropdown-toggle" href="#"> <img src="images/english.png" alt="language"> English <span class="caret"></span> </a>
                <ul class="dropdown-menu" role="menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><img src="images/english.png" alt="language"> English </a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><img src="images/francais.png" alt="language"> French </a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#"><img src="images/german.png" alt="language"> German </a></li>
                </ul>
              </div>
              <!-- End Header Language --> 
              
              <!-- Header Currency -->
              <div class="dropdown block-currency-wrapper hidden-xs"> <a role="button" data-toggle="dropdown" data-target="#" class="block-currency dropdown-toggle" href="#"> USD <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#"> $ - Dollar </a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#"> £ - Pound </a></li>
                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#"> € - Euro </a></li>
                </ul>
              </div>
              <!-- End Header Currency -->
              
              <div class="welcome-msg hidden-xs"> Bienvenido! "Usuario" </div>
            </div>
            <div class="col-xs-5 col-sm-6"> 
              
              <div class="top-cart-contain pull-right"> 
            <!-- Top Cart -->
            <div class="mini-cart">
              <div data-toggle="dropdown" data-hover="dropdown" class="basket dropdown-toggle"><a href="#">  Carrito <span class="cart_count">(2)</span></a></div>
              <div>
                <div class="top-cart-content" style="display: none;">
                  <div class="actions">
                    <button class="btn-checkout" title="Checkout" type="button"><span>Checkout</span></button>
                    <a href="#" class="view-cart" ><span>View Cart</span></a> </div>
                  <!--block-subtitle-->
                  <ul class="mini-products-list" id="cart-sidebar">
                    <li class="item first">
                      <div class="item-inner"><a class="product-image" title="timi &amp; leslie Sophia Diaper Bag, Lemon Yellow/Shadow White" href="#l"><img alt="timi &amp; leslie Sophia Diaper Bag, Lemon Yellow/Shadow White" src="products-images/product.jpg"></a>
                        <div class="product-details">
                          <div class="access"><a class="btn-remove1" title="Remove This Item" href="#">Remove</a> <a class="btn-edit" title="Edit item" href="#"><i class="icon-pencil"></i><span class="hidden">Edit item</span></a> </div>
                          <!--access--> <strong>1</strong> x <span class="price">$499.99</span>
                          <p class="product-name"><a href="#">Vinito Toro</a></p>
                        </div>
                      </div>
                    </li>
                    <li class="item last">
                      <div class="item-inner"><a class="product-image" title="JP Lizzy Satchel Designer Diaper Bag - Slate Citron" href="#"><img alt="JP Lizzy Satchel Designer Diaper Bag - Slate Citron" src="products-images/product.jpg"></a>
                        <div class="product-details">
                          <div class="access"><a class="btn-remove1" title="Remove This Item" href="#">Remove</a> <a class="btn-edit" title="Edit item" href="#"><i class="icon-pencil"></i><span class="hidden">Edit item</span></a> </div>
                          <!--access--> <strong>1</strong> x <span class="price">$80.00</span>
                          <p class="product-name"><a href="#">Manaos Pomelo</a></p>
                        </div>
                      </div>
                    </li>
                  </ul>
                  <!--actions--> 
                </div>
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
                
                  <div class="check"><a title="Checkout" href="checkout.html"><span class="hidden-xs">Checkout</span></a></div>
                  <!-- Header Company -->
                  
                  <!-- End Header Company -->
                  <?php
                  if(empty($_SESSION["usuario"])):
                  ?>
                    <div class="login"><a href="login.html"><span class="hidden-xs">Log In</span></a></div>
                  <?php
                  else:
                  
                  if(!empty($_SESSION['usuario']['secciones'])){?>

                    <ul class="navbar-nav mr-5 pr-6">
                          <span class="nav-link"><?= $_SESSION["usuario"]["nombre"]; ?></span>                                                
                          <div class="login"><a href="panel.html"><span class="hidden-xs">Admin Panel</span></a></div>
                          <div class="login"><a href="logout.html"><span class="hidden-xs">Logout</span></a></div>                    
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
    <div class="logo"><a title="DuranBebidas" href="index.php"><img alt="Duran" src="images/logo1.png"></a></div>
    <!-- End Logo -->
  
    <!-- Navbar -->
  <nav>
    <div class="container">
        <!-- Sections --> 
        <div class="mm-toggle-wrap">
          <div class="mm-toggle"><i class="fa fa-reorder"></i><span class="mm-label">Menu</span> </div>
        </div>

          <ul class="nav hidden-xs menu-item menu-item-left">
            <li class="level0 parent drop-menu active"><a href="index.html"><span>Vinos</span></a>
              <ul class="level1" style="display: none;">
                  <li class="level1 first"><a href="grid.html"><span>Tinto</span></a></li>
                  <li class="level1 nav-10-2"> <a href="list.html"> <span>Rosado</span> </a> </li>
                  <li class="level1 nav-10-3"> <a href="product_detail.html"> <span>Malbec</span> </a> </li>
                  <li class="level1 nav-10-4"> <a href="shopping_cart.html"> <span>Cabernet</span> </a> </li>
                  <li class="level1 nav-10-4"> <a href="wishlist.html"> <span>Blanco</span> </a> </li>
                </ul></li>
            <li class="level0 parent drop-menu"><a href="#"><span>Espumantes</span> </a>
              <ul class="level1" style="display: none;">
                <li class="level1 first"><a href="grid.html"><span>Brut Nature</span></a></li>
                <li class="level1 nav-10-2"> <a href="list.html"> <span>Demi Sec</span> </a> </li>
                <li class="level1 nav-10-3"> <a href="product_detail.html"> <span>Extra Brut</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="shopping_cart.html"> <span>Frizze</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="wishlist.html"> <span>Malbec</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="multiple_addresses.html"> <span>Pinot Noir</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="about_us.html"> <span>Sidra</span> </a> </li>               
              </ul></li>
            <li class="level0 parent drop-menu"><a href="grid.html" class="level-top"><span>Whiskies</span></a>
              <ul class="level1" style="display: none;">
                <li class="level1 first"> <a href="wishlist.html"> <span>Bourbon</span> </a> </li>
                <li class="level1 nav-10-2"> <a href="about_us.html"> <span>Scotch</span> </a> </li>
                <li class="level1 nav-10-3"> <a href="product_detail.html"> <span>Single Malt</span> </a> </li>               
              </ul></li>
            <li class="level0 parent drop-menu"><a href="grid.html" class="level-top"><span>Cervezas</span></a>
              <ul class="level1" style="display: none;">
                  <li class="level1 first"> <a href="wishlist.html"> <span>APA</span> </a> </li>
                  <li class="level1 nav-10-2"> <a href="about_us.html"> <span>Artesanal</span> </a> </li>
                  <li class="level1 nav-10-3"> <a href="product_detail.html"> <span>IPA</span> </a> </li>
                  <li class="level1 nav-10-3"> <a href="product_detail.html"> <span>Lager</span> </a> </li>
                  <li class="level1 nav-10-3"> <a href="product_detail.html"> <span>Miel</span> </a> </li>
                  <li class="level1 nav-10-3"> <a href="product_detail.html"> <span>Negra</span> </a> </li>
                  <li class="level1 nav-10-3"> <a href="product_detail.html"> <span>Roja</span> </a> </li>
                  <li class="level1 nav-10-3"> <a href="product_detail.html"> <span>Rubia</span> </a> </li>
                </ul></li>
            <li class="level0 parent drop-menu"><a href="grid.html" class="level-top"><span>Licores</span></a>
              <ul class="level1" style="display: none;">
                    <li class="level1 first"> <a href="wishlist.html"> <span>Baileys</span></a></li>
              </ul></li>
            <li class="level0 parent drop-menu"><a href="grid.html" class="level-top"><span>Aperitivos</span></a>
              <ul class="level1" style="display: none;">
                <li class="level1 first"> <a href="wishlist.html"> <span>Aperol</span> </a> </li>
                <li class="level1 nav-10-2"> <a href="about_us.html"> <span>Bitter</span> </a> </li>
                <li class="level1 nav-10-3"> <a href="product_detail.html"> <span>Cynar</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="product_detail.html"> <span>Dr Lemon</span> </a> </li>  
                <li class="level1 nav-10-4"> <a href="product_detail.html"> <span>Fernet</span> </a> </li>  
                <li class="level1 nav-10-4"> <a href="product_detail.html"> <span>Vermouth</span> </a> </li>  
              </ul></li>
            </ul>
            <ul class="nav hidden-xs menu-item menu-item-right">         
            <li class="level0 parent drop-menu"><a href="grid.html" class="level-top"><span>Gin</span></a>              
              <ul class="level1" style="display: none;">
                <li class="level1 first"> <a href="wishlist.html"> <span>Gin Gordons</span> </a> </li>
                <li class="level1 nav-10-2"> <a href="about_us.html"> <span>Gin Bombay</span> </a> </li>
                <li class="level1 nav-10-3"> <a href="product_detail.html"> <span>Gin Beefeter</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="product_detail.html"> <span>Gin Tanqueray</span> </a> </li>  
              </ul></li>
            <li class="level0 parent drop-menu"><a href="grid.html" class="level-top"><span>Destilados Varios</span></a>
              <ul class="level1" style="display: none;">
                <li class="level1 first"> <a href="wishlist.html"> <span>Vodka</span> </a> </li>
                <li class="level1 nav-10-2"> <a href="about_us.html"> <span>Ron</span> </a> </li>
                <li class="level1 nav-10-3"> <a href="product_detail.html"> <span>Tequila</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="product_detail.html"> <span>Cachaca</span> </a> </li>  
              </ul></li>
            
            <li class="level0 parent drop-menu"><a href="grid.html" class="level-top"><span>Sin Alcohol</span></a>
              <ul class="level1" style="display: none;">
                <li class="level1 first"> <a href="wishlist.html"> <span>Malta</span> </a> </li>
                <li class="level1 nav-10-2"> <a href="about_us.html"> <span>Jugos</span> </a> </li>
                <li class="level1 nav-10-3"> <a href="product_detail.html"> <span>Aguas y Gaseosas</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="product_detail.html"> <span>Energizantes</span> </a> </li>
                <li class="level1 nav-10-4"> <a href="product_detail.html"> <span>Granadina</span> </a> </li>  
              </ul></li>
            
            <li class="level0 parent drop-menu"><a href="grid.html" class="level-top"><span>Regaleria</span></a>
              <ul class="level1" style="display: none;">
                <li class="level1 first"> <a href="wishlist.html"> <span>Estucheria</span> </a> </li>
              </ul></li>
            
            <li class="level0 parent drop-menu"><a href="grid.html" class="level-top"><span>Placeres</span></a>
              <ul class="level1" style="display: none;">
                <li class="level1 first"> <a href="wishlist.html"> <span>Alimentos</span> </a> </li>
              </ul></li>
          </ul>
          <!-- End Sections --> 
              
    </div>
  </nav>
  <!-- end nav --> 
</body>
</html>