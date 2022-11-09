<?php

require_once "../controllers/usuarios.controller.php";
require_once "../models/usuarios.model.php";

class TablaUsuarios {

	/*=============================================
	MOSTRAR LA TABLA USUARIO
	=============================================*/
		
	public function mostrarTablaUsuarios() {

		$item = null;
		$valor = null;

		$usuarios = ControllerUsuarios::ctrMostrarUsuarios($item, $valor);

		if ($usuarios == null) {
			
			$datosJson = '{
				"data": []
			}';

		} else {

			$datosJson = '{
				"data": [';

				for ($i = 0; $i < count($usuarios); $i++) { 
					/*=============================================
					VERIFICAR EL ESTADO DEL USUARIO 
					=============================================*/
					if($usuarios[$i]["estado_usuario"] != 0 ){
						$estado =  "<button class='btn btn-success btn-sm btnActivar' idUsuario='".$usuarios[$i]["id"]."' estadoUsuario='0'>ACTIVO </button>";
					}else{
    				$estado = "<button class='btn btn-danger btn-sm btnActivar' idUsuario='".$usuarios[$i]["id"]."' estadoUsuario='1'>INACTIVO </button>";
					}

					/*=============================================
					TRAEMOS LAS ACCIONES
					=============================================*/				
					$btnEditarUsuario = "<button class='btn btn-outline-primary btn-sm btnEditarUsuario' id='".$usuarios[$i]["id"]."' data-bs-toggle='modal' data-bs-target='#modalEditarUsuario' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button>";

					$btnEliminarUsuario = "<button class='btn btn-outline-primary btn-sm btnBajarusuario' id='".$usuarios[$i]["id"]."' data-toggle='tooltip' title='Eliminar Usuario'><i class='fas fa-trash-alt'></i></button>";	
						
					$botones = "<div class='btn-group'>".$btnEditarUsuario.$btnEliminarUsuario."</div>";
					
					$datosJson .='[
						"'.($i+1).'",
						"'.$botones.'",					
						"'.$usuarios[$i]["nick_usuario"].'",
						"'.$usuarios[$i]["nombre_usuario"].'",
						"'.$usuarios[$i]["paterno_usuario"].'",
						"'.$usuarios[$i]["materno_usuario"].'",
						"'.$usuarios[$i]["referencia"].'",
						"'.date("d/m/Y (H:i:s)", strtotime($usuarios[$i]["fecha_creacion"])).'",
						"'.$estado.'"
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
ACTIVAR TABLA USUARIOS
=============================================*/

$activarUsuarios = new TablaUsuarios();
$activarUsuarios -> mostrarTablaUsuarios();