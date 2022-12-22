<?php 

require_once "controllers/template.controller.php";
require_once "controllers/usuarios.controller.php";
require_once "controllers/pacientes.controller.php";
require_once "controllers/departamentos.controller.php";
require_once "controllers/establecimientos.controller.php";
require_once "controllers/consultorios.controller.php";
require_once "controllers/servicios.controller.php";
require_once "controllers/especialidades.controller.php";
require_once "controllers/salas.controller.php";
require_once "controllers/diagnosticos.controller.php";
require_once "controllers/tipoUsuarios.controller.php";
require_once "controllers/camas.controller.php";
require_once "controllers/medicos.controller.php";
require_once "controllers/paciente_ingresos.controller.php";


require_once "models/usuarios.model.php";
require_once "models/pacientes.model.php";
require_once "models/departamentos.model.php";
require_once "models/establecimientos.model.php";
require_once "models/consultorios.model.php";
require_once "models/servicios.model.php";
require_once "models/especialidades.model.php";
require_once "models/salas.model.php";
require_once "models/diagnosticos.model.php";
require_once "models/tipoUsuarios.model.php";
require_once "models/camas.model.php";
require_once "models/medicos.model.php";
require_once "models/paciente_ingresos.model.php";


$template = new ControllerTemplate();
$template -> ctrTemplate();