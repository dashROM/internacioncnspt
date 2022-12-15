<?php

require_once "../controllers/libro_servicios.controller.php";
require_once "../models/libro_servicios.model.php";

class TablaLibroServicios {

	public $request;

	/*=============================================
	MOSTRAR LA TABLA DE LIBRO SERVICIOS (FILTRADO POR FECHA DE EGRESO)
	=============================================*/
	public function mostrarTablaLibroServiciosFecha() {

		$request = $this->request;

		$item = "servicio";
		$valor = $this->servicio;

		$item1 = "fecha_ini";
		$valor1 = $this->fecha_ini;

		$item2 = "fecha_fin";
		$valor2 = $this->fecha_fin;

		$totalData = ControllerLibroServicios::ctrContarLibroServiciosFecha($item, $valor, $item1, $valor1, $item2, $valor2);

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

  	$libroServicios = ControllerLibroServicios::ctrMostrarLibroServiciosFecha($item, $valor, $item1, $valor1, $item2, $valor2, $sql);
  	
		$data = array();

		for ($i = 0; $i < count($libroServicios); $i++) {

			// Calcular la Edad a partir de la fecha de nacimiento
			$nacimiento = new DateTime($libroServicios[$i]["fecha_nacimiento"]);
			$hoy = new DateTime(date("Y-m-d"));
			$edad = $hoy->diff($nacimiento);

			/*=============================================
			GUARDAMOS LOS DATOS EN UN NUEVO ARRAY
			=============================================*/			
			$nro = $i + 1;				
			$subdata = array();
	    $subdata[] = $request['start'] + $nro;
	    $subdata[] = date("d", strtotime($libroServicios[$i]["fecha_ingreso"])); 
	    $subdata[] = date("m", strtotime($libroServicios[$i]["fecha_ingreso"])); 
	    $subdata[] = date("Y", strtotime($libroServicios[$i]["fecha_ingreso"])); 
	    $subdata[] = date("H:i", strtotime($libroServicios[$i]["hora_ingreso"])); 
	    $subdata[] = $libroServicios[$i]["paterno_paciente"];
	    $subdata[] = $libroServicios[$i]["materno_paciente"];
	    $subdata[] = $libroServicios[$i]["nombre_paciente"]; 
	    $subdata[] = $libroServicios[$i]["procedencia"];
	    $subdata[] = $edad->y;   
	    $subdata[] = $libroServicios[$i]["sexo"];
	    $subdata[] = $libroServicios[$i]["cod_beneficiario"];
	    $subdata[] = $libroServicios[$i]["estado_civil"];
	    $subdata[] = $libroServicios[$i]["zona"];
	    $subdata[] = $libroServicios[$i]["nombre_cama"]; 
	    $subdata[] = substr($libroServicios[$i]["cod_asegurado"], 0, 6);
	    $subdata[] = substr($libroServicios[$i]["cod_asegurado"], 6, 8);
	    $subdata[] = $libroServicios[$i]["nro_empleador"];
	    $subdata[] = $libroServicios[$i]["cie10_cod_ingreso"];
	    $subdata[] = $libroServicios[$i]["cie10_diag_ingreso"];
	    $subdata[] = $libroServicios[$i]["nombre_servicio"];
	    $subdata[] = $libroServicios[$i]["cie10_cod_egreso"];
	    $subdata[] = $libroServicios[$i]["cie10_diag_egreso"];
	    $subdata[] = date("d", strtotime($libroServicios[$i]["fecha_egreso"])); 
	    $subdata[] = date("m", strtotime($libroServicios[$i]["fecha_egreso"])); 
	    $subdata[] = date("Y", strtotime($libroServicios[$i]["fecha_egreso"])); 
	    $subdata[] = date("H:i", strtotime($libroServicios[$i]["hora_egreso"])); 
	    $subdata[] = $libroServicios[$i]["causa_egreso"];
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
ACTIVAR TABLA LIBRO SERVICIOS
=============================================*/
if (isset($_POST["BuscarFechaLibroServicios"])) {

	$activarlibroServicios = new TablaLibroServicios();
	$activarlibroServicios -> request = $_REQUEST;
	$activarlibroServicios -> servicio = $_POST["servicio"];
	$activarlibroServicios -> fecha_ini = $_POST["fechaIni"];
	$activarlibroServicios -> fecha_fin = $_POST["fechaFin"];
	$activarlibroServicios -> mostrarTablaLibroServiciosFecha();

}
