<!DOCTYPE html>

<?php

session_start();
include('config.php');
require('inc/db_data.php');
include('inc/arrays.php');
include('class/productos.php');
include('class/objeto.php');

if(!isset($_SESSION['carrito'])){
    header('Location:productos.php');
}

$array = $_SESSION['carrito'];

$productos = new Producto($con);


require __DIR__ .  '/vendor/autoload.php';  //Aqui coloca la ruta en donde descargaste el sdk de mercadopago

MercadoPago\SDK::setAccessToken('TEST-6760243392925397-042116-b5fa11a3fd3a9e2bb4ba79f1649ed6fb-747384554'); // Ya que vas a hacer pruebas de pago, aqui tu access token de prueba, luego puedes agregar el token de produccion

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();
$preference->back_urls = array(
    "success" => "https://localhost/wines/thankyou.php",
    "failure" => "https://localhost/wines/errorPago.php?error=error",
    "pending" => "https://localhost/wines/errorPago.php?error=pendiente"
);



$items=array();
// Crea un ítem en la preferencia
foreach ($array as $colum) {

  $item = new MercadoPago\Item();
  $item->title = $colum['Nombre'];
  $item->quantity = $colum['Cantidad'];
  $item->unit_price = $colum['Precio'];
  array_push($items,$item);
}

$preference->items = $items;
$preference->save();

// PARA GENERAR CLIENTE DE PRUEBA
//curl -X POST -H "Content-Type: application/json" "https://api.mercadopago.com/users/test_user?access_token=TEST-2228781292720900-042100-859650dc67e9ee7eb7f5495ef5e55d0f-200979013" -d "{'site_id':'MLA'}"
//{"id":747384503,"nickname":"TESTMHP3EO7G","password":"qatest3152","site_status":"active","email":"test_user_52156287@testuser.com"}//comprador
//{"id":747384554,"nickname":"TEST5ANAL27L","password":"qatest4038","site_status":"active","email":"test_user_12323708@testuser.com"}//vendedor



?>

<html lang="zxx" class="no-js">

<head>
  <title>Vino</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

  
  <link href="https://fonts.googleapis.com/css?family=Cinzel:400,700|Montserrat:400,700|Roboto&display=swap" rel="stylesheet"> 

  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">

  <link rel="stylesheet" href="css/jquery.fancybox.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">

  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

  <link rel="stylesheet" href="css/aos.css">
  <link href="css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">

  <link rel="stylesheet" href="css/style.css">



</head>

<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300" >

<div class="site-wrap site-navbar">

  <div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close mt-3">
        <span class="icon-close2 js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>


  
  <div class="header-top ">
    <div class="container px-0">
      <div class="row align-items-center">
        <div class="col-12 text-center ">
          <a href="index.php" class="site-logo">
            <img src="images/logo.png" alt="Image" class="img-fluid ">
          </a>
        </div>
        <a href="#" class="mx-auto d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span
              class="icon-menu h3"></span></a>
      </div>
    </div>
  </div> 

  <div class="col-12 col-md-12 order-3 order-md-3 text-right" style='padding-right: 100px;'>
            <div class="site-top-icons">
              <ul>
                <li><a href="#"><span class="icon icon-person"></span></a></li>
                <li><a href="#"><span class="icon icon-heart-o"></span></a></li>
                <li>
                  <a href="carrito.php" class="site-cart">
                    <span class="icon icon-shopping_cart"></span>
                    <span class="count" id="value">0</span>
                    <span id="value"></span>
                  </a>
                </li> 
                <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
              </ul>
            </div> 
    </div>


    
  <nav class="navbar bg navbar-expand-lg navbar-dark site-navbar site-navbar-target d-none pl-1 pb-0 d-lg-block mb-0">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse mb-0" id="bs-example-navbar-collapse-1" >
      <ul></ul>
      <ul></ul>
      <ul></ul>
      <ul></ul>
      <ul class="navbar-nav ml-auto pl-3 margen">
          
              <li  Style="font-size:23px; background: -webkit-linear-gradient(red,blue); -webkit-background-clip: text; -webkit-text-fill-color: transparent; color: tomato;font-family:roboto;"><a href="index.php" class="nav-link">Home</a></li>
              <li  Style="font-size:23px;  background: -webkit-linear-gradient(red,blue); -webkit-background-clip: text; -webkit-text-fill-color: transparent; color: tomato;font-family:roboto;"><a href="productos.php" class="nav-link">Listado de Productos</a></li>
              <li  Style="font-size:23px;  background: -webkit-linear-gradient(red,blue); -webkit-background-clip: text; -webkit-text-fill-color: transparent; color: tomato;font-family:roboto;"><a href="contacto.php" class="nav-link">Contacto</a></li>
      </ul>

<?php
      if(empty($_SESSION["usuario"])):
?>
      <ul class="navbar-nav mr-5 pr-6 margen2">
              <li style="font-size:18px; background: -webkit-linear-gradient(red,blue); -webkit-background-clip: text; -webkit-text-fill-color: transparent; color: tomato;font-family:roboto;"><a href="log.php" class="nav-link text-right">Ingresar</a></li>
      </ul>

<?php
      else:
      
      if(!empty($_SESSION['usuario']['secciones'])){?>

        <ul class="navbar-nav mr-5 pr-6">

               <li style="font-size:18px; background: -webkit-linear-gradient(red,blue); -webkit-background-clip: text; -webkit-text-fill-color: transparent; color: tomato;font-family:roboto;">
               <span class="nav-link"><?= $_SESSION["usuario"]["nombre"]; ?></span>
               </li>
             
               <li style="font-size:18px; background: -webkit-linear-gradient(red,blue); -webkit-background-clip:text; -webkit-text-fill-color: transparent; color: tomato;font-family:roboto;"><a href="panel.php" class="nav-link text-right">Panel</a></li>
              <li style="font-size:18px;background:-webkit-linear-gradient(red,blue);-webkit-background-clip:text;-webkit-text-fill-color:transparent;color:tomato;font-family:roboto;"><a href="logout.php" class="nav-link text-right">Logout</a></li>
        </ul>
         
<?php
          }
      endif;
?>
<ul></ul>
    </div>
  </nav>

    
  <div class="site-wrap">
    
    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-12">
            <div class="border p-4 rounded" role="alert">
              Returning customer? <a href="#">Click here</a> to login
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-5 mb-md-0">
            <h2 class="h3 mb-3 text-black">Billing Details</h2>
            <div class="p-3 p-lg-5 border">
              <div class="form-group">
                <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
                <select id="c_country" class="form-control">
                  <option value="1">Select a country</option>    
                  <option value="2">bangladesh</option>    
                  <option value="3">Algeria</option>    
                  <option value="4">Afghanistan</option>    
                  <option value="5">Ghana</option>    
                  <option value="6">Albania</option>    
                  <option value="7">Bahrain</option>    
                  <option value="8">Colombia</option>    
                  <option value="9">Dominican Republic</option>    
                </select>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_fname" name="c_fname">
                </div>
                <div class="col-md-6">
                  <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_lname" name="c_lname">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_companyname" class="text-black">Company Name </label>
                  <input type="text" class="form-control" id="c_companyname" name="c_companyname">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_address" name="c_address" placeholder="Street address">
                </div>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" placeholder="Apartment, suite, unit etc. (optional)">
              </div>

              <div class="form-group row">
                <div class="col-md-6">
                  <label for="c_state_country" class="text-black">State / Country <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_state_country" name="c_state_country">
                </div>
                <div class="col-md-6">
                  <label for="c_postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_postal_zip" name="c_postal_zip">
                </div>
              </div>

              <div class="form-group row mb-5">
                <div class="col-md-6">
                  <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_email_address" name="c_email_address">
                </div>
                <div class="col-md-6">
                  <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number">
                </div>
              </div>

              <div class="form-group">
                <label for="c_create_account" class="text-black" data-toggle="collapse" href="#create_an_account" role="button" aria-expanded="false" aria-controls="create_an_account"><input type="checkbox" value="1" id="c_create_account"> Create an account?</label>
                <div class="collapse" id="create_an_account">
                  <div class="py-2">
                    <p class="mb-3">Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                    <div class="form-group">
                      <label for="c_account_password" class="text-black">Account Password</label>
                      <input type="email" class="form-control" id="c_account_password" name="c_account_password" placeholder="">
                    </div>
                  </div>
                </div>
              </div>


              <div class="form-group">
                <label for="c_ship_different_address" class="text-black" data-toggle="collapse" href="#ship_different_address" role="button" aria-expanded="false" aria-controls="ship_different_address"><input type="checkbox" value="1" id="c_ship_different_address"> Ship To A Different Address?</label>
                <div class="collapse" id="ship_different_address">
                  <div class="py-2">

                    <div class="form-group">
                      <label for="c_diff_country" class="text-black">Country <span class="text-danger">*</span></label>
                      <select id="c_diff_country" class="form-control">
                        <option value="1">Select a country</option>    
                        <option value="2">bangladesh</option>    
                        <option value="3">Algeria</option>    
                        <option value="4">Afghanistan</option>    
                        <option value="5">Ghana</option>    
                        <option value="6">Albania</option>    
                        <option value="7">Bahrain</option>    
                        <option value="8">Colombia</option>    
                        <option value="9">Dominican Republic</option>    
                      </select>
                    </div>


                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="c_diff_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_diff_fname" name="c_diff_fname">
                      </div>
                      <div class="col-md-6">
                        <label for="c_diff_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_diff_lname" name="c_diff_lname">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-12">
                        <label for="c_diff_companyname" class="text-black">Company Name </label>
                        <input type="text" class="form-control" id="c_diff_companyname" name="c_diff_companyname">
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-12">
                        <label for="c_diff_address" class="text-black">Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_diff_address" name="c_diff_address" placeholder="Street address">
                      </div>
                    </div>

                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="Apartment, suite, unit etc. (optional)">
                    </div>

                    <div class="form-group row">
                      <div class="col-md-6">
                        <label for="c_diff_state_country" class="text-black">State / Country <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_diff_state_country" name="c_diff_state_country">
                      </div>
                      <div class="col-md-6">
                        <label for="c_diff_postal_zip" class="text-black">Posta / Zip <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_diff_postal_zip" name="c_diff_postal_zip">
                      </div>
                    </div>

                    <div class="form-group row mb-5">
                      <div class="col-md-6">
                        <label for="c_diff_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_diff_email_address" name="c_diff_email_address">
                      </div>
                      <div class="col-md-6">
                        <label for="c_diff_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="c_diff_phone" name="c_diff_phone" placeholder="Phone Number">
                      </div>
                    </div>

                  </div>

                </div>
              </div>

              <div class="form-group">
                <label for="c_order_notes" class="text-black">Order Notes</label>
                <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
              </div>

            </div>
          </div>
          <div class="col-md-6">

            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Coupon Code</h2>
                <div class="p-3 p-lg-5 border">
                  
                  <label for="c_code" class="text-black mb-3">Enter your coupon code if you have one</label>
                  <div class="input-group w-75">
                    <input type="text" class="form-control" id="c_code" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="button-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary btn-sm" type="button" id="button-addon2">Apply</button>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            
            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Your Order</h2>
                <div class="p-3 p-lg-5 border">
                
                  <table class="table site-block-order-table mb-5">
                    <thead>
                      <th>Product</th>
                      <th>Total</th>
                    </thead>
                    <tbody>

                    <?php

                    $total = 0;
                    $descuento=0;
                    $subtotal=0;
                       
                        foreach($array as $row){
                          $subtotal += ($row['Cantidad'] * $row['Precio']);
                    ?>
                      <tr>
                        <td class="product-name">
                            <h2 class="h5 text-black"><?php echo $row['Nombre'];?></h2>
                        </td>
                        <td>$<?php echo $row['Precio'];?></td>
                      </tr>
                      <?php } ?>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                        <td class="text-black font-weight-bold"><strong>$<?php echo $subtotal;?></strong></td>
                      </tr>
                      
                    </tbody>
                  </table>

                  <!--<form action="pagar.php" method="post">
                    <div class="form-group">
                      <input type="hidden" class="form-control" id="importe" name="importe" placeholder="" value="<?php echo $subtotal;?>">
                      <input type="submit" value="Pagar" class="btn btn-md btn-primary py-3 px-5" >
                    </div>
                </form>-->
                <div class="form-group text-center " style="font-size:20px;">
                  <form action="https://localhost/wines/thankyou.php" method="POST">
                    <script src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js" data-preference-id="<?php echo $preference->id; ?>">
                    </script>
                  </form>
                </div>
                  <div class="form-group">
                  <!--  <button class="btn btn-primary btn-lg py-3 btn-block" data-usu="<?php echo $_SESSION["usuario"] ["id_usuario"]?>" data-importe="<?php echo $subtotal?>" data-fecha="<?php echo date("Y-m-d");?>">Place Order</button>-->
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- </form> -->
      </div>
    </div>

    <?php include_once('inc/footer.php'); ?> 
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
  <script type="text/javascript" src="js/iconoCarrito.js"></script>
  <script src="js/main.js"></script>
   <script src="js/guardarVenta.js"></script>
  

  </body>
</html>