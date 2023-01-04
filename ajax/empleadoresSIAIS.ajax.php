<?php

require_once "../controllers/empleadoresSIAIS.controller.php";
require_once "../models/empleadoresSIAIS.model.php";

class AjaxEmpleadoresSIAIS {
	
	/*=============================================
	MOSTRAR DATOS EMPLEADOR SIAIS
	=============================================*/	
	public $idEmpleador;

	public function ajaxMostrarEmpleadorSIAIS() {
	
    $item = "idempleador";
    $valor = $this->idEmpleador;

    $respuesta = ControllerEmpleadoresSIAIS::ctrMostrarEmpleadoresSIAIS($item, $valor);

    /*=============================================
    ELIMINANDO ESPACIOS EN BLANCO Y FORMATEANDO ALGUNOS REGISTROS
    =============================================*/
    $respuesta['emp_nombre'] = rtrim($respuesta["emp_nombre"]);
    $respuesta['emp_nro_empleador'] = rtrim($respuesta["emp_nro_empleador"]);

    echo json_encode($respuesta);

	}

}
	
/*=============================================
MOSTRAR DATOS EMPLEADOR SIAIS
=============================================*/
if (isset($_POST["mostrarEmpleador"])) {

	$seleccionarEmpleador = new AjaxEmpleadoresSIAIS();
	$seleccionarEmpleador -> idEmpleador = $_POST["idEmpleador"];
	$seleccionarEmpleador -> ajaxMostrarEmpleadorSIAIS();

}