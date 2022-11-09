<?php

require_once "../controllers/afiliadosERP.controller.php";

class AjaxAfialiadosERP {
	
	public $fecha_nacimiento;
	public $documento;

	/*=============================================
	MOSTRAR DATOS LUGARES
	=============================================*/

	public function ajaxBuscadorAfiliadosERP()	{

		$fecha_nacimiento = $this->fecha_nacimiento;
		$documento = $this->documento;

		$respuesta = ControllerAfiliadosERP::ctrShowERP($fecha_nacimiento, $documento);

		echo $respuesta;

	}	

}

/*=============================================
MOSTRAR DATOS AFILIACION CNS
=============================================*/

if (isset($_POST["buscadorAfiliados"])) {
	
	$afiliados = new AjaxAfialiadosERP();
	$afiliados -> fecha_nacimiento = $_POST["fecha_nacimiento"];
	$afiliados -> documento = $_POST["documento"];
	$afiliados -> ajaxBuscadorAfiliadosERP();

}