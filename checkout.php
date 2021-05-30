<!DOCTYPE html>

<?php
error_reporting(0);
session_start();

if(!isset($_SESSION['carrito'])){
    header('Location:productos.php');
}
include_once('inc/headerBlack.php');

$array = $_SESSION['carrito'];

$productos = new Producto($con);


require __DIR__ .  '/vendor/autoload.php';  //Aqui coloca la ruta en donde descargaste el sdk de mercadopago

MercadoPago\SDK::setAccessToken('TEST-6760243392925397-042116-b5fa11a3fd3a9e2bb4ba79f1649ed6fb-747384554'); // Ya que vas a hacer pruebas de pago, aqui tu access token de prueba, luego puedes agregar el token de produccion

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();
$preference->back_urls = array(
    "success" => "https://localhost/DuranBebidas/DuranBebidas/thankyou.php",
    "failure" => "https://localhost/DuranBebidas/errorPago.php?error=error",
    "pending" => "https://localhost/DuranBebidas/errorPago.php?error=pendiente"
);

$preference->statement_descriptor = "DuranBebidas";
$envio = new MercadoPago\shipments();
$envio ->cost = $_SESSION["usuario"] ["envio"];
$envio ->mode = "not_specified";
$preference->shipments = $envio;


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
//Mastercard	5031 7557 3453 0604	123	11/25
//Visa	4509 9535 6623 3704	123	11/25
//American Express	3711 803032 57522	1234	11/25



?>

  <div class="site-wrap">
    
    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-12">
            <br>
            <br>
            <br>
            <div class="border p-4 rounded" role="alert">
              Returning customer? <a href="#">Click here</a> to login
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-5 mb-md-0">
            <h2 class="h3 mb-3 text-black">Billing Details</h2>
            <div class="p-3 p-lg-5 border">

              <div class="form-group row">
                <div class="col-md-6">
                  <label for="c_fname" class="text-black">Nombre <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_fname" name="c_fname">
                </div>
                <div class="col-md-6">
                  <label for="c_lname" class="text-black">Apellido <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_lname" name="c_lname">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_address" name="c_address" placeholder="Street address">
                </div>
              </div>

              <div class="form-group row mb-5">
                <div class="col-md-6">
                  <label for="c_email_address" class="text-black">Email <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_email_address" name="c_email_address">
                </div>
                <div class="col-md-6">
                  <label for="c_phone" class="text-black">Telefono <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number">
                </div>
              </div>

              <div class="form-group">
                <label for="c_create_account" class="text-black" data-toggle="collapse" href="#create_an_account" role="button" aria-expanded="false" aria-controls="create_an_account"><input type="checkbox" value="1" id="c_create_account"> Crear cuenta?</label>
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
                <label for="c_order_notes" class="text-black">Notas del pedido</label>
                <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
              </div>

            </div>
          </div>
          <div class="col-md-6">
            <div class="row mb-5">
              <div class="col-md-12">
              
                <!--<h2 class="h3 mb-3 text-black">Envio</h2>-->
                <div class="p-3 p-lg-5 border">
             
                  

                </div>
              </div>
            </div>
            
            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Pedido</h2>
                <div class="p-3 p-lg-5 border">
                
                  <table class="table site-block-order-table mb-5">
                    <thead>
                      <th>Productos</th>
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
                        <td>$<?php echo $row['Cantidad'] * $row['Precio'];?></td>
                      </tr>
                      <?php } ?>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Envio</strong></td>
                        <td class="text-black font-weight-bold">$<?php echo $_SESSION["usuario"] ["envio"];?></td>
                      </tr>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Pedido Total</strong></td>
                        <td class="text-black font-weight-bold"><strong>$ <?php echo $subtotal + $_SESSION["usuario"] ["envio"];?></strong></td>
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
                  <form action="DuranBebidas/thankyou.php" method="POST">
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

  

  </body>
</html>