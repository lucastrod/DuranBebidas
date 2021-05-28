<?php 
include_once('inc/headerBlack.php');
include_once('funciones.php');
$categorias = new Categoria($con);
?>


<body class="inner-page">
<div id="page">

  <!-- Breadcrumbs -->
  <div class="breadcrumbs">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
        <br>
        <br>

<ul class="breadcrumb">
<?php $ofer = isset($_GET['oferta']) ? '&oferta='.$_GET['oferta']: ''; 
$oferIn =  isset($_GET['oferta']) ? '?oferta='.$_GET['oferta']: ''; 
?>
	<li><a href="productos.php<?=$oferIn?>">Inicio</a></li>
  <?php
        $principal='';
       if(!(empty($_GET["cat"]))){
        $principal = $categorias->esPrincipal($_GET['cat']);
        }

        $class='';
        $cat='';
        $id='';
        if(!(empty($_GET["cat"]))){
          $cat = $categorias->getCategoria($_GET['cat']);
          $categoria = $cat->nombre_Cat;
          $id=$cat->categoria_id;
        }
        else{
          $class='hide';
          $categoria='';
        }      
        $html="<li id=\"titulo\" class='$class'><a href='productos.php?cat=$id$ofer'>$categoria</a></li>";
        //echo $html;

        if($principal){
          echo $html;
        }
        else{
          
        if(!(empty($_GET["cat"]))){ 
        $cat = $categorias->getCategoria($_GET['cat']);
        $padre = $cat->padre_id;
        $padreCat = $categorias->getCategoria($padre);
        $id= $padreCat->categoria_id;
        $padreCategoria = $padreCat->nombre_Cat;
        }
        else{
          $class='hide';
          $padreCategoria='';
        }
         $html2 ="<li id=\"titulo\" class='$class'><a href='productos.php?cat=$id$ofer'>$padreCategoria</a></li>";
         $html2.=$html;
         echo $html2;
        }
  ?>
	<li><a href="#"></a></li>
</ul>
        </div>
      </div>
    </div>
  </div>
  <!-- Breadcrumbs End --> 
<!-- Main Container -->

<section class="main-container col2-left-layout bounceInUp animated">
  <div class="container">
  <br>
    <div class="row">
      <div class="col-main col-sm-9 col-sm-push-3">
	  
        <article class="col-main">
          <div class="page-title">
            <?php
            $ofe = 'Ofertas';
            $cat=!(empty($_GET["cat"]))?$categorias->getCategoria($_GET['cat']):'';
            $categoria=!(empty($_GET["cat"]))?$cat->nombre_Cat:'Todos';
            $html="<h1 id=\"titulo\">$categoria</h1>";
            $oferta = !(empty($_GET["oferta"]))?"<h2 id=\"titulo\">$ofe</h2>":'';
            echo $html;
            echo $oferta;
            ?>
          </div>
        
          <div class="toolbar">
           
            <div id="sort-by">
              <label class="left">Ordenar </label>
              <form id="form" name="form" method="get" action="ordenar.php">

            <?php

            if(!empty($_GET["cat"]) && !empty($_GET["limite"]) && !empty($_GET["oferta"])){
            ?>
              <select style="visibility: hidden;" name="cat" id="orden" onChange="document.form.submit();">
              <option value=""></option>
              <option value="<?php echo $_GET['cat']?>" selected></option>
              </select>
              <select style="visibility: hidden;" name="limite" id="orden" onChange="document.form.submit();">
              <option value=""></option>
              <option value="<?php echo $_GET['limite']?>" selected></option>
              </select>
              <select style="visibility: hidden;" name="oferta" id="orden" onChange="document.form.submit();">
              <option value=""></option>
              <option value="<?php echo $_GET['oferta']?>" selected></option>
              </select>
              <select name="orden" id="orden" onChange="document.form.submit();">
              <option value=""></option>
              <option value="AZ">AZ</option>
              <option value="ZA">ZA</option>
              <option value="Mayor">Mayor Precio</option>
              <option value="Menor">Menor Precio</option>
              </select>
            <?php
            }
            elseif (!empty($_GET["cat"]) && !empty($_GET["oferta"])) {
              ?>
              <select style="visibility: hidden;" name="cat" id="orden" onChange="document.form.submit();">
              <option value=""></option>
              <option value="<?php echo $_GET['cat']?>" selected></option>
              </select>
              <select style="visibility: hidden;" name="oferta" id="orden" onChange="document.form.submit();">
              <option value=""></option>
              <option value="<?php echo $_GET['oferta']?>" selected></option>
              </select>
              <select name="orden" id="orden" onChange="document.form.submit();">
              <option value=""></option>
              <option value="AZ">AZ</option>
              <option value="ZA">ZA</option>
              <option value="Mayor">Mayor Precio</option>
              <option value="Menor">Menor Precio</option>
              </select>
              <?php
            }
            elseif (!empty($_GET["cat"]) && !empty($_GET["limite"])) {
              ?>
              <select style="visibility: hidden;" name="cat" id="orden" onChange="document.form.submit();">
              <option value=""></option>
              <option value="<?php echo $_GET['cat']?>" selected></option>
              </select>
              <select style="visibility: hidden;" name="limite" id="orden" onChange="document.form.submit();">
              <option value=""></option>
              <option value="<?php echo $_GET['limite']?>" selected></option>
              </select>
              <select name="orden" id="orden" onChange="document.form.submit();">
              <option value=""></option>
              <option value="AZ">AZ</option>
              <option value="ZA">ZA</option>
              <option value="Mayor">Mayor Precio</option>
              <option value="Menor">Menor Precio</option>
              </select>
              <?php
            }
            elseif (!empty($_GET["cat"])) {
              ?>
              <select style="visibility: hidden;" name="cat" id="orden" onChange="document.form.submit();">
              <option value=""></option>
              <option value="<?php echo $_GET['cat']?>" selected></option>
              </select>
              <select name="orden" id="orden" onChange="document.form.submit();">
              <option value=""></option>
              <option value="AZ">AZ</option>
              <option value="ZA">ZA</option>
              <option value="Mayor">Mayor Precio</option>
              <option value="Menor">Menor Precio</option>
              </select>
              <?php
            }
            elseif (!empty($_GET["oferta"])) {
              ?>
              <select style="visibility: hidden;" name="oferta" id="orden" onChange="document.form.submit();">
              <option value=""></option>
              <option value="<?php echo $_GET['oferta']?>" selected></option>
              </select>
              <select name="orden" id="orden" onChange="document.form.submit();">
              <option value=""></option>
              <option value="AZ">AZ</option>
              <option value="ZA">ZA</option>
              <option value="Mayor">Mayor Precio</option>
              <option value="Menor">Menor Precio</option>
              </select>
              <?php
            }
            else{
            ?>
              <select name="orden" id="orden" onChange="document.form.submit();">
              <option value=""></option>
              <option value="AZ">AZ</option>
              <option value="ZA">ZA</option>
              <option value="Mayor">Mayor Precio</option>
              <option value="Menor">Menor Precio</option>
              </select>  

            <?php
            }  
            ?>

          </form>
            </div>
          </div>
          <div class="category-products">
            <ol class="products-list" id="products-list">

            <?php
                    $productos = new Producto($con);
                    $limitePaginado = 10;
                    if(isset($_GET['oferta'])){
                    if(isset($_GET['cat'])){
                      $totalProductos =$productos->totalProductos($_GET['cat'],$_GET['oferta']);
                    }
                    else{
                      $totalProductos = $productos->totalProductos('',$_GET['oferta']);
                    }
                  }
                  elseif(isset($_GET['cat'])){
                    $totalProductos =$productos->totalProductos($_GET['cat'],'');
                  }
                  else{
                    $totalProductos = $productos->totalProductos('','');
                  }
                  
                    foreach($productos->obtenerCat($_GET,$limitePaginado) as $row){
                      
            ?>

          <?php if(($row->oferta)==0){
            
           ?>
            <li class="item first">
              <div class="row">
                <div class="col-md-4">
              <div class="product-image"> <img class="small-image" style="height:200px; width:auto" src="file_sitio/<?php echo $row->producto_id;?>/0.png"></div>
                </div>
                <div class="col-md-8">
            <div class="product-shop">
              <h2 class="product-name"><a title="HTC Rhyme Sense"><?php echo utf8_decode($row->nombre)?></a></h2>
              
              <div class="desc std">
                <p><?php echo utf8_decode(utf8_encode($row->descripcion))?> </p>
              </div>
              <div class="price-box">
                <p class="special-price"> <span class="price">$ <?php echo  $row->precio?> </span> </p> 
              </div>
              <div style="display:inline-block" >
                          <div class="input-group ">
                          <select name="cat" id="<?php echo $row->producto_id;?>" style="height:40px;width: 60px; padding:10px;">
                            <option value="1" selected>1</option>
                            <?php
                            $totalStock = ($row->stock);
                            for ($i=2; $i <= $totalStock; $i++) { ?>
                              <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php }?>
                           
                          </select>
                          </div>
              </div>
              <div class="actions">
                <button class="button btn-cart ajx-cart btnAgregar" title="Add to Cart" type="button" data-id="<?php echo $row->producto_id;?>" style="margin-top:5px;"><span>Agregar</span></button>
              </div>
            </div>
            </div>
            </div>
          </li>
          <?php }
          else{
            $porcentaje =  ceil(100 - (($row->precio_oferta * 100) / $row->precio));
            ?>
          
          <li class="item first">
              <div class="product-image"> <a href="#" title="HTC Rhyme Sense"> <img class="small-image" src="products-images/product.jpg" alt="HTC Rhyme Sense"> </a> </div>
            <div class="product-shop">
              <h2 class="product-name"><a href="#/htc-rhyme-sense.html" title="HTC Rhyme Sense"><?php echo utf8_decode($row->nombre)?></a></h2>
              
              <div class="desc std">
                <p><?php echo utf8_decode(utf8_encode($row->descripcion))?> </p>
              </div>
              <div class="price-box">
                <p class="special-price"> <span class="price-label"></span> <span class="price"> $ <?php echo  $row->precio_oferta?> </span> </p> <p class="old-price"> <span class="price-label"></span> <span class="price">$ <?php echo  $row->precio?></span> </p>
                <p class="special-price"> <span class="price" style="color:rgb(110, 196, 39);">% <?php echo $porcentaje;?> off </span></p>
              </div>
              <div style="display:inline-block" >
                          <div class="input-group ">
                          <select name="cat" id="<?php echo $row->producto_id;?>" style="height:40px;width: 60px; padding:10px;">
                            <option value="1" selected>1</option>
                            <?php
                            $totalStock = ($row->stock);
                            for ($i=2; $i <= $totalStock; $i++) { ?>
                              <option value="<?php echo $i;?>"><?php echo $i;?></option>
                            <?php }?>
                           
                          </select>
                          </div>
              </div>
              <div class="actions">
                <button class="button btn-cart ajx-cart btnAgregar" title="Add to Cart" type="button" data-id="<?php echo $row->producto_id;?>" style="margin-top:5px;"><span>Agregar</span></button>
              </div>
            </div>
          </li>

          <?php
          }
              } 
                  ?>
        </ol>
          </div>
        </article>
        <!--	///*///======    End article  ========= //*/// --> 
        <div class="row" data-aos="fade-up">
              <div class="col-md-12 text-center mb-5">
                <div class="site-block-27">
               
                  
              <?php
                    
              $redondeo = round($totalProductos/$limitePaginado,1);
              $totalBotones = ceil($redondeo)-1;
              $valor = 0;
              $limiInf = 0;
              $cantVisib = 5;
              $mayor = ($totalBotones*$limitePaginado)-10;
              $menor = 0;

              $ultimaPag = $totalBotones;
              $cantVi = 2;
              if(empty($_GET['limite'])){
                $limite = 0;
              }
              else{
                $limite = $_GET['limite'];
              }

           
              $inicio = ( ( ($limite/$limitePaginado) - $cantVi ) > 0 ) ? ( ($limite/$limitePaginado) - $cantVi ) : 1;
              $fin = ( (($limite/$limitePaginado) + $cantVi ) < $ultimaPag ) ? (($limite/$limitePaginado) + $cantVi): $ultimaPag;

              $html = '<ul>';

              $cat = isset($_GET['cat']) ? 'cat='.$_GET['cat'].'&'  : '';
              $ord = isset($_GET['orden']) ? 'orden='.$_GET['orden'].'&'  : '';
              $of = isset($_GET['oferta']) ? 'oferta='.$_GET['oferta'].'&'  : '';
 
              $class = (($limite/$limitePaginado)  == 1 ) ? "disabled" : "";
              if($limite-$limitePaginado>=0){
              $html .= '<li class="'.$class .'"><a href="productos.php?'.$cat.$ord.$of.'limite='.($limite-$limitePaginado).'">&laquo;</a></li>';
              }
              if(empty($_GET['limite'])){
                $html .= '<li class="active"><a href="productos.php?'.$cat.$ord.$of.'">1</a></li>';
              }
              elseif( $inicio > 1 ) {
              $html .= '<li><a href="productos.php?'.$cat.$ord.$of.'">1</a></li>';
              $html .= '<li class="disabled"><span>...</span></li>';
              }
              else{
                $html .= '<li><a href="productos.php?'.$cat.$ord.$of.'">1</a></li>';
              }

              for($i = $inicio ; $i <= $fin; $i++) {
              $class  = ($limite/$limitePaginado == $i) ? "active" : "";
              $html .= '<li class="' . $class . '"><a href="productos.php?'.$cat.$ord.$of.'limite='.($i*$limitePaginado).'">' . ($i+1) . '</a></li>';
              }
 
              if( $fin < $ultimaPag ) {
              $html  .= '<li class="disabled"><span>...</span></li>';
              $html  .= '<li><a href="productos.php?'.$cat.$ord.$of.'limite='.($ultimaPag*$limitePaginado).'">' . ($ultimaPag+1) . '</a></li>';
              }
            
              $class = ( ($limite/$limitePaginado) == $ultimaPag ) ? "disabled" : "";
              if(($limite+$limitePaginado)<= ($totalBotones*$limitePaginado)){
              $html .= '<li class="' . $class . '"><a href="productos.php?'.$cat.$ord.$of.'limite='.($limite+$limitePaginado).'">&raquo;</a></li>';
                      }
              $html .= '</ul>';
 
              echo $html;
?>
                </div>
              </div>
            </div>
      </div>
      <div class="col-left sidebar col-sm-3 col-xs-12 col-sm-pull-9">
          <aside class="col-left sidebar">
            <div class="side-nav-categories">
              <div class="block-title"> Categorias </div>
              <!--block-title--> 
              <!-- BEGIN BOX-CATEGORY -->
              <div class="box-content box-category">
                <ul>
                <?php  

                    foreach($categorias->getPrincipal(0) as $ca){
                  $oferta = isset($_GET['oferta']) ? '&oferta='.$_GET['oferta']: '';
                 
                  ?> 
                  <li><a class="active" href="productos.php?cat=<?= utf8_encode($ca['categoria_id']);?><?=$oferta?>"><?= utf8_decode(utf8_encode($ca['nombre_Cat']));?></a> <span class="subDropdown minus"></span>
                    <ul class="level0_415" style="display:block">
                      <?php $cat = $categorias->getListHijos($ca['categoria_id']); 
                      foreach($cat as $sub){?>
                        <li> <a href="productos.php?cat=<?= utf8_encode($sub['categoria_id']);?><?=$oferta?>"><?= utf8_decode(utf8_encode($sub['nombre_Cat']));?></a> <!--<span class="subDropdown plus"></span>-->
                        <!--<ul class="level1" style="display:none">
                          <li> <a href="#/women/tops/evening-tops.html"> Clutch Handbags </a> </li>
                          <li> <a href="#/women/tops/shirts-blouses.html"> Diaper Bags </a> </li>
                          <li> <a href="#/women/tops/tunics.html"> Back Bags </a> </li>
                          <li> <a href="#/women/tops/vests.html"> Hobo handbags </a> </li>
                          
                        </ul>-->
                        </li>
                      <?php } ?>
                      
                    </ul>
                  </li>
                    <?php }
                      
            ?>
              </div>
              <!--box-content box-category--> 
            </div>
           
            
          </aside>
        </div>
    </div>
  </div>
</section>
<!-- Main Container End --> 

  <div class="brand-logo wow bounceInUp animated">
    <div class="container">
      
      <div class="slider-items-products">
        <div id="brand-logo-slider" class="product-flexslider hidden-buttons">
          <div class="slider-items slider-width-col6"> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo3.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo2.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo1.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo4.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo5.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo6.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo1.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
            <!-- Item -->
            <div class="item"><a href="#"><img src="images/b-logo4.png" alt="Image"></a> </div>
            <!-- End Item --> 
            
          </div>
        </div>
      </div>
    </div>
  </div>
  
  

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script type="text/javascript" src="jquery.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script src="js/cartel.js"></script>

  <?php include_once('inc/footer.php'); ?>

</body>
</html>