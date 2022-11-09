<?php

class ControllerAltas{

	/*=============================================
	LISTADO DE PACIENTES
	=============================================*/
	
	static public function ctrMostrarAltas($item, $valor) {

		$tabla = "alta";

		$respuesta = ModelAltas::mdlMostrarAltas($tabla, $item, $valor);

		return $respuesta;

	}
	/*=============================================
	CREAR NUEVO INGRESOS
	=============================================*/
	static public function ctrNuevoAltas($datos) {
		
		$tabla = "alta";
		$tabla_ingreso = 'ingreso';

		$respuesta = ModelAltas::mdlNuevoAltas($tabla, $tabla_ingreso, $datos);
		return $respuesta;

	}
	/*=============================================
	EDITAR PERSONA
	=============================================*/
	
	static public function ctrEditarAltas($datos) {
		
		$tabla = "alta";

		$respuesta = ModelAltas::mdlEditarAltas($tabla, $datos);

		return $respuesta;

	}
}