<?php

class ControllerTipoUsuarios{

    /*=============================================
	LISTADO DE TIPO DE USUARIOS
	=============================================*/ 
	static public function ctrMostrarTipoUsuarios($item, $valor) {

		$tabla = "tipo_usuarios";

		$respuesta = ModelTipoUsuarios::mdlMostrarTipoUsuarios($tabla, $item, $valor);

		return $respuesta;

     }
}