<?php

class ControllerCamas{

	/*=============================================
	DATOS DE CAMA
	=============================================*/
	static public function ctrMostrarCama($item, $valor) {

		$tabla = "camas";

		$respuesta = ModelCamas::mdlMostrarCama($tabla, $item, $valor);

		return $respuesta;

  }

	/*=============================================
	LISTADO DE CAMAS
	=============================================*/
	static public function ctrMostrarCamas($item, $valor) {

		$tabla = "camas";

		$respuesta = ModelCamas::mdlMostrarCamas($tabla, $item, $valor);

		return $respuesta;

  }

  /*=============================================
	LISTADO DE CAMAS LIBRES DE ACUERDO A LA SALA
	=============================================*/
	static public function ctrMostrarSalaCamas($item, $valor) {

		$tabla = "camas";

		$respuesta = ModelCamas::mdlMostrarSalaCamas($tabla, $item, $valor);

		return $respuesta;

  }

  /*=============================================
	REGISTRO NUEVA CAMA
	=============================================*/
	static public function ctrNuevaCama($datos) {
		
		$tabla = "camas";

		$respuesta = ModelCamas::mdlNuevaCama($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	REGISTRO EDITAR CAMA
	=============================================*/
	static public function ctrEditarCama($datos) {
		
		$tabla = "camas";

		$respuesta = ModelCamas::mdlEditarCama($tabla, $datos);

		return $respuesta;

	}
	
}