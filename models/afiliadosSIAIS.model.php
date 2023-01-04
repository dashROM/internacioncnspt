<?php

require_once "conexion.db.php";

class ModelAfiliadosSIAIS {

	/*=============================================
	MOSTRAR AFILIADOS DE LA BASE DE DATOS SIAIS
	=============================================*/
	static public function mdlMostrarAfiliadosSIAIS($item1, $item2, $valor) {

		
		if ($item1 != null && $item2 != null && $valor != null) {

			// devuelve los datos que coincidan con la busqueda
			$sql = "SELECT TOP 4000 * FROM vista_afiliadosSIAIS WHERE $item1 LIKE '%$valor%' OR $item2 LIKE '%$valor%'";

			$stmt = Conexion::connectSQLServer()->query($sql);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);	

			
		} elseif ($item1 != null && $item2 == null && $valor != null) {

			// devuelve los campos que coincidan con el valor del item
			$sql = "SELECT pa.idafiliacion, p.idpoblacion, pa.idempleador, e.emp_nro_empleador, e.emp_nombre, p.idestablecimiento, p.pac_numero_historia, p.pac_codigo, p.pac_nombre, p.pac_primer_apellido, p.pac_segundo_apellido, p.idsexo, p.pac_fecha_nac, p.pac_estado, p.pac_fecha_afiliacion, p.cua_nombre, p.est_nombre FROM hcl_poblacion_actual p, hcl_poblacion_afiliacion pa, hcl_empleador e WHERE p.idpoblacion = pa.idpoblacion AND pa.idempleador = e.idempleador AND e.idempleador = $valor";

			$stmt = Conexion::connectSQLServer()->query($sql);

			return $stmt->fetchAll(PDO::FETCH_ASSOC);

		} elseif ($item1 == null && $item2 != null && $valor != null) {

			// devuelve el dato de un beneficiaro en especifico de acuerdo al valor
			$sql = "SELECT pa.idafiliacion, p.idpoblacion, pa.idempleador, e.emp_nro_empleador, e.emp_nombre, p.idestablecimiento, p.pac_numero_historia, p.pac_codigo, p.pac_nombre, p.pac_primer_apellido, p.pac_segundo_apellido, p.idsexo, p.pac_fecha_nac, p.pac_estado, p.pac_fecha_afiliacion, p.cua_nombre, p.est_nombre FROM hcl_poblacion_actual p, hcl_poblacion_afiliacion pa, hcl_empleador e WHERE p.idpoblacion = pa.idpoblacion AND pa.idempleador = e.idempleador AND e.idempleador = pa.idempleador AND pa.idafiliacion = $valor";

			$stmt = Conexion::connectSQLServer()->query($sql);

			return $stmt->fetch(PDO::FETCH_ASSOC);

		}

		else {

			$stmt = Conexion::connectSQLServer()->query("SELECT TOP 4000 * FROM vista_afiliadosSIAIS");

		}

		$stmt->close();
		$stmt = null;

	}

}