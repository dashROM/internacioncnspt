<?php 

class ControllerUsuarios {

	/*=============================================
	AUTENTICACION DE USUARIO
	=============================================*/
	
	static public function ctrAutenticacionUsuario() {

		if (isset($_POST["usuario"])) {

			$nick_usuario = $_POST["usuario"];
			$clave_usuario = $_POST["clave"];

			if ($nick_usuario != "") {

				if (preg_match('/^[a-zA-Z0-9]+$/', $nick_usuario) && preg_match('/^[a-zA-Z0-9]+$/', $clave_usuario)) {

					$encriptar = crypt($clave_usuario, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

					$tabla = "usuarios";
					$item = "nick_usuario";

					$usuario = ModelUsuarios::mdlMostrarUsuarios($tabla, $item, $nick_usuario);

					if ($usuario["nick_usuario"] == $nick_usuario && $usuario["clave_usuario"] == $encriptar) {

						if ($usuario["estado_usuario"] == 1) {
							
							$_SESSION["iniciarSesion_internacion"] = "ok";
							$_SESSION["id_internacion"] = $usuario["id"];
							$_SESSION["nick_internacion"] = $usuario["nick_usuario"];
							$_SESSION["nombre_internacion"] = $usuario["nombre_usuario"];
							$_SESSION["nivel_internacion"] = $usuario["nivel_usuario"];

							echo '<script>

								window.location = "inicio";

							</script>';

						} else {

							echo '<div class="alert alert-danger mt-3">El usuario aún no está activado<br>Contactese con el Administrador del Sistema</div>';

						}					

					} else {

						echo '<div class="alert alert-danger mt-3">Error al ingresar, vuelva a intentarlo</div>';

					}

				}

			} else {

				echo '<div class="alert alert-danger mt-3">Ingrese su nombre de usuario</div>';

			}

		}

	}

	/*=============================================
	LISTADO DE USUARIOS
	=============================================*/
	static public function ctrMostrarUsuarios($item, $valor) {

		$tabla = "usuarios";

		$respuesta = ModelUsuarios::mdlMostrarUsuarios($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	NUEVO USUARIO
	=============================================*/
	static public function ctrNuevoUsuario($datos) {
		
		$tabla = "usuarios";

		$respuesta = ModelUsuarios::mdlNuevoUsuario($tabla, $datos);
		
		return $respuesta;

	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/
	static public function ctrEditarUsuario($datos) {
		
		$tabla = "usuarios";

		$respuesta = ModelUsuarios::mdlEditarUsuario($tabla, $datos);
		
		return $respuesta;

	}

	/*=============================================
	ELIMINAR USUARIO
	=============================================*/
	static public function ctrEliminarUsuario($datos) {
		
		$tabla = "usuarios";

		$respuesta = ModelUsuarios::mdlEliminarUsuario($tabla, $datos);
		
		return $respuesta;

	}

}
