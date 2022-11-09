<?php

require_once "conexion.db.php";

class ModelCie10{
	
	/*=============================================
	MOSTRAR DATOS DE DIAGNOSTICO BUSCADO CIE10
	=============================================*/
	static public function mdlMostrarDiagnosticoCie10($tabla, $item, $valor) {

		if ($item != null) {

			$sql = "SELECT id, CONCAT(codigo,' - ',descripcion) diagnostico FROM $tabla WHERE (codigo ILIKE '%$valor%') OR (descripcion ILIKE '%$valor%')";
			
			$stmt = Conexion::connectPostgres()->prepare($sql);

			// $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();

		} else {

			$stmt = Conexion::connectPostgres()->prepare("SELECT * FROM  $tabla ORDER BY id DESC");

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	NUMERO DE COLUMNAS DE DIAGNOSTICO BUSCADO CIE10
	=============================================*/
	static public function mdlMostrarColumnasCie10($tabla, $item, $valor) {

		if ($item != null) {

			$sql = "SELECT count(id) FROM $tabla WHERE (codigo LIKE '%$valor%') OR (descripcion LIKE '%$valor%')";
			
			$stmt = Conexion::connectPostgres()->prepare($sql);

			// $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();

		} else {

			$stmt = Conexion::connectPostgres()->prepare("SELECT * FROM  $tabla ORDER BY id DESC");

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

}