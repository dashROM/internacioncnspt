<?php

require_once "../controllers/pacientes.controller.php";
require_once "../models/pacientes.model.php";

class TablaPacientes {

	public $request;

	/*=============================================
	MOSTRAR LA TABLA DE PACIENTES
	=============================================*/
	public function mostrarTablaPacientes() {

		$request = $this->request;

		$col = array(
		    0   =>  'id',
		    1   =>  'id',
		    2   =>  'nombre_paciente',
		    3   =>  'paterno_paciente',
		    4   =>  'materno_paciente',
		    5   =>  'documento_ci',
		    6   =>  'cod_asegurado',
		    7   =>  'cod_beneficiario',
		    8   =>  'fecha_nacimiento',
		    9   =>  'fecha_nacimiento',
		    10   =>  'estado_civil',
		    11   =>  'sexo',
		    12   =>  'domicilio',
		    13   =>  'telefono',
		    14   =>  'nro_empleador',
		    15   =>  'nombre_empleador',
		    16   =>  'nombre_consultorio',
		    17   =>  'estado_asegurado'
		);  //create column like table in database

		$totalData = ControllerPacientes::ctrContarPacientes();

		$totalFilter = $totalData;

		//Search
		$sql = "";

		if(!empty($request['search']['value'])) {

	    $sql .= " AND (nombre_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR paterno_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR materno_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR documento_ci ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR cod_asegurado ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR cod_beneficiario ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR estado_civil ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR sexo ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR domicilio ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR telefono ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nro_empleador ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_empleador ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_consultorio ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR estado_asegurado ILike '%".$request['search']['value']."%' )";
		}

		$totalFilter = ControllerPacientes::ctrContarFiltradoPacientes($sql);

		$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
   	$request['length']."  OFFSET ".$request['start']."  ";

  	$pacientes = ControllerPacientes::ctrMostrarTodosPacientes($sql);
  	
		$data = array();

		for ($i = 0; $i < count($pacientes); $i++) {

			// Calcular la Edad a partir de la fecha de nacimiento
			$nacimiento = new DateTime($pacientes[$i]["fecha_nacimiento"]);
			$hoy = new DateTime(date("Y-m-d"));
			$edad = $hoy->diff($nacimiento);

			// Asignando valor y formato a fecha de nacimiento
			if ($pacientes[$i]["fecha_nacimiento"] == null) {
				$fecha_nacimiento = '';
			} else {
				$fecha_nacimiento = date("d/m/Y", strtotime($pacientes[$i]["fecha_nacimiento"]));
			}

			/*=============================================
		  TRAEMOS LAS ACCIONES
		  =============================================*/		
			$btnEditarPaciente = "<button  class='btn btn-outline-primary btn-sm btnEditarPaciente' id='".$pacientes[$i]["id"]."' data-bs-toggle='modal' data-bs-target='#modalEditarPaciente' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i> EDITAR</button>";
			$btnDetallePaciente = "<button class='btn btn-outline-primary btn-sm btnDetallePaciente' id='".$pacientes[$i]["id"]."' data-toggle='modal' data-target='#modalDetallePaciente' data-toggle='tooltip' title='Detalle Paciente'><i class='fas fa-file-invoice'></i> HISTORIAL</button>";	
					
			$botones = "<div class='btn-group'>".$btnEditarPaciente.$btnDetallePaciente."</div>";

			$subdata = array();
	    $subdata[] = $i+1;
	    $subdata[] = $botones;
	    $subdata[] = $pacientes[$i]["nombre_paciente"];
	    $subdata[] = $pacientes[$i]["paterno_paciente"]; 
	    $subdata[] = $pacientes[$i]["materno_paciente"]; 
	    $subdata[] = $pacientes[$i]["documento_ci"];  
	    $subdata[] = $pacientes[$i]["cod_asegurado"]; 
	    $subdata[] = $pacientes[$i]["cod_beneficiario"]; 
	    $subdata[] = $fecha_nacimiento;
	    $subdata[] = $edad->y.' años '.$edad->m.' meses'; 
	    $subdata[] = $pacientes[$i]["estado_civil"]; 
	    $subdata[] = $pacientes[$i]["sexo"];
	    $subdata[] = $pacientes[$i]["domicilio"];
	    $subdata[] = $pacientes[$i]["telefono"];
	    $subdata[] = $pacientes[$i]["nro_empleador"];
	    $subdata[] = $pacientes[$i]["nombre_empleador"];
	    $subdata[] = $pacientes[$i]["nombre_consultorio"];
	    $subdata[] = $pacientes[$i]["estado_asegurado"];

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
ACTIVAR TABLA PACIENTES
=============================================*/

$activarPacientes = new TablaPacientes();
$activarPacientes -> request = $_REQUEST;
$activarPacientes -> mostrarTablaPacientes();

