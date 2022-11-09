<?php

require_once "../controllers/salas.controller.php";
require_once "../models/salas.model.php";

class TablaSalas {

	/*=============================================
	MOSTRAR LA TABLA DE INGRESOS
	=============================================*/
		
	public function mostrarTablaSalas() {

		$item = null;
		$valor = null;

		$salas = ControllerSalas::ctrMostrarSalas($item, $valor); 

		if ($salas == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($salas); $i++) { 

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/
					// $btnEditarPaciente = "<button  class='btn btn-warning btnEditarPaciente' idPaciente='".$pacientes[$i]["idpaciente"]."' data-bs-toggle='modal' data-bs-target='#Modaleditarpaciente'><i class='fas fa-pencil-alt'></i></button>";
					
					$btnEditarSalas  = "<button class='btn btn-warning btnEditarEspecialidades' idsala='".$salas [$i]["idsala"]."' data-bs-toggle='modal' data-bs-target='#ModaleditarAltas'><i class='fas fa-pencil-alt'></i></button>"; 
					$btnNuevaCama= "<button class='btn btn-success btnNuevaCama' idespecialidad='".$salas[$i]["idespecialidad"]."' idsala='".$salas[$i]["idsala"]."' data-bs-toggle='modal' data-bs-target='#ModalnuevaCamas'><i class='fas fa-plus'></i></button>";
					$btnDetalleesSalas  = "<button class='btn btn-primary btnDetalleEspecialidades' idsala='".$salas[$i]["idsala"]."' data-toggle='modal' data-target='#modalDetalleespecialidades' data-toggle='tooltip' title='Detalle Ingreso'><i class='fas fa-eye'></i></button>";	
		
					$botones = "<div class='btn-group'>".$btnEditarSalas.$btnNuevaCama.$btnDetalleesSalas."</div>";
					
					$datosJson .='[
						"'.($i+1).'",
						"'.$salas[$i]["nombre_especialidad"].'",					
						"'.$salas[$i]["descripcion"].'",
						"'.$botones.'"
					],';
                  
				}

				$datosJson = substr($datosJson, 0, -1);

			$datosJson .= ']

			}';

		}
		
		echo $datosJson;
	
	}

}

/*=============================================
ACTIVAR TABLA PACIENTES
=============================================*/

$activarSalas = new TablaSalas();
$activarSalas -> mostrarTablaSalas();