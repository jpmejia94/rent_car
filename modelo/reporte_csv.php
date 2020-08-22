<?php
ini_set('memory_limit', '3000M');
set_time_limit(3000);

require_once('conexion.php');
$ConnMySQL = NULL;
$ConnMySQL = new MySQL();

$fecha_inicio = $_GET["fecha_inicio"];
$fecha_fin = $_GET["fecha_fin"];

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
                       
                       $datos = $ConnMySQL->ExecuteQuery($consulta,NULL,1);

    if (count($datos) > 0) {
    $nombre_archivo = "reporte.csv";
    $encabezados = "Usuario;Email;Tipo documento;Documento;Vehiculo;Placa;Modelo;Disponibilidad;Valor;Fecha inicio;Fecha fin;Valor Total;Medio de pago";
    $llaves = array(
        "nombre",
        "email",
        "tipo_doc",
        "documento",
        "titulo",
        "placa",
        "modelo",
        "disponibilidad",
        "valor",
        "fecha_ini",
        "fecha_fin",
        "valor_tot",
        "med_pago"
    );
    
    /*Se llama el metodo que comprime el archivo. Los argumentos son:
    1: nombre del archivo zip
    2: nombre del archivo que se va a comprimir
    3: Encabezado del archivo que se va a comprimir
    4: Datos que va conterner el archivo que se va a comprimir (es un arreglo)
    5: Llave de los datos
    */
    echo "\xEF\xBB\xBF";
    $ConnMySQL->comprimir_archivo("reporte", $nombre_archivo, $encabezados, $datos, $llaves);
}
?>