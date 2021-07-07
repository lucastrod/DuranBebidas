<?php

include_once('inc/headerBlack.php');

?>
<br>
<br>
<br>
<br>
<br>
<?php

$productos = new Producto($con);

if(isset($_POST['id'])){
$resp = $productos->chequearProducto($_POST['id']);
        

              if($resp != 1){
    
                  echo "<script languaje='JavaScript'>
                  window.location.href='productos.php?estado=error&error=productoNoDisponible&cat=';
                      </script>";
                
              }

$prod = $productos->getProducto($_POST['id']);
}

if(isset($_SESSION['carrito'])){
    if(isset($_POST['id'])){
    $arrayProductos =  $_SESSION['carrito'];
    $encontro = false;
    $numero = 0;
    for($i=0;$i<count($arrayProductos);$i++){
        if($arrayProductos[$i]['Id'] == $_POST['id']){
            $encontro = true;
            $numero = $i;
        }    
    }
   
    if($encontro){
        $arrayProductos[$numero]['Cantidad']+=$_POST['cantidad'];
        $_SESSION['carrito'] = $arrayProductos;
    }
    else{

        $nombre ='';
        $precio ='';
        $imagen ='';
        $stock = 0;

        $nombre = $prod->nombre;
        $precio=!(empty($prod->precio_oferta))?$prod->precio_oferta:$prod->precio;
        $imagen = $prod->producto_id;
        $cantidad = $_POST['cantidad'];
        $stock = $prod->stock;
        $arrayNuevo = array(
                            'Id'=> $_POST['id'],
                            'Nombre'=> $nombre,
                            'Precio'=> $precio,
                            'Imagen'=> $imagen,
                            'Stock' => $stock,
                            'Cantidad'=> $cantidad
        );
        
        array_push($arrayProductos,$arrayNuevo);
        $_SESSION['carrito']= $arrayProductos;
    }
    }

}
else{
    if(isset($_POST['id'])){
        $nombre ='';
        $precio ='';
        $imagen ='';
        $cantidad = 0;
        $stock = 0;

        $nombre = $prod->nombre;
        $precio=!(empty($prod->precio_oferta))?$prod->precio_oferta:$prod->precio;
        $imagen = $prod->producto_id;
        $cantidad = $_POST['cantidad'];
        $stock = $prod->stock;
        $arrayProductos[] = array(
                            'Id'=> $_POST['id'],
                            'Nombre'=> $nombre,
                            'Precio'=> $precio,
                            'Imagen'=> $imagen,
                            'Stock' => $stock,
                            'Cantidad'=> $cantidad
        );
        $_SESSION['carrito']= $arrayProductos;

    }
}

if(!empty($_SESSION["usuario"])){
  $direccion = $user->GetDireccion($_SESSION["usuario"]['id_usuario']);
  $direccion.=', CABA';
  ?>
  <!--<label for=""><strong>Request</strong></label>
  <br>
  <span id="dir"  data-id="<?=$direccion?>"></span>
  <br>
  <label for=""><strong>Response</strong></label>
  <br>
  <span id="res"></span>-->
  <html>
    <body>
        <form action="" method="post">
            <label>Origin:</label> <input type="text" name="o" placeholder="Enter Origin location" required> <br><br>
            <label>Destination:</label> <input type="text" name="d" placeholder="Enter Destination location" required> <br><br>
            <input type="submit" value="Calculate distance & time" name="submit"> <br><br>
        </form>
        <?php
            if(isset($_POST['submit'])){
            $Origin = $_POST['o']; $destination = $_POST['d'];
            $api = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=".$Origin."&destinations=".$destination."&key=AIzaSyCJKPl7ACcboe15l0ILXFrn0lkuT2so0to");
            $data = json_decode($api);
        ?>
            <label><b>Distance: </b></label> <span><?php echo ((int)$data->rows[0]->elements[0]->distance->value / 1000).' Km'; ?></span> <br><br>
            <label><b>Travel Time: </b></label> <span><?php echo $data->rows[0]->elements[0]->duration->text; ?></span> 

        <?php } ?>
    </body>
</html>


<!--  <div id="dvDistance"></div>

<script type="text/javascript">

$(document).ready(function() {
var geocoder;
var map;
var locations = ["Caseros 3183, CABA"];
var distancesArray = [];
var end2 = "Caseros 3183, CABA";

initialize();

function initialize() {
    var start = new google.maps.LatLng(-34.57882308284431, -58.431455779050324);
    var distancesArray = [];
    
    var service = new google.maps.DistanceMatrixService();
    
    service.getDistanceMatrix({
        origins: [start],
        destinations: [end2],
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC,
        avoidHighways: false,
        avoidTolls: false
    },

    function (response, status) {
        window.alert("Inside callback.");
        var dvTest = document.getElementById("dvDistance");
        dvTest.innerHTML += "getDistanceMatrix's callback.<br />";

        if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") {
            for (var i = 0; i < response.rows.length; i++) {
                for (var j = 0; j < response.rows[i].elements.length; j++) {
                    var distance = response.rows[i].elements[j].distance.text;
                    var duration = response.rows[i].elements[j].duration.text;
                    var dvDistance = document.getElementById("dvDistance");
                    dvDistance.innerHTML += "[" + j + "] Distance: " + distance;
                    dvDistance.innerHTML += " Duration:" + duration +"<br />";
                }
                distancesArray.push(i);
            }
        } else {
            dvTest = document.getElementById("dvDistance");
            dvTest.innerHTML += " For started, locations length = " + locations.length + "<br />";

            // window.alert("Aucun chemin trouvé");
        }
    }


    );
}



google.maps.event.addDomListener(window, "load", initialize);
});
</script>
-->
<!--<script type="text/javascript">

$(document).ready(function() {

var direccion = $('#dir').data('id');
   
initMap(direccion);

  function initMap(direccion) {
    
    const bounds = new google.maps.LatLngBounds();
    
    // initialize services
    const geocoder = new google.maps.Geocoder();
    const service = new google.maps.DistanceMatrixService();
    // Datos del cliente
    const origin1 = {
      lat: -34.57882308284431,
      lng: -58.431455779050324
    };
   
    const destinationB = direccion;
   
    const request = {
      origins: [origin1],
      destinations: [ destinationB],
      travelMode: google.maps.TravelMode.DRIVING,
      unitSystem: google.maps.UnitSystem.METRIC,
      avoidHighways: false,
      avoidTolls: false,
    };
        
    // put request on page
    document.getElementById("dir").innerText = JSON.stringify(
      request,
      null,
      2
    );
    // get distance matrix response
    service.getDistanceMatrix(request).then((response) => {
      // put response
      document.getElementById("res").innerText = JSON.stringify(
        response,
        null,
        2
      );
     
    });
  }

  //setInterval(initMap, 0);

  function getCostoEnvio(km){

      if (km<3) {
        //$200
      }

      if (km>3 && km<6) {
        //$400
      } 

      if (km>6 && km<10) {
        //$600
      } 

  }
});

</script>-->

<?php
  //var_dump($km);
  
  $envio = new Envio($con);
  $_SESSION["envio"] = $envio->Precio();
  }
  else{
    $_SESSION["envio"] = 0;
  }

?>

<div class="site-wrap">

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <form action="checkout.php"  class="col-md-12" method="post" enctype="multipart/form-data">
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Producto</th>
                    <th class="product-name">Nombre</th>
                    <th class="product-price">Precio</th>
                    <th class="product-quantity">Cantidad</th>
                    <th class="product-total">Total</th>
                    <th class="product-remove">Borrar</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                    $total = 0;
                    $descuento=0;
                    $subtotal=0;
                    if(isset($_SESSION['carrito'])){

                        $arregloCarrito = $_SESSION['carrito'];
                       
                        foreach($arregloCarrito as $row){
                          $subtotal += ($row['Cantidad'] * $row['Precio']);
                ?>
                  <tr style="position: relative;">
                    <td class="product-thumbnail" >
                      <img  src="file_sitio/<?php echo $row['Imagen'];?>/0.png" alt="Image" class="img-fluid" width="30" height="60" >
                    </td>
                    <td class="product-name" style="vertical-align:middle;">
                      <h2 class="h5 text-black" ><?php echo $row['Nombre'];?></h2>
                    </td>
                    <td style="vertical-align:middle;">$<?php echo $row['Precio'];?></td>
                    <td style="vertical-align:middle;">
                      <div style="display:inline-block" > 
                        <div class="input-group" style="margin:0;width : 130px;">                           
                            <select name="cant" style="height:40px;width: 65px; padding:10px;" data-id="<?php echo $row['Id']?>" data-precio="<?php echo $row['Precio']?>" onchange="sumar(this.value);">
                            <?php
                            $totalStock = $row['Stock'];
                            for ($i=1; $i <= $totalStock; $i++) { ?>
                           <?php if ($i == $row['Cantidad'] ){
                            echo "<option value='" . $row['Cantidad'] . "' selected='selected'>" . $row['Cantidad'] . "</option>";
                            }
                            else {
                            echo "<option value='" .$i. "'>" .$i. "</option>";
                            }?>
                            <?php }?>
                            </select>
                        </div>
                      </div>
                    </td>
                    <td style="vertical-align:middle;" class="cant<?php echo $row['Id'];?>">$<?php echo $row['Precio'] * $row['Cantidad'];?></td>
                  
                    <td style="vertical-align:middle;"><a href="#" class="btn btn-danger btn-sm btnEliminar" data-id="<?php echo $row['Id']?>">X</a></td>
                  </tr>
                  <?php }} ?>

                </tbody>
              </table>
            </div>
          
        </div>
        
       
      
          
                <div class="row" style="padding-bottom:25px;">
                <?php if (!empty($_GET['login'])){?>
                <div><span id="login" data-id="<?php echo $_GET['login'];?>"></span></div>
                <?php }?>
                  <div class="col-md-8"></div>
                  <div class="col-md-4">
                    <h2 class="h3 text-black">Envio</h2>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding-left:0px;">
                      <label><input type="radio" name="envio" value="0" id="radio2" checked> Retiro en Tienda</label>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding-left:0px;">
                      <label><input type="radio" name="envio" value="1" required id="radio1" > Envio a Domicilio</label>   
                    </div>
                    <table class="table site-block-order-table mb-5">
                    <tbody>
                    <tr>
                        <td class="text-black font-weight-bold" style="max-width:5px;"><strong>Envio</strong></td>
                        <td class="text-black font-weight-bold"style="max-width:5px;">$<span id="envio"></span></td>
                    </tr>
                    </tbody>
                    </table>
                  </div>
                </div>
                <div class="row" style="padding-bottom:25px;">
                  <div class="col-md-8"></div>
                  <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-lg py-3 btn-block">Finalizar Compra</button>               
                  </div>
                  <div class="col-md-1"></div>
                  
                </div>
          </div> 
          </form>
        </div>      
      </div>
    </div>

  </div>

  <?php include_once('inc/footer.php'); ?>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/carrito.js"></script>
  <script src="js/actualizarEnvio.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="js/validarLogin.js"></script>



