<?php

require_once "conexion.db.php"; 
 
class ModelDiagnosticos {


	/*=============================================
	BUSCAR DIAGNOSTICO
	=============================================*/
	
	static public function mdlBuscarDiagnosticos($tabla) {


		$stmt = Conexion::conect()->prepare("SELECT * FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

    }   

}
	