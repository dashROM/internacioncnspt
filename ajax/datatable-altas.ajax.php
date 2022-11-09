<?php

require_once "../controllers/altas.controller.php";
require_once "../models/altas.model.php";

class TablaAltas {

	/*=============================================
	MOSTRAR LA TABLA DE INGRESOS
	=============================================*/
		
	public function mostrarTablaAltas() {

		$item = null;
		$valor = null;

		$altas = ControllerAltas::ctrMostrarAltas($item, $valor); 

		if ($altas == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($altas); $i++) { 

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/
					// $btnEditarPaciente = "<button  class='btn btn-warning btnEditarPaciente' idPaciente='".$pacientes[$i]["idpaciente"]."' data-bs-toggle='modal' data-bs-target='#Modaleditarpaciente'><i class='fas fa-pencil-alt'></i></button>";
					
					$btnEditarAltas = "<button class='btn btn-warning btnEditarAltas' idaltas='".$altas[$i]["idaltas"]."' data-bs-toggle='modal' data-bs-target='#ModaleditarAltas'><i class='fas fa-pencil-alt'></i></button>";

					$btnDetalleAltas = "<button class='btn btn-primary btnDetalleAltas' idaltas='".$altas[$i]["idaltas"]."' data-toggle='modal' data-target='#modalDetalleingreso' data-toggle='tooltip' title='Detalle Ingreso'><i class='fas fa-file-invoice'></i></button>";	
						
					$botones = "<div class='btn-group'>".$btnEditarAltas.$btnDetalleAltas."</div>";
					
					$datosJson .='[
						"'.($i+1).'",					
						"'.$altas[$i]["fecha"].'",
						"'.$altas[$i]["pac_nombre"].'",
						"'.$altas[$i]["pac_primer_apellido"].'",
						"'.$altas[$i]["hora"].'",
						"'.$altas[$i]["diagnosticoegreso"].'",
						"'.$altas[$i]["condicionegreso"].'",
						"'.$altas[$i]["causaegreso"].'",
                        "'.$altas[$i]["per_nombre"].'",
						"'.$altas[$i]["causaclinica"].'",
						"'.$altas[$i]["causaautopsia"].'",
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

$activarAltas = new TablaAltas();
$activarAltas -> mostrarTablaAltas();
