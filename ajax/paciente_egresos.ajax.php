<?php

require_once "../controllers/paciente_egresos.controller.php";
require_once "../models/paciente_egresos.model.php";

require_once "../library/tcpdf/tcpdf.php";

class MYPDF extends TCPDF {

	public $id_paciente_ingreso;
	public $nombre_completo;
	public $documento_ci;
	public $cod_asegurado;
	public $fecha_ingreso;
	public $fecha_egreso;

	//Page header
  public function Header() {
    // Set font
    $this->SetFont('helvetica', 'B', 10);
  	// Titul
  	//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
    $this->MultiCell(100, 3, 'CAJA NACIONAL DE SALUD',0 , 'L', 0, 0, '25', '5', true);
    // $this->Cell(0, 0, 'CAJA NACIONAL DE SALUD', 0, 1, 'C', 0, '', 1);

    $this->SetFont('helvetica', 'B', 8);
    // Subtitulo
    $this->MultiCell(100, 3, 'REGIONAL POTOSI',0 , 'L', 0, 0, '25', '10', true);
    // $this->Cell(0, 8, 'REGIONAL POTOSI', 0, 1, 'C', 0, '', 1);
    $this->MultiCell(100, 3, 'HOSPITAL OBRERO Nº5',0 , 'L', 0, 0, '102', '5', true);
    $this->MultiCell(100, 3, 'DIRECCION: AV. DEL MAESTRO S/N',0 , 'L', 0, 0, '102', '10', true);

    // set border width
		$this->SetLineWidth(0.05);

		// set color for cell border
		$this->SetDrawColor(0,0,0);

		// set filling color
		$this->SetFillColor(0,0,0);

		// set cell height ratio
		$this->setCellHeightRatio(0.025);

    $this->line(10,25,205,25);

    // set border width
		$this->SetLineWidth(0.3);

    $this->line(80,22,80,5);
      
    // Logo
    $image_file = K_PATH_IMAGES.'cns-logo-actual.jpg';
    // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
    $this->Image($image_file, 10, 5, 12, '', 'JPG', '', 'T', false, 100, '', false, false, 0, false, false, false);

     // Logo Hospital
    $image_file2 = K_PATH_IMAGES.'hospital.png';
    // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)
    $this->Image($image_file2, 87, 5, 12, '', 'PNG', '', 'T', false, 100, '', false, false, 0, false, false, false);

    // Estilos necesarios para el Codigo QR
		$style = array(
		    'border' => 0,
		    'vpadding' => 'auto',
		    'hpadding' => 'auto',
		    'fgcolor' => array(0,0,0),
		    'bgcolor' => false, //array(255,255,255)
		    'module_width' => 1, // width of a single module in points
		    'module_height' => 1 // height of a single module in points
		);

		//	Datos a mostrar en el código QR
		$codeContents = "NOMBRE Y APELLIDO: ".$this->nombre_completo."\nC.I.: ".$this->documento_ci."\nCOD. ASEGURADO: ".$this->cod_asegurado."\nFECHA INGRESO: ".date("d/m/Y", strtotime($this->fecha_ingreso))."\nFECHA EGRESO: ".date("d/m/Y", strtotime($this->fecha_egreso));

		// insertando el código QR
		$this->write2DBarcode($codeContents, 'QRCODE,L', 180, 3, 50, 50, $style, 'N');
  }

  // Page footer
  public function Footer() {
      // Position at 15 mm from bottom
      $this->SetY(-15);
      // Set font
      $this->SetFont('helvetica', 'I', 8);
      // Page number
      // $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
  }

}

class AjaxPacienteEgresos {

  public $id;
	public $fecha_egreso;
	public $hora_egreso;
	public $id_cie10;
	public $diagnostico_egreso1;
	public $diagnostico_egreso2;
	public $diagnostico_egreso3;
	public $causa_egreso;
	public $condicion_egreso;
	public $fallecido;
	public $fallecido_causa_clinica;
	public $fallecido_causa_autopsia;
	public $contrareferencia;
	public $id_paciente_ingreso;
	public $id_cama;

	/*=============================================
	MOSTRAR DATOS DE PACIENTE EGRESO
	=============================================*/
	public function ajaxMostrarPacienteEgreso() {

		if (isset($this->id_paciente_ingreso)) {
			$item = "id_paciente_ingreso";
			$valor = $this->id_paciente_ingreso;
		} else {
			$item = "id";
			$valor = $this->id;
		}

		$respuesta= ControllerPacienteEgresos::ctrMostrarPacienteEgreso($item, $valor);
	
		echo json_encode($respuesta);	
			
	}

	/*=============================================
	REGISTRAR PACIENTE EGRESO
	=============================================*/
  public function ajaxNuevoPacienteEgreso()	{

		$datos = array("fecha_egreso"	       			=> $this->fecha_egreso,
		               "hora_egreso"         			=> $this->hora_egreso,
		               "id_cie10"  	     		 			=> $this->id_cie10,
		               "diagnostico_egreso1"  	  => mb_strtoupper($this->diagnostico_egreso1, 'utf-8'),
		               "diagnostico_egreso2"  		=> mb_strtoupper($this->diagnostico_egreso2, 'utf-8'),
		               "diagnostico_egreso3"  	  => mb_strtoupper($this->diagnostico_egreso3, 'utf-8'),
		               "causa_egreso"        			=> $this->causa_egreso,
		               "condicion_egreso"    			=> $this->condicion_egreso,
		               "fallecido"					 			=> $this->fallecido,
		               "fallecido_causa_clinica"  => $this->fallecido_causa_clinica,
		               "fallecido_causa_autopsia" => $this->fallecido_causa_autopsia,
		               "contrareferencia"					=> $this->contrareferencia,
		               "id_paciente_ingreso" 			=> $this->id_paciente_ingreso,
		               "id_cama" 									=> $this->id_cama
		);
	
	  $respuesta = ControllerPacienteEgresos::ctrNuevoPacienteEgreso($datos);

	  echo json_encode($respuesta);
	
	}

	/*=============================================
	GENERAR CERTIFICADO EGRESO PACIENTE (ALTA) EN PDF
	=============================================*/
	public function ajaxReporteEgresoPacientePDF()	{

		/*=============================================
	  TRAEMOS LOS DATOS DE PACIENTE
	  =============================================*/
		$item = "id_paciente_ingreso";
		$valor = $this->id_paciente_ingreso;

		$paciente = ControllerPacienteEgresos::ctrReporteAltaHospitalaria($item, $valor);

		// create new PDF document
		// Extend the TCPDF class to create custom Header and Footer
		$pdf = new MYPDF('P', 'mm', array(215.9, 279.4), true, 'UTF-8', false);

		// set document information
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('CNS');
		$pdf->SetTitle('Certificado Egreso Paciente');
		$pdf->SetSubject('Egreso Paciente');
		$pdf->SetKeywords('CNS, CNS Potosí, Certificado, Egreso, HO5');

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
		$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		    require_once(dirname(__FILE__).'/lang/eng.php');
		    $pdf->setLanguageArray($l);
		}

		// Envio datos al encabezado
		$pdf->nombre_completo = $paciente['nombre_paciente'].' '.$paciente['paterno_paciente'].' '.$paciente['materno_paciente'];
		$pdf->documento_ci = $paciente['documento_ci'];
		$pdf->cod_asegurado = $paciente['cod_asegurado'];
		$pdf->fecha_ingreso = $paciente['fecha_ingreso'];
		$pdf->fecha_egreso = $paciente['fecha_egreso'];

		// ---------------------------------------------------------

		// set font
		$pdf->SetFont('times', 'B', 16);

		// add a page
		$pdf->AddPage();

		// set some text to print
		$txt = "ALTA HOSPITALARIA";

		// print a block of text using Write()
		$pdf->MultiCell(180, 3, 'ALTA HOSPITALARIA', 0, 'C', 0, 0, '15', '32', true);

		$pdf->SetFont('times', '', 12);

		// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

		$pdf->SetFont('times', 'B', 12);

		$pdf->MultiCell(180, 3, 'DATOS PERSONALES', 1, 'L', 0, 0, '15', '44', true);

		$pdf->SetFont('times', '', 12);

		$pdf->MultiCell(180, 3, 'NOMBRE DEL PACIENTE: '.$paciente['nombre_paciente'].' '.$paciente['paterno_paciente'].' '.$paciente['materno_paciente'], 0, 'L', 0, 0, '15', '52', true);
		$pdf->MultiCell(180, 3, 'FECHA DE NACIMIENTO: '.$paciente['fecha_nacimiento'], 0, 'L', 0, 0, '15', '60', true);
		$pdf->MultiCell(180, 3, 'DOMICILIO: '.$paciente['domicilio'], 0, 'L', 0, 0, '110', '60', true);
		
		$pdf->SetFont('times', 'B', 12);

		$pdf->MultiCell(180, 3, 'DATOS ASEGURADO', 1, 'L', 0, 0, '15', '70', true);

		$pdf->SetFont('times', '', 12);
		
		$pdf->MultiCell(90, 3, 'COD. ASEGURADO: '.$paciente['cod_asegurado'], 0, 'L', 0, 0, '15', '78', true);
		$pdf->MultiCell(90, 3, 'NRO. PATRONAL: '.$paciente['nro_empleador'], 0, 'L', 0, 0, '110', '78', true);
		$pdf->MultiCell(180, 6, 'RAZON SOCIAL: '.$paciente['nombre_empleador'], 0, 'L', 0, 0, '15', '86', true);

		$pdf->SetFont('times', 'B', 12);

		$pdf->MultiCell(180, 3, 'DATOS INTERNACIÓN HOSPITAL', 1, 'L', 0, 0, '15', '100', true);

		$pdf->SetFont('times', '', 12);
		
		$pdf->MultiCell(90, 3, 'FECHA DE INGRESO: '.date("d/m/Y", strtotime($paciente['fecha_ingreso'])), 0, 'L', 0, 1, '15', '108', true);
		$pdf->MultiCell(90, 3, 
			'FECHA DE EGRESO: '.date("d/m/Y", strtotime($paciente['fecha_egreso'])), 0, 'L', 0, 0, '110', '108', true);
		$pdf->MultiCell(180, 3, 'DIAGNOSTICO INGRESO: '.$paciente['diagnostico_especifico1'].' - '.$paciente['diagnostico_especifico2'].' - '.$paciente['diagnostico_especifico3'], 0, 'L', 0, 0, '15', '116', true);
		$pdf->MultiCell(180, 6, 'SERVICIO INGRESO: '.$paciente['nombre_servicio'], 0, 'L', 0, 0, '15', '132', true);
		$pdf->MultiCell(180, 3, 'DIAGNOSTICO EGRESO: '.$paciente['diagnostico_egreso1'].' - '.$paciente['diagnostico_egreso2'].' - '.$paciente['diagnostico_egreso3'], 0, 'L', 0, 0, '15', '140', true);
		$pdf->MultiCell(180, 6, 'CONDICION EGRESO: '.$paciente['condicion_egreso'], 0, 'L', 0, 0, '15', '156', true);
		$pdf->MultiCell(180, 3, 'CAUSA EGRESO: '.$paciente['causa_egreso'], 0, 'L', 0, 0, '15', '164', true);
		$pdf->MultiCell(180, 3, 'MÉDICO AUTORIZÓ EGRESO', 0, 'L', 0, 0, '15', '172', true);

		$pdf->MultiCell(70, 3, '.......................................................', 0, 'L', 0, 0, '35', '199', true);
		$pdf->MultiCell(70, 3, 'Firma Familiar Responsable', 0, 'L', 0, 0, '40', '204', true);

		$pdf->MultiCell(70, 3, '....................................................', 0, 'L', 0, 0, '120', '199', true);
		$pdf->MultiCell(70, 3, 'Firma Paciente', 0, 'L', 0, 0, '135', '204', true);
		
		// ---------------------------------------------------------

		//Close and output PDF document
		$pdf->Output('../temp/egreso-'.$paciente['id_paciente_ingreso'].'.pdf', 'F');

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
MOSTRAR PACIENTE EGRESO
=============================================*/
if (isset($_POST["mostrarPacienteEgreso"])) {
				 
	$pacienteEgreso = new AjaxPacienteEgresos();

	if (isset($_POST["idPacienteIngreso"])) {
		$pacienteEgreso -> id_paciente_ingreso = $_POST["idPacienteIngreso"];
	} else {
		$pacienteEgreso -> id = $_POST["id"];
	}

	$pacienteEgreso -> ajaxMostrarPacienteEgreso();

}

/*=============================================
REGISTRAR PACIENTE EGRESO (ALTA PACIENTE)
=============================================*/
if (isset($_POST["nuevoPacienteEgreso"])) {
				 
	$nuevoPacienteEgreso = new AjaxPacienteEgresos();
	$nuevoPacienteEgreso -> fecha_egreso = $_POST['nuevoFechaEgreso'];
	$nuevoPacienteEgreso -> hora_egreso = $_POST['nuevoHoraEgreso'];
	$nuevoPacienteEgreso -> id_cie10 = $_POST['nuevoDiagnosticoEgreso'];
	$nuevoPacienteEgreso -> diagnostico_egreso1 = $_POST['nuevoDiagnosticoEgreso1'];
	$nuevoPacienteEgreso -> diagnostico_egreso2 = $_POST['nuevoDiagnosticoEgreso2'];
	$nuevoPacienteEgreso -> diagnostico_egreso3 = $_POST['nuevoDiagnosticoEgreso3'];
	$nuevoPacienteEgreso -> causa_egreso = $_POST['nuevoCausaEgreso'];
	$nuevoPacienteEgreso -> condicion_egreso = $_POST['nuevoCondicionEgreso'];
	$nuevoPacienteEgreso -> fallecido_causa_clinica = $_POST['nuevoCausaClinica'];
	$nuevoPacienteEgreso -> fallecido_causa_autopsia = $_POST['nuevoCausaAutopsia'];
	
	if($_POST['nuevoCausaClinica'] != "" || $_POST['nuevoCausaAutopsia'] != "") {
		$nuevoPacienteEgreso -> fallecido = 1;
	} else {
		$nuevoPacienteEgreso -> fallecido = 0;
	}

	if (isset($_POST['nuevoContrareferencia'])) {
		if ($_POST['nuevoContrareferencia'] == "on") {
			$nuevoPacienteEgreso -> contrareferencia = 1;
		} else {
			$nuevoPacienteEgreso -> contrareferencia = 0;
		}
	} else {
		$nuevoPacienteEgreso -> contrareferencia = 0;
	}

  $nuevoPacienteEgreso -> id_paciente_ingreso = $_POST['nuevoIdPacienteIngreso'];
  $nuevoPacienteEgreso -> id_cama = $_POST['nuevoIdCama'];
	$nuevoPacienteEgreso -> ajaxNuevoPacienteEgreso();

}

/*=============================================
GENERAR CERTIFICADO EGRESO PACIENTE (ALTA) EN PDF 
=============================================*/
if (isset($_POST["reporteEgresoPaciente"])) {

	$reporteEgresoPaciente = new AjaxPacienteEgresos();
	$reporteEgresoPaciente -> id_paciente_ingreso = $_POST["idPacienteIngreso"];
	$reporteEgresoPaciente -> ajaxReporteEgresoPacientePDF();

}

/*=============================================
ELIMINAR EL PDF TEMPORAL DE RESULTADO COVID
=============================================*/
if (isset($_POST["eliminarPDF"])) {

	$reportes = new AjaxPacienteEgresos();
	$reportes -> file = $_POST["url"];
	$reportes -> ajaxEliminarReportePDF();

}