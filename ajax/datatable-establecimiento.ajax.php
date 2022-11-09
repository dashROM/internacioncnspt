<?php

require_once "../controllers/establecimiento.controller.php";
require_once "../models/establecimiento.model.php";

class TablaEstablecimiento {

	/*=============================================
	MOSTRAR LA TABLA DE INGRESOS
	=============================================*/
		
	public function mostrarTablaEstablecimiento() {

		$item = null;
		$valor = null;

		$establecimiento = ControllerEstablecimiento::ctrMostrarEstablecimiento($item, $valor); 

		if ($establecimiento == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($establecimiento); $i++) { 

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/
					// $btnEditarPaciente = "<button  class='btn btn-warning btnEditarPaciente' idPaciente='".$pacientes[$i]["idpaciente"]."' data-bs-toggle='modal' data-bs-target='#Modaleditarpaciente'><i class='fas fa-pencil-alt'></i></button>";
					
					$btnEditarestablecimiento = "<button class='btn btn-warning btnEditarestablecimiento' idestablecimiento='".$establecimiento[$i]["idestablecimiento"]."' data-bs-toggle='modal' data-bs-target='#ModaleditarEstablecimiento'><i class='fas fa-pencil-alt'></i></button>";

					$btnDetalleestablecimiento = "<button class='btn btn-primary btnDetalleAltas' idaltas='".$establecimiento[$i]["idestablecimiento"]."' data-toggle='modal' data-target='#modalDetalleingreso' data-toggle='tooltip' title='Detalle Ingreso'><i class='fas fa-file-invoice'></i></button>";	
						
					$botones = "<div class='btn-group'>".$btnEditarestablecimiento.$btnDetalleestablecimiento."</div>";
					
					$datosJson .='[
						"'.($i+1).'",					
						"'.$establecimiento[$i]["nombre_establecimiento"].'",
						"'.$establecimiento[$i]["abrev_establecimiento"].'",
						"'.$establecimiento[$i]["ubicacion_establecimiento"].'",
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

$activarEstablecimiento = new TablaEstablecimiento();
$activarEstablecimiento -> mostrarTablaEstablecimiento();
