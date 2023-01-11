<?php

require_once "conexion.db.php";

class ModelLibroServicios {

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA NEONATOS (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function mdlContarLibroServiciosFecha($item, $valor, $item1, $valor1, $item2, $valor2) {

		if ($valor == 21) {

			$sql = "SELECT s.id 
			FROM paciente_ingresos pi2
			INNER JOIN pacientes p
			ON pi2.id_paciente = p.id
			LEFT JOIN paciente_egresos pe
			ON pi2.id = pe.id_paciente_ingreso
			INNER JOIN consultorios c2
			ON p.id_consultorio = c2.id
			LEFT JOIN consultorios c3
			ON pi2.id_consultorio = c3.id
			INNER JOIN cie10 c10_ingreso
			ON pi2.id_cie10 = c10_ingreso.id
			INNER JOIN cie10 c10_egreso
			ON pe.id_cie10 = c10_egreso.id
			INNER JOIN salas s2
			ON pi2.id_sala = s2.id
			INNER JOIN camas c
			ON pi2.id_cama = c.id
			INNER JOIN servicios s
			ON pi2.id_servicio = s.id
			WHERE pi2.id_especialidad = :$item
			AND pe.fecha_egreso BETWEEN :$item1 AND :$item2";
			
		} else {

			$sql = "SELECT s.id 
			FROM paciente_ingresos pi2
			INNER JOIN pacientes p
			ON pi2.id_paciente = p.id
			LEFT JOIN paciente_egresos pe
			ON pi2.id = pe.id_paciente_ingreso
			INNER JOIN consultorios c2
			ON p.id_consultorio = c2.id
			LEFT JOIN consultorios c3
			ON pi2.id_consultorio = c3.id
			INNER JOIN cie10 c10_ingreso
			ON pi2.id_cie10 = c10_ingreso.id
			INNER JOIN cie10 c10_egreso
			ON pe.id_cie10 = c10_egreso.id
			INNER JOIN salas s2
			ON pi2.id_sala = s2.id
			INNER JOIN camas c
			ON pi2.id_cama = c.id
			INNER JOIN servicios s
			ON pi2.id_servicio = s.id
			WHERE pi2.id_servicio = :$item
			AND pe.fecha_egreso BETWEEN :$item1 AND :$item2";

		}

		$stmt = Conexion::connectPostgres()->prepare($sql);

		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->rowCount();		// devuelve el numero de registros de la consulta		

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA NEONATOS (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function mdlContarFiltradoLibroServiciosFecha($item, $valor, $item1, $valor1, $item2, $valor2, $sql) {
		
		if ($valor == 21) {

			if($sql == "") {

				$sql2 = "SELECT s.id 
				FROM paciente_ingresos pi2
				INNER JOIN pacientes p
				ON pi2.id_paciente = p.id
				LEFT JOIN paciente_egresos pe
				ON pi2.id = pe.id_paciente_ingreso
				INNER JOIN consultorios c2
				ON p.id_consultorio = c2.id
				LEFT JOIN consultorios c3
				ON pi2.id_consultorio = c3.id
				INNER JOIN cie10 c10_ingreso
				ON pi2.id_cie10 = c10_ingreso.id
				INNER JOIN cie10 c10_egreso
				ON pe.id_cie10 = c10_egreso.id
				INNER JOIN salas s2
				ON pi2.id_sala = s2.id
				INNER JOIN camas c
				ON pi2.id_cama = c.id
				INNER JOIN servicios s
				ON pi2.id_servicio = s.id
				WHERE pi2.id_especialidad = :$item
				AND pe.fecha_egreso BETWEEN :$item1 AND :$item2";

			} else {

				$sql2 = "SELECT s.id 
				FROM paciente_ingresos pi2
				INNER JOIN pacientes p
				ON pi2.id_paciente = p.id
				LEFT JOIN paciente_egresos pe
				ON pi2.id = pe.id_paciente_ingreso
				INNER JOIN consultorios c2
				ON p.id_consultorio = c2.id
				LEFT JOIN consultorios c3
				ON pi2.id_consultorio = c3.id
				INNER JOIN cie10 c10_ingreso
				ON pi2.id_cie10 = c10_ingreso.id
				INNER JOIN cie10 c10_egreso
				ON pe.id_cie10 = c10_egreso.id
				INNER JOIN salas s2
				ON pi2.id_sala = s2.id
				INNER JOIN camas c
				ON pi2.id_cama = c.id
				INNER JOIN servicios s
				ON pi2.id_servicio = s.id
				WHERE pi2.id_especialidad = :$item
				AND pe.fecha_egreso BETWEEN :$item1 AND :$item2 
				$sql";

			}

		} else {

			if($sql == "") {

				$sql2 = "SELECT s.id 
				FROM paciente_ingresos pi2
				INNER JOIN pacientes p
				ON pi2.id_paciente = p.id
				LEFT JOIN paciente_egresos pe
				ON pi2.id = pe.id_paciente_ingreso
				INNER JOIN consultorios c2
				ON p.id_consultorio = c2.id
				LEFT JOIN consultorios c3
				ON pi2.id_consultorio = c3.id
				INNER JOIN cie10 c10_ingreso
				ON pi2.id_cie10 = c10_ingreso.id
				INNER JOIN cie10 c10_egreso
				ON pe.id_cie10 = c10_egreso.id
				INNER JOIN salas s2
				ON pi2.id_sala = s2.id
				INNER JOIN camas c
				ON pi2.id_cama = c.id
				INNER JOIN servicios s
				ON pi2.id_servicio = s.id
				WHERE pi2.id_servicio = :$item
				AND pe.fecha_egreso BETWEEN :$item1 AND :$item2";

			} else {

				$sql2 = "SELECT s.id 
				FROM paciente_ingresos pi2
				INNER JOIN pacientes p
				ON pi2.id_paciente = p.id
				LEFT JOIN paciente_egresos pe
				ON pi2.id = pe.id_paciente_ingreso
				INNER JOIN consultorios c2
				ON p.id_consultorio = c2.id
				LEFT JOIN consultorios c3
				ON pi2.id_consultorio = c3.id
				INNER JOIN cie10 c10_ingreso
				ON pi2.id_cie10 = c10_ingreso.id
				INNER JOIN cie10 c10_egreso
				ON pe.id_cie10 = c10_egreso.id
				INNER JOIN salas s2
				ON pi2.id_sala = s2.id
				INNER JOIN camas c
				ON pi2.id_cama = c.id
				INNER JOIN servicios s
				ON pi2.id_servicio = s.id
				WHERE pi2.id_servicio = :$item
				AND pe.fecha_egreso BETWEEN :$item1 AND :$item2 
				$sql";

			}
		}

		$stmt = Conexion::connectPostgres()->prepare($sql2);

		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		$stmt->execute();

		$cuenta_col = $stmt->rowCount();

		return $cuenta_col;

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR LISTADO NEONATOS (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function mdlMostrarLibroServiciosFecha($item, $valor, $item1, $valor1, $item2, $valor2, $sql) {

		if ($valor == 21) {

			$sql2 = "SELECT s.id, pi2.id_paciente, pi2.id, pi2.fecha_ingreso, pi2.hora_ingreso, p.nombre_paciente, p.paterno_paciente, p.materno_paciente, c3.nombre_consultorio as procedencia, p.fecha_nacimiento, p.sexo, p.cod_beneficiario, p.estado_civil, c2.nombre_consultorio as zona, c.nombre_cama, p.cod_asegurado, p.nro_empleador, p.cod_asegurado, p.nro_empleador, c10_ingreso.codigo as cie10_cod_ingreso, c10_ingreso.descripcion as cie10_diag_ingreso, s.nombre_servicio, c10_egreso.codigo as cie10_cod_egreso, c10_egreso.descripcion as cie10_diag_egreso, pe.fecha_egreso, pe.hora_egreso, pe.causa_egreso 
			FROM paciente_ingresos pi2
			INNER JOIN pacientes p
			ON pi2.id_paciente = p.id
			LEFT JOIN paciente_egresos pe
			ON pi2.id = pe.id_paciente_ingreso
			INNER JOIN consultorios c2
			ON p.id_consultorio = c2.id
			LEFT JOIN consultorios c3
			ON pi2.id_consultorio = c3.id
			INNER JOIN cie10 c10_ingreso
			ON pi2.id_cie10 = c10_ingreso.id
			INNER JOIN cie10 c10_egreso
			ON pe.id_cie10 = c10_egreso.id
			INNER JOIN salas s2
			ON pi2.id_sala = s2.id
			INNER JOIN camas c
			ON pi2.id_cama = c.id
			INNER JOIN servicios s
			ON pi2.id_servicio = s.id
			WHERE pi2.id_especialidad = :$item
			AND pe.fecha_egreso BETWEEN :$item1 AND :$item2
			$sql";

		} else {

			$sql2 = "SELECT s.id, pi2.id_paciente, pi2.id, pi2.fecha_ingreso, pi2.hora_ingreso, p.nombre_paciente, p.paterno_paciente, p.materno_paciente, c3.nombre_consultorio as procedencia, p.fecha_nacimiento, p.sexo, p.cod_beneficiario, p.estado_civil, c2.nombre_consultorio as zona, c.nombre_cama, p.cod_asegurado, p.nro_empleador, p.cod_asegurado, p.nro_empleador, c10_ingreso.codigo as cie10_cod_ingreso, c10_ingreso.descripcion as cie10_diag_ingreso, s.nombre_servicio, c10_egreso.codigo as cie10_cod_egreso, c10_egreso.descripcion as cie10_diag_egreso, pe.fecha_egreso, pe.hora_egreso, pe.causa_egreso 
			FROM paciente_ingresos pi2
			INNER JOIN pacientes p
			ON pi2.id_paciente = p.id
			LEFT JOIN paciente_egresos pe
			ON pi2.id = pe.id_paciente_ingreso
			LEFT JOIN consultorios c2
			ON p.id_consultorio = c2.id
			INNER JOIN consultorios c3
			ON pi2.id_consultorio = c3.id
			INNER JOIN cie10 c10_ingreso
			ON pi2.id_cie10 = c10_ingreso.id
			INNER JOIN cie10 c10_egreso
			ON pe.id_cie10 = c10_egreso.id
			INNER JOIN salas s2
			ON pi2.id_sala = s2.id
			INNER JOIN camas c
			ON pi2.id_cama = c.id
			INNER JOIN servicios s
			ON pi2.id_servicio = s.id
			WHERE pi2.id_servicio = :$item
			AND pe.fecha_egreso BETWEEN :$item1 AND :$item2
			$sql";

		}
		
		$stmt = Conexion::connectPostgres()->prepare($sql2);

		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
		$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}

}