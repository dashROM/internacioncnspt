<?php

class ControllerConsultorios{

	/*=============================================
	MOSTRAR CONSULTORIOS
	=============================================*/
	static public function ctrMostrarConsultorios($item, $valor) {

		$tabla = "consultorios";
		
		$respuesta = ModelConsultorios::mdlMostrarConsultorios($tabla, $item, $valor);

		return $respuesta;

  }

  /*=============================================
	CREAR NUEVO CONSULTORIO
	=============================================*/
	static public function ctrNuevoConsultorio($datos) {
		
		$tabla = "consultorios";

		$respuesta = ModelSalas::mdlNuevoSalas($tabla, $datos);
		
		return $respuesta;

	}

}