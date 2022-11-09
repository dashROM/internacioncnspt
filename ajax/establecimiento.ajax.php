<?php

require_once "../controllers/establecimiento.controller.php";
require_once "../models/establecimiento.model.php";
class AjaxEstablecimiento{
	public $idestablecimiento;
    public $nombre_establecimiento;
	public $abrev_establecimiento;
	public $ubicacion_establecimiento;
    // public $idingreso;
	// public $idpaciente;
   

	public function ajaxMostrarEstablecimiento()	{

		$item = "idestablecimiento";
		$valor = $this->idestablecimiento;

		$establecimiento = ControllerEstablecimiento::ctrMostrarEstablecimiento($item, $valor);
	
		echo json_encode($establecimiento);	
			
	}
    public function ajaxNuevoEstablecimiento()	{

		$datos = array("nombre_establecimiento"    => mb_strtoupper($this->nombre_establecimiento,'utf-8'), 
		"abrev_establecimiento"	  => mb_strtoupper($this->abrev_establecimiento,'utf-8'),
		"ubicacion_establecimiento"     => mb_strtoupper($this->ubicacion_establecimiento,'utf-8'),  
		);	
	
		  $respuesta = ControllerEstablecimiento::ctrNuevoEstablecimiento($datos);
	
		  echo $respuesta;
	
			
	}
	public function ajaxEditarEstablecimiento() {


		$datos = array("nombre_establecimiento"    => mb_strtoupper($this->nombre_establecimiento,'utf-8'), 
		"abrev_establecimiento"	  => mb_strtoupper($this->abrev_establecimiento,'utf-8'),
		"ubicacion_establecimiento"     => mb_strtoupper($this->ubicacion_establecimiento,'utf-8'),  
        
		"idestablecimiento" => $this->idestablecimiento,
		);		
		
		$respuesta = ControllerEstablecimiento::ctrEditarEstablecimiento($datos);
		
		echo $respuesta;
		
		}	

}
/*=============================================
MOSTRAR PACIENTE
=============================================*/
if (isset($_POST["mostrarEstablecimiento"])) {
				 
	$nuevoEstablecimiento = new AjaxEstablecimiento();
	$nuevoEstablecimiento -> idestablecimiento = $_POST["idestablecimiento"];
	$nuevoEstablecimiento -> ajaxMostrarEstablecimiento();

}
/*=============================================
NUEVO PACIENTE
=============================================*/
if (isset($_POST["nuevoEstablecimiento"])) {
				 
	$nuevoEstablecimiento = new AjaxEstablecimiento();
	$nuevoEstablecimiento -> nombre_establecimiento = $_POST["nombre_establecimiento"];
	$nuevoEstablecimiento -> abrev_establecimiento = $_POST['abrev_establecimiento'];
	$nuevoEstablecimiento -> ubicacion_establecimiento = $_POST['ubicacion_establecimiento'];

	$nuevoEstablecimiento -> ajaxNuevoEstablecimiento();

}
/*=============================================
EDITAR PACIENTE
=============================================*/
if (isset($_POST["editarEstablecimiento"])) {

	$editarEstablecimiento = new AjaxEstablecimiento();
	$editarEstablecimiento -> nombre_establecimiento = $_POST["nombre_establecimiento"];
	$editarEstablecimiento -> abrev_establecimiento = $_POST['abrev_establecimiento'];
	$editarEstablecimiento -> ubicacion_establecimiento = $_POST['ubicacion_establecimiento'];

	$editarEstablecimiento -> idestablecimiento = $_POST["idestablecimiento"];

	$editarEstablecimiento -> ajaxEditarEstablecimiento();
}
