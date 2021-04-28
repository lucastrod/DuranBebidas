<?php

function generar_categorias($padre_id, $con,$data)
    {  


            $query = "SELECT * FROM categorias WHERE inactivo = 0 ";
            $resultado = $con->query($query); 
            while ( $row = $resultado->fetch(PDO::FETCH_ASSOC))
                {
					$menu_array[$row["categoria_id"]] = array("categoria_id" => $row["categoria_id"],"nombre_Cat" => $row["nombre_Cat"],"padre_id" => $row["padre_id"],"orden"=>'',"pais" => '');
                }

                $algo='';

                if(isset($data['marca'])){
                    $algo='&marca='.$data['marca'];
                    if(isset($data['orden'])){
                        $algo.='&orden='.$data['orden'];
                    }
                }
                elseif(isset($data['orden'])){
                    $algo = '&orden='.$data['orden'];
                }    

            foreach($menu_array as $key => $value)
                {
                    if ($value["padre_id"] == $padre_id) 
                        {    
                            if($padre_id == 0)
                            
                            {echo '<a href="productos.php?cat='.$value["categoria_id"].$algo.'">'.$value['nombre_Cat']."<br>". "</a>";
                             generar_categorias($key,$con,$data);
                            }
                        else 
                            {echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".'<a href="productos.php?cat='.$value["categoria_id"].'">' . $value['nombre_Cat']."<br>"."</a>";
                             generar_categorias($key,$con,$data);
                            }
                          
                        }
						
						
                }
    }


    function generar_marcas($data,$con)
    {  
        
        $query = "SELECT id_marca,nombre_Marca FROM marcas WHERE activo = 1 ";
            $resultado = $con->query($query); 

        $algo='cat=';

        if(isset($data['cat'])){
            $algo.=$data['cat'];
            if(isset($data['orden'])){
                $algo.='&orden='.$data['orden'];
            }
        }

        elseif(isset($data['orden'])){
            $algo = 'orden='.$data['orden'];
        }
            foreach($resultado as $key => $value)
                {

                    echo '<a href="productos.php?'.$algo.'&marca='.$value["id_marca"].'">'.utf8_encode($value['nombre_Marca'])."<br>". "</a>";
						
                }
    }

    function chequearImagen($producto){

        if(file_exists("file_sitio/$producto/0.png"))
             return  "file_sitio/$producto/0.png";
         else
             return null;
     }

     function moverImagen($imagen,$nombre){

        move_uploaded_file($imagen["tmp_name"],RUTA_IMAGENES."$nombre/0.png");
    }
    

?>