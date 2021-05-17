<?php 

include_once('inc/db_data.php');
include_once('class/objeto.php');
include_once('class/productos.php');

$comentario = new Comentario($con);
$marca =  new Marca($con);
$producto = new Producto($con);
$categoria = new Categoria($con);
$usuario = new Usuario($con);




if(isset($_GET['activo'])){ 

    if(isset($_GET['comentario_id'])){
            $comentario->activarComentario($_GET);
            $producto->actualizarRanking($_GET);
            header('Location:comentarios.php');
            die();
    }
    elseif(isset($_GET['id_marca'])){
        $marca->activarMarca($_GET);
        header('Location:marcas.php');
        die();
    }
    
    elseif(isset($_GET['id_usuario'])){
        $usuario->activarUsuario($_GET);
        header('Location:usuarios.php');
        die();
    }
}

if(isset($_GET['inactivo'])){ 
        if(isset($_GET['categoria_id'])){
                if($_GET['padre_id'] < 1){
                        $categoria->activarCategoria($_GET);
                        header('Location:categorias.php');
                        die();
                }
                else{
                        $categoria->activarCategoria($_GET);
                        header('Location:subcategorias.php?categoria_id='.$_GET['padre_id']);
                        die();
                }
               
        }
        elseif (isset($_GET['producto_id'])){
                $producto->activarProducto($_GET);
                if(isset($_GET['cat'])){
                        if(isset($_GET['padre_id'])){
                                header('Location:ListProd.php?cat='.$_GET['cat'].'&padre_id='.$_GET['padre_id']);
                        }
                        else{
                                header('Location:ListProd.php?cat='.$_GET['cat']);
                        }
                             
                }
                else{
                        header('Location:ListProd.php');
                }
               
                die();
        }
}
    
						
include('inc/footer.php');

?>