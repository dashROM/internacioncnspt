<?php

require_once "../controllers/camas.controller.php";
require_once "../models/camas.model.php";

class TablaCama {

	/*=============================================
	MOSTRAR LA TABLA DE INGRESOS
	=============================================*/
		
	public function mostrarTablaCamas() {

		$item = null;
		$valor = null;

		$camas = ControllerCamas::ctrMostrarCamas($item, $valor); 

		if ($camas == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($camas); $i++) { 

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/
					// $btnEditarPaciente = "<button  class='btn btn-warning btnEditarPaciente' idPaciente='".$pacientes[$i]["idpaciente"]."' data-bs-toggle='modal' data-bs-target='#Modaleditarpaciente'><i class='fas fa-pencil-alt'></i></button>";
					
					$btnEditarCamas = "<button class='btn btn-warning btnEditarCamas' idcama='".$camas [$i]["idcama"]."' data-bs-toggle='modal' data-bs-target='#ModaleditarAltas'><i class='fas fa-pencil-alt'></i></button>"; 
					$btnDetalleCamas  = "<button class='btn btn-primary btnDetalleCama' idcama='".$camas[$i]["idcama"]."' data-toggle='modal' data-target='#modalDetalleespecialidades' data-toggle='tooltip' title='Detalle Ingreso'><i class='fas fa-eye'></i></button>";	
		
					$botones = "<div class='btn-group'>".$btnEditarCamas.$btnDetalleCamas ."</div>";
					
					$datosJson .='[
						"'.($i+1).'",					
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

$activarCamas = new TablaCama();
$activarCamas -> mostrarTablaCamas();