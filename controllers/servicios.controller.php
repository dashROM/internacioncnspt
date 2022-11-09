<?php

class ControllerServicios {

	/*=============================================
	LISTADO DE SERVICIOS
	=============================================*/
	static public function ctrMostrarServicios($item, $valor) {

		$tabla = "servicios";

		$respuesta = ModelServicios::mdlMostrarServicios($tabla, $item, $valor);

		return $respuesta;

  }

  /*=============================================
	LISTADO DE SERVICIOS FILTRADO
	=============================================*/
	static public function ctrFiltrarMostrarServicios($item, $valor) {

		$tabla = "servicios";

		$respuesta = ModelServicios::mdlFiltrarMostrarServicios($tabla, $item, $valor);

		return $respuesta;

  }

	/*=============================================
	REGISTRAR NUEVO SERVICIO
	=============================================*/
	static public function ctrNuevoServicios($datos) {
		
		$tabla = "servicios";

		$respuesta = ModelServicios::mdlNuevoServicios($tabla, $datos);

		return $respuesta;

	}

}