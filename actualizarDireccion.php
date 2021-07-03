<?php
include_once('inc/headerBlack.php');

if(isset($_POST['calle']) && isset($_POST['id']) && isset($_POST['numero'])){
    $valor = $user->actualizarDireccion($_POST);
    $_SESSION['usuario']['calle'] = $_POST['calle'];
    $_SESSION['usuario']['numero'] = $_POST['numero'];
    isset($_POST['piso_departamento'])?$_SESSION['usuario']['piso_departamento'] = $_POST['piso_departamento']:'';
}
?>