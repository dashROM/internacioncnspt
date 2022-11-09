<?php

require_once "../controllers/referencias.controller.php";
require_once "../models/referencias.model.php";

class AjaxReferencias {

    public $id;
    public $id_establecimiento;
    public $adecuado;
	public $justificado;
	public $oportuno;
    public $id_paciente_ingreso;

	/*=============================================
	MOSTRAR DATOS DE REFERENCIA
	=============================================*/
	public function ajaxMostrarReferencia()	{

		$item = "id_paciente_ingreso";
		$valor = $this->id_paciente_ingreso;

		$neonato = ControllerReferencias::ctrMostrarReferencia($item, $valor);
	
		echo json_encode($neonato);	
			
	}

	/*=============================================
	NUEVO REGISTRO DE REFERENCIA
	=============================================*/
    public function ajaxNuevoReferencia() {

		$datos = array("id_establecimiento"           => $this->id_establecimiento, 
		               "adecuado"	              	  => $this->adecuado,
		               "justificado"	              => $this->justificado,
		               "oportuno"	              	  => $this->oportuno,
		               "id_paciente_ingreso"          => $this->id_paciente_ingreso
		);
	
		$respuesta = ControllerReferencias::ctrNuevoReferencia($datos);
	
		echo json_encode($respuesta);
			
	}

	/*=============================================
	EDITAR REGISTRO DE REFERENCIA
	=============================================*/
	public function ajaxEditarReferencia() {

		$datos = array("id_establecimiento"           => $this->id_establecimiento, 
		               "adecuado"	              	  => $this->adecuado,
		               "justificado"	              => $this->justificado,
		               "oportuno"	              	  => $this->oportuno,
		               "id_paciente_ingreso"          => $this->id_paciente_ingreso,
		               "id" 				          => $this->id
		);
		
		$respuesta = ControllerReferencias::ctrEditarReferencia($datos);
		
		echo json_encode($respuesta);
		
	}
    
}

/*=============================================
MOSTRAR DATOS DE REFERENCIA
=============================================*/
if (isset($_POST["mostrarReferencia"])) {
				 
	$Referencia = new AjaxReferencias();
	$Referencia -> id_paciente_ingreso = $_POST["idPacienteIngreso"];
	$Referencia -> ajaxMostrarReferencia();

}

/*=============================================
NUEVO REGISTRO DE REFERENCIA
=============================================*/
if (isset($_POST["nuevoReferencia"])) {
				 
	$nuevoReferencia = new AjaxReferencias;
	$nuevoReferencia -> id_establecimiento = $_POST["nuevoEstablecimientoRef"];
	if(isset($_POST["nuevoRefAdecuado"])) {
		$nuevoReferencia -> adecuado = 1;
	} else {
		$nuevoReferencia -> adecuado = 0;
	}
	if(isset($_POST["nuevoRefJustificado"])) {
		$nuevoReferencia -> justificado = 1;
	} else {
		$nuevoReferencia -> justificado = 0;
	}
	if(isset($_POST["nuevoRefOportuno"])) {
		$nuevoReferencia -> oportuno = 1;
	} else {
		$nuevoReferencia -> oportuno = 0;
	}
	$nuevoReferencia -> id_paciente_ingreso = $_POST['idPacienteIngresoR'];
	$nuevoReferencia -> ajaxNuevoReferencia();

}

/*=============================================
EDITAR REGISTRO DE REFERENCIA
=============================================*/
if (isset($_POST["editarReferencia"])) {
				 
	$editarReferencia = new AjaxReferencias;
	$editarReferencia -> id_establecimiento = $_POST["editarEstablecimientoRef"];
	if(isset($_POST["editarRefAdecuado"])) {
		$editarReferencia -> adecuado = 1;
	} else {
		$editarReferencia -> adecuado = 0;
	}
	if(isset($_POST["editarRefJustificado"])) {
		$editarReferencia -> justificado = 1;
	} else {
		$editarReferencia -> justificado = 0;
	}
	if(isset($_POST["editarRefOportuno"])) {
		$editarReferencia -> oportuno = 1;
	} else {
		$editarReferencia -> oportuno = 0;
	}
	$editarReferencia -> id_paciente_ingreso = $_POST['idPacienteIngresoER'];
	$editarReferencia -> id = $_POST['idReferencia'];

	$editarReferencia -> ajaxEditarReferencia();

}