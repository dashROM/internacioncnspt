<?php

require_once "../controllers/transferencias.controller.php";
require_once "../models/transferencias.model.php";

class AjaxTransferencias{

	public $id;
	public $fecha_transferencia;
	public $id_servicio_trans;
	public $id_servicio_ant;
	public $id_especialidad_trans;
	public $id_especialidad_ant;
	public $id_sala_trans;
	public $id_sala_ant;
	public $id_cama_trans;
	public $id_cama_ant;
	public $id_medico;
	public $diagnostico_trans1;
	public $diagnostico_trans2;
	public $diagnostico_trans3;
  public $id_paciente_ingreso;
	public $id_paciente;

	/*=============================================
	MOSTRAR TRANSFERENCIA
	=============================================*/
	public function ajaxMostrarTransferencia()	{

		$item = "id";
		$valor = $this->id;

		$respuesta = ControllerTransferencias::ctrMostrarTransferencia($item, $valor);
	
		echo json_encode($respuesta);	
			
	}

	/*=============================================
	MOSTRAR TRANSFERENCIAS
	=============================================*/
	public function ajaxMostrarPacienteTransferencias()	{

		$item = "id_paciente_ingreso";
		$valor = $this->id_paciente_ingreso;

		$respuesta = ControllerTransferencias::ctrMostrarTransferencias($item, $valor);
	
		echo json_encode($respuesta);	
			
	}

	/*=============================================
	REGISTRAR NUEVA TRANSFERENCIA
	=============================================*/
  public function ajaxNuevoTransferencia()	{

		$datos = array("fecha_transferencia"    => $this->fecha_transferencia,  
		               "id_servicio_trans"     	=> $this->id_servicio_trans,
		               "id_servicio_ant"     	  => $this->id_servicio_ant,
		               "id_especialidad_trans"  => $this->id_especialidad_trans,
		               "id_especialidad_ant"    => $this->id_especialidad_ant,
		               "id_sala_trans"     	    => $this->id_sala_trans,
		               "id_sala_ant"     	      => $this->id_sala_ant,
		               "id_cama_trans"     	    => $this->id_cama_trans,
		               "id_cama_ant"     	      => $this->id_cama_ant,
		               "id_medico"     	        => $this->id_medico,
		               "diagnostico_trans1"     => mb_strtoupper($this->diagnostico_trans1, 'utf-8'),
		               "diagnostico_trans2"     => mb_strtoupper($this->diagnostico_trans2, 'utf-8'),
		               "diagnostico_trans3"     => mb_strtoupper($this->diagnostico_trans3, 'utf-8'),
		               "id_paciente_ingreso"  	=> $this->id_paciente_ingreso
		);
	
		$respuesta = ControllerTransferencias::ctrNuevoTransferencia($datos);
		  
		echo json_encode($respuesta);
			
	}

	/*=============================================
	EDITAR TRANSFERENCIA
	=============================================*/
  public function ajaxEditarTransferencia()	{

		$datos = array("fecha_transferencia"    => $this->fecha_transferencia,  
		               "id_servicio_trans"     	=> $this->id_servicio_trans,
		               "id_especialidad_trans"  => $this->id_especialidad_trans,
		               "id_sala_trans"     	    => $this->id_sala_trans,
		               "id_cama_trans"     	    => $this->id_cama_trans,
		               "id_cama_ant"     	      => $this->id_cama_ant,
		               "id_medico"     	        => $this->id_medico,
		               "diagnostico_trans1"     => mb_strtoupper($this->diagnostico_trans1, 'utf-8'),
		               "diagnostico_trans2"     => mb_strtoupper($this->diagnostico_trans2, 'utf-8'),
		               "diagnostico_trans3"     => mb_strtoupper($this->diagnostico_trans3, 'utf-8'),
		               "id_paciente_ingreso"  	=> $this->id_paciente_ingreso,
		               "id"  										=> $this->id
		);
	
		$respuesta = ControllerTransferencias::ctrEditarTransferencia($datos);
		  
		echo json_encode($respuesta);
			
	}

	/*=============================================
	EDITAR TRANSFERENCIA PASADA
	=============================================*/
  public function ajaxEditarTransferenciaPasada()	{

		$datos = array("fecha_transferencia"    => $this->fecha_transferencia,  
		               "id_servicio_trans"     	=> $this->id_servicio_trans,
		               "id_especialidad_trans"  => $this->id_especialidad_trans,
		               "id_sala_trans"     	    => $this->id_sala_trans,
		               "id_cama_trans"     	    => $this->id_cama_trans,
		               "id_medico"     	        => $this->id_medico,
		               "diagnostico_trans1"     => mb_strtoupper($this->diagnostico_trans1, 'utf-8'),
		               "diagnostico_trans2"     => mb_strtoupper($this->diagnostico_trans2, 'utf-8'),
		               "diagnostico_trans3"     => mb_strtoupper($this->diagnostico_trans3, 'utf-8'),
		               "id_paciente_ingreso"  	=> $this->id_paciente_ingreso,
		               "id"  										=> $this->id
		);
	
		$respuesta = ControllerTransferencias::ctrEditarTransferenciaPasada($datos);
		  
		echo json_encode($respuesta);
			
	}

}

/*=============================================
MOSTRAR TRANSFERENCIA
=============================================*/
if (isset($_POST["mostrarTransferencia"])) {
				 
	$mostrarTransferencia = new AjaxTransferencias();
	$mostrarTransferencia -> id = $_POST["id"];
	$mostrarTransferencia -> ajaxMostrarTransferencia();

}

/*=============================================
MOSTRAR TRANSFERENCIAS
=============================================*/
if (isset($_POST["mostrarPacienteTransferencias"])) {
				 
	$mostrarTransferencia = new AjaxTransferencias();
	$mostrarTransferencia -> id_paciente_ingreso = $_POST["id"];
	$mostrarTransferencia -> ajaxMostrarPacienteTransferencias();

}

/*=============================================
REGISTRAR NUEVA TRANSFERENCIA
=============================================*/
if (isset($_POST["nuevoTransferencia"])) {
				 
	$nuevoTransferencia = new AjaxTransferencias();
	$nuevoTransferencia -> fecha_transferencia = $_POST['nuevoFechaTrans'];
	$nuevoTransferencia -> id_servicio_trans = $_POST['nuevoServicioTrans'];
	$nuevoTransferencia -> id_servicio_ant = $_POST['idServicioAnt'];
	$nuevoTransferencia -> id_especialidad_trans = $_POST['nuevoEspecialidadTrans'];
	$nuevoTransferencia -> id_especialidad_ant = $_POST['idEspecialidadAnt'];
	$nuevoTransferencia -> id_sala_trans = $_POST['nuevoSalaTrans'];
	$nuevoTransferencia -> id_sala_ant = $_POST['idSalaAnt'];
	$nuevoTransferencia -> id_cama_trans = $_POST['nuevoCamaTrans'];
	$nuevoTransferencia -> id_cama_ant = $_POST['idCamaAnt'];
	$nuevoTransferencia -> id_medico = $_POST['nuevoMedicoSolicitanteTrans'];
	$nuevoTransferencia -> diagnostico_trans1 = $_POST['nuevoDiagnosticoTrans1'];
	$nuevoTransferencia -> diagnostico_trans2 = $_POST['nuevoDiagnosticoTrans2'];
	$nuevoTransferencia -> diagnostico_trans3 = $_POST['nuevoDiagnosticoTrans3'];
  $nuevoTransferencia -> id_paciente = $_POST['nuevoIdPaciente'];
  $nuevoTransferencia -> id_paciente_ingreso = $_POST['idPacienteIngresoTrans'];
	$nuevoTransferencia -> ajaxNuevoTransferencia();

}

/*=============================================
EDITAR TRANSFERENCIA
=============================================*/
if (isset($_POST["editarTransferencia"])) {
				 
	$editarTransferencia = new AjaxTransferencias();
	$editarTransferencia -> fecha_transferencia = $_POST['editarFechaTrans'];
	$editarTransferencia -> id_servicio_trans = $_POST['editarServicioTrans'];
	$editarTransferencia -> id_especialidad_trans = $_POST['editarEspecialidadTrans'];
	$editarTransferencia -> id_sala_trans = $_POST['editarSalaTrans'];
	$editarTransferencia -> id_cama_trans = $_POST['editarCamaTrans'];
	$editarTransferencia -> id_cama_ant = $_POST['editarIDCamaAnt'];
	$editarTransferencia -> id_medico = $_POST['editarMedicoSolicitanteTrans'];
	$editarTransferencia -> diagnostico_trans1 = $_POST['editarDiagnosticoTrans1'];
	$editarTransferencia -> diagnostico_trans2 = $_POST['editarDiagnosticoTrans2'];
	$editarTransferencia -> diagnostico_trans3 = $_POST['editarDiagnosticoTrans3'];
  $editarTransferencia -> id_paciente_ingreso = $_POST['editarIDPacienteIngresoTrans'];
  $editarTransferencia -> id = $_POST['idTransferencia'];
  if($_POST['idTransferencia'] == $_POST['ultimoIDTransferencia']){
  	$editarTransferencia -> ajaxEditarTransferencia();
  } else {
  	$editarTransferencia -> ajaxEditarTransferenciaPasada();
  }	

}