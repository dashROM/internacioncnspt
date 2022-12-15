<?php

require_once "../controllers/medicos.controller.php";
require_once "../models/medicos.model.php";
class AjaxMedicos{
	
	public $id;
	public $prefijo_medico;
	public $id_especialidad;
  public $nombre_medico;
	public $paterno_medico;
  public $materno_medico;
  public $matricula_medico;
  public $direccion_medico;
  public $telefono_medico;


	public function ajaxMostrarMedico()	{

		$item = "id";
		$valor = $this->id;

		$respuesta = ControllerMedicos::ctrMostrarMedicos($item, $valor);
	
		echo json_encode($respuesta);	
			
	}

  /*=============================================
	REGISTRO DE NUEVO MEDICO
	=============================================*/
  public function ajaxNuevoMedico()	{

		$datos = array("prefijo_medico"    		=> $this->prefijo_medico,
									 "id_especialidad"  		=> $this->id_especialidad, 
			             "paterno_medico"    		=> mb_strtoupper($this->paterno_medico,'utf-8'), 
                   "materno_medico"    		=> mb_strtoupper($this->materno_medico,'utf-8'),
                   "nombre_medico"     		=> mb_strtoupper($this->nombre_medico,'utf-8'),
                   "matricula_medico"  		=> mb_strtoupper($this->matricula_medico,'utf-8'),
                   "direccion_medico"  		=> mb_strtoupper($this->direccion_medico,'utf-8'),
                   "telefono_medico"   		=> $this->telefono_medico	
		);	
	
	  $respuesta = ControllerMedicos::ctrNuevoMedico($datos);

	  echo json_encode($respuesta);
			
	}

	/*=============================================
	EDITAR MEDICO
	=============================================*/

 	public function ajaxEditarMedico() {

		$datos = array("prefijo_medico"    		=> $this->prefijo_medico,
									 "id_especialidad"  		=> $this->id_especialidad,
			             "paterno_medico"    		=> mb_strtoupper($this->paterno_medico,'utf-8'), 
                   "materno_medico"    		=> mb_strtoupper($this->materno_medico,'utf-8'),
                   "nombre_medico"     		=> mb_strtoupper($this->nombre_medico,'utf-8'),
                   "matricula_medico"  		=> mb_strtoupper($this->matricula_medico,'utf-8'),
                   "direccion_medico"  		=> mb_strtoupper($this->direccion_medico,'utf-8'),
                   "telefono_medico"   		=> $this->telefono_medico,
        					 "id"				 				 		=> $this->id,
		);		
		
		$respuesta = ControllerMedicos::ctrEditarMedico($datos);
		
		echo json_encode($respuesta);
		
	}

}

/*=============================================
MOSTRAR MEDICOS
=============================================*/
if (isset($_POST["mostrarMedico"])) {
				 
	$nuevoMedico = new AjaxMedicos();
	$nuevoMedico -> id = $_POST["idMedico"];
	$nuevoMedico -> ajaxMostrarMedico();

}

/*=============================================
REGISTRO DE NUEVO MEDICO
=============================================*/
if (isset($_POST["nuevoMedico"])) {
				 
	$nuevoMedico = new AjaxMedicos();

	$nuevoMedico -> prefijo_medico = $_POST["nuevoPrefijo"];
	$nuevoMedico -> id_especialidad = $_POST["nuevoEspecialidadMedico"];
  $nuevoMedico -> paterno_medico = $_POST["nuevoPaternoMedico"];
  $nuevoMedico -> materno_medico = $_POST["nuevoMaternoMedico"];
  $nuevoMedico -> nombre_medico = $_POST["nuevoNombreMedico"];
  $nuevoMedico -> matricula_medico = $_POST["nuevoMatricula"];
  $nuevoMedico -> direccion_medico = $_POST['nuevoDireccion'];
  $nuevoMedico -> telefono_medico = $_POST['nuevoTelefono'];

	$nuevoMedico -> ajaxNuevoMedico();

}

/*=============================================
EDITAR MEDICO
=============================================*/
if (isset($_POST["editarMedico"])) {
				 
	$editarMedico = new AjaxMedicos();
	
	$editarMedico -> prefijo_medico = $_POST["editarPrefijo"];
	$editarMedico -> id_especialidad = $_POST["editarEspecialidadMedico"];
  $editarMedico -> paterno_medico = $_POST["editarPaternoMedico"];
  $editarMedico -> materno_medico = $_POST["editarMaternoMedico"];
  $editarMedico -> nombre_medico = $_POST["editarNombreMedico"];
  $editarMedico -> matricula_medico = $_POST["editarMatricula"];
  $editarMedico -> direccion_medico = $_POST['editarDireccion'];
  $editarMedico -> telefono_medico = $_POST['editarTelefono'];
  $editarMedico -> id = $_POST['editarIdMedico'];

	$editarMedico -> ajaxEditarMedico();

}