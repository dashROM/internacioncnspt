<?php

require_once "conexion.db.php";

class ModelServicios {
	
	/*=============================================
	MOSTRAR SERVICIOS
	=============================================*/
	static public function mdlMostrarServicios($tabla, $item, $valor) {

		if ($item != null) {
			
			$stmt = Conexion::connectPostgres()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();

		} else {

			$stmt = Conexion::connectPostgres()->prepare("SELECT s.id, s.nombre_servicio, s.id_establecimiento, e.nombre_establecimiento FROM servicios s, establecimientos e WHERE e.id = s.id_establecimiento ORDER BY s.id ASC");

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR SERVICIOS
	=============================================*/
	static public function mdlFiltrarMostrarServicios($tabla, $item, $valor) {

		if ($item != null) {

			$sql = "SELECT * FROM $tabla WHERE $item != :$item";
			
			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	REGISTRO DE NUEVO SERVICIO
	=============================================*/
	static public function mdlNuevoServicio($tabla, $datos) { 

		$stmt = Conexion::connectPostgres()->prepare("INSERT INTO $tabla(nombre_especialidad) VALUES (:nombre_especialidad)");

		$stmt->bindParam(":nombre_especialidad", $datos["nombre_especialidad"], PDO::PARAM_STR);
	
		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}
}    