<?php
include_once('inc/headerBlack.php');

if(isset($_POST['direccion']) && isset($_POST['id'])){
    $user->actualizarDireccion($_POST['id'], $_POST['direccion']);
    $_SESSION['usuario']['direccion'] = $_POST['direccion'];
}

?>