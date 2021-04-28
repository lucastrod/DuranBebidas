<?php


if(!empty($_GET)):

    if(!empty($_GET["cat"])):

        $cat = $_GET["cat"];

    else:
        $cat ='';
    endif;

    if(!empty($_GET["orden"])):

        $orden = $_GET["orden"];
    else:
        $orden ='';
    endif;

    if(!empty($_GET["marca"])):

        $marca = $_GET["marca"];
    else:
        $marca ='';
    endif;

    header("Location:productos.php?cat=$cat&orden=$orden&marca=$marca");

endif;

if(!empty($_POST)):


    if(isset($_POST["orden"])){
        if(!empty($_POST["orden"])):

            $orden = $_POST["orden"];
        else:
            $orden = '';
        endif;
    
        header("Location:comentarios.php?orden=$orden");
    }
    elseif(isset($_POST["categoria"])){
        if(!empty($_POST["categoria"])):

            $cat = $_POST["categoria"];
        else:
            $cat = '';
        endif;
    
        header("Location:ListProd.php?cat=$cat");
    }
   

endif;