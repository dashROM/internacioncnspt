<?php

require_once "../controllers/medicos.controller.php";
require_once "../models/medicos.model.php";

class TablaMedicos {

	/*=============================================
	MOSTRAR LA TABLA DE MEDICOS
	=============================================*/
		
	public function mostrarTablaMedicos() {

		$item = null;
		$valor = null;

		$medico = ControllerMedicos::ctrMostrarMedicos($item, $valor); 

		if ($medico == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($medico); $i++) { 

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/
					$btnEditarmedico = "<button class='btn btn-outline-primary btn-sm btnEditarMedico' idMedico='".$medico[$i]["id"]."' data-bs-toggle='modal' data-bs-target='#modalEditarMedico'><i class='fas fa-pencil-alt'></i></button>";
						
					$botones = "<div class='btn-group'>".$btnEditarmedico."</div>";
					
					$datosJson .='[
						"'.($i+1).'",
						"'.$botones.'",					
						"'.$medico[$i]["nombre_medico"].'",
						"'.$medico[$i]["paterno_medico"].'",
						"'.$medico[$i]["materno_medico"].'",
						"'.$medico[$i]["matricula_medico"].'",
						"'.$medico[$i]["direccion_medico"].'",
						"'.$medico[$i]["telefono_medico"].'"
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
ACTIVAR TABLA MEDICOS
=============================================*/

$activarMedico = new TablaMedicos();
$activarMedico -> mostrarTablaMedicos();
