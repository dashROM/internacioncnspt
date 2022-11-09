<?php

class ControllerSalas{

	/*=============================================
	MOSTRAR SALAS
	=============================================*/
	static public function ctrMostrarSalas($item, $valor) {

		$tabla = "salas";
		
		$respuesta = ModelSalas::mdlMostrarSalas($tabla, $item, $valor);

		return $respuesta;

  }

  /*=============================================
	CREAR NUEVO SALAS
	=============================================*/
	static public function ctrNuevoSalas($datos) {
		
		$tabla = "salas";

		$respuesta = ModelSalas::mdlNuevoSalas($tabla, $datos);
		
		return $respuesta;

	}

}