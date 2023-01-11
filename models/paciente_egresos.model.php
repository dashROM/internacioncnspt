<?php

require_once "conexion.db.php";

class ModelPacienteEgresos {

		/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA PACIENTES EGRESOS
	=============================================*/
	static public function mdlContarPacientesEgresos($tabla) {

		// devuelve el numero de registros de la consulta
		$sql = "SELECT pe.id, pe.id_paciente_ingreso, pi2.id_paciente, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, pe.fecha_egreso, pe.hora_egreso, pe.causa_egreso, pe.condicion_egreso, CONCAT(c10.codigo, ' - ',c10.descripcion) diagnostico, pe.diagnostico_egreso1, pe.diagnostico_egreso2, pe.diagnostico_egreso3 FROM paciente_egresos pe, paciente_ingresos pi2, pacientes p, cie10 c10 WHERE pe.id_paciente_ingreso = pi2.id AND pi2.id_paciente = p.id AND pe.id_cie10 = c10.id";

		$stmt = Conexion::connectPostgres()->prepare($sql);

		$stmt->execute();

		return $stmt->rowCount();

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA PACIENTES EGRESOS FILTRADO
	=============================================*/
	static public function mdlContarFiltradoPacientesEgresos($tabla, $sql) {

		if($sql == "") {

			// devuelve el numero de registros de la consulta

			$sql2 = "SELECT pe.id, pe.id_paciente_ingreso, pi2.id_paciente, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, pe.fecha_egreso, pe.hora_egreso, pe.causa_egreso, pe.condicion_egreso, CONCAT(c10.codigo, ' - ',c10.descripcion) diagnostico, pe.diagnostico_egreso1, pe.diagnostico_egreso2, pe.diagnostico_egreso3 FROM paciente_egresos pe, paciente_ingresos pi2, pacientes p, cie10 c10 WHERE pe.id_paciente_ingreso = pi2.id AND pi2.id_paciente = p.id AND pe.id_cie10 = c10.id";

			$stmt = Conexion::connectPostgres()->prepare($sql2);

			$stmt->execute();

			$cuenta_col = $stmt->rowCount();

			return $cuenta_col;

		} else {

			// devuelve el numero de registros de la consulta

			$sql2 = "SELECT pe.id, pe.id_paciente_ingreso, pi2.id_paciente, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, pe.fecha_egreso, pe.hora_egreso, pe.causa_egreso, pe.condicion_egreso, CONCAT(c10.codigo, ' - ',c10.descripcion) diagnostico, pe.diagnostico_egreso1, pe.diagnostico_egreso2, pe.diagnostico_egreso3 FROM paciente_egresos pe, paciente_ingresos pi2, pacientes p, cie10 c10 WHERE pe.id_paciente_ingreso = pi2.id AND pi2.id_paciente = p.id AND pe.id_cie10 = c10.id $sql";

			$stmt = Conexion::connectPostgres()->prepare($sql2);

			$stmt->execute();

			$cuenta_col = $stmt->rowCount();

			return $cuenta_col;

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR DATOS DE UN PACIENTE EGRESO
	=============================================*/
	static public function mdlMostrarPacienteEgreso($tabla, $item, $valor) {

		if ($item != null) {

			$sql = "SELECT pe.fecha_egreso, pe.hora_egreso, CONCAT(c.codigo,' - ',c.descripcion) diagnostico, pe.diagnostico_egreso1, pe.diagnostico_egreso2, pe.diagnostico_egreso3, pe.causa_egreso, pe.condicion_egreso FROM paciente_egresos pe, cie10 c WHERE pe.id_cie10 = c.id AND pe.$item = :$item";
			
			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetch();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR PACIENTE EGRESOS
	=============================================*/
	static public function mdlMostrarPacientesEgresos($tabla, $sql) {

		$sql2 = "SELECT pe.id, pe.id_paciente_ingreso, pi2.id_paciente, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, pe.fecha_egreso, pe.hora_egreso, pe.causa_egreso, pe.condicion_egreso, CONCAT(c10.codigo, ' - ',c10.descripcion) diagnostico, pe.diagnostico_egreso1, pe.diagnostico_egreso2, pe.diagnostico_egreso3 FROM paciente_egresos pe, paciente_ingresos pi2, pacientes p, cie10 c10 WHERE pe.id_paciente_ingreso = pi2.id AND pi2.id_paciente = p.id AND pe.id_cie10 = c10.id $sql";

		$stmt = Conexion::connectPostgres()->prepare($sql2);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA PACIENTES EGRESOS (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function mdlContarPacientesEgresosFecha($tabla, $item1, $valor1, $item2, $valor2) {

		// devuelve el numero de registros de la consulta
		$sql = "SELECT pe.id, pe.id_paciente_ingreso, pi2.id_paciente, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, pe.fecha_egreso, pe.hora_egreso, pe.causa_egreso, pe.condicion_egreso, CONCAT(c10.codigo, ' - ',c10.descripcion) diagnostico, pe.diagnostico_egreso1, pe.diagnostico_egreso2, pe.diagnostico_egreso3 FROM paciente_egresos pe, paciente_ingresos pi2, pacientes p, cie10 c10 WHERE pe.id_paciente_ingreso = pi2.id AND pi2.id_paciente = p.id AND pe.id_cie10 = c10.id AND pe.fecha_egreso BETWEEN :$item1 AND :$item2";

		$stmt = Conexion::connectPostgres()->prepare($sql);

		$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->rowCount();

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA PACIENTES EGRESOS (FILTRADO POR FECHA DE EGRESO)
	=============================================*/
	static public function mdlContarFiltradoPacientesEgresosFecha($tabla, $item1, $valor1, $item2, $valor2, $sql) {

		if($sql == "") {

			// devuelve el numero de registros de la consulta

			$sql2 = "SELECT pe.id, pe.id_paciente_ingreso, pi2.id_paciente, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, pe.fecha_egreso, pe.hora_egreso, pe.causa_egreso, pe.condicion_egreso, CONCAT(c10.codigo, ' - ',c10.descripcion) diagnostico, pe.diagnostico_egreso1, pe.diagnostico_egreso2, pe.diagnostico_egreso3 FROM paciente_egresos pe, paciente_ingresos pi2, pacientes p, cie10 c10 WHERE pe.id_paciente_ingreso = pi2.id AND pi2.id_paciente = p.id AND pe.id_cie10 = c10.id AND pe.fecha_egreso BETWEEN :$item1 AND :$item2";

			$stmt = Conexion::connectPostgres()->prepare($sql2);

			$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
			$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

			$stmt->execute();

			$cuenta_col = $stmt->rowCount();

			return $cuenta_col;

		} else {

			// devuelve el numero de registros de la consulta

			$sql2 = "SELECT pe.id, pe.id_paciente_ingreso, pi2.id_paciente, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, pe.fecha_egreso, pe.hora_egreso, pe.causa_egreso, pe.condicion_egreso, CONCAT(c10.codigo, ' - ',c10.descripcion) diagnostico, pe.diagnostico_egreso1, pe.diagnostico_egreso2, pe.diagnostico_egreso3 FROM paciente_egresos pe, paciente_ingresos pi2, pacientes p, cie10 c10 WHERE pe.id_paciente_ingreso = pi2.id AND pi2.id_paciente = p.id AND pe.id_cie10 = c10.id AND pe.fecha_egreso BETWEEN :$item1 AND :$item2 $sql";

			$stmt = Conexion::connectPostgres()->prepare($sql2);

			$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
			$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

			$stmt->execute();

			$cuenta_col = $stmt->rowCount();

			return $cuenta_col;

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR PACIENTE EGRESOS (FILTRADO POR FECHA DE EGRESO)
	=============================================*/
	static public function mdlMostrarPacientesEgresosFecha($tabla, $item1, $valor1, $item2, $valor2, $sql) {

		$sql2 = "SELECT pe.id, pe.id_paciente_ingreso, pi2.id_paciente, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, pe.fecha_egreso, pe.hora_egreso, pe.causa_egreso, pe.condicion_egreso, CONCAT(c10.codigo, ' - ',c10.descripcion) diagnostico, pe.diagnostico_egreso1, pe.diagnostico_egreso2, pe.diagnostico_egreso3 FROM paciente_egresos pe, paciente_ingresos pi2, pacientes p, cie10 c10 WHERE pe.id_paciente_ingreso = pi2.id AND pi2.id_paciente = p.id AND pe.id_cie10 = c10.id AND pe.fecha_egreso BETWEEN :$item1 AND :$item2 $sql";

		$stmt = Conexion::connectPostgres()->prepare($sql2);

		$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	REGISTRO DE NUEVO PACIENTE EGRESO
	=============================================*/
	static public function mdlNuevoPacienteEgreso($tabla, $datos) {

		$pdo = Conexion::connectPostgres();

		try {
 
	    //Inicio de las transacciones.

	    $pdo->beginTransaction();

	    // Consulta 1: Inserta nuevo paciente egreso
			$sql1 = "INSERT INTO $tabla(fecha_egreso, hora_egreso, id_cie10, diagnostico_egreso1, diagnostico_egreso2, diagnostico_egreso3, causa_egreso, condicion_egreso, id_departamento, fallecido, fallecido_causa_clinica, fallecido_causa_autopsia, contrareferencia, id_paciente_ingreso) VALUES (:fecha_egreso, :hora_egreso, :id_cie10, :diagnostico_egreso1, :diagnostico_egreso2, :diagnostico_egreso3, :causa_egreso, :condicion_egreso, :id_departamento, :fallecido, :fallecido_causa_clinica, :fallecido_causa_autopsia, :contrareferencia, :id_paciente_ingreso)";

			$stmt = $pdo->prepare($sql1);

			$stmt->bindParam(":fecha_egreso", $datos["fecha_egreso"], PDO::PARAM_STR);
			$stmt->bindParam(":hora_egreso", $datos["hora_egreso"], PDO::PARAM_STR);
			$stmt->bindParam(":id_cie10", $datos["id_cie10"], PDO::PARAM_INT);
			$stmt->bindParam(":diagnostico_egreso1", $datos["diagnostico_egreso1"], PDO::PARAM_STR);
			$stmt->bindParam(":diagnostico_egreso2", $datos["diagnostico_egreso2"], PDO::PARAM_STR);
			$stmt->bindParam(":diagnostico_egreso3", $datos["diagnostico_egreso3"], PDO::PARAM_STR);
			$stmt->bindParam(":causa_egreso", $datos["causa_egreso"], PDO::PARAM_STR);
			$stmt->bindParam(":condicion_egreso", $datos["condicion_egreso"], PDO::PARAM_STR);
			$stmt->bindParam(":id_departamento", $datos["id_departamento"], PDO::PARAM_INT);
			$stmt->bindParam(":fallecido", $datos["fallecido"], PDO::PARAM_INT);
			$stmt->bindParam(":fallecido_causa_clinica", $datos["fallecido_causa_clinica"], PDO::PARAM_STR);
			$stmt->bindParam(":fallecido_causa_autopsia", $datos["fallecido_causa_autopsia"], PDO::PARAM_STR);
			$stmt->bindParam(":contrareferencia", $datos["contrareferencia"], PDO::PARAM_INT);
			$stmt->bindParam(":id_paciente_ingreso", $datos["id_paciente_ingreso"], PDO::PARAM_INT);

		  if ($stmt->execute()) {

		  	// Consulta 2: Actualizacion de estado de paciente de ingresado a dado de alta.
		  	$sql2 = "UPDATE paciente_ingresos SET estado_paciente = 1 WHERE id = :id";

			  $stmt = $pdo->prepare($sql2);

				$stmt->bindParam(":id", $datos["id_paciente_ingreso"], PDO::PARAM_INT);

				if ($stmt->execute()) {

			  	// Consulta 3: Actualizacion de estado de paciente de internado a dado de alta.
			  	$sql3 = "UPDATE paciente_internados SET estado_internado = 1 WHERE id_paciente_ingreso = :id_paciente_ingreso";

				  $stmt = $pdo->prepare($sql3);

					$stmt->bindParam(":id_paciente_ingreso", $datos["id_paciente_ingreso"], PDO::PARAM_INT);

					if ($stmt->execute()) {

						// Consulta 4: Actualizacion de estado de cama de ocupado a libre.
				  	$sql4 = "UPDATE camas SET estado_cama = 0 WHERE id = :id";

					  $stmt = $pdo->prepare($sql4);

						$stmt->bindParam(":id", $datos["id_cama"], PDO::PARAM_INT);

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
	MOSTRAR DATOS DE UN PACIENTE EGRESO (REPORTE ALTA HOSPITALARIA)
	=============================================*/
	static public function mdlReporteAltaHospitalaria($tabla, $item, $valor) {

		if ($item != null) {

			$sql = "SELECT * FROM pacientes p, paciente_ingresos pi2, paciente_egresos pe, servicios s WHERE pi2.id_paciente = p.id AND pe.id_paciente_ingreso = pi2.id AND pi2.id_servicio = s.id AND pi2.id = :$item";
			
			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetch();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR EGRESO PACIENTE
	=============================================*/
	static public function mdlEliminarPacienteEgreso($tabla, $item1, $valor1, $item2, $valor2) {

		$pdo = Conexion::connectPostgres();

		try {

	    //Inicio de las transacciones.
	    $pdo->beginTransaction();

			$sql = "DELETE FROM $tabla WHERE id_paciente_ingreso = :$item1";
			
			$stmt = $pdo->prepare($sql);

			$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_INT);

			if ($stmt->execute()) {
				
				// Consulta 2: Actualizacion de estado pacientes con ingreso a internacion.
			  $sql2 = "UPDATE paciente_ingresos SET estado_paciente = 0 WHERE id = :$item1";

				$stmt = $pdo->prepare($sql2);

				$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_INT);

				if ($stmt->execute()) {

					// Consulta 3: Actualizacion de estado de paciente intenado.
			  	$sql2 = "UPDATE paciente_internados SET estado_internado = 0 WHERE id_paciente_ingreso = :$item1";

				  $stmt = $pdo->prepare($sql2);

					$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_INT);

					if ($stmt->execute()) {
					
						// Consulta 4: Actualizacion de estado de cama de libre a ocupado.
				  	$sql2 = "UPDATE camas SET estado_cama = 1 WHERE id = :$item2";

					  $stmt = $pdo->prepare($sql2);

						$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_INT);

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

}