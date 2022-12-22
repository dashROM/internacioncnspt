<?php

$item = "id";
$valor = $parametros[1];

$paciente = ControllerPacientes::ctrMostrarPacientes($item, $valor);

// Calcular la Edad a partir de la fecha de nacimiento
$nacimiento = new DateTime($paciente["fecha_nacimiento"]);
$hoy = new DateTime(date("Y-m-d"));
$edad = $hoy->diff($nacimiento);

?>

<main>

  <div class="container px-4">

    <h1 class="mt-4">DATOS PACIENTE</h1>

    <ol class="breadcrumb p-2 mb-4 shadow">

      <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/inicio">Inicio</a></li>
      <li class="breadcrumb-item active"><a href="<?= BASEURL; ?>/pacientes">Pacientes</a></li>
      <li class="breadcrumb-item active">Detalle Paciente</li>

    </ol>

    <div class="card mb-4 shadow">

      <div class="card-body">

        <div class="row">

          <div class="col-md-5 col-sm-12 col-xs-12">

            <dl class="row">

              <dt class="col-sm-5 mb-1">APELLIDO PATERNO:</dt>
              <dd class="col-sm-4 mb-1"><?= $paciente['paterno_paciente'] ?></dd>

              <dt class="col-sm-5 mb-1">APELLIDO MATERNO:</dt>
              <dd class="col-sm-4 mb-1"><?= $paciente['materno_paciente'] ?></dd>

              <dt class="col-sm-5 mb-1">NOMBRE(S):</dt>
              <dd class="col-sm-4 mb-1"><?= $paciente['nombre_paciente'] ?></dd>

              <dt class="col-sm-5 mb-1">N° DOCUMENTO (CI):</dt>
              <dd class="col-sm-4 mb-1"><?= $paciente['documento_ci'] ?></dd>

              <dt class="col-sm-5 mb-1">FECHA NACIMIENTO:</dt>
              <dd class="col-sm-4 mb-1"><?= date("d/m/Y", strtotime($paciente["fecha_nacimiento"])) ?></dd>

              <dt class="col-sm-5 mb-1">EDAD:</dt>
              <dd class="col-sm-4 mb-1"><?= $edad->y.' años '.$edad->m.' meses' ?></dd>

              <dt class="col-sm-5 mb-1">SEXO:</dt>
              <dd class="col-sm-4 mb-1"><?= $paciente['sexo'] ?></dd>

            </dl>

          </div>

          <div class="col-md-7 col-sm-12 col-xs-12">

            <dl class="row">

              <dt class="col-sm-3">COD ASEGURADO:</dt>
              <dd class="col-sm-8"><?= $paciente['cod_asegurado'] ?></dd>

              <dt class="col-sm-3">COD BENEFICIARIO:</dt>
              <dd class="col-sm-8"><?= $paciente['cod_beneficiario'] ?></dd>

              <dt class="col-sm-3">N° PATRONAL:</dt>
              <dd class="col-sm-8"><?= $paciente['nro_empleador'] ?></dd>

              <dt class="col-sm-3">RAZON SOCIAL:</dt>
              <dd class="col-sm-8"><?= $paciente['nombre_empleador'] ?></dd>

              <dt class="col-sm-3">CONSULTORIO:</dt>
              <dd class="col-sm-8"><?= $paciente['nombre_consultorio'] ?></dd>

            </dl>

          </div>

        </div>

      </div>

    </div>

    <div class="card mb-4 shadow">

      <div class="card-body">

        <button type="button" class="btn btn-primary" id="btnNuevoIngreso" idPaciente="<?= $valor ?>"><i class="fas fa-plus"></i> Ingreso Internación</button>

      </div>

    </div>

    <div class="card mb-4">

      <div class="card-header">

        <i class="fas fa-table me-1"></i>LISTADO INGRESO A INTERNACIÓN

      </div>
      
      <div class="card-body">

        <table class="table table-striped table-bordered shadow-lg mt-4" id="tblPacienteIngresos">

          <thead class="text-light bg-primary">
            <tr>
              <th scope="col">#</th> 
              <th scope="col"></th>
              <th scope="col"></th>
              <th scope="col">LUGAR</th>
              <th scope="col">FECHA INGRESO</th>
              <th scope="col">HORA INGRESO</th>
              <th scope="col">SERVICIO ACTUAL</th> 
              <th scope="col">SALA ACTUAL</th> 
              <th scope="col">CAMA ACTUAL</th>
              <th scope="col">DIAGNOSTICO CIE10</th>
              <th scope="col">DIAGNOSTICOS ESPECIFICOS ACTUAL</th>
            </tr>
          </thead>

          <tbody>

          </tbody>
        </table>

        <input id="idPaciente" type="hidden" value="<?= $valor ?>">
        <input id="sexoPaciente" type="hidden" value="<?= $paciente['sexo'] ?>">

      </div>

    </div>

  </div>

</main>

<!--=====================================
MODAL NUEVO PACIENTE INGRESO
======================================-->
<div class="modal hide fade" role="dialog" tabindex="-1" id="modalNuevoPacienteIngreso" aria-labelledby="nuevoPacienteIngreso" aria-hidden="true">

  <div class="modal-dialog modal-dialog-scrollable modal-lg">

    <div class="modal-content">

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->
      <div class="modal-header bg-modal">

        <h5 class="modal-title" id="nuevoPacienteIngreso">Registrar Nuevo Ingreso de Paciente</h5>
        <button type="button" class="btn btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->
      <div class="modal-body">

        <form method="post" id="frmNuevoPacienteIngreso">

          <div class="card mb-4">

            <div class="card-header">
              Todos los Campos con (<i class="fas fa-asterisk asterisk mr-1 mt-2"></i>) son Obligatorios
            </div>

            <div class="card-body">
              
              <div class="row">   

                <div class="col-md-6 col-sm-6 col-xs-12">

                  <!-- ENTRADA PARA LA UNIDAD SANITARIA DE ORIGEN -->  
                  <div class="form-group">

                    <label for="nuevoConsultorio" class="form-label">UNIDAD SANITARIA DE ORIGEN</label> 
                    <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <select  class="form-select" name="nuevoConsultorio" id="nuevoConsultorio" required>
                      <option value="" disabled selected>ELEGIR...</option>';
                      <?php

                      $item = null;
                      $valor = null;

                      $consultorios =  ControllerConsultorios::ctrMostrarConsultorios($item, $valor);

                      foreach($consultorios as  $key => $value) {

                        echo '<option value="'.$value["id"].'">'.$value["nombre_consultorio"].'</option>';

                      }
                      ?> 
                    </select>

                  </div>

                </div>

                <div class="col-md-6 col-sm-6 col-xs-12">

                  <!-- ENTRADA PARA EL MEDICO SOLICITANTE -->  
                  <div class="form-group">

                    <label for="nuevoMedicoTratante" class="form-label">MEDICO TRATANTE</label>
                    <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <select  class="form-select" name="nuevoMedicoTratante" id="nuevoMedicoTratante" required>
                      <option value="" disabled selected>ELEGIR...</option>';
                      <?php

                      $item = null;
                      $valor = null;

                      $medicos =  ControllerMedicos::ctrMostrarMedicos($item, $valor);

                      foreach($medicos as  $key => $value) {

                        echo '<option value="'.$value["id"].'">'.$value["nombre_medico"].' '.$value["paterno_medico"].' '.$value["materno_medico"].' ('.$value["nombre_especialidad"].')</option>';

                      }
                      ?> 
                    </select>

                  </div>

                </div>

              </div>

              <div class="row">   

                <div class="col-md-12">

                  <!-- ENTRADA PARA EL DIAGNOSTICO DE INGRESO -->
                  <div class="form-group">

                    <label for="nuevoDiagnosticoIngreso" class="form-label">DIAGNOSTICO CIE-10 AL INGRESO</label>
                    <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <select class="form-select" name="nuevoDiagnosticoIngreso" id="nuevoDiagnosticoIngreso" required>
      
                    </select>

                  </div>

                </div>

              </div>

              <div class="row">   

                <div class="col-md-12">

                  <!-- ENTRADA PARA EL DIAGNOSTICO ESPECIFICO 1 -->
                  <div class="form-group">

                    <label for="nuevoDiagnostico1" class="form-label">DIAGNOSTICOS ESPECIFICOS</label>
                    <textarea class="form-control mayuscula" name="nuevoDiagnostico1" id="nuevoDiagnostico1" placeholder="INGRESE EL 1ER DIAGNOSTICO (OPCIONAL)"></textarea>

                  </div>

                </div>

                <div class="col-md-12">

                  <!-- ENTRADA PARA EL DIAGNOSTICO ESPECIFICO 2 -->
                  <div class="form-group">

                    <textarea class="form-control mayuscula" name="nuevoDiagnostico2" id="nuevoDiagnostico2" placeholder="INGRESE EL 2DO DIAGNOSTICO (OPCIONAL)"></textarea>

                  </div>

                </div>

                <div class="col-md-12">

                  <!-- ENTRADA PARA EL DIAGNOSTICO ESPECIFICO 3 -->
                  <div class="form-group">

                    <textarea class="form-control mayuscula" name="nuevoDiagnostico3" id="nuevoDiagnostico3" placeholder="INGRESE EL 3ER DIAGNOSTICO (OPCIONAL)"></textarea>

                  </div>

                </div>

              </div>

            </div>

            <div class="card-header">
              DATOS DE INGRESO
            </div>

            <div class="card-body">

              <div class="row">

                <div class="col-md-6 col-sm-6 col-xs-12">

                  <!-- ENTRADA PARA EL ESTABLECIMIENTO -->
                  <div class="form-group">

                    <label for="nuevoEstablecimiento" class="form-label">ESTABLECIMIENTO</label>
                    <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <select class="form-select" name="nuevoEstablecimiento" id="nuevoEstablecimiento" required>
                      <option value="">ELEGIR...</option>
                      <?php

                      $item = null;
                      $valor = null;

                      $establecimientos = ControllerEstablecimientos::ctrMostrarEstablecimientos($item, $valor);

                      foreach($establecimientos as  $key => $value) {

                        echo '<option value="'.$value["id"].'"> '.$value["nombre_establecimiento"]. '</option>';
                      }
                      ?> 
                    </select>

                  </div>

                  <!-- ENTRADA PARA LA FECHA DE INGRESO -->
                  <div class="form-group">

                   <label for="nuevoFechaIngreso">FECHA INGRESO</label>
                   <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                   <input type="date" class="form-control" name="nuevoFechaIngreso" id="nuevoFechaIngreso" value="<?= date("Y-m-d"); ?>" required>

                  </div>

                  <!-- ENTRADA PARA LA HORA DE INGRESO -->
                  <div class="form-group">

                    <label for="nuevoHoraIngreso">HORA INGRESO </label>
                    <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <input type="time" class="form-control" name="nuevoHoraIngreso" id="nuevoHoraIngreso" required>

                  </div>

                </div>

                <div class="col-md-6 col-sm-6 col-xs-12">

                  <!-- ENTRADA PARA SELECCIONAR SERVICIO -->
                  <div class="form-group"> 

                    <label for="nuevoServicio" class="form-label">SERVICIO</label> 
                    <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <select class="form-select" name="nuevoServicio" id="nuevoServicio" required>
                      <option value="" disabled selected>ELEGIR...</option>';
                      <?php

                      $item = null;
                      $valor = null;

                      $servicios =  ControllerServicios::ctrMostrarServicios($item, $valor);

                      foreach($servicios as  $key => $value) {

                        echo '<option value="'.$value["id"].'">'.$value["nombre_servicio"].'</option>';

                      }
                      ?> 
                    </select>
                  </div> 

                  <!-- ENTRADA PARA SELECCIONAR ESPECIALIDAD -->
                  <div class="form-group"> 

                    <label for="nuevoEspecialidad" class="form-label">ESPECIALIDAD</label> 
                    <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <select class="form-select" name="nuevoEspecialidad" id="nuevoEspecialidad" disabled required>
                      <option value="" disabled selected>ELEGIR...</option>
                    </select>
                  </div> 

                  <!-- ENTRADA PARA SELECCIONAR SALA -->
                  <div class="form-group">

                    <label for="nuevoSala" class="form-label">SALA</label>
                    <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <select class="form-select" name="nuevoSala" id="nuevoSala" disabled required>
                      <option value="" disabled selected>ELEGIR...</option>
                    </select>

                  </div> 
                
                  <!-- ENTRADA PARA SELECCIONAR CAMA -->
                  <div class="form-group"> 

                    <label for="nuevoCama" class="form-label">CAMA</label>
                    <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <select class="form-select" name="nuevoCama" id="nuevoCama" disabled required>
                      <option value="" disabled selected>ELEGIR...</option>
                    </select>

                  </div> 
                </div>
              </div>

            </div>

            <div class="card-footer text-right">

              <button type="button" class="btn btn-round btn-danger" data-bs-dismiss="modal" aria-label="Close">

                <i class="fas fa-times"></i>
                Cerrar

              </button>

              <button type="button" class="btn btn-round btn-primary btnGuardar">

                <i class="fas fa-save"></i>
                Guardar Ingreso

              </button>

              <input type="hidden" id="nuevoIdPaciente" name="nuevoIdPaciente" value="<?= $parametros[1] ?>">

            </div>

          </div>

        </form>

      </div>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PERSONA INGRESADA
======================================--> 
<div class="modal fade" id="modalEditarPacienteIngreso" tabindex="-1" aria-labelledby="editarPacienteIngreso" aria-hidden="true">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->
      <div class="modal-header bg-modal">

        <h5 class="modal-title" id="nuevoPacienteIngreso">Editar Ingreso de Paciente</h5>

        <button type="button" class="btn btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->
      <div class="modal-body">

        <form id="frmEditarPacienteIngreso">

          <div class="card mb-4">

            <div class="card-header">
              Todos los Campos con (<i class="fas fa-asterisk asterisk mr-1 mt-2"></i>) son Obligatorios
            </div>

            <div class="card-body">

              <div class="row">

                <div class="col-md-6 col-sm-6 col-xs-12">

                  <!-- ENTRADA PARA LA UNIDAD SANITARIA DE ORIGEN -->  
                  <div class="form-group">

                    <label for="editarConsultorio" class="form-label">UNIDAD SANITARIA DE ORIGEN</label> 
                    <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <select  class="form-select" name="editarConsultorio" id="editarConsultorio" required>
                      <?php

                      $item = null;
                      $valor = null;

                      $consultorios =  ControllerConsultorios::ctrMostrarConsultorios($item, $valor);

                      foreach($consultorios as  $key => $value) {

                        echo '<option value="'.$value["id"].'">'.$value["nombre_consultorio"].'</option>';

                      }
                      ?> 
                    </select>

                  </div>

                </div>

                <div class="col-md-6 col-sm-6 col-xs-12">

                  <!-- ENTRADA PARA EL MEDICO SOLICITANTE -->  
                  <div class="form-group">

                    <label for="editarMedicoTratante" class="form-label">MEDICO TRATANTE</label>
                    <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <select  class="form-select" name="editarMedicoTratante" id="editarMedicoTratante" required>
                      <?php

                      $item = null;
                      $valor = null;

                      $servicios =  ControllerMedicos::ctrMostrarMedicos($item, $valor);

                      foreach($servicios as  $key => $value) {

                        echo '<option value="'.$value["id"].'">'.$value["nombre_medico"].' '.$value["paterno_medico"].' '.$value["materno_medico"].' ('.$value["nombre_especialidad"].')</option>';

                      }
                      ?> 
                    </select>

                  </div>

                </div>
              </div>

              <div class="row">   

                <div class="col-md-12">

                  <!-- ENTRADA PARA EL DIAGNOSTICO DE INGRESO -->
                  <div class="form-group">

                    <label for="editarDiagnosticoIngreso" class="form-label">DIAGNOSTICO CIE10 AL INGRESO</label>
                    <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <select  class="form-select" name="editarDiagnosticoIngreso" id="editarDiagnosticoIngreso" required>
      
                    </select>

                  </div>

                </div>

              </div>

              <div class="row">   

                <div class="col-md-12">

                  <!-- ENTRADA PARA EL DIAGNOSTICO ESPECIFICO 1 -->
                  <div class="form-group">

                    <label for="editarDiagnostico1" class="form-label">DIAGNOSTICOS ESPECIFICOS</label>
                    <textarea class="form-control mayuscula" name="editarDiagnostico1" id="editarDiagnostico1" placeholder="INGRESE EL 1ER DIAGNOSTICO (OPCIONAL)"></textarea>

                  </div>

                </div>

                <div class="col-md-12">

                  <!-- ENTRADA PARA EL DIAGNOSTICO ESPECIFICO 2 -->
                  <div class="form-group">

                    <textarea class="form-control mayuscula" name="editarDiagnostico2" id="editarDiagnostico2" placeholder="INGRESE EL 2DO DIAGNOSTICO (OPCIONAL)"></textarea>

                  </div>

                </div>

                <div class="col-md-12">

                  <!-- ENTRADA PARA EL DIAGNOSTICO ESPECIFICO 3 -->
                  <div class="form-group">

                    <textarea class="form-control mayuscula" name="editarDiagnostico3" id="editarDiagnostico3" placeholder="INGRESE EL 3ER DIAGNOSTICO (OPCIONAL)"></textarea>

                  </div>

                </div>

              </div>

            </div>

            <div class="card-header">
              DATOS DE INGRESO
            </div>

            <div class="card-body">

              <div class="row">

                <div class="col-md-6 col-sm-6 col-xs-12">

                  <!-- ENTRADA PARA EL ESTABLECIMIENTO -->  

                  <div class="form-group">

                    <label for="editarEstablecimiento" class="form-label">ESTABLECIMIENTO</label>
                    <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <select class="form-select" name="editarEstablecimiento" id="editarEstablecimiento" required>

                      <option value="" disabled selected>ELEGIR...</option>
                      <?php

                      $item = null;
                      $valor = null;

                      $establecimientos = ControllerEstablecimientos::ctrMostrarEstablecimientos($item, $valor);

                      foreach($establecimientos as  $key => $value) {

                        echo '<option value="'.$value["id"].'"> '.$value["nombre_establecimiento"]. '</option>';
                      }
                      ?> 
                    </select>

                  </div>

                  <!-- ENTRADA PARA LA FECHA DE INGRESO -->  

                  <div class="form-group">

                   <label for="editarFechaIngreso">FECHA INGRESO</label>
                   <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                   <input type="date" class="form-control" name="editarFechaIngreso" id="editarFechaIngreso" required>

                  </div>

                  <!-- ENTRADA LA HORA DE INGRESO -->  

                  <div class="form-group">

                    <label for="editarHoraIngreso">HORA INGRESO </label>
                    <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <input type="time" class="form-control" name="editarHoraIngreso" id="editarHoraIngreso" required>

                  </div>

                </div>

                <div class="col-md-6 col-sm-6 col-xs-12">

                  <div class="form-group"> 

                    <label for="editarServicio" class="form-label">SERVICIO</label>
                    <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <select class="form-select" name="editarServicio" id="editarServicio" required>
                      <?php

                      $item = null;
                      $valor = null;

                      $servicios =  ControllerServicios::ctrMostrarServicios($item, $valor);

                      foreach($servicios as  $key => $value) {

                        echo '<option value="'.$value["id"].'">'.$value["nombre_servicio"].'</option>';

                      }
                      ?> 
                    </select>
                  </div> 

                  <!-- ENTRADA PARA SELECCIONAR ESPECIALIDAD -->
                  <div class="form-group"> 
                    <label for="editarEspecialidad" class="form-label">ESPECIALIDAD</label> 
                    <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <select class="form-select" name="editarEspecialidad" id="editarEspecialidad" required>
                    </select>
                  </div> 

                  <div class="form-group"> 
                    <label for="editarSala" class="form-label">SALA</label>
                    <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label> 
                    <select class="form-select" name="editarSala" id="editarSala" required>
                    </select>
                  </div> 
                
                  <div class="form-group"> 
                    <label for="editarCama" class="form-label">CAMA</label>
                    <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label> 
                    <select class="form-select" name="editarCama" id="editarCama" required>
                    </select>
                  </div> 
                </div>
              </div>

            </div>

            <div class="card-footer text-right">

              <button type="button" class="btn btn-round btn-danger" data-bs-dismiss="modal" aria-label="Close">

                <i class="fas fa-times"></i>
                Cerrar

              </button>

              <button type="button" class="btn btn-round btn-primary btnGuardar">

                <i class="fas fa-save"></i>
                Guardar Cambios

              </button>

              <input type="hidden" id="editarIdPaciente" name="editarIdPaciente" value="<?= $parametros[1] ?>">
              <input type="hidden" id="editarIdIngresoPaciente" name="editarIdIngresoPaciente">
              <input type="hidden" id="editarCamaAnt" name="editarCamaAnt">
              <input type="hidden" id="transferencia" name="transferencia">

            </div>

          </div>

        </form>

      </div>

    </div>

  </div>

</div>

<!--=====================================
MODAL DAR ALTA A PACIENTE 
======================================-->
<div class="modal fade" id="modalDarAltaPaciente" tabindex="-1" aria-labelledby="darAltaPaciente" aria-hidden="true">

  <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">

    <div class="modal-content">

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->
      <div class="modal-header bg-modal">

        <h5 class="modal-title" id="darAltaPaciente">Dar Alta Paciente</h5>
        <button type="button" class="btn btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->
      <div class="modal-body">

        <div class="row">

          <div class="col-md-6 col-xs-12">

            <div class="card">

              <div class="card-header">
                DATOS DE INGRESO DE PACIENTE
              </div>

              <div class="card-body">

                <div class="row">

                  <div class="col-md-12 form-group mb-0">

                    <dl class="row">

                      <dt class="col-sm-3">FECHA INGRESO:</dt>
                      <dd class="col-sm-3" id="fechaIngreso"></dd>

                      <dt class="col-sm-3">HORA INGRESO:</dt>
                      <dd class="col-sm-3" id="horaIngreso"></dd>

                      <dt class="col-sm-4">DIAGNOSTICO INGRESO:</dt>
                      <dd class="col-sm-6" id="diagnosticoIngreso"></dd>

                      <dt class="col-sm-4">DIAGNOSTICOS ESPECIFICOS:</dt>
                      <dd class="col-sm-6" id="diagnosticosEspecificos"></dd>

                      <dt class="col-sm-4">SERVICIO INGRESO:</dt>
                      <dd class="col-sm-6" id="servicioIngreso"></dd>

                      <dt class="col-sm-3">SALA INGRESO:</dt>
                      <dd class="col-sm-3" id="salaIngreso"></dd>

                      <dt class="col-sm-3">CAMA INGRESO:</dt>
                      <dd class="col-sm-3" id="camaIngreso"></dd>

                    </dl>

                  </div>

                </div>

              </div>

              <div class="card-header">
                DATOS DE TRANSFERENCIA DE PACIENTE
              </div>

              <div class="card-body">

                <div class="table-responsive">

                  <table class="table table-striped table-bordered shadow-lg" id="tblInternacion" width="100%">

                    <thead class="text-light bg-primary">
                      
                      <tr>

                        <th>FECHA TRANSFERENCIA</th>
                        <th>DEL SERVICIO</th>
                        <th>AL SERVICIO</th>
                        <th>DIAGNOSTICO</th>

                      </tr>

                    </thead>

                    <tbody id="transferencias">
                      

                    </tbody>

                  </table>

                </div>

              </div>

            </div>

          </div>

          <div class="col-md-6 col-xs-12">

            <form id="frmDarAltaPaciente">

              <div class="card">

                <div class="card-header">
                  Todos los Campos con (<i class="fas fa-asterisk asterisk mr-1 mt-2"></i>) son Obligatorios
                </div>

                <div class="card-body">

                  <div class="row">

                    <div class="col-md-6 form-group">  
                      <label for="nuevoFechaEgreso">FECHA DE ALTA</label>
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>   
                      <input type="date" class="form-control" name="nuevoFechaEgreso" id="nuevoFechaEgreso" value="<?= date("Y-m-d"); ?>" required>
                    </div>

                    <div class="col-md-6 form-group">
                      <label for="nuevoHoraEgreso">HORA DE ALTA</label>
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                      <input type="time" class="form-control" name="nuevoHoraEgreso" id="nuevoHoraEgreso" required>
                    </div>

                  </div>

                  <div class="row"> 

                    <div class="col-md-12 form-group"> 
                      <label for="nuevoDiagnosticoEgreso" class="form-label">DIAGNOSTICO CIE-10 AL EGRESO</label>
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                      <select class="form-select" name="nuevoDiagnosticoEgreso" id="nuevoDiagnosticoEgreso" required>
                        
                      </select>
                    </div> 

                  </div>

                  <div class="row">   

                    <div class="col-md-12">

                      <!-- ENTRADA PARA EL DIAGNOSTICO ESPECIFICO 1 -->
                      <div class="form-group">

                        <label for="nuevoDiagnosticoEgreso1" class="form-label">DIAGNOSTICOS ESPECIFICOS</label>
                        <textarea class="form-control mayuscula" name="nuevoDiagnosticoEgreso1" id="nuevoDiagnosticoEgreso1" placeholder="INGRESE EL 1ER DIAGNOSTICO (OPCIONAL)"></textarea>

                      </div>

                    </div>

                    <div class="col-md-12">

                      <!-- ENTRADA PARA EL DIAGNOSTICO ESPECIFICO 2 -->
                      <div class="form-group">

                        <textarea class="form-control mayuscula" name="nuevoDiagnosticoEgreso2" id="nuevoDiagnosticoEgreso2" placeholder="INGRESE EL 2DO DIAGNOSTICO (OPCIONAL)"></textarea>

                      </div>

                    </div>

                    <div class="col-md-12">

                      <!-- ENTRADA PARA EL DIAGNOSTICO ESPECIFICO 3 -->
                      <div class="form-group">

                        <textarea class="form-control mayuscula" name="nuevoDiagnosticoEgreso3" id="nuevoDiagnosticoEgreso3" placeholder="INGRESE EL 3ER DIAGNOSTICO (OPCIONAL)"></textarea>

                      </div>

                    </div>

                  </div>

                  <div class="row">

                    <div class="col-md-6 form-group">
                      <label for="nuevoCausaEgreso" class="form-label">CAUSA DE EGRESO</label>
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                      <select class="form-select" name="nuevoCausaEgreso" id="nuevoCausaEgreso" required>
                        <option value="" disabled selected>ELEGIR...</option>
                        <option value="ALTA MEDICA">ALTA MEDICA</option>
                        <option value="TRANSFERENCIA EXTERNA">TRANSFERENCIA EXTERNA</option>
                        <option value="ABANDONO">ABANDONO</option>
                        <option value="MUERTE INSTITUCIONAL">MUERTE INSTITUCIONAL</option>
                        <option value="MUERTE NO INSTITUCIONAL">MUERTE NO INSTITUCIONAL</option>
                        <option value="ALTA SOLICITADA">ALTA SOLICITADA</option>
                        <option value="INDICIPLINA">INDICIPLINA</option>
                        <option value="OTRAS">OTRAS</option>
                      </select>  
                    </div>
                
                    <div class="col-md-6 form-group">
                      <label for="nuevoCondicionEgreso" class="form-label">CONDICION AL EGRESO</label>
                      <label class="indicadorAltaPaciente">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                      <select class="form-select" name="nuevoCondicionEgreso" id="nuevoCondicionEgreso" required>
                        <option value="" disabled selected>ELEGIR...</option>
                        <option value="CURADO">CURADO </option>
                        <option value="MEJORADO">MEJORADO </option>
                        <option value="MISMO ESTADO">MISMO ESTADO </option>
                        <option value="INCURABLE">INCURABLE </option>
                        <option value="NO TRATADO">NO TRATADO</option>
                      </select>  
                    </div>

                  </div>

                  <div class="row d-none" id="nuevoTransExterna">

                    <div class="col-md-6 form-group">
                      <label for="nuevoDestinoTransExterna" class="form-label">DESTINO TRANSFERENCIA EXTERNA</label>
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                      <select class="form-select" name="nuevoDestinoTransExterna" id="nuevoDestinoTransExterna" required>
                        <option value="" disabled selected>ELEGIR...</option>
                        <?php

                        $item = "id";
                        $valor = 5;

                        $departamentos =  ControllerDepartamentos::ctrMostrarDepartamentosTransExterna($item, $valor);

                        foreach($departamentos as  $key => $value) {

                          echo '<option value="'.$value["id"].'">'.$value["nombre_departamento"].'</option>';

                        }
                        ?> 
                      </select>  
                    </div>

                  </div>

                </div>

                <div class="card-header">
                  EN CASO DE MUERTE
                </div>

                <div class="card-body">

                  <div class="row">

                    <div class="col-md-6 form-group"> 
                      <label for="nuevoCausaClinica" class="form-label">CAUSA (CLINICA)</label>
                      <textarea class="form-control mayuscula" name="nuevoCausaClinica" id="nuevoCausaClinica" readonly></textarea> 
                    </div>

                    <div class="col-md-6 form-group"> 
                      <label for="nuevoCausaAutopsia" class="form-label">CAUSA (AUTOPSIA)</label>
                      <textarea class="form-control mayuscula" name="nuevoCausaAutopsia" id="nuevoCausaAutopsia" readonly></textarea> 
                    </div>

                  </div>

                  <div class="row">

                    <div class="col-md-12 mb-2">

                      <div class="form-check form-switch">
                        <input id="nuevoContrareferencia" type="checkbox" class="form-check-input" name="nuevoContrareferencia">
                        <label class="form-check-label" for="nuevoContrareferencia">CONTRAREFERENCIA</label>
                      </div>

                    </div>

                  </div>  

                </div>

                <div class="card-footer text-right">

                  <button type="button" class="btn btn-round btn-danger" data-bs-dismiss="modal" aria-label="Close">

                    <i class="fas fa-times"></i>
                    Cerrar

                  </button>

                  <button type="button" class="btn btn-round btn-primary btnGuardar">

                    <i class="fas fa-save"></i>
                    Guardar Egreso

                  </button>

                  <input type="hidden" id="nuevoIdPaciente" name="nuevoIdPaciente" value="<?= $parametros[1] ?>">
                  <input type="hidden" id="nuevoIdPacienteIngreso" name="nuevoIdPacienteIngreso">
                  <input type="hidden" id="nuevoIdCama" name="nuevoIdCama">
                  <input type="hidden" id="modulo" name="modulo" value="detalle-paciente">

                </div>

              </div>

            </form>

          </div>

        </div>

      </div>

    </div> 

  </div>

</div>      

<!--=====================================
MODAL VER ALTA A PACIENTE 
======================================-->
<div class="modal fade" id="modalVerAltaPaciente" tabindex="-1" aria-labelledby="verAltaPaciente" aria-hidden="true">

  <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">

    <div class="modal-content">

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->
      <div class="modal-header bg-modal">

        <h5 class="modal-title" id="verAltaPaciente">Ver Alta Paciente</h5>
        <button type="button" class="btn btn-close btn-outline-danger btnCerrarReporte" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->
      <div class="modal-body">

        <div class="row">

          <div class="col-md-5 col-xs-12">

            <div class="card">

              <div class="card-body" id="view_pdf">

              </div>

            </div>

          </div>

          <div class="col-md-7 col-xs-12">

            <form id="frmVerAltaPaciente">

              <div class="card">

                <div class="card-header">
                  DATOS DE INGRESO DE PACIENTE
                </div>

                <div class="card-body">

                  <div class="row">

                    <div class="col-md-12 form-group mb-0">

                      <dl class="row">

                        <dt class="col-sm-3">FECHA INGRESO:</dt>
                        <dd class="col-sm-3" id="fechaIngresoA"></dd>

                        <dt class="col-sm-3">HORA INGRESO:</dt>
                        <dd class="col-sm-3" id="horaIngresoA"></dd>

                        <dt class="col-sm-4">DIAGNOSTICO INGRESO:</dt>
                        <dd class="col-sm-6" id="diagnosticoIngresoA"></dd>

                        <dt class="col-sm-4">DIAGNOSTICOS ESPECIFICOS:</dt>
                        <dd class="col-sm-6" id="diagnosticosEspecificosA"></dd>

                        <dt class="col-sm-4">SERVICIO INGRESO:</dt>
                        <dd class="col-sm-6" id="servicioIngresoA"></dd>

                        <dt class="col-sm-3">SALA INGRESO:</dt>
                        <dd class="col-sm-3" id="salaIngresoA"></dd>

                        <dt class="col-sm-3">CAMA INGRESO:</dt>
                        <dd class="col-sm-3" id="camaIngresoA"></dd>

                      </dl>

                    </div>

                  </div>

                </div>

                <div class="card-header">
                  DATOS DE TRANSFERENCIA DE PACIENTE
                </div>

                <div class="card-body">

                  <div class="table-responsive">

                    <table class="table table-striped table-bordered shadow-lg" id="tblInternacion" width="100%">

                      <thead class="text-light bg-primary">

                        <tr>

                          <th>FECHA TRANSFERENCIA</th>
                          <th>DEL SERVICIO</th>
                          <th>AL SERVICIO</th>
                          <th>DIAGNOSTICO</th>

                        </tr>

                      </thead>

                      <tbody id="transferenciasA">

                      </tbody>

                    </table>

                  </div>

                </div>

                <div class="card-header">
                  DATOS DE EGRESO DE PACIENTE (ALTA)
                </div>

                <div class="card-body">

                  <div class="row">

                    <div class="col-md-12 form-group mb-0">

                      <dl class="row">

                        <dt class="col-sm-3">FECHA EGRESO:</dt>
                        <dd class="col-sm-3" id="fechaEgresoA"></dd>

                        <dt class="col-sm-3">HORA EGRESO:</dt>
                        <dd class="col-sm-3" id="horaEgresoA"></dd>

                        <dt class="col-sm-4">DIAGNOSTICO EGRESO:</dt>
                        <dd class="col-sm-6" id="diagnosticoEgresoA"></dd>

                        <dt class="col-sm-4">DIAGNOSTICO(S):</dt>
                        <dd class="col-sm-6" id="diagnosticosEgresoA"></dd>

                        <dt class="col-sm-3">CAUSA EGRESO:</dt>
                        <dd class="col-sm-3" id="causaEgresoA"></dd>

                        <dt class="col-sm-3">CONDICION EGRESO:</dt>
                        <dd class="col-sm-3" id="condicionEgresoA"></dd>

                      </dl>

                    </div>

                  </div>

                </div>

                <div class="card-footer text-right">

                  <!-- <button type="button" class="btn btn-round btn-danger" data-bs-dismiss="modal" aria-label="Close">

                    <i class="fas fa-times"></i>
                    Cerrar

                  </button> -->

                  <input type="hidden" id="nuevoIdPaciente" name="nuevoIdPaciente" value="<?= $parametros[1] ?>">

                  <input type="hidden" id="nuevoIdPacienteIngreso" name="nuevoIdPacienteIngreso">

                  <input type="hidden" id="modulo" name="modulo" value="detalle-paciente">

                </div>

              </div>

            </form>

          </div>

        </div>

      </div>

    </div> 

  </div>

</div>      

<!--=====================================
MODAL NUEVA TRASFERENCIA DE PACIENTE 
======================================-->
<div class="modal fade" id="modalNuevaTransferencia" tabindex="-1" aria-labelledby="nuevaTrasferencia" aria-hidden="true">

  <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">

    <div class="modal-content">

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->
      <div class="modal-header bg-modal">

        <h5 class="modal-title" id="nuevaTrasferencia">Nueva Transferencia Interna de Paciente</h5>
        <button type="button" class="btn btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->
      <div class="modal-body">

        <div class="row">

          <div class="col-md-6 col-xs-12">

            <div class="card">

              <div class="card-header">
                DATOS DE INGRESO DE PACIENTE
              </div>

              <div class="card-body">

                <div class="row">

                  <div class="col-md-12 form-group mb-0">

                    <dl class="row">

                      <dt class="col-sm-3">FECHA INGRESO:</dt>
                      <dd class="col-sm-3" id="fechaIngresoTrans"></dd>

                      <dt class="col-sm-3">HORA INGRESO:</dt>
                      <dd class="col-sm-3" id="horaIngresoTrans"></dd>

                      <dt class="col-sm-4">DIAGNOSTICO INGRESO:</dt>
                      <dd class="col-sm-6" id="diagnosticoIngresoTrans"></dd>

                      <dt class="col-sm-4">DIAGNOSTICOS ESPECIFICOS:</dt>
                      <dd class="col-sm-6" id="diagnosticosEspecificosTrans"></dd>

                      <dt class="col-sm-4">SERVICIO INGRESO:</dt>
                      <dd class="col-sm-6" id="servicioIngresoTrans"></dd>

                      <dt class="col-sm-3">SALA INGRESO:</dt>
                      <dd class="col-sm-3" id="salaIngresoTrans"></dd>

                      <dt class="col-sm-3">CAMA INGRESO:</dt>
                      <dd class="col-sm-3" id="camaIngresoTrans"></dd>

                    </dl>

                  </div>

                </div>

              </div>

              <div class="card-header">
                DATOS DE TRANSFERENCIA DE PACIENTE
              </div>

              <div class="card-body">

                <div class="table-responsive">

                  <table class="table table-striped table-bordered shadow-lg mt-4" id="tblPacienteTransferencias" width="100%">

                    <thead class="text-light bg-primary">

                      <tr>

                        <th scope="col"></th>
                        <th scope="col">FECHA TRANSFERENCIA</th>
                        <th scope="col">DEL SERVICIO</th>
                        <th scope="col">AL SERVICIO</th>
                        <th scope="col">DIAGNOSTICO</th>

                      </tr>

                    </thead>

                    <tbody>                      

                    </tbody>

                  </table>

                </div>

              </div>

            </div>

          </div>

          <div class="col-md-6 col-xs-12">

            <form id="frmNuevaTrasferencia">

              <div class="card mb-4">

                <div class="card-header">
                  Todos los Campos con (<i class="fas fa-asterisk asterisk mr-1 mt-2"></i>) son Obligatorios
                </div>

                <div class="card-body">

                  <div class="row">

                    <!-- ENTRADA PARA INGRESAR FECHA DE TRANSFERENCIA -->
                    <div class="col-md-6 form-group">  

                      <label for="nuevoFechaTrans">FECHA DE TRANSFERENCIA</label>
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>   
                      <input type="date" class="form-control" name="nuevoFechaTrans" id="nuevoFechaTrans" value="<?= date("Y-m-d"); ?>" required>

                    </div>

                    <!-- ENTRADA PARA EL MEDICO TRATANTE -->  
                    <div class="col-md-6 form-group">

                      <label for="nuevoMedicoSolicitanteTrans" class="form-label">MEDICO TRATANTE</label>
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                      <select  class="form-select" name="nuevoMedicoSolicitanteTrans" id="nuevoMedicoSolicitanteTrans" required>
                        <option value="" disabled selected>ELEGIR...</option>';
                        <?php

                        $item = null;
                        $valor = null;

                        $servicios =  ControllerMedicos::ctrMostrarMedicos($item, $valor);

                        foreach($servicios as  $key => $value) {

                          echo '<option value="'.$value["id"].'">'.$value["nombre_medico"].' '.$value["paterno_medico"].' '.$value["materno_medico"].' ('.$value["nombre_especialidad"].')</option>';

                        }
                        ?> 
                      </select>

                    </div>

                    <!-- ENTRADA PARA PARA INGRESAR DIAGNOSTICO DE TRANSFERENCIA -->
                    <div class="col-md-12 form-group"> 

                      <label for="nuevoDiagnosticoTrans1" class="form-label">DIAGNOSTICO(S)</label> 
                      <textarea class="form-control mayuscula" name="nuevoDiagnosticoTrans1" id="nuevoDiagnosticoTrans1" placeholder="INGRESE EL 1ER DIAGNOSTICO (OPCIONAL)"></textarea>
                    </div>

                    <!-- ENTRADA PARA EL DIAGNOSTICO TRANSFERENCIA 2 -->
                    <div class="form-group">

                      <textarea class="form-control mayuscula" name="nuevoDiagnosticoTrans2" id="nuevoDiagnosticoTrans2" placeholder="INGRESE EL 2DO DIAGNOSTICO (OPCIONAL)"></textarea>

                    </div>

                    <!-- ENTRADA PARA EL DIAGNOSTICO TRANSFERENCIA 3 -->
                    <div class="form-group">

                      <textarea class="form-control mayuscula" name="nuevoDiagnosticoTrans3" id="nuevoDiagnosticoTrans3" placeholder="INGRESE EL 3ER DIAGNOSTICO (OPCIONAL)"></textarea>

                    </div>

                    <!-- ENTRADA PARA SELECCIONAR SERVICIO -->
                    <div class="col-md-6 form-group"> 

                      <label for="nuevoServicioTrans" class="form-label">SERVICIO</label> 
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                      <select class="form-select" name="nuevoServicioTrans" id="nuevoServicioTrans" required>
                        <option value="" disabled selected>ELEGIR...</option>';
                      </select>
                    </div>

                    <!-- ENTRADA PARA SELECCIONAR ESPECIALIDAD -->
                  <div class="col-md-6 form-group"> 

                    <label for="nuevoEspecialidadTrans" class="form-label">ESPECIALIDAD</label> 
                    <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <select class="form-select" name="nuevoEspecialidadTrans" id="nuevoEspecialidadTrans" disabled required>
                      <option value="" disabled selected>ELEGIR...</option>
                    </select>
                  </div> 

                    <!-- ENTRADA PARA SELECCIONAR SALA -->
                    <div class="col-md-6 form-group"> 

                      <label for="nuevoSalaTrans" class="form-label">SALA</label>
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                      <select class="form-select" name="nuevoSalaTrans" id="nuevoSalaTrans" disabled required>
                        <option value="" disabled selected>ELEGIR...</option>
                      </select>

                    </div> 
                  
                    <!-- ENTRADA PARA SELECCIONAR CAMA -->
                    <div class="col-md-6 form-group"> 

                      <label for="nuevoCamaTrans" class="form-label">CAMA</label>
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                      <select class="form-select" name="nuevoCamaTrans" id="nuevoCamaTrans" disabled required>
                        <option value="" disabled selected>ELEGIR...</option>
                      </select>

                    </div>

                  </div>

                </div>

                <div class="card-footer text-right">

                  <button type="button" class="btn btn-round btn-danger" data-bs-dismiss="modal" aria-label="Close">

                    <i class="fas fa-times"></i>
                    Cerrar

                  </button>

                  <button type="button" class="btn btn-round btn-primary btnGuardar">

                    <i class="fas fa-save"></i>
                    Guardar Transferencia

                  </button>

                  <input type="hidden" id="nuevoIdPaciente" name="nuevoIdPaciente" value="<?= $parametros[1] ?>">
                  <input type="hidden" id="idPacienteIngresoTrans" name="idPacienteIngresoTrans">
                  <input type="hidden" id="idServicioAnt" name="idServicioAnt">
                  <input type="hidden" id="idEspecialidadAnt" name="idEspecialidadAnt">
                  <input type="hidden" id="idSalaAnt" name="idSalaAnt">
                  <input type="hidden" id="idCamaAnt" name="idCamaAnt">

                </div>

              </div>

            </form>

          </div>

        </div>

      </diV>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR TRASFERENCIA DE PACIENTE 
======================================-->
<div class="modal fade" id="modalEditarTransferencia" tabindex="-1" aria-labelledby="editarTrasferencia" aria-hidden="true">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->
      <div class="modal-header bg-modal">

        <h5 class="modal-title" id="editarTrasferencia">Editar Transferencia Interna de Paciente</h5>
        <button type="button" class="btn btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->
      <div class="modal-body">

        <div class="row">

          <div class="col-md-12 col-xs-12">

            <form id="frmEditarTrasferencia">

              <div class="card mb-4">

                <div class="card-header">
                  Todos los Campos con (<i class="fas fa-asterisk asterisk mr-1 mt-2"></i>) son Obligatorios
                </div>

                <div class="card-body">

                  <div class="row">

                    <!-- ENTRADA PARA INGRESAR FECHA DE TRANSFERENCIA -->
                    <div class="col-md-6 form-group">  

                      <label for="editarFechaTrans">FECHA DE TRANSFERENCIA</label>
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>   
                      <input type="date" class="form-control" name="editarFechaTrans" id="editarFechaTrans" value="<?= date("Y-m-d"); ?>" required>

                    </div>

                    <!-- ENTRADA PARA EL MEDICO TRATANTE -->  
                    <div class="col-md-6 form-group">

                      <label for="editarMedicoSolicitanteTrans" class="form-label">MEDICO TRATANTE</label>
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                      <select  class="form-select" name="editarMedicoSolicitanteTrans" id="editarMedicoSolicitanteTrans" required>
                        <option value="" disabled selected>ELEGIR...</option>';
                        <?php

                        $item = null;
                        $valor = null;

                        $servicios =  ControllerMedicos::ctrMostrarMedicos($item, $valor);

                        foreach($servicios as  $key => $value) {

                          echo '<option value="'.$value["id"].'">'.$value["nombre_medico"].' '.$value["paterno_medico"].' '.$value["materno_medico"].' ('.$value["nombre_especialidad"].')</option>';

                        }
                        ?> 
                      </select>

                    </div>

                    <!-- ENTRADA PARA PARA INGRESAR DIAGNOSTICO DE TRANSFERENCIA -->
                    <div class="col-md-12 form-group"> 

                      <label for="editarDiagnosticoTrans1" class="form-label">DIAGNOSTICO(S)</label> 
                      <textarea class="form-control mayuscula" name="editarDiagnosticoTrans1" id="editarDiagnosticoTrans1" placeholder="INGRESE EL 1ER DIAGNOSTICO (OPCIONAL)"></textarea>
                    </div>

                    <!-- ENTRADA PARA EL DIAGNOSTICO TRANSFERENCIA 2 -->
                    <div class="form-group">

                      <textarea class="form-control mayuscula" name="editarDiagnosticoTrans2" id="editarDiagnosticoTrans2" placeholder="INGRESE EL 2DO DIAGNOSTICO (OPCIONAL)"></textarea>

                    </div>

                    <!-- ENTRADA PARA EL DIAGNOSTICO TRANSFERENCIA 3 -->
                    <div class="form-group">

                      <textarea class="form-control mayuscula" name="editarDiagnosticoTrans3" id="editarDiagnosticoTrans3" placeholder="INGRESE EL 3ER DIAGNOSTICO (OPCIONAL)"></textarea>

                    </div>

                    <!-- ENTRADA PARA SELECCIONAR SERVICIO -->
                    <div class="col-md-6 form-group"> 

                      <label for="editarServicioTrans" class="form-label">SERVICIO</label> 
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                      <select class="form-select" name="editarServicioTrans" id="editarServicioTrans" required>
                        <?php

                        $item = null;
                        $valor = null;

                        $servicios =  ControllerServicios::ctrMostrarServicios($item, $valor);

                        foreach($servicios as  $key => $value) {

                          echo '<option value="'.$value["id"].'">'.$value["nombre_servicio"].'</option>';

                        }
                        ?> 
                      </select>
                    </div>

                    <!-- ENTRADA PARA SELECCIONAR ESPECIALIDAD -->
                  <div class="col-md-6 form-group"> 

                    <label for="editarEspecialidadTrans" class="form-label">ESPECIALIDAD</label> 
                    <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <select class="form-select" name="editarEspecialidadTrans" id="editarEspecialidadTrans" required>
                    </select>
                  </div> 

                    <!-- ENTRADA PARA SELECCIONAR SALA -->
                    <div class="col-md-6 form-group"> 

                      <label for="editarSalaTrans" class="form-label">SALA</label>
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                      <select class="form-select" name="editarSalaTrans" id="editarSalaTrans" required>
                      </select>

                    </div> 
                  
                    <!-- ENTRADA PARA SELECCIONAR CAMA -->
                    <div class="col-md-6 form-group"> 

                      <label for="editarCamaTrans" class="form-label">CAMA</label>
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                      <select class="form-select" name="editarCamaTrans" id="editarCamaTrans" required>
                      </select>

                    </div>

                  </div>

                </div>

                <div class="card-footer text-right">

                  <button type="button" class="btn btn-round btn-danger" data-bs-dismiss="modal" aria-label="Close">

                    <i class="fas fa-times"></i>
                    Cerrar

                  </button>

                  <button type="button" class="btn btn-round btn-primary btnGuardar">

                    <i class="fas fa-save"></i>
                    Guardar Cambios

                  </button>

                  <input type="hidden" id="editarIDCamaAnt" name="editarIDCamaAnt">
                  <input type="hidden" id="editarIDPacienteIngresoTrans" name="editarIDPacienteIngresoTrans"> 

                  <input type="hidden" id="ultimoIDTransferencia" name="ultimoIDTransferencia">
                  <input type="hidden" id="idTransferencia" name="idTransferencia">

                </div>

              </div>

            </form>

          </div>

        </div>

      </diV>

    </div>

  </div>

</div>

<!--=====================================
MODAL NUEVO MATERNIDAD
======================================-->
<div class="modal fade" id="modalNuevaMaternidad" tabindex="-1" aria-labelledby="nuevaMaternidad" aria-hidden="true">

  <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">

    <div class="modal-content">

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->
      <div class="modal-header bg-modal">

        <h5 class="modal-title" id="nuevaMaternidad">Registrar Maternidad</h5>
        <button type="button" class="btn btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->
      <div class="modal-body">

        <div class="row">

          <div class="col-md-6 col-xs-12">

            <div class="card">

              <div class="card-header">
              DATOS DE INGRESO DE PACIENTE
              </div>

              <div class="card-body">

                <div class="row">

                  <div class="col-md-12 form-group mb-0">

                    <dl class="row">

                      <dt class="col-sm-3">FECHA INGRESO:</dt>
                      <dd class="col-sm-3" id="fechaIngresoM"></dd>

                      <dt class="col-sm-3">HORA INGRESO:</dt>
                      <dd class="col-sm-3" id="horaIngresoM"></dd>

                      <dt class="col-sm-4">DIAGNOSTICO INGRESO:</dt>
                      <dd class="col-sm-6" id="diagnosticoIngresoM"></dd>

                      <dt class="col-sm-4">DIAGNOSTICOS ESPECIFICOS:</dt>
                      <dd class="col-sm-6" id="diagnosticosEspecificosM"></dd>

                      <dt class="col-sm-4">SERVICIO ACTUAL:</dt>
                      <dd class="col-sm-6" id="servicioIngresoM"></dd>

                      <dt class="col-sm-3">SALA ACTUAL:</dt>
                      <dd class="col-sm-3" id="salaIngresoM"></dd>

                      <dt class="col-sm-3">CAMA ACTUAL:</dt>
                      <dd class="col-sm-3" id="camaIngresoM"></dd>

                    </dl>

                  </div>

                </div>

              </div>

              <div class="card-header">
                DATOS DE TRANSFERENCIA DE PACIENTE
              </div>

              <div class="card-body">

                <div class="table-responsive-sm">

                  <table class="table table-striped table-bordered shadow-lg" id="tblInternacion" width="100%">

                    <thead class="text-light bg-primary">

                      <tr>

                        <th>FECHA TRANSFERENCIA</th>
                        <th>DEL SERVICIO</th>
                        <th>AL SERVICIO</th>
                        <th>DIAGNOSTICO</th>

                      </tr>

                    </thead>

                    <tbody id="transferenciasM">
                      

                    </tbody>

                  </table>

                </div>

              </div>

            </div>

          </div>

          <div class="col-md-6 col-xs-12">

            <form method="post" id="frmNuevaMaternidad" enctype="multipart/form-data">

              <div class="card mb-4">
                
                <div class="card-header">
                  Todos los Campos con (<i class="fas fa-asterisk asterisk mr-1 mt-2"></i>) son Obligatorios
                </div>

                <div class="card-body">

                  <div class="row">

                    <!-- ENTRADA PARA SELECCIONAR LA PROCEDENCIA -->
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group"> 
                      <label for="nuevoProcedencia" class="form-label">PROCEDENCIA</label>
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                      <select name="nuevoProcedencia" id="nuevoProcedencia" class="form-select" role="presetation" required>
                        <option value="" disabled selected>ELEGIR...</option>
                        <option value="URBANO">URBANO</option>
                        <option value="RURAL">RURAL</option>
                      </select>   
                    </div>

                    <!-- ENTRADA PARA LA PARIDAD --> 
                    <div class="col-md-3 col-sm-3 col-xs-6 form-group">
                      <label for="nuevoParidad">PARIDAD</label>
                      <input type="number" class="form-control" name="nuevoParidad" id="nuevoParidad" min=0>
                    </div>

                  </div>

                  <div class="row">

                    <!-- ENTRADA PARA EL EDAD GESTACIONAL -->
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                      <label for="nuevoEdadGestacional">EDAD GESTACIONAL</label>                      
                      <div class="input-group mb-3">
                        <input type="number" step="0.1" class="form-control" name="nuevoEdadGestacional" id="nuevoEdadGestacional" aria-describedby="gestacion" min="0.1">
                        <span class="input-group-text" id="gestacion">SEMANAS</span>
                      </div>
                    </div>

                    <!-- ENTRADA PARA SELECCIONAR EL TIPO DE PARTO -->
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group"> 
                      <label for="nuevoTipoParto" class="form-label">TIPO DE PARTO</label>
                      <select name="nuevoTipoParto" id="nuevoTipoParto" class="form-select" role="presetation">
                        <option value="" disabled selected>ELEGIR...</option>
                        <option value="EUTOCICO">EUTOCICO</option>
                        <option value="DISTOCICO">DISTOCICO</option>
                        <option value="CESAREA">CESAREA</option>
                      </select>   
                    </div>

                    <!-- ENTRADA PARA SELECCIONAR EL LIQUIDO AMNIOTICO -->
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group"> 
                      <label for="nuevoLiquidoAmniotico" class="form-label">LIQUIDO AMNIOTICO</label>
                      <select name="nuevoLiquidoAmniotico" id="nuevoLiquidoAmniotico" class="form-select" role="presetation">
                        <option value="" disabled selected>ELEGIR...</option>
                        <option value="CLARO">CLARO</option>
                        <option value="LECHOSO">LECHOSO</option>
                        <option value="BLANCO LECHOSO">BLANCO LECHOSO</option>
                        <option value="LECHOSO GRUMOSO">LECHOSO GRUMOSO</option>
                      </select>   
                    </div>

                    <!-- ENTRADA PARA LA FECHA DE PARTO -->  
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                      <label for="nuevoFechaParto">FECHA DE NACIMIENTO</label> 
                      <input type="date" class="form-control" name="nuevoFechaParto" id="nuevoFechaParto">
                    </div>

                    <!-- ENTRADA PARA LA HORA DE PARTO --> 
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                      <label for="nuevoHoraParto">HORA DE NACIMIENTO</label>
                      <input type="time" class="form-control" name="nuevoHoraParto" id="nuevoHoraParto">
                    </div>

                  </div>

                  <div class="row">

                    <div class="card mb-3">
                      
                      <div class="card-body">

                        <div class="row">

                          <!-- ENTRADA PARA EL PESO R.N. 1 --> 
                          <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                            <label for="nuevoPesoNacido1">PESO R.N. 1</label>                
                            <div class="input-group">
                              <input type="text" step="0.001" class="form-control" name="nuevoPesoNacido1" id="nuevoPesoNacido1" aria-describedby="pesoNacido1" min="0.001" max="9.999" data-inputmask="'mask': '9.999'" data-error="#errNuevoPesoNacido1">
                              <span class="input-group-text" id="pesoNacido1">Kgms.</span>
                            </div>
                            <span id="errNuevoPesoNacido1"></span>
                          </div>

                          <!-- ENTRADA PARA SELECCIONAR EL SEXO R.N. 1 -->
                          <div class="col-md-4 col-sm-4 col-xs-12 form-group"> 
                            <label for="nuevoSexoNacido1" class="form-label">SEXO R.N. 1</label>
                            <select class="form-select" name="nuevoSexoNacido1" id="nuevoSexoNacido1">
                              <option value="" disabled selected>ELEGIR...</option>
                              <option value="FEMENINO">FEMENINO</option>
                              <option value="MASCULINO">MASCULINO</option>
                            </select>
                          </div>

                          <!-- ENTRADA PARA SELECCIONAR LA CONDICION DEL R.N. 1 -->
                          <div class="col-md-4 col-sm-4 col-xs-12 form-group"> 
                            <label for="nuevoEstadoNacido1" class="form-label">ESTADO AL NACER R.N. 1</label>
                            <select class="form-select" name="nuevoEstadoNacido1" id="nuevoEstadoNacido1">
                              <option value="" disabled selected>ELEGIR...</option>
                              <option value="VIVO">VIVO</option>
                              <option value="VIVO DEPRIMIDO">VIVO DEPRIMIDO</option>
                              <option value="MUERTO">MUERTO</option>
                            </select>
                          </div>  

                          <!-- ENTRADA PARA EL PESO R.N. 2 --> 
                          <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                            <label for="nuevoPesoNacido2">PESO R.N. 2</label>                
                            <div class="input-group">
                              <input type="text" step="0.001" class="form-control" name="nuevoPesoNacido2" id="nuevoPesoNacido2" aria-describedby="pesoNacido2" min="0.001" max="9.999" data-inputmask="'mask': '9.999'" data-error="#errNuevoPesoNacido2">
                              <span class="input-group-text" id="pesoNacido2">Kgms.</span>
                            </div>
                            <span id="errNuevoPesoNacido2"></span>
                          </div>

                          <!-- ENTRADA PARA SELECCIONAR EL SEXO R.N. 2-->
                          <div class="col-md-4 col-sm-4 col-xs-12 form-group"> 
                            <label for="nuevoSexoNacido2" class="form-label">SEXO R.N. 2</label>
                            <select class="form-select" name="nuevoSexoNacido2" id="nuevoSexoNacido2">
                              <option value="" disabled selected>ELEGIR...</option>
                              <option value="FEMENINO">FEMENINO</option>
                              <option value="MASCULINO">MASCULINO</option>
                            </select>
                          </div>

                          <!-- ENTRADA PARA SELECCIONAR LA CONDICION DEL R.N. 2 -->
                          <div class="col-md-4 col-sm-4 col-xs-12 form-group"> 
                            <label for="nuevoEstadoNacido2" class="form-label">ESTADO AL NACER R.N. 2</label>
                            <select class="form-select" name="nuevoEstadoNacido2" id="nuevoEstadoNacido2">
                              <option value="" disabled selected>ELEGIR...</option>
                              <option value="VIVO">VIVO</option>
                              <option value="VIVO DEPRIMIDO">VIVO DEPRIMIDO</option>
                              <option value="MUERTO">MUERTO</option>
                            </select>
                          </div>  

                          <!-- ENTRADA PARA EL PESO R.N. 3 --> 
                          <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                            <label for="nuevoPesoNacido3">PESO R.N. 3</label>                
                            <div class="input-group">
                              <input type="text" step="0.001" class="form-control" name="nuevoPesoNacido3" id="nuevoPesoNacido3" aria-describedby="pesoNacido3" min="0.001" max="9.999" data-inputmask="'mask': '9.999'" data-error="#errNuevoPesoNacido3">
                              <span class="input-group-text" id="pesoNacido3">Kgms.</span>
                            </div>
                            <span id="errNuevoPesoNacido3"></span>
                          </div>

                          <!-- ENTRADA PARA SELECCIONAR EL SEXO R.N. 3 -->
                          <div class="col-md-4 col-sm-4 col-xs-12 form-group"> 
                            <label for="nuevoSexoNacido3" class="form-label">SEXO R.N. 3</label>
                            <select class="form-select" name="nuevoSexoNacido3" id="nuevoSexoNacido3">
                              <option value="" disabled selected>ELEGIR...</option>
                              <option value="FEMENINO">FEMENINO</option>
                              <option value="MASCULINO">MASCULINO</option>
                            </select>
                          </div>

                          <!-- ENTRADA PARA SELECCIONAR LA CONDICION DEL R.N. 3 -->
                          <div class="col-md-4 col-sm-4 col-xs-12 form-group"> 
                            <label for="nuevoEstadoNacido3" class="form-label">ESTADO AL NACER R.N. 3</label>
                            <select class="form-select" name="nuevoEstadoNacido3" id="nuevoEstadoNacido3">
                              <option value="" disabled selected>ELEGIR...</option>
                              <option value="VIVO">VIVO</option>
                              <option value="VIVO DEPRIMIDO">VIVO DEPRIMIDO</option>
                              <option value="MUERTO">MUERTO</option>
                            </select>
                          </div> 

                        </div>
                        
                      </div>

                    </div>                    

                  </div>

                  <div class="row">            

                    <!-- ENTRADA PARA SELECCIONAR EL ALUMBRAMIENTO -->
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                      <label for="nuevoAlumbramiento" class="form-label">ALUMBRAMIENTO</label>
                      <select class="form-select" name="nuevoAlumbramiento" id="nuevoAlumbramiento">
                        <option value="" disabled selected>ELEGIR...</option>
                        <option value="COMPLETO">COMPLETO</option>
                        <option value="IMCOMPLETO">IMCOMPLETO</option>
                      </select>
                    </div> 

                    <!-- ENTRADA PARA EL PERINE --> 
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                      <label for="nuevoPerine">PERINE</label>
                      <select class="form-select" name="nuevoPerine" id="nuevoPerine">
                        <option value="" disabled selected>ELEGIR...</option>
                        <option value="SANO">SANO</option>
                        <option value="SATURADO">SATURADO</option>
                        <option value="EPISIORRAFIA">EPISIORRAFIA</option>
                        <option value="DESGARRO LEVE RESUELTO">DESGARRO LEVE RESUELTO</option>
                      </select>
                    </div>

                    <!-- ENTRADA PARA SELECCIONAR EL SANGRADO -->
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                      <label for="nuevoSangrado" class="form-label">SANGRADO</label>
                      <select class="form-select" name="nuevoSangrado" id="nuevoSangrado">
                        <option value="" disabled selected>ELEGIR...</option>
                        <option value="HABITUAL">HABITUAL</option>
                        <option value="MAS DE LO HABITUAL">MAS DE LO HABITUAL</option>
                        <option value="MODERADO">MODERADO</option>
                        <option value="ESCASO">ESCASO</option>
                      </select>
                    </div>

                    <!-- ENTRADA PARA SELECCIONAR ESTADO DE LA MADRE -->
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                      <label for="nuevoEstadoMadre" class="form-label">ESTADO DE LA MADRE</label>
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                      <select class="form-select" name="nuevoEstadoMadre" id="nuevoEstadoMadre" role="presetation" required>
                        <option value="" disabled selected>ELEGIR...</option>
                        <option value="BUENO">BUENO</option>
                        <option value="REGULAR">REGULAR</option>
                        <option value="MALO">MALO</option>
                      </select>
                    </div> 

                    <!-- ENTRADA PARA EL NOMBRE DEL ESPOSO --> 
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                      <label for="nuevoNombreEsposo">NOMBRE DEL ESPOSO</label>
                      <input type="text" class="form-control mayuscula" name="nuevoNombreEsposo" id="nuevoNombreEsposo">
                    </div>              

                  </div>

                </div>

                <div class="card-footer text-right">

                  <button type="button" class="btn btn-round btn-danger" data-bs-dismiss="modal" aria-label="Close">

                    <i class="fas fa-times"></i>
                    Cerrar

                  </button>

                   <button type="button" class="btn btn-round btn-primary btnGuardar">

                    <i class="fas fa-save"></i>
                    Guardar Maternidad

                  </button>

                  <input type="hidden" id="nuevoIdPaciente" name="nuevoIdPaciente" value="<?= $parametros[1] ?>">

                  <input type="hidden" id="idPacienteIngresoM" name="idPacienteIngresoM">

                </div>

              </div>

            </form>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR MATERNIDAD
======================================-->
<div class="modal fade" id="modalEditarMaternidad" tabindex="-1" aria-labelledby="editarMaternidad" aria-hidden="true">

  <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">

    <div class="modal-content">

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->
      <div class="modal-header bg-modal">

        <h5 class="modal-title" id="editarMaternidad">Editar Maternidad</h5>
        <button type="button" class="btn btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->
      <div class="modal-body">

        <div class="row">

          <div class="col-md-6 col-xs-12">

            <div class="card">

              <div class="card-header">
              DATOS DE INGRESO DE PACIENTE
              </div>

              <div class="card-body">

                <div class="row">

                  <div class="col-md-12 form-group mb-0">

                    <dl class="row">

                      <dt class="col-sm-3">FECHA INGRESO:</dt>
                      <dd class="col-sm-3" id="fechaIngresoEM"></dd>

                      <dt class="col-sm-3">HORA INGRESO:</dt>
                      <dd class="col-sm-3" id="horaIngresoEM"></dd>

                      <dt class="col-sm-4">DIAGNOSTICO INGRESO:</dt>
                      <dd class="col-sm-6" id="diagnosticoIngresoEM"></dd>

                      <dt class="col-sm-4">DIAGNOSTICOS ESPECIFICOS:</dt>
                      <dd class="col-sm-6" id="diagnosticosEspecificosEM"></dd>

                      <dt class="col-sm-4">SERVICIO ACTUAL:</dt>
                      <dd class="col-sm-6" id="servicioIngresoEM"></dd>

                      <dt class="col-sm-3">SALA ACTUAL:</dt>
                      <dd class="col-sm-3" id="salaIngresoEM"></dd>

                      <dt class="col-sm-3">CAMA ACTUAL:</dt>
                      <dd class="col-sm-3" id="camaIngresoEM"></dd>

                    </dl>

                  </div>

                </div>

              </div>

              <div class="card-header">
                DATOS DE TRANSFERENCIA DE PACIENTE
              </div>

              <div class="card-body">

                <div class="table-responsive-sm">

                  <table class="table table-striped table-bordered shadow-lg" id="tblInternacion" width="100%">

                    <thead class="text-light bg-primary">

                      <tr>

                        <th>FECHA TRANSFERENCIA</th>
                        <th>DEL SERVICIO</th>
                        <th>AL SERVICIO</th>
                        <th>DIAGNOSTICO</th>

                      </tr>

                    </thead>

                    <tbody id="transferenciasEM">
                      

                    </tbody>

                  </table>

                </div>

              </div>

            </div>

          </div>

          <div class="col-md-6 col-xs-12">

            <form method="post" id="frmEditarMaternidad" enctype="multipart/form-data">

              <div class="card mb-4">
                
                <div class="card-header">
                  Todos los Campos con (<i class="fas fa-asterisk asterisk mr-1 mt-2"></i>) son Obligatorios
                </div>

                <div class="card-body">

                  <div class="row">

                    <!-- ENTRADA PARA SELECCIONAR LA PROCEDENCIA -->
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group"> 
                      <label for="editarProcedencia" class="form-label">PROCEDENCIA</label>
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                      <select name="editarProcedencia" id="editarProcedencia" class="form-select" role="presetation" required>
                        <option value="" disabled selected>ELEGIR...</option>
                        <option value="URBANO">URBANO</option>
                        <option value="RURAL">RURAL</option>
                      </select>   
                    </div>

                    <!-- ENTRADA PARA LA PARIDAD --> 
                    <div class="col-md-3 col-sm-3 col-xs-6 form-group">
                      <label for="editarParidad">PARIDAD</label>
                      <input type="number" class="form-control" name="editarParidad" id="editarParidad" min=0>
                    </div>

                  </div>

                  <div class="row">

                    <!-- ENTRADA PARA EL EDAD GESTACIONAL --> 
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                      <label for="editarEdadGestacional">EDAD GESTACIONAL</label>                      
                      <div class="input-group mb-3">
                        <input type="number" step="0.01" class="form-control" name="editarEdadGestacional" id="editarEdadGestacional" aria-describedby="gestacion" min="0.00">
                        <span class="input-group-text" id="gestacion">SEMANAS</span>
                      </div>
                    </div>

                    <!-- ENTRADA PARA SELECCIONAR EL TIPO DE PARTO -->
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group"> 
                      <label for="editarTipoParto" class="form-label">TIPO DE PARTO</label>
                      <select name="editarTipoParto" id="editarTipoParto" class="form-select" role="presetation">
                        <option value="" disabled selected>ELEGIR...</option>
                        <option value="EUTOCICO">EUTOCICO</option>
                        <option value="DISTOCICO">DISTOCICO</option>
                        <option value="CESAREA">CESAREA</option>
                      </select>   
                    </div>

                    <!-- ENTRADA PARA SELECCIONAR EL LIQUIDO AMNIOTICO -->
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group"> 
                      <label for="editarLiquidoAmniotico" class="form-label">LIQUIDO AMNIOTICO</label>
                      <select name="editarLiquidoAmniotico" id="editarLiquidoAmniotico" class="form-select" role="presetation">
                        <option value="" disabled selected>ELEGIR...</option>
                        <option value="CLARO">CLARO</option>
                        <option value="LECHOSO">LECHOSO</option>
                        <option value="BLANCO LECHOSO">BLANCO LECHOSO</option>
                        <option value="LECHOSO GRUMOSO">LECHOSO GRUMOSO</option>
                      </select>   
                    </div>

                    <!-- ENTRADA PARA LA FECHA DE PARTO -->  
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">

                      <label for="editarFechaParto">FECHA DE NACIMIENTO</label>
                      <input type="date" class="form-control" name="editarFechaParto" id="editarFechaParto" >
                    </div>

                    <!-- ENTRADA PARA LA HORA DE PARTO --> 
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                      <label for="editarHoraParto">HORA DE NACIMIENTO</label>
                      <input type="time" class="form-control" name="editarHoraParto" id="editarHoraParto" >
                    </div>

                  </div>

                  <div class="row">

                    <div class="card mb-3">
                      
                      <div class="card-body">

                        <div class="row">

                          <!-- ENTRADA PARA EL PESO R.N. 1 --> 
                          <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                            <label for="editarPesoNacido1">PESO R.N. 1</label>
                                             
                            <div class="input-group">
                              <input type="text" step="0.001" class="form-control" name="editarPesoNacido1" id="editarPesoNacido1" aria-describedby="pesoNacido1" max="9.999" data-inputmask="'mask': '9.999'" data-error="#errEditarPesoNacido1">
                              <span class="input-group-text" id="pesoNacido1">Kgms.</span>
                            </div>
                            <span id="errEditarPesoNacido1"></span>
                          </div>

                          <!-- ENTRADA PARA SELECCIONAR EL SEXO R.N. 1 -->
                          <div class="col-md-4 col-sm-4 col-xs-12 form-group"> 
                            <label for="editarSexoNacido1" class="form-label">SEXO R.N. 1</label>
                            <select class="form-select" name="editarSexoNacido1" id="editarSexoNacido1">
                              <option value="" disabled selected>ELEGIR...</option>
                              <option value="FEMENINO">FEMENINO</option>
                              <option value="MASCULINO">MASCULINO</option>
                            </select>
                          </div>

                          <!-- ENTRADA PARA SELECCIONAR LA CONDICION DEL R.N. 1 -->
                          <div class="col-md-4 col-sm-4 col-xs-12 form-group"> 
                            <label for="editarEstadoNacido1" class="form-label">ESTADO AL NACER R.N. 1</label>
                            <select class="form-select" name="editarEstadoNacido1" id="editarEstadoNacido1">
                              <option value="" disabled selected>ELEGIR...</option>
                              <option value="VIVO">VIVO</option>
                              <option value="VIVO DEPRIMIDO">VIVO DEPRIMIDO</option>
                              <option value="MUERTO">MUERTO</option>
                            </select>
                          </div>        

                          <!-- ENTRADA PARA EL PESO R.N. 2 --> 
                          <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                            <label for="editarPesoNacido2">PESO R.N. 2</label>                
                            <div class="input-group">
                              <input type="text" step="0.001" class="form-control" name="editarPesoNacido2" id="editarPesoNacido2" aria-describedby="pesoNacido2" min="0.001" max="9.999" data-inputmask="'mask': '9.999'" data-error="#errEditarPesoNacido2">
                              <span class="input-group-text" id="pesoNacido2">Kgms.</span>
                            </div>
                            <span id="errEditarPesoNacido2"></span>
                          </div>

                          <!-- ENTRADA PARA SELECCIONAR EL SEXO R.N. 2 -->
                          <div class="col-md-4 col-sm-4 col-xs-12 form-group"> 
                            <label for="editarSexoNacido2" class="form-label">SEXO R.N. 2</label>
                            <select class="form-select" name="editarSexoNacido2" id="editarSexoNacido2">
                              <option value="" disabled selected>ELEGIR...</option>
                              <option value="FEMENINO">FEMENINO</option>
                              <option value="MASCULINO">MASCULINO</option>
                            </select>
                          </div>

                          <!-- ENTRADA PARA SELECCIONAR LA CONDICION DEL R.N. 2 -->
                          <div class="col-md-4 col-sm-4 col-xs-12 form-group"> 
                            <label for="editarEstadoNacido2" class="form-label">ESTADO AL NACER R.N. 2</label>
                            <select class="form-select" name="editarEstadoNacido2" id="editarEstadoNacido2">
                              <option value="" disabled selected>ELEGIR...</option>
                              <option value="VIVO">VIVO</option>
                              <option value="VIVO DEPRIMIDO">VIVO DEPRIMIDO</option>
                              <option value="MUERTO">MUERTO</option>
                            </select>
                          </div>  

                          <!-- ENTRADA PARA EL PESO R.N. 3 --> 
                          <div class="col-md-4 col-sm-4 col-xs-12 form-group">
                            <label for="editarPesoNacido3">PESO R.N. 3</label>                
                            <div class="input-group">
                              <input type="text" step="0.001" class="form-control" name="editarPesoNacido3" id="editarPesoNacido3" aria-describedby="pesoNacido3" min="0.001" max="9.999" data-inputmask="'mask': '9.999'" data-error="#errEditarPesoNacido3">
                              <span class="input-group-text" id="pesoNacido3">Kgms.</span>
                            </div>
                            <span id="errEditarPesoNacido3"></span>
                          </div>

                          <!-- ENTRADA PARA SELECCIONAR EL SEXO R.N. 3 -->
                          <div class="col-md-4 col-sm-4 col-xs-12 form-group"> 
                            <label for="editarSexoNacido3" class="form-label">SEXO R.N. 3</label>
                            <select class="form-select" name="editarSexoNacido3" id="editarSexoNacido3">
                              <option value="" disabled selected>ELEGIR...</option>
                              <option value="FEMENINO">FEMENINO</option>
                              <option value="MASCULINO">MASCULINO</option>
                            </select>
                          </div>

                          <!-- ENTRADA PARA SELECCIONAR LA CONDICION DEL R.N. 2 -->
                          <div class="col-md-4 col-sm-4 col-xs-12 form-group"> 
                            <label for="editarEstadoNacido3" class="form-label">ESTADO AL NACER R.N. 3</label>
                            <select class="form-select" name="editarEstadoNacido3" id="editarEstadoNacido3">
                              <option value="" disabled selected>ELEGIR...</option>
                              <option value="VIVO">VIVO</option>
                              <option value="VIVO DEPRIMIDO">VIVO DEPRIMIDO</option>
                              <option value="MUERTO">MUERTO</option>
                            </select>
                          </div>  

                        </div>

                      </div>

                    </div>        

                    <!-- ENTRADA PARA SELECCIONAR EL ALUMBRAMIENTO -->
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                      <label for="editarAlumbramiento" class="form-label">ALUMBRAMIENTO</label>
                      <select class="form-select" name="editarAlumbramiento" id="editarAlumbramiento">
                        <option value="" disabled selected>ELEGIR...</option>
                        <option value="COMPLETO">COMPLETO</option>
                        <option value="IMCOMPLETO">IMCOMPLETO</option>
                      </select>
                    </div> 

                    <!-- ENTRADA PARA EL PERINE --> 
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                      <label for="editarPerine">PERINE</label>
                      <select class="form-select" name="editarPerine" id="editarPerine">
                        <option value="" disabled selected>ELEGIR...</option>
                        <option value="SANO">SANO</option>
                        <option value="SATURADO">SATURADO</option>
                        <option value="EPISIORRAFIA">EPISIORRAFIA</option>
                        <option value="DESGARRO LEVE RESUELTO">DESGARRO LEVE RESUELTO</option>
                      </select>
                    </div>

                    <!-- ENTRADA PARA SELECCIONAR EL SANGRADO -->
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                      <label for="editarSangrado" class="form-label">SANGRADO</label>
                      <select class="form-select" name="editarSangrado" id="editarSangrado">
                        <option value="" disabled selected>ELEGIR...</option>
                        <option value="HABITUAL">HABITUAL</option>
                        <option value="MAS DE LO HABITUAL">MAS DE LO HABITUAL</option>
                        <option value="MODERADO">MODERADO</option>
                        <option value="ESCASO">ESCASO</option>
                      </select>
                    </div>

                    <!-- ENTRADA PARA SELECCIONAR ESTADO DE LA MADRE -->
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                      <label for="editarEstadoMadre" class="form-label">ESTADO DE LA MADRE</label>
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                      <select class="form-select" name="editarEstadoMadre" id="editarEstadoMadre" role="presetation" required>
                        <option value="" disabled selected>ELEGIR...</option>
                        <option value="BUENO">BUENO</option>
                        <option value="REGULAR">REGULAR</option>
                        <option value="MALO">MALO</option>
                      </select>
                    </div> 

                    <!-- ENTRADA PARA EL NOMBRE DEL ESPOSO --> 
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                      <label for="editarNombreEsposo">NOMBRE DEL ESPOSO</label>
                      <input type="text" class="form-control mayuscula" name="editarNombreEsposo" id="editarNombreEsposo">
                    </div>              

                  </div>

                </div>

                <div class="card-footer text-right">

                  <button type="button" class="btn btn-round btn-danger" data-bs-dismiss="modal" aria-label="Close">

                    <i class="fas fa-times"></i>
                    Cerrar

                  </button>

                   <button type="button" class="btn btn-round btn-primary btnGuardar">

                    <i class="fas fa-save"></i>
                    Guardar Cambios

                  </button>

                  <input type="hidden" id="nuevoIdPaciente" name="nuevoIdPaciente" value="<?= $parametros[1] ?>">

                  <input type="hidden" id="idPacienteIngresoEM" name="idPacienteIngresoEM">

                  <input type="hidden" id="idMaternidad" name="idMaternidad">

                </div>

              </div>

            </form>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>

<!--=====================================
MODAL NUEVO NEONATO
======================================-->
<div class="modal fade" id="modalNuevoNeonato" tabindex="-1" aria-labelledby="nuevoNeonato" aria-hidden="true">

  <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">

    <div class="modal-content">

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->
      <div class="modal-header bg-modal">

        <h5 class="modal-title" id="nuevoNeonato">Registrar Neonato</h5>
        <button type="button" class="btn btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->
      <div class="modal-body">

        <div class="row">

          <div class="col-md-6 col-xs-12">

            <div class="card">

              <div class="card-header">
              DATOS DE INGRESO DE PACIENTE
              </div>

              <div class="card-body">

                <div class="row">

                  <div class="col-md-12 form-group mb-0">

                    <dl class="row">

                      <dt class="col-sm-3">FECHA INGRESO:</dt>
                      <dd class="col-sm-3" id="fechaIngresoN"></dd>

                      <dt class="col-sm-3">HORA INGRESO:</dt>
                      <dd class="col-sm-3" id="horaIngresoN"></dd>

                      <dt class="col-sm-4">DIAGNOSTICO INGRESO:</dt>
                      <dd class="col-sm-6" id="diagnosticoIngresoN"></dd>

                      <dt class="col-sm-4">DIAGNOSTICOS ESPECIFICOS:</dt>
                      <dd class="col-sm-6" id="diagnosticosEspecificosN"></dd>

                      <dt class="col-sm-4">SERVICIO ACTUAL:</dt>
                      <dd class="col-sm-6" id="servicioIngresoN"></dd>

                      <dt class="col-sm-3">SALA ACTUAL:</dt>
                      <dd class="col-sm-3" id="salaIngresoN"></dd>

                      <dt class="col-sm-3">CAMA ACTUAL:</dt>
                      <dd class="col-sm-3" id="camaIngresoN"></dd>

                    </dl>

                  </div>

                </div>

              </div>

              <div class="card-header">
                DATOS DE TRANSFERENCIA DE PACIENTE
              </div>

              <div class="card-body">

                <div class="table-responsive-sm">

                  <table class="table table-striped table-bordered shadow-lg" id="tblInternacion" width="100%">

                    <thead class="text-light bg-primary">

                      <tr>

                        <th>FECHA TRANSFERENCIA</th>
                        <th>DEL SERVICIO</th>
                        <th>AL SERVICIO</th>
                        <th>DIAGNOSTICO</th>

                      </tr>

                    </thead>

                    <tbody id="transferenciasN">
                      

                    </tbody>

                  </table>

                </div>

              </div>

            </div>

          </div>

          <div class="col-md-6 col-xs-12">

            <form method="post" id="frmNuevoNeonato" enctype="multipart/form-data">

              <div class="card mb-4">
                
                <div class="card-header">
                  Todos los Campos con (<i class="fas fa-asterisk asterisk mr-1 mt-2"></i>) son Obligatorios
                </div>

                <div class="card-body">

                  <div class="row">

                    <!-- ENTRADA PARA EL PESO --> 
                    <div class="col-md-3 col-sm-3 col-xs-6 form-group">
                      <label for="nuevoPesoNeonato">PESO</label>
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                      <input type="text" step="0.001" class="form-control" name="nuevoPesoNeonato" id="nuevoPesoNeonato" min="0.001" max="9.999" data-inputmask="'mask': '9.999'" required>
                    </div>

                    <!-- ENTRADA PARA LA TALLA --> 
                    <div class="col-md-3 col-sm-3 col-xs-6 form-group">
                      <label for="nuevoTallaNeonato">TALLA</label>
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                      <input type="text" step="1" class="form-control" name="nuevoTallaNeonato" id="nuevoTallaNeonato" min="0" max="99" data-inputmask="'mask': '99'" required>
                    </div>

                    <!-- ENTRADA PARA VARIABLE PC --> 
                    <div class="col-md-3 col-sm-3 col-xs-6 form-group">
                      <label for="nuevoPCNeonato">PC</label>
                      <input type="number" step="0.1" class="form-control" name="nuevoPCNeonato" id="nuevoPCNeonato" min="0.1" max="99.9">
                    </div>

                    <!-- ENTRADA PARA VARIABLE PT --> 
                    <div class="col-md-3 col-sm-3 col-xs-6 form-group">
                      <label for="nuevoPTNeonato">PT</label>
                      <input type="number" step="0.1" class="form-control" name="nuevoPTNeonato" id="nuevoPTNeonato" min="0.1" max="99.9">
                    </div>

                    <!-- ENTRADA PARA LA VARIABLE APGAR --> 
                    <div class="col-md-3 col-sm-3 col-xs-6 form-group">
                      <label for="nuevoAPGAR">APGAR</label>
                      <input type="text" class="form-control" name="nuevoAPGAR" id="nuevoAPGAR">
                    </div>

                    <!-- ENTRADA PARA EL EDAD GESTACIONAL --> 
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                      <label for="nuevoEdadGestacional">EDAD GESTACIONAL</label>                     
                      <div class="input-group">
                        <input type="number" step="0.1" class="form-control" name="nuevoEdadGestacional" id="nuevoEdadGestacional" aria-describedby="edadGestacional" min="0.1" data-error="#errNuevoEdadGestacional">
                        <span class="input-group-text" id="edadGestacional">SEMANAS</span>
                      </div>
                      <span id="errNuevoEdadGestacional"></span>
                    </div>

                    <!-- ENTRADA PARA SELECCIONAR EL TIPO DE PARTO -->
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group"> 
                      <label for="nuevoTipoPartoNeonato" class="form-label">TIPO DE PARTO</label>
                      <select name="nuevoTipoPartoNeonato" id="nuevoTipoPartoNeonato" class="form-select" role="presetation">
                        <option value="" disabled selected>ELEGIR...</option>
                        <option value="EUTOCICO">EUTOCICO</option>
                        <option value="DISTOCICO">DISTOCICO</option>
                        <option value="CESAREA">CESAREA</option>
                      </select>   
                    </div>

                    <!-- ENTRADA PARA EL NOMBRE DEL ESPOSO --> 
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                      <label for="nuevoDescripcionParto">DESCRIPCION PARTO</label>
                      <textarea name="nuevoDescripcionParto" id="nuevoDescripcionParto" class="form-control" cols="30" rows="3"></textarea>
                    </div>    

                  </div>

                </div>

                <div class="card-footer text-right">

                  <button type="button" class="btn btn-round btn-danger" data-bs-dismiss="modal" aria-label="Close">

                    <i class="fas fa-times"></i>
                    Cerrar

                  </button>

                   <button type="button" class="btn btn-round btn-primary btnGuardar">

                    <i class="fas fa-save"></i>
                    Guardar Neonato

                  </button>

                  <input type="hidden" id="nuevoIdPaciente" name="nuevoIdPaciente" value="<?= $parametros[1] ?>">

                  <input type="hidden" id="idPacienteIngresoN" name="idPacienteIngresoN">

                </div>

              </div>

            </form>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR NEONATO
======================================-->
<div class="modal fade" id="modalEditarNeonato" tabindex="-1" aria-labelledby="editarNeonato" aria-hidden="true">

  <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">

    <div class="modal-content">

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->
      <div class="modal-header bg-modal">

        <h5 class="modal-title" id="editarNeonato">Editar Neonato</h5>
        <button type="button" class="btn btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->
      <div class="modal-body">

        <div class="row">

          <div class="col-md-6 col-xs-12">

            <div class="card">

              <div class="card-header">
              DATOS DE INGRESO DE PACIENTE
              </div>

              <div class="card-body">

                <div class="row">

                  <div class="col-md-12 form-group mb-0">

                    <dl class="row">

                      <dt class="col-sm-3">FECHA INGRESO:</dt>
                      <dd class="col-sm-3" id="fechaIngresoEN"></dd>

                      <dt class="col-sm-3">HORA INGRESO:</dt>
                      <dd class="col-sm-3" id="horaIngresoEN"></dd>

                      <dt class="col-sm-4">DIAGNOSTICO INGRESO:</dt>
                      <dd class="col-sm-6" id="diagnosticoIngresoEN"></dd>

                      <dt class="col-sm-4">DIAGNOSTICOS ESPECIFICOS:</dt>
                      <dd class="col-sm-6" id="diagnosticosEspecificosEN"></dd>

                      <dt class="col-sm-4">SERVICIO ACTUAL:</dt>
                      <dd class="col-sm-6" id="servicioIngresoEN"></dd>

                      <dt class="col-sm-3">SALA ACTUAL:</dt>
                      <dd class="col-sm-3" id="salaIngresoEN"></dd>

                      <dt class="col-sm-3">CAMA ACTUAL:</dt>
                      <dd class="col-sm-3" id="camaIngresoEN"></dd>

                    </dl>

                  </div>

                </div>

              </div>

              <div class="card-header">
                DATOS DE TRANSFERENCIA DE PACIENTE
              </div>

              <div class="card-body">

                <div class="table-responsive-sm">

                  <table class="table table-striped table-bordered shadow-lg" id="tblInternacion" width="100%">

                    <thead class="text-light bg-primary">

                      <tr>

                        <th>FECHA TRANSFERENCIA</th>
                        <th>DEL SERVICIO</th>
                        <th>AL SERVICIO</th>
                        <th>DIAGNOSTICO</th>

                      </tr>

                    </thead>

                    <tbody id="transferenciasEN">
                      

                    </tbody>

                  </table>

                </div>

              </div>

            </div>

          </div>

          <div class="col-md-6 col-xs-12">

            <form method="post" id="frmEditarNeonato" enctype="multipart/form-data">

              <div class="card mb-4">
                
                <div class="card-header">
                  Todos los Campos con (<i class="fas fa-asterisk asterisk mr-1 mt-2"></i>) son Obligatorios
                </div>

                <div class="card-body">

                  <div class="row">

                    <!-- ENTRADA PARA EL PESO --> 
                    <div class="col-md-3 col-sm-3 col-xs-6 form-group">
                      <label for="editarPesoNeonato">PESO</label>
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                      <input type="text" step="0.001" class="form-control" name="editarPesoNeonato" id="editarPesoNeonato" min="0.001" max="9.999" data-inputmask="'mask': '9.999'" required>
                    </div>

                    <!-- ENTRADA PARA LA TALLA --> 
                    <div class="col-md-3 col-sm-3 col-xs-6 form-group">
                      <label for="editarTallaNeonato">TALLA</label>
                      <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                      <input type="text" step="1" class="form-control" name="editarTallaNeonato" id="editarTallaNeonato" min="0" max="99" data-inputmask="'mask': '99'" required>
                    </div>

                    <!-- ENTRADA PARA VARIABLE PC --> 
                    <div class="col-md-3 col-sm-3 col-xs-6 form-group">
                      <label for="editarPCNeonato">PC</label>
                      <input type="number" step="0.01" class="form-control" name="editarPCNeonato" id="editarPCNeonato" min="0" max="99.9">
                    </div>

                    <!-- ENTRADA PARA VARIABLE PT --> 
                    <div class="col-md-3 col-sm-3 col-xs-6 form-group">
                      <label for="editarPTNeonato">PT</label>
                      <input type="number" step="0.01" class="form-control" name="editarPTNeonato" id="editarPTNeonato" min="0" max="99">
                    </div>

                    <!-- ENTRADA PARA LA VARIABLE APGAR --> 
                    <div class="col-md-3 col-sm-3 col-xs-6 form-group">
                      <label for="editarAPGAR">APGAR</label>
                      <input type="text" class="form-control" name="editarAPGAR" id="editarAPGAR">
                    </div>

                    <!-- ENTRADA PARA EL EDAD GESTACIONAL --> 
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                      <label for="editarEdadGestacional">EDAD GESTACIONAL</label>                    
                      <div class="input-group">
                        <input type="number" step="0.01" class="form-control" name="editarEdadGestacional" id="editarEdadGestacional" aria-describedby="edadGestacional" min="0" data-error="#errEditarEdadGestacional" >
                        <span class="input-group-text" id="edadGestacional">SEMANAS</span>
                      </div>
                      <span id="errEditarEdadGestacional"></span>
                    </div>

                    <!-- ENTRADA PARA SELECCIONAR EL TIPO DE PARTO -->
                    <div class="col-md-6 col-sm-6 col-xs-12 form-group"> 
                      <label for="editarTipoPartoNeonato" class="form-label">TIPO DE PARTO</label>
                      <select name="editarTipoPartoNeonato" id="editarTipoPartoNeonato" class="form-select" role="presetation">
                        <option value="" disabled selected>ELEGIR...</option>
                        <option value="EUTOCICO">EUTOCICO</option>
                        <option value="DISTOCICO">DISTOCICO</option>
                        <option value="CESAREA">CESAREA</option>
                      </select>   
                    </div>

                    <!-- ENTRADA PARA EL NOMBRE DEL ESPOSO --> 
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                      <label for="editarDescripcionParto">DESCRIPCION PARTO</label>
                      <textarea name="editarDescripcionParto" id="editarDescripcionParto" class="form-control mayuscula" cols="30" rows="3"></textarea>
                    </div>    

                  </div>

                </div>

                <div class="card-footer text-right">

                  <button type="button" class="btn btn-round btn-danger" data-bs-dismiss="modal" aria-label="Close">

                    <i class="fas fa-times"></i>
                    Cerrar

                  </button>

                   <button type="button" class="btn btn-round btn-primary btnGuardar">

                    <i class="fas fa-save"></i>
                    Guardar Cambios

                  </button>

                  <input type="hidden" id="editarIdPaciente" name="editarIdPaciente" value="<?= $parametros[1] ?>">

                  <input type="hidden" id="idPacienteIngresoEN" name="idPacienteIngresoEN">

                  <input type="hidden" id="idNeonato" name="idNeonato">

                </div>

              </div>

            </form>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>

<!--=====================================
MODAL NUEVO REFERENCIA
======================================-->
<div class="modal fade" id="modalNuevoReferencia" tabindex="-1" aria-labelledby="nuevoReferencia" aria-hidden="true">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->
      <div class="modal-header bg-modal">

        <h5 class="modal-title" id="nuevoReferencia">Registrar Referencia</h5>
        <button type="button" class="btn btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->
      <div class="modal-body">

        <form method="post" id="frmNuevoReferencia" enctype="multipart/form-data">

          <div class="card mb-4">
            
            <div class="card-header">
              Todos los Campos con (<i class="fas fa-asterisk asterisk mr-1 mt-2"></i>) son Obligatorios
            </div>

            <div class="card-body">

              <div class="row">

                <!-- ENTRADA PARA EL ESTABLECIMIENTO DE REFERENCIA -->

                <div class="col-md-6 form-group align-self-center">

                  <div class="form-group">

                    <label for="nuevoEstablecimientoRef" class="form-label">ESTABLECIMIENTO DE REFERENCIA</label>
                    <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <select class="form-select" name="nuevoEstablecimientoRef" id="nuevoEstablecimientoRef" required>
                      <option value="" disabled selected>ELEGIR...</option>
                      <?php

                      $item = 'id';
                      $valor = 1;

                      $establecimientosRef = ControllerEstablecimientos::ctrMostrarEstablecimientosReferencia($item, $valor);

                      foreach($establecimientosRef as  $key => $value) {

                        echo '<option value="'.$value["id"].'"> '.$value["nombre_establecimiento"]. '</option>';
                      }
                      ?> 
                    </select>

                  </div>

                </div>

                <!-- ENTRADA PARA EL AJO -->
                
                <div class="col-md-6 form-group text-center align-self-center">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input mt-1" type="checkbox" name="nuevoRefAdecuado" id="nuevoRefAdecuado" value="ADECUADO">
                    <label class="form-check-label" for="nuevoRefAdecuado">A</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input mt-1" type="checkbox" name="nuevoRefJustificado" id="nuevoRefJustificado" value="JUSTIFICADO">
                    <label class="form-check-label" for="nuevoRefJustificado">J</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input mt-1" type="checkbox" name="nuevoRefOportuno" id="nuevoRefOportuno" value="OPORTUNO">
                    <label class="form-check-label" for="nuevoRefOportuno">O</label>
                  </div>
                </div>
                
              </div>

            </div>

            <div class="card-footer text-right">

              <button type="button" class="btn btn-round btn-danger" data-bs-dismiss="modal" aria-label="Close">

                <i class="fas fa-times"></i>
                Cerrar

              </button>

               <button type="button" class="btn btn-round btn-primary btnGuardar">

                <i class="fas fa-save"></i>
                Guardar Referencia

              </button>

              <input type="hidden" id="nuevoIdPaciente" name="nuevoIdPaciente" value="<?= $parametros[1] ?>">

              <input type="hidden" id="idPacienteIngresoR" name="idPacienteIngresoR">

            </div>

          </div>

        </form>

      </div>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR REFERENCIA
======================================-->
<div class="modal fade" id="modalEditarReferencia" tabindex="-1" aria-labelledby="editarReferencia" aria-hidden="true">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->
      <div class="modal-header bg-modal">

        <h5 class="modal-title" id="editarReferencia">Editar Referencia</h5>
        <button type="button" class="btn btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->
      <div class="modal-body">

        <form method="post" id="frmEditarReferencia" enctype="multipart/form-data">

          <div class="card mb-4">
            
            <div class="card-header">
              Todos los Campos con (<i class="fas fa-asterisk asterisk mr-1 mt-2"></i>) son Obligatorios
            </div>

            <div class="card-body">

              <div class="row">

                <!-- ENTRADA PARA EL ESTABLECIMIENTO DE REFERENCIA -->

                <div class="col-md-6 form-group align-self-center">

                  <div class="form-group">

                    <label for="editarEstablecimientoRef" class="form-label">ESTABLECIMIENTO DE REFERENCIA</label>
                    <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <select class="form-select" name="editarEstablecimientoRef" id="editarEstablecimientoRef" required>
                      <option value="" disabled selected>ELEGIR...</option>
                      <?php

                      $item = 'id';
                      $valor = 1;

                      $establecimientosRef = ControllerEstablecimientos::ctrMostrarEstablecimientosReferencia($item, $valor);

                      foreach($establecimientosRef as  $key => $value) {

                        echo '<option value="'.$value["id"].'"> '.$value["nombre_establecimiento"]. '</option>';
                      }
                      ?> 
                    </select>

                  </div>

                </div>

                <!-- ENTRADA PARA EL AJO -->
                
                <div class="col-md-6 form-group text-center align-self-center">
                  <div class="form-check form-check-inline">
                    <input class="form-check-input mt-1" type="checkbox" name="editarRefAdecuado" id="editarRefAdecuado" value="ADECUADO">
                    <label class="form-check-label" for="editarRefAdecuado">A</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input mt-1" type="checkbox" name="editarRefJustificado" id="editarRefJustificado" value="JUSTIFICADO">
                    <label class="form-check-label" for="editarRefJustificado">J</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input mt-1" type="checkbox" name="editarRefOportuno" id="editarRefOportuno" value="OPORTUNO">
                    <label class="form-check-label" for="editarRefOportuno">O</label>
                  </div>
                </div>
                
              </div>

            </div>

            <div class="card-footer text-right">

              <button type="button" class="btn btn-round btn-danger" data-bs-dismiss="modal" aria-label="Close">

                <i class="fas fa-times"></i>
                Cerrar

              </button>

               <button type="button" class="btn btn-round btn-primary btnGuardar">

                <i class="fas fa-save"></i>
                Guardar Cambios

              </button>

              <input type="hidden" id="editarIdPaciente" name="editarIdPaciente" value="<?= $parametros[1] ?>">

              <input type="hidden" id="idPacienteIngresoER" name="idPacienteIngresoER">

              <input type="hidden" id="idReferencia" name="idReferencia">

            </div>

          </div>

        </form>

      </div>

    </div>

  </div>

</div>

<!--=====================================
MODAL REPORTE PACIENTE
======================================-->
<div  id="ver-pdf" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog" tabindex="-1" aria-labelledby="reportePaciente" aria-hidden="true">
  <div class="modal-dialog modal-xl">

    <div class="modal-content">

      <div class="modal-header bg-modal">
        <h5 class="modal-title" id="reportePaciente">Reporte Paciente</h5>
        <button type="button" class="btn-close btnCerrarReporte" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>                   

      <div class="modal-body">
        <div id="view_pdf_frm204" style="height:550px"> 


        </div>  
      </div>  

      <div class="modal-footer">
        <button type="button" class="btn btn-danger btnCerrar float-left" data-bs-dismiss="modal">Cerrar</button>   
      </div>

    </div>

  </div>
</div>