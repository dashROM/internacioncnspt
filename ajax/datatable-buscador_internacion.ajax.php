<?php

require_once "../controllers/paciente_internados.controller.php";
require_once "../models/paciente_internados.model.php";

class TablaBusquedaPaciente {

	public $cod_asegurado;
	public $documento_ci;
	public $nombre_paciente;

	/*=============================================
	MOSTRAR LA TABLA DE PACIENTES ENCONTRADOS POR MATRICULA
	=============================================*/	
	public function mostrarTablaPacienteInternadoMatricula() {

		$item = "cod_asegurado";
		$valor = mb_strtoupper($this->cod_asegurado,'utf-8');

		$respuesta = ControllerPacienteInternados::ctrMostrarPacienteInternadosFiltro($item,$valor);

		echo json_encode($respuesta);
	
	}	

	/*=============================================
	MOSTRAR LA TABLA DE PACIENTES ENCONTRADOS POR CI
	=============================================*/
	public function mostrarTablaPacienteInternadoCI() {

		$item = "documento_ci";
		$valor = $this->documento_ci;

		$respuesta = ControllerPacienteInternados::ctrMostrarPacienteInternadosFiltro($item,$valor);

		echo json_encode($respuesta);
	
	}	

	/*=============================================
	MOSTRAR LA TABLA DE PACIENTES ENCONTRADOS POR NOMBRE O APELLIDOS
	=============================================*/	
	public function mostrarTablaPacienteInternadoNombre() {

		$item = "nombre_paciente";
		$valor = mb_strtoupper($this->nombre_paciente,'utf-8');

		$respuesta = ControllerPacienteInternados::ctrMostrarPacienteInternadosFiltro($item,$valor);

		echo json_encode($respuesta);
	
	}	

}

/*=============================================
MOSTRAR PACIENTE POR MATRICULA
=============================================*/
if (isset($_POST["buscarMatricula"])) {
				 
	$busquedaPaciente = new TablaBusquedaPaciente();
	$busquedaPaciente -> cod_asegurado = $_POST["matricula"];
	$busquedaPaciente -> mostrarTablaPacienteInternadoMatricula();

}

/*=============================================
MOSTRAR PACIENTE POR CI
=============================================*/
if (isset($_POST["buscarCI"])) {
				 
	$busquedaPaciente = new TablaBusquedaPaciente();
	$busquedaPaciente -> documento_ci = $_POST["ci"];
	$busquedaPaciente -> mostrarTablaPacienteInternadoCI();

}

/*=============================================
MOSTRAR PACIENTE POR NOMBRE O APELLIDOS
=============================================*/
if (isset($_POST["buscarNombre"])) {
				 
	$busquedaPaciente = new TablaBusquedaPaciente();
	$busquedaPaciente -> nombre_paciente = $_POST["nombre"];
	$busquedaPaciente -> mostrarTablaPacienteInternadoNombre();

}