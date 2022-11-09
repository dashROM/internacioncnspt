<?php 

class ControllerMaternidades {

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE QUE DEVUELVE LA CONSULTA
	=============================================*/
	static public function ctrContarMaternidades() {

		$tabla = "paciente_ingresos";

		$respuesta = ModelMaternidades::mdlContarMaternidades($tabla);

		return $respuesta;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA MATERNIDADES FILTRADO
	=============================================*/
	static public function ctrContarFiltradoMaternidades($sql) {

		$tabla = "paciente_ingresos";

		$respuesta = ModelMaternidades::mdlContarFiltradoMaternidades($tabla, $sql);

		return $respuesta;

	}

    /*=============================================
	LISTADO DE MATERNIDADES
	=============================================*/
	static public function ctrMostrarMaternidades($sql) {

		$tabla = "maternidades";

		$respuesta = ModelMaternidades::mdlMostrarMaternidades($tabla, $sql);

		return $respuesta;

	}

	/*=============================================
	DATOS DE MATERNIDAD
	=============================================*/
	static public function ctrMostrarMaternidad($item, $valor) {

		$tabla = "maternidades";

		$respuesta = ModelMaternidades::mdlMostrarMaternidad($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE QUE DEVUELVE LA CONSULTA (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function ctrContarMaternidadesFecha($item1, $valor1, $item2, $valor2) {

		$tabla = "maternidades";

		$respuesta = ModelMaternidades::mdlContarMaternidadesFecha($tabla, $item1, $valor1, $item2, $valor2);

		return $respuesta;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA MATERNIDADES FILTRADO (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function ctrContarFiltradoMaternidadesFecha($item1, $valor1, $item2, $valor2, $sql) {

		$tabla = "maternidades";

		$respuesta = ModelMaternidades::mdlContarFiltradoMaternidadesFecha($tabla, $item1, $valor1, $item2, $valor2, $sql);

		return $respuesta;

	}

	/*=============================================
	LISTADO DE MATERNIDADES (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function ctrMostrarMaternidadesFecha($item1, $valor1, $item2, $valor2, $sql) {

		$tabla = "maternidades";

		$respuesta = ModelMaternidades::mdlMostrarMaternidadesFecha($tabla, $item1, $valor1, $item2, $valor2, $sql);

		return $respuesta;
		
	} 

	/*=============================================
	NUEVO REGISTRO EN MATERNIDAD
	=============================================*/
	static public function ctrNuevoMaternidad($datos) {
		
		$tabla = "maternidades";

		$respuesta = ModelMaternidades::mdlNuevoMaternidad($tabla, $datos);

		return $respuesta;

	}
	/*=============================================
	EDITAR PERSONA
	=============================================*/
	static public function ctrEditarMaternidad($datos) {
		
		$tabla = "maternidades";

		$respuesta = ModelMaternidades::mdlEditarMaternidad($tabla, $datos);

		return $respuesta;

	}
}