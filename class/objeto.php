<?php

Class Usuario{

    /*conexion a la base*/
	private $con;
	
	
	public function __construct($con){
		$this->con = $con;
	}
        /**
        * Obtengo todos los usuarios
        */
	public function getList(){
		$query = "SELECT id_usuario,nombre,apellido,email,usuario,clave,activo 
		           FROM usuarios";
		$resultado = array();
		foreach($this->con->query($query) as $key=>$usuario){
			$resultado[$key] = $usuario;
			$sql = 'SELECT nombre 
					  FROM perfil 
					  INNER JOIN usuarios_perfiles ON (usuarios_perfiles.perfil_id = perfil.id)
					  WHERE usuarios_perfiles.usuario_id = '.$usuario['id_usuario'];
			foreach($this->con->query($sql) as $key2=>$perfil){
				$resultado[$key]['perfiles'][$key2] = $perfil['nombre'];
			}
			
			
		}
			/* echo '<pre>';
			var_dump($resultado);echo '</pre>'; */
            return $resultado; 
	}
	
	/**
	* obtengo un usuario
	*/
	public function get($id){
	    $query = "SELECT id_usuario,nombre,apellido,email,usuario,clave,activo,salt
		           FROM usuarios WHERE id_usuario = ".$id;
        $query = $this->con->query($query); 
			
		$usuario = $query->fetch(PDO::FETCH_OBJ);
			
			$sql = 'SELECT perfil_id
					  FROM usuarios_perfiles  
					  WHERE usuarios_perfiles.usuario_id = '.$usuario->id_usuario;
					  
			foreach($this->con->query($sql) as $key2=>$perfil){
				$usuario->perfiles[$key2] = $perfil['perfil_id'];
			}
			/*echo '<pre>';
			var_dump($usuario);echo '</pre>'; */
            return $usuario;
	}
	
	
	/**
	* Guardo los datos en la base de datos
	*/
	public function save($data){
			$data['salt'] = uniqid();
            // $data['salt'] = md5(date("Y-m-d H:i:s"));
            $data['clave'] = $this->encrypt($data['clave'],$data['salt']);
            
            foreach($data as $key => $value){
				if(!is_array($value)){
					if($value != null){
						$columns[]=$key;
						$datos[]=$value;
					}
				}
            }
            $sql = "INSERT INTO usuarios(".implode(',',$columns).") VALUES('".implode("','",$datos)."')";
            $this->con->exec($sql);
			$id_usuario = $this->con->lastInsertId();
			  			
			$sql = '';
			
			if(!empty($data['perfil'])){
			
				foreach($data['perfil'] as $perfil){
					$sql .= 'INSERT INTO usuarios_perfiles(usuario_id,perfil_id) 
								VALUES ('.$id_usuario.','.$perfil.');';
				}
				 $this->con->exec($sql);
			}
	} 
	
	/**
	* Actualizo los datos en la base de datos
	*/
	public function edit($data){
	    $id = $data['id_usuario'];
	    unset($data['id_usuario']);
		$user = $this->get($id);
		
            if( $data['clave'] != null){
                $data['clave'] = $this->encrypt($data['clave'],$user->salt);
            }else{
                unset($data['clave']);
			}

            foreach($data as $key => $value){
                if($value != null && $key!= 'perfil'){
					$columns[]=$key." = '".$value."'";
					$sql = "UPDATE usuarios SET ".implode(',',$columns)." WHERE id_usuario = ".$id;
            
					$this->con->exec($sql);
                }
			}
			 
			 
			$sql = 'DELETE FROM usuarios_perfiles WHERE usuario_id = '.$id;
			$this->con->exec($sql);
			
			$sql = '';
			if(!empty($data['perfil'])){
			
				foreach($data['perfil'] as $perfil){
					$sql .= 'INSERT INTO usuarios_perfiles(usuario_id,perfil_id) 
								VALUES ('.$id.','.$perfil.');';
				}
				 $this->con->exec($sql);
			}
			
	} 
	
	/**
	* encrypt password
	*/
	
	private function encrypt($clave,$salt){
		
		/* concateno el salt con la clave */
		$clave .= $salt;
		
		/* pongo el salt al medio de la contraseña */
		//$clave = substr($clave,0,strlen($clave)/2).$salt.substr($clave,strlen($clave)/2,strlen($clave));
		
		/* par aobtener la lista de algoritmos de hash usar hash_algos()*/
		//return md5($clave);
		return hash('md5',$clave);
	}
	/**
	* borrado de usuario
	*/
	
        public function del($id){
            $sql = "DELETE FROM usuarios WHERE id_usuario = ".$id;
            $this->con->exec($sql);
        }
		
	
	/**
	* Login de usuario
	*/
	
        public function login($data){

			

            $sql = "SELECT id_usuario,nombre,apellido,email,usuario,clave,activo,salt,direccion
		           FROM usuarios WHERE activo = 1 AND email = '".$data['email']."'";
			$datos = $this->con->query($sql)->fetch(PDO::FETCH_ASSOC);
 			if(isset($datos['id_usuario'])){
				if($this->encrypt($data['clave'],$datos['salt']) == $datos['clave']){
				
					$_SESSION['usuario'] = $datos;
					$query = "SELECT cod FROM secciones
							  INNER JOIN perfil_secciones ON (perfil_secciones.seccion_id = secciones.id)
							  INNER JOIN usuarios_perfiles ON (usuarios_perfiles.perfil_id = perfil_secciones.perfil_id)
							  WHERE usuario_id = ".$datos['id_usuario'];
						  
					$secciones = array();
					foreach($this->con->query($query) as $key => $value){
						$secciones[$key] = $value['cod'];
					}	
						
					$_SESSION['usuario']['secciones'] = $secciones;
				}
				else{
					return 'Error';
				}
			}
			else{
				return 'Error';
			} 
        }
		
		/**
	* Login de usuario
	*/
	
        public function notLogged(){
            if(!isset($_SESSION['usuario'])){
				return true;
			}
			return false;
		}
		
		public function activarUsuario($data){
       
			$id = $data['id_usuario'];
			unset($data['id_usuario']);
			
				foreach($data as $key => $value){
					if($value != null){
						$columns[]=$key." = '".$value."'";
						$sql = "UPDATE usuarios SET ".implode(',',$columns)." WHERE id_usuario = ".$id;
						$this->con->exec($sql);
					}
				}
		}

		public function validarDatos($email,$usuario){
       
			$query = 'SELECT count(1) as cantidad FROM usuarios WHERE email like "'.$email.'"';

			$consulta = $this->con->query($query)->fetch(PDO::FETCH_OBJ);

			$query2 = 'SELECT count(1) as cantidad2 FROM usuarios WHERE usuario like "'.$usuario.'"';
			$consulta2 = $this->con->query($query2)->fetch(PDO::FETCH_OBJ);

			$resp = '';

			if($consulta->cantidad == 1){
				$resp .= 'Email ya registrado';
			}

			if($consulta2->cantidad2 == 1 && $resp!=''){
				$resp .= 'y Usuario ya registrado';
			}
			elseif($consulta2->cantidad2 == 1){
				$resp .= 'Usuario ya registrado';
			}
			return $resp;
		}
}

Class UsuarioTipos{

    /*conexion a la base*/
	private $con;
	
	public function __construct($con){
		$this->con = $con;
	}

	public function getList(){
		$query = "SELECT id_tipo,tipo 
		           FROM usuarios_tipos";
        return $this->con->query($query); 
	}
}


Class Perfil{

    /*conexion a la base*/
	private $con;
	
	public function __construct($con){
		$this->con = $con;
	}

	public function getListPerfil(){
		$query = "SELECT id, nombre 
		           FROM perfil";
        return $this->con->query($query); 
	}
	
	public function delPerfil($id){
		$query = 'SELECT count(1) as cantidad FROM usuarios_perfiles WHERE perfil_id = '.$id;
		$consulta = $this->con->query($query)->fetch(PDO::FETCH_OBJ);
		if($consulta->cantidad == 0){
			$query = "DELETE FROM perfil WHERE id = ".$id;
			return $this->con->exec($query); 
		}
		return 'Perfil asignado a un usuario';
	}
	
	/**
	* Guardo los datos en la base de datos
	*/
	public function savePerfil($data){
		
            foreach($data as $key => $value){
				
				if(!is_array($value)){
					if($value != null){
						$columns[]=$key;
						$datos[]=$value;
					}
				}
            }
            $sql = "INSERT INTO perfil(".implode(',',$columns).") VALUES('".implode("','",$datos)."')";
			
            $this->con->exec($sql);
			$id = $this->con->lastInsertId();
			   			
			$sql = '';
			foreach($data['secciones'] as $secciones){
				$sql .= 'INSERT INTO perfil_secciones(perfil_id,seccion_id) 
							VALUES ('.$id.','.$secciones.');';
			}
			 
 			$this->con->exec($sql);
	} 
	
	
	public function getPerfil($id){
	    $query = "SELECT id,nombre
		           FROM perfil WHERE id = ".$id;
        $query = $this->con->query($query); 
			
		$perfil = $query->fetch(PDO::FETCH_OBJ);
			
			$sql = 'SELECT perfil_id, seccion_id
					  FROM perfil_secciones  
					  WHERE perfil_id = '.$perfil->id;
					  
			foreach($this->con->query($sql) as $key2=>$seccion){
				$perfil->secciones[$key2] = $seccion['seccion_id'];
			}
			/*echo '<pre>';
			var_dump($usuario);echo '</pre>'; */
            return $perfil;
	}
	
	public function editPerfil($data){
			$id = $data['id'];
			unset($data['id']);
            
            foreach($data as $key => $value){
				if(!is_array($value)){
					if($value != null){	
						$columns[]=$key." = '".$value."'"; 
					}
				}
            }
            $sql = "UPDATE perfil SET ".implode(',',$columns)." WHERE id = ".$id;
            
            $this->con->exec($sql);
			
			 
			 
			$sql = 'DELETE FROM perfil_secciones WHERE perfil_id= '.$id;
			$this->con->exec($sql);
			
			$sql = '';
			foreach($data['secciones'] as $secciones){
				$sql .= 'INSERT INTO perfil_secciones(perfil_id,seccion_id) 
							VALUES ('.$id.','.$secciones.');';
			}
			$this->con->exec($sql);
			 
	} 
}

class Marca{

	
	protected $con;
	
	public function __construct($con){
		$this->con = $con;
	}
	
    public function getListMarcas($parametros = array()){

		$query = 'SELECT id_marca,nombre_Marca,activo
                   FROM marcas';

		$resultado = array();
		foreach($this->con->query($query) as $key=>$marca){
			$resultado[$key] = $marca;	
		}
			/* echo '<pre>';
			var_dump($resultado);echo '</pre>'; */
            return $resultado; 
    }

    public function activarMarca($data){
        $id = $data['id_marca'];
        unset($data['id_marca']);
        
            foreach($data as $key => $value){
                if($value != null){
					$columns[]=$key." = '".$value."'";
					$sql = "UPDATE marcas SET ".implode(',',$columns)." WHERE id_marca = ".$id;
            
					$this->con->exec($sql);
                }
			}
    }
    
    public function getMarca($id){
	    $query = "SELECT id_marca, nombre_Marca, activo
		           FROM marcas WHERE id_marca = ".$id;
        $query = $this->con->query($query); 
			
		$marca = $query->fetch(PDO::FETCH_OBJ);
			/*echo '<pre>';
			var_dump($usuario);echo '</pre>'; */
            return $marca;
	}

    public function editMarca($data){
	    $id = $data['id_marca'];
        unset($data['id_marca']);
		
            foreach($data as $key => $value){
                if($value != null){
					$columns[]=$key." = '".$value."'";
					$sql = "UPDATE marcas SET ".implode(',',$columns)." WHERE id_marca = ".$id;
            
					$this->con->exec($sql);
                }
			}
    }
    
    public function delMarca($id){
        $sql = "DELETE FROM marcas WHERE id_marca = ".$id;
        $this->con->exec($sql);
    }

    public function saveMarca($data){
        
        foreach($data as $key => $value){
            if(!is_array($value)){
                if($value != null){
                    $columns[]=$key;
                    $datos[]=$value;
                }
            }
        }
        $sql = "INSERT INTO marcas(".implode(',',$columns).") VALUES('".implode("','",$datos)."')";
        $this->con->exec($sql);
    
    }

	
}

class Comentario{

	
	protected $con;
	
	public function __construct($con){
		$this->con = $con;
	}
	
    public function getListComentarios($parametros = array()){

       

        $orden = array();

        if(isset($parametros['orden'])){

			switch ($parametros['orden']) {
				case "todos":
					$orden[]=' AND 1=1';
					break;
				case "activos":
					$orden[]=' AND activo = 1';
					break;
				case "inactivos":
					$orden[]=' AND activo = 0';
					break;
				default:
				$orden[]='AND 1=1';
			}

        }
        else{
			$orden[]=' AND 1=1';
        }

        if(isset($parametros['id'])){

            $detalle[]=' AND comentarios.producto_id='.$parametros['id'];

        }
        else{
			$detalle[]=' AND 1=1';
        }

        $result= array_merge($orden,$detalle);
        

		$query = 'SELECT comentario_id,comentarios.descripcion,comentarios.ranking_Comentario,fecha,activo,email, productos.nombre, productos.producto_id
                   FROM comentarios,productos
                   WHERE comentarios.producto_id = productos.producto_id'.implode(' ',$result).'
					ORDER BY fecha DESC';

		$resultado = array();
		foreach($this->con->query($query) as $key=>$comentario){
			$resultado[$key] = $comentario;	
		}
			/* echo '<pre>';
			var_dump($resultado);echo '</pre>'; */
            return $resultado; 
    }
    
    public function getComentario($id){
	    $query = "SELECT comentario_id,email,descripcion,ranking_Comentario,fecha,activo
		           FROM comentarios WHERE comentario_id = ".$id;
        $query = $this->con->query($query); 
			
		$comentario = $query->fetch(PDO::FETCH_OBJ);
			/*echo '<pre>';
			var_dump($usuario);echo '</pre>'; */
            return $comentario;
    }
    
    public function guardarComentario($data){

		$ip = $data['ip'];
		$fecha = $data['fecha'];

		$query = 'SELECT count(1) as cantidad FROM comentarios WHERE ip = '.'"'.$ip.'"'.' AND comentarios.fecha = '.'"'.$fecha.'"';


		$consulta = $this->con->query($query)->fetch(PDO::FETCH_OBJ);
		
		if($consulta->cantidad == 0){

			foreach($data as $key => $value){
				if(!is_array($value)){
					if($value != null){
						$columns[]=$key;
						$datos[]=$value;
					}
				}
			}
			$sql = "INSERT INTO comentarios(".implode(',',$columns).") VALUES('".implode("','",$datos)."')";
			return $this->con->exec($sql);
		}
    
    }

    public function del($id){
        $sql = "DELETE FROM comentarios WHERE comentario_id = ".$id;
        $this->con->exec($sql);
    }
    
    public function activarComentario($data){
        $id = $data['comentario_id'];
	    unset($data['comentario_id']);
        $comentario = $this->getComentario($id);

            foreach($data as $key => $value){
                if($value != null){
					$columns[]=$key." = '".$value."'";
					$sql = "UPDATE comentarios SET ".implode(',',$columns)." WHERE comentario_id = ".$id;
					$this->con->exec($sql);
                }
			}
	}

	
}



class Categoria{

	
	protected $con;
	
	public function __construct($con){
		$this->con = $con;
	}
	
    public function getListCategorias($parametros = array()){


		if(!empty($_GET['categoria_id'])){
			$categoria = ' AND categoria_id = '.$parametros['categoria_id'];
		}
		else{
			$categoria = '';
		}
			

        if($parametros['padre_id'] != 1){

            $query = 'SELECT categoria_id,nombre_Cat,padre_id,inactivo
            FROM categorias
            WHERE padre_id = 0'.$categoria;
        }
        else{
            $query = 'SELECT categoria_id,nombre_Cat,padre_id,inactivo
            FROM categorias
            WHERE padre_id != 0';
        }

	

		$resultado = array();
		foreach($this->con->query($query) as $key=>$comentario){
			$resultado[$key] = $comentario;	
		}
            return $resultado; 
    }

    public function getListHijos($parametros = array()){

		
		$query = 'SELECT categoria_id,nombre_Cat,padre_id,inactivo
                   FROM categorias
                   WHERE padre_id='.$parametros;

		$resultado = array();
		foreach($this->con->query($query) as $key=>$comentario){
			$resultado[$key] = $comentario;	
		}
            return $resultado; 
    }

	public function getPrincipal($parametros = array()){

		
		$query = 'SELECT categoria_id,nombre_Cat,padre_id,inactivo
                   FROM categorias
                   WHERE inactivo = 0 AND padre_id='.$parametros;

		$resultado = array();
		foreach($this->con->query($query) as $key=>$comentario){
			$resultado[$key] = $comentario;	
		}
            return $resultado; 
    }

	public function esPrincipal($cat){

	    $query = 'SELECT count(1) as cantidad
                   FROM categorias
                   WHERE padre_id=0 AND categoria_id ='.$cat;
		
		$consulta = $this->con->query($query)->fetch(PDO::FETCH_OBJ);

		if($consulta->cantidad == 0){
			return false; 
		}
		return true;
	}

	public function getListSubcat($parametro){

		$query = 'SELECT categoria_id, nombre_Cat,padre_id,inactivo
                   FROM categorias
                   WHERE padre_id='.$parametro;

		$resultado = array();
		foreach($this->con->query($query) as $key=>$comentario){
			$resultado[$key] = $comentario;	
		}
            return $resultado; 
    }


    public function activarCategoria($data){
       
        $id = $data['categoria_id'];
        unset($data['categoria_id']);
        
            foreach($data as $key => $value){
                if($value != null){
					$columns[]=$key." = '".$value."'";
					$sql = "UPDATE categorias SET ".implode(',',$columns)." WHERE categoria_id = ".$id;
					$this->con->exec($sql);
                }
			}
    }
    
    public function getCategoria($id){
	    $query = "SELECT categoria_id, nombre_Cat, inactivo,padre_id
		           FROM categorias WHERE categoria_id = ".$id;
        $query = $this->con->query($query); 
			
		$marca = $query->fetch(PDO::FETCH_OBJ);
			/*echo '<pre>';
			var_dump($usuario);echo '</pre>'; */
            return $marca;
    }

    public function editCategoria($data){
	
	    $id = $data['categoria_id'];
        unset($data['categoria_id']);
		
            foreach($data as $key => $value){
               
                if(!is_array($value)){
                    if($value != null){
                        $columns[]=$key." = '".$value."'";
                        $sql = "UPDATE categorias SET ".implode(',',$columns)." WHERE categoria_id = ".$id;
						
                        $this->con->exec($sql);
                    }
                }
                else{
                    foreach($value as $key => $val){
					
					$sql = "UPDATE categorias SET padre_id=$val WHERE categoria_id = ".$id;
            
                    $this->con->exec($sql);
			        }
                    
                }
			}
    }
    
    public function delCategoria($id){
        $sql = "DELETE FROM categorias WHERE categoria_id = ".$id;
        $this->con->exec($sql);
    }

    public function saveCategoria($data){
        
        
        foreach($data as $key => $value){
            
            if(!is_array($value)){
                if($value != null){
                    $columns[]=$key;
                    $datos[]=$value;
                }
            }
           
        }
        $sql = "INSERT INTO categorias(".implode(',',$columns).") VALUES('".implode("','",$datos)."')";
        $this->con->exec($sql);

        $id = $this->con->lastInsertId();
         
        if(isset($data['padre_id'])){
            $arr = $data['padre_id'];

            foreach($arr as $key => $value){
               
               if($value != null){
   
                   $sql = "UPDATE categorias SET padre_id=$value WHERE categoria_id = ".$id;
           
                   $this->con->exec($sql);
               }
           }
        }
    
    }

    public function getListCat(){
		$query = "SELECT categoria_id, nombre_Cat, padre_id
		           FROM categorias";
        return $this->con->query($query); 
	}

	public function getCategoriaProd($parametros = array()){

		if($parametros['padre_id'] == 0){

			$padre[] = ' AND categorias.padre_id = '.$parametros['padre_id'];
		}

		else{
			$padre[] = ' AND categorias.padre_id != 0';
		}

		if(!empty($parametros['producto_id'])){

			$padre[] .= ' AND productos_categorias.producto_id = '.$parametros['producto_id'];
		}

		else{
			$padre[] .= ' AND 1=1';
		}

		$query = "SELECT *
		           FROM productos";
		$resultado = array();
		foreach($this->con->query($query) as $key=>$producto){
			$resultado[$key] = $producto;

				$sql = 'SELECT categorias.categoria_id, nombre_Cat, padre_id 
					  FROM categorias 
					  INNER JOIN productos_categorias ON (productos_categorias.categoria_id = categorias.categoria_id)
					  WHERE productos_categorias.producto_id = '.$producto['producto_id'].implode(' ',$padre);
					  
					
			foreach($this->con->query($sql) as $key2=>$categoria){
				$resultado[$key]['categorias'][$key2] = $categoria['nombre_Cat'];
			}

		}
            return $resultado; 
	}
	

	
}

class Compra{

	protected $con;
	
	public function __construct($con){
		$this->con = $con;
	}

	public function guardarVenta($data){
  
        foreach($data as $key => $value){
            if(!is_array($value)){
                if($value != null){
                    $columns[]=$key;
                    $datos[]=$value;
                }
            }
        }
        $sql = "INSERT INTO ventas(".implode(',',$columns).") VALUES('".implode("','",$datos)."')";

	try{
		$this->con->exec($sql);
		$respuesta = $this->con->lastInsertId();
	}
	catch(PDOException $e){
		$respuesta = 0;
	}

	return $respuesta;
        
    }

	public function guardarDetalle($data){
		
		foreach($data as $key => $value){
            if(!is_array($value)){
                if($value != null){
                    $columns[]=$key;
                    $datos[]=$value;
                }
            }
        }
        $sql = "INSERT INTO detalle_venta(".implode(',',$columns).") VALUES('".implode("','",$datos)."')";

		try{
			$this->con->exec($sql);
		}
		catch(PDOException $e){

		}

	}

	public function mostrarVenta($parametros = array()){

		
		if(!empty($parametros['enCurso'])){

			if($parametros['enCurso'] == 'si'){
				$est = 0;
			}
			else{
				$est = 1;
			}

			$estado = ' WHERE estado = '.$est.' order by fecha desc';
		}
		else{
			$estado = ' order by fecha desc';
		}

		$query = "SELECT id_venta, id_cliente, envio, total, fecha, estado
		           FROM ventas".$estado;

        return $this->con->query($query);
	}

	public function actualizar($estado,$venta){

		$sql = "UPDATE ventas SET estado=$estado WHERE id_venta = ".$venta;
           
		$this->con->exec($sql);
	}

	public function getDetalleVenta($venta){

		$query = 'SELECT detalle_venta.id_venta, detalle_venta.id_producto, productos.nombre, productos.descripcion, detalle_venta.cantidad
		FROM detalle_venta
		INNER JOIN productos on (detalle_venta.id_producto = productos.producto_id)
		WHERE detalle_venta.id_venta = '.$venta;

		return $this->con->query($query);	
	}

	public function getCliente($venta){

		$query = 'SELECT usuarios.nombre, usuarios.apellido, usuarios.usuario, usuarios.direccion
		FROM ventas
		INNER JOIN usuarios on (ventas.id_cliente = usuarios.id_usuario)
		WHERE ventas.id_venta = '.$venta;

		return $this->con->query($query);	
	}
}

?>
