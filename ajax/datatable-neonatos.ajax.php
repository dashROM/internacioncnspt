<?php

require_once "../controllers/neonatos.controller.php";
require_once "../models/neonatos.model.php";

class TablaNeonatos {

	public $request;

	/*=============================================
	MOSTRAR LA TABLA DE NEONATOS
	=============================================*/
	public function mostrarTablaNeonatos() {

		$request = $this->request;

		$col = array(
	    0   =>  'id',
	    1   =>  'fecha_ingreso',
	    2   =>  'hora_ingreso',
	    3   =>  'nombre_completo',
	    4   =>  'nombre_cama',
	    5   =>  'sexo',
	    6   =>  'peso_neonato',
	    7   =>  'talla_neonato',
	    8   =>  'pc_neonato',
	    9   =>  'pt_neonato',
	    10   =>  'apgar_ini',
	    11   =>  'edad_gestacional_neonato',
	    12   =>  'cod_asegurado',
	    13   =>  'nro_empleador',
	    14   =>  'tipo_parto_neonato',
	    15   =>  'diagnostico_especifico1',
	    16   =>  'diagnostico_egreso1',
	    17   =>  'nombre_consultorio',
	    18   =>  'fecha_egreso',
	    19   =>  'hora_egreso',
	    20   =>  'causa_egreso',
	    21   =>  'descripcion_parto',

		);  //create column like table in database


		$totalData = ControllerNeonatos::ctrContarNeonatos();

		$totalFilter = $totalData;

		//Search
		$sql = "";

		if(!empty($request['search']['value'])) {

		    $sql .= " AND (fecha_ingreso Like '".$request['search']['value']."%' ";
		    $sql .= " OR hora_ingreso Like '".$request['search']['value']."%' ";
		    $sql .= " OR nombre_completo Like '".$request['search']['value']."%' ";
		    $sql .= " OR nombre_cama Like '".$request['search']['value']."%' )";
		    $sql .= " OR sexo Like '".$request['search']['value']."%' )";
		    $sql .= " OR peso_neonato Like '".$request['search']['value']."%' )";
		    $sql .= " OR talla_neonato Like '".$request['search']['value']."%' )";
		    $sql .= " OR pc_neonato Like '".$request['search']['value']."%' )";
		    $sql .= " OR pt_neonato Like '".$request['search']['value']."%' )";
		    $sql .= " OR apgar_ini Like '".$request['search']['value']."%' )";
		    $sql .= " OR edad_gestacional_neonato Like '".$request['search']['value']."%' )";
		    $sql .= " OR cod_asegurado Like '".$request['search']['value']."%' )";
		    $sql .= " OR nro_empleador Like '".$request['search']['value']."%' )";
		    $sql .= " OR tipo_parto_neonato Like '".$request['search']['value']."%' )";  		    
		    $sql .= " OR diagnostico_especifico1 Like '".$request['search']['value']."%' )";
		    $sql .= " OR diagnostico_egreso1 Like '".$request['search']['value']."%' )";
		    $sql .= " OR nombre_consultorio Like '".$request['search']['value']."%' )";
		    $sql .= " OR fecha_egreso Like '".$request['search']['value']."%' )";
		    $sql .= " OR hora_egreso Like '".$request['search']['value']."%' )";
		    $sql .= " OR causa_egreso Like '".$request['search']['value']."%' )";
		    $sql .= " OR descripcion_parto Like '".$request['search']['value']."%' )";
		
		}

		$totalFilter = ControllerNeonatos::ctrContarFiltradoNeonatos($sql);

		$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
   	$request['length']."  OFFSET ".$request['start']."  ";

  	$neonatos = ControllerNeonatos::ctrMostrarNeonatos($sql);
  	
		$data = array();

		for ($i = 0; $i < count($neonatos); $i++) {

			/*=============================================
			TRAEMOS LAS ACCIONES
			=============================================*/					
			$btnEditarNeonatos = "<button class='btn btn-warning btnEditarNeonatos' idneonatos='".$neonatos[$i]["id"]."' data-bs-toggle='modal' data-bs-target='#ModaleditarNeonatos'><i class='fas fa-pencil-alt'></i></button>";
			$btnDetalleNeonatos = "<button class='btn btn-primary btnDetalleIngreso' idneonatos='".$neonatos[$i]["id"]."' data-bs-toggle='modal' data-bs-target='#ModalnuevaAltas'><i class='fas fa-file-invoice'></i></button>";	
		
			$botones = "<div class='btn-group'>".$btnEditarNeonatos.$btnDetalleNeonatos."</div>";

			$subdata = array();
	    $subdata[] = $i+1;
	    $subdata[] = date("d/m/Y", strtotime($neonatos[$i]["fecha_ingreso"])); 
	    $subdata[] = $neonatos[$i]["hora_ingreso"]; 
	    $subdata[] = $neonatos[$i]["nombre_completo"]; 
	    $subdata[] = $neonatos[$i]["nombre_cama"];   
	    $subdata[] = $neonatos[$i]["sexo"]; 
	    $subdata[] = $neonatos[$i]["peso_neonato"];
	    $subdata[] = $neonatos[$i]["talla_neonato"];
	    $subdata[] = $neonatos[$i]["pc_neonato"];
	    $subdata[] = $neonatos[$i]["pt_neonato"];
	    $subdata[] = $neonatos[$i]["apgar_ini"].' - '.$neonatos[$i]["apgar_fin"];
	    $subdata[] = number_format($neonatos[$i]["edad_gestacional_neonato"],2,",","");
	    $subdata[] = $neonatos[$i]["cod_asegurado"];
	    $subdata[] = $neonatos[$i]["nro_empleador"];
	    $subdata[] = $neonatos[$i]["tipo_parto_neonato"];
	    $subdata[] = $neonatos[$i]["diagnostico_especifico1"].' - '.$neonatos[$i]["diagnostico_especifico2"].' - '.$neonatos[$i]["diagnostico_especifico3"];
	    $subdata[] = $neonatos[$i]["diagnostico_egreso1"].' - '.$neonatos[$i]["diagnostico_egreso2"].' - '.$neonatos[$i]["diagnostico_egreso3"];
	    $subdata[] = $neonatos[$i]["nombre_consultorio"];
	    $subdata[] = $neonatos[$i]["fecha_egreso"];
	    $subdata[] = $neonatos[$i]["hora_egreso"];
	    $subdata[] = $neonatos[$i]["causa_egreso"];
	    $subdata[] = $neonatos[$i]["descripcion_parto"];
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
	MOSTRAR LA TABLA DE NEONATOS (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	public function mostrarTablaNeonatosFecha() {

		$request = $this->request;

		$item1 = "fecha_ini";;
		$valor1 = $this->fecha_ini;

		$item2 = "fecha_fin";
		$valor2 = $this->fecha_fin;

		$col = array(
	    0   =>  'id',
	    1   =>  'fecha_ingreso',
	    2   =>  'hora_ingreso',
	    3   =>  'nombre_completo',
	    4   =>  'nombre_cama',
	    5   =>  'sexo',
	    6   =>  'peso_neonato',
	    7   =>  'talla_neonato',
	    8   =>  'pc_neonato',
	    9   =>  'pt_neonato',
	    10   =>  'apgar_ini',
	    11   =>  'edad_gestacional_neonato',
	    12   =>  'cod_asegurado',
	    13   =>  'nro_empleador',
	    14   =>  'tipo_parto_neonato',
	    15   =>  'diagnostico_especifico1',
	    16   =>  'diagnostico_egreso1',
	    17   =>  'nombre_consultorio',
	    18   =>  'fecha_egreso',
	    19   =>  'hora_egreso',
	    20   =>  'causa_egreso',
	    21   =>  'descripcion_parto',

		);  //create column like table in database

		$totalData = ControllerNeonatos::ctrContarNeonatosFecha($item1, $valor1, $item2, $valor2);

		$totalFilter = $totalData;

		//Search
		$sql = "";

		if(!empty($request['search']['value'])) {

		    $sql .= " AND (fecha_ingreso Like '".$request['search']['value']."%' ";
		    $sql .= " OR hora_ingreso Like '".$request['search']['value']."%' ";
		    $sql .= " OR nombre_completo Like '".$request['search']['value']."%' ";
		    $sql .= " OR nombre_cama Like '".$request['search']['value']."%' )";
		    $sql .= " OR sexo Like '".$request['search']['value']."%' )";
		    $sql .= " OR peso_neonato Like '".$request['search']['value']."%' )";
		    $sql .= " OR talla_neonato Like '".$request['search']['value']."%' )";
		    $sql .= " OR pc_neonato Like '".$request['search']['value']."%' )";
		    $sql .= " OR pt_neonato Like '".$request['search']['value']."%' )";
		    $sql .= " OR apgar_ini Like '".$request['search']['value']."%' )";
		    $sql .= " OR edad_gestacional_neonato Like '".$request['search']['value']."%' )";
		    $sql .= " OR cod_asegurado Like '".$request['search']['value']."%' )";
		    $sql .= " OR nro_empleador Like '".$request['search']['value']."%' )";
		    $sql .= " OR tipo_parto_neonato Like '".$request['search']['value']."%' )";  		    
		    $sql .= " OR diagnostico_especifico1 Like '".$request['search']['value']."%' )";
		    $sql .= " OR diagnostico_egreso1 Like '".$request['search']['value']."%' )";
		    $sql .= " OR nombre_consultorio Like '".$request['search']['value']."%' )";
		    $sql .= " OR fecha_egreso Like '".$request['search']['value']."%' )";
		    $sql .= " OR hora_egreso Like '".$request['search']['value']."%' )";
		    $sql .= " OR causa_egreso Like '".$request['search']['value']."%' )";
		    $sql .= " OR descripcion_parto Like '".$request['search']['value']."%' )";
		
		}

		$totalFilter = ControllerNeonatos::ctrContarFiltradoNeonatosFecha($item1, $valor1, $item2, $valor2, $sql);

		$sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
   	$request['length']."  OFFSET ".$request['start']."  ";

  	$neonatos = ControllerNeonatos::ctrMostrarNeonatosFecha($item1, $valor1, $item2, $valor2, $sql);
  	
		$data = array();

		for ($i = 0; $i < count($neonatos); $i++) {

			/*=============================================
			TRAEMOS LAS ACCIONES
			=============================================*/					
			$btnEditarNeonatos = "<button class='btn btn-warning btnEditarNeonatos' idneonatos='".$neonatos[$i]["id"]."' data-bs-toggle='modal' data-bs-target='#ModaleditarNeonatos'><i class='fas fa-pencil-alt'></i></button>";
			$btnDetalleNeonatos = "<button class='btn btn-primary btnDetalleIngreso' idneonatos='".$neonatos[$i]["id"]."' data-bs-toggle='modal' data-bs-target='#ModalnuevaAltas'><i class='fas fa-file-invoice'></i></button>";	
		
			$botones = "<div class='btn-group'>".$btnEditarNeonatos.$btnDetalleNeonatos."</div>";

			$subdata = array();
	    $subdata[] = $i+1;
	    $subdata[] = date("d/m/Y", strtotime($neonatos[$i]["fecha_ingreso"])); 
	    $subdata[] = $neonatos[$i]["hora_ingreso"]; 
	    $subdata[] = $neonatos[$i]["nombre_completo"]; 
	    $subdata[] = $neonatos[$i]["nombre_cama"];   
	    $subdata[] = $neonatos[$i]["sexo"]; 
	    $subdata[] = $neonatos[$i]["peso_neonato"];
	    $subdata[] = $neonatos[$i]["talla_neonato"];
	    $subdata[] = $neonatos[$i]["pc_neonato"];
	    $subdata[] = $neonatos[$i]["pt_neonato"];
	    $subdata[] = $neonatos[$i]["apgar_ini"].' - '.$neonatos[$i]["apgar_fin"];
	    $subdata[] = number_format($neonatos[$i]["edad_gestacional_neonato"],2,",","");
	    $subdata[] = $neonatos[$i]["cod_asegurado"];
	    $subdata[] = $neonatos[$i]["nro_empleador"];
	    $subdata[] = $neonatos[$i]["tipo_parto_neonato"];
	    $subdata[] = $neonatos[$i]["diagnostico_especifico1"].' - '.$neonatos[$i]["diagnostico_especifico2"].' - '.$neonatos[$i]["diagnostico_especifico3"];
	    $subdata[] = $neonatos[$i]["diagnostico_egreso1"].' - '.$neonatos[$i]["diagnostico_egreso2"].' - '.$neonatos[$i]["diagnostico_egreso3"];
	    $subdata[] = $neonatos[$i]["nombre_consultorio"];
	    $subdata[] = $neonatos[$i]["fecha_egreso"];
	    $subdata[] = $neonatos[$i]["hora_egreso"];
	    $subdata[] = $neonatos[$i]["causa_egreso"];
	    $subdata[] = $neonatos[$i]["descripcion_parto"];
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
ACTIVAR TABLA NEONATOS
=============================================*/
if (isset($_POST["neonatos"])) {

	$activarNeonatos = new TablaNeonatos();
	$activarNeonatos -> request = $_REQUEST;
	$activarNeonatos -> mostrarTablaNeonatos();

}

if (isset($_POST["BuscarFechaNeonatos"])) {
	$activarNeonatos = new TablaNeonatos();
	$activarNeonatos -> request = $_REQUEST;
	$activarNeonatos -> fecha_ini = $_POST["fechaIni"];
	$activarNeonatos -> fecha_fin = $_POST["fechaFin"];
	$activarNeonatos -> mostrarTablaNeonatosFecha();
}
