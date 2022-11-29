<?php

require_once "../controllers/maternidades.controller.php";
require_once "../models/maternidades.model.php";

class AjaxMaternidades {

    public $id;
    public $procedencia;
	public $paridad;
	public $diagnostico_maternidad;
	public $edad_gestacional_fum;
	public $edad_gestacional_ecografia;
	public $tipo_parto;
	public $tipo_aborto;     
	public $liquido_amniotico;
	public $fecha_nacido;     
	public $hora_nacido;
	public $peso_nacido;     
	public $sexo_nacido;	
    public $estado_nacido;
    public $alumbramiento;     
	public $perine;	
    public $sangrado;
    public $estado_madre;
    public $nombre_esposo;
    public $id_paciente_ingreso;

	/*=============================================
	MOSTRAR DATOS DE MATERNIDAD
	=============================================*/
	public function ajaxMostrarMaternidad()	{

		$item = "id_paciente_ingreso";
		$valor = $this->id_paciente_ingreso;

		$maternidad = ControllerMaternidades::ctrMostrarMaternidad($item, $valor);
	
		echo json_encode($maternidad);	
			
	}

	/*=============================================
	NUEVO INGRESO A MATERNIDAD
	=============================================*/
    public function ajaxNuevoMaternidad() {

		$datos = array("procedencia"              	  => $this->procedencia, 
		               "paridad"	              	  => $this->paridad,
		               "edad_gestacional_fum"     	  => $this->edad_gestacional_fum,
		               "edad_gestacional_ecografia"   => $this->edad_gestacional_ecografia,
                       "tipo_parto"                   => $this->tipo_parto,
                       "tipo_aborto"                  => $this->tipo_aborto,
		               "liquido_amniotico"            => $this->liquido_amniotico,
		               "fecha_nacido"                 => $this->fecha_nacido,
		               "hora_nacido"                  => $this->hora_nacido,
		               "peso_nacido"                  => $this->peso_nacido,
		               "sexo_nacido"                  => $this->sexo_nacido,
		               "estado_nacido"                => $this->estado_nacido,
		               "alumbramiento"                => $this->alumbramiento,
		               "perine"                       => $this->perine, 
		               "sangrado"                     => $this->sangrado,
		               "estado_madre"                 => $this->estado_madre,
		               "nombre_esposo"                => mb_strtoupper($this->nombre_esposo,'utf-8'),
		               "id_paciente_ingreso"          => $this->id_paciente_ingreso
		);
	
		$respuesta = ControllerMaternidades::ctrNuevoMaternidad($datos);
	
		echo json_encode($respuesta);
			
	}

	/*=============================================
	EDITAR REGISTRO A MATERNIDAD
	=============================================*/
	public function ajaxEditarMaternidad() {

		$datos = array("procedencia"              	  => $this->procedencia, 
		               "paridad"	              	  => $this->paridad,
		               "edad_gestacional_fum"     	  => $this->edad_gestacional_fum,
		               "edad_gestacional_ecografia"   => $this->edad_gestacional_ecografia,
                       "tipo_parto"                   => $this->tipo_parto,
                       "tipo_aborto"                  => $this->tipo_aborto,
		               "liquido_amniotico"            => $this->liquido_amniotico,
		               "fecha_nacido"                 => $this->fecha_nacido,
		               "hora_nacido"                  => $this->hora_nacido,
		               "peso_nacido"                  => $this->peso_nacido,
		               "sexo_nacido"                  => $this->sexo_nacido,
		               "estado_nacido"                => $this->estado_nacido,
		               "alumbramiento"                => $this->alumbramiento,
		               "perine"                       => $this->perine, 
		               "sangrado"                     => $this->sangrado,
		               "estado_madre"                 => $this->estado_madre,
		               "nombre_esposo"                => mb_strtoupper($this->nombre_esposo,'utf-8'),
		               "id_paciente_ingreso"          => $this->id_paciente_ingreso,
		               "id" 				          => $this->id
		);

		// var_dump($datos);
		
		$respuesta = ControllerMaternidades::ctrEditarMaternidad($datos);
		
		echo json_encode($respuesta);
		
	}
    
}

/*=============================================
MOSTRAR PACIENTE
=============================================*/
if (isset($_POST["mostrarMaternidad"])) {
				 
	$maternidad = new AjaxMaternidades();
	$maternidad -> id_paciente_ingreso = $_POST["idPacienteIngreso"];
	$maternidad -> ajaxMostrarMaternidad();

}

/*=============================================
NUEVO INGRESO A MATERNIDAD
=============================================*/
if (isset($_POST["nuevoMaternidad"])) {
				 
	$nuevoMaternidad = new AjaxMaternidades;
	$nuevoMaternidad -> procedencia = $_POST["nuevoProcedencia"];
	$nuevoMaternidad -> paridad = $_POST['nuevoParidad'];
	
	if ($_POST['nuevoEdadFUM'] != "") {
		$nuevoMaternidad -> edad_gestacional_fum = $_POST['nuevoEdadFUM'];
	} else {
		$nuevoMaternidad -> edad_gestacional_fum = "0";
	}

	if ($_POST['nuevoEdadEcografia'] != "") {
		$nuevoMaternidad -> edad_gestacional_ecografia = $_POST['nuevoEdadEcografia'];
	} else {
		$nuevoMaternidad -> edad_gestacional_ecografia = "0";
	}

	// $nuevoMaternidad -> tipo_intervencion = $_POST['nuevoTipoIntervencion'];

	if (isset($_POST["nuevoTipoParto"])) {
		$nuevoMaternidad -> tipo_parto = $_POST['nuevoTipoParto'];
	} else {
		$nuevoMaternidad -> tipo_parto = "";
	}

	if (isset($_POST["nuevoLiquidoAmniotico"])) {
		$nuevoMaternidad -> liquido_amniotico = $_POST['nuevoLiquidoAmniotico'];
	} else {
		$nuevoMaternidad -> liquido_amniotico = "";
	}
 
	$nuevoMaternidad -> fecha_nacido = $_POST['nuevoFechaParto'];
	$nuevoMaternidad -> hora_nacido = $_POST['nuevoHoraParto'];
	$nuevoMaternidad -> peso_nacido = $_POST['nuevoPesoNacido'];
	$nuevoMaternidad -> sexo_nacido = $_POST['nuevoSexoNacido'];
	$nuevoMaternidad -> estado_nacido = $_POST['nuevoEstadoNacido'];

	if (isset($_POST["nuevoAlumbramiento"])) {
		$nuevoMaternidad -> alumbramiento = $_POST['nuevoAlumbramiento'];
	} else {
		$nuevoMaternidad -> alumbramiento = "";
	}

	if (isset($_POST["nuevoPerine"])) {
		$nuevoMaternidad -> perine = $_POST['nuevoPerine'];
	} else {
		$nuevoMaternidad -> perine = "";
	}

	if (isset($_POST["nuevoSangrado"])) {
		$nuevoMaternidad -> sangrado = $_POST['nuevoSangrado'];
	} else {
		$nuevoMaternidad -> sangrado = "";
	}

	$nuevoMaternidad -> estado_madre = $_POST['nuevoEstadoMadre'];
	$nuevoMaternidad -> nombre_esposo = $_POST['nuevoNombreEsposo'];
	$nuevoMaternidad -> id_paciente_ingreso = $_POST['idPacienteIngresoM'];
	$nuevoMaternidad -> ajaxNuevoMaternidad();

}   

/*=============================================
EDITAR PACIENTE
=============================================*/
if (isset($_POST["editarMaternidad"])) {

	$editarMaternidad = new AjaxMaternidades;
	$editarMaternidad -> procedencia = $_POST["editarProcedencia"];
	$editarMaternidad -> paridad = $_POST['editarParidad'];
	
	if ($_POST['editarEdadFUM'] != "") {
		$editarMaternidad -> edad_gestacional_fum = $_POST['editarEdadFUM'];
	} else {
		$editarMaternidad -> edad_gestacional_fum = "0";
	}

	if ($_POST['editarEdadEcografia'] != "") {
		$editarMaternidad -> edad_gestacional_ecografia = $_POST['editarEdadEcografia'];
	} else {
		$editarMaternidad -> edad_gestacional_ecografia = "0";
	}

	// $editarMaternidad -> tipo_intervencion = $_POST['editarTipoIntervencion'];

	if (isset($_POST["editarTipoParto"])) {
		$editarMaternidad -> tipo_parto = $_POST['editarTipoParto'];
	} else {
		$editarMaternidad -> tipo_parto = "";
	}

	if (isset($_POST["editarLiquidoAmniotico"])) {
		$editarMaternidad -> liquido_amniotico = $_POST['editarLiquidoAmniotico'];
	} else {
		$editarMaternidad -> liquido_amniotico = "";
	}
 
	$editarMaternidad -> fecha_nacido = $_POST['editarFechaParto'];
	$editarMaternidad -> hora_nacido = $_POST['editarHoraParto'];
	$editarMaternidad -> peso_nacido = $_POST['editarPesoNacido'];
	$editarMaternidad -> sexo_nacido = $_POST['editarSexoNacido'];
	$editarMaternidad -> estado_nacido = $_POST['editarEstadoNacido'];

	if (isset($_POST["editarAlumbramiento"])) {
		$editarMaternidad -> alumbramiento = $_POST['editarAlumbramiento'];
	} else {
		$editarMaternidad -> alumbramiento = "";
	}

	if (isset($_POST["editarPerine"])) {
		$editarMaternidad -> perine = $_POST['editarPerine'];
	} else {
		$editarMaternidad -> perine = "";
	}

	if (isset($_POST["editarSangrado"])) {
		$editarMaternidad -> sangrado = $_POST['editarSangrado'];
	} else {
		$editarMaternidad -> sangrado = "";
	}

	$editarMaternidad -> estado_madre = $_POST['editarEstadoMadre'];
	$editarMaternidad -> nombre_esposo = $_POST['editarNombreEsposo'];
	$editarMaternidad -> id_paciente_ingreso = $_POST['idPacienteIngresoEM'];
	$editarMaternidad -> id = $_POST['idMaternidad'];
	$editarMaternidad -> ajaxEditarMaternidad();
}