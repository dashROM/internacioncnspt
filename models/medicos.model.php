<?php

require_once "conexion.db.php";

class ModelMedicos {
	
	/*=============================================
	MOSTRAR MEDICOS
	=============================================*/
	
	static public function mdlMostrarMedicos($tabla, $item, $valor) {

		if ($item != null) {

			$sql = "SELECT * FROM  $tabla WHERE $item = :$item";
			
			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();

		} else {

			$sql = "SELECT m.id, m.nombre_medico, m.paterno_medico, m.materno_medico, m.matricula_medico, m.direccion_medico, m.telefono_medico, m.clave_medico, e.nombre_especialidad 
			FROM medicos m
			LEFT join especialidades e
			ON m.id_especialidad = e.id
			ORDER BY m.id DESC";

			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	REGISTRO DE NUEVO MEDICO
	=============================================*/
	static public function mdlNuevoMedico($tabla, $datos) { 

		$sql = "INSERT INTO $tabla(nombre_medico, paterno_medico, materno_medico, matricula_medico, prefijo_medico, id_especialidad, direccion_medico, telefono_medico) 
		VALUES (:nombre_medico,:paterno_medico,:materno_medico,:matricula_medico,:prefijo_medico, :id_especialidad, :direccion_medico,:telefono_medico)";

		$stmt = Conexion::connectPostgres()->prepare($sql);

		$stmt->bindParam(":nombre_medico", $datos["nombre_medico"], PDO::PARAM_STR);
		$stmt->bindParam(":paterno_medico", $datos["paterno_medico"], PDO::PARAM_STR);
		$stmt->bindParam(":materno_medico", $datos["materno_medico"], PDO::PARAM_STR);
		$stmt->bindParam(":matricula_medico", $datos["matricula_medico"], PDO::PARAM_STR);
		$stmt->bindParam(":prefijo_medico", $datos["prefijo_medico"], PDO::PARAM_STR);
		$stmt->bindParam(":id_especialidad", $datos["id_especialidad"], PDO::PARAM_INT);
		$stmt->bindParam(":direccion_medico", $datos["direccion_medico"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono_medico", $datos["telefono_medico"], PDO::PARAM_STR);
	
		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}
	/*=============================================
	EDITAR MEDICOS
	=============================================*/
	static public function mdlEditarMedico($tabla, $datos) {

		$stmt = Conexion::connectPostgres()->prepare("UPDATE $tabla SET prefijo_medico = :prefijo_medico, id_especialidad = :id_especialidad,paterno_medico = :paterno_medico, materno_medico = :materno_medico, 
		nombre_medico = :nombre_medico, matricula_medico = :matricula_medico, direccion_medico = :direccion_medico, telefono_medico = :telefono_medico WHERE id = :id");
		
		$stmt->bindParam(":prefijo_medico", $datos["prefijo_medico"], PDO::PARAM_STR);
		$stmt->bindParam(":id_especialidad", $datos["id_especialidad"], PDO::PARAM_INT);
		$stmt->bindParam(":paterno_medico", $datos["paterno_medico"], PDO::PARAM_STR);
		$stmt->bindParam(":materno_medico", $datos["materno_medico"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_medico", $datos["nombre_medico"], PDO::PARAM_STR);
		$stmt->bindParam(":matricula_medico", $datos["matricula_medico"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion_medico", $datos["direccion_medico"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono_medico", $datos["telefono_medico"], PDO::PARAM_STR);
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