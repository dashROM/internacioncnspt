<?php

require_once "conexion.db.php";

class ModelEmpleadoresSIAIS {

	/*=============================================
	MOSTRAR EMPLEADORES DE LA BASE DE DATOS SIAIS
	=============================================*/
	
	static public function mdlMostrarEmpleadoresSIAIS($item, $valor) {

		if ($item != null) {

			// devuelve los campos que coincidan con el valor del item
			$sql = "SELECT * FROM hcl_empleador WHERE $item = '$valor'";
			$stmt = Conexion::connectSQLServer()->query($sql);

			return $stmt->fetch(PDO::FETCH_ASSOC);

		} else {

			// devuelve todos los datos de la tabla
			$sql = "SELECT e.idempleador, e.emp_nombre, e.emp_nro_empleador, e.emp_nro_padron, e.emp_telefono, e.emp_fecha_iniciacion, a.act_nombre FROM hcl_empleador e LEFT JOIN hcl_actividad_economica a ON e.idactividad = a.idactividad";
			$stmt = Conexion::connectSQLServer()->query($sql);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);

		}

		$stmt->close();
		$stmt = null;

	}

}