<?php

require_once "conexion.db.php";

class ModelMaternidades {

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA PACIENTES INGRESOS
	=============================================*/
	static public function mdlContarMaternidades($tabla) {

		// devuelve el numero de registros de la consulta
		$sql = "SELECT m.id, pi2.fecha_ingreso, c2.nombre_consultorio, pi2.hora_ingreso, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, p.fecha_nacimiento, p.cod_asegurado, p.nro_empleador, p.nombre_empleador, p.estado_civil, m.procedencia, m.gestacion, m.paridad, m.cesarea, m.aborto, m.edad_gestacional_fum, m.edad_gestacional_ecografia, m.tipo_parto, m.liquido_amniotico, m.fecha_nacido, m.peso_nacido, m.hora_nacido, m.sexo_nacido, m.alumbramiento, m.perine, m.sangrado, m.estado_madre, m.nombre_esposo, s2.nombre_sala, c.nombre_cama, pe.causa_egreso 
				FROM paciente_ingresos pi2
				INNER JOIN pacientes p
				ON pi2.id_paciente = p.id
				INNER JOIN maternidades m
				ON pi2.id = m.id_paciente_ingreso
				LEFT JOIN paciente_egresos pe
				ON pi2.id = pe.id_paciente_ingreso
				INNER JOIN consultorios c2
				ON pi2.id_consultorio = c2.id
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

			$sql2 = "SELECT m.id, pi2.fecha_ingreso, c2.nombre_consultorio, pi2.hora_ingreso, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, p.fecha_nacimiento, p.cod_asegurado, p.nro_empleador, p.nombre_empleador, p.estado_civil, m.procedencia, m.gestacion, m.paridad, m.cesarea, m.aborto, m.edad_gestacional_fum, m.edad_gestacional_ecografia, m.tipo_parto, m.liquido_amniotico, m.fecha_nacido, m.peso_nacido, m.hora_nacido, m.sexo_nacido, m.alumbramiento, m.perine, m.sangrado, m.estado_madre, m.nombre_esposo, s2.nombre_sala, c.nombre_cama, pe.causa_egreso 
				FROM paciente_ingresos pi2
				INNER JOIN pacientes p
				ON pi2.id_paciente = p.id
				INNER JOIN maternidades m
				ON pi2.id = m.id_paciente_ingreso
				LEFT JOIN paciente_egresos pe
				ON pi2.id = pe.id_paciente_ingreso
				INNER JOIN consultorios c2
				ON pi2.id_consultorio = c2.id
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

			$sql2 = "SELECT m.id, pi2.fecha_ingreso, c2.nombre_consultorio, pi2.hora_ingreso, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, p.fecha_nacimiento, p.cod_asegurado, p.nro_empleador, p.nombre_empleador, p.estado_civil, m.procedencia, m.gestacion, m.paridad, m.cesarea, m.aborto, m.edad_gestacional_fum, m.edad_gestacional_ecografia, m.tipo_parto, m.liquido_amniotico, m.fecha_nacido, m.peso_nacido, m.hora_nacido, m.sexo_nacido, m.alumbramiento, m.perine, m.sangrado, m.estado_madre, m.nombre_esposo, s2.nombre_sala, c.nombre_cama, pe.causa_egreso 
				FROM paciente_ingresos pi2
				INNER JOIN pacientes p
				ON pi2.id_paciente = p.id
				INNER JOIN maternidades m
				ON pi2.id = m.id_paciente_ingreso
				LEFT JOIN paciente_egresos pe
				ON pi2.id = pe.id_paciente_ingreso
				INNER JOIN consultorios c2
				ON pi2.id_consultorio = c2.id
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
	MOSTRAR LISTADO DE MATERNIDADES
	=============================================*/
	static public function mdlMostrarMaternidades($tabla, $sql) {

		$sql = "SELECT m.id, pi2.fecha_ingreso, c2.nombre_consultorio, pi2.hora_ingreso, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, p.fecha_nacimiento, p.cod_asegurado, p.nro_empleador, p.nombre_empleador, p.estado_civil, m.procedencia, m.gestacion, m.paridad, m.cesarea, m.aborto, m.edad_gestacional_fum, m.edad_gestacional_ecografia, m.tipo_parto, m.liquido_amniotico, m.fecha_nacido, m.peso_nacido, m.hora_nacido, m.sexo_nacido, m.alumbramiento, m.perine, m.sangrado, m.estado_madre, m.nombre_esposo, s2.nombre_sala, c.nombre_cama, pe.causa_egreso 
			FROM paciente_ingresos pi2
			INNER JOIN pacientes p
			ON pi2.id_paciente = p.id
			INNER JOIN maternidades m
			ON pi2.id = m.id_paciente_ingreso
			LEFT JOIN paciente_egresos pe
			ON pi2.id = pe.id_paciente_ingreso
			INNER JOIN consultorios c2
			ON pi2.id_consultorio = c2.id
			INNER JOIN salas s2
			ON pi2.id_sala = s2.id
			INNER JOIN camas c
			ON pi2.id_cama = c.id
			INNER JOIN servicios s
			ON pi2.id_servicio = s.id $sql";

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
		$sql = "SELECT m.id, pi2.fecha_ingreso, c2.nombre_consultorio, pi2.hora_ingreso, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, p.fecha_nacimiento, p.cod_asegurado, p.nro_empleador, p.nombre_empleador, p.estado_civil, m.procedencia, m.gestacion, m.paridad, m.cesarea, m.aborto, m.edad_gestacional_fum, m.edad_gestacional_ecografia, m.tipo_parto, m.liquido_amniotico, m.fecha_nacido, m.peso_nacido, m.hora_nacido, m.sexo_nacido, m.alumbramiento, m.perine, m.sangrado, m.estado_madre, m.nombre_esposo, s2.nombre_sala, c.nombre_cama, pe.causa_egreso 
			FROM paciente_ingresos pi2
			INNER JOIN pacientes p
			ON pi2.id_paciente = p.id
			INNER JOIN maternidades m
			ON pi2.id = m.id_paciente_ingreso
			LEFT JOIN paciente_egresos pe
			ON pi2.id = pe.id_paciente_ingreso
			INNER JOIN consultorios c2
			ON pi2.id_consultorio = c2.id
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
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA MATERNIDADES (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function mdlContarFiltradoMaternidadesFecha($tabla, $item1, $valor1, $item2, $valor2, $sql) {

		if($sql == "") {

			// devuelve el numero de registros de la consulta

			$sql2 = "SELECT m.id, pi2.fecha_ingreso, c2.nombre_consultorio, pi2.hora_ingreso, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, p.fecha_nacimiento, p.cod_asegurado, p.nro_empleador, p.nombre_empleador, p.estado_civil, m.procedencia, m.gestacion, m.paridad, m.cesarea, m.aborto, m.edad_gestacional_fum, m.edad_gestacional_ecografia, m.tipo_parto, m.liquido_amniotico, m.fecha_nacido, m.peso_nacido, m.hora_nacido, m.sexo_nacido, m.alumbramiento, m.perine, m.sangrado, m.estado_madre, m.nombre_esposo, s2.nombre_sala, c.nombre_cama, pe.causa_egreso 
			FROM paciente_ingresos pi2
			INNER JOIN pacientes p
			ON pi2.id_paciente = p.id
			INNER JOIN maternidades m
			ON pi2.id = m.id_paciente_ingreso
			LEFT JOIN paciente_egresos pe
			ON pi2.id = pe.id_paciente_ingreso
			INNER JOIN consultorios c2
			ON pi2.id_consultorio = c2.id
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

			$sql2 = "SELECT m.id, pi2.fecha_ingreso, c2.nombre_consultorio, pi2.hora_ingreso, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, p.fecha_nacimiento, p.cod_asegurado, p.nro_empleador, p.nombre_empleador, p.estado_civil, m.procedencia, m.gestacion, m.paridad, m.cesarea, m.aborto, m.edad_gestacional_fum, m.edad_gestacional_ecografia, m.tipo_parto, m.liquido_amniotico, m.fecha_nacido, m.peso_nacido, m.hora_nacido, m.sexo_nacido, m.alumbramiento, m.perine, m.sangrado, m.estado_madre, m.nombre_esposo, s2.nombre_sala, c.nombre_cama, pe.causa_egreso 
			FROM paciente_ingresos pi2
			INNER JOIN pacientes p
			ON pi2.id_paciente = p.id
			INNER JOIN maternidades m
			ON pi2.id = m.id_paciente_ingreso
			LEFT JOIN paciente_egresos pe
			ON pi2.id = pe.id_paciente_ingreso
			INNER JOIN consultorios c2
			ON pi2.id_consultorio = c2.id
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
	MOSTRAR LISTADO MATERNIDADES (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function mdlMostrarMaternidadesFecha($tabla, $item1, $valor1, $item2, $valor2, $sql) {

		$sql2 = "SELECT m.id, pi2.fecha_ingreso, c2.nombre_consultorio, pi2.hora_ingreso, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, p.fecha_nacimiento, p.cod_asegurado, p.nro_empleador, p.nombre_empleador, p.estado_civil, m.procedencia, m.gestacion, m.paridad, m.cesarea, m.aborto, m.edad_gestacional_fum, m.edad_gestacional_ecografia, m.tipo_parto, m.liquido_amniotico, m.fecha_nacido, m.peso_nacido, m.hora_nacido, m.sexo_nacido, m.alumbramiento, m.perine, m.sangrado, m.estado_madre, m.nombre_esposo, s2.nombre_sala, c.nombre_cama, pe.causa_egreso 
			FROM paciente_ingresos pi2
			INNER JOIN pacientes p
			ON pi2.id_paciente = p.id
			INNER JOIN maternidades m
			ON pi2.id = m.id_paciente_ingreso
			LEFT JOIN paciente_egresos pe
			ON pi2.id = pe.id_paciente_ingreso
			INNER JOIN consultorios c2
			ON pi2.id_consultorio = c2.id
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
	REGISTRO DE NUEVA MATERNIDAD
	=============================================*/
	static public function mdlNuevoMaternidad($tabla, $datos) {

		$pdo = Conexion::connectPostgres();

		try {
 
	    //Inicio de las transacciones.
	    $pdo->beginTransaction();

	    // Consulta 1: Registrar nueva materniadad de paciente
			$sql = "INSERT INTO $tabla(procedencia, gestacion, paridad, cesarea, aborto, edad_gestacional_fum, edad_gestacional_ecografia, tipo_intervencion, tipo_parto, tipo_aborto, liquido_amniotico, fecha_nacido, hora_nacido, peso_nacido, sexo_nacido, estado_nacido, alumbramiento, perine, sangrado, estado_madre, nombre_esposo, id_paciente_ingreso) VALUES (:procedencia, :gestacion, :paridad, :cesarea, :aborto,:edad_gestacional_fum, :edad_gestacional_ecografia, :tipo_intervencion, :tipo_parto, :tipo_aborto, :liquido_amniotico, :fecha_nacido, :hora_nacido, :peso_nacido, :sexo_nacido, :estado_nacido, :alumbramiento, :perine, :sangrado, :estado_madre, :nombre_esposo, :id_paciente_ingreso)";

			$stmt = $pdo->prepare($sql);

			$stmt->bindParam(":procedencia", $datos["procedencia"], PDO::PARAM_STR);
			$stmt->bindParam(":gestacion", $datos["gestacion"], PDO::PARAM_STR);
			$stmt->bindParam(":paridad", $datos["paridad"], PDO::PARAM_STR);
			$stmt->bindParam(":cesarea", $datos["cesarea"], PDO::PARAM_STR);
			$stmt->bindParam(":aborto", $datos["aborto"], PDO::PARAM_STR);
			$stmt->bindParam(":edad_gestacional_fum", $datos["edad_gestacional_fum"], PDO::PARAM_STR);
			$stmt->bindParam(":edad_gestacional_ecografia", $datos["edad_gestacional_ecografia"], PDO::PARAM_STR);
			$stmt->bindParam(":tipo_intervencion", $datos["tipo_intervencion"], PDO::PARAM_STR);
			$stmt->bindParam(":tipo_parto", $datos["tipo_parto"], PDO::PARAM_STR);
	    $stmt->bindParam(":tipo_aborto", $datos["tipo_aborto"], PDO::PARAM_STR);
			$stmt->bindParam(":liquido_amniotico", $datos["liquido_amniotico"], PDO::PARAM_INT);
			$stmt->bindParam(":fecha_nacido", $datos["fecha_nacido"], PDO::PARAM_STR);
			$stmt->bindParam(":hora_nacido", $datos["hora_nacido"], PDO::PARAM_STR);
			$stmt->bindParam(":peso_nacido", $datos["peso_nacido"], PDO::PARAM_STR);
			$stmt->bindParam(":sexo_nacido", $datos["sexo_nacido"], PDO::PARAM_STR);
			$stmt->bindParam(":estado_nacido", $datos["estado_nacido"], PDO::PARAM_STR);
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

		$sql = "UPDATE $tabla SET procedencia = :procedencia, gestacion = :gestacion, paridad = :paridad, cesarea = :cesarea, aborto = :aborto, edad_gestacional_fum =:edad_gestacional_fum, edad_gestacional_ecografia = :edad_gestacional_ecografia, tipo_intervencion = :tipo_intervencion, tipo_parto = :tipo_parto, tipo_aborto = :tipo_aborto, liquido_amniotico = :liquido_amniotico, fecha_nacido = :fecha_nacido, hora_nacido = :hora_nacido, peso_nacido = :peso_nacido, sexo_nacido = :sexo_nacido, estado_nacido = :estado_nacido, alumbramiento = :alumbramiento, perine = :perine, sangrado = :sangrado, estado_madre = :estado_madre, nombre_esposo = :nombre_esposo WHERE id = :id";

		$stmt = Conexion::connectPostgres()->prepare($sql);
		
		$stmt->bindParam(":procedencia", $datos["procedencia"], PDO::PARAM_STR);
		$stmt->bindParam(":gestacion", $datos["gestacion"], PDO::PARAM_STR);
		$stmt->bindParam(":paridad", $datos["paridad"], PDO::PARAM_STR);
		$stmt->bindParam(":cesarea", $datos["cesarea"], PDO::PARAM_STR);
		$stmt->bindParam(":aborto", $datos["aborto"], PDO::PARAM_STR);
		$stmt->bindParam(":edad_gestacional_fum", $datos["edad_gestacional_fum"], PDO::PARAM_STR);
		$stmt->bindParam(":edad_gestacional_ecografia", $datos["edad_gestacional_ecografia"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_intervencion", $datos["tipo_intervencion"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_parto", $datos["tipo_parto"], PDO::PARAM_STR);
    $stmt->bindParam(":tipo_aborto", $datos["tipo_aborto"], PDO::PARAM_STR);
		$stmt->bindParam(":liquido_amniotico", $datos["liquido_amniotico"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_nacido", $datos["fecha_nacido"], PDO::PARAM_STR);
		$stmt->bindParam(":hora_nacido", $datos["hora_nacido"], PDO::PARAM_STR);
		$stmt->bindParam(":peso_nacido", $datos["peso_nacido"], PDO::PARAM_STR);
		$stmt->bindParam(":sexo_nacido", $datos["sexo_nacido"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_nacido", $datos["estado_nacido"], PDO::PARAM_STR);
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