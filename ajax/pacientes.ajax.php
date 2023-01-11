<?php

require_once "../controllers/pacientes.controller.php";
require_once "../models/pacientes.model.php";

class AjaxPaciente {

  public $id;
  public $fecha_nacimiento;
	public $documento_ci;
	public $paterno_paciente;
	public $materno_paciente;
	public $nombre_paciente;
	public $sexo;
	public $estado_civil;
	public $domicilio;
	public $telefono;
	public $particular;
	public $cod_asegurado;
	public $cod_beneficiario;
	public $nro_empleador;
	public $nombre_empleador;
	public $estado_asegurado;
	public $id_consultorio;
	public $validarDocumentoPaciente;

  /*=============================================
	MOSTRAR DATOS DE PACIENTES
	=============================================*/
	public function ajaxMostrarPacientes()	{

		$item = "id";
		$valor = $this->id;

		$pacientes = ControllerPacientes::ctrMostrarPacientes($item, $valor);
	
		echo json_encode($pacientes);	
			
	}

	/*=============================================
	MOSTRAR DATOS DE HISTORIAL DE PACIENTES 
	=============================================*/
	public function ajaxHistorialPacientes()	{

		$item = "idpaciente";
		$valor = $this->idpaciente;

		$pacientes = ControllerHistorialpaciente::ctrHistorialPacientes($item, $valor);
	
		echo json_encode($pacientes);	
			
	}

	/*=============================================
	REGISTRO DE NUEVO PACIENTE
	=============================================*/
	public function ajaxNuevoPaciente()	{

		$datos = array("nombre_paciente"     => mb_strtoupper($this->nombre_paciente, 'utf-8'),
		               "paterno_paciente"	   => mb_strtoupper($this->paterno_paciente, 'utf-8'),
		               "materno_paciente"    => mb_strtoupper($this->materno_paciente, 'utf-8'), 
		               "documento_ci"     	 => $this->documento_ci,
		               "cod_asegurado"   	   => mb_strtoupper($this->cod_asegurado, 'utf-8'),
		               "cod_beneficiario"    => mb_strtoupper($this->cod_beneficiario, 'utf-8'),
		               "fecha_nacimiento"    => $this->fecha_nacimiento,
		               "estado_civil"   	   => $this->estado_civil,
		               "sexo"                => $this->sexo,
		               "domicilio"   	   		 => mb_strtoupper($this->domicilio, 'utf-8'),
		               "telefono"   	       => $this->telefono,
		               "particular"   	     => $this->particular,
		               "nro_empleador"   	   => $this->nro_empleador,
		               "nombre_empleador"    => mb_strtoupper(rtrim($this->nombre_empleador), 'utf-8'),
		               "estado_asegurado"    => $this->estado_asegurado,
		               "id_consultorio"    	 => $this->id_consultorio
		);	
	
	  $respuesta = ControllerPacientes::ctrNuevoPaciente($datos);

	  echo json_encode($respuesta);
			
	}

	/*=============================================
	EDITAR PACIENTE
	=============================================*/
	public function ajaxEditarPacientes() {

		$datos = array("nombre_paciente"     => mb_strtoupper($this->nombre_paciente, 'utf-8'),
		               "paterno_paciente"	   => mb_strtoupper($this->paterno_paciente, 'utf-8'),
		               "materno_paciente"    => mb_strtoupper($this->materno_paciente, 'utf-8'), 
		               "documento_ci"     	 => $this->documento_ci,
		               "cod_asegurado"   	   => mb_strtoupper($this->cod_asegurado, 'utf-8'),
		               "cod_beneficiario"    => mb_strtoupper($this->cod_beneficiario, 'utf-8'),
		               "fecha_nacimiento"    => $this->fecha_nacimiento,
		               "estado_civil"   	   => $this->estado_civil,
		               "sexo"                => $this->sexo,
		               "domicilio"   	   		 => mb_strtoupper($this->domicilio, 'utf-8'),
		               "telefono"   	       => $this->telefono,
		               "particular"   	     => $this->particular,
		               "nro_empleador"   	   => $this->nro_empleador,
		               "nombre_empleador"    => mb_strtoupper(rtrim($this->nombre_empleador), 'utf-8'),
		               "estado_asegurado"    => $this->estado_asegurado,
		               "id_consultorio"    	 => $this->id_consultorio,
		               "id"				 					 => $this->id
		);	
		
		$respuesta = ControllerPacientes::ctrEditarPacientes($datos);
		
		echo $respuesta;
		
	}	

	/*=============================================
	VALIDAR NO REPETIR PACIENTE
	=============================================*/
	public function ajaxValidarPaciente() {

		$item = "documento_ci";
		$valor = $this->validarDocumentoPaciente;

		$respuesta = ControllerPacientes::ctrMostrarPacientes($item, $valor);

		echo json_encode($respuesta);

	}
		
}

/*=============================================
MOSTRAR PACIENTE
=============================================*/
if (isset($_POST["mostrarPaciente"])) {
				 
	$nuevoPaciente = new AjaxPaciente();
	$nuevoPaciente -> id = $_POST["id"];
	$nuevoPaciente -> ajaxMostrarPacientes();

}

/*=============================================
REGISTRO DE NUEVO PACIENTE
=============================================*/
if (isset($_POST["nuevoPaciente"])) {
				 
	$nuevoPaciente = new AjaxPaciente();

	$nuevoPaciente -> fecha_nacimiento = $_POST['nuevoFechaNacimientoPaciente'];
	$nuevoPaciente -> documento_ci = $_POST['nuevoDocumentoCiPaciente'];
	$nuevoPaciente -> paterno_paciente = $_POST['nuevoPaternoPaciente'];
	$nuevoPaciente -> materno_paciente = $_POST['nuevoMaternoPaciente'];
	$nuevoPaciente -> nombre_paciente = $_POST["nuevoNombrePaciente"];

	if (isset($_POST['nuevoSexoPaciente'])) {
		$nuevoPaciente -> sexo = $_POST['nuevoSexoPaciente'];
	} else {
		$nuevoPaciente -> sexo = "";
	}

	if (isset($_POST['nuevoSexoPaciente'])) {
		$nuevoPaciente -> estado_civil = $_POST['nuevoEstadoCivil'];
	} else {
		$nuevoPaciente -> estado_civil = "";
	}

	$nuevoPaciente -> domicilio = $_POST['nuevoDomicilioPaciente'];	
	$nuevoPaciente -> telefono = $_POST['nuevoTelefonoPaciente'];	

	if (isset($_POST['nuevoParticular'])) {
		if ($_POST['nuevoParticular'] == "on") {
			$nuevoPaciente -> particular = 1;
		} else {
			$nuevoPaciente -> particular = 0;
		}
	} else {
		$nuevoPaciente -> particular = 0;
	}

	$nuevoPaciente -> cod_asegurado = $_POST['nuevoCodAsegurado'];

	if (isset($_POST['nuevoCodBeneficiarioActual'])) {
		$nuevoPaciente -> cod_beneficiario = $_POST['nuevoCodBeneficiarioActual'];
	} else {
		$nuevoPaciente -> cod_beneficiario = $_POST['nuevoCodBeneficiario'];
	}
	
	$nuevoPaciente -> nro_empleador = $_POST['nuevoNroEmpleador'];
	$nuevoPaciente -> nombre_empleador = $_POST['nuevoNombreEmpleador'];
	$nuevoPaciente -> estado_asegurado = $_POST['nuevoEstadoAsegurado'];
	
	if (isset($_POST['nuevoZonaPaciente'])) {
		$nuevoPaciente -> id_consultorio = $_POST['nuevoZonaPaciente'];
	} else {
		$nuevoPaciente -> id_consultorio = null;
	}

	$nuevoPaciente -> ajaxNuevoPaciente();

}

/*=============================================
EDITAR PACIENTE
=============================================*/
if (isset($_POST["editarPaciente"])) {

	$editarPaciente = new AjaxPaciente();

	$editarPaciente -> fecha_nacimiento = $_POST['editarFechaNacimientoPaciente'];
	$editarPaciente -> documento_ci = $_POST['editarDocumentoCiPaciente'];
	$editarPaciente -> paterno_paciente = $_POST['editarPaternoPaciente'];
	$editarPaciente -> materno_paciente = $_POST['editarMaternoPaciente'];
	$editarPaciente -> nombre_paciente = $_POST["editarNombrePaciente"];

	if (isset($_POST['editarSexoPaciente'])) {
		$editarPaciente -> sexo = $_POST['editarSexoPaciente'];
	} else {
		$editarPaciente -> sexo = "";
	}

	if (isset($_POST['editarEstadoCivil'])) {
		$editarPaciente -> estado_civil = $_POST['editarEstadoCivil'];
	} else {
		$editarPaciente -> estado_civil = "";
	}
	
	$editarPaciente -> domicilio = $_POST['editarDomicilioPaciente'];	
	$editarPaciente -> telefono = $_POST['editarTelefonoPaciente'];	

	if (isset($_POST['editarParticular'])) {
		if ($_POST['editarParticular'] == "on") {
			$editarPaciente -> particular = 1;
		} else {
			$editarPaciente -> particular = 0;
		}
	} else {
		$editarPaciente -> particular = 0;
	}

	$editarPaciente -> cod_asegurado = $_POST['editarCodAsegurado'];

	if (isset($_POST['editarCodBeneficiario'])) {
		$editarPaciente -> cod_beneficiario = $_POST['editarCodBeneficiario'];
	} else {
		$editarPaciente -> cod_beneficiario = "";
	}
	
	$editarPaciente -> nro_empleador = $_POST['editarNroEmpleador'];
	$editarPaciente -> nombre_empleador = $_POST['editarNombreEmpleador'];
	$editarPaciente -> estado_asegurado = $_POST['editarEstadoAsegurado'];

	if (isset($_POST['editarZonaPaciente'])) {
		$editarPaciente -> id_consultorio = $_POST['editarZonaPaciente'];
	} else {
		$editarPaciente -> id_consultorio = null;
	}

	$editarPaciente -> id = $_POST['editarId'];

	$editarPaciente -> ajaxEditarPacientes();

}

/*=============================================
VALIDAR NO REPETIR PACIENTE
=============================================*/
if (isset($_POST["validarDocumentoPaciente"])) {

	$valPaciente = new AjaxPaciente();
	$valPaciente -> validarDocumentoPaciente = $_POST["validarDocumentoPaciente"];
	$valPaciente -> ajaxValidarPaciente();

}