<?php

class Producto{

	
	protected $con;
	
	public function __construct($con){
		$this->con = $con;
	}

	public function getListProductos($parametros = array()){

		if(isset($parametros['cat'])){

			if($parametros['cat'] != ''){

				$where = ' AND categorias.categoria_id = '.$parametros['cat'];
			}
			else{
				$where = ' AND categorias.categoria_id  BETWEEN 1 AND 24';
			}
		}
		else{	
			
			$where= ' AND categorias.categoria_id BETWEEN 1 AND 24';
		}

	if(isset($parametros['padre_id'])){

		if($parametros['padre_id'] == 0){

			$padre[] = ' AND categorias.padre_id = '.$parametros['padre_id'].$where;
		}

		else{
			$padre[] = ' AND categorias.padre_id != 0'.$where;
		}

	}
	else{	
		
		$padre[] = ' AND categorias.padre_id = 0'.$where;
	}

		$sql = 'SELECT DISTINCT productos_categorias.producto_id,productos.modelo,productos.inactivo,productos.precio,productos.ranking,nombre,descripcion,destacado,id_marca,nombre_Cat,padre_id
				FROM productos, categorias, productos_categorias
				WHERE productos_categorias.producto_id = productos.producto_id AND productos_categorias.categoria_id = categorias.categoria_id'.implode(' ',$padre);

				
				   
				   $resultado = array();
				   foreach($this->con->query($sql) as $key=>$producto){
					   $resultado[$key] = $producto;
					 
		   
				   }
					   return $resultado;
	}

	public function getListCatProd($parametros = array()){

		if($parametros['padre_id'] == 0){

			$padre[] = ' AND categorias.padre_id = '.$parametros['padre_id'];
		}

		else{
			$padre[] = ' AND categorias.padre_id != 0';
		}

		$query = 'SELECT productos.producto_id,modelo,productos.inactivo,precio,ranking,nombre,descripcion,destacado,id_marca,productos.categoria_id, categorias.categoria_id, nombre_Cat,padre_id
		FROM productos, categorias, productos_categorias
		WHERE productos_categorias.categoria_id = categorias.categoria_id AND productos_categorias.producto_id = productos.producto_id AND productos_categorias.producto_id = '.$parametros['producto_id'].implode(' ',$padre);
		
				   
		$resultado = array();
		foreach($this->con->query($query) as $key=>$producto){
			$resultado[$key] = $producto;

		}
            return $resultado; 
	}

	public function getListSubcat($parametros = array()){
		
		

		$query = 'SELECT categoria_id, nombre_Cat,padre_id,inactivo
                   FROM categorias
                   WHERE padre_id='.$parametros;

		$resultado = array();
		foreach($this->con->query($query) as $key=>$comentario){
			$resultado[$key] = $comentario;	
		}
            return $resultado; 
    }

	
	public function obtenerListado($data = array()){
	
		$where =  array();
		if(isset($data['id'])){
			$where[] = ' AND producto_id = '.$data['id'];
		}
		
		if(isset($data['destacado'])){
			$where[] = ' AND destacado = TRUE ';
		}

		else {
			$where[] = ' AND 1 = 1 ';
		}
			
		$query = 'SELECT producto_id, 
						 nombre, 
						 modelo, 
						 descripcion,
						 inactivo,
						 destacado,
						 ranking,
						 precio,
						 productos.id_marca,
						 marcas.nombre_Marca 
					FROM productos,marcas
					WHERE productos.id_marca = marcas.id_marca'.implode(' ',$where).'
					ORDER BY ranking DESC, rand()';
		if(isset($data['limit'])){
			$query .= ' LIMIT '.$data['limit'];
		}

	

	
		try{
			$resultado =  $this->con->query($query)->fetchAll(PDO::FETCH_OBJ); //objetos
		}catch(PDOException $e){
			$resultado = 'error en la consulta'.$e->getMessage();
		}
		return $resultado;
	
	    //return $this->con->query($query)->fetchAll(PDO::FETCH_ASSOC); // array asociativo
		//return $this->con->query($query); // Puntero a la consulta
	}
	
	public function obtenerCat($parametros = array()){
		
	
		$where = array();
		$orden = '';
		$marca= ' AND 1=1';

		
		if(isset($parametros['marca'])){

			
			if($parametros['marca']>0){
				$marca= ' AND productos.id_marca = '.$parametros['marca'];
			}
		}

		else{
			$marca= ' AND 1=1';
		}

		$query = 'SELECT count(1) as cantidad FROM categorias WHERE padre_id = 0';
		$consulta = $this->con->query($query)->fetch(PDO::FETCH_OBJ);


		if(isset($parametros['cat'])){

			if($parametros['cat'] != ''){

				if($parametros['cat'] <= $consulta->cantidad){
					$where[] = ' AND productos.inactivo = 0 '.$marca.' AND categorias.padre_id = '.$parametros['cat'];
				}
				else {
					$where[] = ' AND productos.inactivo = 0 AND productos_categorias.categoria_id = '.$parametros['cat'].$marca;
				}
			}
			elseif(isset($parametros['marca']))
			{
				$where[] = 'AND productos.inactivo = 0 AND productos_categorias.categoria_id  BETWEEN 1 AND 100'.$marca;
			}
			else{
				$where[] = 'AND productos.inactivo = 0 AND productos_categorias.categoria_id  BETWEEN 1 AND 100';
			}
		}
		else{	
			
			$where[] = 'AND productos.inactivo = 0 AND productos_categorias.categoria_id BETWEEN 1 AND 100'.$marca;
		}

		if(isset($parametros['orden'])){

			switch ($parametros['orden']) {
				case "AZ":
					$orden=' productos.nombre';
					break;
				case "ZA":
					$orden=' productos.nombre DESC';
					break;
				case "destacados":
					$orden=' productos.destacado DESC';
					break;
				case "ranking":
					$orden=' ranking DESC';
					break;	
				default:
				$orden=' rand()';
			}
			
		}
		else{
			$orden=' productos.destacado DESC';
		}
		

		
		$query = 'SELECT DISTINCT productos.producto_id, 
						 nombre, 
						 productos.id_marca,
						 destacado,
						 precio,
						 ranking,
						 productos.categoria_id,
						 categorias.padre_id 
					FROM productos, productos_categorias, marcas, categorias
					WHERE 1=1 AND productos_categorias.producto_id = productos.producto_id AND productos.id_marca = marcas.id_marca AND marcas.activo = 1 AND productos_categorias.categoria_id = productos.categoria_id AND productos_categorias.categoria_id = categorias.categoria_id AND categorias.inactivo = 0 AND categorias.padre_id IN (SELECT categoria_id FROM categorias WHERE inactivo = 0) AND productos.categoria_id = categorias.categoria_id '.implode("",$where).'
					ORDER BY'.$orden;
				
					
		try{
			$resultado = $this->con->query($query)->fetchAll(PDO::FETCH_OBJ); //objetos
		}catch(PDOException $e){
			$resultado = 'error en la consulta'.$e->getMessage();
		}
		return $resultado;
	    //return $this->con->query($query)->fetchAll(PDO::FETCH_ASSOC); // array asociativo
		//return $this->con->query($query); // Puntero a la consulta
	}



	public function actualizarRanking($data = array()){

		$id='';
	 
		if($data['producto_id'] > 0){

			$id = $data['producto_id'];

				$query = 'SELECT  round(avg(ranking_Comentario),0) as Promedio
					FROM comentarios
					WHERE comentarios.activo = 1 AND comentarios.producto_id ='. $id;
		}
		else {
		}

		foreach ($this->con->query($query) as $key => $value) {
			if($value['Promedio'] != 0){
				$sql = 'UPDATE productos SET ranking ='.$value['Promedio'].' WHERE producto_id = '.$id;	
			}
			else {
				$sql = 'UPDATE productos SET ranking = 0 WHERE producto_id = '.$id;
			}
			
		}		
		$this->con->exec($sql);
	 
	}

	public function activarProducto($data){
       
		$id = $data['producto_id'];
		unset($data['producto_id']);
		
			foreach($data as $key => $value){
				if($value != null){
					$columns[]=$key." = '".$value."'";
					$sql = "UPDATE productos SET ".implode(',',$columns)." WHERE producto_id = ".$id;
					$this->con->exec($sql);
				}
			}
	}

	public function editarProducto($data){
		
	    $id = $data['producto_id'];
        unset($data['producto_id']);
		
            foreach($data as $key => $value){
                if($value != null && $key!= 'categorias'){
					$columns[]=$key." = '".$value."'";
					$sql = "UPDATE productos SET ".implode(',',$columns)." WHERE producto_id = ".$id;
					$this->con->exec($sql);
                }
			}		
					 					 
			$sql = 'DELETE FROM productos_categorias WHERE producto_id = '.$id;
			$this->con->exec($sql);

			$query = 'SELECT count(1) as cantidad FROM categorias WHERE padre_id = 0';
			$consulta = $this->con->query($query)->fetch(PDO::FETCH_OBJ);
					
			$sql = '';
			if(!empty($data['categorias'])){
					
				foreach($data['categorias'] as $categoria){
					$sql .= 'INSERT INTO productos_categorias(producto_id,categoria_id) 
										VALUES ('.$id.','.$categoria.');';
					if($categoria > $consulta->cantidad){
						
						$sql .= "UPDATE productos SET categoria_id = $categoria WHERE producto_id = ".$id;
					}
				}
						 $this->con->exec($sql);
			}
					
			
    }
    
    public function delProducto($id){
	
		
		$query = 'SELECT count(1) as cantidad FROM productos_categorias WHERE producto_id = '.$id;
		$consulta = $this->con->query($query)->fetch(PDO::FETCH_OBJ);

		if($consulta->cantidad == 0){
			$query = "DELETE FROM productos WHERE producto_id = ".$id;
			return $this->con->exec($query); 
		}
		else{
			$query = "DELETE FROM productos_categorias WHERE producto_id = ".$id;
			$this->con->exec($query);
			$sql = "DELETE FROM productos WHERE producto_id = ".$id;
			return $this->con->exec($sql);
		}
		
		return 'Producto asignado a una categoria';
	}
	

    public function saveProducto($data){

        foreach($data as $key => $value){
            if(!is_array($value)){
                if($value != null){
                    $columns[]=$key;
                    $datos[]=$value;
                }
            }
        }
        $sql = "INSERT INTO productos(".implode(',',$columns).") VALUES('".implode("','",$datos)."')";
		$this->con->exec($sql);
		$id_producto = $this->con->lastInsertId();

		$sql = '';
		
		if(!empty($data['categorias'])){
			
			foreach($data['categorias'] as $categoria){
				$sql .= 'INSERT INTO productos_categorias(producto_id,categoria_id) 
							VALUES ('.$id_producto.','.$categoria.');';
			}
			
			 $this->con->exec($sql);
		}

		return $id_producto;
	}
	
	public function getProducto($id){
	    $query = "SELECT productos.producto_id,modelo,inactivo,precio,ranking,nombre,descripcion,destacado,marcas.id_marca,marcas.nombre_Marca, productos_categorias.categoria_id, marcas.activo
				   FROM productos, marcas, productos_categorias WHERE productos_categorias.producto_id = productos.producto_id AND productos.id_marca = marcas.id_marca AND productos.producto_id = ".$id;
				 
        $query = $this->con->query($query); 
			
		$producto = $query->fetch(PDO::FETCH_OBJ);

		
			$sql = 'SELECT categoria_id
					  FROM productos_categorias  
					  WHERE productos_categorias.producto_id = '.$producto->producto_id;
					  
			foreach($this->con->query($sql) as $key2=>$categoria){
				$producto->categorias[$key2] = $categoria['categoria_id'];
			}

        return $producto;
	}

	public function chequearProducto($id){
		$query = 'SELECT count(1) as cantidad FROM productos, marcas, categorias WHERE productos.producto_id ='.$id.' AND productos.id_marca = marcas.id_marca AND productos.categoria_id = categorias.categoria_id AND (marcas.activo = 0 OR productos.inactivo = 1 OR categorias.inactivo = 1 OR categorias.padre_id IN (SELECT categoria_id FROM categorias WHERE inactivo = 1))';

		$consulta = $this->con->query($query)->fetch(PDO::FETCH_OBJ);
		
		if($consulta->cantidad == 0){
			return 1; 
		}
		else{
			return 'Producto Inactivo';
		}	
	}

	public function getActivoPadre($id){
	    $query = 'SELECT count(1) as cantidad FROM productos, categorias WHERE productos.producto_id ='.$id.' AND productos.categoria_id = categorias.categoria_id AND categorias.padre_id IN (SELECT categoria_id FROM categorias WHERE inactivo = 1)';
				 
		$consulta = $this->con->query($query)->fetch(PDO::FETCH_OBJ);
		
		if($consulta->cantidad == 0){
			return 1; 
		}
		else{
			return 'Padre Inactivo';
		}
	}
	
	
}

?>