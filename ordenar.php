<?php


if(!empty($_GET)):

    echo($_GET);
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

    if(!empty($_GET["oferta"])):

        $oferta = '&oferta='.$_GET["oferta"];
    else:
        $oferta ='';
    endif;

    if(!empty($_GET["limite"])):

        $lim = $_GET["limite"];

    else:
        $lim ='';
    endif;
    
    header("Location:productos.php?cat=$cat&orden=$orden&limite=$lim$oferta");

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
    elseif(isset($_POST["pedido"])){
        if(!empty($_POST["pedido"])):

            $ped = $_POST["pedido"];
        else:
            $ped = '';
        endif;
    
        header("Location:entregas.php?enCurso=$ped");
    }

endif;