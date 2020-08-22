<?php 
require_once('../modelo/modelo.php');
$modelo = new RentCar();

try {
	$variables = $_POST;
	$tipo_res = "";
	$response = null;

if(!isset($_POST['accion'])){echo "0"; return;} // Evita que ocurra un error si no manda accion.
	$accion = trim($variables['accion']);

switch($accion){	

	//INICIO VISTA PRINCIPAL
	case 'cargar_contenido':
		$tipo_res = "JSON";	
		$items_por_pagina = $variables['items_por_pagina'];
		$numero_pagina = $variables['numero_pagina'];
		$buscar = $variables['buscar'];
		$response = $modelo->cargar_contenido($items_por_pagina,$numero_pagina,$buscar);
	break; 

	case 'slider':
		$tipo_res = 'JSON'; 
		$response = $modelo->slider();
	break;

	case 'cargar_imagenes': 
		$tipo_res = 'JSON'; 
		$id = $variables["id"];
		$response = $modelo->cargar_imagenes($id);
	break;

	case 'guardar_form':
		$tipo_res = 'JSON';
		$id_pub = $variables['id_pub'];
		$nombre = $variables['nombre'];
		$apellido = $variables['apellido'];
		$email = $variables['email'];
		$t_doc = $variables['t_doc'];
		$documento = $variables['documento'];
		$t_pago = $variables['t_pago'];
		$f_ini_prod = $variables['f_ini_prod'];
		$f_fin_prod = $variables['f_fin_prod'];
		$response = $modelo->guardar_form($id_pub,$nombre,$apellido,$email,$t_doc,$documento,$t_pago,$f_ini_prod,$f_fin_prod);
	break;

	case 'login': 
		$tipo_res = 'JSON'; 
		$user = $variables["user"];
		$password = $variables["password"];
		$response = $modelo->login($user,$password);
	break;

	// FIN VISTA PRINCIPAL

	//INICIO CPANEL

	case 'cargar_tabla':
		$tipo_res = 'JSON'; //Definir tipo de respuesta;
		$response = $modelo->cargar_tabla();
	break;

	case "guardar_datos":
		$tipo_res = "JSON";            
		$titulo = $variables['titulo'];
		$placa = $variables['placa'];
		$modelo_car = $variables['modelo'];
		$valor = $variables['valor'];
		$anio = $variables['anio'];
		$color = $variables['color'];
		$imagen1 = array();
		$imagen2 = array();
		$imagen3 = array();
		$imagen4 = array();

		if(isset($_FILES["imagen1"])){
			$imagen1 = $_FILES["imagen1"];
		}
		if(isset($_FILES["imagen2"])){
			$imagen2 = $_FILES["imagen2"];
		}
		if(isset($_FILES["imagen3"])){
			$imagen3 = $_FILES["imagen3"];
		}
		if(isset($_FILES["imagen4"])){
		$imagen4 = $_FILES["imagen4"];
		}        		
		$response = $modelo->guardar_datos($titulo,$placa,$modelo_car,$valor,$anio,$color,$imagen1,$imagen2,$imagen3,$imagen4);
	break;

	case 'obtener_datos': 
		$tipo_res = 'JSON';
		$id = $variables["id"];
		$response = $modelo->obtener_datos($id);
	break;

	case 'eliminar_img':
		$tipo_res = 'JSON';
		$id = $variables['id'];
		$eli_img = $variables['eli_img'];
		$id_img = $variables['id_img'];
		$id_img2 = $variables['id_img2'];
		$response = $modelo->eliminar_img($id,$eli_img,$id_img,$id_img2);
	break;

	case 'subir_img': 
		$tipo_res = 'JSON'; 
		$id_pub = $variables["id_pub"];        
		$imagen2_edit = array();
		$imagen3_edit = array();
		$imagen4_edit = array();

		if(isset($_FILES["imagen2_edit"])){
			$imagen2_edit = $_FILES["imagen2_edit"];
		}
		if(isset($_FILES["imagen3_edit"])){
			$imagen3_edit = $_FILES["imagen3_edit"];
		}
		if(isset($_FILES["imagen4_edit"])){
		$imagen4_edit = $_FILES["imagen4_edit"];
		}
		$response = $modelo->subir_img($id_pub,$imagen2_edit,$imagen3_edit,$imagen4_edit);
	break;

	case "editar_datos":
		$tipo_res = 'JSON';              
		$id_update = $variables['id_update'];
		$titulo = $variables['titulo'];
		$placa = $variables['placa'];
		$modelo_edit = $variables['modelo'];
		$valor = $variables['valor'];
		$anio = $variables['anio'];
		$color = $variables['color'];     
		$imagen1 = array();		

		if(isset($_FILES["imagen1_edit"])){
			$imagen1 = $_FILES["imagen1_edit"];
		}
		$response = $modelo->editar_datos($id_update,$titulo,$placa,$modelo_edit,$valor,$anio,$color,$imagen1);
	break;

	case "cambiar_estado":
		$tipo_res = "JSON";
		$id = $variables["id"];
		$estado = $variables["estado"];
		$response = $modelo->cambiar_estado($id, $estado);		
	break;

	case "eliminar":
		$tipo_res = "JSON";
		$id = $variables["id"];	
		$response = $modelo->eliminar($id);		
	break;

	// FIN CPANEL

	//INICIO REPORTE

	case "consultar":
		$tipo_res = 'JSON';              
		$fecha_inicio = $variables['fecha_inicio'];
		$fecha_fin = $variables['fecha_fin'];
		$response = $modelo->consultar($fecha_inicio,$fecha_fin);
	break;

	//FIN REPORTE		
}

	// respuesta del controlador
	if ($tipo_res == "JSON") {
		// $response será un arreglo con los datos de nuestra respuesta
		echo json_encode ($response, true);
	} else if ($tipo_res == "HTML") {
		// $response será un html con el string de nuestra respuesta
		echo $response;
	}
	} catch (Exception $e) {}      
?>