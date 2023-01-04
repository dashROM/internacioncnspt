<?php

class ControllerPacienteInternados {

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE QUE DEVUELVE LA CONSULTA
	=============================================*/
	static public function ctrContarPacientesInternados() {

		$tabla = "paciente_internados";

		$respuesta = ModelPacienteInternados::mdlContarPacientesInternados($tabla);

		return $respuesta;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA PACIENTES INTERNADOS FILTRADO
	=============================================*/
	static public function ctrContarFiltradoPacientesInternados($sql) {

		$tabla = "paciente_internados";

		$respuesta = ModelPacienteInternados::mdlContarFiltradoPacientesInternados($tabla, $sql);

		return $respuesta;

	}

	/*=============================================
	LISTADO DE PACIENTES INTERNADOS
	=============================================*/
	static public function ctrMostrarPacientesInternados($sql) {

		$tabla = "paciente_internados";

		$respuesta = ModelPacienteInternados::mdlMostrarPacientesInternados($tabla, $sql);

		return $respuesta;
		
	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE QUE DEVUELVE LA CONSULTA (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function ctrContarPacientesInternadosFecha($item1, $valor1, $item2, $valor2) {

		$tabla = "paciente_internados";

		$respuesta = ModelPacienteInternados::mdlContarPacientesInternadosFecha($tabla, $item1, $valor1, $item2, $valor2);

		return $respuesta;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA PACIENTES INTERNADOS FILTRADO (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function ctrContarFiltradoPacientesInternadosFecha($item1, $valor1, $item2, $valor2, $sql) {

		$tabla = "paciente_internados";

		$respuesta = ModelPacienteInternados::mdlContarFiltradoPacientesInternadosFecha($tabla, $item1, $valor1, $item2, $valor2, $sql);

		return $respuesta;

	}

	/*=============================================
	LISTADO DE PACIENTE INTERNADOS (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function ctrMostrarPacientesInternadosFecha($item1, $valor1, $item2, $valor2, $sql) {

		$tabla = "paciente_internados";

		$respuesta = ModelPacienteInternados::mdlMostrarPacientesInternadosFecha($tabla, $item1, $valor1, $item2, $valor2, $sql);

		return $respuesta;
		
	} 

	/*=============================================
	LISTADO DE PACIENTES INTERNADO POR BUSQUEDA FILTRADO
	=============================================*/
	static public function ctrMostrarPacienteInternadosFiltro($item, $valor) {

		$respuesta = ModelPacienteInternados::mdlMostrarPacienteInternadosFiltro($item, $valor);

		return $respuesta;

	}

	/*=============================================
	LISTADO DE PACIENTE INTERNADOS (FILTRADO POR SERVICIO)
	=============================================*/
	static public function ctrMostrarPacientesInternadosServicio($item, $valor) {

		$tabla = "paciente_internados";

		$respuesta = ModelPacienteInternados::mdlMostrarPacientesInternadosServicio($tabla, $item, $valor);

		return $respuesta;
		
	} 

}