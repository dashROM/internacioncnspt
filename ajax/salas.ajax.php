<?php

require_once "../controllers/salas.controller.php";
require_once "../models/salas.model.php";

class AjaxSalas{

	public $id;
	public $nombre_sala;
  public $descripcion_sala;
	public $id_servicio;

	/*=============================================
	MOSTRAR SALAS
	=============================================*/
	public function ajaxMostrarSalas()	{

		$item = "id";
		$valor = $this->id;

		$sala = ControllerSalas::ctrMostrarSalas($item, $valor);
	
		echo json_encode($sala);	
			
	}

	/*=============================================
	MOSTRAR SERVICIO SALAS
	=============================================*/
	public function ajaxMostrarServicioSalas()	{

		$item = "id_servicio";
		$valor = $this->id_servicio;

		$sala = ControllerSalas::ctrMostrarSalas($item, $valor);
	
		echo json_encode($sala);	
			
	}
   
	/*=============================================
	REGISTRAR NUEVA SALA
	=============================================*/
  public function ajaxNuevoSalas()	{

		$datos = array("nombre_sala"       => mb_strtoupper($this->nombre_sala,'utf-8'),
									 "descripcion_sala"  => mb_strtoupper($this->descripcion_sala,'utf-8'), 
    							 "id_servicio"       => $this->id_servicio,
	
		);	
	
	  $respuesta = ControllerSalas::ctrNuevoSalas($datos);

	  echo json_encode($respuesta);
			
	}

} 

/*=============================================
MOSTRAR SALAS
=============================================*/
if (isset($_POST["mostrarSalas"])) {
				 
	$nuevoSala = new AjaxSalas();
	$nuevoSala -> id = $_POST["idSala"];
	$nuevoSala -> ajaxMostrarSalas();

}

/*=============================================
MOSTRAR SERVICIO SALAS
=============================================*/
if (isset($_POST["mostrarServicioSalas"])) {
				 
	$nuevoSala = new AjaxSalas();
	$nuevoSala -> id_servicio = $_POST["idServicio"];
	$nuevoSala -> ajaxMostrarServicioSalas();

}

/*=============================================
REGISTRAR NUEVA SALA
=============================================*/
if (isset($_POST["nuevaSala"])) {
				 
	$nuevoSala = new AjaxSalas();
	
	$nuevoSala -> nombre_sala = $_POST["nuevoNombreSala"];
	$nuevoSala -> descripcion_sala = $_POST["nuevoDescripcionSala"];
  $nuevoSala -> id_servicio = $_POST['idServicio'];

	$nuevoSala -> ajaxNuevoSalas();

}