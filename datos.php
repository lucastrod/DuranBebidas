<?php 

include_once('inc/db_data.php');
include_once('class/objeto.php');
include_once('class/productos.php');

$categoria = new Categoria($con);

$cat=$_POST['categoria'];


$cadena="<label>Subcategorias</label> 
			<select id='lista2' name='lista2'>";
    
$ca = $categoria->getListSubcat($cat);

    $class='';
    foreach($ca as $t){

        $cadena=$cadena.'<option value='.$t['categoria_id'].''.$class.'   
        
        >'.utf8_encode($t['nombre_Cat']).'</option>';
    }
   
	echo  $cadena."</select>";
	

?>