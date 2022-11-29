<?php

require_once "../controllers/neonatos.controller.php";
require_once "../models/neonatos.model.php";

class AjaxNeonatos {

    public $id;
    public $peso_neonato;
    public $talla_neonato;
	public $pc_neonato;
	public $pt_neonato;
	public $apgar;
	public $edad_gestacional_neonato;
	public $tipo_parto_neonato;
	public $descripcion_parto;
    public $id_paciente_ingreso;

	/*=============================================
	MOSTRAR DATOS DE NEONATOS
	=============================================*/
	public function ajaxMostrarNeonato()	{

		$item = "id_paciente_ingreso";
		$valor = $this->id_paciente_ingreso;

		$neonato = ControllerNeonatos::ctrMostrarNeonato($item, $valor);
	
		echo json_encode($neonato);	
			
	}

	/*=============================================
	NUEVO INGRESO DE NEONATO
	=============================================*/
    public function ajaxNuevoNeonato() {

		$datos = array("peso_neonato"              	  => $this->peso_neonato, 
		               "talla_neonato"	              => $this->talla_neonato,
		               "pc_neonato"	              	  => $this->pc_neonato,
		               "pt_neonato"	              	  => $this->pt_neonato,
		               "apgar"		              	  => $this->apgar,
		               "edad_gestacional_neonato"     => $this->edad_gestacional_neonato,
                       "tipo_parto_neonato"           => $this->tipo_parto_neonato,
                       "descripcion_parto"            => mb_strtoupper($this->descripcion_parto,'utf-8'),
		               "id_paciente_ingreso"          => $this->id_paciente_ingreso
		);
	
		$respuesta = ControllerNeonatos::ctrNuevoNeonato($datos);
	
		echo json_encode($respuesta);
			
	}

	/*=============================================
	EDITAR REGISTRO DE NEONATO
	=============================================*/
	public function ajaxEditarNeonato() {

		$datos = array("peso_neonato"              	  => $this->peso_neonato, 
		               "talla_neonato"	              => $this->talla_neonato,
		               "pc_neonato"	              	  => $this->pc_neonato,
		               "pt_neonato"	              	  => $this->pt_neonato,
		               "apgar"		              	  => $this->apgar,
		               "edad_gestacional_neonato"     => $this->edad_gestacional_neonato,
                       "tipo_parto_neonato"           => $this->tipo_parto_neonato,
                       "descripcion_parto"            => mb_strtoupper($this->descripcion_parto,'utf-8'),
		               "id_paciente_ingreso"          => $this->id_paciente_ingreso,
		               "id" 				          => $this->id
		);
		
		$respuesta = ControllerNeonatos::ctrEditarNeonato($datos);
		
		echo json_encode($respuesta);
		
	}
    
}

/*=============================================
MOSTRAR DATOS PACIENTE NEONATO
=============================================*/
if (isset($_POST["mostrarNeonato"])) {
				 
	$Neonato = new AjaxNeonatos();
	$Neonato -> id_paciente_ingreso = $_POST["idPacienteIngreso"];
	$Neonato -> ajaxMostrarNeonato();

}

/*=============================================
NUEVO INGRESO DE NEONATO
=============================================*/
if (isset($_POST["nuevoNeonato"])) {
				 
	$nuevoNeonato = new AjaxNeonatos;
	$nuevoNeonato -> peso_neonato = $_POST["nuevoPesoNeonato"];
	$nuevoNeonato -> talla_neonato = $_POST['nuevoTallaNeonato'];
	// $nuevoNeonato -> pc_neonato = $_POST['nuevoPCNeonato'];
	if ($_POST['nuevoPCNeonato'] != "") {
		$nuevoNeonato -> pc_neonato = $_POST['nuevoPCNeonato'];
	} else {
		$nuevoNeonato -> pc_neonato = "0";
	}
	// $nuevoNeonato -> pt_neonato = $_POST['nuevoPTNeonato'];
	if ($_POST['nuevoPTNeonato'] != "") {
		$nuevoNeonato -> pt_neonato = $_POST['nuevoPTNeonato'];
	} else {
		$nuevoNeonato -> pt_neonato = "0";
	}
	$nuevoNeonato -> apgar = $_POST['nuevoAPGAR'];	
	// $nuevoNeonato -> edad_gestacional_neonato = $_POST['nuevoEdadGestacional'];
	if ($_POST['nuevoEdadGestacional'] != "") {
		$nuevoNeonato -> edad_gestacional_neonato = $_POST['nuevoEdadGestacional'];
	} else {
		$nuevoNeonato -> edad_gestacional_neonato = "0";
	}
	// $nuevoNeonato -> tipo_parto_neonato = $_POST['nuevoTipoPartoNeonato'];
	if (isset($_POST["nuevoTipoPartoNeonato"])) {
		$nuevoNeonato -> tipo_parto_neonato = $_POST['nuevoTipoPartoNeonato'];
	} else {
		$nuevoNeonato -> tipo_parto_neonato = "";
	}
	$nuevoNeonato -> descripcion_parto = $_POST['nuevoDescripcionParto'];
	$nuevoNeonato -> id_paciente_ingreso = $_POST['idPacienteIngresoN'];
	$nuevoNeonato -> ajaxNuevoNeonato();

}

/*=============================================
EDITAR REGISTRO DE NEONATO
=============================================*/
if (isset($_POST["editarNeonato"])) {
				 
	$editarNeonato = new AjaxNeonatos;
	$editarNeonato -> peso_neonato = $_POST["editarPesoNeonato"];
	$editarNeonato -> talla_neonato = $_POST['editarTallaNeonato'];
	// $editarNeonato -> pc_neonato = $_POST['editarPCNeonato'];
	if ($_POST['editarPCNeonato'] != "") {
		$editarNeonato -> pc_neonato = $_POST['editarPCNeonato'];
	} else {
		$editarNeonato -> pc_neonato = "0";
	}
	// $editarNeonato -> pt_neonato = $_POST['editarPTNeonato'];
	if ($_POST['editarPTNeonato'] != "") {
		$editarNeonato -> pt_neonato = $_POST['editarPTNeonato'];
	} else {
		$editarNeonato -> pt_neonato = "0";
	}
	$editarNeonato -> apgar = $_POST['editarAPGAR'];
	// $editarNeonato -> edad_gestacional_neonato = $_POST['editarEdadGestacional'];
	if ($_POST['editarEdadGestacional'] != "") {
		$editarNeonato -> edad_gestacional_neonato = $_POST['editarEdadGestacional'];
	} else {
		$editarNeonato -> edad_gestacional_neonato = "0";
	}
	// $editarNeonato -> tipo_parto_neonato = $_POST['editarTipoPartoNeonato'];
	if (isset($_POST["editarTipoPartoNeonato"])) {
		$editarNeonato -> tipo_parto_neonato = $_POST['editarTipoPartoNeonato'];
	} else {
		$editarNeonato -> tipo_parto_neonato = "";
	}
	$editarNeonato -> descripcion_parto = $_POST['editarDescripcionParto'];
	$editarNeonato -> id_paciente_ingreso = $_POST['idPacienteIngresoEN'];
	$editarNeonato -> id = $_POST['idNeonato'];
	$editarNeonato -> ajaxEditarNeonato();

}