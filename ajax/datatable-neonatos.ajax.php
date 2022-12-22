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

		$totalData = ControllerNeonatos::ctrContarNeonatos();

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

		$totalFilter = ControllerNeonatos::ctrContarFiltradoNeonatos($sql);

		$sql.=" ORDER BY fecha_ingreso LIMIT ".
   	$request['length']."  OFFSET ".$request['start']."  ";

  	$neonatos = ControllerNeonatos::ctrMostrarNeonatos($sql);
  	
		$data = array();
		$nro = 0;

		for ($i = 0; $i < count($neonatos); $i++) {

			// Calcular la Edad a partir de la fecha de nacimiento
			$nacimiento = new DateTime($neonatos[$i]["fecha_nacimiento"]);
			$hoy = new DateTime(date("Y-m-d"));
			$edad = $hoy->diff($nacimiento);

			/*=============================================
			TRAEMOS LAS ACCIONES
			=============================================*/					
			$btnReporteForm204 = "<button class='btn btn-outline-primary btn-sm btnReporteForm204' idPaciente='".$neonatos[$i]["id_paciente"]."' idPacienteIngreso='".$neonatos[$i]["id_paciente_ingreso"]."' modulo='paciente-ingresos' data-toggle='tooltip' title='Reportes Paciente'><i class='fas fa-print'></i> FORM204</button>";

			$botones = "<div class='btn-group'>".$btnReporteForm204."</div>";

			/*=============================================
			GUARDAMOS LOS DATOS EN UN NUEVO ARRAY
			=============================================*/
			$nro = $i + 1;				
			$subdata = array();
	    $subdata[] = $request['start'] + $nro;
	    $subdata[] = date("d", strtotime($neonatos[$i]["fecha_ingreso"])); 
	    $subdata[] = date("m", strtotime($neonatos[$i]["fecha_ingreso"])); 
	    $subdata[] = date("Y", strtotime($neonatos[$i]["fecha_ingreso"])); 
	    $subdata[] = date("H:i", strtotime($neonatos[$i]["hora_ingreso"])); 
	    $subdata[] = $neonatos[$i]["paterno_paciente"];
	    $subdata[] = $neonatos[$i]["materno_paciente"];
	    $subdata[] = $neonatos[$i]["nombre_paciente"]; 
	    $subdata[] = $neonatos[$i]["procedencia"];
	    $subdata[] = $edad->y;   
	    $subdata[] = $neonatos[$i]["sexo"];
	    $subdata[] = $neonatos[$i]["cod_beneficiario"];
	    $subdata[] = $neonatos[$i]["estado_civil"];
	    $subdata[] = $neonatos[$i]["zona"];
	    $subdata[] = $neonatos[$i]["nombre_cama"]; 
	    $subdata[] = substr($neonatos[$i]["cod_asegurado"], 0, 6);
	    $subdata[] = substr($neonatos[$i]["cod_asegurado"], 6, 8);
	    $subdata[] = $neonatos[$i]["nro_empleador"];
	    $subdata[] = $neonatos[$i]["cie10_cod_ingreso"];
	    $subdata[] = $neonatos[$i]["cie10_diag_ingreso"];
	    $subdata[] = $neonatos[$i]["nombre_servicio"];
	    $subdata[] = $neonatos[$i]["cie10_cod_egreso"];
	    $subdata[] = $neonatos[$i]["cie10_diag_egreso"];
	    $subdata[] = date("d", strtotime($neonatos[$i]["fecha_egreso"])); 
	    $subdata[] = date("m", strtotime($neonatos[$i]["fecha_egreso"])); 
	    $subdata[] = date("Y", strtotime($neonatos[$i]["fecha_egreso"])); 
	    $subdata[] = date("H:i", strtotime($neonatos[$i]["hora_egreso"])); 
	    $subdata[] = $neonatos[$i]["causa_egreso"];
	    $subdata[] = $neonatos[$i]["talla_neonato"];
	    $subdata[] = $neonatos[$i]["peso_neonato"];
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
	MOSTRAR LA TABLA DE NEONATOS (FILTRADO POR FECHA DE INGRESO)
	=============================================*/
	public function mostrarTablaNeonatosFecha() {

		$request = $this->request;

		$item1 = "fecha_ini";;
		$valor1 = $this->fecha_ini;

		$item2 = "fecha_fin";
		$valor2 = $this->fecha_fin;

		$totalData = ControllerNeonatos::ctrContarNeonatosFecha($item1, $valor1, $item2, $valor2);

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

		$sql.=" ORDER BY fecha_ingreso ";

  	$neonatos = ControllerNeonatos::ctrMostrarNeonatosFecha($item1, $valor1, $item2, $valor2, $sql);
  	
		$data = array();
		$nro = 0;

		for ($i = 0; $i < count($neonatos); $i++) {

			// Calcular la Edad a partir de la fecha de nacimiento
			$nacimiento = new DateTime($neonatos[$i]["fecha_nacimiento"]);
			$hoy = new DateTime(date("Y-m-d"));
			$edad = $hoy->diff($nacimiento);

			/*=============================================
			TRAEMOS LAS ACCIONES
			=============================================*/					
			$btnReporteForm204 = "<button class='btn btn-outline-primary btn-sm btnReporteForm204' idPaciente='".$neonatos[$i]["id_paciente"]."' idPacienteIngreso='".$neonatos[$i]["id_paciente_ingreso"]."' modulo='paciente-ingresos' data-toggle='tooltip' title='Reportes Paciente'><i class='fas fa-print'></i> FORM204</button>";

			$botones = "<div class='btn-group'>".$btnReporteForm204."</div>";

			/*=============================================
			GUARDAMOS LOS DATOS EN UN NUEVO ARRAY
			=============================================*/			
			$nro = $i + 1;				
			$subdata = array();
	    $subdata[] = $nro;
	    $subdata[] = date("d", strtotime($neonatos[$i]["fecha_ingreso"])); 
	    $subdata[] = date("m", strtotime($neonatos[$i]["fecha_ingreso"])); 
	    $subdata[] = date("Y", strtotime($neonatos[$i]["fecha_ingreso"])); 
	    $subdata[] = date("H:i", strtotime($neonatos[$i]["hora_ingreso"])); 
	    $subdata[] = $neonatos[$i]["paterno_paciente"];
	    $subdata[] = $neonatos[$i]["materno_paciente"];
	    $subdata[] = $neonatos[$i]["nombre_paciente"]; 
	    $subdata[] = $neonatos[$i]["procedencia"];
	    $subdata[] = $edad->y;   
	    $subdata[] = $neonatos[$i]["sexo"];
	    $subdata[] = $neonatos[$i]["cod_beneficiario"];
	    $subdata[] = $neonatos[$i]["estado_civil"];
	    $subdata[] = $neonatos[$i]["zona"];
	    $subdata[] = $neonatos[$i]["nombre_cama"]; 
	    $subdata[] = substr($neonatos[$i]["cod_asegurado"], 0, 6);
	    $subdata[] = substr($neonatos[$i]["cod_asegurado"], 6, 8);
	    $subdata[] = $neonatos[$i]["nro_empleador"];
	    $subdata[] = $neonatos[$i]["cie10_cod_ingreso"];
	    $subdata[] = $neonatos[$i]["cie10_diag_ingreso"];
	    $subdata[] = $neonatos[$i]["nombre_servicio"];
	    $subdata[] = $neonatos[$i]["cie10_cod_egreso"];
	    $subdata[] = $neonatos[$i]["cie10_diag_egreso"];
	    $subdata[] = date("d", strtotime($neonatos[$i]["fecha_egreso"])); 
	    $subdata[] = date("m", strtotime($neonatos[$i]["fecha_egreso"])); 
	    $subdata[] = date("Y", strtotime($neonatos[$i]["fecha_egreso"])); 
	    $subdata[] = date("H:i", strtotime($neonatos[$i]["hora_egreso"])); 
	    $subdata[] = $neonatos[$i]["causa_egreso"];
	    $subdata[] = $neonatos[$i]["talla_neonato"];
	    $subdata[] = $neonatos[$i]["peso_neonato"];
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
