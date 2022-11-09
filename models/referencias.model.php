<?php

require_once "conexion.db.php";

class ModelReferencias {

	/*=============================================
	MOSTRAR DATOS DE REFERENCIA
	=============================================*/
	static public function mdlMostrarReferencia($tabla, $item, $valor) {

		if ($item != null) {
			
			$stmt = Conexion::connectPostgres()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();

		} 

		$stmt->close();
		$stmt = null;

	}

  /*=============================================
	REGISTRO DE NUEVO REFERENCIA
	=============================================*/
	static public function mdlNuevoReferencia($tabla, $datos) {

		$pdo = Conexion::connectPostgres();

		try {
 
	    //Inicio de las transacciones.
	    $pdo->beginTransaction();

	    // Consulta 1: Registrar nueva materniadad de paciente
			$sql = "INSERT INTO $tabla(id_establecimiento, adecuado, justificado, oportuno, id_paciente_ingreso) VALUES (:id_establecimiento, :adecuado, :justificado, :oportuno, :id_paciente_ingreso)";

			$stmt = $pdo->prepare($sql);

			$stmt->bindParam(":id_establecimiento", $datos["id_establecimiento"], PDO::PARAM_INT);
			$stmt->bindParam(":adecuado", $datos["adecuado"], PDO::PARAM_INT);
			$stmt->bindParam(":justificado", $datos["justificado"], PDO::PARAM_INT);
			$stmt->bindParam(":oportuno", $datos["oportuno"], PDO::PARAM_INT);
			$stmt->bindParam(":id_paciente_ingreso", $datos["id_paciente_ingreso"], PDO::PARAM_INT);

			if ($stmt->execute()) {

				// Consulta 2: Actualizacion de estado de referencia de paciente ingresado.
		  	$sql2 = "UPDATE paciente_ingresos SET referencia = 1 WHERE id = :id";

			  $stmt = $pdo->prepare($sql2);

				$stmt->bindParam(":id", $datos["id_paciente_ingreso"], PDO::PARAM_INT);

				if ($stmt->execute()) {

					// Permitir la transacción.
			    $pdo->commit();

			    return "ok";

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
	EDITAR REGISTRO DE REFERENCIA
	=============================================*/
	static public function mdlEditarReferencia($tabla, $datos) {

		$sql = "UPDATE $tabla SET id_establecimiento = :id_establecimiento, adecuado = :adecuado, justificado = :justificado, oportuno = :oportuno WHERE id = :id";

		$stmt = Conexion::connectPostgres()->prepare($sql);
		
		$stmt->bindParam(":id_establecimiento", $datos["id_establecimiento"], PDO::PARAM_INT);
		$stmt->bindParam(":adecuado", $datos["adecuado"], PDO::PARAM_INT);
		$stmt->bindParam(":justificado", $datos["justificado"], PDO::PARAM_INT);
		$stmt->bindParam(":oportuno", $datos["oportuno"], PDO::PARAM_INT);
		// $stmt->bindParam(":id_paciente_ingreso", $datos["id_paciente_ingreso"], PDO::PARAM_INT);
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