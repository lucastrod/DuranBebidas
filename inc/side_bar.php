<div class="row row-offcanvas row-offcanvas-left pt-4 mt-4">
        
    <!-- Sidebar -->
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block col-sm-3 col-md-2"><!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
        <!-- Bootstrap List Group -->
        <ul class="list-group">
            <!-- Separator with title -->
            <a class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed pl-1" style="font-size:25px;font-family:cursive;">
               Panel 
            </a>
           
            <a href="index.php" class="bg-dark list-group-item list-group-item-action ">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-tasks fa-fw mr-3"></span>
                    <span class="menu-collapsed">Home</span>    
                </div>
            </a>
            
          
            <?php if(in_array('produ',$_SESSION['usuario']['secciones'])){?>
            <a href="ListProd.php" class="bg-dark list-group-item list-group-item-action <?=isset($productsMenu)?'active':''?>">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-question fa-fw mr-3"></span>
                    <span class="menu-collapsed">Productos</span>
                </div>
            </a>
            <?php }?>

            <?php if(in_array('perf',$_SESSION['usuario']['secciones'])){?>
            <a class="<?=isset($perfilMenu)?'active':''?> bg-dark list-group-item list-group-item-action" href="perfiles.php">
            <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-question fa-fw mr-3"></span>
                    <span class="menu-collapsed">Perfiles</span>
                </div>
            </a>
            <?php }?>

            <?php if(in_array('usu',$_SESSION['usuario']['secciones'])){?>
					 <a href="usuarios.php" data-toggle="sidebar-colapse" class="bg-dark list-group-item list-group-item-action d-flex align-items-center <?=isset($userMenu)?'active':''?>">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span id="collapse-icon" class="fa fa-2x mr-3"></span>
                    <span id="collapse-text" class="menu-collapsed">Usuarios</span>
                </div>
            </a>
			  <?php }?>

              <?php if(in_array('coment',$_SESSION['usuario']['secciones'])){?>
              <a href="comentarios.php" class="bg-dark list-group-item list-group-item-action <?=isset($comentariosMenu)?'active':''?>">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-question fa-fw mr-3"></span>
                    <span class="menu-collapsed">Comentarios</span>
                </div>
              </a>
              <?php }?>

              <?php if(in_array('cat',$_SESSION['usuario']['secciones'])){?>
              <a href="categorias.php" class="bg-dark list-group-item list-group-item-action <?=isset($categoriasMenu)?'active':''?>">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-question fa-fw mr-3"></span>
                    <span class="menu-collapsed">Categorias</span>
                </div>
              </a>
              <?php }?>

              <?php if(in_array('marc',$_SESSION['usuario']['secciones'])){?>
              <a href="marcas.php" class="bg-dark list-group-item list-group-item-action <?=isset($marcasMenu)?'active':''?>">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-question fa-fw mr-3"></span>
                    <span class="menu-collapsed">Marcas</span>
                </div>
              </a>
              <?php }?>

        </ul><!-- List Group END-->
    </div><!-- sidebar-container END -->
    
    <!-- MAIN -->
    
    
