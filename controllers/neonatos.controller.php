<?php 

class ControllerNeonatos {

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE QUE DEVUELVE LA CONSULTA
	=============================================*/
	static public function ctrContarNeonatos() {

		$tabla = "neonatos";

		$respuesta = ModelNeonatos::mdlContarNeonatos($tabla);

		return $respuesta;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA NEONATOS FILTRADO
	=============================================*/
	static public function ctrContarFiltradoNeonatos($sql) {

		$tabla = "neonatos";

		$respuesta = ModelNeonatos::mdlContarFiltradoNeonatos($tabla, $sql);

		return $respuesta;

	}

    /*=============================================
	LISTADO DE NEONATO PACIENTES
	=============================================*/
	static public function ctrMostrarNeonatos($sql) {

		$tabla = "neonatos";

		$respuesta = ModelNeonatos::mdlMostrarNeonatos($tabla, $sql);

		return $respuesta;

	}

	/*=============================================
	DATOS DE NEONATO PACIENTES
	=============================================*/
	static public function ctrMostrarNeonato($item, $valor) {

		$tabla = "neonatos";

		$respuesta = ModelNeonatos::mdlMostrarNeonato($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE QUE DEVUELVE LA CONSULTA (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function ctrContarNeonatosFecha($item1, $valor1, $item2, $valor2) {

		$tabla = "neonatos";

		$respuesta = ModelNeonatos::mdlContarNeonatosFecha($tabla, $item1, $valor1, $item2, $valor2);

		return $respuesta;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA NEONATOS FILTRADO (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function ctrContarFiltradoNeonatosFecha($item1, $valor1, $item2, $valor2, $sql) {

		$tabla = "neonatos";

		$respuesta = ModelNeonatos::mdlContarFiltradoNeonatosFecha($tabla, $item1, $valor1, $item2, $valor2, $sql);

		return $respuesta;

	}

	/*=============================================
	LISTADO DE NEONATOS (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	static public function ctrMostrarNeonatosFecha($item1, $valor1, $item2, $valor2, $sql) {

		$tabla = "neonatos";

		$respuesta = ModelNeonatos::mdlMostrarNeonatosFecha($tabla, $item1, $valor1, $item2, $valor2, $sql);

		return $respuesta;
		
	} 

	/*=============================================
	NUEVO REGISTRO DE NEONATO
	=============================================*/
	static public function ctrNuevoNeonato($datos) {
		
		$tabla = "neonatos";

		$respuesta = ModelNeonatos::mdlNuevoNeonato($tabla, $datos);

		return $respuesta;

	}
	/*=============================================
	EDITAR REGISTRO DE NEONATO
	=============================================*/
	static public function ctrEditarNeonato($datos) {
		
		$tabla = "neonatos";

		$respuesta = ModelNeonatos::mdlEditarNeonato($tabla, $datos);

		return $respuesta;

	}
}