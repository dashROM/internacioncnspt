<?php

class ControllerPacienteEgresos {

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE QUE DEVUELVE LA CONSULTA
	=============================================*/
	static public function ctrContarPacientesEgresos() {

		$tabla = "paciente_egresos";

		$respuesta = ModelPacienteEgresos::mdlContarPacientesEgresos($tabla);

		return $respuesta;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA PACIENTES EGRESOS FILTRADO
	=============================================*/
	static public function ctrContarFiltradoPacientesEgresos($sql) {

		$tabla = "paciente_egresos";

		$respuesta = ModelPacienteEgresos::mdlContarFiltradoPacientesEgresos($tabla, $sql);

		return $respuesta;

	}

	/*=============================================
	DATOS DE UN PACIENTE EGRESO
	=============================================*/
	static public function ctrMostrarPacienteEgreso($item, $valor) {

		$tabla = "paciente_egresos";

		$respuesta = ModelPacienteEgresos::mdlMostrarPacienteEgreso($tabla, $item, $valor);

		return $respuesta;
		
	} 

	/*=============================================
	LISTADO DE PACIENTES EGRESO
	=============================================*/
	static public function ctrMostrarPacientesEgresos($sql) {

		$tabla = "paciente_egresos";

		$respuesta = ModelPacienteEgresos::mdlMostrarPacientesEgresos($tabla, $sql);

		return $respuesta;
		
	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE QUE DEVUELVE LA CONSULTA (FILTRADO POR FECHA DE EGRESO)
	=============================================*/
	static public function ctrContarPacientesEgresosFecha($item1, $valor1, $item2, $valor2) {

		$tabla = "paciente_egresos";

		$respuesta = ModelPacienteEgresos::mdlContarPacientesEgresosFecha($tabla, $item1, $valor1, $item2, $valor2);

		return $respuesta;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA PACIENTES EGRESOS FILTRADO (FILTRADO POR FECHA DE EGRESO)
	=============================================*/
	static public function ctrContarFiltradoPacientesEgresosFecha($item1, $valor1, $item2, $valor2, $sql) {

		$tabla = "paciente_egresos";

		$respuesta = ModelPacienteEgresos::mdlContarFiltradoPacientesEgresosFecha($tabla, $item1, $valor1, $item2, $valor2, $sql);

		return $respuesta;

	}

	/*=============================================
	LISTADO DE PACIENTES EGRESO (FILTRADO POR FECHA DE EGRESO)
	=============================================*/
	static public function ctrMostrarPacientesEgresosFecha($item1, $valor1, $item2, $valor2, $sql) {

		$tabla = "paciente_egresos";

		$respuesta = ModelPacienteEgresos::mdlMostrarPacientesEgresosFecha($tabla, $item1, $valor1, $item2, $valor2, $sql);

		return $respuesta;
		
	}

	/*=============================================
	REGISTRAR PACIENTE EGRESO 
	=============================================*/
	static public function ctrNuevoPacienteEgreso($datos) {
		
		$tabla = "paciente_egresos";

		$respuesta = ModelPacienteEgresos::mdlNuevoPacienteEgreso($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	DATOS DE PACIENTE EGRESO (REPORTE ALTA HOSPITALARIA) 
	=============================================*/
	static public function ctrReporteAltaHospitalaria($item, $valor) {
		
		$tabla = "paciente_egresos";

		$respuesta = ModelPacienteEgresos::mdlReporteAltaHospitalaria($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	ELIMINADO DATOS DE PACIENTE EGRESO 
	=============================================*/
	static public function ctrEliminarPacienteEgreso($item1, $valor1, $item2, $valor2) {
		
		$tabla = "paciente_egresos";

		$respuesta = ModelPacienteEgresos::mdlEliminarPacienteEgreso($tabla, $item1, $valor1, $item2, $valor2);

		return $respuesta;

	}

}