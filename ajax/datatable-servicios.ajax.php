<?php

require_once "../controllers/servicios.controller.php";
require_once "../models/servicios.model.php";

class TablaServicios {

	/*=============================================
	MOSTRAR LA TABLA DE SERVICIOS
	=============================================*/
		
	public function mostrarTablaServicios() {

		$item = null;
		$valor = null;

		$servicios = ControllerServicios::ctrMostrarServicios($item, $valor); 

		if ($servicios == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($servicios); $i++) { 

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/
					// $btnEditarPaciente = "<button  class='btn btn-warning btnEditarPaciente' idPaciente='".$pacientes[$i]["idpaciente"]."' data-bs-toggle='modal' data-bs-target='#Modaleditarpaciente'><i class='fas fa-pencil-alt'></i></button>";
					
					$btnEditarServicio = "<button class='btn btn-outline-primary btn-sm btnEditarServicio' idServicio='".$servicios [$i]["id"]."' data-bs-toggle='modal' data-bs-target='#ModalEditarServicio' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i> EDITAR</button>"; 
					$btnDetalleServicio = "<button class='btn btn-outline-primary btn-sm btnDetalleServicio' idServicio='".$servicios[$i]["id"]."' data-toggle='modal' data-target='#modalDetalle' data-toggle='tooltip' title='Más Detalle Servicio'><i class='fas fa-eye'></i> DETALLE SERVICIO</button>";	

					$botones = "<div class='btn-group' id='ver'>".$btnEditarServicio.$btnDetalleServicio."</div>";
					
					$datosJson .='[
						"'.($i+1).'",
						"'.$botones.'",					
						"'.$servicios[$i]["nombre_servicio"].'",
						"'.$servicios[$i]["nombre_establecimiento"].'"
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
ACTIVAR TABLA SERVICIOS
=============================================*/

$activarServicios = new TablaServicios();
$activarServicios -> mostrarTablaServicios();
