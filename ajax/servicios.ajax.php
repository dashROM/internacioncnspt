<?php

require_once "../controllers/servicios.controller.php";
require_once "../models/servicios.model.php";

class AjaxServicios {

	public $id;

	public function ajaxMostrarServicios() {

		$item = null;
		$valor = null;

		$respuesta = ControllerServicios::ctrMostrarServicios($item, $valor);
	
		echo json_encode($respuesta);	
			
	}

}

/*=============================================
MOSTRAR SERVICIOS
=============================================*/
if (isset($_POST["mostrarServicios"])) {
				 
	$nuevoEspecialidad = new AjaxServicios();
	$nuevoEspecialidad -> ajaxMostrarServicios();

}