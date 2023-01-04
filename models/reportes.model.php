<?php

require_once "conexion.db.php";

class ModelReportes {

	/*=============================================
	MOSTRAR DATOS PARA REPORTE FORM 204 PACIENTE INGRESO
	=============================================*/
	static public function mdlFrmEM204PacienteIngreso($tabla, $item, $valor) {

		if ($item != null) {

			$sql = "SELECT pi2.id, p.fecha_nacimiento, p.paterno_paciente, p.materno_paciente, p.nombre_paciente, p.cod_asegurado, p.cod_beneficiario, p.estado_civil, p.sexo, p.nombre_empleador, p.nro_empleador, e.nombre_establecimiento, pi2.fecha_ingreso, c2.nombre_consultorio, pi2.hora_ingreso, CONCAT(c10.codigo,' - ',c10.descripcion) diagnostico, c10.codigo, es.nombre_especialidad, es.codigo_especialidad
			FROM paciente_ingresos pi2
			INNER JOIN pacientes p
			ON pi2.id_paciente = p.id
			INNER JOIN establecimientos e
			ON pi2.id_establecimiento = e.id
			INNER JOIN consultorios c2
			ON pi2.id_consultorio = c2.id
			INNER JOIN especialidades es
			ON pi2.id_especialidad = es.id
			INNER JOIN cie10 c10
			ON pi2.id_cie10 = c10.id
			WHERE pi2.id = :$item";
			
			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetch();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR DATOS PARA REPORTE FORM 204 PACIENTE EGRESO
	=============================================*/
	static public function mdlFrmEM204PacienteEgreso($tabla, $item, $valor) {

		if ($item != null) {

			$sql = "SELECT pe.fecha_egreso, pe.hora_egreso, CONCAT(c10.codigo,' - ',c10.descripcion) diagnostico_egreso, pe.causa_egreso, pe.condicion_egreso, pe.fallecido_causa_clinica, pe.fallecido_causa_autopsia
			FROM paciente_egresos pe
			INNER JOIN paciente_ingresos pi2
			ON pe.id_paciente_ingreso = pi2.id
			INNER JOIN especialidades es
			ON pi2.id_especialidad = es.id
			INNER JOIN cie10 c10
			ON pe.id_cie10 = c10.id
			WHERE pi2.id = :$item";
			
			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetch();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR DATOS PARA REPORTE FORM 204 TRANSFERENCIAS
	=============================================*/
	static public function mdlFrmEM204Transferencias($tabla, $item, $valor) {

		if ($item != null) {

			$sql = "SELECT t.fecha_transferencia, s.nombre_servicio, e.nombre_especialidad
			FROM transferencias t
			INNER JOIN paciente_ingresos pi2
			ON t.id_paciente_ingreso = pi2.id
			INNER JOIN servicios s
			ON t.id_servicio_trans = s.id
			INNER JOIN especialidades e
			ON t.id_especialidad_trans = e.id
			WHERE pi2.id = :$item";
			
			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR DATOS PARA REPORTE FORM 204 MATERNIDAD
	=============================================*/
	static public function mdlFrmEM204Maternidad($tabla, $item, $valor) {

		if ($item != null) {

			$sql = "SELECT m.fecha_nacido, m.hora_nacido, m.tipo_parto, m.tipo_aborto, m.edad_gestacional, m.sexo_nacido1, m.peso_nacido1, m.estado_nacido1, m.sexo_nacido2, m.peso_nacido2, m.estado_nacido2, m.sexo_nacido3, m.peso_nacido3, m.estado_nacido3
			FROM maternidades m
			INNER JOIN paciente_ingresos pi2
			ON m.id_paciente_ingreso = pi2.id
			WHERE pi2.id = :$item";
			
			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetch();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR DATOS PARA REPORTE FORM 204 MATERNIDAD
	=============================================*/
	static public function mdlFrmEM204Neonato($tabla, $item, $valor) {

		if ($item != null) {

			$sql = "SELECT n.peso_neonato, n.talla_neonato, n.edad_gestacional_neonato
			FROM neonatos n
			INNER JOIN paciente_ingresos pi2
			ON n.id_paciente_ingreso = pi2.id
			WHERE pi2.id = :$item";
			
			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetch();

		}

		$stmt->close();
		$stmt = null;

	}

}