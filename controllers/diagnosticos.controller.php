<?php

class ControllerDiagnosticos{



    /*=============================================
	BUSQUEDA DE ESPECIALIDADES
	=============================================*/ 
	static public function ctrBuscarDiagnosticos() {

		$tabla = "diagnostico";

		$respuesta = ModelDiagnosticos::mdlBuscarDiagnosticos($tabla);

		return $respuesta;

     }
}