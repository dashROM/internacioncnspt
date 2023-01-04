<?php 

class ControllerAfiliadosSIAIS {

	/*=============================================
	LISTADO DE AFILIADOS DE LA BASE DE DATOS SIAIS
	=============================================*/
	
	static public function ctrMostrarAfiliadosSIAIS($item1, $item2, $valor) {

		$respuesta = ModelAfiliadosSIAIS::mdlMostrarAfiliadosSIAIS($item1, $item2, $valor);

		return $respuesta;

	}

}