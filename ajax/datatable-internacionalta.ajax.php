<?php

require_once "../controllers/internacionalta.controller.php";
require_once "../models/internacionalta.model.php";

class TablaInternacionAlta {

	/*=============================================
	MOSTRAR LA TABLA DE PACIENTES
	=============================================*/
		
	public function mostrarTablaInternacionAlta() {

		$item = null;
		$valor = null;

		$internacion = ControllerInternacionAlta::ctrMostrarInternacionAlta($item, $valor);

		if ($internacion == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($internacion); $i++) { 

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/
					
					$datosJson .='[
						"'.($i+1).'",
						"'.$internacion[$i]["fecha"].'",		
						"'.$internacion[$i]["nombre_especialidad"].'",			
						"'.$internacion[$i]["pac_nombre"].'",
                        "'.$internacion[$i]["pac_primer_apellido"].'",
                        "'.$internacion[$i]["descripcion"].'",
                        "'.$internacion[$i]["descripcioncama"].'",
                        "'.$internacion[$i]["per_nombre"].'"

						
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
$activarPacientes = new TablaInternacionAlta();
$activarPacientes -> mostrarTablaInternacionAlta();

