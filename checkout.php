<!DOCTYPE html>

<?php
error_reporting(0);
session_start();

if(!isset($_SESSION['carrito'])){
    header('Location:productos.php');
}
if(!isset($_SESSION['usuario'])){
  header('Location:carrito.php?login=1');
}

if(!isset($_POST['envio'])){
  if(!isset($_GET['modif'])){
    $_SESSION["usuario"] ["envio"] = 0;
  }
}

include_once('inc/headerBlack.php');

$array = $_SESSION['carrito'];

$productos = new Producto($con);

?>



<?php
//require __DIR__ .  '/vendor/autoload.php';  //Aqui coloca la ruta en donde descargaste el sdk de mercadopago
include_once('vendor/autoload.php');

MercadoPago\SDK::setAccessToken('TEST-6760243392925397-042116-b5fa11a3fd3a9e2bb4ba79f1649ed6fb-747384554'); // Ya que vas a hacer pruebas de pago, aqui tu access token de prueba, luego puedes agregar el token de produccion

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();
$preference->back_urls = array(
    "success" => "https://localhost/DuranBebidas/thankyou.php",
    "failure" => "https://localhost/DuranBebidas/errorPago.php?error=error",
    "pending" => "https://localhost/DuranBebidas/errorPago.php?error=pendiente"
);

$preference->statement_descriptor = "DuranBebidas";
$envio = new MercadoPago\Shipments();
$envio ->cost =  intval($_SESSION["usuario"] ["envio"]);
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
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-5 mb-md-0">
            <h2 class="h3 mb-3 text-black">Datos de Contacto</h2>
            <div class="p-3 p-lg-5 border">
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="c_fname" class="text-black">Nombre</label>
                  <label for="c_lname" class="form-control" disabled><?= $_SESSION['usuario']['nombre'];?></label>
                </div>
                <div class="col-md-6">
                  <label for="c_lname" class="text-black">Apellido</label>
                  <label for="c_lname" class="form-control" disabled><?= $_SESSION['usuario']['apellido'];?></label>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <div class="form-group row">
                    <div class="col-md-4">
                      <label for="c_fname" class="text-black">Calle</label>
                      <label for="c_lname" class="form-control"><?= $_SESSION['usuario']['calle'];?></label>
                    </div>
                    <div class="col-md-4">
                      <label for="c_lname" class="text-black">Numero</label>
                      <label for="c_lname" class="form-control"><?= $_SESSION['usuario']['numero'];?></label>
                    </div>
                    <div class="col-md-4">
                      <label for="c_lname" class="text-black">Piso/Departamento</label>
                      <label for="c_lname" class="form-control"><?= $_SESSION['usuario']['piso_departamento'];?></label>
                    </div>
                </div>
                  <span class="text-danger">* Puede modificar la dirección de envío</span>
                  <a title="Cambiar" href="javascript:void(null)"><img alt="Cambiar" src="images/lapiz.png" width="10" height="20" onClick="cambiar(<?php echo $_SESSION['usuario']['id_usuario']?>, '<?= !empty($_SESSION['usuario']['calle'])?$_SESSION['usuario']['calle']:'Sin datos'; ?>', '<?= !empty($_SESSION['usuario']['numero'])?$_SESSION['usuario']['numero']:'Sin datos'; ?>', '<?= !empty($_SESSION['usuario']['piso_departamento'])?$_SESSION['usuario']['piso_departamento']:'Sin datos'; ?>');"></a>
                </div>
              </div>

              <div class="form-group row mb-5">
                <div class="col-md-6">
                  <label for="c_email_address" class="text-black" >Email</label>
                  <label for="c_lname" class="form-control" disabled><?= $_SESSION['usuario']['email'];?></label>
                </div>
                <div class="col-md-6">
                  <label for="c_phone" class="text-black" >Telefono</label>
                  <label for="c_lname" class="form-control"disabled><?= $_SESSION['usuario']['telefono'];?></label>
                </div>
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

                <div class="form-group text-center " style="font-size:20px;">
                  <form action="DuranBebidas/thankyou.php" method="POST">
                  
                    <script src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js" data-preference-id="<?php echo $preference->id; ?>">
                    </script>
                    
                  </form>
                </div>
                </div>
              </div>
            </div>

          </div>
        </div>

        
        <!-- </form> -->

        

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
  <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
  <script type="text/javascript" src="js/iconoCarrito.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script type="text/javascript" src="js/actualizarDireccion.js"></script>
  <script src="js/main.js"></script>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
  </body>
</html>
<?php include_once('inc/footer.php'); ?> 
