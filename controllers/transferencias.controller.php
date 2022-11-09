<?php

class ControllerTransferencias{

	/*=============================================
	DATOS DE UNA TRANSFERENCIA
	=============================================*/
	static public function ctrMostrarTransferencia($item, $valor) {

		$tabla = "transferencias";

		$respuesta = ModelTransferencias::mdlMostrarTransferencia($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	LISTADO DE TRANSFERENCIAS
	=============================================*/
	static public function ctrMostrarTransferencias($item, $valor) {

		$tabla = "transferencias";

		$respuesta = ModelTransferencias::mdlMostrarTransferencias($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CREAR NUEVO TRANSFERENCIA
	=============================================*/
	static public function ctrNuevoTransferencia($datos) {
		
		$tabla = "transferencias";

		$respuesta = ModelTransferencias::mdlNuevoTransferencia($tabla, $datos);
		return $respuesta;

	}

	/*=============================================
	EDITAR TRANSFERENCIA
	=============================================*/
	static public function ctrEditarTransferencia($datos) {
		
		$tabla = "transferencias";

		$respuesta = ModelTransferencias::mdlEditarTransferencia($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	EDITAR TRANSFERENCIA PASADA
	=============================================*/
	static public function ctrEditarTransferenciaPasada($datos) {
		
		$tabla = "transferencias";

		$respuesta = ModelTransferencias::mdlEditarTransferenciaPasada($tabla, $datos);

		return $respuesta;

	}

}