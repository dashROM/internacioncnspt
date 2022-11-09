<?php

require_once "conexion.db.php";

class ModelPacientes {

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA PACIENTES
	=============================================*/
	static public function mdlContarPacientes($tabla) {

		// devuelve el numero de registros de la consulta
		$sql = "SELECT p.id, p.nombre_paciente, p.paterno_paciente, p.materno_paciente, p.documento_ci, p.fecha_nacimiento, p.estado_civil, p.sexo, p.cod_asegurado, p.cod_beneficiario, p.nro_empleador, p.nombre_empleador, p.estado_asegurado, c.nombre_consultorio 
			FROM pacientes p
			LEFT JOIN consultorios C
			ON c.id = p.id_consultorio
			WHERE p.eliminado = 0";

		$stmt = Conexion::connectPostgres()->prepare($sql);

		$stmt->execute();

		return $stmt->rowCount();

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA PACIENTES FILTRADO
	=============================================*/
	static public function mdlContarFiltradoPacientes($tabla, $sql) {

		if($sql == "") {

			// devuelve el numero de registros de la consulta

			$sql2 = "SELECT p.id, p.nombre_paciente, p.paterno_paciente, p.materno_paciente, p.documento_ci, p.fecha_nacimiento, p.estado_civil, p.sexo, p.cod_asegurado, p.cod_beneficiario, p.nro_empleador, p.nombre_empleador, p.estado_asegurado, c.nombre_consultorio 
			FROM pacientes p
			LEFT JOIN consultorios C
			ON c.id = p.id_consultorio
			WHERE p.eliminado = 0";

			$stmt = Conexion::connectPostgres()->prepare($sql2);

			$stmt->execute();

			$cuenta_col = $stmt->rowCount();

			return $cuenta_col;

		} else {

			// devuelve el numero de registros de la consulta

			$sql2 = "SELECT p.id, p.nombre_paciente, p.paterno_paciente, p.materno_paciente, p.documento_ci, p.fecha_nacimiento, p.estado_civil, p.sexo, p.cod_asegurado, p.cod_beneficiario, p.nro_empleador, p.nombre_empleador, p.estado_asegurado, c.nombre_consultorio 
			FROM pacientes p
			LEFT JOIN consultorios C
			ON c.id = p.id_consultorio
			WHERE p.eliminado = 0 
			$sql";

			$stmt = Conexion::connectPostgres()->prepare($sql2);

			$stmt->execute();

			$cuenta_col = $stmt->rowCount();

			return $cuenta_col;

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR TODOS LOS PACIENTES
	=============================================*/
	static public function mdlMostrarTodosPacientes($tabla, $sql) {

		$sql2 = "SELECT p.id, p.nombre_paciente, p.paterno_paciente, p.materno_paciente, p.documento_ci, p.fecha_nacimiento, p.estado_civil, p.sexo, p.cod_asegurado, p.cod_beneficiario, p.nro_empleador, p.nombre_empleador, p.estado_asegurado, p.domicilio, p.telefono, c.nombre_consultorio 
		FROM pacientes p
		LEFT JOIN consultorios C
		ON c.id = p.id_consultorio
		WHERE p.eliminado = 0 $sql";

		$stmt = Conexion::connectPostgres()->prepare($sql2);

		$stmt->execute();

		// return $sql2;

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;
 
	} 
	
	/*=============================================
	MOSTRAR PACIENTES
	=============================================*/
	static public function mdlMostrarPacientes($tabla, $item, $valor) {

		if ($item != null) {
			
			$sql = "SELECT p.id, p.nombre_paciente, p.paterno_paciente, p.materno_paciente, p.documento_ci, p.fecha_nacimiento, p.estado_civil, p.sexo, p.cod_asegurado, p.cod_beneficiario, p.nro_empleador, p.nombre_empleador, p.estado_asegurado, p.domicilio, p.telefono, p.id_consultorio, c.nombre_consultorio, p.particular
			FROM pacientes p
			LEFT JOIN consultorios C
			ON c.id = p.id_consultorio
			WHERE p.$item = :$item";

			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();

		} else {

			$sql = "SELECT p.id, p.nombre_paciente, p.paterno_paciente, p.materno_paciente, p.documento_ci, p.fecha_nacimiento, p.estado_civil, p.sexo, p.cod_asegurado, p.cod_beneficiario, p.nro_empleador, p.nombre_empleador, p.estado_asegurado, c.nombre_consultorio 
			FROM pacientes p
			LEFT JOIN consultorios C
			ON c.id = p.id_consultorio
			WHERE p.eliminado = 0 
			ORDER BY p.id DESC";

			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;
 
	} 

	/*=============================================
	REGISTRO DE NUEVA PERSONA
	=============================================*/
	static public function mdlNuevoPaciente($tabla, $datos) {

		$sql = "INSERT INTO $tabla(nombre_paciente, paterno_paciente,materno_paciente, documento_ci, cod_asegurado, cod_beneficiario, fecha_nacimiento, estado_civil, sexo, domicilio, telefono, particular, nro_empleador, nombre_empleador, estado_asegurado, id_consultorio) VALUES (:nombre_paciente, :paterno_paciente, :materno_paciente,:documento_ci, :cod_asegurado, :cod_beneficiario, :fecha_nacimiento, :estado_civil, :sexo, :domicilio, :telefono, :particular, :nro_empleador, :nombre_empleador,:estado_asegurado, :id_consultorio)";

		$stmt = Conexion::connectPostgres()->prepare($sql);

		$stmt->bindParam(":nombre_paciente", $datos["nombre_paciente"], PDO::PARAM_STR);
		$stmt->bindParam(":paterno_paciente", $datos["paterno_paciente"], PDO::PARAM_STR);
		$stmt->bindParam(":materno_paciente", $datos["materno_paciente"], PDO::PARAM_STR);
		$stmt->bindParam(":documento_ci", $datos["documento_ci"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_asegurado", $datos["cod_asegurado"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_beneficiario", $datos["cod_beneficiario"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_civil", $datos["estado_civil"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
		$stmt->bindParam(":domicilio", $datos["domicilio"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":particular", $datos["particular"], PDO::PARAM_STR);
		$stmt->bindParam(":nro_empleador", $datos["nro_empleador"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_empleador", $datos["nombre_empleador"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_asegurado", $datos["estado_asegurado"], PDO::PARAM_STR);
		$stmt->bindParam(":id_consultorio", $datos["id_consultorio"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}
	/*=============================================
	EDITAR PERSONA
	=============================================*/
	static public function mdlEditarPacientes($tabla, $datos) {

		$sql = "UPDATE $tabla SET nombre_paciente = :nombre_paciente, paterno_paciente = :paterno_paciente, materno_paciente = :materno_paciente, documento_ci = :documento_ci, cod_asegurado = :cod_asegurado, cod_beneficiario = :cod_beneficiario, fecha_nacimiento = :fecha_nacimiento, estado_civil = :estado_civil, sexo = :sexo, domicilio = :domicilio, telefono = :telefono, particular = :particular, nro_empleador = :nro_empleador, nombre_empleador = :nombre_empleador, estado_asegurado = :estado_asegurado, id_consultorio = :id_consultorio WHERE id = :id";
		
		$stmt = Conexion::connectPostgres()->prepare($sql);

		$stmt->bindParam(":nombre_paciente", $datos["nombre_paciente"], PDO::PARAM_STR);
		$stmt->bindParam(":paterno_paciente", $datos["paterno_paciente"], PDO::PARAM_STR);
		$stmt->bindParam(":materno_paciente", $datos["materno_paciente"], PDO::PARAM_STR);
		$stmt->bindParam(":documento_ci", $datos["documento_ci"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_asegurado", $datos["cod_asegurado"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_beneficiario", $datos["cod_beneficiario"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_civil", $datos["estado_civil"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
		$stmt->bindParam(":domicilio", $datos["domicilio"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":particular", $datos["particular"], PDO::PARAM_STR);
		$stmt->bindParam(":nro_empleador", $datos["nro_empleador"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_empleador", $datos["nombre_empleador"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_asegurado", $datos["estado_asegurado"], PDO::PARAM_STR);
		$stmt->bindParam(":id_consultorio", $datos["id_consultorio"], PDO::PARAM_INT);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR PERSONA
	=============================================*/
	static public function mdlActualizarPacientes($tabla, $item1, $valor1, $item2, $valor2) {

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