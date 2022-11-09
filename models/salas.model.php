<?php

require_once "conexion.db.php";

class ModelSalas {
	
	/*=============================================
	MOSTRAR SALAS
	=============================================*/
	static public function mdlMostrarSalas($tabla, $item, $valor) {

		if ($item != null) {

			$sql = "SELECT * FROM $tabla WHERE $item = :$item";
			
			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetchAll();

		} else {

			$stmt = Conexion::connectPostgres()->prepare("SELECT s.idsala, e.idespecialidad, e.nombre_especialidad,s.descripcion  FROM  sala s, especialidades e where e.idespecialidad = s.idespecialidad  ORDER BY idsala DESC");

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	} 

	/*=============================================
	REGISTRO DE SALAS
	=============================================*/
	static public function mdlNuevoSalas($tabla, $datos) {

		$pdo = Conexion::connectPostgres();

		$sql = "INSERT INTO $tabla(nombre_sala, descripcion_sala, id_servicio) VALUES (:nombre_sala, :descripcion_sala, :id_servicio)";

		$stmt = $pdo->prepare($sql);

		$stmt->bindParam(":nombre_sala", $datos["nombre_sala"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_sala", $datos["descripcion_sala"], PDO::PARAM_STR);
		$stmt->bindParam(":id_servicio", $datos["id_servicio"], PDO::PARAM_INT);
	
		if ($stmt->execute()) {

			return $pdo->lastInsertId();

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

}