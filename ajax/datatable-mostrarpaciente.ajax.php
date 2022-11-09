<?php

require_once "../controllers/pacientes.controller.php";
require_once "../models/pacientes.model.php";

class TablaPacientes {

	/*=============================================
	MOSTRAR LA TABLA DE PACIENTES
	=============================================*/
		
	public function mostrarTablaPacientesServicio() {

		$item = null;
		$valor = null;

		$pacientes = ControllerPacientes::ctrMostrarPacientesServicio($item, $valor);

		if ($pacientes == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($pacientes); $i++) { 

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/
					
					$datosJson .='[
						"'.($i+1).'",
						"'.$pacientes[$i]["fecha"].'",		
						"'.$pacientes[$i]["nombre_especialidad"].'",			
						"'.$pacientes[$i]["count"].'"
						
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

$activarPacientes = new TablaPacientes();
$activarPacientes -> mostrarTablaPacientesServicio();

