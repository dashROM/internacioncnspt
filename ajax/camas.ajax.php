<?php

require_once "../controllers/camas.controller.php";
require_once "../models/camas.model.php";

class AjaxCamas{
	
	public $id;
	public $id_servicio;
	public $id_sala;
	public $nombre_cama;
	public $descripcion_cama;

	/*=============================================
	MOSTRAR CAMA
	=============================================*/
	public function ajaxMostrarCama()	{

		$item = "id";
		$valor = $this->id;

		$cama = ControllerCamas::ctrMostrarCama($item, $valor);
	
		echo json_encode($cama);	
			
	}

	/*=============================================
	MOSTRAR CAMAS
	=============================================*/
	public function ajaxMostrarCamas()	{

		$item = "id";
		$valor = $this->id;

		$cama = ControllerCamas::ctrMostrarCamas($item, $valor);
	
		echo json_encode($cama);	
			
	}

	/*=============================================
	MOSTRAR SALA CAMAS
	=============================================*/
	public function ajaxMostrarSalaCamas()	{

		$item = "id_sala";
		$valor = $this->id_sala;

		$cama = ControllerCamas::ctrMostrarSalaCamas($item, $valor);
	
		echo json_encode($cama);
			
	}

	/*=============================================
	REGISTRO NUEVA CAMA
	=============================================*/
  public function ajaxNuevaCama()	{

		$datos = array("nombre_cama"    		 => mb_strtoupper($this->nombre_cama,'utf-8'),
			             "descripcion_cama"    => mb_strtoupper($this->descripcion_cama,'utf-8'), 
			             "id_sala"             => $this->id_sala,	
		);	
	
		$respuesta = ControllerCamas::ctrNuevaCama($datos);
	
		echo json_encode($respuesta);

	}

	/*=============================================
	REGISTRO EDITAR CAMA
	=============================================*/
  public function ajaxEditarCama()	{

		$datos = array("nombre_cama"    		 => mb_strtoupper($this->nombre_cama,'utf-8'),
			             "descripcion_cama"    => mb_strtoupper($this->descripcion_cama,'utf-8'),
			             "id_servicio"         => $this->id_servicio,
			             "id_sala"             => $this->id_sala,
			             "id"             		 => $this->id,
		);	
	
		$respuesta = ControllerCamas::ctrEditarCama($datos);
	
		echo json_encode($respuesta);

	}

}

/*=============================================
MOSTRAR CAMA
=============================================*/
if (isset($_POST["mostrarCama"])) {
				 
	$nuevoCama = new AjaxCamas();
	$nuevoCama -> id = $_POST["idCama"];
	$nuevoCama -> ajaxMostrarCama();

}

/*=============================================
MOSTRAR CAMAS
=============================================*/
if (isset($_POST["mostrarCamas"])) {
				 
	$nuevoCama = new AjaxCamas();
	$nuevoCama -> id = $_POST["idCama"];
	$nuevoCama -> ajaxMostrarCamas();

}

/*=============================================
MOSTRAR SALA CAMAS
=============================================*/
if (isset($_POST["mostrarSalaCamas"])) {
				 
	$nuevoCama = new AjaxCamas();
	$nuevoCama -> id_sala = $_POST["idSala"];
	$nuevoCama -> ajaxMostrarSalaCamas();

}

/*=============================================
REGISTRO NUEVA CAMA
=============================================*/
if (isset($_POST["nuevaCama"])) {
				 
	$nuevoCama = new AjaxCamas();
	$nuevoCama -> nombre_cama = $_POST['nuevoNombreCama'];
	$nuevoCama -> descripcion_cama = $_POST["nuevoDescripcionCama"];
  $nuevoCama -> id_sala = $_POST['idSala'];
	$nuevoCama -> ajaxNuevaCama();

}

/*=============================================
REGISTRO EDITAR CAMA
=============================================*/
if (isset($_POST["editarCama"])) {
				 
	$nuevoCama = new AjaxCamas();
	$nuevoCama -> nombre_cama = $_POST['editarNombreCama'];
	$nuevoCama -> descripcion_cama = $_POST["editarDescripcionCama"];
	$nuevoCama -> id_servicio = $_POST["editarServicioDS"];
	$nuevoCama -> id_sala = $_POST["editarSalaDS"];
  $nuevoCama -> id = $_POST['editarIdCama'];
	$nuevoCama -> ajaxEditarCama();

}