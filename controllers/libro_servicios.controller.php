<?php 

class ControllerLibroServicios {

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS DE EGRESO QUE EXISTE DE ACUERDO AL SERVICIO (FILTRADO POR FECHA DE EGRESO)
	=============================================*/
	static public function ctrContarLibroServiciosFecha($item, $valor, $item1, $valor1, $item2, $valor2) {

		$respuesta = ModelLibroServicios::mdlContarLibroServiciosFecha($item, $valor, $item1, $valor1, $item2, $valor2);

		return $respuesta;

	}

	/*=============================================
	CONTAR EL NUMERO DE REGISTROS DE EGRESO QUE EXISTE DE ACUERDO AL SERVICIO (FILTRADO POR FECHA DE EGRESO)
	=============================================*/
	static public function ctrContarFiltradoLibroServiciosFecha($item, $valor, $item1, $valor1, $item2, $valor2, $sql) {

		$respuesta = ModelLibroServicios::mdlContarFiltradoLibroServiciosFecha($item, $valor, $item1, $valor1, $item2, $valor2, $sql);

		return $respuesta;

	}

	/*=============================================
	LISTADO DE EGRESO DE ACUERDO AL SERVICIO (FILTRADO POR FECHA DE EGRESO)
	=============================================*/
	static public function ctrMostrarLibroServiciosFecha($item, $valor, $item1, $valor1, $item2, $valor2, $sql) {

		$respuesta = ModelLibroServicios::mdlMostrarLibroServiciosFecha($item, $valor, $item1, $valor1, $item2, $valor2, $sql);

		return $respuesta;
		
	} 

}