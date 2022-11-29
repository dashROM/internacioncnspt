<?php

require_once "../controllers/paciente_ingresos.controller.php";
require_once "../models/paciente_ingresos.model.php";

class TablaPacienteIngresos {

	public $id_paciente;
	public $sexo;

	/*=============================================
	MOSTRAR LA TABLA DE INGRESOS DE ACUERDO A UN PACIENTE
	=============================================*/
	public function mostrarTablaPacienteIngresos() {

		$item = "id_paciente";
		$valor = $this->id_paciente;

		$paciente_ingresos = ControllerPacienteIngresos::ctrMostrarPacienteIngresos($item, $valor);

		if ($paciente_ingresos == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($paciente_ingresos); $i++) {

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/					
					$btnEditarIngreso = "<button class='btn btn-outline-primary btn-sm btnEditarPacienteIngreso' idPacienteIngreso='".$paciente_ingresos[$i]["id"]."' data-bs-toggle='modal' data-bs-target='#modalEditarPacienteIngreso' data-toggle='tooltip' title='Editar Ingreso'><i class='fas fa-pencil-alt'></i> EDITAR</button>";

					$btnTransferencia = "<button class='btn btn-outline-primary btn-sm btnNuevaTransferencia' idPacienteIngreso='".$paciente_ingresos[$i]["id"]."' fechaIngreso='".$paciente_ingresos[$i]["fecha_ingreso"]."' idServicio='".$paciente_ingresos[$i]["id_servicio"]."' idEspecialidad='".$paciente_ingresos[$i]["id_especialidad_actual"]."' idSala='".$paciente_ingresos[$i]["id_sala"]."' idCama='".$paciente_ingresos[$i]["id_cama"]."' data-bs-toggle='modal' data-bs-target='#modalNuevaTransferencia' data-toggle='tooltip' title='Registrar Transferencia'><i class='fas fa-exchange-alt'></i> TRANSFERENCIA</button>";

					$btnMaternidad = "<button class='btn btn-outline-primary btn-sm btnNuevaMaternidad' idPacienteIngreso='".$paciente_ingresos[$i]["id"]."' fechaIngreso='".$paciente_ingresos[$i]["fecha_ingreso"]."' idServicio='".$paciente_ingresos[$i]["id_servicio"]."' idSala='".$paciente_ingresos[$i]["id_sala"]."' idCama='".$paciente_ingresos[$i]["id_cama"]."' data-bs-toggle='modal' data-bs-target='#modalNuevaMaternidad' data-toggle='tooltip' title='Registro a Maternidad'><i class='fas fa-baby-carriage'></i> MATERNIDAD</button>";

					$btnEditarMaternidad = "<button class='btn btn-outline-primary btn-sm btnEditarMaternidad' idPacienteIngreso='".$paciente_ingresos[$i]["id"]."' data-bs-toggle='modal' data-bs-target='#modalEditarMaternidad' data-toggle='tooltip' title='Editar Maternidad'><i class='fas fa-baby-carriage'></i> MATERNIDAD</button>";

					$btnNeonato = "<button class='btn btn-outline-primary btn-sm btnNuevoNeonato' idPacienteIngreso='".$paciente_ingresos[$i]["id"]."' fechaIngreso='".$paciente_ingresos[$i]["fecha_ingreso"]."' idServicio='".$paciente_ingresos[$i]["id_servicio"]."' idSala='".$paciente_ingresos[$i]["id_sala"]."' idCama='".$paciente_ingresos[$i]["id_cama"]."' data-bs-toggle='modal' data-bs-target='#modalNuevoNeonato' data-toggle='tooltip' title='Registro a Neonato'><i class='fas fa-baby'></i> NEONATOS</button>";

					$btnEditarNeonato = "<button class='btn btn-outline-primary btn-sm btnEditarNeonato' idPacienteIngreso='".$paciente_ingresos[$i]["id"]."' data-bs-toggle='modal' data-bs-target='#modalEditarNeonato' data-toggle='tooltip' title='Editar Neonato'><i class='fas fa-baby'></i> NEONATOS</button>";
					
					$btnReferencia = "<button class='btn btn-outline-primary btn-sm btnNuevoReferencia' idPacienteIngreso='".$paciente_ingresos[$i]["id"]."' data-bs-toggle='modal' data-bs-target='#modalNuevoReferencia' data-toggle='tooltip' title='Registrar Referencia'><i class='fas fa-registered'></i> REFERENCIA</button>";

					$btnEditarReferencia = "<button class='btn btn-outline-primary btn-sm btnEditarReferencia' idPacienteIngreso='".$paciente_ingresos[$i]["id"]."' data-bs-toggle='modal' data-bs-target='#modalEditarReferencia' data-toggle='tooltip' title='Editar Referencia'><i class='fas fa-registered'></i> REFERENCIA</button>";

					$btnReporteForm204 = "<button class='btn btn-outline-primary btn-sm btnReporteForm204' idPaciente='".$paciente_ingresos[$i]["id_paciente"]."' idPacienteIngreso='".$paciente_ingresos[$i]["id"]."' modulo='detalle-paciente' data-toggle='tooltip' title='Reportes Paciente'><i class='fas fa-print'></i> FORM204</button>";

					/*=============================================
					VERIFICAR EL ESTADO DEL PACIENTE 
					=============================================*/
					if($paciente_ingresos[$i]["estado_paciente"] == 0) {

    				$estado = "<button class='btn btn-danger btn-sm btnDarAltaPaciente' idPacienteIngreso='".$paciente_ingresos[$i]["id"]."' fecha_ingreso='".$paciente_ingresos[$i]["fecha_ingreso"]."' estado_paciente='0' idCama='".$paciente_ingresos[$i]["id_cama"]."' modulo='detalle-paciente' data-bs-toggle='modal' data-bs-target='#modalDarAltaPaciente' data-toggle='tooltip' title='Registrar Alta Paciente'><i class='fas fa-procedures'></i> REGISTRAR ALTA</button>";

    				if ($this->sexo == "FEMENINO") {

	    				if($paciente_ingresos[$i]["nombre_especialidad"] == "MATERNIDAD") {

	    					if($paciente_ingresos[$i]["maternidad"] == "0") {

	    						$botones = "<div class='btn-group'>".$btnEditarIngreso.$btnTransferencia.$btnMaternidad."</div>";

	    					} else {

	    						$botones = "<div class='btn-group'>".$btnEditarIngreso.$btnTransferencia.$btnEditarMaternidad."</div>";

	    					}

	    				} else if($paciente_ingresos[$i]["nombre_especialidad"] == "NEONATOLOGIA") {

  							if($paciente_ingresos[$i]["neonato"] == "0") {

	    						$botones = "<div class='btn-group'>".$btnEditarIngreso.$btnTransferencia.$btnNeonato."</div>";

	    					} else {

	    						$botones = "<div class='btn-group'>".$btnEditarIngreso.$btnTransferencia.$btnEditarNeonato."</div>";

	    					}

	    				} else {

    						$botones = "<div class='btn-group'>".$btnEditarIngreso.$btnTransferencia."</div>";

	    				}

	    			} elseif($paciente_ingresos[$i]["nombre_especialidad"] == "NEONATOLOGIA") {

    					if($paciente_ingresos[$i]["neonato"] == "0") {

    						$botones = "<div class='btn-group'>".$btnEditarIngreso.$btnTransferencia.$btnNeonato."</div>";

    					} else {

    						$botones = "<div class='btn-group'>".$btnEditarIngreso.$btnTransferencia.$btnEditarNeonato."</div>";

    					}

    				} else {

    					$botones = "<div class='btn-group'>".$btnEditarIngreso.$btnTransferencia."</div>";

    				}

    				if ($paciente_ingresos[$i]["referencia"] == "0") {

							$botones2 = "<div class='btn-group'>".$btnReferencia."</div>";

						} else {

							$botones2 = "<div class='btn-group'>".$btnEditarReferencia."</div>";
						
						}					

					} else {

						$estado = "<button class='btn btn-success btn-sm btnVerAltaPaciente' idPacienteIngreso='".$paciente_ingresos[$i]["id"]."' estado_paciente='1' data-bs-toggle='modal' modulo='detalle-paciente' data-bs-target='#modalVerAltaPaciente' data-toggle='tooltip' title='Ver Detalle Alta Paciente'><i class='fas fa-user-injured'></i> DETALLE ALTA</button>";

							if ($paciente_ingresos[$i]["referencia"] == "0") {

							$botones = "";
							$botones2 = "<div class='btn-group'>".$btnReporteForm204."</div>";

						} else {

							$botones = "";
							$botones2 = "<div class='btn-group'>".$btnReporteForm204."</div>";
						
						}
					
					} 

					$datosJson .='[
						"'.($i+1).'",	
						"'.$botones.$botones2.'",
						"'.$estado.'",		
						"'.$paciente_ingresos[$i]["abrev_establecimiento"].'",
						"'.date("d/m/Y", strtotime($paciente_ingresos[$i]["fecha_ingreso"])).'",
						"'.$paciente_ingresos[$i]["hora_ingreso"].'",
						"'.$paciente_ingresos[$i]["nombre_servicio"].' - '.$paciente_ingresos[$i]["nombre_especialidad"].'",
						"'.$paciente_ingresos[$i]["nombre_sala"].'",
						"'.$paciente_ingresos[$i]["nombre_cama"].'",
						"'.$paciente_ingresos[$i]["diagnostico"].'",
						"'.$paciente_ingresos[$i]["diagnostico_especifico1"].' - '.$paciente_ingresos[$i]["diagnostico_especifico2"].' - '.$paciente_ingresos[$i]["diagnostico_especifico3"].'"		
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
ACTIVAR TABLA PACIENTE INGRESOS
=============================================*/
if (isset($_POST["id_paciente"])) {

	$activarPacienteIngresos = new TablaPacienteIngresos();
	$activarPacienteIngresos -> id_paciente = $_POST["id_paciente"];
	$activarPacienteIngresos -> sexo = $_POST["sexo"];
	$activarPacienteIngresos -> mostrarTablaPacienteIngresos();

}