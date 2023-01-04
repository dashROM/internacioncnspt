<?php

require_once "../controllers/afiliadosSIAIS.controller.php";
require_once "../models/afiliadosSIAIS.model.php";

class TablaAfiliadosSIAIS {

	/*=============================================
	MOSTRAR LA TABLA DE POBLACION AFILIADA
	=============================================*/

	public $afiliado;

	public function mostrarTablaAfiliadosSIAIS() {
 
		$item1 = "nombre_completo";
		$item2 = "cod_asegurado";
		$valor = $this->afiliado;
		
		$respuesta = ControllerAfiliadosSIAIS::ctrMostrarAfiliadosSIAIS($item1, $item2, $valor);

		echo json_encode($respuesta);

	}
	
	/*=============================================
	MOSTRAR LA TABLA DE POBLACION AFILIADA DE ACUERDO AL CRITERIO DE IDEMPLEADOR
	=============================================*/
}

if (isset($_POST["mostrarAfiliados"])) {

	$activarAfiliadosSIAIS = new TablaAfiliadosSIAIS();
	$activarAfiliadosSIAIS -> afiliado = $_POST["afiliado"];
	$activarAfiliadosSIAIS -> mostrarTablaAfiliadosSIAIS();

}
