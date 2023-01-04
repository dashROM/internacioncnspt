<?php

require_once "conexion.db.php";

class ModelPacienteInternados {

    /*=============================================
    CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA PACIENTES INTERNADOS
    =============================================*/
    static public function mdlContarPacientesInternados($tabla) {

        // devuelve el numero de registros de la consulta
        $sql = "SELECT pi.id FROM pacientes p, paciente_ingresos pi, paciente_internados pi2, establecimientos e, cie10 c10,servicios se, especialidades es, salas s ,camas c WHERE p.id = pi.id_paciente AND pi2.id_paciente_ingreso = pi.id AND e.id = pi.id_establecimiento AND  se.id = pi2.id_servicio AND es.id = pi2.id_especialidad AND c10.id = pi.id_cie10 AND s.id = pi2.id_sala AND c.id = pi2.id_cama AND pi.estado_paciente = 0";

        $stmt = Conexion::connectPostgres()->prepare($sql);

        $stmt->execute();

        return $stmt->rowCount();

        $stmt->close();
        $stmt = null;

    }

    /*=============================================
    CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA PACIENTES INTERNADOS FILTRADO
    =============================================*/
    static public function mdlContarFiltradoPacientesInternados($tabla, $sql) {

        if($sql == "") {

            // devuelve el numero de registros de la consulta

            $sql2 = "SELECT pi.id FROM pacientes p, paciente_ingresos pi, paciente_internados pi2, establecimientos e, cie10 c10,servicios se, especialidades es, salas s ,camas c WHERE p.id = pi.id_paciente AND pi2.id_paciente_ingreso = pi.id AND e.id = pi.id_establecimiento AND  se.id = pi.id_servicio AND es.id = pi.id_especialidad AND c10.id = pi.id_cie10 AND s.id = pi2.id_sala AND c.id = pi2.id_cama AND pi.estado_paciente = 0";

            $stmt = Conexion::connectPostgres()->prepare($sql2);

            $stmt->execute();

            $cuenta_col = $stmt->rowCount();

            return $cuenta_col;

        } else {

            // devuelve el numero de registros de la consulta

            $sql2 = "SELECT pi.id FROM pacientes p, paciente_ingresos pi, paciente_internados pi2, establecimientos e, cie10 c10,servicios se, especialidades es, salas s ,camas c WHERE p.id = pi.id_paciente AND pi2.id_paciente_ingreso = pi.id AND e.id = pi.id_establecimiento AND  se.id = pi2.id_servicio AND es.id = pi2.id_especialidad AND c10.id = pi.id_cie10 AND s.id = pi2.id_sala AND c.id = pi2.id_cama AND pi.estado_paciente = 0 $sql";

            $stmt = Conexion::connectPostgres()->prepare($sql2);

            $stmt->execute();

            $cuenta_col = $stmt->rowCount();

            return $cuenta_col;

        }

        $stmt->close();
        $stmt = null;

    }

    /*=============================================
    MOSTRAR TODOS PACIENTES INGRESOS
    =============================================*/
    static public function mdlMostrarPacientesInternados($tabla, $sql) {

        $sql2 = "SELECT pi.id, pi.id_paciente, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, p.fecha_nacimiento, p.cod_asegurado, p.nro_empleador, p.nombre_empleador, e.nombre_establecimiento, e.abrev_establecimiento, pi.fecha_ingreso, pi.hora_ingreso, pi.id_cie10, CONCAT(c10.codigo, ' - ',c10.descripcion) diagnostico, pi.diagnostico_especifico1, pi.diagnostico_especifico2, pi.diagnostico_especifico3, pi.estado_paciente, pi.id_servicio, se.nombre_servicio, pi.id_especialidad, pi2.id_especialidad as id_especialidad_actual, es.nombre_especialidad, pi.id_sala, s.nombre_sala, s.descripcion_sala, pi.id_cama, c.nombre_cama, c.descripcion_cama, pi.maternidad, pi.neonato, pi.referencia FROM pacientes p, paciente_ingresos pi, paciente_internados pi2, establecimientos e, cie10 c10,servicios se, especialidades es, salas s ,camas c WHERE p.id = pi.id_paciente AND pi2.id_paciente_ingreso = pi.id AND e.id = pi.id_establecimiento AND  se.id = pi2.id_servicio AND es.id = pi2.id_especialidad AND c10.id = pi.id_cie10 AND s.id = pi2.id_sala AND c.id = pi2.id_cama AND pi.estado_paciente = 0 $sql";

        $stmt = Conexion::connectPostgres()->prepare($sql2);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();
        $stmt = null;

    }

    /*=============================================
    CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA PACIENTES INTERNADOS (FILTRADO POR FECHA DE INGRESO)
    =============================================*/
    static public function mdlContarPacientesInternadosFecha($tabla, $item1, $valor1, $item2, $valor2) {

        // devuelve el numero de registros de la consulta
        $sql = "SELECT pi.id FROM pacientes p, paciente_ingresos pi, paciente_internados pi2, establecimientos e, cie10 c10, servicios se, especialidades es, salas s ,camas c WHERE p.id = pi.id_paciente AND pi2.id_paciente_ingreso = pi.id AND e.id = pi.id_establecimiento AND se.id = pi2.id_servicio AND es.id = pi2.id_especialidad AND c10.id = pi.id_cie10 AND s.id = pi2.id_sala AND c.id = pi2.id_cama AND pi.estado_paciente = 0 AND pi.fecha_ingreso BETWEEN :$item1 AND :$item2";

        $stmt = Conexion::connectPostgres()->prepare($sql);

        $stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->rowCount();

        $stmt->close();
        $stmt = null;

    }

    /*=============================================
    CONTAR EL NUMERO DE REGISTROS QUE EXISTE EN LA TABLA PACIENTES INTERNADOS (FILTRADO POR FECHA DE INGRESO)
    =============================================*/
    static public function mdlContarFiltradoPacientesInternadosFecha($tabla, $item1, $valor1, $item2, $valor2, $sql) {

        if($sql == "") {

            // devuelve el numero de registros de la consulta

            $sql2 = "SELECT pi.id FROM pacientes p, paciente_ingresos pi, paciente_internados pi2, establecimientos e, cie10 c10, servicios se, especialidades es, salas s ,camas c WHERE p.id = pi.id_paciente AND pi2.id_paciente_ingreso = pi.id AND e.id = pi.id_establecimiento AND se.id = pi2.id_servicio AND es.id = pi2.id_especialidad AND c10.id = pi.id_cie10 AND s.id = pi2.id_sala AND c.id = pi2.id_cama AND pi.estado_paciente = 0 AND pi.fecha_ingreso BETWEEN :$item1 AND :$item2";

            $stmt = Conexion::connectPostgres()->prepare($sql2);

            $stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
            $stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

            $stmt->execute();

            $cuenta_col = $stmt->rowCount();

            return $cuenta_col;

        } else {

            // devuelve el numero de registros de la consulta

            $sql2 = "SELECT pi.id FROM pacientes p, paciente_ingresos pi, paciente_internados pi2, establecimientos e, cie10 c10, servicios se, especialidades es, salas s ,camas c WHERE p.id = pi.id_paciente AND pi2.id_paciente_ingreso = pi.id AND e.id = pi.id_establecimiento AND se.id = pi2.id_servicio AND es.id = pi2.id_especialidad AND c10.id = pi.id_cie10 AND s.id = pi2.id_sala AND c.id = pi2.id_cama AND pi.estado_paciente = 0 AND pi.fecha_ingreso BETWEEN :$item1 AND :$item2 $sql";

            $stmt = Conexion::connectPostgres()->prepare($sql2);

            $stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
            $stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

            $stmt->execute();

            $cuenta_col = $stmt->rowCount();

            return $cuenta_col;

        }

        $stmt->close();
        $stmt = null;

    }

    /*=============================================
    MOSTRAR LISTADO PACIENTE INGRESO (FILTRADO POR FECHA DE INGRESO)
    =============================================*/
    static public function mdlMostrarPacientesInternadosFecha($tabla, $item1, $valor1, $item2, $valor2, $sql) {

        $sql2 = "SELECT pi.id, pi.id_paciente, CONCAT(p.nombre_paciente,' ',p.paterno_paciente,' ',p.materno_paciente) nombre_completo, p.fecha_nacimiento, p.cod_asegurado, p.nro_empleador, p.nombre_empleador, e.nombre_establecimiento, e.abrev_establecimiento, pi.fecha_ingreso, pi.hora_ingreso, pi.id_cie10, CONCAT(c10.codigo, ' - ',c10.descripcion) diagnostico, pi.diagnostico_especifico1, pi.diagnostico_especifico2, pi.diagnostico_especifico3, pi.estado_paciente, pi.id_servicio, se.nombre_servicio, pi.id_especialidad, pi2.id_especialidad as id_especialidad_actual, es.nombre_especialidad, pi.id_sala, s.nombre_sala, s.descripcion_sala, pi.id_cama, c.nombre_cama, c.descripcion_cama, pi.maternidad, pi.neonato, pi.referencia FROM pacientes p, paciente_ingresos pi, paciente_internados pi2, establecimientos e, cie10 c10, servicios se, especialidades es, salas s ,camas c WHERE p.id = pi.id_paciente AND pi2.id_paciente_ingreso = pi.id AND e.id = pi.id_establecimiento AND se.id = pi2.id_servicio AND es.id = pi2.id_especialidad AND c10.id = pi.id_cie10 AND s.id = pi2.id_sala AND c.id = pi2.id_cama AND pi.estado_paciente = 0 AND pi.fecha_ingreso BETWEEN :$item1 AND :$item2 $sql";
        
        $stmt = Conexion::connectPostgres()->prepare($sql2);

        $stmt->bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();
        $stmt = null;

    }

    /*=============================================
    LISTADO DE PACIENTES INTERNADO POR BUSQUEDA FILTRADO
    =============================================*/
    static public function mdlMostrarPacienteInternadosFiltro($item, $valor){

        if ($item == "cod_asegurado") {

            $sql = "
            SELECT concat_ws(' ', p.nombre_paciente, p.paterno_paciente, p.materno_paciente) as nombre_completo, p.documento_ci, p.cod_asegurado, s.nombre_sala, c.nombre_cama, se.nombre_servicio, e.nombre_especialidad, concat_ws(' ', m.nombre_medico, m.paterno_medico, m.materno_medico) as nombre_completo_medico 
            FROM pacientes p, paciente_internados pi2, salas s, camas c, servicios se, especialidades e, medicos m 
            WHERE p.id = pi2.id_paciente AND s.id = pi2.id_sala AND c.id = pi2.id_cama AND se.id = pi2.id_servicio AND e.id = pi2.id_especialidad AND m.id = pi2.id_medico AND pi2.estado_internado = 0 AND p.cod_asegurado LIKE '%$valor%'";
                
            $stmt = Conexion::connectPostgres()->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        } elseif ($item == "documento_ci") {

            $sql = "
            SELECT concat_ws(' ', p.nombre_paciente, p.paterno_paciente, p.materno_paciente) as nombre_completo, p.documento_ci, p.cod_asegurado, s.nombre_sala, c.nombre_cama, se.nombre_servicio, e.nombre_especialidad, concat_ws(' ', m.nombre_medico, m.paterno_medico, m.materno_medico) as nombre_completo_medico 
            FROM pacientes p, paciente_internados pi2, salas s, camas c, servicios se, especialidades e, medicos m 
            WHERE p.id = pi2.id_paciente AND s.id = pi2.id_sala AND c.id = pi2.id_cama AND se.id = pi2.id_servicio AND e.id = pi2.id_especialidad AND m.id = pi2.id_medico AND pi2.estado_internado = 0 AND CAST(p.documento_ci AS TEXT) LIKE '%$valor%'";
                
            $stmt = Conexion::connectPostgres()->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();

        } elseif ($item == "nombre_paciente") {
            $sql = "
            SELECT concat_ws(' ', p.nombre_paciente, p.paterno_paciente, p.materno_paciente) as nombre_completo, p.documento_ci, p.cod_asegurado, s.nombre_sala, c.nombre_cama, se.nombre_servicio, e.nombre_especialidad, concat_ws(' ', m.nombre_medico, m.paterno_medico, m.materno_medico) as nombre_completo_medico 
            FROM pacientes p, paciente_internados pi2, salas s, camas c, servicios se, especialidades e, medicos m 
            WHERE p.id = pi2.id_paciente AND s.id = pi2.id_sala AND c.id = pi2.id_cama AND se.id = pi2.id_servicio AND e.id = pi2.id_especialidad AND m.id = pi2.id_medico AND pi2.estado_internado = 0 AND (p.nombre_paciente LIKE '%$valor%' OR p.paterno_paciente LIKE '%$valor%' OR p.materno_paciente LIKE '%$valor%')";
                
            $stmt = Conexion::connectPostgres()->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        }

        $stmt->close();
        $stmt = null;

    }

    /*=============================================
    LISTADO DE PACIENTES INTERNADO POR BUSQUEDA FILTRADO
    =============================================*/
    static public function mdlMostrarPacientesInternadosServicio($tabla, $item, $valor){

        if ($valor == 7 || $valor == 22) {
            $sql = "SELECT pi.fecha_ingreso, concat_ws(' ', p.nombre_paciente, p.paterno_paciente, p.materno_paciente) as nombre_completo, p.documento_ci, p.cod_asegurado, s.nombre_sala, c.nombre_cama, se.nombre_servicio, e.nombre_especialidad, concat_ws(' ', m.nombre_medico, m.paterno_medico, m.materno_medico) as nombre_completo_medico 
            FROM pacientes p, paciente_ingresos pi, paciente_internados pi2, salas s, camas c, servicios se, especialidades e, medicos m 
            WHERE p.id = pi2.id_paciente and pi.id = pi2.id_paciente_ingreso AND s.id = pi2.id_sala AND c.id = pi2.id_cama AND se.id = pi2.id_servicio AND e.id = pi2.id_especialidad AND m.id = pi2.id_medico AND pi2.estado_internado = 0 AND e.id = :$item";
        } else {
            $sql = "SELECT pi.fecha_ingreso, concat_ws(' ', p.nombre_paciente, p.paterno_paciente, p.materno_paciente) as nombre_completo, p.documento_ci, p.cod_asegurado, s.nombre_sala, c.nombre_cama, se.nombre_servicio, e.nombre_especialidad, concat_ws(' ', m.nombre_medico, m.paterno_medico, m.materno_medico) as nombre_completo_medico 
            FROM pacientes p, paciente_ingresos pi, paciente_internados pi2, salas s, camas c, servicios se, especialidades e, medicos m 
            WHERE p.id = pi2.id_paciente and pi.id = pi2.id_paciente_ingreso AND s.id = pi2.id_sala AND c.id = pi2.id_cama AND se.id = pi2.id_servicio AND e.id = pi2.id_especialidad AND m.id = pi2.id_medico AND pi2.estado_internado = 0 AND se.id = :$item";
        }
            
        $stmt = Conexion::connectPostgres()->prepare($sql);

        $stmt->bindParam(":".$item, $valor, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt->close();
        $stmt = null;

    }
}

