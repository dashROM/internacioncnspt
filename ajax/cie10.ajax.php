<?php

require_once "../controllers/cie10.controller.php";
require_once "../models/cie10.model.php";

class AjaxCie10 {

	public $q;
	/*=============================================
	MOSTRAR DATOS DE DIAGNOSTICO CIE10
	=============================================*/

	public function ajaxMostrarDiagnosticoCie10()	{

		$item = "q";
		$valor = $this->q;

		$diagnosticoCie10 = ControllerCie10::ctrMostrarDiagnosticoCie10($item, $valor);

		$columnasCie10 = ControllerCie10::ctrMostrarColumnasCie10($item, $valor);

		$data = [ 'total_count' => $columnasCie10["count"], 'incomplete_results' => false, 'items' => $diagnosticoCie10 ];
	
		echo json_encode($data);	
			
	}


}


/*=============================================
MOSTRAR CAMAS
=============================================*/
				 
$ctrMostrarDiagnostico = new AjaxCie10();
$ctrMostrarDiagnostico -> q = $_GET["q"];

// var_dump($_GET["q"]);

$ctrMostrarDiagnostico -> ajaxMostrarDiagnosticoCie10();

