<?php
require_once('conexion.php');

class RentCar{
	
	private $ConnMySQL = NULL;
	private $ruta ='../assets/images/publicaciones/';
		
	public function __construct(){
		$this->ConnMySQL = new MySQL();
	}

	// INICIO VISTA PRINCIPAL
	
	public function cargar_contenido($items_por_pagina,$numero_pagina,$buscador){

		$condicion = "";
		$condicion2 = "";
		
		if($numero_pagina !=  1){
		    $condicion2 = ($items_por_pagina * ($numero_pagina - 1));
		}else{
			$condicion2 = 0;
		}		
		if($buscador != ""){
			$condicion.=" AND titulo LIKE '%$buscador%' OR modelo LIKE '%$buscador%' ";
		}

		$sql = "SELECT COUNT(*) AS cantidad FROM vehiculos WHERE disponibilidad = 1 $condicion";
		$res = $this->ConnMySQL->ExecuteQuery($sql,NULL,0);
		$total = $res['cantidad'];			                          
			 
		$num_paginado = ceil($total / $items_por_pagina);
	
		$consulta = "SELECT 
						v.id,
						v.titulo,
						v.placa,
						v.color,
						v.anio,
						v.modelo,
						v.valor,
						v.disponibilidad,
						img.imagen,
						img.orden,
						$num_paginado AS num_paginador,
						$total AS total_registros
					FROM vehiculos v
				LEFT JOIN img_vehiculos img ON v.id = img.id_vehiculo AND img.orden = 1
					WHERE v.disponibilidad = 1 $condicion
					LIMIT $items_por_pagina
					OFFSET $condicion2";					 					 
							
		return  $this->ConnMySQL->ExecuteQuery($consulta,NULL,1);			
	}	

	public function slider(){

		$sql = "SELECT COUNT(id) AS total FROM slider WHERE estado = 1 ";
		$res = $this->ConnMySQL->ExecuteQuery($sql,NULL,0);
		$total = $res['total'];	

		$consulta = "SELECT id,imagen,$total AS total_registros FROM slider WHERE estado = 1";
		return $this->ConnMySQL->ExecuteQuery($consulta,NULL,1);
	}


	public function cargar_imagenes($id){
		
		$consulta ="SELECT img_v.id, img_v.imagen, img_v.orden FROM img_vehiculos img_v WHERE img_v.id_vehiculo = $id";					   
		return  $this->ConnMySQL->ExecuteQuery($consulta,NULL,1);
		
	}

	public function guardar_form($id_pub,$nombre,$apellido,$email,$t_doc,$documento,$t_pago,$f_ini_prod,$f_fin_prod){		

		$consulta = "INSERT INTO solicitud_renta (nombre,apellido,email,tipo_doc,documento,med_pago,fecha_ini,fecha_fin,id_vehiculo) 
						  VALUES (?,?,?,?,?,?,?,?,?)";
		$datos =  $this->ConnMySQL->ExecuteInsert_LastInsert_rowCount($consulta, array($nombre,$apellido,$email,$t_doc,$documento,$t_pago,$f_ini_prod,$f_fin_prod,$id_pub));

		if(!$datos){
			return 1;
		}else{
			return 0;
		}
	}

	public function login($user, $password){

		$consulta = "SELECT user, password FROM usuarios WHERE user = '$user' AND password = '$password'";
		$datos =  $this->ConnMySQL->ExecuteQuery($consulta,NULL,0);

		if(!$datos){
			return 1;
		}else{
			return 0;
		}
	}

	//FIN VISTA PRINCIPAL

	//INICIO CPANEL

	public function cargar_tabla(){
		
		$consulta = "SELECT 
							v.id,
							v.titulo,
							v.placa,
							v.color,
							v.anio,
							v.modelo,
							CONCAT('$',' ', CONVERT(FORMAT(v.valor, 0, 'de_DE') USING utf8)) AS valor,						
							v.disponibilidad,
							img.imagen,
							img.orden
					   FROM vehiculos v
				  LEFT JOIN img_vehiculos img ON v.id = img.id_vehiculo AND img.orden = 1 ";

		$datos =  $this->ConnMySQL->ExecuteQuery($consulta,NULL,1);

		return array("data" => $datos);
	}

	public function guardar_datos($titulo,$placa,$modelo,$valor,$anio,$color,$imagen1,$imagen2,$imagen3,$imagen4){          
		
		$error = 0;

		$consulta = "INSERT INTO vehiculos (titulo,placa,modelo,valor,anio,color,disponibilidad) 
						  VALUES(?,?,?,?,?,?,?)";
		$datos =  $this->ConnMySQL->ExecuteInsert_LastInsert_rowCount($consulta, array($titulo,$placa,$modelo,$valor,$anio,$color,1));

		if(!$datos){
			$error = 1;
		}else{
			$consulta_id = "SELECT MAX(id) AS id FROM vehiculos";
			$datos_id = $this->ConnMySQL->ExecuteQuery($consulta_id,NULL,0);
			 $id_registro = $datos_id['id'];					
                 if(isset($imagen1) && !empty($imagen1)){
                    $nom_img1 = $imagen1["name"];
                    $type_img1 = $imagen1["type"];
                    $tem_img1 = $imagen1["tmp_name"];
					$consulta_img1 = "INSERT INTO img_vehiculos(imagen,orden,id_vehiculo) VALUES (?,?,?)";
					$datos_img1 =  $this->ConnMySQL->ExecuteInsert_LastInsert_rowCount($consulta_img1, array($nom_img1,1,$id_registro));                    
                    move_uploaded_file($tem_img1, $this->ruta.$nom_img1);
                    if(!$datos_img1){
                        $error = 1;
                     }
                 }                 
                 if(isset($imagen2) && !empty($imagen2)){
                    $nom_img2 = $imagen2["name"];
                    $type_img2 = $imagen2["type"];
					$tem_img2 = $imagen2["tmp_name"];
					$consulta_img2 = "INSERT INTO img_vehiculos(imagen,orden,id_vehiculo) VALUES (?,?,?)";
					$datos_img2 =  $this->ConnMySQL->ExecuteInsert_LastInsert_rowCount($consulta_img2, array($nom_img2,2,$id_registro)); 
                    move_uploaded_file($tem_img2, $this->ruta.$nom_img2);
                    if(!$datos_img2){
                        $error = 1;
                     }
                 }
                 if(isset($imagen3) && !empty($imagen3)){
                    $nom_img3 = $imagen3["name"];
                    $type_img3 = $imagen3["type"];
					$tem_img3 = $imagen3["tmp_name"];
					$consulta_img3 = "INSERT INTO img_vehiculos(imagen,orden,id_vehiculo) VALUES (?,?,?)";
					$datos_img3 =  $this->ConnMySQL->ExecuteInsert_LastInsert_rowCount($consulta_img3, array($nom_img3,3,$id_registro)); 
                    move_uploaded_file($tem_img3, $this->ruta.$nom_img3);
                    if(!$datos_img3){
                        $error = 1;
                     }
                 }
                 if(isset($imagen4) && !empty($imagen4)){
                    $nom_img4 = $imagen4["name"];
                    $type_img4 = $imagen4["type"];
					$tem_img4 = $imagen4["tmp_name"];
					$consulta_img4 = "INSERT INTO img_vehiculos(imagen,orden,id_vehiculo) VALUES (?,?,?)";
					$datos_img4 =  $this->ConnMySQL->ExecuteInsert_LastInsert_rowCount($consulta_img4, array($nom_img4,4,$id_registro)); 
                    move_uploaded_file($tem_img4, $this->ruta.$nom_img4);
                    if(!$datos_img4){
						$error = 1;
                     }
                 }
            }
        if($error == 0){                
            return 0;
        }else{                
            return 1;
        }         
	}
	
	public function obtener_datos($id){

		$consulta = "SELECT id, titulo, placa, color, anio, modelo, valor, disponibilidad FROM vehiculos WHERE id = $id";
		return $this->ConnMySQL->ExecuteQuery($consulta,NULL,0);
	}

	public function eliminar_img($id,$eli_img,$id_img,$id_img2){
        
        $response = 0;
        $condicion = "";        

        if($eli_img == 1 || $eli_img == 2){
            $condicion .="SET orden = 2 WHERE id= $id_img"; 
        }if($eli_img == 2){
            $sql = "UPDATE img_vehiculos SET orden = 3 WHERE id= $id_img2"; 
            $res = $this->ConnMySQL->ExecuteUpdateRow($sql, NULL);
        }if($eli_img == 3){
            $condicion .="SET orden = 3 WHERE id= $id_img"; 
        }

        $sql_f ="UPDATE img_vehiculos $condicion";        
        $res_f = $this->ConnMySQL->ExecuteUpdateRow($sql_f, NULL);

        $consulta = "DELETE FROM img_vehiculos WHERE id = '$id'";
        $datos = $this->ConnMySQL->ExecuteQuery($consulta,NULL,0);       
        if(!$datos){
            $response = 1;
        }

        return $response;
	}

	public function subir_img($id_pub,$imagen2_edit,$imagen3_edit,$imagen4_edit){

        $error = 0;

        if(isset($imagen2_edit) && !empty($imagen2_edit)){
            $nom_img2 = $imagen2_edit["name"];
            $type_img2 = $imagen2_edit["type"];
            $tem_img2 = $imagen2_edit["tmp_name"];
            $consulta_img2 = "INSERT INTO img_vehiculos(imagen,orden,id_vehiculo)VALUES(?,?,?)";
            $datos_img2 = $this->ConnMySQL->ExecuteInsert_LastInsert_rowCount($consulta_img2, array($nom_img2,2,$id_pub)); 
            move_uploaded_file($tem_img2, $this->ruta.$nom_img2);
            if(!$datos_img2){
                $error = 1;
             }
         }                 
         if(isset($imagen3_edit) && !empty($imagen3_edit)){
            $nom_img3 = $imagen3_edit["name"];
            $type_img3 = $imagen3_edit["type"];
            $tem_img3 = $imagen3_edit["tmp_name"];
            $consulta_img3 = "INSERT INTO img_vehiculos(imagen,orden,id_vehiculo)VALUES(?,?,?)";
            $datos_img3 = $this->ConnMySQL->ExecuteInsert_LastInsert_rowCount($consulta_img3, array($nom_img3,3,$id_pub)); 
            move_uploaded_file($tem_img3, $this->ruta.$nom_img3);
            if(!$datos_img3){
                $error = 1;
             }
         }                 
         if(isset($imagen4_edit) && !empty($imagen4_edit)){
            $nom_img4 = $imagen4_edit["name"];
            $type_img4 = $imagen4_edit["type"];
            $tem_img4 = $imagen4_edit["tmp_name"];
            $consulta_img4 = "INSERT INTO img_vehiculos(imagen,orden,id_vehiculo)VALUES(?,?,?)";
            $datos_img4 = $this->ConnMySQL->ExecuteInsert_LastInsert_rowCount($consulta_img4, array($nom_img4,4,$id_pub)); 
            move_uploaded_file($tem_img4, $this->ruta.$nom_img4);
            if(!$datos_img4){
                $error = 1;
             }
         }

        return $error;        
	}
	
	public function editar_datos($id_update,$titulo,$placa,$modelo,$valor,$anio,$color,$imagen1){        
   
        $error = 0;

		$consulta = "UPDATE vehiculos SET titulo = '$titulo', placa = '$placa',color = '$color',anio = '$anio',modelo = '$modelo',valor = '$valor' WHERE id = $id_update";		
		$datos = $this->ConnMySQL->ExecuteUpdateRow($consulta, NULL);
		  
        if(isset($imagen1) && !empty($imagen1)){
			$nom_img1 = $imagen1["name"];
			$type_img1 = $imagen1["type"];
			$tem_img1 = $imagen1["tmp_name"];
			$consulta_img1 = "UPDATE img_vehiculos SET imagen = '$nom_img1' WHERE id_vehiculo = $id_update AND orden = 1";						
			$datos_img1 = $this->ConnMySQL->ExecuteUpdateRow($consulta_img1, NULL);
			move_uploaded_file($tem_img1, $this->ruta.$nom_img1);
			}                                                                        
		return 0;     
	}

	public function cambiar_estado ($id, $estado) {    		
		       
        $consulta = "UPDATE vehiculos SET disponibilidad = $estado WHERE id = $id";     
        $datos = $this->ConnMySQL->ExecuteUpdateRow($consulta, NULL);        

        return 0;
	}
	
	public function eliminar($id){

		$consulta = "DELETE FROM vehiculos WHERE id = $id";		
		$datos = $this->ConnMySQL->ExecuteQuery($consulta,NULL,0);
		
		$consulta_img = "DELETE FROM img_vehiculos WHERE id_vehiculo = $id";		
		$datos_img = $this->ConnMySQL->ExecuteQuery($consulta_img,NULL,1);		

		return 0;
	}

	// FIN CPANEL

	// INICIO REPORTE
	
	public function consultar($fecha_inicio,$fecha_fin){

		$condicion = "";

		if($fecha_inicio != ""){
			$condicion .= "AND fecha_ini >= '$fecha_inicio'";
		}if($fecha_fin != ""){
			$condicion .= "AND fecha_fin <= '$fecha_fin'";
		}

		$consulta = "SELECT 
							sr.id,
							CONCAT(sr.nombre,' ',sr.apellido) AS nombre,
							sr.email,
							CASE                                
								WHEN sr.tipo_doc = 1 THEN 'Cedula Ciudadania'
								WHEN sr.tipo_doc = 2 THEN 'Cedula Extranjeria'
								WHEN sr.tipo_doc = 3 THEN 'Nit'
								WHEN sr.tipo_doc = 4 THEN 'Nuip'
								WHEN sr.tipo_doc = 5 THEN 'Pasaporte'
								WHEN sr.tipo_doc = 6 THEN 'Registro Civil'                                 
							END tipo_doc,
							sr.documento,
							IF(sr.med_pago = 1, 'Efectivo', 'Tarjeta Crédito / Débito') AS med_pago,
							sr.fecha_ini,
							sr.fecha_fin,
							IF(v.titulo IS NULL, 'N/A', v.titulo) AS titulo,
							IF(v.placa IS NULL, 'N/A', v.placa) AS placa,	
							IF(v.modelo IS NULL, 'N/A', v.modelo) AS modelo,
							IF(v.disponibilidad = 1, 'Disponible', 'No disponible') AS disponibilidad,
							IF(v.valor IS NULL, 'N/A',CONVERT(FORMAT(v.valor, 0, 'de_DE') USING UTF8)) AS valor,                            
							IF(v.valor IS NULL, 'N/A',CONVERT(FORMAT((DATEDIFF(sr.fecha_fin,sr.fecha_ini) * v.valor), 0, 'de_DE') USING UTF8)) AS valor_tot
					FROM solicitud_renta sr
					LEFT JOIN vehiculos v ON v.id = sr.id_vehiculo
					   WHERE 1 $condicion";

		$datos = $this->ConnMySQL->ExecuteQuery($consulta,NULL,1);

		return array("data" => $datos);

	}
	
	//FIN REPORTE
}