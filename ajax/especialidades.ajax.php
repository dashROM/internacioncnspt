<?php

require_once "../controllers/especialidades.controller.php";
require_once "../models/especialidades.model.php";

class AjaxEspecialidades{

	public $id;
	public $id_servicio;

	/*=============================================
	MOSTRAR SERVICIO ESPECIALIDADES
	=============================================*/
	public function ajaxMostrarServicioEspecialidades()	{

		$item1 = "id_servicio";
		$valor1 = $this->id_servicio;

		$item2 = "id";
		$valor2 = $this->id;

		$especialidad = ControllerEspecialidades::ctrMostrarServicioEspecialidades($item1, $valor1, $item2, $valor2);
	
		echo json_encode($especialidad);
			
	}

} 


/*=============================================
MOSTRAR SERVICIO ESPECIALIDADES
=============================================*/
if (isset($_POST["mostrarServicioEspecialidades"])) {
				 
	$nuevoEspecialidad = new AjaxEspecialidades();
	$nuevoEspecialidad -> id_servicio = $_POST["idServicio"];

	if (isset($_POST["idEspecialidad"])) {
		$nuevoEspecialidad -> id = $_POST["idEspecialidad"];
	} else {
		$nuevoEspecialidad -> id = null;
	}
	$nuevoEspecialidad -> ajaxMostrarServicioEspecialidades();

}