<?php

require_once "../controllers/paciente_ingresos.controller.php";
require_once "../models/paciente_ingresos.model.php";

require_once "../controllers/reportes.controller.php";
require_once "../models/reportes.model.php";

require_once "../library/tcpdf/tcpdf.php";

class MYPDF extends TCPDF {

	public $pdf;

    //Page header
    public function Header() {
      // Logo
      $image_file = K_PATH_IMAGES.'cns-logo-simple.png';
      $this->Image($image_file, 10, 3, 15, '', 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);

      $this->SetFont('Helvetica', '', 8);
      // Title
      // $this->Cell(0,12,' CNS',0,false,'L',0,'',false,'M','M');
      $this->Cell(0,12,'Form. EM 204',0,false,'R',0,'',false,'M','M');
      $this->ln(8);
      $this->SetFont('Helvetica', 'B', 14);
      $this->Cell(0,12,'INFORME ESTADISTICO DE EGRESO DE HOSPITALIZACION',0,false,'C',0,'',false,'M','M');

      // $this->MultiCell(20, 3, 'Formu. EM 204', 0, 'C', 0, 1, '22', '176', true);
        
    }
}

class AjaxPacienteIngresos {

  public $id;
  public $id_establecimiento;
	public $fecha_ingreso;
	public $hora_ingreso;
	public $id_servicio;
	public $id_especialidad;
	public $estado;
	public $id_sala;
	public $id_cama;
	public $id_cama_ant;
	public $id_consultorio;
	public $id_medico;
	public $id_cie10;
	public $id_paciente;

	public $transferencia;

	public function ajaxMostrarPacienteIngreso() {

		$item = "id";
		$valor = $this->id;

		$ingresos = ControllerPacienteIngresos::ctrMostrarPacienteIngreso($item, $valor);
	
		echo json_encode($ingresos);	
			
	}

	/*=============================================
	NUEVO PACIENTE INGRESO
	=============================================*/
  public function ajaxNuevoPacienteIngreso()	{

		$datos = array("id_establecimiento"  			=> $this->id_establecimiento,
		               "fecha_ingreso"	     			=> $this->fecha_ingreso,
		               "hora_ingreso"        			=> $this->hora_ingreso,
		               "id_servicio"  	     			=> $this->id_servicio,
		               "id_especialidad"  	     	=> $this->id_especialidad,
		               "id_sala"             			=> $this->id_sala,
		               "id_cama"             			=> $this->id_cama,
		               "id_consultorio"      			=> $this->id_consultorio,
		               "id_medico"           			=> $this->id_medico,
		               "id_cie10"     	     			=> $this->id_cie10,
		               "diagnostico_especifico1"	=> mb_strtoupper($this->diagnostico_especifico1, 'utf-8'),
		               "diagnostico_especifico2"	=> mb_strtoupper($this->diagnostico_especifico2, 'utf-8'),
		               "diagnostico_especifico3"	=> mb_strtoupper($this->diagnostico_especifico3, 'utf-8'),
		               "id_paciente"         			=> $this->id_paciente,
		);
	
	  $respuesta = ControllerPacienteIngresos::ctrNuevoPacienteIngreso($datos);

	  echo json_encode($respuesta);
	
	}

	/*=============================================
	EDITAR PACIENTE INGRESO
	=============================================*/
	public function ajaxEditarPacienteIngreso() {

		$datos = array("id_establecimiento"       => $this->id_establecimiento,
		               "fecha_ingreso"	          => $this->fecha_ingreso,
		               "hora_ingreso"             => $this->hora_ingreso,
		               "id_servicio"  	          => $this->id_servicio,
		               "id_especialidad"  	      => $this->id_especialidad,
		               "id_sala"                  => $this->id_sala,
		               "id_cama"                  => $this->id_cama,
		               "id_cama_ant"              => $this->id_cama_ant,
		               "id_consultorio"           => $this->id_consultorio,
		               "id_medico"                => $this->id_medico,
		               "id_cie10"     	          => $this->id_cie10,
		               "diagnostico_especifico1"	=> mb_strtoupper($this->diagnostico_especifico1, 'utf-8'),
		               "diagnostico_especifico2"	=> mb_strtoupper($this->diagnostico_especifico2, 'utf-8'),
		               "diagnostico_especifico3"	=> mb_strtoupper($this->diagnostico_especifico3, 'utf-8'),
		               "id_paciente"              => $this->id_paciente,
		               "id"         				      => $this->id
		);

		if($this->transferencia == 0) {

			$respuesta = ControllerPacienteIngresos::ctrEditarPacienteIngreso($datos);

		} else {

			$respuesta = ControllerPacienteIngresos::ctrEditarPacienteIngresoCT($datos);

		}
		
		echo json_encode($respuesta);
		
	}

	/*=============================================
	VERIFICAR INGRESO PACIENTE
	=============================================*/
	public function ajaxVerificarPacienteIngresos() {

		$item = "id_paciente";
		$valor = $this->id_paciente;

		$respuesta = ControllerPacienteIngresos::ctrVerificarPacienteIngresos($item, $valor);

		if ($respuesta == null) {
	
			echo 'ok';

		} else {

			echo 'error';
		}
			
	}

	/*=============================================
	MOSTRAR REPORTE FORM 204
	=============================================*/
	public function ajaxReporteForm204() {

		$item = "id";
		$valor = $this->id;

		// Datos Paciente - Ingreso Paciente
		$paciente_ingreso = ControllerReportes::ctrFrmEM204PacienteIngreso($item, $valor);

		//Datos Trasnferencia
		$transferencias = ControllerReportes::ctrFrmEM204Transferencias($item,$valor);

		// Datos Egreso Paciente
		$paciente_egreso = ControllerReportes::ctrFrmEM204PacienteEgreso($item, $valor);
		
		// Datos Maternidad
		$maternidad = ControllerReportes::ctrFrmEM204Maternidad($item, $valor);

		// Datos Neonato
		$neonato = ControllerReportes::ctrFrmEM204Neonato($item, $valor);

		/*=============================================
		OBTENEMOS LA EDAD A PARTIR DE LA FECHA DE NACIMIENTO
		=============================================*/	
		$fecha_nacimiento = new DateTime($paciente_ingreso["fecha_nacimiento"]);
		$hoy = new DateTime();
		$edad = $hoy->diff($fecha_nacimiento);

		$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('CNS');
		$pdf->SetTitle('INFORME ESTADISTICO DE EGRESO DE HOSPITALIZACION');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');



		// set default header data
		$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

		// set margins
		$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

		// set auto page breaks
		$pdf->SetAutoPageBreak(TRUE, 5);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}

		// ---------------------------------------------------------

		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);

		// add a page
		$pdf->AddPage(); 
		// set cell padding
		$pdf->setCellPaddings(1, 1, 1, 1);

		// set cell margins
		$pdf->setCellMargins(1, 1, 1, 1);

		// set color for background
		$pdf->SetFillColor(255, 255, 127);

		// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

		// Logo
    $image_file = K_PATH_IMAGES.'cns-logo-simple.png';
    $pdf->Image($image_file, 10, 3, 15, '', 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);

    $pdf->SetFont('Helvetica', '', 8);
    
    // Title
    $pdf->MultiCell(20, 3, 'Form EM 204', 0, 'L', 0, 1, '185', '3', true);
    $pdf->ln(8);
    $pdf->SetFont('Helvetica', 'B', 16);
    // $pdf->Cell(0,6,' INFORME ESTADISTICO DE EGRESO DE HOSPITALIZACION',0,false,'C',0,'',false,'M','M');
    $pdf->MultiCell(200, 5, 'INFORME ESTADISTICO DE EGRESO DE HOSPITALIZACION', 0, 'C', 0, 1, '13', '9', true);

    //********************************
		// DATOS PERSONALES DEL PACIENTE
		//********************************		

		// set border width
		$pdf->SetLineWidth(0.5);

		// set color for cell border
		$pdf->SetDrawColor(0,0,0);

		// set filling color
		$pdf->SetFillColor(0,0,0);

    $pdf->line(5,20,205,20);

    // set border width
		$pdf->SetLineWidth(0.1);

    $pdf->line(5,21,205,21);

    // set border width
		$pdf->SetLineWidth(0.3);

    $pdf->line(12,21,12,287);

    $pdf->line(190,44,205,44);

    $pdf->line(190,44,190,287);

    // set border width
		$pdf->SetLineWidth(0.1);

		// set cell height ratio
		$pdf->setCellHeightRatio(0.3);

		// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(30, 3, date("d", strtotime($paciente_ingreso['fecha_nacimiento'])), 0, 'C', 0, 0, '46', '25', true);
		$pdf->MultiCell(30, 3, date("m", strtotime($paciente_ingreso['fecha_nacimiento'])), 0, 'C', 0, 0, '64', '25', true);
		$pdf->MultiCell(30, 3, date("Y", strtotime($paciente_ingreso['fecha_nacimiento'])), 0, 'C', 0, 0, '84', '25', true);
		$pdf->SetFont('times', '', 10);
		
		$pdf->MultiCell(150, 3, 'FECHA NACIMIENTO:......................................................................', 0, 'L', 0, 0, '13', '27', true);

		$pdf->MultiCell(30, 3, 'DIA', 0, 'C', 0, 0, '46', '31', true);
		$pdf->MultiCell(30, 3, 'MES', 0, 'C', 0, 0, '64', '31', true);
		$pdf->MultiCell(30, 3, 'AÑO', 0, 'C', 0, 0, '84', '31', true);

		
		$pdf->MultiCell(40, 5, 'Nº de Asegurado', 0, 'L', 0, 0, '124', '25', true);
		$pdf->MultiCell(35, 5, 'Beneficiario', 0, 'L', 0, 1, '124', '33', true);

		$pdf->SetFont('times', 'B', 12);
		$pdf->MultiCell(50, 6, $paciente_ingreso['cod_asegurado'], 1, 'C', 0, 1, '154', '24', true, 0, false, true, 6, 'M');
		$pdf->MultiCell(50, 6, $paciente_ingreso['cod_beneficiario'], 1, 'C', 0, 1, '154', '32', true, 0, false, true, 6, 'M');
		
		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(55, 5, $paciente_ingreso['paterno_paciente'], 0, 'C', 0, 1, '13', '42', true);
		$pdf->MultiCell(55, 5, $paciente_ingreso['materno_paciente'], 0, 'C', 0, 1, '68', '42', true);
		$pdf->MultiCell(60, 5, $paciente_ingreso['nombre_paciente'], 0, 'C', 0, 1, '123', '42', true);
		$pdf->SetFont('times', '', 10);

		$pdf->MultiCell(180, 3, '.................................................................................................................................................................................................', 0, 'L', 0, 0, '13', '44', true);
		$pdf->MultiCell(55, 5, 'APELLIDO PATERNO', 0, 'R', 0, 1, '5', '48', true);
		$pdf->MultiCell(55, 5, 'APELLIDO MATERNO', 0, 'R', 0, 1, '60', '48', true);
		$pdf->MultiCell(55, 5, 'NOMBRE(S)', 0, 'R', 0, 1, '110', '48', true);

		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(25, 3, $edad->y.' años', 0, 'L', 0, 0, '45', '54', true);
		$pdf->SetFont('times', '', 10);

		$pdf->MultiCell(105, 5, '1.- Edad cumplida:...............................................', 0, 'L', 0, 0, '13', '56', true);
		
		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(35, 5, $paciente_ingreso['estado_civil'], 0, 'L', 0, 0, '130', '54', true);
		$pdf->SetFont('times', '', 10);

		$pdf->MultiCell(105, 5, 'Estado civil:...................................................................', 0, 'L', 0, 0, '110', '56', true);

		$pdf->SetFont('times', 'B', 10);
		$pdf->setCellHeightRatio(1);	
		$pdf->MultiCell(100, 5, $paciente_ingreso['nombre_empleador'], 0, 'C', 0, 0, '88', '62', true);
		$pdf->setCellHeightRatio(0);
		$pdf->SetFont('times', '', 10);

		$pdf->MultiCell(100, 3, '..............................................................................................................................', 0, 'L', 0, 0, '88', '68', true);		
		$pdf->MultiCell(100, 5, '2.- Empresa donde trabaja', 0, 'C', 0, 0, '88', '71', true);

		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(35, 5, $paciente_ingreso['nro_empleador'], 0, 'C', 0, 0, '105', '78', true);
		$pdf->SetFont('times', '', 10);

		$pdf->MultiCell(100, 5, 'N° Patronal:...........................................................................................', 0, 'L', 0, 0, '88', '80', true);

		$pdf->MultiCell(100, 5, 'Ocupacion Actual:.................................................................................', 0, 'L', 0, 0, '88', '88', true);

		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(95, 5, $paciente_ingreso['nombre_consultorio'], 0, 'L', 0, 0, '130', '96', true);
		$pdf->SetFont('times', '', 10);

		$pdf->MultiCell(100, 5, 'Unidad Sanitaria de origen:...................................................................', 0, 'L', 0, 0, '88', '98', true);

		$pdf->setCellHeightRatio(1);
		// $pdf->MultiCell(80, 5, $paciente_ingreso['diagnostico'], 1, 'L', 0, 0, '108', '99', true);
		$pdf->setCellHeightRatio(0);

		$pdf->MultiCell(185, 5, 'Diagnostico:...........................................................................................', 0, 'L', 0, 0, '88', '106', true);
		// $pdf->MultiCell(155, 5, $respuesta['diagnosticop'], 0, 'L', 0, 0, '35', '105', true);
		$pdf->MultiCell(85, 5, 'A pedido Del Dr.:....................................................', 0, 'L', 0, 0, '88', '115', true);
		// $pdf->MultiCell(55, 5, $respuesta['per_nombre'], 0, 'L', 0, 0, '40', '115', true);
		$pdf->MultiCell(40, 5, 'Clave:...................', 0, 'L', 0, 0, '160', '115', true);

		// cuadrado para el contenido
		$pdf->MultiCell(67, 55, '', 1, 'L', 0, 1, '20', '63', true);
		
		// set border width
		$pdf->SetLineWidth(0.1);

		// lineas horizontales
		$pdf->line(21,75,88,75);
		$pdf->line(40,71,88,71);
		$pdf->line(21,84,88,84);
		$pdf->line(21,90,88,90);
		$pdf->line(21,96,88,96);
		$pdf->line(21,102,88,102);
		$pdf->line(21,108,88,108);
		$pdf->line(21,114,88,114);

		// lineas verticales
		$pdf->line(40,64,40,119);
		$pdf->line(52,75,52,119);
		$pdf->line(64,75,64,119);
		$pdf->line(76,75,76,119);

		// lineas que separan primera columna en filas
		$pdf->line(56,64,56,75);
		$pdf->line(72,64,72,75);

		// lineas que separa sexo
		$pdf->line(31,75,31,84);
		$pdf->line(21,79,40,79);

		$pdf->MultiCell(30, 5, 'RIESGO', 0, 'L', 0, 0, '22', '68', true);

		$pdf->SetFont('times', '', 8);
		$pdf->MultiCell(17, 5, 'Enf. y Acc.', 0, 'C', 0, 0, '39', '64', true);
		$pdf->MultiCell(17, 5, 'Común', 0, 'C', 0, 0, '39', '67', true);

		$pdf->MultiCell(18, 5, 'Maternidad', 0, 'C', 0, 0, '54', '65', true);

		$pdf->MultiCell(17, 5, 'Acc. Trab.', 0, 'C', 0, 0, '70', '64', true);
		$pdf->MultiCell(17, 5, 'Enf. Prof.', 0, 'C', 0, 0, '70', '67', true);

		$pdf->SetFont('times', '', 6);
		$pdf->MultiCell(12, 3, 'HOMBRE', 0, 'C', 0, 0, '19', '75', true);
		$pdf->MultiCell(12, 3, 'MUJER', 0, 'C', 0, 0, '28', '75', true);

		$pdf->setCellHeightRatio(1);
		$pdf->MultiCell(12, 6, 'ASEGU- RADO', 0, 'C', 0, 0, '39', '75', true);
		$pdf->setCellHeightRatio(0);

		$pdf->setCellHeightRatio(1);
		$pdf->MultiCell(14, 6, 'ESPOSA O COMPAÑE- RA', 0, 'C', 0, 0, '50', '74', true);
		$pdf->setCellHeightRatio(0);

		$pdf->MultiCell(14, 3, 'HIJOS', 0, 'C', 0, 0, '62', '77', true);

		$pdf->setCellHeightRatio(1);
		$pdf->MultiCell(12, 6, 'OTROS FAM.', 0, 'C', 0, 0, '75', '75', true);
		$pdf->setCellHeightRatio(0);

		$pdf->MultiCell(20, 3, 'ACTIVO', 0, 'L', 0, 0, '20', '85', true);
		$pdf->MultiCell(20, 3, 'RENTISTA', 0, 'L', 0, 0, '20', '91', true);
		$pdf->MultiCell(20, 3, 'BENEMERITO', 0, 'L', 0, 0, '20', '97', true);
		$pdf->setCellHeightRatio(1);
		$pdf->MultiCell(20, 6, 'OTROS ASEGURADOS', 0, 'L', 0, 0, '20', '101', true);
		$pdf->setCellHeightRatio(0);
		$pdf->MultiCell(20, 3, 'PARTICULAR', 0, 'L', 0, 0, '20', '109', true);

		$pdf->SetFont('times', '', 10);
		$pdf->MultiCell(14, 3, '1', 0, 'C', 0, 0, '38', '114', true, 0, false, true, 3, 'M');
		$pdf->MultiCell(14, 3, '2', 0, 'C', 0, 0, '50', '114', true, 0, false, true, 3, 'M');
		$pdf->MultiCell(14, 3, '3', 0, 'C', 0, 0, '62', '114', true, 0, false, true, 3, 'M');
		$pdf->MultiCell(14, 3, '4', 0, 'C', 0, 0, '74', '114', true, 0, false, true, 3, 'M');

		$pdf->SetFont('times', '', 8);
		$pdf->MultiCell(4, 3, '1', 1, 'C', 0, 0, '39', '70', true, 0, false, true, 3, 'M');
		$pdf->MultiCell(4, 3, '2', 1, 'C', 0, 0, '55', '70', true, 0, false, true, 3, 'M');
		$pdf->MultiCell(4, 3, '3', 1, 'C', 0, 0, '71', '70', true, 0, false, true, 3, 'M');

		$pdf->MultiCell(4, 3, '1', 1, 'C', 0, 0, '20', '78', true, 0, false, true, 3, 'M');
		$pdf->MultiCell(4, 3, '2', 1, 'C', 0, 0, '30', '78', true, 0, false, true, 3, 'M');

		$pdf->SetFont('times', '', 10);
		$pdf->MultiCell(6, 3, '3.-', 0, 'C', 0, 0, '12', '66', true, 0, false, true, 3, 'M');
		$pdf->MultiCell(6, 3, '4.-', 0, 'C', 0, 0, '12', '76', true, 0, false, true, 3, 'M');
		$pdf->MultiCell(6, 3, '5.-', 0, 'C', 0, 0, '12', '116', true, 0, false, true, 3, 'M');
		$pdf->MultiCell(12, 3, '6.-  }', 0, 'C', 0, 0, '29', '114', true, 0, false, true, 3, 'M');

		$pdf->SetFont('times', '', 16);
		$pdf->MultiCell(6, 3, '{', 0, 'C', 0, 0, '15', '66', true, 0, false, true, 3, 'M');
		$pdf->MultiCell(6, 3, '{', 0, 'C', 0, 0, '15', '76', true, 0, false, true, 3, 'M');

		// Rotar Texto
		$pdf->StartTransform();
		$pdf->Rotate(-90);
		$pdf->MultiCell(6, 3, '{', 0, 'C', 0, 0, '57', '80', true, 0, false, true, 3, 'M');
		$pdf->StopTransform();

		$pdf->SetFont('times', '', 10);
		$pdf->MultiCell(6, 3, '1', 0, 'C', 0, 0, '12', '85', true, 0, false, true, 3, 'M');
		$pdf->MultiCell(6, 3, '2', 0, 'C', 0, 0, '12', '91', true, 0, false, true, 3, 'M');
		$pdf->MultiCell(6, 3, '3', 0, 'C', 0, 0, '12', '97', true, 0, false, true, 3, 'M');
		$pdf->MultiCell(6, 3, '4', 0, 'C', 0, 0, '12', '103', true, 0, false, true, 3, 'M');
		$pdf->MultiCell(6, 3, '5', 0, 'C', 0, 0, '12', '109', true, 0, false, true, 3, 'M');

		// Rotar Texto
		$pdf->StartTransform();
		$pdf->Rotate(-270);
		// set font
		$pdf->SetFont('times', 'B', 14);
		$pdf->MultiCell(100, 5, 'DATOS PERSONALES DEL PACIENTE', 0, 'C', 0, 0, '5', '96', true);
		$pdf->MultiCell(85, 5, 'DATOS DE INGRESO', 0, 'C', 0, 0, '-80', '96', true);
		$pdf->MultiCell(50, 5, 'DATOS DE ALTA', 0, 'C', 0, 0, '-145', '96', true);
		$pdf->StopTransform();

		// set font
		$pdf->SetFont('times', '', 10);

		//********************************
		// DATOS DE INGRESO
		//********************************
		$pdf->line(5,124,190,124);

		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(85, 5, $paciente_ingreso['nombre_establecimiento'], 0, 'L', 0, 0, '45', '127', true);
		$pdf->SetFont('times', '', 10);

		$pdf->MultiCell(185, 5, '7.- Hospital(Clinica):..................................................................................................................................................................', 0, 'L', 0, 0, '13', '129', true);
		$pdf->MultiCell(55, 5, '8.- Con fecha', 0, 'L', 0, 0, '13', '137', true);
		

		$pdf->MultiCell(10, 7, '', 1, 'C', 0, 0, '36', '134', true);
		$pdf->MultiCell(10, 7, '', 1, 'C', 0, 0, '46', '134', true);
		$pdf->MultiCell(20, 7, '', 1, 'C', 0, 0, '56', '134', true);

		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(10, 7, date("d", strtotime($paciente_ingreso['fecha_ingreso'])), 0, 'C', 0, 0, '36', '136', true);
		$pdf->MultiCell(10, 7, date("m", strtotime($paciente_ingreso['fecha_ingreso'])), 0, 'C', 0, 0, '46', '136', true);
		$pdf->MultiCell(20, 7, date("Y", strtotime($paciente_ingreso['fecha_ingreso'])), 0, 'C', 0, 0, '56', '136', true);
		$pdf->SetFont('times', '', 10);

		$pdf->MultiCell(11, 5, 'DIA', 0, 'C', 0, 0, '36', '143', true);
		$pdf->MultiCell(11, 5, 'MES', 0, 'C', 0, 0, '46', '143', true);
		$pdf->MultiCell(21, 5, 'AÑO', 0, 'C', 0, 0, '56', '143', true); 

		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(65, 5, date("H:i", strtotime($paciente_ingreso['hora_ingreso'])), 0, 'L', 0, 0, '98', '135', true);
		$pdf->SetFont('times', '', 10);

		$pdf->MultiCell(65, 5, 'A horas:.........................................', 0, 'L', 0, 0, '80', '137', true);
		
		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(150, 5, $paciente_ingreso['nombre_especialidad'], 0, 'L', 0, 0, '39', '150', true);
		$pdf->SetFont('times', '', 10);

		$pdf->MultiCell(185, 5, '9.- Servico de:.............................................................................................................................................................................', 0, 'L', 0, 0, '13', '152', true);

		$pdf->setCellHeightRatio(1);

		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(137, 5, $paciente_ingreso['diagnostico'], 0, 'L', 0, 0, '50', '156', true);
		$pdf->SetFont('times', '', 10);

		$pdf->setCellHeightRatio(0);

		$pdf->MultiCell(185, 5, 'Diagnostico al ingreso:...............................................................................................................................................................', 0, 'L', 0, 0, '13', '162', true);

		//**********************************
		// DATOS NEONATOS (OPCIONAL)
		//**********************************

		if ($neonato != null) {
			$pdf->SetFont('times', 'B', 10);
			$pdf->MultiCell(80, 5, 'PESO NEONATO = '.$neonato['peso_neonato'], 0, 'L', 0, 0, '14', '169', true);
			$pdf->MultiCell(80, 5, 'TALLA NEONATO = '.$neonato['talla_neonato'], 0, 'L', 0, 0, '14', '174', true);
			$pdf->SetFont('times', '', 10);
		}

		//**********************************
		// DATOS TRANSFERENCIAS
		//**********************************
		
		$pdf->SetFont('times', 'B', 13);
		$pdf->MultiCell(80, 5, 'TRANSFERENCIAS INTERNAS:', 0, 'c', 0, 0, '69', '172', true);
		$pdf->SetFont('times', '', 10);

		$y = 0;

		for ($i = 0; $i < 3; $i++) {
		
			if ($transferencias != null) {

				if(isset($transferencias[$i]['fecha_transferencia'])) {
					$pdf->SetFont('times', 'B', 10);
					$pdf->MultiCell(75, 5, date("d/m/Y", strtotime($transferencias[$i]['fecha_transferencia'])), 0, 'L', 0, 0, '35', 180 + $y, true);
					$pdf->SetFont('times', '', 10);
				} else {
					$pdf->MultiCell(75, 5, '', 0, 'L', 0, 0, '35', 180 + $y, true);
				}
				$pdf->SetFont('times', 'B', 10);
				$pdf->MultiCell(125, 5, $transferencias[$i]['nombre_servicio'].' - '.$transferencias[$i]['nombre_especialidad'], 0, 'L', 0, 0, '95', 180 + $y, true);
				$pdf->SetFont('times', '', 10);	

				$pdf->MultiCell(75, 5, 'El Dia:......................................................', 0, 'L', 0, 0, '13', 182 + $y, true);
				$pdf->MultiCell(125, 5, 'Al servicio de:...........................................................................................................', 0, 'L', 0, 0, '70', 182 + $y, true);

				$y = $y + 10;

			} else {

				$pdf->MultiCell(75, 5, 'El Dia:.....................................................', 0, 'L', 0, 0, '13', 182 + $y, true);
				$pdf->MultiCell(125, 5, 'Al servicio de:...........................................................................................................', 0, 'L', 0, 0, '70', 182 + $y, true);

				$y = $y + 10;

			}

		}

		// $pdf->MultiCell(75, 5, 'El Dia:..............................................', 0, 'L', 0, 0, '', '190', true);
		// $pdf->MultiCell(125, 5, 'Al servicio de:...................................................................................................', 0, 'L', 0, 0, '70', '190', true);

		// $pdf->MultiCell(75, 5, 'El Dia:..............................................', 0, L', 0, 0, '', '200', true);
		// $pdf->MultiCell(125, 5, 'Al servicio de:...................................................................................................', 0, 'L', 0, 0, '70', '200', true);

		//**********************************
		// DATOS DE ALTA
		//**********************************

		$pdf->line(5,210,190,210);

		$pdf->MultiCell(55, 5, '10.- Con fecha', 0, 'L', 0, 0, '13', '216', true);
		// $pdf->MultiCell(55, 5, date("d", strtotime($respuesta['fecha'])).'       '.date("m", strtotime($respuesta['fecha'])).'     '.date("Y", strtotime($respuesta['fecha'])), 0, 'L', 0, 0, '48', '135', true);

		$pdf->MultiCell(10, 7, '', 1, 'C', 0, 0, '38', '212', true);
		$pdf->MultiCell(10, 7, '', 1, 'C', 0, 0, '48', '212', true);
		$pdf->MultiCell(20, 7, '', 1, 'C', 0, 0, '58', '212', true);

		if(isset($paciente_egreso['fecha_egreso'])) {
			$pdf->SetFont('times', 'B', 10);
			$pdf->MultiCell(10, 7, date("d", strtotime($paciente_egreso['fecha_egreso'])), 0, 'C', 0, 0, '38', '214', true);
			$pdf->MultiCell(10, 7, date("m", strtotime($paciente_egreso['fecha_egreso'])), 0, 'C', 0, 0, '48', '214', true);
			$pdf->MultiCell(20, 7, date("Y", strtotime($paciente_egreso['fecha_egreso'])), 0, 'C', 0, 0, '58', '214', true);
			$pdf->SetFont('times', '', 10);
		}
		
		$pdf->MultiCell(11, 5, 'DIA', 0, 'C', 0, 0, '38', '221', true);
		$pdf->MultiCell(11, 5, 'MES', 0, 'C', 0, 0, '48', '221', true);
		$pdf->MultiCell(21, 5, 'AÑO', 0, 'C', 0, 0, '58', '221', true); 

		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(55, 5, date("H:i", strtotime($paciente_egreso['hora_egreso'])), 0, 'L', 0, 0, '98', '214', true);
		$pdf->SetFont('times', '', 10);
		$pdf->MultiCell(135, 5, 'A horas:.................................. El paciente ha sido dado de Alta', 0, 'L', 0, 0, '84', '216', true);

		$pdf->setCellHeightRatio(2);

		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(173, 5, '                                                                                         '.$paciente_egreso['diagnostico_egreso'], 0, 'L', 0, 0, '15', '223', true);
		$pdf->SetFont('times', '', 10);

		$pdf->setCellHeightRatio(2);

		$pdf->MultiCell(175, 5, '11.- Diagnostico al egreso(el de mayor importancia)....................................................................................................................................................................................................................................................................................................................', 0, 'L', 0, 0, '13', '225', true);

		$pdf->setCellHeightRatio(0);

		// OPCIONES CAUSA EGRESO
		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(75, 3, '12.- CAUSA EGRESO', 0, 'L', 0, 0, '13', '243', true);
		$pdf->SetFont('times', '', 10);

		// MARCA CON UNA X DEPENDIENDO A LA CAUSA DE EGRESO
		if ($paciente_egreso['causa_egreso'] == "ALTA MEDICA") {
			$pdf->MultiCell(5, 3, 'X', 0, 'C', 0, 0, '43', '251', true);
		} else if ($paciente_egreso['causa_egreso'] == "TRANSFERENCIA EXTERNA") {
			$pdf->MultiCell(5, 3, 'X', 0, 'C', 0, 0, '86', '251', true);
		} else if ($paciente_egreso['causa_egreso'] == "ABANDONO") {
			$pdf->MultiCell(5, 3, 'X', 0, 'C', 0, 0, '121', '251', true);
		} else if ($paciente_egreso['causa_egreso'] == "MUERTE INSTITUCIONAL") {
			$pdf->MultiCell(5, 3, 'X', 0, 'C', 0, 0, '180', '251', true);
		} else if ($paciente_egreso['causa_egreso'] == "MUERTE NO INSTITUCIONAL") {
			$pdf->MultiCell(5, 3, 'X', 0, 'C', 0, 0, '69', '258', true);
		} else if ($paciente_egreso['causa_egreso'] == "ALTA SOLICITADA") {
			$pdf->MultiCell(5, 3, 'X', 0, 'C', 0, 0, '113', '258', true);
		} else if ($paciente_egreso['causa_egreso'] == "INDICIPLINA") {
			$pdf->MultiCell(5, 3, 'X', 0, 'C', 0, 0, '150', '258', true);
		} else if ($paciente_egreso['causa_egreso'] == "OTROS") {
			$pdf->MultiCell(5, 3, 'X', 0, 'C', 0, 0, '177', '258', true);
		}

		$pdf->MultiCell(55, 5, 'ALTA MEDICA', 0, 'L', 0, 0, '', '251', true);
		$pdf->MultiCell(5, 4, '', 1, 'C', 0, 0, '43', '250', true);
		$pdf->MultiCell(55, 5, 'TRANS. EXTERNA', 0, 'L', 0, 0, '53', '251', true);
		$pdf->MultiCell(5, 4, '', 1, 'C', 0, 0, '86', '250', true);
		$pdf->MultiCell(55, 5, 'ABANDONO', 0, 'L', 0, 0, '97', '251', true);
		$pdf->MultiCell(5, 4, '', 1, 'C', 0, 0, '121', '250', true);
		$pdf->MultiCell(55, 5, 'MUERTE INSTITUCIONAL', 0, 'L', 0, 0, '134', '251', true);
		$pdf->MultiCell(5, 4, '', 1, 'C', 0, 0, '180', '250', true);

		$pdf->MultiCell(55, 5, 'MUESTRE NO INSTITUCIONAL', 0, 'L', 0, 0, '', '258', true);
		$pdf->MultiCell(5, 4, '', 1, 'C', 0, 0, '69', '257', true);
		$pdf->MultiCell(55, 5, 'ALTA SOLICITADA', 0, 'L', 0, 0, '78', '258', true);
		$pdf->MultiCell(5, 4, '', 1, 'C', 0, 0, '113', '257', true);
		$pdf->MultiCell(55, 5, 'INDICIPLINA', 0, 'L', 0, 0, '125', '258', true);
		$pdf->MultiCell(5, 4, '', 1, 'C', 0, 0, '150', '257', true);
		$pdf->MultiCell(55, 5, 'OTROS', 0, 'L', 0, 0, '162', '258', true);
		$pdf->MultiCell(5, 4, '', 1, 'C', 0, 0, '177', '257', true);

		// OPCIONES CONDICION AL EGRESO
		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(75, 5, '13.- CONDICION AL EGRESO ', 0, 'L', 0, 0, '13', '268', true);
		$pdf->SetFont('times', '', 10);

		// MARCA CON UNA X DEPENDIENDO A LA CAUSA DE EGRESO
		if ($paciente_egreso['condicion_egreso'] == "CURADO") {
			$pdf->MultiCell(5, 3, 'X', 0, 'C', 0, 0, '34', '276', true);
		} else if ($paciente_egreso['condicion_egreso'] == "MEJORADO") {
			$pdf->MultiCell(5, 3, 'X', 0, 'C', 0, 0, '70', '276', true);
		} else if ($paciente_egreso['condicion_egreso'] == "MISMO ESTADO") {
			$pdf->MultiCell(5, 3, 'X', 0, 'C', 0, 0, '110', '276', true);
		} else if ($paciente_egreso['condicion_egreso'] == "INCURABLE") {
			$pdf->MultiCell(5, 3, 'X', 0, 'C', 0, 0, '143', '276', true);
		} else if ($paciente_egreso['condicion_egreso'] == "NO TRATADO") {
			$pdf->MultiCell(5, 3, 'X', 0, 'C', 0, 0, '180', '276', true);
		}

		$pdf->MultiCell(55, 5, 'CURADO', 0, 'L', 0, 0, '', '276', true);
		$pdf->MultiCell(5, 4, '', 1, 'C', 0, 0, '34', '275', true);
		$pdf->MultiCell(55, 5, 'MEJORADO', 0, 'L', 0, 0, '47', '276', true);
		$pdf->MultiCell(5, 4, '', 1, 'C', 0, 0, '70', '275', true);
		$pdf->MultiCell(55, 5, 'MISMO ESTADO', 0, 'L', 0, 0, '81', '276', true);
		$pdf->MultiCell(5, 4, '', 1, 'C', 0, 0, '110', '275', true);
		$pdf->MultiCell(55, 5, 'INCURABLE', 0, 'L', 0, 0, '120', '276', true);
		$pdf->MultiCell(5, 4, '', 1, 'C', 0, 0, '143', '275', true);
		$pdf->MultiCell(55, 5, 'NO TRATADO', 0, 'L', 0, 0, '153', '276', true);
		$pdf->MultiCell(5, 4, '', 1, 'C', 0, 0, '180', '275', true);


		//**********************************
		// DISEÑO CODIFICACION
		//**********************************
		$pdf->SetFont('times', 'B', 8);
		$pdf->MultiCell(18, 5, 'Codificación', 0, 'C', 0, 0, '188', '46', true);
		$pdf->SetFont('times', '', 8);
		$pdf->MultiCell(18, 5, '(No escribir)', 0, 'C', 0, 0, '188', '50', true);

		$pdf->MultiCell(25, 5, '.....................', 0, 'L', 0, 0, '189', '53', true);
		$pdf->SetFont('times', '', 10);
		$pdf->MultiCell(18, 5, '1', 0, 'C', 0, 0, '189', '56', true);
		$pdf->SetFont('times', '', 8);

		$pdf->MultiCell(25, 5, '.....................', 0, 'L', 0, 0, '189', '70', true);
		$pdf->SetFont('times', '', 10);
		$pdf->MultiCell(18, 5, '2', 0, 'C', 0, 0, '189', '73', true);
		$pdf->SetFont('times', '', 8);

		$pdf->MultiCell(25, 5, '.....................', 0, 'L', 0, 0, '189', '87', true);
		$pdf->SetFont('times', '', 10);
		$pdf->MultiCell(18, 5, '3', 0, 'C', 0, 0, '189', '90', true);
		$pdf->SetFont('times', '', 8);

		$pdf->MultiCell(25, 5, '.....................', 0, 'L', 0, 0, '189', '104', true);
		$pdf->SetFont('times', '', 10);
		$pdf->MultiCell(18, 5, '4', 0, 'C', 0, 0, '189', '107', true);
		$pdf->SetFont('times', '', 8);

		$pdf->MultiCell(25, 5, '.....................', 0, 'L', 0, 0, '189', '121', true);
		$pdf->SetFont('times', '', 10);
		$pdf->MultiCell(18, 5, '5', 0, 'C', 0, 0, '189', '124', true);
		$pdf->SetFont('times', '', 8);

		$pdf->MultiCell(25, 5, '.....................', 0, 'L', 0, 0, '189', '138', true);
		$pdf->SetFont('times', '', 10);
		$pdf->MultiCell(18, 5, '6', 0, 'C', 0, 0, '189', '141', true);
		$pdf->SetFont('times', '', 8);

		$pdf->MultiCell(25, 5, '.....................', 0, 'L', 0, 0, '189', '155', true);
		$pdf->SetFont('times', '', 10);
		$pdf->MultiCell(18, 5, '7', 0, 'C', 0, 0, '189', '158', true);
		$pdf->SetFont('times', '', 8);

		$pdf->MultiCell(25, 5, '.....................', 0, 'L', 0, 0, '189', '172', true);
		$pdf->SetFont('times', '', 10);
		$pdf->MultiCell(18, 5, '8-15', 0, 'C', 0, 0, '189', '175', true);
		$pdf->SetFont('times', '', 8);

		$pdf->MultiCell(25, 5, '.....................', 0, 'L', 0, 0, '189', '189', true);
		$pdf->SetFont('times', '', 10);
		$pdf->MultiCell(18, 5, '9', 0, 'C', 0, 0, '189', '192', true);
		$pdf->SetFont('times', '', 8);

		$pdf->MultiCell(25, 5, '.....................', 0, 'L', 0, 0, '189', '206', true);
		$pdf->SetFont('times', '', 10);
		$pdf->MultiCell(18, 5, '8-10', 0, 'C', 0, 0, '189', '209', true);
		$pdf->SetFont('times', '', 8);

		$pdf->MultiCell(25, 5, '.....................', 0, 'L', 0, 0, '189', '223', true);
		$pdf->SetFont('times', '', 10);
		$pdf->MultiCell(18, 5, '11', 0, 'C', 0, 0, '189', '226', true);
		$pdf->SetFont('times', '', 8);

		$pdf->MultiCell(25, 5, '.....................', 0, 'L', 0, 0, '189', '240', true);
		$pdf->SetFont('times', '', 10);
		$pdf->MultiCell(18, 5, '12', 0, 'C', 0, 0, '189', '243', true);
		$pdf->SetFont('times', '', 8);

		$pdf->MultiCell(25, 5, '.....................', 0, 'L', 0, 0, '189', '257', true);
		$pdf->SetFont('times', '', 10);
		$pdf->MultiCell(18, 5, '13', 0, 'C', 0, 0, '189', '260', true);


		//**********************************
		// DATOS CODIFICACION
		//**********************************
		$pdf->SetFont('times', 'B', 12);

		// Edad
		$pdf->MultiCell(25, 3, $edad->y, 0, 'L', 0, 0, '193', '66', true);

		// Tipo Asegurado-Beneficiario
		if ($paciente_ingreso['cod_beneficiario'] == 'ID') {
			$pdf->MultiCell(25, 3, '1', 0, 'L', 0, 0, '193', '83', true);
		} else {
			$pdf->MultiCell(25, 3, '2', 0, 'L', 0, 0, '193', '83', true);
		}

		// Sexo
		if ($paciente_ingreso['sexo'] == 'MASCULINO') {
			$pdf->MultiCell(25, 3, '1', 0, 'L', 0, 0, '193', '117', true);
		} else {
			$pdf->MultiCell(25, 3, '2', 0, 'L', 0, 0, '193', '117', true);
		}

		// codigo especialidad
		$pdf->MultiCell(25, 3, $paciente_ingreso['codigo_especialidad'], 0, 'L', 0, 0, '193', '202', true);

		// dias internación
		$fecha1 = new DateTime($paciente_ingreso['fecha_ingreso']);
		$fecha2 = new DateTime($paciente_egreso['fecha_egreso']);
		$diff = $fecha1->diff($fecha2);
		$pdf->MultiCell(25, 3, $diff->days+1, 0, 'L', 0, 0, '193', '220', true);

		// codigo cie-10
		$pdf->MultiCell(25, 3, $paciente_ingreso['codigo'], 0, 'L', 0, 0, '193', '236', true);	


		$pdf->SetFont('times', '', 10);



		// add a page
		$pdf->AddPage(); 
		// ---------------------------------------------------------

		// set border width
		$pdf->SetLineWidth(0.3);
		// line left
		$pdf->line(12,10,12,239);
		// line rigth
    $pdf->line(190,10,190,239);
    // set border width
		$pdf->SetLineWidth(0.1);

		$pdf->setCellPaddings(1, 1, 1, 1);

		// set cell margins
		$pdf->setCellMargins(1, 1, 1, 1);

		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(75, 5, '14.- EN CASO DE MUERTE', 0, 'L', 0, 0, '13', '10', true);
		$pdf->SetFont('times', '', 10);

		$pdf->setCellHeightRatio(2);

		$pdf->MultiCell(150, 25, $paciente_egreso['fallecido_causa_clinica'], 0, 'L', 0, 0, '37', '14', true);
		$pdf->MultiCell(175, 25, '1 Causa Clínica:.................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................', 0, 'L', 0, 0, '13', '15', true);
		
		$pdf->MultiCell(133, 5, $paciente_egreso['fallecido_causa_autopsia'], 0, 'L', 0, 0, '55', '34', true);
		$pdf->MultiCell(175, 5, '2 Causa Anatomia(Autopsia).............................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................', 0, 'L', 0, 0, '13', '35', true);
	
		$pdf->line(15,60,190,60); 

		$pdf->setCellHeightRatio(0);

		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(180, 3, 'EN CASO DE QUE EL PACIENTE HAYA SIDO INTERVENIDO QUIRURGICAMENTE', 0, 'C', 0, 0, '10', '62', true);
		$pdf->SetFont('times', '', 10);

		$pdf->MultiCell(55, 5, '15.- Con fecha:', 0, 'L', 0, 0, '13', '72', true);

		$pdf->MultiCell(10, 7, '', 1, 'C', 0, 0, '40', '68', true);
		$pdf->MultiCell(10, 7, '', 1, 'C', 0, 0, '50', '68', true);
		$pdf->MultiCell(20, 7, '', 1, 'C', 0, 0, '60', '68', true);
		$pdf->MultiCell(11, 5, 'DIA', 0, 'C', 0, 0, '40', '77', true);
		$pdf->MultiCell(11, 5, 'MES', 0, 'C', 0, 0, '50', '77', true);
		$pdf->MultiCell(21, 5, 'AÑO', 0, 'C', 0, 0, '60', '77', true); 

		$pdf->MultiCell(135, 5, 'A horas:......................................... El paciente ha sido operado', 0, 'L', 0, 0, '88', '72', true);

		$pdf->MultiCell(135, 5, '17.- Cirujano Dr.:..................................................................................................................', 0, 'L', 0, 0, '13', '85', true);

		$pdf->MultiCell(55, 5, 'Clave:.........................................', 0, 'C', 0, 0, '135', '85', true);

		$pdf->MultiCell(175, 5, '18.- Tipo de anestesia:...............................................................................................................................................................', 0, 'L', 0, 0, '13', '92', true);

		$pdf->MultiCell(135, 5, '19.- Anasteseologo Dr.:.......................................................................................................', 0, 'L', 0, 0, '13', '99', true);

		$pdf->MultiCell(55, 5, 'Clave:............................................', 0, 'C', 0, 0, '135', '99', true);

		$pdf->MultiCell(155, 5, '3  Por el Técnico Anestesista:', 0, 'L', 0, 0, '22', '106', true);

		//********************************
		// MATERNIDAD
		//********************************
		$pdf->line(5,113,190,113); 

		// if($maternidad==null){

		$pdf->MultiCell(55, 5, '20.- Fecha de Parto:', 0, 'L', 0, 0, '13', '118', true);
		// $pdf->MultiCell(55, 5, date("d", strtotime($respuesta['fecha'])).'       '.date("m", strtotime($respuesta['fecha'])).'     '.date("Y", strtotime($respuesta['fecha'])), 0, 'L', 0, 0, '48', '135', true);

		$pdf->MultiCell(10, 7, '', 1, 'C', 0, 0, '45', '115', true);
		$pdf->MultiCell(10, 7, '', 1, 'C', 0, 0, '55', '115', true);
		$pdf->MultiCell(20, 7, '', 1, 'C', 0, 0, '65', '115', true);
		if(isset($maternidad['fecha_nacido'])) {
			$pdf->SetFont('times', 'B', 10);
			$pdf->MultiCell(10, 7, date("d", strtotime($maternidad['fecha_nacido'])), 0, 'C', 0, 0, '45', '117', true);
			$pdf->MultiCell(10, 7, date("m", strtotime($maternidad['fecha_nacido'])), 0, 'C', 0, 0, '55', '117', true);
			$pdf->MultiCell(20, 7, date("Y", strtotime($maternidad['fecha_nacido'])), 0, 'C', 0, 0, '65', '117', true);
			$pdf->SetFont('times', '', 10);
		}
		$pdf->MultiCell(11, 5, 'DIA', 0, 'C', 0, 0, '45', '124', true);
		$pdf->MultiCell(11, 5, 'MES', 0, 'C', 0, 0, '55', '124', true);
		$pdf->MultiCell(21, 5, 'AÑO', 0, 'C', 0, 0, '65', '124', true);

		if(isset($maternidad['hora_nacido'])) {
			$pdf->SetFont('times', 'B', 10);
			$pdf->MultiCell(55, 5, date("H:i", strtotime($maternidad['hora_nacido'])), 0, 'L', 0, 0, '105', '116', true);
			$pdf->SetFont('times', '', 10);
		}

		$pdf->MultiCell(55, 5, 'A horas  .............................', 0, 'L', 0, 0, '90', '118', true);

		// MARCA CON UNA X DEPENDIENDO AL TIPO DE PARTO
		if ($maternidad['tipo_parto'] == "EUTOCICO") {
			$pdf->MultiCell(5, 3, 'X', 0, 'C', 0, 0, '35', '135', true);
		} else if ($maternidad['tipo_parto'] == "DISTOCICO") {
			$pdf->MultiCell(5, 3, 'X', 0, 'C', 0, 0, '66', '135', true);
		} else if ($maternidad['tipo_parto'] == "CESAREA") {
			$pdf->MultiCell(5, 3, 'X', 0, 'C', 0, 0, '95', '135', true);
		} 
		// else if ($maternidad['tipo_parto'] == "EXTRACCION INSTRUMENTAL") {
		// 	$pdf->MultiCell(5, 3, 'X', 0, 'C', 0, 0, '158', '135', true);
		// } else if ($maternidad['tipo_parto'] == "CASERA") {
		// 	$pdf->MultiCell(5, 3, 'X', 0, 'C', 0, 0, '182', '135', true);
		// }

		$pdf->MultiCell(55, 5, '21.- Parto:', 0, 'L', 0, 0, '13', '129', true);
		$pdf->MultiCell(55, 5, 'Eutócico', 0, 'L', 0, 0, '', '135', true);
		$pdf->MultiCell(5, 5, '', 1, 'C', 0, 0, '35', '134', true);
		$pdf->MultiCell(55, 5, 'Distócico', 0, 'L', 0, 0, '47', '135', true);
		$pdf->MultiCell(5, 5, '', 1, 'C', 0, 0, '66', '134', true);
		$pdf->MultiCell(55, 5, 'Cesarea', 0, 'L', 0, 0, '78', '135', true);
		$pdf->MultiCell(5, 5, '', 1, 'C', 0, 0, '95', '134', true);
		// $pdf->MultiCell(55, 5, 'Extraccion Instrumental', 0, 'L', 0, 0, '120', '135', true);
		// $pdf->MultiCell(5, 5, '', 1, 'C', 0, 0, '158', '134', true);
		// $pdf->MultiCell(55, 5, 'Casera', 0, 'L', 0, 0, '170', '135', true);
		// $pdf->MultiCell(5, 5, '', 1, 'C', 0, 0, '182', '134', true);

		// MARCA CON UNA X DEPENDIENDO AL TIPO DE ABORTO
		if ($maternidad['tipo_aborto'] == "COMPLETO ESPONTANEO") {
			$pdf->MultiCell(5, 3, 'X', 0, 'C', 0, 0, '50', '147', true);
		} else if ($maternidad['tipo_aborto'] == "INCOMPLETO TRATAMIENTO INSTRUMENTAL") {
			$pdf->MultiCell(5, 3, 'X', 0, 'C', 0, 0, '120', '147', true);
		} else if ($maternidad['tipo_aborto'] == "AMENAZAS") {
			$pdf->MultiCell(5, 3, 'X', 0, 'C', 0, 0, '152', '147', true);
		} else if ($maternidad['tipo_aborto'] == "OTROS") {
			$pdf->MultiCell(5, 3, 'X', 0, 'C', 0, 0, '176', '147', true);
		} 

		$pdf->MultiCell(55, 5, '22.- Aborto:', 0, 'L', 0, 0, '13', '141', true);
		$pdf->MultiCell(55, 5, 'Completo Espontaneo', 0, 'L', 0, 0, '', '147', true);
		$pdf->MultiCell(5, 5, '', 1, 'C', 0, 0, '50', '146', true);
		$pdf->MultiCell(95, 5, ' Incompleto Tratamiento Instrumental ', 0, 'L', 0, 0, '62', '147', true);
		$pdf->MultiCell(5, 5, '', 1, 'C', 0, 0, '120', '146', true);
		$pdf->MultiCell(55, 5, ' Amenazas', 0, 'L', 0, 0, '132', '147', true);
		$pdf->MultiCell(5, 5, '', 1, 'C', 0, 0, '152', '146', true);
		$pdf->MultiCell(55, 5, 'Otros', 0, 'L', 0, 0, '164', '147', true);
		$pdf->MultiCell(5, 5, '', 1, 'C', 0, 0, '176', '146', true);

		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(75, 5, '23.- ENFERMEDAD OBSTETRICIA:', 0, 'L', 0, 0, '13', '155', true);
		$pdf->SetFont('times', '', 10);

		$pdf->setCellHeightRatio(2);

		if(isset($maternidad['edad_gestacional'])) {
			$pdf->SetFont('times', 'B', 10);
			$pdf->MultiCell(60, 5, number_format($maternidad['edad_gestacional'],2,",","").' SEMANAS', 0, 'L', 0, 0, '55', '156', true);
			$pdf->SetFont('times', '', 10);
		} else {
			$pdf->MultiCell(70, 5, '', 0, 'L', 0, 0, '50', '156', true);
		}

		$pdf->MultiCell(175, 5, '1   En Curso de Embarazo:.............................................................................................................................................................................................................................................................................................................................................................', 0, 'L', 0, 0, '13', '158', true);
		$pdf->MultiCell(175, 5, '2   Post - Partum:............................................................................................................................................................................................................................................................................................................................................................................', 0, 'L', 0, 0, '13', '172', true);

		$pdf->line(15,188,190,188);

		if(isset($maternidad['estado_nacido1']) || isset($maternidad['estado_nacido2']) || isset($maternidad['estado_nacido3'])) {
			$pdf->SetFont('times', 'B', 10);
			$pdf->MultiCell(150, 5, 'R.N.1 = '.$maternidad['estado_nacido1'].'     R.N.2 = '.$maternidad['estado_nacido2'].'     R.N.3 = '.$maternidad['estado_nacido3'], 0, 'L', 0, 0, '50', '188', true);
			$pdf->SetFont('times', '', 10);
		}		
		$pdf->MultiCell(175, 5, '24.- Estado al nacer:.......................................................................................................................................................................................................................................................................................................................................................................', 0, 'L', 0, 0, '13', '190', true);

		$pdf->setCellHeightRatio(1);

		$pdf->MultiCell(52, 2, 'NOTA:', 0, 'L', 0, 0, '3', '239', true);
		$pdf->MultiCell(195, 2, 'En los cuadritos numerados para fines de codificación marca con una (x) lo que corresponda.', 0, 'L', 0, 0, '15', '240', true);
		$pdf->MultiCell(195, 2, 'En las casillas Nos. 25, 26, 27, 28, 30 y 31 se debe anotar el número que corresponda a los recién nacidos.', 0, 'L', 0, 0, '15', '244', true);
		$pdf->MultiCell(195, 2, 'Mensualmente, junto con los ejemplares del Resumen Quincenal de Censo de Pacientes a horas "0" Form. EM 204 - A, deben ser remitidos a Estadística Nacional.', 0, 'L', 0, 0, '15', '248', true);
		$pdf->MultiCell(195, 2, 'El número de formularios remitidos deberá coincidir exactamente con el número de egresos consignados en el Form. EM 204 - A', 0, 'L', 0, 0, '15', '256', true);
		$pdf->MultiCell(125, 2, 'Lugar y Fecha: .......................................................................................', 0, 'L', 0, 0, '75', '263', true);

		$vivo_hombres = 0;
		$vivo_mujeres = 0;
		$muerto_hombres = 0;
		$muerto_mujeres = 0;

		if ($maternidad['sexo_nacido1'] == "MASCULINO") {
			if ($maternidad['estado_nacido1'] == "VIVO" || $maternidad['estado_nacido1'] == "VIVO DEPRIMIDO") {
				$vivo_hombres = $vivo_hombres + 1;
			} elseif ($maternidad['estado_nacido1'] == "MUERTO") {
				$muerto_hombres = $muerto_hombres + 1;
			} 
		} else {
			if ($maternidad['estado_nacido1'] == "VIVO" || $maternidad['estado_nacido1'] == "VIVO DEPRIMIDO") {
				$vivo_mujeres = $vivo_mujeres + 1;
			} elseif ($maternidad['estado_nacido1'] == "MUERTO") {
				$muerto_mujeres = $muerto_mujeres + 1;
			}
		}

		if ($maternidad['sexo_nacido2'] == "MASCULINO") {
			if ($maternidad['estado_nacido2'] == "VIVO" || $maternidad['estado_nacido2'] == "VIVO DEPRIMIDO") {
				$vivo_hombres = $vivo_hombres + 1;
			} elseif ($maternidad['estado_nacido2'] == "MUERTO") {
				$muerto_hombres = $muerto_hombres + 1;
			} 
		} else {
			if ($maternidad['estado_nacido2'] == "VIVO" || $maternidad['estado_nacido2'] == "VIVO DEPRIMIDO") {
				$vivo_mujeres = $vivo_mujeres + 1;
			} elseif ($maternidad['estado_nacido2'] == "MUERTO") {
				$muerto_mujeres = $muerto_mujeres + 1;
			}
		}

		if ($maternidad['sexo_nacido3'] == "MASCULINO") {
			if ($maternidad['estado_nacido3'] == "VIVO" || $maternidad['estado_nacido3'] == "VIVO DEPRIMIDO") {
				$vivo_hombres = $vivo_hombres + 1;
			} elseif ($maternidad['estado_nacido3'] == "MUERTO") {
				$muerto_hombres = $muerto_hombres + 1;
			} 
		} else {
			if ($maternidad['estado_nacido3'] == "VIVO" || $maternidad['estado_nacido3'] == "VIVO DEPRIMIDO") {
				$vivo_mujeres = $vivo_mujeres + 1;
			} elseif ($maternidad['estado_nacido3'] == "MUERTO") {
				$muerto_mujeres = $muerto_mujeres + 1;
			}
		}

		$pdf->setCellHeightRatio(2);

		if ($maternidad != null) {
			$pdf->MultiCell(20, 2, '25.- '.$vivo_hombres, 0, 'C', 0, 0, '46', '216', true);
			$pdf->MultiCell(20, 2, '27.- '.$muerto_hombres, 0, 'C', 0, 0, '46', '225', true);
			$pdf->MultiCell(20, 2, '26.- '.$vivo_mujeres, 0, 'C', 0, 0, '66', '216', true);
			$pdf->MultiCell(20, 2, '28.- '.$muerto_mujeres, 0, 'C', 0, 0, '66', '225', true);
		} else {
			$pdf->MultiCell(20, 2, '25.- ', 0, 'C', 0, 0, '46', '216', true);
			$pdf->MultiCell(20, 2, '27.- ', 0, 'C', 0, 0, '46', '225', true);
			$pdf->MultiCell(20, 2, '26.- ', 0, 'C', 0, 0, '66', '216', true);
			$pdf->MultiCell(20, 2, '28.- ', 0, 'C', 0, 0, '66', '225', true);
		}

	
		$pdf->MultiCell(30, 2, 'RECIEN NACIDO', 1, 'C', 0, 0, '16', '207', true);
		$pdf->MultiCell(20, 2, 'HOMBRE', 1, 'C', 0, 0, '46', '207', true);
		$pdf->MultiCell(20, 2, 'MUJER', 1, 'C', 0, 0, '66', '207', true);
		$pdf->MultiCell(30, 2, 'VIVOS', 1, 'C', 0, 0, '16', '216', true);
		$pdf->MultiCell(20, 2, '', 1, 'C', 0, 0, '46', '216', true);
		$pdf->MultiCell(20, 2, '', 1, 'C', 0, 0, '66', '216', true);
		$pdf->MultiCell(30, 2, 'MUERTOS', 1, 'C', 0, 0, '16', '225', true);
		$pdf->MultiCell(20, 2, '', 1, 'C', 0, 0, '46', '225', true);
		$pdf->MultiCell(20, 2, '', 1, 'C', 0, 0, '66', '225', true);

		$pdf->SetFont('times', 'B', 10);
		$pdf->MultiCell(52, 2, '29.- PESO AL NACER', 0, 'C', 0, 0, '88', '205', true);
		$pdf->SetFont('times', '', 10);

		$pdf->SetFont('times', 'B', 10);
		if(isset($maternidad['peso_nacido1'])) {
			$pdf->MultiCell(52, 2, number_format($maternidad['peso_nacido1'],2,",",""), 0, 'C', 0, 0, '85', '211', true);
		} else {
			$pdf->MultiCell(52, 2, '', 0, 'C', 0, 0, '85', '211', true);
		}
		if(isset($maternidad['peso_nacido2'])) {
			$pdf->MultiCell(52, 2, number_format($maternidad['peso_nacido2'],2,",",""), 0, 'C', 0, 0, '85', '218', true);
		} else {
			$pdf->MultiCell(52, 2, '', 0, 'C', 0, 0, '85', '218', true);
		}
		if(isset($maternidad['peso_nacido3'])) {
			$pdf->MultiCell(52, 2, number_format($maternidad['peso_nacido3'],2,",",""), 0, 'C', 0, 0, '85', '225', true);
		} else {
			$pdf->MultiCell(52, 2, '', 0, 'C', 0, 0, '85', '211', true);
		}
		$pdf->SetFont('times', '', 10);

		$pdf->MultiCell(52, 2, '...................................... Kgms.', 0, 'C', 0, 0, '87', '213', true);
		$pdf->MultiCell(52, 2, '...................................... Kgms.', 0, 'C', 0, 0, '87', '220', true);
		$pdf->MultiCell(52, 2, '...................................... Kgms.', 0, 'C', 0, 0, '87', '227', true);
	
		$pdf->setCellHeightRatio(1);
		$pdf->MultiCell(45, 2, 'CONDICION AL EGRESO AMBOS SEXOS', 1, 'C', 0, 0, '140', '207', true);

		$pdf->setCellHeightRatio(2);
		$pdf->MultiCell(45, 2, '30.- VIVOS Nº', 1, 'L', 0, 0, '140', '216', true);
		$pdf->MultiCell(45, 2, '31.- MUERTOS Nº', 1, 'L', 0, 0, '140', '225', true);

		if ($maternidad != null) {
			$pdf->MultiCell(35, 2, $vivo_hombres + $vivo_mujeres, 0, 'C', 0, 0, '157', '216', true);
			$pdf->MultiCell(35, 2, $muerto_hombres + $muerto_mujeres, 0, 'C', 0, 0, '157', '225', true);
		}

		// set border width
		$pdf->SetLineWidth(0.1);
		$pdf->line(5,239,205,239);

		// set border width
		$pdf->SetLineWidth(0.5);
		$pdf->line(5,240,205,240);

		$pdf->setCellHeightRatio(0);

		// set font
		$pdf->SetFont('times', 'B', 14);

		// Rotar Texto
		$pdf->StartTransform();
		$pdf->Rotate(-270);
		if ($maternidad != null) {			
			$pdf->MultiCell(100, 5, 'DATOS DE ALTA', 0, 'C', 0, 0, '310', '38', true);
			$pdf->MultiCell(125, 5, 'MATERNIDAD', 0, 'C', 0, 0, '180', '38', true);
		} else {
			$pdf->MultiCell(100, 5, 'DATOS DE ALTA', 0, 'C', 0, 0, '310', '45', true);
			$pdf->MultiCell(125, 5, 'MATERNIDAD', 0, 'C', 0, 0, '180', '45', true);
		}

		$pdf->StopTransform();

		$k = 23;
		$text = array('15','16','17','18','19','8 - 20','21','22','23','24','25','26','27','28','29','30','31');

		$pdf->SetFont('times', '', 10);		
		$pdf->MultiCell(18, 5, '14', 0, 'C', 0, 0, '189', '15', true);
		$pdf->SetFont('times', '', 8);

		for ($i = 0; $i < count($text); $i++) {

			$pdf->MultiCell(25, 5, '.....................', 0, 'L', 0, 0, '189', $k, true);
			$pdf->SetFont('times', '', 10);
			$pdf->MultiCell(18, 5, $text[$i], 0, 'C', 0, 0, '189', $k + 3, true);
			$pdf->SetFont('times', '', 8);

			$k = $k + 12;
		}



		$pdf->SetFont('times', 'I', 10);

		$pdf->MultiCell(90, 2, '..............................................................................................', 0, 'C', 0, 0, '10', '279', true);	
		$pdf->MultiCell(90, 2, 'FIRMA DEL JEFE DE FICHAJE (ESTADISTICA)',0, 'C', 0, 0, '10', '282', true);

		$pdf->MultiCell(90, 2, '..............................................................................................', 0, 'C', 0, 0, '110', '279', true);	
		$pdf->MultiCell(90, 2, 'NOMBRE Y APELLIDO COMPLETO',0, 'C', 0, 0, '110', '282', true);	

		//============================================================+
		// END OF FILE
		//============================================================+

		// $pdf->lastPage();
		//Close and output PDF document
		$pdf->output('../temp/form204-'.$paciente_ingreso['id'].'.pdf', 'F');

	}

	/*=============================================
	ELIMINADO REPORTE PDF GENERADO
	=============================================*/
	public $file;

	public function ajaxEliminarReportePDF()	{
		
		$file = $this->file;

		unlink($file);

	}

}

/*=============================================
MOSTRAR PACIENTE INGRESO
=============================================*/
if (isset($_POST["mostrarPacienteIngreso"])) {
				 
	$nuevoIngreso = new AjaxPacienteIngresos();
	$nuevoIngreso -> id = $_POST["id"];
	$nuevoIngreso -> ajaxMostrarPacienteIngreso();

}

/*=============================================
NUEVO PACIENTE INGRESO
=============================================*/
if (isset($_POST["nuevoPacienteIngreso"])) {
				 
	$nuevoPacienteIngreso = new AjaxPacienteIngresos();
	$nuevoPacienteIngreso -> id_establecimiento = $_POST["nuevoEstablecimiento"];
	$nuevoPacienteIngreso -> fecha_ingreso = $_POST['nuevoFechaIngreso'];
	$nuevoPacienteIngreso -> hora_ingreso = $_POST['nuevoHoraIngreso'];
	$nuevoPacienteIngreso -> id_servicio = $_POST['nuevoServicio'];
	$nuevoPacienteIngreso -> id_especialidad = $_POST['nuevoEspecialidad'];
	$nuevoPacienteIngreso -> id_sala = $_POST['nuevoSala'];
	$nuevoPacienteIngreso -> id_cama = $_POST['nuevoCama'];
	$nuevoPacienteIngreso -> id_consultorio = $_POST['nuevoConsultorio'];
	$nuevoPacienteIngreso -> id_medico = $_POST['nuevoMedicoTratante'];
	$nuevoPacienteIngreso -> id_cie10 = $_POST['nuevoDiagnosticoIngreso'];
	$nuevoPacienteIngreso -> diagnostico_especifico1 = $_POST['nuevoDiagnostico1'];
	$nuevoPacienteIngreso -> diagnostico_especifico2 = $_POST['nuevoDiagnostico2'];
	$nuevoPacienteIngreso -> diagnostico_especifico3 = $_POST['nuevoDiagnostico3'];
  $nuevoPacienteIngreso -> id_paciente = $_POST['nuevoIdPaciente'];	
	$nuevoPacienteIngreso -> ajaxNuevoPacienteIngreso();

}

/*=============================================
EDITAR PACIENTE INGRESO
=============================================*/
if (isset($_POST["editarPacienteIngreso"])) {

	$editarPacienteIngreso = new AjaxPacienteIngresos();
	$editarPacienteIngreso -> id_establecimiento = $_POST["editarEstablecimiento"];
	$editarPacienteIngreso -> fecha_ingreso = $_POST['editarFechaIngreso'];
	$editarPacienteIngreso -> hora_ingreso = $_POST['editarHoraIngreso'];
	$editarPacienteIngreso -> id_servicio = $_POST['editarServicio'];
	$editarPacienteIngreso -> id_especialidad = $_POST['editarEspecialidad'];
	$editarPacienteIngreso -> id_sala = $_POST['editarSala'];
	$editarPacienteIngreso -> id_cama = $_POST['editarCama'];
	$editarPacienteIngreso -> id_cama_ant = $_POST['editarCamaAnt'];	
	$editarPacienteIngreso -> id_consultorio = $_POST['editarConsultorio'];
	$editarPacienteIngreso -> id_medico = $_POST['editarMedicoTratante'];
	$editarPacienteIngreso -> id_cie10 = $_POST['editarDiagnosticoIngreso'];
	$editarPacienteIngreso -> diagnostico_especifico1 = $_POST['editarDiagnostico1'];
	$editarPacienteIngreso -> diagnostico_especifico2 = $_POST['editarDiagnostico2'];
	$editarPacienteIngreso -> diagnostico_especifico3 = $_POST['editarDiagnostico3'];
	$editarPacienteIngreso -> transferencia = $_POST['transferencia'];
  $editarPacienteIngreso -> id_paciente = $_POST['editarIdPaciente'];
  $editarPacienteIngreso -> id = $_POST['editarIdIngresoPaciente'];
	$editarPacienteIngreso -> ajaxEditarPacienteIngreso();

}

/*=============================================
VERIFICAR PACIENTE INGRESOS
=============================================*/
if (isset($_POST["verificarPacienteIngresos"])) {

	$verificarPacienteIngresos = new AjaxPacienteIngresos();
	$verificarPacienteIngresos -> id_paciente = $_POST["id_paciente"];
	$verificarPacienteIngresos -> ajaxVerificarPacienteIngresos();

}

if (isset($_POST["reporteForm204"])) {

	$reportePaciente = new AjaxPacienteIngresos();
	$reportePaciente -> id_paciente = $_POST["idPaciente"];
	$reportePaciente -> id = $_POST["idPacienteIngreso"];
	$reportePaciente -> ajaxReporteForm204();

}

/*=============================================
ELIMINAR EL PDF TEMPORAL DE RESULTADO COVID
=============================================*/
if (isset($_POST["eliminarPDF"])) {

	$reportes = new AjaxPacienteIngresos();
	$reportes -> file = $_POST["url"];
	$reportes -> ajaxEliminarReportePDF();

}
