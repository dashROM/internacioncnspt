<?php

class ControllerDepartamentos {

	/*=============================================
	LISTADO DE DEPARTAMENTOS
	=============================================*/
	
	static public function ctrMostrarEstablecimientos($item, $valor) {

		$tabla = "departamentos";

		$respuesta = ModelDepartamentos::mdlMostrarDepartamentos($tabla, $item, $valor);

		return $respuesta;

  }

  /*=============================================
	LISTADO DE DEPARTAMENTOS
	=============================================*/
	
	static public function ctrMostrarDepartamentosTransExterna($item, $valor) {

		$tabla = "departamentos";

		$respuesta = ModelDepartamentos::mdlMostrarDepartamentosTransExterna($tabla, $item, $valor);

		return $respuesta;

  }

}