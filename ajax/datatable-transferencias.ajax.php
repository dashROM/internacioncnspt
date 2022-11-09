<?php

require_once "../controllers/transferencias.controller.php";
require_once "../models/transferencias.model.php"; 

class TablaTransferencias {

	/*=============================================
	MOSTRAR LA TABLA DE TRANSFERENCIAS
	=============================================*/		
	public function ajaxMostrarPacienteTransferencias() {

		$item = "id_paciente_ingreso";
		$valor = $this->id_paciente_ingreso;

		$transferencia = ControllerTransferencias::ctrMostrarTransferencias($item, $valor); 

		if ($transferencia == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($transferencia); $i++) { 

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/
					$btnEditartransferencia= "<button  class='btn btn-outline-primary btn-sm btnEditarTransferencia' id='".$transferencia[$i]["id"]."' data-bs-toggle='modal' data-bs-target='#modalEditarTransferencia' data-toggle='tooltip' title='Editar Transferencia'><i class='fas fa-pencil-alt'></i></button>";
						
					$botones = "<div class='btn-group'>".$btnEditartransferencia."</div>";
					
					$datosJson .='[				
						"'.$botones.'",
						"'.date("d/m/Y", strtotime($transferencia[$i]["fecha_transferencia"])).'",
						"'.$transferencia[$i]["servicio_ini"].'",
						"'.$transferencia[$i]["servicio_fin"].'",
						"'.$transferencia[$i]["diagnostico_transferencia"].'"
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
MOSTRAR TRANSFERENCIAS
=============================================*/
if (isset($_POST["mostrarPacienteTransferencias"])) {
				 
	$mostrarTransferencia = new TablaTransferencias();
	$mostrarTransferencia -> id_paciente_ingreso = $_POST["id"];
	$mostrarTransferencia -> ajaxMostrarPacienteTransferencias();

}