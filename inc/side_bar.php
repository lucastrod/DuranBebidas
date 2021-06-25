<div class="row row-offcanvas row-offcanvas-left pt-4 mt-4">
        
    <!-- Sidebar -->
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block col-sm-3 col-md-2"><!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
        <!-- Bootstrap List Group -->
        <ul class="list-group">
            <!-- Separator with title -->
            <a class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed pl-1" style="font-size:30px; text-align:center;font-family:Montserrat">
               Panel 
            </a>
                                
            <?php if(in_array('produ',$_SESSION['usuario']['secciones'])){?>
            <a href="ListProd.php" class="bg-dark list-group-item list-group-item-action <?=isset($productsMenu)?'active':''?>">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="menu-collapsed" style="font-family:Montserrat">Productos</span>
                </div>
            </a>
            <?php }?>

            <?php if(in_array('ent',$_SESSION['usuario']['secciones'])){?>
            <a class="<?=isset($entregaMenu)?'active':''?> bg-dark list-group-item list-group-item-action" href="entregas.php">
            <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="menu-collapsed" style="font-family:Montserrat">Entregas</span>
                </div>
            </a>
            <?php }?>

            <?php if(in_array('usu',$_SESSION['usuario']['secciones'])){?>
					 <a href="usuarios.php" data-toggle="sidebar-colapse" class="bg-dark list-group-item list-group-item-action d-flex align-items-center <?=isset($userMenu)?'active':''?>">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span id="collapse-text" class="menu-collapsed" style="font-family:Montserrat">Usuarios</span>
                </div>
            </a>
			  <?php }?>

              <?php if(in_array('cat',$_SESSION['usuario']['secciones'])){?>
              <a href="categorias.php" class="bg-dark list-group-item list-group-item-action <?=isset($categoriasMenu)?'active':''?>">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="menu-collapsed" style="font-family:Montserrat">Categorias</span>
                </div>
              </a>
              <?php }?>

              <?php if(in_array('msj',$_SESSION['usuario']['secciones'])){?>
              <a href="mensajes.php" class="bg-dark list-group-item list-group-item-action <?=isset($mensajesMenu)?'active':''?>">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="menu-collapsed" style="font-family:Montserrat">Mensajes</span>
                </div>
              </a>
              <?php }?>

              <?php if(in_array('env',$_SESSION['usuario']['secciones'])){?>
              <a href="envios.php" class="bg-dark list-group-item list-group-item-action <?=isset($enviosMenu)?'active':''?>">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="menu-collapsed" style="font-family:Montserrat">Envio</span>
                </div>
              </a>
              <?php }?>

        </ul><!-- List Group END-->
    </div><!-- sidebar-container END -->
    
    <!-- MAIN -->
    
    
