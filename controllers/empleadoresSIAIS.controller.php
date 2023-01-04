<?php 

class ControllerEmpleadoresSIAIS {

	/*=============================================
	LISTADO DE EMPLEADORES DE LA BASE DE DATOS SIAIS
	=============================================*/
	
	static public function ctrMostrarEmpleadoresSIAIS($item, $valor) {

		$respuesta = ModelEmpleadoresSIAIS::mdlMostrarEmpleadoresSIAIS($item, $valor);

		return $respuesta;

	}

}