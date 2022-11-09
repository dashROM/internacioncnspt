<?php

require_once "conexion.db.php";

class ModelEstablecimientos {
	
	/*=============================================
	MOSTRAR ESTABLECIMIENTOS
	=============================================*/
	static public function mdlMostrarEstablecimientos($tabla, $item, $valor) {

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
	MOSTRAR ESTABLECIMIENTOS REFERENCIA
	=============================================*/
	static public function mdlMostrarEstablecimientosReferencia($tabla, $item, $valor) {

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

	/*=============================================
	REGISTRO DE ESTABLECIMIENTOS
	=============================================*/

	static public function mdlNuevoEstablecimiento($tabla, $datos) { 

		$stmt = Conexion::connectPostgres()->prepare("INSERT INTO $tabla(nombre_establecimiento,abrev_establecimiento, ubicacion_establecimiento) VALUES (:nombre_establecimiento,:abrev_establecimiento,:ubicacion_establecimiento)");

		$stmt->bindParam(":nombre_establecimiento", $datos["nombre_establecimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":abrev_establecimiento", $datos["abrev_establecimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":ubicacion_establecimiento", $datos["ubicacion_establecimiento"], PDO::PARAM_STR);
		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}
	/*=============================================
	EDITAR ESTABLECIMIENTOS
	=============================================*/

	static public function mdlEditarEstablecimiento($tabla, $datos) {

		$stmt = Conexion::connectPostgres()->prepare("UPDATE $tabla SET nombre_establecimiento=:nombre_establecimiento, abrev_establecimiento=:abrev_establecimiento, ubicacion_establecimiento=:ubicacion_establecimiento
		 WHERE idestablecimiento = :idestablecimiento");
		
		$stmt->bindParam(":nombre_establecimiento", $datos["nombre_establecimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":abrev_establecimiento", $datos["abrev_establecimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":ubicacion_establecimiento", $datos["ubicacion_establecimiento"], PDO::PARAM_STR);
	    $stmt->bindParam(":idestablecimiento", $datos["idestablecimiento"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR ESTABLECIMIENTOS
	=============================================*/

	static public function mdlActualizarEstablecimiento($tabla, $item1, $valor1, $item2, $valor2) {

		$stmt = Conexion::connectPostgres()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}
}    