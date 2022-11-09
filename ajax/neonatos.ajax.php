<?php

require_once "../controllers/neonatos.controller.php";
require_once "../models/neonatos.model.php";

class AjaxNeonatos {

    public $id;
    public $peso_neonato;
    public $talla_neonato;
	public $pc_neonato;
	public $pt_neonato;
	public $apgar_ini;
	public $apgar_fin;
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
		               "apgar_ini"	              	  => $this->apgar_ini,
		               "apgar_fin"     	  		  	  => $this->apgar_fin,
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
		               "apgar_ini"	              	  => $this->apgar_ini,
		               "apgar_fin"     	  		  	  => $this->apgar_fin,
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
	$nuevoNeonato -> pc_neonato = $_POST['nuevoPCNeonato'];
	$nuevoNeonato -> pt_neonato = $_POST['nuevoPTNeonato'];
	$nuevoNeonato -> apgar_ini = $_POST['nuevoAPGARIni'];
	$nuevoNeonato -> apgar_fin = $_POST['nuevoAPGARFin'];
	$nuevoNeonato -> edad_gestacional_neonato = $_POST['nuevoEdadGestacional'];
	$nuevoNeonato -> tipo_parto_neonato = $_POST['nuevoTipoPartoNeonato'];
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
	$editarNeonato -> pc_neonato = $_POST['editarPCNeonato'];
	$editarNeonato -> pt_neonato = $_POST['editarPTNeonato'];
	$editarNeonato -> apgar_ini = $_POST['editarAPGARIni'];
	$editarNeonato -> apgar_fin = $_POST['editarAPGARFin'];
	$editarNeonato -> edad_gestacional_neonato = $_POST['editarEdadGestacional'];
	$editarNeonato -> tipo_parto_neonato = $_POST['editarTipoPartoNeonato'];
	$editarNeonato -> descripcion_parto = $_POST['editarDescripcionParto'];
	$editarNeonato -> id_paciente_ingreso = $_POST['idPacienteIngresoEN'];
	$editarNeonato -> id = $_POST['idNeonato'];
	$editarNeonato -> ajaxEditarNeonato();

}