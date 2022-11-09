<?php

class ControllerCie10{

	/*=============================================
	DATOS DE DIAGNOSTICO BUSCADO CIE10
	=============================================*/
	static public function ctrMostrarDiagnosticoCie10($item, $valor) {

		$tabla = "cie10";

		$respuesta = ModelCie10::mdlMostrarDiagnosticoCie10($tabla, $item, $valor);

		return $respuesta;

  }

  /*=============================================
	NUMERO DE COLUMNAS DE DIAGNOSTICO BUSCADO CIE10
	=============================================*/
	static public function ctrMostrarColumnasCie10($item, $valor) {

		$tabla = "cie10";

		$respuesta = ModelCie10::mdlMostrarColumnasCie10($tabla, $item, $valor);

		return $respuesta;

  }
	
}