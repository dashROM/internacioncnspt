<?php

require_once "../controllers/altas.controller.php";
require_once "../models/altas.model.php";

class AjaxAltas{

    public $fecha;
	public $hora;
	public $diagnosticoegreso;
	public $causaegreso;
	public $condicionegreso;
	public $idpersonalmedico;
    public $idaltas;
	public $idpaciente;
	public $idingreso;
	public $fallecido;

	public function ajaxMostrarAltas()	{

		$item = "idaltas";
		$valor = $this->idaltas;

		$altas= ControllerAltas::ctrMostrarAltas($item, $valor);
	
		echo json_encode($altas);	
			
	}
    public function ajaxNuevoAltas()	{
		if($this->causaegreso=="Muerte Institucional"||$this->causaegreso=="Muerte No Institucional"){
			$fallecido=1;
		}else{
			$fallecido=0;
		}

		$datos = array("fecha"    => mb_strtoupper($this->fecha,'utf-8'), 
		"hora"	  => mb_strtoupper($this->hora,'utf-8'),
		"diagnosticoegreso"     => mb_strtoupper($this->diagnosticoegreso,'utf-8'),  
		"causaegreso"     	=> $this->causaegreso,
		"condicionegreso"  	      => $this->condicionegreso,
        "idpersonalmedico" =>  $this->idpersonalmedico,
		"causaclinica" =>  $this->causaclinica,
		"causaautopsia" =>  $this->causaautopsia,
		"idpaciente" => $this->idpaciente,
		"idingreso" =>$this->idingreso,
		"fallecido"=>1,
		);
		
		// var_dump($datos);
	
		$respuesta = ControllerAltas::ctrNuevoAltas($datos);
		
	
		echo $respuesta;
			
	} 
	public function ajaxEditarAltas() {


		$datos = array("fecha"    => mb_strtoupper($this->fecha,'utf-8'), 
		"hora"	  => $this->hora,
		"diagnosticoegreso"     => $this->diagnosticoegreso,  
		"causaegreso"     	=> $this->causaegreso,
		"condicionegreso"  	      => $this->condicionegreso,
		"idpersonalmedico"  	      => $this->idpersonalmedico,
		"idaltas"  => $this->idaltas,
		

		);	
		
		$respuesta = ControllerAltas::ctrEditarAltas($datos);
		
		echo $respuesta;
		
		}	
	
    
}
/*=============================================
MOSTRAR PACIENTE
=============================================*/
if (isset($_POST["mostrarAlta"])) {
				 
	$nuevoAlta = new AjaxAltas();
	$nuevoAlta -> idaltas = $_POST["idaltas"];
	$nuevoAlta -> ajaxMostrarAltas();

}
/*=============================================
NUEVO PACIENTE
=============================================*/
if (isset($_POST["nuevoAlta"])) {
				 
	$nuevoAlta = new AjaxAltas;
	$nuevoAlta -> fecha = $_POST["fecha"];
	$nuevoAlta -> hora = $_POST['hora'];
	$nuevoAlta -> diagnosticoegreso = $_POST['diagnosticoegreso'];
	if(isset($_POST["condicionegreso"])){
		$nuevoAlta -> condicionegreso = $_POST['condicionegreso'];
		
	} else {
		$nuevoAlta -> condicionegreso = '';
	}
	$nuevoAlta -> causaegreso = $_POST['causaegreso'];
    $nuevoAlta -> idpersonalmedico =$_POST['idpersonalmedico'];
	
	if(isset($_POST["causaclinica"])){
		$nuevoAlta -> causaclinica = $_POST['causaclinica'];		
	} else {
		$nuevoAlta -> causaclinica = '';
	}
	if(isset($_POST["causaautopsia"])){
		$nuevoAlta -> causaautopsia =$_POST['causaautopsia'];
		
	} else {
		$nuevoAlta ->  causaautopsia = '';
	}	
	

	$nuevoAlta -> idpaciente =$_POST['idpacientealta'];
	$nuevoAlta -> idingreso =$_POST['idingresopaciente'];
	

	$nuevoAlta -> ajaxNuevoAltas();

}   
/*=============================================
EDITAR PACIENTE
=============================================*/
if (isset($_POST["editarAltas"])) {

	$editarAltas = new AjaxAltas();
	$editarAltas -> fecha = $_POST["fecha"];
	$editarAltas -> hora = $_POST['hora'];
	$editarAltas -> diagnosticoegreso = $_POST['diagnosticoegreso'];
	$editarAltas -> causaegreso = $_POST['causaegreso'];
	$editarAltas -> condicionegreso = $_POST['condicionegreso'];
	$editarAltas -> idpersonalmedico = $_POST['idpersonalmedico'];
	$editarAltas -> idaltas = $_POST["idaltas"];

	$editarAltas -> ajaxEditarAltas();
}
