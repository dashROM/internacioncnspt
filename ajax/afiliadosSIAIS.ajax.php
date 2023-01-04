<?php

require_once "../controllers/afiliadosSIAIS.controller.php";
require_once "../models/afiliadosSIAIS.model.php";

class AjaxAfiliadosSIAIS {
	
	/*=============================================
	MOSTRAR DATOS AFILIADO SIAIS
	=============================================*/
	
	public $idAfiliado;

	public function ajaxMostrarAfiliadoSIAIS() {
	
    $item1 = null;
    $item2 = "idafiliacion";
    $valor = $this->idAfiliado;

    $respuesta = ControllerAfiliadosSIAIS::ctrMostrarAfiliadosSIAIS($item1, $item2, $valor);

    /*=============================================
    ELIMINANDO ESPACIOS EN BLANCO Y FORMATEANDO ALGUNOS REGISTROS
    =============================================*/      
    $respuesta['pac_numero_historia'] = rtrim($respuesta["pac_numero_historia"]);

    $respuesta['pac_codigo'] = rtrim($respuesta["pac_codigo"]);

    $respuesta['emp_nombre'] = rtrim($respuesta["emp_nombre"]);

    $respuesta['pac_primer_apellido'] = rtrim($respuesta["pac_primer_apellido"]);

    $respuesta['pac_segundo_apellido'] = rtrim($respuesta["pac_segundo_apellido"]);

    $respuesta['pac_nombre'] = rtrim($respuesta["pac_nombre"]);

    $respuesta['pac_fecha_nac'] = $respuesta['pac_fecha_nac'];

    echo json_encode($respuesta);

	}

}
	
/*=============================================
MOSTRAR DATOS AFILIADO SIAIS
=============================================*/
if (isset($_POST["mostrarAfiliado"])) {

	$seleccionarAfiliado = new AjaxAfiliadosSIAIS();
	$seleccionarAfiliado -> idAfiliado = $_POST["idAfiliado"];
	$seleccionarAfiliado -> ajaxMostrarAfiliadoSIAIS();

}