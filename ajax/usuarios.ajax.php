<?php

require_once "../controllers/usuarios.controller.php";
require_once "../models/usuarios.model.php";

class AjaxUsuarios {

	public $nombre_usuario;
	public $clave_usuario;

	/*=============================================
	AUTENTICACION DE USUARIO
	=============================================*/

	public function ajaxAutenticacionUsuario() {

		$nombre_usuario = $this->nombre_usuario;

		$clave_usuario = $this->clave_usuario;

		$respuesta = ControllerUsuarios::ctrAutenticacionUsuario($nombre_usuario, $clave_usuario);

		echo $respuesta;

	}

	public $id;  

  /*=============================================
	MOSTRAR USUARIO
	=============================================*/
	public function ajaxMostrarUsuarios()	{

		$item = "id";
		$valor = $this->id;

		$usuario = ControllerUsuarios::ctrMostrarUsuarios($item, $valor);
	
		echo json_encode($usuario);	
			
	}

	public $paterno_usuario;
	public $materno_usuario;
	public $nick_usuario;
	public $id_tipo_usuario;  

	/*=============================================
	NUEVO USUARIO
	=============================================*/

	public function ajaxNuevoUsuario()	{

		// ENCRIPTAR CLAVE DE USUARIO
		$encriptar = crypt($this->clave_usuario, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

		$datos = array("nombre_usuario"   => mb_strtoupper($this->nombre_usuario,'utf-8'), 
		               "paterno_usuario"  => mb_strtoupper($this->paterno_usuario,'utf-8'),  
		               "materno_usuario"  => mb_strtoupper($this->materno_usuario,'utf-8'),
		               "nick_usuario"	    => mb_strtoupper($this->nick_usuario,'utf-8'),
		               "clave_usuario"  	=> $encriptar,
		               "id_tipo_usuario"  => $this->id_tipo_usuario,
		);	
	
		$respuesta = ControllerUsuarios::ctrNuevoUsuario($datos);
	
		echo json_encode($respuesta);
	
			
	}

	public $estado_usuario;

	/*=============================================
	ACTIVAR USUARIO
	=============================================*/

	public function ajaxActivarUsuario() {
		
		$tabla = "usuarios";

		$item1 = "estado_usuario";
		$valor1 = $this->estado_usuario;

		$item2 = "id";
		$valor2 = $this->id;

		$respuesta = ModelUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

		echo json_encode($respuesta);

	}

	public $clave_actual; 

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	public function ajaxEditarUsuario()	{

		if ($this->clave_usuario != "") {

			$encriptar = crypt($this->clave_usuario, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

		} else {

			$encriptar = $this->clave_actual;
		}

		$datos = array("nombre_usuario"    => mb_strtoupper($this->nombre_usuario,'utf-8'),  
		               "paterno_usuario"   => mb_strtoupper($this->paterno_usuario,'utf-8'), 
						       "materno_usuario"	 => mb_strtoupper($this->materno_usuario,'utf-8'),					
						       "nick_usuario"      => mb_strtoupper($this->nick_usuario,'utf-8'),
						       "clave_usuario"     => $encriptar,
						       "id_tipo_usuario"   => $this->id_tipo_usuario,
						       "id"   		         => $this->id,
		);	

		$respuesta = ControllerUsuarios::ctrEditarUsuario($datos);

		echo json_encode($respuesta);

	}
	

	/*=============================================
	ELIMINAR USUARIO
	=============================================*/
	public function ajaxEliminarUsuarios()	{
	
		$item = "id";
		$valor = $this->id;

		$usuario = ControllerUsuarios::CtrEliminarUsuario($item,$valor);

		echo json_encode($id);  
	}
}

/*=============================================
AUTENTICACION DE USUARIO
=============================================*/

if (isset($_POST["autenticarUsuario"])) {

	$ingresoUsuario = new AjaxUsuarios();
	$ingresoUsuario -> nombre_usuario = $_POST["usuario"];
	$ingresoUsuario -> clave = $_POST["clave"];
	$ingresoUsuario -> ajaxAutenticacionUsuario();

}

/*=============================================
MOSTRAR USUARIO
=============================================*/
if (isset($_POST["mostrarUsuario"])) {
				 
	$nuevoUsuario = new AjaxUsuarios();
	$nuevoUsuario -> id = $_POST["id"];
	$nuevoUsuario -> ajaxMostrarUsuarios();

}

/*=============================================
NUEVO USUARIO
=============================================*/
if (isset($_POST["nuevoUsuario"])) {
				 
	$nuevoUsuario = new AjaxUsuarios();

	$nuevoUsuario -> nombre_usuario = $_POST['nuevoNombreUsuario'];
	$nuevoUsuario -> paterno_usuario = $_POST['nuevoPaternoUsuario'];
	$nuevoUsuario -> materno_usuario = $_POST['nuevoMaternoUsuario'];
	$nuevoUsuario -> nick_usuario = $_POST["nuevoNickUsuario"];
	$nuevoUsuario -> clave_usuario = $_POST['nuevoClaveUsuario'];
	$nuevoUsuario -> id_tipo_usuario = $_POST['nuevoTipoUsuario'];

	$nuevoUsuario -> ajaxNuevoUsuario();

}

/*=============================================
ACTIVAR USUARIO
=============================================*/

if (isset($_POST["activarUsuario"])) {

	$activarUsuario = new AjaxUsuarios();
	$activarUsuario -> id = $_POST["id"];
	$activarUsuario -> estado_usuario = $_POST["estado_usuario"];
	$activarUsuario -> ajaxActivarUsuario();

}

/*=============================================
EDITAR USUARIO
=============================================*/
if (isset($_POST["editarUsuario"])) {
				 
	$editarUsuario = new AjaxUsuarios();

	$editarUsuario -> nombre_usuario = $_POST['editarNombreUsuario'];
	$editarUsuario -> paterno_usuario = $_POST['editarPaternoUsuario'];
	$editarUsuario -> materno_usuario = $_POST['editarMaternoUsuario'];
	$editarUsuario -> nick_usuario = $_POST["editarNickUsuario"];
	$editarUsuario -> clave_usuario = $_POST['editarClaveUsuario'];
	$editarUsuario -> clave_actual = $_POST["claveActual"];
	$editarUsuario -> id_tipo_usuario = $_POST['editarTipoUsuario'];
	$editarUsuario -> id = $_POST['editarIdUsuario'];

	$editarUsuario -> ajaxEditarUsuario();

}

/*=============================================
ELIMINAR USUARIO
=============================================*/  
if(isset($_POST["eliminarUsuario"])){

	$eliminarUsuario=new AjaxUsuarios();
	$eliminarUsuario->id=$_POST("id");
	$eliminarUsuario->ajaxEliminarUsuarios();
}