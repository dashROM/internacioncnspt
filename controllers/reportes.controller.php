<?php

class ControllerReportes{

	/*=============================================
	DATOS PARA REPORTE FORM 204 PACIENTE INGRESO
	=============================================*/
	static public function ctrFrmEM204PacienteIngreso($item, $valor) {

		$tabla = "paciente_ingresos";

		$respuesta = ModelReportes::mdlFrmEM204PacienteIngreso($tabla, $item, $valor);

		return $respuesta;

  }

  /*=============================================
	DATOS PARA REPORTE FORM 204 PACIENTE EGRESO
	=============================================*/
	static public function ctrFrmEM204PacienteEgreso($item, $valor) {

		$tabla = "paciente_egresos";

		$respuesta = ModelReportes::mdlFrmEM204PacienteEgreso($tabla, $item, $valor);

		return $respuesta;

  }

  /*=============================================
	DATOS PARA REPORTE FORM 204 TRANSFERENCIAS
	=============================================*/
	static public function ctrFrmEM204Transferencias($item, $valor) {

		$tabla = "transferencias";

		$respuesta = ModelReportes::mdlFrmEM204Transferencias($tabla, $item, $valor);

		return $respuesta;

  }

  /*=============================================
	DATOS PARA REPORTE FORM 204 MATERNIDAD
	=============================================*/
	static public function ctrFrmEM204Maternidad($item, $valor) {

		$tabla = "maternidades";

		$respuesta = ModelReportes::mdlFrmEM204Maternidad($tabla, $item, $valor);

		return $respuesta;

  }

  /*=============================================
	DATOS PARA REPORTE FORM 204 NEONATO
	=============================================*/
	static public function ctrFrmEM204Neonato($item, $valor) {

		$tabla = "neonatos";

		$respuesta = ModelReportes::mdlFrmEM204Neonato($tabla, $item, $valor);

		return $respuesta;

  }
	
}