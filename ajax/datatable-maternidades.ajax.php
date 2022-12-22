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

		// $col = array(
	  //   0   =>  'id',
	  //   1   =>  'fecha_ingreso',
	  //   2   =>  'nombre_consultorio',
	  //   3   =>  'hora_ingreso',
	  //   4   =>  'nombre_completo',
	  //   5   =>  'fecha_nacimiento',
	  //   6   =>  'cod_asegurado',
	  //   7   =>  'nro_empleador',
	  //   8   =>  'nombre_empleador',
	  //   9   =>  'estado_civil',
	  //   10   =>  'procedencia',
	  //   11   =>  'paridad',
	  //   12   =>  'edad_gestacional',
	  //   13   =>  'tipo_parto',
	  //   14   =>  'liquido_amniotico',
	  //   15   =>  'fecha_nacido',
	  //   16   =>  'peso_nacido',
	  //   17   =>  'hora_nacido',
	  //   18   =>  'sexo_nacido',
	  //   19   =>  'alumbramiento',
	  //   20   =>  'perine',
	  //   21   =>  'sangrado',
	  //   22   =>  'estado_madre',
	  //   23   =>  'nombre_esposo',
	  //   24   =>  'nombre_sala',
	  //   25   =>  'nombre_cama',
	  //   26   =>  'causa_egreso',

		// );  //create column like table in database

		$totalData = ControllerMaternidades::ctrContarMaternidades();

		$totalFilter = $totalData;

		//Search
		$sql = "";

		if(!empty($request['search']['value'])) {

	    $sql .= " AND (nombre_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR paterno_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR materno_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_cama ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR sexo ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR cod_asegurado ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nro_empleador ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR estado_civil ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR c2.nombre_consultorio ILike '%".$request['search']['value']."%' ";		    
	    $sql .= " OR c3.nombre_consultorio ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_cama ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR c10_ingreso.codigo ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR c10_ingreso.descripcion ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR c10_egreso.codigo ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR c10_egreso.descripcion ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_servicio ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR causa_egreso ILike '%".$request['search']['value']."%' )";
	    
		}

		$totalFilter = ControllerMaternidades::ctrContarFiltradoMaternidades($sql);

		// $sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
		$sql.=" ORDER BY fecha_ingreso LIMIT ".
   	$request['length']."  OFFSET ".$request['start']."  ";

  	$maternidad = ControllerMaternidades::ctrMostrarMaternidades($sql);
  	
		$data = array();
		$nro = 0;

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
			$btnReporteForm204 = "<button class='btn btn-outline-primary btn-sm btnReporteForm204' idPaciente='".$maternidad[$i]["id_paciente"]."' idPacienteIngreso='".$maternidad[$i]["id_paciente_ingreso"]."' modulo='paciente-ingresos' data-toggle='tooltip' title='Reportes Paciente'><i class='fas fa-print'></i> FORM204</button>";

			$botones = "<div class='btn-group'>".$btnReporteForm204."</div>";

			$nro = $i + 1;				
			$subdata = array();
	    $subdata[] = $request['start'] + $nro;
	    $subdata[] = date("d", strtotime($maternidad[$i]["fecha_ingreso"])); 
	    $subdata[] = date("m", strtotime($maternidad[$i]["fecha_ingreso"])); 
	    $subdata[] = date("Y", strtotime($maternidad[$i]["fecha_ingreso"])); 
	    $subdata[] = date("H:i", strtotime($maternidad[$i]["hora_ingreso"])); 
	    $subdata[] = $maternidad[$i]["paterno_paciente"];
	    $subdata[] = $maternidad[$i]["materno_paciente"];
	    $subdata[] = $maternidad[$i]["nombre_paciente"]; 
	    $subdata[] = $maternidad[$i]["procedencia"];
	    $subdata[] = $edad->y;   
	    $subdata[] = $maternidad[$i]["sexo"];
	    $subdata[] = $maternidad[$i]["cod_beneficiario"];
	    $subdata[] = $maternidad[$i]["estado_civil"];
	    $subdata[] = $maternidad[$i]["zona"];
	    $subdata[] = $maternidad[$i]["nombre_cama"]; 
	    $subdata[] = substr($maternidad[$i]["cod_asegurado"], 0, 6);
	    $subdata[] = substr($maternidad[$i]["cod_asegurado"], 6, 8);
	    $subdata[] = $maternidad[$i]["nro_empleador"];
	    $subdata[] = $maternidad[$i]["cie10_cod_ingreso"];
	    $subdata[] = $maternidad[$i]["cie10_diag_ingreso"];
	    $subdata[] = $maternidad[$i]["nombre_servicio"];
	    $subdata[] = $maternidad[$i]["cie10_cod_egreso"];
	    $subdata[] = $maternidad[$i]["cie10_diag_egreso"];
	    $subdata[] = date("d", strtotime($maternidad[$i]["fecha_egreso"])); 
	    $subdata[] = date("m", strtotime($maternidad[$i]["fecha_egreso"])); 
	    $subdata[] = date("Y", strtotime($maternidad[$i]["fecha_egreso"])); 
	    $subdata[] = date("H:i", strtotime($maternidad[$i]["hora_egreso"])); 
	    $subdata[] = $maternidad[$i]["causa_egreso"];
	    $subdata[] = date("d/m/Y", strtotime($maternidad[$i]["fecha_nacido"]));
	    $subdata[] = $maternidad[$i]["peso_nacido1"].' - '.$maternidad[$i]["peso_nacido2"].' - '.$maternidad[$i]["peso_nacido3"];
	    $subdata[] = date("H:i", strtotime($maternidad[$i]["hora_nacido"]));
	    $subdata[] = $maternidad[$i]["sexo_nacido1"].' - '.$maternidad[$i]["sexo_nacido2"].' - '.$maternidad[$i]["sexo_nacido3"];
	    $subdata[] = $maternidad[$i]["tipo_parto"];
	    $subdata[] = $maternidad[$i]["edad_gestacional"];
	    $subdata[] = $botones;

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

		// $col = array(
	  //   0   =>  'id',
	  //   1   =>  'fecha_ingreso',
	  //   2   =>  'nombre_consultorio',
	  //   3   =>  'hora_ingreso',
	  //   4   =>  'nombre_completo',
	  //   5   =>  'fecha_nacimiento',
	  //   6   =>  'cod_asegurado',
	  //   7   =>  'nro_empleador',
	  //   8   =>  'nombre_empleador',
	  //   9   =>  'estado_civil',
	  //   10   =>  'procedencia',
	  //   11   =>  'paridad',
	  //   12   =>  'edad_gestacional',
	  //   13   =>  'tipo_parto',
	  //   14   =>  'liquido_amniotico',
	  //   15   =>  'fecha_nacido',
	  //   16   =>  'peso_nacido',
	  //   17   =>  'hora_nacido',
	  //   18   =>  'sexo_nacido',
	  //   19   =>  'alumbramiento',
	  //   20   =>  'perine',
	  //   21   =>  'sangrado',
	  //   22   =>  'estado_madre',
	  //   23   =>  'nombre_esposo',
	  //   24   =>  'nombre_sala',
	  //   25   =>  'nombre_cama',
	  //   26   =>  'causa_egreso',

		// );  //create column like table in database

		$totalData = ControllerMaternidades::ctrContarMaternidadesFecha($item1, $valor1, $item2, $valor2);

		$totalFilter = $totalData;

		//Search
		$sql = "";

		if(!empty($request['search']['value'])) {

	    $sql .= " AND (nombre_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR paterno_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR materno_paciente ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_cama ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR sexo ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR cod_asegurado ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nro_empleador ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR estado_civil ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR c2.nombre_consultorio ILike '%".$request['search']['value']."%' ";		    
	    $sql .= " OR c3.nombre_consultorio ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_cama ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR c10_ingreso.codigo ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR c10_ingreso.descripcion ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR c10_egreso.codigo ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR c10_egreso.descripcion ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR nombre_servicio ILike '%".$request['search']['value']."%' ";
	    $sql .= " OR causa_egreso ILike '%".$request['search']['value']."%' )";

		}

		// $totalFilter = ControllerMaternidades::ctrContarFiltradoMaternidadesFecha($item1, $valor1, $item2, $valor2, $sql);

		// $sql.=" ORDER BY ".$col[$request['order'][0]['column']]."   ".$request['order'][0]['dir']."  LIMIT ".
   	// $request['length']."  OFFSET ".$request['start']."  ";

   	$sql.=" ORDER BY fecha_ingreso ";

  	$maternidad = ControllerMaternidades::ctrMostrarMaternidadesFecha($item1, $valor1, $item2, $valor2, $sql);
  	
		$data = array();
		$nro = 0;

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
			$btnReporteForm204 = "<button class='btn btn-outline-primary btn-sm btnReporteForm204' idPaciente='".$maternidad[$i]["id_paciente"]."' idPacienteIngreso='".$maternidad[$i]["id_paciente_ingreso"]."' modulo='paciente-ingresos' data-toggle='tooltip' title='Reportes Paciente'><i class='fas fa-print'></i> FORM204</button>";

			$botones = "<div class='btn-group'>".$btnReporteForm204."</div>";

			$nro = $i + 1;				
			$subdata = array();
	    $subdata[] = $nro;
	    $subdata[] = date("d", strtotime($maternidad[$i]["fecha_ingreso"])); 
	    $subdata[] = date("m", strtotime($maternidad[$i]["fecha_ingreso"])); 
	    $subdata[] = date("Y", strtotime($maternidad[$i]["fecha_ingreso"])); 
	    $subdata[] = date("H:i", strtotime($maternidad[$i]["hora_ingreso"])); 
	    $subdata[] = $maternidad[$i]["paterno_paciente"];
	    $subdata[] = $maternidad[$i]["materno_paciente"];
	    $subdata[] = $maternidad[$i]["nombre_paciente"]; 
	    $subdata[] = $maternidad[$i]["procedencia"];
	    $subdata[] = $edad->y;   
	    $subdata[] = $maternidad[$i]["sexo"];
	    $subdata[] = $maternidad[$i]["cod_beneficiario"];
	    $subdata[] = $maternidad[$i]["estado_civil"];
	    $subdata[] = $maternidad[$i]["zona"];
	    $subdata[] = $maternidad[$i]["nombre_cama"]; 
	    $subdata[] = substr($maternidad[$i]["cod_asegurado"], 0, 6);
	    $subdata[] = substr($maternidad[$i]["cod_asegurado"], 6, 8);
	    $subdata[] = $maternidad[$i]["nro_empleador"];
	    $subdata[] = $maternidad[$i]["cie10_cod_ingreso"];
	    $subdata[] = $maternidad[$i]["cie10_diag_ingreso"];
	    $subdata[] = $maternidad[$i]["nombre_servicio"];
	    $subdata[] = $maternidad[$i]["cie10_cod_egreso"];
	    $subdata[] = $maternidad[$i]["cie10_diag_egreso"];
	    $subdata[] = date("d", strtotime($maternidad[$i]["fecha_egreso"])); 
	    $subdata[] = date("m", strtotime($maternidad[$i]["fecha_egreso"])); 
	    $subdata[] = date("Y", strtotime($maternidad[$i]["fecha_egreso"])); 
	    $subdata[] = date("H:i", strtotime($maternidad[$i]["hora_egreso"])); 
	    $subdata[] = $maternidad[$i]["causa_egreso"];
	    $subdata[] = date("d/m/Y", strtotime($maternidad[$i]["fecha_nacido"]));
	    $subdata[] = $maternidad[$i]["peso_nacido1"].' - '.$maternidad[$i]["peso_nacido2"].' - '.$maternidad[$i]["peso_nacido3"];
	    $subdata[] = date("H:i", strtotime($maternidad[$i]["hora_nacido"]));
	    $subdata[] = $maternidad[$i]["sexo_nacido1"].' - '.$maternidad[$i]["sexo_nacido2"].' - '.$maternidad[$i]["sexo_nacido3"];
	    $subdata[] = $maternidad[$i]["tipo_parto"];
	    $subdata[] = $maternidad[$i]["edad_gestacional"];
	   	$subdata[] = $botones;

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