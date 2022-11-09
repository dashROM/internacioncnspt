<?php

require_once "conexion.db.php";

class ModelTransferencias {

	/*=============================================
	MOSTRAR DATOS DE UNA TRANSFERENCIA
	=============================================*/
	static public function mdlMostrarTransferencia($tabla, $item, $valor) {

		if ($item != null) {

			$sql = "SELECT t.id, t.id_paciente_ingreso, t.fecha_transferencia, t.id_medico, CONCAT(m.nombre_medico, ' ', m.paterno_medico, ' ', m.materno_medico) medico_tratante, t.diagnostico_trans1, t.diagnostico_trans2, t.diagnostico_trans3, t.id_servicio_trans, t.id_especialidad_trans, e.nombre_especialidad, t.id_sala_trans, s.nombre_sala, t.id_cama_trans, c.nombre_cama FROM transferencias t, medicos m, especialidades e, salas s, camas c WHERE t.id_medico = m.id AND t.id_especialidad_trans = e.id AND t.id_sala_trans = s.id AND t.id_cama_trans = c.id AND t.id = :$item";
			
			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();

		}

		$stmt->close();
		$stmt = null;

	}
	
	/*=============================================
	MOSTRAR TRANSFERENCIAS
	=============================================*/
	static public function mdlMostrarTransferencias($tabla, $item, $valor) {

		if ($item != null) {

			$sql = "SELECT a.id, a.id_paciente_ingreso, a.fecha_transferencia, CONCAT(a.diagnostico_trans1, ' - ', a.diagnostico_trans2, ' - ', a.diagnostico_trans3) diagnostico_transferencia, CONCAT(a.nombre_servicio, ' - ',a.nombre_especialidad, ' (', a.nombre_sala, ' - ', a.nombre_cama, ')') AS servicio_ini, CONCAT(b.nombre_servicio, ' - ', b.nombre_especialidad, ' (', b.nombre_sala, ' - ', b.nombre_cama, ')') AS servicio_fin
			FROM (
			  SELECT t.id, t.id_paciente_ingreso, t.fecha_transferencia, t.diagnostico_trans1, t.diagnostico_trans2, t.diagnostico_trans3, s.nombre_servicio, e.nombre_especialidad, s2.nombre_sala, c.nombre_cama
				FROM transferencias t, paciente_ingresos pi2, servicios s, salas s2, camas c, especialidades e 
				WHERE t.id_servicio_ant = s.id AND t.id_especialidad_ant = e.id AND t.id_sala_ant = s2.id AND t.id_cama_ant = c.id AND t.id_paciente_ingreso = pi2.id AND t.id_paciente_ingreso = :$item ORDER BY id ASC
			) a
			INNER JOIN (
			  SELECT t.id, s.nombre_servicio, e.nombre_especialidad, s2.nombre_sala, c.nombre_cama
				FROM transferencias t, paciente_ingresos pi2, servicios s, salas s2, camas c, especialidades e
				WHERE t.id_servicio_trans = s.id AND t.id_especialidad_trans = e.id AND t.id_sala_trans = s2.id AND t.id_cama_trans = c.id AND t.id_paciente_ingreso = pi2.id AND t.id_paciente_ingreso = :$item ORDER BY id ASC
			) b ON a.id = b.id";
			
			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll();

		} 

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	REGISTRO DE NUEVA TRANSFERENCIA
	=============================================*/
	static public function mdlNuevoTransferencia($tabla, $datos) { 

		$pdo = Conexion::connectPostgres();

		try {
 
	    //Inicio de las transacciones.
	    $pdo->beginTransaction();

	    // Consulta 1: Insertar nueva transferencia de paciente
	    $sql = "INSERT INTO $tabla(fecha_transferencia, id_servicio_trans, id_servicio_ant, id_especialidad_trans, id_especialidad_ant, id_sala_trans, id_sala_ant, id_cama_trans, id_cama_ant, id_medico, diagnostico_trans1, diagnostico_trans2, diagnostico_trans3, id_paciente_ingreso) 
        VALUES (:fecha_transferencia, :id_servicio_trans, :id_servicio_ant, :id_especialidad_trans, :id_especialidad_ant, :id_sala_trans, :id_sala_ant, :id_cama_trans, :id_cama_ant, :id_medico, :diagnostico_trans1, :diagnostico_trans2, :diagnostico_trans3, :id_paciente_ingreso)";

			$stmt = $pdo->prepare($sql);

			$stmt->bindParam(":fecha_transferencia", $datos["fecha_transferencia"], PDO::PARAM_STR);
			$stmt->bindParam(":id_servicio_trans", $datos["id_servicio_trans"], PDO::PARAM_INT);
			$stmt->bindParam(":id_servicio_ant", $datos["id_servicio_ant"], PDO::PARAM_INT);
			$stmt->bindParam(":id_especialidad_trans", $datos["id_especialidad_trans"], PDO::PARAM_INT);
			$stmt->bindParam(":id_especialidad_ant", $datos["id_especialidad_ant"], PDO::PARAM_INT);
			$stmt->bindParam(":id_sala_trans", $datos["id_sala_trans"], PDO::PARAM_INT);
			$stmt->bindParam(":id_sala_ant", $datos["id_sala_ant"], PDO::PARAM_INT);
			$stmt->bindParam(":id_cama_trans", $datos["id_cama_trans"], PDO::PARAM_INT);
	    $stmt->bindParam(":id_cama_ant", $datos["id_cama_ant"], PDO::PARAM_INT);
	    $stmt->bindParam(":id_medico", $datos["id_medico"], PDO::PARAM_INT);
	    $stmt->bindParam(":diagnostico_trans1", $datos["diagnostico_trans1"], PDO::PARAM_STR);
	    $stmt->bindParam(":diagnostico_trans2", $datos["diagnostico_trans2"], PDO::PARAM_STR);
	    $stmt->bindParam(":diagnostico_trans3", $datos["diagnostico_trans3"], PDO::PARAM_STR);
			$stmt->bindParam(":id_paciente_ingreso", $datos["id_paciente_ingreso"], PDO::PARAM_INT);

			if ($stmt->execute()) {

		  	// Consulta 2: Actualizacion de servico, especiadlidad, sala y cama del paciente transferido.
		  	$sql2 = "UPDATE paciente_internados SET id_servicio = :id_servicio_trans, id_especialidad = :id_especialidad_trans, id_sala = :id_sala_trans, id_cama = :id_cama_trans, id_medico = :id_medico, diagnostico_especifico1 = :diagnostico_especifico1, diagnostico_especifico2 = :diagnostico_especifico2, diagnostico_especifico3 = :diagnostico_especifico3  WHERE id_paciente_ingreso = :id_paciente_ingreso";

			  $stmt = $pdo->prepare($sql2);

				$stmt->bindParam(":id_servicio_trans", $datos["id_servicio_trans"], PDO::PARAM_INT);
				$stmt->bindParam(":id_especialidad_trans", $datos["id_especialidad_trans"], PDO::PARAM_INT);
				$stmt->bindParam(":id_sala_trans", $datos["id_sala_trans"], PDO::PARAM_INT);
				$stmt->bindParam(":id_cama_trans", $datos["id_cama_trans"], PDO::PARAM_INT);
				$stmt->bindParam(":id_medico", $datos["id_medico"], PDO::PARAM_INT);
				$stmt->bindParam(":diagnostico_especifico1", $datos["diagnostico_trans1"], PDO::PARAM_STR);
	    	$stmt->bindParam(":diagnostico_especifico2", $datos["diagnostico_trans2"], PDO::PARAM_STR);
	    	$stmt->bindParam(":diagnostico_especifico3", $datos["diagnostico_trans3"], PDO::PARAM_STR);
				$stmt->bindParam(":id_paciente_ingreso", $datos["id_paciente_ingreso"], PDO::PARAM_INT);

				if ($stmt->execute()) {

					// Consulta 3: Actualizacion de estado de cama de ocupado a libre.
			  	$sql2 = "UPDATE camas SET estado_cama = 0 WHERE id = :id";

				  $stmt = $pdo->prepare($sql2);

					$stmt->bindParam(":id", $datos["id_cama_ant"], PDO::PARAM_INT);

					if ($stmt->execute()) {

						// Consulta 4: Actualizacion de estado de cama de libre a ocupado.
				  	$sql2 = "UPDATE camas SET estado_cama = 1 WHERE id = :id";

					  $stmt = $pdo->prepare($sql2);

						$stmt->bindParam(":id", $datos["id_cama_trans"], PDO::PARAM_INT);

						if ($stmt->execute()) {

							// Permitir la transacción.
					    $pdo->commit();

					    return "ok";

					  } else {

							// Revertir la transacción.
							$pdo->rollBack();

			    		return "error4";

						}

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
	EDITAR TRANSFERENCIA
	=============================================*/
	static public function mdlEditarTransferencia($tabla, $datos) {

		$pdo = Conexion::connectPostgres();

		try {
 
	    //Inicio de las transacciones.
	    $pdo->beginTransaction();

	  	// Consulta 1: Actualizacion de datos de transferencia.
	  	$sql = "UPDATE transferencias SET fecha_transferencia = :fecha_transferencia, id_medico = :id_medico, diagnostico_trans1 = :diagnostico_trans1, diagnostico_trans2 = :diagnostico_trans2, diagnostico_trans3 = :diagnostico_trans3, id_servicio_trans = :id_servicio_trans, id_especialidad_trans = :id_especialidad_trans, id_sala_trans = :id_sala_trans, id_cama_trans = :id_cama_trans WHERE id = :id";

		  $stmt = $pdo->prepare($sql);

			$stmt->bindParam(":fecha_transferencia", $datos["fecha_transferencia"], PDO::PARAM_INT);
			$stmt->bindParam(":id_medico", $datos["id_medico"], PDO::PARAM_INT);
			$stmt->bindParam(":diagnostico_trans1", $datos["diagnostico_trans1"], PDO::PARAM_STR);
    	$stmt->bindParam(":diagnostico_trans2", $datos["diagnostico_trans2"], PDO::PARAM_STR);
    	$stmt->bindParam(":diagnostico_trans3", $datos["diagnostico_trans3"], PDO::PARAM_STR);    	
			$stmt->bindParam(":id_servicio_trans", $datos["id_servicio_trans"], PDO::PARAM_INT);
			$stmt->bindParam(":id_especialidad_trans", $datos["id_especialidad_trans"], PDO::PARAM_INT);
			$stmt->bindParam(":id_sala_trans", $datos["id_sala_trans"], PDO::PARAM_INT);
			$stmt->bindParam(":id_cama_trans", $datos["id_cama_trans"], PDO::PARAM_INT);
			$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

			if ($stmt->execute()) {

				// Consulta 2: Actualizacion de servico, especiadlidad, sala y cama del paciente transferido.
		  	$sql2 = "UPDATE paciente_internados SET id_servicio = :id_servicio, id_especialidad = :id_especialidad, id_sala = :id_sala, id_cama = :id_cama, id_medico = :id_medico, diagnostico_especifico1 = :diagnostico_especifico1, diagnostico_especifico2 = :diagnostico_especifico2, diagnostico_especifico3 = :diagnostico_especifico3  WHERE id_paciente_ingreso = :id_paciente_ingreso";

			  $stmt = $pdo->prepare($sql2);

				$stmt->bindParam(":id_servicio", $datos["id_servicio_trans"], PDO::PARAM_INT);
				$stmt->bindParam(":id_especialidad", $datos["id_especialidad_trans"], PDO::PARAM_INT);
				$stmt->bindParam(":id_sala", $datos["id_sala_trans"], PDO::PARAM_INT);
				$stmt->bindParam(":id_cama", $datos["id_cama_trans"], PDO::PARAM_INT);
				$stmt->bindParam(":id_medico", $datos["id_medico"], PDO::PARAM_INT);
				$stmt->bindParam(":diagnostico_especifico1", $datos["diagnostico_trans1"], PDO::PARAM_STR);
	    	$stmt->bindParam(":diagnostico_especifico2", $datos["diagnostico_trans2"], PDO::PARAM_STR);
	    	$stmt->bindParam(":diagnostico_especifico3", $datos["diagnostico_trans3"], PDO::PARAM_STR);
				$stmt->bindParam(":id_paciente_ingreso", $datos["id_paciente_ingreso"], PDO::PARAM_INT);

				if ($stmt->execute()) {

					// Consulta 2: Actualizacion de estado de cama de ocupado a libre.
			  	$sql3 = "UPDATE camas SET estado_cama = 0 WHERE id = :id";

				  $stmt = $pdo->prepare($sql3);

					$stmt->bindParam(":id", $datos["id_cama_ant"], PDO::PARAM_INT);

					if ($stmt->execute()) {

						// Consulta 3: Actualizacion de estado de cama de libre a ocupado.
				  	$sql4 = "UPDATE camas SET estado_cama = 1 WHERE id = :id";

					  $stmt = $pdo->prepare($sql4);

						$stmt->bindParam(":id", $datos["id_cama_trans"], PDO::PARAM_INT);

						if ($stmt->execute()) {

							// Permitir la transacción.
					    $pdo->commit();

					    return "ok";

					  } else {

							// Revertir la transacción.
							$pdo->rollBack();

			    		return "error4";

						}

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

				// Revertir la transacción.
				$pdo->rollBack();

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
	EDITAR TRANSFERENCIA PASADA
	=============================================*/
	static public function mdlEditarTransferenciaPasada($tabla, $datos) {

		$pdo = Conexion::connectPostgres();

		try {
 
	    //Inicio de las transacciones.
	    $pdo->beginTransaction();

	  	// Consulta 1: Actualizacion de datos de transferencia.
	  	$sql = "UPDATE transferencias SET fecha_transferencia = :fecha_transferencia, id_medico = :id_medico, diagnostico_trans1 = :diagnostico_trans1, diagnostico_trans2 = :diagnostico_trans2, diagnostico_trans3 = :diagnostico_trans3, id_servicio_trans = :id_servicio_trans, id_especialidad_trans = :id_especialidad_trans, id_sala_trans = :id_sala_trans, id_cama_trans = :id_cama_trans WHERE id = :id";

		  $stmt = $pdo->prepare($sql);

			$stmt->bindParam(":fecha_transferencia", $datos["fecha_transferencia"], PDO::PARAM_INT);
			$stmt->bindParam(":id_medico", $datos["id_medico"], PDO::PARAM_INT);
			$stmt->bindParam(":diagnostico_trans1", $datos["diagnostico_trans1"], PDO::PARAM_STR);
    	$stmt->bindParam(":diagnostico_trans2", $datos["diagnostico_trans2"], PDO::PARAM_STR);
    	$stmt->bindParam(":diagnostico_trans3", $datos["diagnostico_trans3"], PDO::PARAM_STR);    	
			$stmt->bindParam(":id_servicio_trans", $datos["id_servicio_trans"], PDO::PARAM_INT);
			$stmt->bindParam(":id_especialidad_trans", $datos["id_especialidad_trans"], PDO::PARAM_INT);
			$stmt->bindParam(":id_sala_trans", $datos["id_sala_trans"], PDO::PARAM_INT);
			$stmt->bindParam(":id_cama_trans", $datos["id_cama_trans"], PDO::PARAM_INT);
			$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

			if ($stmt->execute()) {

				// Permitir la transacción.
		    $pdo->commit();

		    return "ok";

		  } else {

				// Revertir la transacción.
				$pdo->rollBack();

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

}