<?php

require_once "conexion.db.php";

class ModelCamas{
	

	/*=============================================
	MOSTRAR CAMAS
	=============================================*/
	static public function mdlMostrarCama($tabla, $item, $valor) {

		if ($item != null) {
			
			$stmt = Conexion::connectPostgres()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetch();

		} 

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR CAMAS
	=============================================*/	
	static public function mdlMostrarSalaCamas($tabla, $item, $valor) {

		if ($item != null) {
			
			$stmt = Conexion::connectPostgres()->prepare("SELECT * FROM $tabla WHERE $item = :$item AND estado_cama = 0 ORDER BY id ASC");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR CAMAS
	=============================================*/	
	static public function mdlMostrarCamas($tabla, $item, $valor) {

		if ($item != null) {
			
			$stmt = Conexion::connectPostgres()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetchAll();

		} else {

			$stmt = Conexion::connectPostgres()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	REGISTRO DE NUEVA CAMA
	=============================================*/
	static public function mdlNuevaCama($tabla, $datos) { 

		$pdo = Conexion::connectPostgres();

		$sql = "INSERT INTO $tabla(nombre_cama,descripcion_cama,id_sala) VALUES (:nombre_cama,:descripcion_cama,:id_sala)";

		$stmt = $pdo->prepare($sql);

		$stmt->bindParam(":nombre_cama", $datos["nombre_cama"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_cama", $datos["descripcion_cama"], PDO::PARAM_STR);
    $stmt->bindParam(":id_sala", $datos["id_sala"], PDO::PARAM_INT); 

		if ($stmt->execute()) {
			
			return $pdo->lastInsertId();	

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	REGISTRO DE EDITAR CAMA
	=============================================*/
	static public function mdlEditarCama($tabla, $datos) { 

		$pdo = Conexion::connectPostgres();

		$sql = "UPDATE $tabla SET nombre_cama = :nombre_cama, descripcion_cama = :descripcion_cama, id_sala = :id_sala WHERE id = :id";

		$stmt = $pdo->prepare($sql);

		$stmt->bindParam(":nombre_cama", $datos["nombre_cama"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_cama", $datos["descripcion_cama"], PDO::PARAM_STR);
    $stmt->bindParam(":id_sala", $datos["id_sala"], PDO::PARAM_INT);
    $stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT); 

		if ($stmt->execute()) {
			
			return "ok";	

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

}