<?php

class ControllerEspecialidades{

	/*=============================================
	MOSTRAR ESPECIALIDADES
	=============================================*/
	static public function ctrMostrarEspecialidades($item, $valor) {

		$tabla = "especialidades";
		
		$respuesta = ModelEspecialidades::mdlMostrarEspecialidades($tabla, $item, $valor);

		return $respuesta;

  }

  /*=============================================
	MOSTRAR SERVICIOS ESPECIALIDADES
	=============================================*/
	static public function ctrMostrarServicioEspecialidades($item1, $valor1, $item2, $valor2) {

		$tabla = "especialidades";
		
		$respuesta = ModelEspecialidades::mdlMostrarServicioEspecialidades($tabla, $item1, $valor1, $item2, $valor2);

		return $respuesta;

  }

}