<?php

require_once "conexion.db.php"; 
 
class ModelTipoUsuarios {

	/*=============================================
	LISTADO DE TIPO DE USUARIOS
	=============================================*/
	
	static public function mdlMostrarTipoUsuarios($tabla) {


		$stmt = Conexion::connectPostgres()->prepare("SELECT * FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

    }   

}