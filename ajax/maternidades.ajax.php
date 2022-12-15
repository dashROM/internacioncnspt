<?php

require_once "../controllers/maternidades.controller.php";
require_once "../models/maternidades.model.php";

class AjaxMaternidades {

    public $id;
    public $procedencia;
	public $paridad;
	public $diagnostico_maternidad;
	public $edad_gestacional;
	public $tipo_parto;
	public $tipo_aborto;     
	public $liquido_amniotico;
	public $fecha_nacido;     
	public $hora_nacido;
	public $peso_nacido1;     
	public $sexo_nacido1;	
	public $peso_nacido2;     
	public $sexo_nacido2;	
	public $peso_nacido3;     
	public $sexo_nacido3;	
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
		               "edad_gestacional"     	      => $this->edad_gestacional,
                       "tipo_parto"                   => $this->tipo_parto,
                       "tipo_aborto"                  => $this->tipo_aborto,
		               "liquido_amniotico"            => $this->liquido_amniotico,
		               "fecha_nacido"                 => $this->fecha_nacido,
		               "hora_nacido"                  => $this->hora_nacido,
		               "peso_nacido1"                 => $this->peso_nacido1,
		               "sexo_nacido1"                 => $this->sexo_nacido1,
		               "peso_nacido2"                 => $this->peso_nacido2,
		               "sexo_nacido2"                 => $this->sexo_nacido2,
		               "peso_nacido3"                 => $this->peso_nacido3,
		               "sexo_nacido3"                 => $this->sexo_nacido3,
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
		               "edad_gestacional"     	  	  => $this->edad_gestacional,
                       "tipo_parto"                   => $this->tipo_parto,
                       "tipo_aborto"                  => $this->tipo_aborto,
		               "liquido_amniotico"            => $this->liquido_amniotico,
		               "fecha_nacido"                 => $this->fecha_nacido,
		               "hora_nacido"                  => $this->hora_nacido,
		               "peso_nacido1"                 => $this->peso_nacido1,
		               "sexo_nacido1"                 => $this->sexo_nacido1,
		               "peso_nacido2"                 => $this->peso_nacido2,
		               "sexo_nacido2"                 => $this->sexo_nacido2,
		               "peso_nacido3"                 => $this->peso_nacido3,
		               "sexo_nacido3"                 => $this->sexo_nacido3,
		               "estado_nacido"                => $this->estado_nacido,
		               "alumbramiento"                => $this->alumbramiento,
		               "perine"                       => $this->perine, 
		               "sangrado"                     => $this->sangrado,
		               "estado_madre"                 => $this->estado_madre,
		               "nombre_esposo"                => mb_strtoupper($this->nombre_esposo,'utf-8'),
		               "id_paciente_ingreso"          => $this->id_paciente_ingreso,
		               "id" 				          => $this->id
		);
		
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

	if ($_POST['nuevoParidad'] != "") {
		$nuevoMaternidad -> paridad = $_POST['nuevoParidad'];
	} else {
		$nuevoMaternidad -> paridad = null;
	}
	
	if ($_POST['nuevoEdadGestacional'] != "") {
		$nuevoMaternidad -> edad_gestacional = $_POST['nuevoEdadGestacional'];
	} else {
		$nuevoMaternidad -> edad_gestacional = null;
	}

	if (isset($_POST["nuevoTipoParto"])) {
		$nuevoMaternidad -> tipo_parto = $_POST['nuevoTipoParto'];
	} else {
		$nuevoMaternidad -> tipo_parto = null;
	}

	if (isset($_POST["nuevoLiquidoAmniotico"])) {
		$nuevoMaternidad -> liquido_amniotico = $_POST['nuevoLiquidoAmniotico'];
	} else {
		$nuevoMaternidad -> liquido_amniotico = null;
	}
 
	if ($_POST["nuevoFechaParto"] != "") {
		$nuevoMaternidad -> fecha_nacido = $_POST['nuevoFechaParto'];
	} else {
		$nuevoMaternidad -> fecha_nacido = null;
	}

	if ($_POST["nuevoHoraParto"] != "") {
		$nuevoMaternidad -> hora_nacido = $_POST['nuevoHoraParto'];
	} else {
		$nuevoMaternidad -> hora_nacido = null;
	}

	if ($_POST['nuevoPesoNacido1'] != "") {
		$nuevoMaternidad -> peso_nacido1 = $_POST['nuevoPesoNacido1'];
	} else {
		$nuevoMaternidad -> peso_nacido1 = null;
	}
	
	if (isset($_POST["nuevoSexoNacido1"])) {
		$nuevoMaternidad -> sexo_nacido1 = $_POST['nuevoSexoNacido1'];
	} else {
		$nuevoMaternidad -> sexo_nacido1 = null;
	}

	if ($_POST['nuevoPesoNacido2'] != "") {
		$nuevoMaternidad -> peso_nacido2 = $_POST['nuevoPesoNacido2'];
	} else {
		$nuevoMaternidad -> peso_nacido2 = null;
	}
	
	if (isset($_POST["nuevoSexoNacido2"])) {
		$nuevoMaternidad -> sexo_nacido2 = $_POST['nuevoSexoNacido2'];
	} else {
		$nuevoMaternidad -> sexo_nacido2 = null;
	}

	if ($_POST['nuevoPesoNacido3'] != "") {
		$nuevoMaternidad -> peso_nacido3 = $_POST['nuevoPesoNacido3'];
	} else {
		$nuevoMaternidad -> peso_nacido3 = null;
	}
	
	if (isset($_POST["nuevoSexoNacido3"])) {
		$nuevoMaternidad -> sexo_nacido3 = $_POST['nuevoSexoNacido3'];
	} else {
		$nuevoMaternidad -> sexo_nacido3 = null;
	}

	if (isset($_POST["nuevoEstadoNacido"])) {
		$nuevoMaternidad -> estado_nacido = $_POST['nuevoEstadoNacido'];
	} else {
		$nuevoMaternidad -> estado_nacido = null;
	}

	if (isset($_POST["nuevoAlumbramiento"])) {
		$nuevoMaternidad -> alumbramiento = $_POST['nuevoAlumbramiento'];
	} else {
		$nuevoMaternidad -> alumbramiento = null;
	}

	if (isset($_POST["nuevoPerine"])) {
		$nuevoMaternidad -> perine = $_POST['nuevoPerine'];
	} else {
		$nuevoMaternidad -> perine = null;
	}

	if (isset($_POST["nuevoSangrado"])) {
		$nuevoMaternidad -> sangrado = $_POST['nuevoSangrado'];
	} else {
		$nuevoMaternidad -> sangrado = null;
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

	if ($_POST['editarParidad'] != "") {
		$editarMaternidad -> paridad = $_POST['editarParidad'];
	} else {
		$editarMaternidad -> paridad = null;
	}
	
	if ($_POST['editarEdadGestacional'] != "") {
		$editarMaternidad -> edad_gestacional = $_POST['editarEdadGestacional'];
	} else {
		$editarMaternidad -> edad_gestacional = null;
	}

	if (isset($_POST["editarTipoParto"])) {
		$editarMaternidad -> tipo_parto = $_POST['editarTipoParto'];
	} else {
		$editarMaternidad -> tipo_parto = null;
	}

	if (isset($_POST["editarLiquidoAmniotico"])) {
		$editarMaternidad -> liquido_amniotico = $_POST['editarLiquidoAmniotico'];
	} else {
		$editarMaternidad -> liquido_amniotico = null;
	}

	if ($_POST["editarFechaParto"] != "") {
		$editarMaternidad -> fecha_nacido = $_POST['editarFechaParto'];
	} else {
		$editarMaternidad -> fecha_nacido = null;
	}

	if ($_POST["editarHoraParto"] != "") {
		$editarMaternidad -> hora_nacido = $_POST['editarHoraParto'];
	} else {
		$editarMaternidad -> hora_nacido = null;
	}

	if ($_POST['editarPesoNacido1'] != "") {
		$editarMaternidad -> peso_nacido1 = $_POST['editarPesoNacido1'];
	} else {
		$editarMaternidad -> peso_nacido1 = null;
	}

	if (isset($_POST["editarSexoNacido1"])) {
		$editarMaternidad -> sexo_nacido1 = $_POST['editarSexoNacido1'];
	} else {
		$editarMaternidad -> sexo_nacido1 = null;
	}

	if ($_POST['editarPesoNacido2'] != "") {
		$editarMaternidad -> peso_nacido2 = $_POST['editarPesoNacido2'];
	} else {
		$editarMaternidad -> peso_nacido2 = null;
	}

	if (isset($_POST["editarSexoNacido2"])) {
		$editarMaternidad -> sexo_nacido2 = $_POST['editarSexoNacido2'];
	} else {
		$editarMaternidad -> sexo_nacido2 = null;
	}

	if ($_POST['editarPesoNacido3'] != "") {
		$editarMaternidad -> peso_nacido3 = $_POST['editarPesoNacido3'];
	} else {
		$editarMaternidad -> peso_nacido3 = null;
	}

	if (isset($_POST["editarSexoNacido3"])) {
		$editarMaternidad -> sexo_nacido3 = $_POST['editarSexoNacido3'];
	} else {
		$editarMaternidad -> sexo_nacido3 = null;
	}

	if (isset($_POST["editarEstadoNacido"])) {
		$editarMaternidad -> estado_nacido = $_POST['editarEstadoNacido'];
	} else {
		$editarMaternidad -> estado_nacido = null;
	}

	if (isset($_POST["editarAlumbramiento"])) {
		$editarMaternidad -> alumbramiento = $_POST['editarAlumbramiento'];
	} else {
		$editarMaternidad -> alumbramiento = null;
	}

	if (isset($_POST["editarPerine"])) {
		$editarMaternidad -> perine = $_POST['editarPerine'];
	} else {
		$editarMaternidad -> perine = null;
	}

	if (isset($_POST["editarSangrado"])) {
		$editarMaternidad -> sangrado = $_POST['editarSangrado'];
	} else {
		$editarMaternidad -> sangrado = null;
	}

	$editarMaternidad -> estado_madre = $_POST['editarEstadoMadre'];
	$editarMaternidad -> nombre_esposo = $_POST['editarNombreEsposo'];
	$editarMaternidad -> id_paciente_ingreso = $_POST['idPacienteIngresoEM'];
	$editarMaternidad -> id = $_POST['idMaternidad'];
	$editarMaternidad -> ajaxEditarMaternidad();
}