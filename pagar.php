
<?php include_once('inc/header.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago Mercadopago</title>
</head>
<body>

    <h2>Mercadopago pago:</h2>

    <?php

    require __DIR__ .  '/vendor/autoload.php';  //Aqui coloca la ruta en donde descargaste el sdk de mercadopago

    MercadoPago\SDK::setAccessToken('TEST-6760243392925397-042116-b5fa11a3fd3a9e2bb4ba79f1649ed6fb-747384554'); // Ya que vas a hacer pruebas de pago, aqui tu access token de prueba, luego puedes agregar el token de produccion

    // Crea un objeto de preferencia
    $preference = new MercadoPago\Preference();
    $preference->back_urls = array(
        "success" => "https://localhost/wines/productos.php",
        "failure" => "https://localhost/wines/errorPago.php?error=error",
        "pending" => "https://localhost/wines/errorPago.php?error=pendiente"
    );

    // Crea un ítem en la preferencia
    $item = new MercadoPago\Item();
    $item->title = 'Rutini';
    $item->quantity = 1;
    $item->unit_price = 300; //Detalle aca, si tu previamente tienes configurado en tu cuenta que eres de algun pais que no maneje decimales en el valor, el valor debe ser entero, sino mercadopago arrojara error
    $preference->items = array($item);
    $preference->save();

// PARA GENERAR CLIENTE DE PRUEBA
//curl -X POST -H "Content-Type: application/json" "https://api.mercadopago.com/users/test_user?access_token=TEST-2228781292720900-042100-859650dc67e9ee7eb7f5495ef5e55d0f-200979013" -d "{'site_id':'MLA'}"
//{"id":747384503,"nickname":"TESTMHP3EO7G","password":"qatest3152","site_status":"active","email":"test_user_52156287@testuser.com"}//comprador
//{"id":747384554,"nickname":"TEST5ANAL27L","password":"qatest4038","site_status":"active","email":"test_user_12323708@testuser.com"}//vendedor
?>

    <form action="https://localhost/wines/thankyou.php" method="POST">
        <script src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js" data-preference-id="<?php echo $preference->id; ?>">
        </script>
    </form>

</body>
</html>