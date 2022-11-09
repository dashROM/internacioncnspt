<?php 

class ControllerReferencias {

	/*=============================================
	DATOS DE REFERENCIA PACIENTE
	=============================================*/
	static public function ctrMostrarReferencia($item, $valor) {

		$tabla = "referencias";

		$respuesta = ModelReferencias::mdlMostrarReferencia($tabla, $item, $valor);

		return $respuesta;

	}
	
	/*=============================================
	NUEVO REGISTRO DE REFERENCIA
	=============================================*/
	static public function ctrNuevoReferencia($datos) {
		
		$tabla = "referencias";

		$respuesta = ModelReferencias::mdlNuevoReferencia($tabla, $datos);

		return $respuesta;

	}
	/*=============================================
	EDITAR REGISTRO DE REFERENCIA
	=============================================*/
	static public function ctrEditarReferencia($datos) {
		
		$tabla = "referencias";

		$respuesta = ModelReferencias::mdlEditarReferencia($tabla, $datos);

		return $respuesta;

	}
}