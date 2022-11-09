<?php

require_once "conexion.db.php";

class ModelAltas {
	
	/*=============================================
	MOSTRAR PACIENTES
	=============================================*/
	
	static public function mdlMostrarAltas($tabla, $item, $valor) {

		if ($item != null) {
			
			$stmt = Conexion::conect()->prepare("SELECT * FROM  $tabla WHERE $item = :$item");

			$stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetch();

		} else {

			$stmt = Conexion::conect()->prepare("select p.pac_nombre,p.pac_primer_apellido,a.idaltas, a.fecha,a.hora,a.diagnosticoegreso,a.causaegreso,a.condicionegreso,m.per_nombre,a.causaclinica,a.causaautopsia 
			from  alta a , medicos m,pacientes p ,ingreso i 
			where  a.idaltas = m.idpersonalmedico and a.idpaciente = p.idpaciente  and a.idingreso= i.idingreso ORDER BY idaltas DESC");

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}
	/*=============================================
	REGISTRO DE NUEVA PERSONA
	=============================================*/

	static public function mdlNuevoAltas($tabla,$tabla_ingreso,$datos) {
		

		$pdo = Conexion::conect();
		try {	
			//inicio de la transaccion
		$pdo->beginTransaction();
	
		$stmt = $pdo->prepare("INSERT INTO $tabla(fecha, hora,diagnosticoegreso,causaegreso, 
		condicionegreso,idpersonalmedico,idpaciente,idingreso,causaclinica,causaautopsia,fallecido) VALUES (:fecha, :hora,:diagnosticoegreso,:causaegreso, :condicionegreso,:idpersonalmedico,:idpaciente,:idingreso,:causaclinica,:causaautopsia,:fallecido)");

		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":hora", $datos["hora"], PDO::PARAM_STR);
		$stmt->bindParam(":diagnosticoegreso", $datos["diagnosticoegreso"], PDO::PARAM_STR);
		$stmt->bindParam(":causaegreso", $datos["causaegreso"], PDO::PARAM_STR);
		$stmt->bindParam(":condicionegreso", $datos["condicionegreso"], PDO::PARAM_STR);
		$stmt->bindParam(":idpersonalmedico", $datos["idpersonalmedico"], PDO::PARAM_STR);
		$stmt->bindParam(":idpaciente", $datos["idpaciente"], PDO::PARAM_INT);
		$stmt->bindParam(":idingreso", $datos["idingreso"], PDO::PARAM_INT);
		$stmt->bindParam(":causaclinica", $datos["causaclinica"], PDO::PARAM_INT);
		$stmt->bindParam(":causaautopsia", $datos["causaautopsia"], PDO::PARAM_INT);
		$stmt->bindParam(":fallecido", $datos["fallecido"], PDO::PARAM_INT);

		if ($stmt->execute()) {

			
			$stmt2 = $pdo->prepare("UPDATE $tabla_ingreso SET estado = 1 WHERE idingreso = :idingreso"); 
			$stmt2->bindParam(":idingreso", $datos["idingreso"], PDO::PARAM_INT);
			
			if ($stmt2->execute()){
				
				$pdo->commit(); 
				return "ok";	
		 }else{
				$pdo->rollBack();
				return "error";
		
			  }
		}else {
			$pdo->rollBack();
			return "error";

		} 

		}catch(Exception $e){ 
		   echo 'Execption capturada:', $e->Message();
	  } 
		$stmt->close();
		$stmt = null;

	}
	
	/*=============================================
	EDITAR PERSONA ALTAS
	=============================================*/

		static public function mdlEditarAltas($tabla, $datos) {

		$stmt = Conexion::conect()->prepare("UPDATE $tabla SET fecha=:fecha, hora=:hora, diagnosticoegreso=:diagnosticoegreso, 
		condicionegreso = :condicionegreso, causaegreso =:causaegreso, causamuerte=:causamuerte WHERE idaltas = :idaltas");
		
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":hora", $datos["hora"], PDO::PARAM_STR);
		$stmt->bindParam(":diagnosticoegreso", $datos["diagnosticoegreso"], PDO::PARAM_STR);
		$stmt->bindParam(":condicionegreso", $datos["condicionegreso"], PDO::PARAM_STR);
		$stmt->bindParam(":causaegreso", $datos["causaegreso"], PDO::PARAM_STR);
		$stmt->bindParam(":causamuerte", $datos["causamuerte"], PDO::PARAM_STR);
	    $stmt->bindParam(":idaltas", $datos["idaltas"], PDO::PARAM_INT);

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

	static public function mdlActualizarAltas($tabla, $item1, $valor1, $item2, $valor2) {

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
