<?php
include_once('inc/header.php');

?> 

<div class="container-fluid">
      
      <?php $userMenu = 'Usuarios';
	include_once('inc/side_bar.php');
	
	
	   if(!in_array('usu',$_SESSION['usuario']['secciones'])){
				header('Location: panel.php');
			}
	
	$perfil = new Perfil($con); 
	
	if(isset($_GET['edit'])){
        if((!empty($_GET['edit']))){
            $usuario = $user->get($_GET['edit']); 
            $titulo = 'Editar Usuario'; 
        }
        else{
            $titulo = 'Nuevo Usuario';
        }
    }
    else{
            $titulo = 'Nuevo Usuario';
    }
	?>
	  
	  
        
        <div class="col-sm-9 col-md-10 main">
          
          <!--toggle sidebar button-->
          
          
	      <div class="row">

            <div class="col-4"></div>
            <div>
                <h1 class="page-header text-center subtitulo ml-5" style="padding-left:30px;">
                    <?=$titulo;?>
                </h1>
            </div>        

          </div>

    <div class="row">

        <div class="col-3"></div>

        <div class="col-6 card my-3 border border-secondary shadow"  style="border-radius: 15px; background: -webkit-linear-gradient(rgb(37, 45, 78),rgb(80, 155, 216));">
        <div class="card-header text-center py-2 m-0 pase" style="border-top-right-radius: 15px;border-top-left-radius: 15px;">
            <img src="images/logovino.png" alt="logo" class="img-fluid" width="70">
        </div>
        <div class="card-body">    
  
            <form action="usuarios.php" method="post" class="from-horizontal">

             <div class="row">
                <div class="form-group col-6">
                    <label for="nombre" class="col control-label text-center" style="color:rgb(243, 234, 234);font-family:Arial;font-size:17px;">Nombre</label>
                    <div class="col">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" value="<?=isset($usuario->nombre)?$usuario->nombre:'';?>">
                    </div>
                </div> 
                 <div class="form-group col-6">
                    <label for="apellido" class="col control-label  text-center" style="color:rgb(243, 234, 234);font-family:Arial;font-size:17px;">Apellido</label>
                     <div class="col">
                        <input type="text" class="form-control" id="apellido" name="apellido" placeholder="" value="<?=isset($usuario->apellido)?$usuario->apellido:'';?>">
                    </div>
                </div> 

             </div>
                
             <div class="row">

                 <div class="form-group col">
                    <label for="usuario" class="col control-label text-center" style="color:rgb(243, 234, 234);font-family:Arial;font-size:17px;">Usuario</label>
                     <div class="col">
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="" value="<?=isset($usuario->usuario)?$usuario->usuario:'';?>">
                    </div>
                </div> 
                 <div class="form-group col">
                    <label for="calve" class="col control-label text-center" style="color:rgb(243, 234, 234);font-family:Arial;font-size:17px;">Clave</label>
                     <div class="col">
                        <input type="password" class="form-control" id="clave" name="clave" placeholder="" <?=isset($usuario->usuario)?'':'required';?>>
                    </div>
                </div>
             </div>
             
             <div class="row">
                
                 <div class="col-2"></div>
                 <div class="form-group col-8">
                    <label for="email" class="col control-label text-center" style="color:rgb(243, 234, 234);font-family:Arial;font-size:17px;">e-Mail</label>
                     <div class="col">
                        <input type="email" class="form-control" id="email" name="email" placeholder="" value="<?=isset($usuario->email)?$usuario->email:'';?>" required>
                    </div>
                </div> 

            </div>   
                <div class="form-group">
                    <label for="tipo" class="col control-label text-center" style="color:rgb(243, 234, 234);font-family:Arial;font-size:17px;">Perfil</label>
                    <div class="col text-center">
                        <select name="perfil[]" id="perfil" multiple='multiple' >
                            <?php foreach($perfil->getListPerfil() as $t){?>
                                <option value="<?=$t['id']?>" 
								<?php
									if(isset($usuario->perfiles)){
										if(in_array($t['id'],$usuario->perfiles)){
											echo ' selected="selected" ';
										}
									}
								
								?>><?=$t['nombre']?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                 
                <div class="form-group">
                    <div class="col text-center">
                    <div class="checkbox">
                        <label style="color:rgb(243, 234, 234);font-family:Arial;font-size:17px;">
                        <input type="radio" name="activo" value="1" <?=(isset($usuario->activo)?(($usuario->activo == 1) ?'checked':''):'');?>> Activo
                        </label>
                        <label style="color:rgb(243, 234, 234);font-family:Arial;font-size:17px;">
                        <input class="ml-2" type="radio" name="activo" value="0" <?=(isset($usuario->activo)?(($usuario->activo == 0) ?'checked':''):'');?>> Inactivo
                        </label>
                    </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    <div class="col">
                    <button type="submit" class="btn btn-default  bg-dark" name="submit" style="color:rgb(243, 234, 234);font-family:Arial;font-size:17px;">Guardar</button>
                    </div>
                </div> 
                <input type="hidden" class="form-control" id="id_usuario" name="id_usuario" placeholder="" value="<?=isset($usuario->id_usuario)?$usuario->id_usuario:'';?>">

            </form>
        </div>
    </div>

</div>
 
          
      </div><!--/row-->
	</div>
</div><!--/.container-->

<?php include('inc/footer.php');?>