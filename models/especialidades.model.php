<?php

require_once "conexion.db.php";

class ModelEspecialidades {
	
	/*=============================================
	MOSTRAR ESPECIALIDADES
	=============================================*/
	static public function mdlMostrarEspecialidades($tabla, $item, $valor) {

		if ($item != null) {

			$sql = "SELECT * FROM $tabla WHERE $item = :$item";
			
			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetchAll();

		} else {

			$sql = "SELECT * FROM $tabla";
			
			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	} 

	/*=============================================
	MOSTRAR SERVICIO ESPECIALIDADES
	=============================================*/
	static public function mdlMostrarServicioEspecialidades($tabla, $item1, $valor1, $item2, $valor2) {

		if ($valor2 != null) {

			$sql = "SELECT * FROM $tabla WHERE $item1 = :$item1 AND $item2 <> :$item2";
			
			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_INT);
			$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetchAll();

		} else {

			$sql = "SELECT * FROM $tabla WHERE $item1 = :$item1";
			
			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetchAll();
			
		}

		$stmt->close();
		$stmt = null;

	} 

}