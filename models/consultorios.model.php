<?php

require_once "conexion.db.php";

class ModelConsultorios{

	/*=============================================
	MOSTRAR CAMAS
	=============================================*/	
	static public function mdlMostrarConsultorios($tabla, $item, $valor) {

		if ($item != null) {
			
			$stmt = Conexion::connectPostgres()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetchAll();

		} else {

			$stmt = Conexion::connectPostgres()->prepare("SELECT * FROM $tabla WHERE id_tipo_servicio <> 4 ORDER BY id ASC");

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	REGISTRO DE NUEVA CAMA
	=============================================*/

	static public function mdlNuevoConsultorio($tabla, $datos) { 

	}

}