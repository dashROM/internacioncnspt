<?php

require_once "../controllers/paciente_internados.controller.php";
require_once "../models/paciente_internados.model.php";

class TablaPacienteInternados {

	public $request;

	public $fecha_ini;
	public $fecha_fin;

	/*=============================================
	MOSTRAR LA TABLA DE PACIENTES INTERNADOS
	=============================================*/
	public function mostrarTablaPacientesInternados() {

		$request = $this->request;

		$col = array(
	    0   =>  'id',
	    1   =>  'id',
	    2   =>  'abrev_establecimiento',
	    3   =>  'fecha_ingreso',
	    4   =>  'hora_ingreso',
	    5   =>  'nombre_completo',
	    6   =>  'fecha_nacimiento',
	    7   =>  'fecha_nacimiento',
	    8   =>  'cod_asegurado',
	    9   =>  'nro_empleador',
	    10   =>  'nombre_empleador',
	    11   =>  'diagnostico',
	    12   =>  'nombre_servicio',
	    13   =>  'nombre_sala',
	    14   =>  'nombre_cama',
	    15   =>  'id',

		);  //create column like table in database

		$totalData = ControllerPacienteInternados::ctrContarPacientesInternados();

		$totalFilter = $totalData;

		//Search
		$sql = "";

		if(!empty($request['search']['value'])) {

	    $sql .= " AND (abrev_establecimiento ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR paterno_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR materno_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR cod_asegurado ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nro_empleador ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_empleador ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR codigo ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR descripcion ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_servicio ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_sala ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_cama ILike '%".$request['search']['value']."%' )";
		}

		$totalFilter = ControllerPacienteInternados::ctrContarFiltradoPacientesInternados($sql);

		$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
   	$request['length']."  OFFSET ".$request['start']."  ";

  	$paciente_internados = ControllerPacienteInternados::ctrMostrarPacientesInternados($sql);
  	
		$data = array();

		for ($i = 0; $i < count($paciente_internados); $i++) {

			/*=============================================
			OBTENEMOS LA EDAD A PARTIR DE LA FECHA DE NACIMIENTO
			=============================================*/	
			$fecha_nacimiento = new DateTime($paciente_internados[$i]["fecha_nacimiento"]);
			$hoy = new DateTime();
			$edad = $hoy->diff($fecha_nacimiento);

			/*=============================================
			TRAEMOS LAS ACCIONES
			=============================================*/					
			$btnEditarIngreso = "<button class='btn btn-outline-primary btn-sm btnEditarPacienteIngreso' idPacienteIngreso='".$paciente_internados[$i]["id"]."' data-bs-toggle='modal' data-bs-target='#modalEditarPacienteIngreso' data-toggle='tooltip' title='Editar Ingreso'><i class='fas fa-pencil-alt'></i></button>";

			$btnTransferencia = "<button class='btn btn-outline-primary btn-sm btnNuevaTransferencia' idPacienteIngreso='".$paciente_internados[$i]["id"]."' fechaIngreso='".$paciente_internados[$i]["fecha_ingreso"]."' idServicio='".$paciente_internados[$i]["id_servicio"]."' idSala='".$paciente_internados[$i]["id_sala"]."' idCama='".$paciente_internados[$i]["id_cama"]."' data-bs-toggle='modal' data-bs-target='#modalNuevaTransferencia' data-toggle='tooltip' title='Registrar Transferencia'><i class='fas fa-exchange-alt'></i></button>";

			$btnReporteForm204 = "<button class='btn btn-outline-primary btn-sm btnReporteForm204' idPaciente='".$paciente_internados[$i]["id_paciente"]."' idPacienteIngreso='".$paciente_internados[$i]["id"]."' modulo='paciente-ingresos' data-toggle='tooltip' title='Reportes Paciente'><i class='fas fa-print'></i></button>";

			$estado = "<button class='btn btn-danger btn-sm btnDarAltaPaciente' idPacienteIngreso='".$paciente_internados[$i]["id"]."' fecha_ingreso='".$paciente_internados[$i]["fecha_ingreso"]."' estado_paciente='0' idCama='".$paciente_internados[$i]["id_cama"]."' modulo='paciente-ingresos' data-bs-toggle='modal' data-bs-target='#modalDarAltaPaciente' data-toggle='tooltip' title='Registrar Alta Paciente'>INTERNADO</button>";

			$botones = "<div class='btn-group'>".$btnReporteForm204."</div>";	

			$subdata = array();
	    $subdata[] = $i+1;
	    $subdata[] = $botones;
	    $subdata[] = $paciente_internados[$i]["abrev_establecimiento"];
	    $subdata[] = date("d/m/Y", strtotime($paciente_internados[$i]["fecha_ingreso"])); 
	    $subdata[] = $paciente_internados[$i]["hora_ingreso"]; 
	    $subdata[] = $paciente_internados[$i]["nombre_completo"];  
	    $subdata[] = date("d/m/Y", strtotime($paciente_internados[$i]["fecha_nacimiento"]));
	    $subdata[] = $edad->y.' años '.$edad->m.' meses'; 
	    $subdata[] = $paciente_internados[$i]["cod_asegurado"]; 
	    $subdata[] = $paciente_internados[$i]["nro_empleador"];
	    $subdata[] = $paciente_internados[$i]["nombre_empleador"];
	    $subdata[] = $paciente_internados[$i]["diagnostico"];
	    $subdata[] = $paciente_internados[$i]["nombre_servicio"].' - '.$paciente_internados[$i]["nombre_especialidad"];
	    $subdata[] = $paciente_internados[$i]["nombre_sala"];
	    $subdata[] = $paciente_internados[$i]["nombre_cama"];
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
	MOSTRAR LA TABLA DE PACIENTES INTERNADOS
	=============================================*/
	public function mostrarTablaPacientesInternadosFecha() {

		$request = $this->request;

		$item1 = "fecha_ini";;
		$valor1 = $this->fecha_ini;

		$item2 = "fecha_fin";
		$valor2 = $this->fecha_fin;

		$col = array(
	    0   =>  'id',
	    1   =>  'id',
	    2   =>  'abrev_establecimiento',
	    3   =>  'fecha_ingreso',
	    4   =>  'hora_ingreso',
	    5   =>  'nombre_completo',
	    6   =>  'fecha_nacimiento',
	    7   =>  'fecha_nacimiento',
	    8   =>  'cod_asegurado',
	    9   =>  'nro_empleador',
	    10   =>  'nombre_empleador',
	    11   =>  'diagnostico',
	    12   =>  'nombre_servicio',
	    13   =>  'nombre_sala',
	    14   =>  'nombre_cama',
	    15   =>  'id',

		);  //create column like table in database

		$totalData = ControllerPacienteInternados::ctrContarPacientesInternadosFecha($item1, $valor1, $item2, $valor2);

		$totalFilter = $totalData;

		//Search
		$sql = "";

		if(!empty($request['search']['value'])) {

		  $sql .= " AND (abrev_establecimiento ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR paterno_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR materno_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR cod_asegurado ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nro_empleador ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_empleador ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR codigo ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR descripcion ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_servicio ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_sala ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_cama ILike '%".$request['search']['value']."%' )";
		}

		$totalFilter = ControllerPacienteInternados::ctrContarFiltradoPacientesInternadosFecha($item1, $valor1, $item2, $valor2, $sql);

		$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
   	$request['length']."  OFFSET ".$request['start']."  ";

		$paciente_internados = ControllerPacienteInternados::ctrMostrarPacientesInternadosFecha($item1, $valor1, $item2, $valor2, $sql);

		$data = array();

		for ($i = 0; $i < count($paciente_internados); $i++) {

			/*=============================================
			OBTENEMOS LA EDAD A PARTIR DE LA FECHA DE NACIMIENTO
			=============================================*/	
			$fecha_nacimiento = new DateTime($paciente_internados[$i]["fecha_nacimiento"]);
			$hoy = new DateTime();
			$edad = $hoy->diff($fecha_nacimiento);

			/*=============================================
			TRAEMOS LAS ACCIONES
			=============================================*/					
			$btnEditarIngreso = "<button class='btn btn-outline-primary btn-sm btnEditarPacienteIngreso' idPacienteIngreso='".$paciente_internados[$i]["id"]."' data-bs-toggle='modal' data-bs-target='#modalEditarPacienteIngreso' data-toggle='tooltip' title='Editar Ingreso'><i class='fas fa-pencil-alt'></i></button>";

			$btnTransferencia = "<button class='btn btn-outline-primary btn-sm btnNuevaTransferencia' idPacienteIngreso='".$paciente_internados[$i]["id"]."' fechaIngreso='".$paciente_internados[$i]["fecha_ingreso"]."' idServicio='".$paciente_internados[$i]["id_servicio"]."' idSala='".$paciente_internados[$i]["id_sala"]."' idCama='".$paciente_internados[$i]["id_cama"]."' data-bs-toggle='modal' data-bs-target='#modalNuevaTransferencia' data-toggle='tooltip' title='Registrar Transferencia'><i class='fas fa-exchange-alt'></i></button>";

			$btnReporteForm204 = "<button class='btn btn-outline-primary btn-sm btnReporteForm204' idPaciente='".$paciente_internados[$i]["id_paciente"]."' idPacienteIngreso='".$paciente_internados[$i]["id"]."' modulo='paciente-ingresos' data-toggle='tooltip' title='Reportes Paciente'><i class='fas fa-print'></i></button>";

			$estado = "<button class='btn btn-danger btn-sm btnDarAltaPaciente' idPacienteIngreso='".$paciente_internados[$i]["id"]."' fecha_ingreso='".$paciente_internados[$i]["fecha_ingreso"]."' estado_paciente='0' idCama='".$paciente_internados[$i]["id_cama"]."' modulo='paciente-ingresos' data-bs-toggle='modal' data-bs-target='#modalDarAltaPaciente' data-toggle='tooltip' title='Registrar Alta Paciente'>INTERNADO</button>";

			$botones = "<div class='btn-group'>".$btnReporteForm204."</div>";	

			$subdata = array();
	    $subdata[] = $i+1;
	    $subdata[] = $botones;
	    $subdata[] = $paciente_internados[$i]["abrev_establecimiento"];
	    $subdata[] = date("d/m/Y", strtotime($paciente_internados[$i]["fecha_ingreso"])); 
	    $subdata[] = $paciente_internados[$i]["hora_ingreso"]; 
	    $subdata[] = $paciente_internados[$i]["nombre_completo"];  
	    $subdata[] = date("d/m/Y", strtotime($paciente_internados[$i]["fecha_nacimiento"]));
	    $subdata[] = $edad->y.' años '.$edad->m.' meses'; 
	    $subdata[] = $paciente_internados[$i]["cod_asegurado"]; 
	    $subdata[] = $paciente_internados[$i]["nro_empleador"];
	    $subdata[] = $paciente_internados[$i]["nombre_empleador"];
	    $subdata[] = $paciente_internados[$i]["diagnostico"];
	    $subdata[] = $paciente_internados[$i]["nombre_servicio"].' - '.$paciente_internados[$i]["nombre_especialidad"];
	    $subdata[] = $paciente_internados[$i]["nombre_sala"];
	    $subdata[] = $paciente_internados[$i]["nombre_cama"];
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


if (isset($_POST["pacientesInternados"])) {

	$activarPacienteInternados = new TablaPacienteInternados();
	$activarPacienteInternados -> request = $_REQUEST;
	$activarPacienteInternados -> mostrarTablaPacientesInternados();

}

if (isset($_POST["BuscarFechaInternados"])) {
	$activarPacienteInternados = new TablaPacienteInternados();
	$activarPacienteInternados -> request = $_REQUEST;
	$activarPacienteInternados -> fecha_ini = $_POST["fechaIni"];
	$activarPacienteInternados -> fecha_fin = $_POST["fechaFin"];
	$activarPacienteInternados -> mostrarTablaPacientesInternadosFecha();
}