<?php

require_once "conexion.db.php";

class ModelMaternidades {

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA PACIENTES INGRESOS
	=============================================*/
	static public function mdlContarMaternidades($tabla) {

		// devuelve el numero de registros de la consulta
		$sql = "SELECT m.id 
		FROM paciente_ingresos pi2
		INNER JOIN pacientes p
		ON pi2.id_paciente = p.id
		INNER JOIN maternidades m
		ON pi2.id = m.id_paciente_ingreso 
		LEFT JOIN paciente_egresos pe
		ON pi2.id = pe.id_paciente_ingreso
		INNER JOIN consultorios c2
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
		ON pi2.id_servicio = s.id";

		$stmt = Conexion::connectPostgres()->prepare($sql);

		$stmt->execute();

		return $stmt->rowCount();

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA PACIENTES INGRESOS FILTRADO
	=============================================*/
	static public function mdlContarFiltradoMaternidades($tabla, $sql) {

		if($sql == "") {

			// devuelve el numero de registros de la consulta

			$sql2 = "SELECT m.id 
			FROM paciente_ingresos pi2
			INNER JOIN pacientes p
			ON pi2.id_paciente = p.id
			INNER JOIN maternidades m
			ON pi2.id = m.id_paciente_ingreso 
			LEFT JOIN paciente_egresos pe
			ON pi2.id = pe.id_paciente_ingreso
			INNER JOIN consultorios c2
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
			ON pi2.id_servicio = s.id";

			$stmt = Conexion::connectPostgres()->prepare($sql2);

			$stmt->execute();

			$cuenta_col = $stmt->rowCount();

			return $cuenta_col;

		} else {

			// devuelve el numero de registros de la consulta

			$sql2 = "SELECT m.id 
			FROM paciente_ingresos pi2
			INNER JOIN pacientes p
			ON pi2.id_paciente = p.id
			INNER JOIN maternidades m
			ON pi2.id = m.id_paciente_ingreso 
			LEFT JOIN paciente_egresos pe
			ON pi2.id = pe.id_paciente_ingreso
			INNER JOIN consultorios c2
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
	MOSTRAR LISTADO DE MATERNIDADES
	=============================================*/
	static public function mdlMostrarMaternidades($tabla, $sql) {

		$sql = "SELECT m.id, pi2.id_paciente, m.id_paciente_ingreso, pi2.fecha_ingreso, pi2.hora_ingreso, p.nombre_paciente, p.paterno_paciente, p.materno_paciente, c3.nombre_consultorio as procedencia, p.fecha_nacimiento, p.sexo, p.cod_beneficiario, p.estado_civil, c2.nombre_consultorio as zona, c.nombre_cama, p.cod_asegurado, p.nro_empleador, p.cod_asegurado, p.nro_empleador, c10_ingreso.codigo as cie10_cod_ingreso, c10_ingreso.descripcion as cie10_diag_ingreso, s.nombre_servicio, c10_egreso.codigo as cie10_cod_egreso, c10_egreso.descripcion as cie10_diag_egreso, pe.fecha_egreso, pe.hora_egreso, pe.causa_egreso, m.fecha_nacido, m.hora_nacido, m.peso_nacido1, m.sexo_nacido1, m.peso_nacido2, m.sexo_nacido2, m.peso_nacido3, m.sexo_nacido3, m.tipo_parto, m.edad_gestacional
		FROM paciente_ingresos pi2
		INNER JOIN pacientes p
		ON pi2.id_paciente = p.id
		INNER JOIN maternidades m
		ON pi2.id = m.id_paciente_ingreso 
		LEFT JOIN paciente_egresos pe
		ON pi2.id = pe.id_paciente_ingreso
		INNER JOIN consultorios c2
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
		$sql";

		$stmt = Conexion::connectPostgres()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR DATOS DE MATERNIDAD
	=============================================*/
	static public function mdlMostrarMaternidad($tabla, $item, $valor) {

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
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA MATERNIDADES (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function mdlContarMaternidadesFecha($tabla, $item1, $valor1, $item2, $valor2) {

		// devuelve el numero de registros de la consulta
		$sql = "SELECT m.id 
		FROM paciente_ingresos pi2
		INNER JOIN pacientes p
		ON pi2.id_paciente = p.id
		INNER JOIN maternidades m
		ON pi2.id = m.id_paciente_ingreso 
		LEFT JOIN paciente_egresos pe
		ON pi2.id = pe.id_paciente_ingreso
		INNER JOIN consultorios c2
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
		AND pe.fecha_egreso BETWEEN :$item1 AND :$item2";

		$stmt = Conexion::connectPostgres()->prepare($sql);

		$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->rowCount();

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA MATERNIDADES (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function mdlContarFiltradoMaternidadesFecha($tabla, $item1, $valor1, $item2, $valor2, $sql) {

		if($sql == "") {

			// devuelve el numero de registros de la consulta

			$sql2 = "SELECT m.id 
			FROM paciente_ingresos pi2
			INNER JOIN pacientes p
			ON pi2.id_paciente = p.id
			INNER JOIN maternidades m
			ON pi2.id = m.id_paciente_ingreso 
			LEFT JOIN paciente_egresos pe
			ON pi2.id = pe.id_paciente_ingreso
			INNER JOIN consultorios c2
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
			AND pe.fecha_egreso BETWEEN :$item1 AND :$item2";

			$stmt = Conexion::connectPostgres()->prepare($sql2);

			$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
			$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

			$stmt->execute();

			$cuenta_col = $stmt->rowCount();

			return $cuenta_col;

		} else {

			// devuelve el numero de registros de la consulta

			$sql2 = "SELECT m.id 
			FROM paciente_ingresos pi2
			INNER JOIN pacientes p
			ON pi2.id_paciente = p.id
			INNER JOIN maternidades m
			ON pi2.id = m.id_paciente_ingreso 
			LEFT JOIN paciente_egresos pe
			ON pi2.id = pe.id_paciente_ingreso
			INNER JOIN consultorios c2
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
			AND pe.fecha_egreso BETWEEN :$item1 AND :$item2 
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
	MOSTRAR LISTADO MATERNIDADES (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function mdlMostrarMaternidadesFecha($tabla, $item1, $valor1, $item2, $valor2, $sql) {

		$sql2 = "SELECT m.id, pi2.id_paciente, m.id_paciente_ingreso, pi2.fecha_ingreso, pi2.hora_ingreso, p.nombre_paciente, p.paterno_paciente, p.materno_paciente, c3.nombre_consultorio as procedencia, p.fecha_nacimiento, p.sexo, p.cod_beneficiario, p.estado_civil, c2.nombre_consultorio as zona, c.nombre_cama, p.cod_asegurado, p.nro_empleador, p.cod_asegurado, p.nro_empleador, c10_ingreso.codigo as cie10_cod_ingreso, c10_ingreso.descripcion as cie10_diag_ingreso, s.nombre_servicio, c10_egreso.codigo as cie10_cod_egreso, c10_egreso.descripcion as cie10_diag_egreso, pe.fecha_egreso, pe.hora_egreso, pe.causa_egreso, m.fecha_nacido, m.hora_nacido, m.peso_nacido1, m.sexo_nacido1, m.peso_nacido2, m.sexo_nacido2, m.peso_nacido3, m.sexo_nacido3, m.tipo_parto, m.edad_gestacional
			FROM paciente_ingresos pi2
			INNER JOIN pacientes p
			ON pi2.id_paciente = p.id
			INNER JOIN maternidades m
			ON pi2.id = m.id_paciente_ingreso 
			LEFT JOIN paciente_egresos pe
			ON pi2.id = pe.id_paciente_ingreso
			INNER JOIN consultorios c2
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
			AND pe.fecha_egreso BETWEEN :$item1 AND :$item2 
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
	REGISTRO DE NUEVA MATERNIDAD
	=============================================*/
	static public function mdlNuevoMaternidad($tabla, $datos) {

		$pdo = Conexion::connectPostgres();

		try {
 
	    //Inicio de las transacciones.
	    $pdo->beginTransaction();

	    // Consulta 1: Registrar nueva materniadad de paciente
			$sql = "INSERT INTO $tabla(procedencia, paridad, edad_gestacional, tipo_intervencion, tipo_parto, tipo_aborto, liquido_amniotico, fecha_nacido, hora_nacido, peso_nacido1, sexo_nacido1, estado_nacido1, peso_nacido2, sexo_nacido2, estado_nacido2, peso_nacido3, sexo_nacido3, estado_nacido3, alumbramiento, perine, sangrado, estado_madre, nombre_esposo, id_paciente_ingreso) VALUES (:procedencia, :paridad, :edad_gestacional, :tipo_intervencion, :tipo_parto, :tipo_aborto, :liquido_amniotico, :fecha_nacido, :hora_nacido, :peso_nacido1, :sexo_nacido1, :estado_nacido1, :peso_nacido2, :sexo_nacido2, :estado_nacido2, :peso_nacido3, :sexo_nacido3, :estado_nacido3, :alumbramiento, :perine, :sangrado, :estado_madre, :nombre_esposo, :id_paciente_ingreso)";

			$stmt = $pdo->prepare($sql);

			$stmt->bindParam(":procedencia", $datos["procedencia"], PDO::PARAM_STR);
			$stmt->bindParam(":paridad", $datos["paridad"], PDO::PARAM_STR);
			$stmt->bindParam(":edad_gestacional", $datos["edad_gestacional"], PDO::PARAM_STR);
			$stmt->bindParam(":tipo_intervencion", $datos["tipo_intervencion"], PDO::PARAM_STR);
			$stmt->bindParam(":tipo_parto", $datos["tipo_parto"], PDO::PARAM_STR);
	    $stmt->bindParam(":tipo_aborto", $datos["tipo_aborto"], PDO::PARAM_STR);
			$stmt->bindParam(":liquido_amniotico", $datos["liquido_amniotico"], PDO::PARAM_INT);
			$stmt->bindParam(":fecha_nacido", $datos["fecha_nacido"], PDO::PARAM_STR);
			$stmt->bindParam(":hora_nacido", $datos["hora_nacido"], PDO::PARAM_STR);
			$stmt->bindParam(":peso_nacido1", $datos["peso_nacido1"], PDO::PARAM_STR);
			$stmt->bindParam(":sexo_nacido1", $datos["sexo_nacido1"], PDO::PARAM_STR);
			$stmt->bindParam(":estado_nacido1", $datos["estado_nacido1"], PDO::PARAM_STR);
			$stmt->bindParam(":peso_nacido2", $datos["peso_nacido2"], PDO::PARAM_STR);
			$stmt->bindParam(":sexo_nacido2", $datos["sexo_nacido2"], PDO::PARAM_STR);
			$stmt->bindParam(":estado_nacido2", $datos["estado_nacido2"], PDO::PARAM_STR);
			$stmt->bindParam(":peso_nacido3", $datos["peso_nacido3"], PDO::PARAM_STR);
			$stmt->bindParam(":sexo_nacido3", $datos["sexo_nacido3"], PDO::PARAM_STR);
			$stmt->bindParam(":estado_nacido3", $datos["estado_nacido3"], PDO::PARAM_STR);
			$stmt->bindParam(":alumbramiento", $datos["alumbramiento"], PDO::PARAM_STR);
			$stmt->bindParam(":perine", $datos["perine"], PDO::PARAM_STR);
			$stmt->bindParam(":sangrado", $datos["sangrado"], PDO::PARAM_STR);
			$stmt->bindParam(":estado_madre", $datos["estado_madre"], PDO::PARAM_STR);
			$stmt->bindParam(":nombre_esposo", $datos["nombre_esposo"], PDO::PARAM_STR);
			$stmt->bindParam(":id_paciente_ingreso", $datos["id_paciente_ingreso"], PDO::PARAM_INT);

			if ($stmt->execute()) {

				// Consulta 2: Actualizacion de estado de maternidad de paciente ingresado.
		  	$sql2 = "UPDATE paciente_ingresos SET maternidad = 1 WHERE id = :id";

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
	EDITAR PERSONA ALTAS
	=============================================*/

	static public function mdlEditarMaternidad($tabla, $datos) {

		$sql = "UPDATE $tabla SET procedencia = :procedencia, paridad = :paridad, edad_gestacional =:edad_gestacional, tipo_intervencion = :tipo_intervencion, tipo_parto = :tipo_parto, tipo_aborto = :tipo_aborto, liquido_amniotico = :liquido_amniotico, fecha_nacido = :fecha_nacido, hora_nacido = :hora_nacido, peso_nacido1 = :peso_nacido1, sexo_nacido1 = :sexo_nacido1, estado_nacido1 = :estado_nacido1, peso_nacido2 = :peso_nacido2, sexo_nacido2 = :sexo_nacido2, estado_nacido2 = :estado_nacido2, peso_nacido3 = :peso_nacido3, sexo_nacido3 = :sexo_nacido3, estado_nacido3 = :estado_nacido3, alumbramiento = :alumbramiento, perine = :perine, sangrado = :sangrado, estado_madre = :estado_madre, nombre_esposo = :nombre_esposo WHERE id = :id";

		$stmt = Conexion::connectPostgres()->prepare($sql);
		
		$stmt->bindParam(":procedencia", $datos["procedencia"], PDO::PARAM_STR);
		$stmt->bindParam(":paridad", $datos["paridad"], PDO::PARAM_STR);
		$stmt->bindParam(":edad_gestacional", $datos["edad_gestacional"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_intervencion", $datos["tipo_intervencion"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_parto", $datos["tipo_parto"], PDO::PARAM_STR);
    $stmt->bindParam(":tipo_aborto", $datos["tipo_aborto"], PDO::PARAM_STR);
		$stmt->bindParam(":liquido_amniotico", $datos["liquido_amniotico"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_nacido", $datos["fecha_nacido"], PDO::PARAM_STR);
		$stmt->bindParam(":hora_nacido", $datos["hora_nacido"], PDO::PARAM_STR);
		$stmt->bindParam(":peso_nacido1", $datos["peso_nacido1"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo_nacido1", $datos["sexo_nacido1"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_nacido1", $datos["estado_nacido1"], PDO::PARAM_STR);
		$stmt->bindParam(":peso_nacido2", $datos["peso_nacido2"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo_nacido2", $datos["sexo_nacido2"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_nacido2", $datos["estado_nacido2"], PDO::PARAM_STR);
		$stmt->bindParam(":peso_nacido3", $datos["peso_nacido3"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo_nacido3", $datos["sexo_nacido3"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_nacido3", $datos["estado_nacido3"], PDO::PARAM_STR);
		$stmt->bindParam(":alumbramiento", $datos["alumbramiento"], PDO::PARAM_STR);
		$stmt->bindParam(":perine", $datos["perine"], PDO::PARAM_STR);
		$stmt->bindParam(":sangrado", $datos["sangrado"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_madre", $datos["estado_madre"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_esposo", $datos["nombre_esposo"], PDO::PARAM_STR);
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

	/*=============================================
	ACTUALIZAR PERSONA ALTAS
	=============================================*/

	static public function mdlActualizarMaternidad($tabla, $item1, $valor1, $item2, $valor2) {

		$stmt = Conexion::conect()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

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