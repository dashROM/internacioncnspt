<?php

class ControllerMedicos{

	/*=============================================
	LISTADO DE MEDICOS
	=============================================*/
	static public function ctrMostrarMedicos($item, $valor) {

		$tabla = "medicos";

		$respuesta = ModelMedicos::mdlMostrarMedicos($tabla, $item, $valor);

		return $respuesta;

  }

 	/*=============================================
	CREAR NUEVO MEDICO
	=============================================*/
	static public function ctrNuevoMedico($datos) {
		
		$tabla = "medicos";

		$respuesta = ModelMedicos::mdlNuevoMedico($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	EDITAR MEDICO
	=============================================*/
	static public function ctrEditarMedico($datos) {
		
		$tabla = "medicos";

		$respuesta = ModelMedicos::mdlEditarMedico($tabla, $datos);

		return $respuesta;

	}
}