
<?php

require_once "conexion.db.php";

class ModelUsuarios {
	
	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/
	
	static public function mdlMostrarUsuarios($tabla, $item, $valor) {

		if ($item != null) {

			$sql = "SELECT u.id, u.nick_usuario, u.nombre_usuario, u.paterno_usuario, u.materno_usuario, u.clave_usuario, u.estado_usuario, u.id_tipo_usuario, tu.referencia, tu.nivel_usuario FROM usuarios u, tipo_usuarios tu WHERE u.id_tipo_usuario = tu.id and u.$item = :$item";
			
			$stmt = Conexion::connectPostgres()->prepare($sql);
			 
			$stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

			$stmt->execute();

			return $stmt->fetch();

		} else {

			$sql = "SELECT u.id, u.nick_usuario, u.nombre_usuario, u.paterno_usuario, u.materno_usuario, u.clave_usuario, u.estado_usuario, u.fecha_creacion, tu.referencia from usuarios u, tipo_usuarios tu where u.id_tipo_usuario = tu.id ORDER BY id DESC";

			$stmt = Conexion::connectPostgres()->prepare($sql);

			$stmt->execute();

			return $stmt->fetchAll();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	REGISTRO DE NUEVO USUARIO
	=============================================*/

	static public function mdlNuevoUsuario($tabla, $datos) {

		$sql = "INSERT INTO $tabla(nick_usuario, paterno_usuario, materno_usuario, nombre_usuario, clave_usuario, id_tipo_usuario) VALUES (:nick_usuario, :paterno_usuario, :materno_usuario, :nombre_usuario, :clave_usuario, :id_tipo_usuario)";

		$stmt = Conexion::connectPostgres()->prepare($sql);

		$stmt->bindParam(":nick_usuario", $datos["nick_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":paterno_usuario", $datos["paterno_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":materno_usuario", $datos["materno_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_usuario", $datos["nombre_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":clave_usuario", $datos["clave_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":id_tipo_usuario", $datos["id_tipo_usuario"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR USUARIO
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2) {

		$sql = "UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2"; 
		
		$stmt = Conexion::connectPostgres()->prepare($sql);

		$stmt->bindParam(":".$item1, $valor1, PDO::PARAM_INT);
		$stmt->bindParam(":".$item2, $valor2, PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}	

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarUsuario($tabla, $datos) {

		$sql = "UPDATE $tabla SET nick_usuario = :nick_usuario, paterno_usuario = :paterno_usuario, materno_usuario = :materno_usuario, nombre_usuario = :nombre_usuario, clave_usuario = :clave_usuario, id_tipo_usuario = :id_tipo_usuario WHERE id = :id";

		$stmt = Conexion::connectPostgres()->prepare($sql);

		$stmt->bindParam(":nick_usuario", $datos["nick_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":paterno_usuario", $datos["paterno_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":materno_usuario", $datos["materno_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_usuario", $datos["nombre_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":clave_usuario", $datos["clave_usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":id_tipo_usuario", $datos["id_tipo_usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if ($stmt->execute()) {
			
			return "ok";

		} else {
			
			return "error";

		}
		
		$stmt->close();
		$stmt = null;

	}

}