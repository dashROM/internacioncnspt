<?php

require_once "../controllers/paciente_egresos.controller.php";
require_once "../models/paciente_egresos.model.php";

class TablaPacienteEgresos {

	public $request;

	public $fecha_ini;
	public $fecha_fin;

	/*=============================================
	MOSTRAR LA TABLA DE PACIENTES EGRESOS
	=============================================*/
	public function mostrarTablaPacientesEgresos() {

		$request = $this->request;

		$col = array(
	    0   =>  'id',
	    1   =>  'id',
	    2   =>  'nombre_completo',
	    3   =>  'fecha_egreso',
	    4   =>  'hora_egreso',
	    5   =>  'causa_egreso',
	    6   =>  'condicion_egreso',
	    7   =>  'diagnostico',
	    8   =>  'diagnostico_egreso1',
	    9   =>  'id',

		);  //create column like table in database

		$totalData = ControllerPacienteEgresos::ctrContarPacientesEgresos();

		$totalFilter = $totalData;

		//Search
		$sql = "";

		if(!empty($request['search']['value'])) {

	    $sql .= " AND (paterno_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR materno_paciente ILike '%".$request['search']['value']."%' ";
    	$sql .= " OR nombre_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR causa_egreso ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR condicion_egreso ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR codigo ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR descripcion ILike '%".$request['search']['value']."%' )";
	    $sql .= " OR diagnostico_egreso1 ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR diagnostico_egreso2 ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR diagnostico_egreso3 ILike '%".$request['search']['value']."%' )";
	
		}

		$totalFilter = ControllerPacienteEgresos::ctrContarFiltradoPacientesEgresos($sql);

		$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
   	$request['length']."  OFFSET ".$request['start']."  ";

  	$paciente_egresos = ControllerPacienteEgresos::ctrMostrarPacientesEgresos($sql);
  	
		$data = array();

		for ($i = 0; $i < count($paciente_egresos); $i++) {

			/*=============================================
			TRAEMOS LAS ACCIONES
			=============================================*/					
			$btnReporteForm204 = "<button class='btn btn-outline-primary btn-sm btnReporteForm204' idPaciente='".$paciente_egresos[$i]["id_paciente"]."' idPacienteIngreso='".$paciente_egresos[$i]["id_paciente_ingreso"]."' modulo='paciente-ingresos' data-toggle='tooltip' title='Reportes Paciente'><i class='fas fa-print'></i></button>";

			$estado = "<button class='btn btn-success btn-sm btnVerAltaPaciente' idPacienteIngreso='".$paciente_egresos[$i]["id_paciente_ingreso"]."' estado_paciente='1' data-bs-toggle='modal' modulo='paciente-egresos' data-bs-target='#modalVerAltaPaciente' data-toggle='tooltip' title='Ver Detalle Alta Paciente'>DADO DE ALTA</button>";

			$botones = "<div class='btn-group'>".$btnReporteForm204."</div>";

			$subdata = array();
	    $subdata[] = $i+1;
	    $subdata[] = $botones;
	    $subdata[] = $paciente_egresos[$i]["nombre_completo"];
	    $subdata[] = date("d/m/Y", strtotime($paciente_egresos[$i]["fecha_egreso"])); 
	    $subdata[] = $paciente_egresos[$i]["hora_egreso"]; 
	    $subdata[] = $paciente_egresos[$i]["causa_egreso"];  
	    $subdata[] = $paciente_egresos[$i]["condicion_egreso"];
	    $subdata[] = $paciente_egresos[$i]["diagnostico"]; 
	    $subdata[] = $paciente_egresos[$i]["diagnostico_egreso1"].' - '.$paciente_egresos[$i]["diagnostico_egreso2"].' - '.$paciente_egresos[$i]["diagnostico_egreso3"]; 
	    $subdata[] = $estado;

	    $data[] = $subdata;	

		}

		$json_data = array(
	    "draw"              =>  intval($request['draw']),
	    "recordsTotal"      =>  intval($totalData),
	    "recordsFiltered"   =>  intval($totalFilter),
	    "data"              =>  $data
		);

		echo json_encode($json_data);

	}

	/*=============================================
	MOSTRAR LA TABLA DE PACIENTES INGRESOS
	=============================================*/
	public function mostrarTablaPacientesFechaEgresos() {

		$request = $this->request;

		$item1 = "fecha_ini";;
		$valor1 = $this->fecha_ini;

		$item2 = "fecha_fin";
		$valor2 = $this->fecha_fin;

		$col = array(
	    0   =>  'id',
	    1   =>  'id',
	    2   =>  'nombre_completo',
	    3   =>  'fecha_egreso',
	    4   =>  'hora_egreso',
	    5   =>  'causa_egreso',
	    6   =>  'condicion_egreso',
	    7   =>  'diagnostico',
	    8   =>  'diagnostico_egreso1',
	    9   =>  'id',

		);  //create column like table in database

		$totalData = ControllerPacienteEgresos::ctrContarPacientesEgresosFecha($item1, $valor1, $item2, $valor2);

		$totalFilter = $totalData;

		//Search
		$sql = "";

		if(!empty($request['search']['value'])) {

	    $sql .= " AND (paterno_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR materno_paciente ILike '%".$request['search']['value']."%' ";
    	$sql .= " OR nombre_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR causa_egreso ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR condicion_egreso ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR codigo ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR descripcion ILike '%".$request['search']['value']."%' )";
	    $sql .= " OR diagnostico_egreso1 ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR diagnostico_egreso2 ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR diagnostico_egreso3 ILike '%".$request['search']['value']."%' )";
	
		}

		$totalFilter = ControllerPacienteEgresos::ctrContarFiltradoPacientesEgresosFecha($item1, $valor1, $item2, $valor2, $sql);

		$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
   	$request['length']."  OFFSET ".$request['start']."  ";

  	$paciente_egresos = ControllerPacienteEgresos::ctrMostrarPacientesEgresosFecha($item1, $valor1, $item2, $valor2, $sql);
  	
		$data = array();

		for ($i = 0; $i < count($paciente_egresos); $i++) {

			/*=============================================
			TRAEMOS LAS ACCIONES
			=============================================*/					
			$btnReporteForm204 = "<button class='btn btn-outline-primary btn-sm btnReporteForm204' idPaciente='".$paciente_egresos[$i]["id_paciente"]."' idPacienteIngreso='".$paciente_egresos[$i]["id_paciente_ingreso"]."' modulo='paciente-ingresos' data-toggle='tooltip' title='Reportes Paciente'><i class='fas fa-print'></i></button>";

			$estado = "<button class='btn btn-success btn-sm btnVerAltaPaciente' idPacienteIngreso='".$paciente_egresos[$i]["id_paciente_ingreso"]."' estado_paciente='1' data-bs-toggle='modal' modulo='paciente-egresos' data-bs-target='#modalVerAltaPaciente' data-toggle='tooltip' title='Ver Detalle Alta Paciente'>DADO DE ALTA</button>";

			$botones = "<div class='btn-group'>".$btnReporteForm204."</div>";

			$subdata = array();
	    $subdata[] = $i+1;
	    $subdata[] = $botones;
	    $subdata[] = $paciente_egresos[$i]["nombre_completo"];
	    $subdata[] = date("d/m/Y", strtotime($paciente_egresos[$i]["fecha_egreso"])); 
	    $subdata[] = $paciente_egresos[$i]["hora_egreso"]; 
	    $subdata[] = $paciente_egresos[$i]["causa_egreso"];  
	    $subdata[] = $paciente_egresos[$i]["condicion_egreso"];
	    $subdata[] = $paciente_egresos[$i]["diagnostico"]; 
	    $subdata[] = $paciente_egresos[$i]["diagnostico_egreso1"].' - '.$paciente_egresos[$i]["diagnostico_egreso2"].' - '.$paciente_egresos[$i]["diagnostico_egreso3"]; 
	    $subdata[] = $estado;

	    $data[] = $subdata;	

		}

		$json_data = array(
	    "draw"              =>  intval($request['draw']),
	    "recordsTotal"      =>  intval($totalData),
	    "recordsFiltered"   =>  intval($totalFilter),
	    "data"              =>  $data
		);

		echo json_encode($json_data);
	
	}

} 

/*=============================================
ACTIVAR TABLA PACIENTE EGRESOS
=============================================*/

if (isset($_POST["pacientesEgresados"])) {

	$activarPacienteEgresos = new TablaPacienteEgresos();
	$activarPacienteEgresos -> request = $_REQUEST;	
	$activarPacienteEgresos -> mostrarTablaPacientesEgresos();

}

if (isset($_POST["BuscarFechaEgresados"])) {

	$activarPacienteEgresos = new TablaPacienteEgresos();
	$activarPacienteEgresos -> request = $_REQUEST;
	$activarPacienteEgresos -> fecha_ini = $_POST["fechaIni"];
	$activarPacienteEgresos -> fecha_fin = $_POST["fechaFin"];
	$activarPacienteEgresos -> mostrarTablaPacientesFechaEgresos();

}