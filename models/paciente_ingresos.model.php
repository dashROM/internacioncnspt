<?php

require_once "conexion.db.php";

class ModelPacienteIngresos {

	/*=============================================
	MOSTRAR DATOS DE UN PACIENTE INGRESO
	=============================================*/
	static public function mdlMostrarPacienteIngreso($tabla, $item, $valor) {

		if ($item != null) {

			$sql = "SELECT pi.id, pi.id_paciente, pi.id_establecimiento, e.nombre_establecimiento, e.abrev_establecimiento, pi.fecha_ingreso, pi.hora_ingreso, pi.estado_paciente, pi.id_servicio, se.nombre_servicio,  pi.id_especialidad, pi2.id_especialidad as id_especialidad_actual, es.nombre_especialidad, pi.id_sala, s.nombre_sala, s.descripcion_sala, pi.id_cama, c.nombre_cama, c.descripcion_cama, pi.id_consultorio, pi.id_medico, CONCAT(m.nombre_medico, ' ', m.paterno_medico, ' ', m.materno_medico) medico_tratante, pi.id_cie10, CONCAT(c10.codigo, ' - ',c10.descripcion) diagnostico, pi.diagnostico_especifico1, pi.diagnostico_especifico2, pi.diagnostico_especifico3, pi.maternidad, pi.neonato, pi.referencia, pi.transferencia FROM pacientes p, paciente_ingresos pi, paciente_internados pi2, establecimientos e, medicos m, cie10 c10, servicios se, especialidades es,salas s, camas c  WHERE p.id = pi.id_paciente AND pi2.id_paciente_ingreso = pi.id AND e.id = pi.id_establecimiento AND  se.id = pi2.id_servicio AND es.id = pi.id_especialidad AND  m.id = pi.id_medico AND c10.id = pi.id_cie10 AND s.id = pi.id_sala AND c.id = pi.id_cama AND pi.$item = :$item ORDER BY pi.fecha_ingreso DESC";
			
			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetch();

		}

		$stmt->close();
		$stmt = null;

	}
	
	/*=============================================
	MOSTRAR PACIENTE INGRESOS
	=============================================*/
	static public function mdlMostrarPacienteIngresos($tabla, $item, $valor) {

		if ($item != null) {

			$sql = "SELECT pi.id, pi.id_paciente, e.nombre_establecimiento, e.abrev_establecimiento, pi.fecha_ingreso, pi.hora_ingreso, pi.id_cie10, CONCAT(c10.codigo, ' - ',c10.descripcion) diagnostico, pi2.diagnostico_especifico1, pi2.diagnostico_especifico2, pi2.diagnostico_especifico3, pi.estado_paciente, pi2.id_servicio, se.nombre_servicio, pi.id_especialidad, pi2.id_especialidad as id_especialidad_actual, es.nombre_especialidad, pi2.id_sala, s.nombre_sala, s.descripcion_sala, pi2.id_cama, c.nombre_cama, c.descripcion_cama, pi.maternidad, pi.neonato, pi.referencia FROM pacientes p, paciente_ingresos pi, paciente_internados pi2, establecimientos e, cie10 c10, servicios se, especialidades es, salas s ,camas c WHERE p.id = pi.id_paciente AND pi2.id_paciente_ingreso = pi.id AND e.id = pi.id_establecimiento AND se.id = pi2.id_servicio AND es.id = pi2.id_especialidad AND c10.id = pi.id_cie10 AND s.id = pi2.id_sala AND c.id = pi2.id_cama AND pi.$item = :$item ORDER BY pi.fecha_ingreso DESC";
			
			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetchAll();

		} else {

			$sql = "SELECT pi.id, pi.id_paciente, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, p.fecha_nacimiento, p.cod_asegurado, p.nro_empleador, p.nombre_empleador, e.nombre_establecimiento, e.abrev_establecimiento, pi.fecha_ingreso, pi.hora_ingreso, pi.id_cie10, CONCAT(c10.codigo, ' - ',c10.descripcion) diagnostico, pi2.diagnostico_especifico1, pi2.diagnostico_especifico2, pi2.diagnostico_especifico3, pi.estado_paciente, pi2.id_servicio, se.nombre_servicio, pi.id_especialidad, pi2.id_especialidad as id_especialidad_actual, es.nombre_especialidad, pi.id_sala, s.nombre_sala, s.descripcion_sala, pi.id_cama, c.nombre_cama, c.descripcion_cama, pi.maternidad, pi.neonato, pi.referencia FROM pacientes p, paciente_ingresos pi, paciente_internados pi2, establecimientos e, cie10 c10,servicios se, especialidades es, salas s ,camas c WHERE p.id = pi.id_paciente AND pi2.id_paciente_ingreso = pi.id AND e.id = pi.id_establecimiento AND  se.id = pi2.id_servicio AND es.id = pi2.id_especialidad AND c10.id = pi.id_cie10 AND s.id = pi2.id_sala AND c.id = pi2.id_cama AND pi.estado_paciente = 0 ORDER BY pi.fecha_ingreso DESC";

			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	REGISTRO DE NUEVO PACIENTE INGRESO
	=============================================*/
	static public function mdlNuevoPacienteIngreso($tabla, $datos) {

		$pdo = Conexion::connectPostgres();

		try {
 
	    //Inicio de las transacciones.

	    $pdo->beginTransaction();

	    // Consulta 1: Inserta nuevo paciente ingreso
			$sql = "INSERT INTO $tabla(id_establecimiento,fecha_ingreso, hora_ingreso, id_servicio, id_especialidad,id_sala, id_cama, id_consultorio, id_medico, id_cie10, diagnostico_especifico1, diagnostico_especifico2, diagnostico_especifico3, id_paciente) VALUES (:id_establecimiento, :fecha_ingreso, :hora_ingreso, :id_servicio, :id_especialidad, :id_sala, :id_cama, :id_consultorio, :id_medico, :id_cie10, :diagnostico_especifico1, :diagnostico_especifico2, :diagnostico_especifico3, :id_paciente)";

			$stmt = $pdo->prepare($sql);

			$stmt->bindParam(":id_establecimiento", $datos["id_establecimiento"], PDO::PARAM_INT);
			$stmt->bindParam(":fecha_ingreso", $datos["fecha_ingreso"], PDO::PARAM_STR);
			$stmt->bindParam(":hora_ingreso", $datos["hora_ingreso"], PDO::PARAM_STR);
			$stmt->bindParam(":id_servicio", $datos["id_servicio"], PDO::PARAM_INT);
			$stmt->bindParam(":id_especialidad", $datos["id_especialidad"], PDO::PARAM_INT);
			$stmt->bindParam(":id_sala", $datos["id_sala"], PDO::PARAM_INT);
			$stmt->bindParam(":id_cama", $datos["id_cama"], PDO::PARAM_INT);
			$stmt->bindParam(":id_consultorio", $datos["id_consultorio"], PDO::PARAM_INT);
			$stmt->bindParam(":id_medico", $datos["id_medico"], PDO::PARAM_INT);
			$stmt->bindParam(":id_cie10", $datos["id_cie10"], PDO::PARAM_INT);
			$stmt->bindParam(":diagnostico_especifico1", $datos["diagnostico_especifico1"], PDO::PARAM_STR);
			$stmt->bindParam(":diagnostico_especifico2", $datos["diagnostico_especifico2"], PDO::PARAM_STR);
			$stmt->bindParam(":diagnostico_especifico3", $datos["diagnostico_especifico3"], PDO::PARAM_STR);
			$stmt->bindParam(":id_paciente", $datos["id_paciente"], PDO::PARAM_INT);

			if ($stmt->execute()) {

				$id_paciente_ingreso = $pdo->lastInsertId();
			
		  	// Consulta 2: Actualizacion de estado de cama de libre a ocupado.
		  	$sql2 = "INSERT INTO paciente_internados(id_establecimiento, id_servicio, id_especialidad,id_sala, id_cama, id_medico, diagnostico_especifico1, diagnostico_especifico2, diagnostico_especifico3, id_paciente, id_paciente_ingreso) VALUES (:id_establecimiento, :id_servicio, :id_especialidad, :id_sala, :id_cama, :id_medico, :diagnostico_especifico1, :diagnostico_especifico2, :diagnostico_especifico3, :id_paciente, :id_paciente_ingreso)";

			  $stmt = $pdo->prepare($sql2);

				$stmt->bindParam(":id_establecimiento", $datos["id_establecimiento"], PDO::PARAM_INT);
				$stmt->bindParam(":id_servicio", $datos["id_servicio"], PDO::PARAM_INT);
				$stmt->bindParam(":id_especialidad", $datos["id_especialidad"], PDO::PARAM_INT);
				$stmt->bindParam(":id_sala", $datos["id_sala"], PDO::PARAM_INT);
				$stmt->bindParam(":id_cama", $datos["id_cama"], PDO::PARAM_INT);
				$stmt->bindParam(":id_medico", $datos["id_medico"], PDO::PARAM_INT);
				$stmt->bindParam(":diagnostico_especifico1", $datos["diagnostico_especifico1"], PDO::PARAM_STR);
				$stmt->bindParam(":diagnostico_especifico2", $datos["diagnostico_especifico2"], PDO::PARAM_STR);
				$stmt->bindParam(":diagnostico_especifico3", $datos["diagnostico_especifico3"], PDO::PARAM_STR);
				$stmt->bindParam(":id_paciente", $datos["id_paciente"], PDO::PARAM_INT);
				$stmt->bindParam(":id_paciente_ingreso", $id_paciente_ingreso, PDO::PARAM_INT);

				if ($stmt->execute()) {

					// Consulta 3: Actualizacion de estado de cama de libre a ocupado.
			  	$sql3 = "UPDATE camas SET estado_cama = 1 WHERE id = :id";

				  $stmt = $pdo->prepare($sql3);

					$stmt->bindParam(":id", $datos["id_cama"], PDO::PARAM_INT);

					if ($stmt->execute()) {

						// Permitir la transacción.
				    $pdo->commit();

				    return "ok";

					} else {

						// Revertir la transacción.
						$pdo->rollBack();

	    			return "error3";

					}

				} else {

					// Revertir la transacción.
					$pdo->rollBack();

    			return "error2";

				}

			} else {
				
				return "error1";

			}

		} 
		// Bloque de captura manejará cualquier excepción que se lance.
		catch (Exception $e){
		    // Se ha producido una excepción, lo que significa que una de nuestras consultas de base de datos hafallado
		    // Imprimiendo mensaje de error.
		    echo $e->getMessage();
		    // Revertir la transacción.
		    $pdo->rollBack();

		    return "error";

		}
		
		$stmt->close();
		$stmt = null;

	} 

	/*=============================================
	EDITAR PACIENTE INGRESO
	=============================================*/
	static public function mdlEditarPacienteIngreso($tabla, $datos) {

		$pdo = Conexion::connectPostgres();

		try {

	    //Inicio de las transacciones.
	    $pdo->beginTransaction();

	    // Consulta 1: Actualizacion pacientes ingresos
			$sql = "UPDATE $tabla SET id_establecimiento = :id_establecimiento, fecha_ingreso = :fecha_ingreso, hora_ingreso = :hora_ingreso, id_servicio = :id_servicio, id_especialidad = :id_especialidad, id_sala = :id_sala, id_cama = :id_cama, id_consultorio = :id_consultorio, id_medico = :id_medico, id_cie10 = :id_cie10, diagnostico_especifico1 = :diagnostico_especifico1, diagnostico_especifico2 = :diagnostico_especifico2, diagnostico_especifico3 = :diagnostico_especifico3, id_paciente = :id_paciente WHERE id = :id";

			$stmt = $pdo->prepare($sql);

			$stmt->bindParam(":id_establecimiento", $datos["id_establecimiento"], PDO::PARAM_INT);
			$stmt->bindParam(":fecha_ingreso", $datos["fecha_ingreso"], PDO::PARAM_STR);
			$stmt->bindParam(":hora_ingreso", $datos["hora_ingreso"], PDO::PARAM_STR);
			$stmt->bindParam(":id_servicio", $datos["id_servicio"], PDO::PARAM_INT);
			$stmt->bindParam(":id_especialidad", $datos["id_especialidad"], PDO::PARAM_INT);
			$stmt->bindParam(":id_sala", $datos["id_sala"], PDO::PARAM_INT);
			$stmt->bindParam(":id_cama", $datos["id_cama"], PDO::PARAM_INT);
			$stmt->bindParam(":id_consultorio", $datos["id_consultorio"], PDO::PARAM_INT);
			$stmt->bindParam(":id_medico", $datos["id_medico"], PDO::PARAM_INT);
			$stmt->bindParam(":id_cie10", $datos["id_cie10"], PDO::PARAM_INT);
			$stmt->bindParam(":diagnostico_especifico1", $datos["diagnostico_especifico1"], PDO::PARAM_STR);
			$stmt->bindParam(":diagnostico_especifico2", $datos["diagnostico_especifico2"], PDO::PARAM_STR);
			$stmt->bindParam(":diagnostico_especifico3", $datos["diagnostico_especifico3"], PDO::PARAM_STR);
			$stmt->bindParam(":id_paciente", $datos["id_paciente"], PDO::PARAM_INT);
			$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

			if ($stmt->execute()) {

				// Consulta 2: Actualizacion pacientes internados.
		  	$sql2 = "UPDATE paciente_internados SET id_establecimiento = :id_establecimiento, id_servicio = :id_servicio, id_especialidad = :id_especialidad, id_sala = :id_sala, id_cama = :id_cama, id_medico = :id_medico, diagnostico_especifico1 = :diagnostico_especifico1, diagnostico_especifico2 = :diagnostico_especifico2, diagnostico_especifico3 = :diagnostico_especifico3, id_paciente = :id_paciente WHERE id_paciente_ingreso = :id_paciente_ingreso";

			  $stmt = $pdo->prepare($sql2);

				$stmt->bindParam(":id_establecimiento", $datos["id_establecimiento"], PDO::PARAM_INT);
				$stmt->bindParam(":id_servicio", $datos["id_servicio"], PDO::PARAM_INT);
				$stmt->bindParam(":id_especialidad", $datos["id_especialidad"], PDO::PARAM_INT);
				$stmt->bindParam(":id_sala", $datos["id_sala"], PDO::PARAM_INT);
				$stmt->bindParam(":id_cama", $datos["id_cama"], PDO::PARAM_INT);
				$stmt->bindParam(":id_medico", $datos["id_medico"], PDO::PARAM_INT);
				$stmt->bindParam(":diagnostico_especifico1", $datos["diagnostico_especifico1"], PDO::PARAM_STR);
				$stmt->bindParam(":diagnostico_especifico2", $datos["diagnostico_especifico2"], PDO::PARAM_STR);
				$stmt->bindParam(":diagnostico_especifico3", $datos["diagnostico_especifico3"], PDO::PARAM_STR);
				$stmt->bindParam(":id_paciente", $datos["id_paciente"], PDO::PARAM_INT);
				$stmt->bindParam(":id_paciente_ingreso", $datos["id"], PDO::PARAM_INT);

				if ($stmt->execute()) {
				
					// Consulta 3: Actualizacion de estado de cama de ocupado a libre.
			  	$sql2 = "UPDATE camas SET estado_cama = 0 WHERE id = :id";

				  $stmt = $pdo->prepare($sql2);

					$stmt->bindParam(":id", $datos["id_cama_ant"], PDO::PARAM_INT);

					if ($stmt->execute()) {

						// Consulta 4: Actualizacion de estado de cama de libre a ocupado.
				  	$sql3 = "UPDATE camas SET estado_cama = 1 WHERE id = :id";

					  $stmt = $pdo->prepare($sql3);

						$stmt->bindParam(":id", $datos["id_cama"], PDO::PARAM_INT);

						if ($stmt->execute()) {

							// Permitir la transacción.
					    $pdo->commit();

					    return "ok";

					  } else {

							// Revertir la transacción.
							$pdo->rollBack();

			    		return "error3";

						}

				  } else {

						// Revertir la transacción.
						$pdo->rollBack();

		    		return "error2";

					}

				}

				else {

					// Revertir la transacción.
					$pdo->rollBack();

	    		return "error2";

				}


			} else {
				
				return "error1";

			}
			
		} 
		// Bloque de captura manejará cualquier excepción que se lance.
		catch (Exception $e){
	    // Se ha producido una excepción, lo que significa que una de nuestras consultas de base de datos hafallado
	    // Imprimiendo mensaje de error.
	    echo $e->getMessage();
	    // Revertir la transacción.
	    $pdo->rollBack();

	    return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR PACIENTE INGRESO
	=============================================*/
	static public function mdlEditarPacienteIngresoCT($tabla, $datos) {

		$pdo = Conexion::connectPostgres();

    // Consulta 1: Actualizacion pacientes ingresos
		$sql = "UPDATE $tabla SET id_establecimiento = :id_establecimiento, fecha_ingreso = :fecha_ingreso, hora_ingreso = :hora_ingreso, id_servicio = :id_servicio, id_especialidad = :id_especialidad, id_sala = :id_sala, id_cama = :id_cama, id_consultorio = :id_consultorio, id_medico = :id_medico, id_cie10 = :id_cie10, diagnostico_especifico1 = :diagnostico_especifico1, diagnostico_especifico2 = :diagnostico_especifico2, diagnostico_especifico3 = :diagnostico_especifico3, id_paciente = :id_paciente WHERE id = :id";

		$stmt = $pdo->prepare($sql);

		$stmt->bindParam(":id_establecimiento", $datos["id_establecimiento"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_ingreso", $datos["fecha_ingreso"], PDO::PARAM_STR);
		$stmt->bindParam(":hora_ingreso", $datos["hora_ingreso"], PDO::PARAM_STR);
		$stmt->bindParam(":id_servicio", $datos["id_servicio"], PDO::PARAM_INT);
		$stmt->bindParam(":id_especialidad", $datos["id_especialidad"], PDO::PARAM_INT);
		$stmt->bindParam(":id_sala", $datos["id_sala"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cama", $datos["id_cama"], PDO::PARAM_INT);
		$stmt->bindParam(":id_consultorio", $datos["id_consultorio"], PDO::PARAM_INT);
		$stmt->bindParam(":id_medico", $datos["id_medico"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cie10", $datos["id_cie10"], PDO::PARAM_INT);
		$stmt->bindParam(":diagnostico_especifico1", $datos["diagnostico_especifico1"], PDO::PARAM_STR);
		$stmt->bindParam(":diagnostico_especifico2", $datos["diagnostico_especifico2"], PDO::PARAM_STR);
		$stmt->bindParam(":diagnostico_especifico3", $datos["diagnostico_especifico3"], PDO::PARAM_STR);
		$stmt->bindParam(":id_paciente", $datos["id_paciente"], PDO::PARAM_INT);
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
	ACTUALIZAR INGRESO
	=============================================*/
	static public function mdlActualizarIngresos($tabla, $item1, $valor1, $item2, $valor2) {

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

	/*=============================================
	VERIFICAR PACIENTE INGRESOS
	=============================================*/
	static public function mdlVerificarPacienteIngresos($tabla, $item, $valor) {

		$sql = "SELECT * FROM $tabla WHERE estado_paciente = '0' AND $item = :$item";

		$stmt = Conexion::connectPostgres()->prepare($sql);

		$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();
		
		$stmt->close();
		$stmt = null;

	}

}