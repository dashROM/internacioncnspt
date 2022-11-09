<?php

class ControllerPacientes {

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE QUE DEVUELVE LA CONSULTA
	=============================================*/
	static public function ctrContarPacientes() {

		$tabla = "pacientes";

		$respuesta = ModelPacientes::mdlContarPacientes($tabla);

		return $respuesta;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA PACIENTES FILTRADO
	=============================================*/
	static public function ctrContarFiltradoPacientes($sql) {

		$tabla = "pacientes";

		$respuesta = ModelPacientes::mdlContarFiltradoPacientes($tabla, $sql);

		return $respuesta;

	}

	/*=============================================
	MOSTAR LOS REGISTROS QUE EXISTE EN LA TABLA PACIENTES
	=============================================*/
	static public function ctrMostrarTodosPacientes($sql) {

		$tabla = "pacientes";

		$respuesta = ModelPacientes::mdlMostrarTodosPacientes($tabla, $sql);

		return $respuesta;

	}

	/*=============================================
	LISTADO DE PACIENTES
	=============================================*/
	static public function ctrMostrarPacientes($item, $valor) {

		$tabla = "pacientes";

		$respuesta = ModelPacientes::mdlMostrarPacientes($tabla, $item, $valor);

		return $respuesta;

	}
	
	// static public function ctrReportePacientes($item, $valor,$item1,$valor1) {

	// 	$respuesta = ModelPacientes::mdlReportePaciente($item, $valor,$item1,$valor1);

	// 	return $respuesta;

	// }

	// static public function ctrReportePacientesTrasferencia($item, $valor,$item1,$valor1) {

	// 	$respuesta = ModelPacientes::mdlReportePacienteTrasferencia($item, $valor,$item1,$valor1);

	// 	return $respuesta;

	// }
	// static public function ctrReportePacientesAltas($item, $valor,$item1,$valor1) {

	// 	$respuesta = ModelPacientes::mdlReportePacienteAltas($item, $valor,$item1,$valor1);

	// 	return $respuesta;

	// }
	// static public function ctrReportePacientesMaternidad($item, $valor,$item1,$valor1) {

	// 	$respuesta = ModelPacientes::mdlReportePacienteMaternidad($item, $valor,$item1,$valor1);

	// 	return $respuesta;

	// }

	/*=============================================
	CREAR NUEVO PACIENTE
	=============================================*/

	static public function ctrNuevoPaciente($datos) {
		
		$tabla = "pacientes";

		$respuesta = ModelPacientes::mdlNuevoPaciente($tabla, $datos);
		return $respuesta;

	}

	/*=============================================
	EDITAR PACIENTES
	=============================================*/
	static public function ctrEditarPacientes($datos) {
		
		$tabla = "pacientes";

		$respuesta = ModelPacientes::mdlEditarPacientes($tabla, $datos);

		return $respuesta;

	}
		
	// static public function ctrMostrarPacientesServicio($item, $valor) {
		
	// 	$tabla = "pacientes";

	// 	$respuesta = ModelPacientes::mdlMostrarPacientesServicio($item, $valor,$tabla);

	// 	return $respuesta;

	// }

	// static public function ctrHistorialPacientes($item, $valor) {
		
	// 	$tabla = "pacientes";

	// 	$respuesta = ModelPacientes::mdlMostrarPacientesHistorial($item, $valor,$tabla);

	// 	return $respuesta;

	// }

	// static public function ctrMostrarReportes($item, $valor) {


	// 	$respuesta = ModelPacientes::mdlMostrarReporte($item, $valor);

	// 	return $respuesta;

	// }

}