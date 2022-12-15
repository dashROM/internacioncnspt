<?php

require_once "../controllers/cie10.controller.php";
require_once "../models/cie10.model.php";

class AjaxCie10 {

	public $term;
	// public $page;

	/*=============================================
	MOSTRAR DATOS DE DIAGNOSTICO CIE10
	=============================================*/
	public function ajaxMostrarDiagnosticoCie10()	{

		$term = $this->term;
		// var_dump($start);
		$diagnosticoCie10 = ControllerCie10::ctrMostrarDiagnosticoCie10($term);
		// $count = $diagnosticoCie10->rowCount();
		$columnasCie10 = ControllerCie10::ctrMostrarColumnasCie10($term);

		$data = ['total_count' => $columnasCie10["count"], 'items' => $diagnosticoCie10 ];
	
		echo json_encode($data);
			
	}


}

/*=============================================
MOSTRAR DIAGNOSTICO CIE10
=============================================*/
$ctrMostrarDiagnostico = new AjaxCie10();
$ctrMostrarDiagnostico -> term = $_GET['term'];
$ctrMostrarDiagnostico -> ajaxMostrarDiagnosticoCie10();