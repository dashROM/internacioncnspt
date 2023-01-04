<?php

require_once "../controllers/empleadoresSIAIS.controller.php";
require_once "../models/empleadoresSIAIS.model.php";

class TablaEmpleadoresSIAIS {

	/*=============================================
	MOSTRAR LA TABLA DE EMPLEADORES DE LA BASE DE DATOS SIAIS
	=============================================*/
		
	public function mostrarTablaEmpleadoresSIAIS() {

		$item = null;
		$valor = null;

		$empleadores = ControllerEmpleadoresSIAIS::ctrMostrarEmpleadoresSIAIS($item, $valor);

		if ($empleadores == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($empleadores); $i++) { 

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/
					
					$datosJson .='[
						"'.($i+1).'",			
						"'.$empleadores[$i]['emp_nro_empleador'].'",
						"'.str_replace('"','\\"',$empleadores[$i]['emp_nombre']).'",
						"'.$empleadores[$i]['idempleador'].'"
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
ACTIVAR TABLA EMPLEADORES
=============================================*/

$activarEmpleadoresSIAIS = new TablaEmpleadoresSIAIS();
$activarEmpleadoresSIAIS -> mostrarTablaEmpleadoresSIAIS();