<?php

require_once "conexion.db.php";

class ModelDepartamentos {
	
	/*=============================================
	MOSTRAR DEPARTAMENTOS
	=============================================*/
	static public function mdlMostrarDepartamentos($tabla, $item, $valor) {

		if ($item != null) {
			
			$stmt = Conexion::connectPostgres()->prepare("SELECT * FROM  $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();

		} else {

			$stmt = Conexion::connectPostgres()->prepare("SELECT * FROM  $tabla ORDER BY id ASC");

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR DEPARTAMENTOS TRANS EXTERNA
	=============================================*/
	static public function mdlMostrarDepartamentosTransExterna($tabla, $item, $valor) {

		if ($item != null) {

			$sql = "SELECT * FROM $tabla WHERE $item <> :$item";
			
			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

}    