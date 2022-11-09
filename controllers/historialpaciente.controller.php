<?php

class ControllerHistorialpaciente {

	/*=============================================
	LISTADO DE PACIENTES
	=============================================*/
	
	static public function ctrMostrarPacientes($pac_numero_historia,$valor) {


		$respuesta = ModelHistorialpaciente::mdlMostrarPacientes($pac_numero_historia,$valor);

		return $respuesta;

	}
}