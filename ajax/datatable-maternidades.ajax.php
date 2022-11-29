<?php

require_once "../controllers/maternidades.controller.php";
require_once "../models/maternidades.model.php";

class TablaMaternidades {

	public $request;

	/*=============================================
	MOSTRAR LA TABLA DE MATERNIDAD
	=============================================*/
	public function mostrarTablaMaternidades() {

		$request = $this->request;

		$col = array(
	    0   =>  'id',
	    1   =>  'fecha_ingreso',
	    2   =>  'nombre_consultorio',
	    3   =>  'hora_ingreso',
	    4   =>  'nombre_completo',
	    5   =>  'fecha_nacimiento',
	    6   =>  'cod_asegurado',
	    7   =>  'nro_empleador',
	    8   =>  'nombre_empleador',
	    9   =>  'estado_civil',
	    10   =>  'procedencia',
	    11   =>  'paridad',
	    12   =>  'edad_gestacional_fum',
	    13   =>  'tipo_parto',
	    14   =>  'liquido_amniotico',
	    15   =>  'fecha_nacido',
	    16   =>  'peso_nacido',
	    17   =>  'hora_nacido',
	    18   =>  'sexo_nacido',
	    19   =>  'alumbramiento',
	    20   =>  'perine',
	    21   =>  'sangrado',
	    22   =>  'estado_madre',
	    23   =>  'nombre_esposo',
	    24   =>  'nombre_sala',
	    25   =>  'nombre_cama',
	    26   =>  'causa_egreso',

		);  //create column like table in database

		$totalData = ControllerMaternidades::ctrContarMaternidades();

		$totalFilter = $totalData;

		//Search
		$sql = "";

		if(!empty($request['search']['value'])) {

	    $sql .= " AND (nombre_consultorio ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR paterno_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR materno_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR cod_asegurado ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nro_empleador ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_empleador ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR estado_civil ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR procedencia ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR tipo_parto ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR liquido_amniotico ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR sexo_nacido ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR alumbramiento ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR perine ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR sangrado ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR estado_madre ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_esposo ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_sala ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_cama ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR causa_egreso ILike '%".$request['search']['value']."%' )";
	    
		}

		$totalFilter = ControllerMaternidades::ctrContarFiltradoMaternidades($sql);

		$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
   	$request['length']."  OFFSET ".$request['start']."  ";

  	$maternidad = ControllerMaternidades::ctrMostrarMaternidades($sql);
  	
		$data = array();

		for ($i = 0; $i < count($maternidad); $i++) {

			/*=============================================
			OBTENEMOS LA EDAD A PARTIR DE LA FECHA DE NACIMIENTO
			=============================================*/	
			$fecha_nacimiento = new DateTime($maternidad[$i]["fecha_nacimiento"]);
			$hoy = new DateTime();
			$edad = $hoy->diff($fecha_nacimiento);

			/*=============================================
			TRAEMOS LAS ACCIONES
			=============================================*/					
			$btnEditarMaternidad = "<button class='btn btn-warning btnEditarMaternidad' idMaternidad='".$maternidad[$i]["id"]."' data-bs-toggle='modal' data-bs-target='#ModaleditarMaternidad'><i class='fas fa-pencil-alt'></i></button>";
			$btnDetalleMaternidad = "<button class='btn btn-primary btnDetalleIngreso' idMaternidad='".$maternidad[$i]["id"]."' data-bs-toggle='modal' data-bs-target='#ModalnuevaAltas'><i class='fas fa-file-invoice'></i></button>";

			$botones = "<div class='btn-group'>".$btnEditarMaternidad.$btnDetalleMaternidad."</div>";	

			$subdata = array();
	    $subdata[] = $i+1;
	    $subdata[] = date("d/m/Y", strtotime($maternidad[$i]["fecha_ingreso"])); 
	    $subdata[] = $maternidad[$i]["nombre_consultorio"]; 
	    $subdata[] = $maternidad[$i]["hora_ingreso"];   
	    $subdata[] = $maternidad[$i]["nombre_completo"]; 
	    $subdata[] = $edad->y.' años '.$edad->m.' meses';
	    $subdata[] = $maternidad[$i]["cod_asegurado"];
	    $subdata[] = $maternidad[$i]["nro_empleador"];
	    $subdata[] = $maternidad[$i]["nombre_empleador"];
	    $subdata[] = $maternidad[$i]["estado_civil"];
	    $subdata[] = $maternidad[$i]["procedencia"];
	    $subdata[] = $maternidad[$i]["paridad"];
	    $subdata[] = 'FUM = '.number_format($maternidad[$i]["edad_gestacional_fum"],2,",","").'   ECOGRAGIA = '.number_format($maternidad[$i]["edad_gestacional_ecografia"],2,",","");
	    $subdata[] = $maternidad[$i]["tipo_parto"];
	    $subdata[] = $maternidad[$i]["liquido_amniotico"];
	    $subdata[] = date("d/m/Y", strtotime($maternidad[$i]["fecha_nacido"]));
	    $subdata[] = number_format($maternidad[$i]["peso_nacido"],3,",","");
	    $subdata[] = $maternidad[$i]["hora_nacido"];
	    $subdata[] = $maternidad[$i]["sexo_nacido"];
	    $subdata[] = $maternidad[$i]["alumbramiento"];
	    $subdata[] = $maternidad[$i]["perine"];
	    $subdata[] = $maternidad[$i]["sangrado"];
	    $subdata[] = $maternidad[$i]["estado_madre"];
	    $subdata[] = $maternidad[$i]["nombre_esposo"];
	    $subdata[] = $maternidad[$i]["nombre_sala"];
	    $subdata[] = $maternidad[$i]["nombre_cama"];
	    $subdata[] = $maternidad[$i]["causa_egreso"];
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
	MOSTRAR LA TABLA DE MATERNIDADES (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	public function mostrarTablaMaternidadesFecha() {

		$request = $this->request;

		$item1 = "fecha_ini";;
		$valor1 = $this->fecha_ini;

		$item2 = "fecha_fin";
		$valor2 = $this->fecha_fin;

		$col = array(
	    0   =>  'id',
	    1   =>  'fecha_ingreso',
	    2   =>  'nombre_consultorio',
	    3   =>  'hora_ingreso',
	    4   =>  'nombre_completo',
	    5   =>  'fecha_nacimiento',
	    6   =>  'cod_asegurado',
	    7   =>  'nro_empleador',
	    8   =>  'nombre_empleador',
	    9   =>  'estado_civil',
	    10   =>  'procedencia',
	    11   =>  'paridad',
	    12   =>  'edad_gestacional_fum',
	    13   =>  'tipo_parto',
	    14   =>  'liquido_amniotico',
	    15   =>  'fecha_nacido',
	    16   =>  'peso_nacido',
	    17   =>  'hora_nacido',
	    18   =>  'sexo_nacido',
	    19   =>  'alumbramiento',
	    20   =>  'perine',
	    21   =>  'sangrado',
	    22   =>  'estado_madre',
	    23   =>  'nombre_esposo',
	    24   =>  'nombre_sala',
	    25   =>  'nombre_cama',
	    26   =>  'causa_egreso',

		);  //create column like table in database

		$totalData = ControllerMaternidades::ctrContarMaternidadesFecha($item1, $valor1, $item2, $valor2);

		$totalFilter = $totalData;

		//Search
		$sql = "";

		if(!empty($request['search']['value'])) {

	    $sql .= " AND (nombre_consultorio ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR paterno_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR materno_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR cod_asegurado ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nro_empleador ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_empleador ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR estado_civil ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR procedencia ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR tipo_parto ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR liquido_amniotico ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR sexo_nacido ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR alumbramiento ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR perine ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR sangrado ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR estado_madre ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_esposo ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_sala ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_cama ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR causa_egreso ILike '%".$request['search']['value']."%' )";

		}

		$totalFilter = ControllerMaternidades::ctrContarFiltradoMaternidadesFecha($item1, $valor1, $item2, $valor2, $sql);

		$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
   	$request['length']."  OFFSET ".$request['start']."  ";

  	$maternidad = ControllerMaternidades::ctrMostrarMaternidadesFecha($item1, $valor1, $item2, $valor2, $sql);
  	
		$data = array();

		for ($i = 0; $i < count($maternidad); $i++) {

			/*=============================================
			OBTENEMOS LA EDAD A PARTIR DE LA FECHA DE NACIMIENTO
			=============================================*/	
			$fecha_nacimiento = new DateTime($maternidad[$i]["fecha_nacimiento"]);
			$hoy = new DateTime();
			$edad = $hoy->diff($fecha_nacimiento);

			/*=============================================
			TRAEMOS LAS ACCIONES
			=============================================*/					
			$btnEditarMaternidad = "<button class='btn btn-warning btnEditarMaternidad' idMaternidad='".$maternidad[$i]["id"]."' data-bs-toggle='modal' data-bs-target='#ModaleditarMaternidad'><i class='fas fa-pencil-alt'></i></button>";
			$btnDetalleMaternidad = "<button class='btn btn-primary btnDetalleIngreso' idMaternidad='".$maternidad[$i]["id"]."' data-bs-toggle='modal' data-bs-target='#ModalnuevaAltas'><i class='fas fa-file-invoice'></i></button>";

			$botones = "<div class='btn-group'>".$btnEditarMaternidad.$btnDetalleMaternidad."</div>";	

			$subdata = array();
	    $subdata[] = $i+1;
	    $subdata[] = date("d/m/Y", strtotime($maternidad[$i]["fecha_ingreso"])); 
	    $subdata[] = $maternidad[$i]["nombre_consultorio"]; 
	    $subdata[] = $maternidad[$i]["hora_ingreso"];   
	    $subdata[] = $maternidad[$i]["nombre_completo"]; 
	    $subdata[] = $edad->y.' años '.$edad->m.' meses';
	    $subdata[] = $maternidad[$i]["cod_asegurado"];
	    $subdata[] = $maternidad[$i]["nro_empleador"];
	    $subdata[] = $maternidad[$i]["nombre_empleador"];
	    $subdata[] = $maternidad[$i]["estado_civil"];
	    $subdata[] = $maternidad[$i]["procedencia"];
	    $subdata[] = $maternidad[$i]["paridad"];
	    $subdata[] = 'FUM = '.number_format($maternidad[$i]["edad_gestacional_fum"],2,",","").'   ECOGRAGIA = '.number_format($maternidad[$i]["edad_gestacional_ecografia"],2,",","");
	    $subdata[] = $maternidad[$i]["tipo_parto"];
	    $subdata[] = $maternidad[$i]["liquido_amniotico"];
	    $subdata[] = date("d/m/Y", strtotime($maternidad[$i]["fecha_nacido"]));
	    $subdata[] = number_format($maternidad[$i]["peso_nacido"],3,",","");
	    $subdata[] = $maternidad[$i]["hora_nacido"];
	    $subdata[] = $maternidad[$i]["sexo_nacido"];
	    $subdata[] = $maternidad[$i]["alumbramiento"];
	    $subdata[] = $maternidad[$i]["perine"];
	    $subdata[] = $maternidad[$i]["sangrado"];
	    $subdata[] = $maternidad[$i]["estado_madre"];
	    $subdata[] = $maternidad[$i]["nombre_esposo"];
	    $subdata[] = $maternidad[$i]["nombre_sala"];
	    $subdata[] = $maternidad[$i]["nombre_cama"];
	    $subdata[] = $maternidad[$i]["causa_egreso"];
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
ACTIVAR TABLA MATERNIDADES
=============================================*/
if (isset($_POST["maternidades"])) {
	$activarMaternidad = new TablaMaternidades();
	$activarMaternidad -> request = $_REQUEST;
	$activarMaternidad -> mostrarTablaMaternidades();
}
if (isset($_POST["BuscarFechaMaternidades"])) {
	$activarMaternidad = new TablaMaternidades();
	$activarMaternidad -> request = $_REQUEST;
	$activarMaternidad -> fecha_ini = $_POST["fechaIni"];
	$activarMaternidad -> fecha_fin = $_POST["fechaFin"];
	$activarMaternidad -> mostrarTablaMaternidadesFecha();
}