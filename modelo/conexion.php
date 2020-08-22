<?php
class MySQL{
	private
		$Server = 'localhost',
		$Port = 3306,
		$dbName = 'rent_car',
		$UserName = 'root',
		$Password = '',
		$Conn = NULL;
		
		
	public function Connect(){
		try{
			$this->Conn = new PDO(
				"mysql:host=$this->Server;port=$this->Port;dbname=$this->dbName",
				$this->UserName,
				$this->Password,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
			);
			$this->Conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $Ex){
			echo $Ex->getMessage();
		}
		return $this->Conn;
	}
	
	public function ExecuteQuery($Sql, $Parameters, $Type){
		try{
			$Conn = $this->Connect();
			$Stmt = $Conn->prepare($Sql);
			$Stmt->execute($Parameters);
			
			if($Type == 0){
				$Rset = $Stmt->fetch(PDO::FETCH_ASSOC);
			}
			else{
				$Rset = $Stmt->fetchAll(PDO::FETCH_ASSOC);
			}
		}
		catch(PDOException $Ex){
			echo $Ex->getMessage();
		}
		return $Rset;
	}
	

	public function ExecuteInsert($Sql, $Parameters){
		try{
			$Conn = $this->Connect();
			$Stmt = $Conn->prepare($Sql);
			$Stmt->execute($Parameters);
		}
		catch(PDOException $Ex){
			echo $Ex->getMessage();
		}
		return $Conn->lastInsertId();
	}
	
	public function ExecuteInsertrowCount($Sql, $Parameters){
		try{
			$Conn = $this->Connect();
			$Stmt = $Conn->prepare($Sql);
			$Stmt->execute($Parameters);
		}
		catch(PDOException $Ex){
			echo $Ex->getMessage();
		}
		return $Stmt->rowCount();
	}
	
	public function ExecuteInsert_LastInsert_rowCount($Sql, $Parameters){
		
		try{
			$Conn = $this->Connect();
			$Stmt = $Conn->prepare($Sql);
			$Stmt->execute($Parameters);
		}
		catch(PDOException $Ex){
			echo $Ex->getMessage();
		}
		 $row = $Stmt->rowCount();
		 $id  = $Conn->lastInsertId();
		 
		 return array($row,$id);		           
	}	
	
	public function ExecuteUpdate($Sql, $Parameters){
		try{
			$Conn = $this->Connect();
			$Stmt = $Conn->prepare($Sql);
			$Stmt->execute($Parameters);
		}
		catch(PDOException $Ex){
			echo $Ex->getMessage();
		}
		return $Conn->lastInsertId();
	}
	
	public function ExecuteUpdateRow($Sql, $Parameters){
		try{
			$Conn = $this->Connect();
			$Stmt = $Conn->prepare($Sql);
			$Stmt->execute($Parameters);
		}
		catch(PDOException $Ex){
			echo $Ex->getMessage();
		}
		return $Stmt->rowCount();
	}
	
	public function comprimir_archivo ($nombre_zip, $nombre_archivo, $encabezado, $datos, $llaves) {
		//Recibe el nombre del archivo csv
		$archivo = $nombre_archivo;
	
		//Inicia la creacion del archivo
		$ar = fopen($archivo, "w") or die("1");
	
		fwrite($ar, $encabezado);
	
		//Recorre los datos
		if (count($datos) > 0) {
		for ($i = 0; $i < count($datos); $i ++) {
			fwrite($ar, "\n");
	
			//Recorre la llave de los datos
			for ($j = 0; $j < count($llaves); $j ++) {
			fwrite($ar, $datos[$i][$llaves[$j]].";");
			}
		}
		}
	
		//Se cierra la creación del archivo
		fclose($ar);
	
		$size = filesize($archivo);// En byte
		$byte = 1000000;// 1 megabyte
		$megabyte = round($size / $byte, 1);
	
		if ($megabyte >= 10) {
		//Se crea el objeto zip
		$zip = new ZipArchive();
	
		$filename = $nombre_zip;
	
		if ($zip->open($filename, ZIPARCHIVE::CREATE) === true) {
			$zip->addFile($archivo);
			$zip->close();
		} else {
			echo 'Error creando '.$filename;
		}
	
		if (file_exists($filename)) {
			//Se descarga el archivo zip
			header("Content-Encoding: UTF-8");
			header('Content-type: "application/zip"');
			header('Content-Disposition: attachment; filename="'.$filename.'.zip"');
	
			readfile($filename);
	
			//Se borra el archivo zip
			unlink($filename);
		}
		} else {      
		header("Content-Encoding: UTF-8");
		header("Content-type: text/csv; charset=UTF-8");
		header("Content-Disposition: attachment; filename=".$archivo.";");		  
		readfile($archivo);
		}
	
		//Se borra el archivo CSV que se genera dentro del modulo
		unlink($archivo);
	}
}

?>