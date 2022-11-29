<?php

require_once "conexion.db.php";

class ModelNeonatos {

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA NEONATOS
	=============================================*/
	static public function mdlContarNeonatos($tabla) {

		// devuelve el numero de registros de la consulta
		$sql = "SELECT n.id, pi2.fecha_ingreso, pi2.hora_ingreso, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, c.nombre_cama, p.sexo, n.peso_neonato, n.talla_neonato, n.pc_neonato, n.pt_neonato, n.apgar, n.edad_gestacional_neonato, p.cod_asegurado, p.nro_empleador, n.tipo_parto_neonato, pi2.diagnostico_especifico1, pi2.diagnostico_especifico2, pi2.diagnostico_especifico3, pe.diagnostico_egreso1, pe.diagnostico_egreso2, pe.diagnostico_egreso3, p.id_consultorio, c2.nombre_consultorio, pe.fecha_egreso, pe.hora_egreso, pe.causa_egreso, n.descripcion_parto 
			FROM paciente_ingresos pi2
			INNER JOIN pacientes p
			ON pi2.id_paciente = p.id
			INNER JOIN neonatos n
			ON pi2.id = n.id_paciente_ingreso 
			LEFT JOIN paciente_egresos pe
			ON pi2.id = pe.id_paciente_ingreso
			INNER JOIN consultorios c2
			ON p.id_consultorio = c2.id
			INNER JOIN salas s2
			ON pi2.id_sala = s2.id
			INNER JOIN camas c
			ON pi2.id_cama = c.id
			INNER JOIN servicios s
			ON pi2.id_servicio = s.id";

		$stmt = Conexion::connectPostgres()->prepare($sql);

		$stmt->execute();

		return $stmt->rowCount();

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA NEONATOS FILTRADO
	=============================================*/
	static public function mdlContarFiltradoNeonatos($tabla, $sql) {

		if($sql == "") {

			// devuelve el numero de registros de la consulta

			$sql2 = "SELECT n.id, pi2.fecha_ingreso, pi2.hora_ingreso, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, c.nombre_cama, p.sexo, n.peso_neonato, n.talla_neonato, n.pc_neonato, n.pt_neonato, n.apgar, n.edad_gestacional_neonato, p.cod_asegurado, p.nro_empleador, n.tipo_parto_neonato, pi2.diagnostico_especifico1, pi2.diagnostico_especifico2, pi2.diagnostico_especifico3, pe.diagnostico_egreso1, pe.diagnostico_egreso2, pe.diagnostico_egreso3, p.id_consultorio, c2.nombre_consultorio, pe.fecha_egreso, pe.hora_egreso, pe.causa_egreso, n.descripcion_parto 
			FROM paciente_ingresos pi2
			INNER JOIN pacientes p
			ON pi2.id_paciente = p.id
			INNER JOIN neonatos n
			ON pi2.id = n.id_paciente_ingreso 
			LEFT JOIN paciente_egresos pe
			ON pi2.id = pe.id_paciente_ingreso
			INNER JOIN consultorios c2
			ON p.id_consultorio = c2.id
			INNER JOIN salas s2
			ON pi2.id_sala = s2.id
			INNER JOIN camas c
			ON pi2.id_cama = c.id
			INNER JOIN servicios s
			ON pi2.id_servicio = s.id";

			$stmt = Conexion::connectPostgres()->prepare($sql2);

			$stmt->execute();

			$cuenta_col = $stmt->rowCount();

			return $cuenta_col;

		} else {

			// devuelve el numero de registros de la consulta

			$sql2 = "SELECT n.id, pi2.fecha_ingreso, pi2.hora_ingreso, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, c.nombre_cama, p.sexo, n.peso_neonato, n.talla_neonato, n.pc_neonato, n.pt_neonato, n.apgar, n.edad_gestacional_neonato, p.cod_asegurado, p.nro_empleador, n.tipo_parto_neonato, pi2.diagnostico_especifico1, pi2.diagnostico_especifico2, pi2.diagnostico_especifico3, pe.diagnostico_egreso1, pe.diagnostico_egreso2, pe.diagnostico_egreso3, p.id_consultorio, c2.nombre_consultorio, pe.fecha_egreso, pe.hora_egreso, pe.causa_egreso, n.descripcion_parto 
			FROM paciente_ingresos pi2
			INNER JOIN pacientes p
			ON pi2.id_paciente = p.id
			INNER JOIN neonatos n
			ON pi2.id = n.id_paciente_ingreso 
			LEFT JOIN paciente_egresos pe
			ON pi2.id = pe.id_paciente_ingreso
			INNER JOIN consultorios c2
			ON p.id_consultorio = c2.id
			INNER JOIN salas s2
			ON pi2.id_sala = s2.id
			INNER JOIN camas c
			ON pi2.id_cama = c.id
			INNER JOIN servicios s
			ON pi2.id_servicio = s.id $sql";

			$stmt = Conexion::connectPostgres()->prepare($sql2);

			$stmt->execute();

			$cuenta_col = $stmt->rowCount();

			return $cuenta_col;

		}

		$stmt->close();
		$stmt = null;

	}
	
	/*=============================================
	MOSTRAR LISTADO DE NEONATOS
	=============================================*/
	static public function mdlMostrarNeonatos($tabla, $sql) {

		$sql2 = "SELECT n.id, pi2.fecha_ingreso, pi2.hora_ingreso, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, c.nombre_cama, p.sexo, n.peso_neonato, n.talla_neonato, n.pc_neonato, n.pt_neonato, n.apgar, n.edad_gestacional_neonato, p.cod_asegurado, p.nro_empleador, n.tipo_parto_neonato, pi2.diagnostico_especifico1, pi2.diagnostico_especifico2, pi2.diagnostico_especifico3, pe.diagnostico_egreso1, pe.diagnostico_egreso2, pe.diagnostico_egreso3, p.id_consultorio, c2.nombre_consultorio, pe.fecha_egreso, pe.hora_egreso, pe.causa_egreso, n.descripcion_parto 
		FROM paciente_ingresos pi2
		INNER JOIN pacientes p
		ON pi2.id_paciente = p.id
		INNER JOIN neonatos n
		ON pi2.id = n.id_paciente_ingreso 
		LEFT JOIN paciente_egresos pe
		ON pi2.id = pe.id_paciente_ingreso
		INNER JOIN consultorios c2
		ON p.id_consultorio = c2.id
		INNER JOIN salas s2
		ON pi2.id_sala = s2.id
		INNER JOIN camas c
		ON pi2.id_cama = c.id
		INNER JOIN servicios s
		ON pi2.id_servicio = s.id $sql";

		$stmt = Conexion::connectPostgres()->prepare($sql2);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR DATOS DE NEONATO
	=============================================*/
	static public function mdlMostrarNeonato($tabla, $item, $valor) {

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
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA NEONATOS (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function mdlContarNeonatosFecha($tabla, $item1, $valor1, $item2, $valor2) {

		// devuelve el numero de registros de la consulta
		$sql = "SELECT n.id, pi2.fecha_ingreso, pi2.hora_ingreso, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, c.nombre_cama, p.sexo, n.peso_neonato, n.talla_neonato, n.pc_neonato, n.pt_neonato, n.apgar, n.edad_gestacional_neonato, p.cod_asegurado, p.nro_empleador, n.tipo_parto_neonato, pi2.diagnostico_especifico1, pi2.diagnostico_especifico2, pi2.diagnostico_especifico3, pe.diagnostico_egreso1, pe.diagnostico_egreso2, pe.diagnostico_egreso3, p.id_consultorio, c2.nombre_consultorio, pe.fecha_egreso, pe.hora_egreso, pe.causa_egreso, n.descripcion_parto 
			FROM paciente_ingresos pi2
			INNER JOIN pacientes p
			ON pi2.id_paciente = p.id
			INNER JOIN neonatos n
			ON pi2.id = n.id_paciente_ingreso 
			LEFT JOIN paciente_egresos pe
			ON pi2.id = pe.id_paciente_ingreso
			INNER JOIN consultorios c2
			ON p.id_consultorio = c2.id
			INNER JOIN salas s2
			ON pi2.id_sala = s2.id
			INNER JOIN camas c
			ON pi2.id_cama = c.id
			INNER JOIN servicios s
			ON pi2.id_servicio = s.id
			AND pi2.fecha_ingreso BETWEEN :$item1 AND :$item2";

		$stmt = Conexion::connectPostgres()->prepare($sql);

		$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->rowCount();

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA NEONATOS (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function mdlContarFiltradoNeonatosFecha($tabla, $item1, $valor1, $item2, $valor2, $sql) {

		if($sql == "") {

			// devuelve el numero de registros de la consulta

			$sql2 = "SELECT n.id, pi2.fecha_ingreso, pi2.hora_ingreso, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, c.nombre_cama, p.sexo, n.peso_neonato, n.talla_neonato, n.pc_neonato, n.pt_neonato, n.apgar, n.edad_gestacional_neonato, p.cod_asegurado, p.nro_empleador, n.tipo_parto_neonato, pi2.diagnostico_especifico1, pi2.diagnostico_especifico2, pi2.diagnostico_especifico3, pe.diagnostico_egreso1, pe.diagnostico_egreso2, pe.diagnostico_egreso3, p.id_consultorio, c2.nombre_consultorio, pe.fecha_egreso, pe.hora_egreso, pe.causa_egreso, n.descripcion_parto 
			FROM paciente_ingresos pi2
			INNER JOIN pacientes p
			ON pi2.id_paciente = p.id
			INNER JOIN neonatos n
			ON pi2.id = n.id_paciente_ingreso 
			LEFT JOIN paciente_egresos pe
			ON pi2.id = pe.id_paciente_ingreso
			INNER JOIN consultorios c2
			ON p.id_consultorio = c2.id
			INNER JOIN salas s2
			ON pi2.id_sala = s2.id
			INNER JOIN camas c
			ON pi2.id_cama = c.id
			INNER JOIN servicios s
			ON pi2.id_servicio = s.id 
			AND pi2.fecha_ingreso BETWEEN :$item1 AND :$item2";

			$stmt = Conexion::connectPostgres()->prepare($sql2);

			$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
			$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

			$stmt->execute();

			$cuenta_col = $stmt->rowCount();

			return $cuenta_col;

		} else {

			// devuelve el numero de registros de la consulta

			$sql2 = "SELECT n.id, pi2.fecha_ingreso, pi2.hora_ingreso, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, c.nombre_cama, p.sexo, n.peso_neonato, n.talla_neonato, n.pc_neonato, n.pt_neonato, n.apgar, n.edad_gestacional_neonato, p.cod_asegurado, p.nro_empleador, n.tipo_parto_neonato, pi2.diagnostico_especifico1, pi2.diagnostico_especifico2, pi2.diagnostico_especifico3, pe.diagnostico_egreso1, pe.diagnostico_egreso2, pe.diagnostico_egreso3, p.id_consultorio, c2.nombre_consultorio, pe.fecha_egreso, pe.hora_egreso, pe.causa_egreso, n.descripcion_parto 
			FROM paciente_ingresos pi2
			INNER JOIN pacientes p
			ON pi2.id_paciente = p.id
			INNER JOIN neonatos n
			ON pi2.id = n.id_paciente_ingreso 
			LEFT JOIN paciente_egresos pe
			ON pi2.id = pe.id_paciente_ingreso
			INNER JOIN consultorios c2
			ON p.id_consultorio = c2.id
			INNER JOIN salas s2
			ON pi2.id_sala = s2.id
			INNER JOIN camas c
			ON pi2.id_cama = c.id
			INNER JOIN servicios s
			ON pi2.id_servicio = s.id 
			AND pi2.fecha_ingreso BETWEEN :$item1 AND :$item2 
			$sql";

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
	MOSTRAR LISTADO NEONATOS (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function mdlMostrarNeonatosFecha($tabla, $item1, $valor1, $item2, $valor2, $sql) {

		$sql2 = "SELECT n.id, pi2.fecha_ingreso, pi2.hora_ingreso, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, c.nombre_cama, p.sexo, n.peso_neonato, n.talla_neonato, n.pc_neonato, n.pt_neonato, n.apgar, n.edad_gestacional_neonato, p.cod_asegurado, p.nro_empleador, n.tipo_parto_neonato, pi2.diagnostico_especifico1, pi2.diagnostico_especifico2, pi2.diagnostico_especifico3, pe.diagnostico_egreso1, pe.diagnostico_egreso2, pe.diagnostico_egreso3, p.id_consultorio, c2.nombre_consultorio, pe.fecha_egreso, pe.hora_egreso, pe.causa_egreso, n.descripcion_parto 
			FROM paciente_ingresos pi2
			INNER JOIN pacientes p
			ON pi2.id_paciente = p.id
			INNER JOIN neonatos n
			ON pi2.id = n.id_paciente_ingreso 
			LEFT JOIN paciente_egresos pe
			ON pi2.id = pe.id_paciente_ingreso
			INNER JOIN consultorios c2
			ON p.id_consultorio = c2.id
			INNER JOIN salas s2
			ON pi2.id_sala = s2.id
			INNER JOIN camas c
			ON pi2.id_cama = c.id
			INNER JOIN servicios s
			ON pi2.id_servicio = s.id 
			AND pi2.fecha_ingreso BETWEEN :$item1 AND :$item2 
			$sql";
		
		$stmt = Conexion::connectPostgres()->prepare($sql2);

		$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}
  
  /*=============================================
	REGISTRO DE NUEVO NEONATO
	=============================================*/
	static public function mdlNuevoNeonato($tabla, $datos) {

		$pdo = Conexion::connectPostgres();

		try {
 
	    //Inicio de las transacciones.
	    $pdo->beginTransaction();

	    // Consulta 1: Registrar nueva materniadad de paciente
			$sql = "INSERT INTO $tabla(peso_neonato, talla_neonato, pc_neonato, pt_neonato, apgar, edad_gestacional_neonato, tipo_parto_neonato, descripcion_parto, id_paciente_ingreso) VALUES (:peso_neonato, :talla_neonato, :pc_neonato, :pt_neonato, :apgar, :edad_gestacional_neonato, :tipo_parto_neonato, :descripcion_parto, :id_paciente_ingreso)";

			$stmt = $pdo->prepare($sql);

			$stmt->bindParam(":peso_neonato", $datos["peso_neonato"], PDO::PARAM_STR);
			$stmt->bindParam(":talla_neonato", $datos["talla_neonato"], PDO::PARAM_STR);
			$stmt->bindParam(":pc_neonato", $datos["pc_neonato"], PDO::PARAM_STR);
			$stmt->bindParam(":pt_neonato", $datos["pt_neonato"], PDO::PARAM_STR);
			$stmt->bindParam(":apgar", $datos["apgar"], PDO::PARAM_STR);
			$stmt->bindParam(":edad_gestacional_neonato", $datos["edad_gestacional_neonato"], PDO::PARAM_STR);
			$stmt->bindParam(":tipo_parto_neonato", $datos["tipo_parto_neonato"], PDO::PARAM_STR);
			$stmt->bindParam(":descripcion_parto", $datos["descripcion_parto"], PDO::PARAM_STR);
			$stmt->bindParam(":id_paciente_ingreso", $datos["id_paciente_ingreso"], PDO::PARAM_INT);

			if ($stmt->execute()) {

				// Consulta 2: Actualizacion de estado de neonato de paciente ingresado.
		  	$sql2 = "UPDATE paciente_ingresos SET neonato = 1 WHERE id = :id";

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
	EDITAR RESGISTRO DE NEONATO
	=============================================*/
	static public function mdlEditarNeonato($tabla, $datos) {

		$sql = "UPDATE $tabla SET peso_neonato = :peso_neonato, talla_neonato = :talla_neonato, pc_neonato = :pc_neonato, pt_neonato = :pt_neonato, apgar = :apgar, edad_gestacional_neonato = :edad_gestacional_neonato, tipo_parto_neonato = :tipo_parto_neonato, descripcion_parto = :descripcion_parto WHERE id = :id";

		$stmt = Conexion::connectPostgres()->prepare($sql);
		
		$stmt->bindParam(":peso_neonato", $datos["peso_neonato"], PDO::PARAM_STR);
		$stmt->bindParam(":talla_neonato", $datos["talla_neonato"], PDO::PARAM_STR);
		$stmt->bindParam(":pc_neonato", $datos["pc_neonato"], PDO::PARAM_STR);
		$stmt->bindParam(":pt_neonato", $datos["pt_neonato"], PDO::PARAM_STR);
		$stmt->bindParam(":apgar", $datos["apgar"], PDO::PARAM_STR);
		$stmt->bindParam(":edad_gestacional_neonato", $datos["edad_gestacional_neonato"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_parto_neonato", $datos["tipo_parto_neonato"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_parto", $datos["descripcion_parto"], PDO::PARAM_STR);
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