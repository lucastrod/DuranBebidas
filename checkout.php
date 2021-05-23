<!DOCTYPE html>

<?php

include_once('inc/header.php');

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
    "success" => "https://localhost/DuranBebidas/DuranBebidas/thankyou.php",
    "failure" => "https://localhost/DuranBebidas/errorPago.php?error=error",
    "pending" => "https://localhost/DuranBebidas/errorPago.php?error=pendiente"
);

$preference->statement_descriptor = "DuranBebidas";
$envio = new MercadoPago\shipments();
$envio ->cost = 0;
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
              
                <h2 class="h3 mb-3 text-black">Envio</h2>
                <div class="p-3 p-lg-5 border">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label><input type="radio" name="envio" value="0" id="radio2" checked> Retiro en Tienda</label>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                <label><input type="radio" name="envio" value="1" required id="radio1" > Envio a Domicilio</label>   
                </div>
                  

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
                        <td class="text-black font-weight-bold">$<span id="envio"></span></td>
                      </tr>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Pedido Total</strong></td>
                        <td class="text-black font-weight-bold"><strong>$<span id="subtotal"></span></strong></td>
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
                  <form action="DuranBebidas/DuranBebidas/thankyou.php" method="POST">
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
  <script src="js/actualizarEnvio.js"></script>
  

  </body>
</html>