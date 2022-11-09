<?php

class ControllerEstablecimientos {

	/*=============================================
	LISTADO DE ESTABLECIMIENTOS
	=============================================*/
	
	static public function ctrMostrarEstablecimientos($item, $valor) {

		$tabla = "establecimientos";

		$respuesta = ModelEstablecimientos::mdlMostrarEstablecimientos($tabla, $item, $valor);

		return $respuesta;

  }

  /*=============================================
	LISTADO DE ESTABLECIMIENTOS
	=============================================*/
	
	static public function ctrMostrarEstablecimientosReferencia($item, $valor) {

		$tabla = "establecimientos";

		$respuesta = ModelEstablecimientos::mdlMostrarEstablecimientosReferencia($tabla, $item, $valor);

		return $respuesta;

  }

	/*=============================================
	REGISTRAR NUEVO ESTABECIMIENTO
	=============================================*/
	static public function ctrNuevoEstablecimiento($datos) {
		
		$tabla = "establecimientos";

		$respuesta = ModelEstablecimientos::mdlNuevoEstablecimiento($tabla, $datos);
		return $respuesta;

	}
	/*=============================================
	EDITAR ESTABLECIMIENTO
	=============================================*/
	
	static public function ctrEditarEstablecimiento($datos) {
		
		$tabla = "establecimientos";

		$respuesta = ModelEstablecimientos::mdlEditarEstablecimiento($tabla, $datos);

		return $respuesta;

	}
}