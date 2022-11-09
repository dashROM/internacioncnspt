<?php

class ControllerPacienteIngresos {

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE QUE DEVUELVE LA CONSULTA
	=============================================*/
	static public function ctrContarPacientesIngresos() {

		$tabla = "paciente_ingresos";

		$respuesta = ModelPacienteIngresos::mdlContarPacientesIngresos($tabla);

		return $respuesta;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA PACIENTES INGRESOS FILTRADO
	=============================================*/
	static public function ctrContarFiltradoPacientesIngresos($sql) {

		$tabla = "paciente_ingresos";

		$respuesta = ModelPacienteIngresos::mdlContarFiltradoPacientesIngresos($tabla, $sql);

		return $respuesta;

	}

	/*=============================================
	DATOS DE UN PACIENTE INGRESO
	=============================================*/
	static public function ctrMostrarPacienteIngreso($item, $valor) {

		$tabla = "paciente_ingresos";

		$respuesta = ModelPacienteIngresos::mdlMostrarPacienteIngreso($tabla, $item, $valor);

		return $respuesta;
		
	} 

	/*=============================================
	MOSTAR LOS REGISTROS QUE EXISTE EN LA TABLA PACIENTES
	=============================================*/
	static public function ctrMostrarTodosPacientesIngresos($sql) {

		$tabla = "paciente_ingresos";

		$respuesta = ModelPacienteIngresos::mdlMostrarTodosPacientesIngresos($tabla, $sql);

		return $respuesta;

	}

	/*=============================================
	LISTADO DE PACIENTE INGRESOS
	=============================================*/
	static public function ctrMostrarPacienteIngresos($item, $valor) {

		$tabla = "paciente_ingresos";

		$respuesta = ModelPacienteIngresos::mdlMostrarPacienteIngresos($tabla, $item, $valor);

		return $respuesta;
		
	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE QUE DEVUELVE LA CONSULTA (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function ctrContarPacientesIngresosFecha($item1, $valor1, $item2, $valor2) {

		$tabla = "paciente_ingresos";

		$respuesta = ModelPacienteIngresos::mdlContarPacientesIngresosFecha($tabla, $item1, $valor1, $item2, $valor2);

		return $respuesta;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA PACIENTES INGRESOS FILTRADO (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function ctrContarFiltradoPacientesIngresosFecha($item1, $valor1, $item2, $valor2, $sql) {

		$tabla = "paciente_ingresos";

		$respuesta = ModelPacienteIngresos::mdlContarFiltradoPacientesIngresosFecha($tabla, $item1, $valor1, $item2, $valor2, $sql);

		return $respuesta;

	}

	/*=============================================
	LISTADO DE PACIENTE INGRESOS (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function ctrMostrarPacientesIngresosFecha($item1, $valor1, $item2, $valor2, $sql) {

		$tabla = "paciente_ingresos";

		$respuesta = ModelPacienteIngresos::mdlMostrarPacientesIngresosFecha($tabla, $item1, $valor1, $item2, $valor2, $sql);

		return $respuesta;
		
	} 

	/*=============================================
	CREAR NUEVO PACIENTE INGRESO 
	=============================================*/
	static public function ctrNuevoPacienteIngreso($datos) {
		
		$tabla = "paciente_ingresos";

		$respuesta = ModelPacienteIngresos::mdlNuevoPacienteIngreso($tabla, $datos);
		return $respuesta;

	}

	/*=============================================
	EDITAR PACIENTE INGRESO
	=============================================*/
	static public function ctrEditarPacienteIngreso($datos) {
		
		$tabla = "paciente_ingresos";

		$respuesta = ModelPacienteIngresos::mdlEditarPacienteIngreso($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	EDITAR PACIENTE INGRESO CON TRANSFERENCIA
	=============================================*/
	static public function ctrEditarPacienteIngresoCT($datos) {
		
		$tabla = "paciente_ingresos";

		$respuesta = ModelPacienteIngresos::mdlEditarPacienteIngresoCT($tabla, $datos);

		return $respuesta;

	}

	/*=============================================
	VERIFICAR PACIENTE INGRESOS
	=============================================*/
	static public function ctrVerificarPacienteIngresos($item, $valor) {
		
		$tabla = "paciente_ingresos";

		$respuesta = ModelPacienteIngresos::mdlVerificarPacienteIngresos($tabla, $item, $valor);

		return $respuesta;

	}

}