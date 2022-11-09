<main>

	<div class="container-xl px-4">

		<h1 class="mt-4">PACIENTES</h1>

		<ol class="breadcrumb p-2 mb-4 shadow">

      <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/inicio">Inicio</a></li>
      <li class="breadcrumb-item active">Pacientes</li>

    </ol>

    <div class="card mb-4 shadow">

      <div class="card-body">

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevoPaciente"><i class="fas fa-plus"></i> Nuevo Paciente</button>

      </div>

    </div>

    <div class="card mb-4">

      <div class="card-header">

        <i class="fas fa-table me-1"></i>LISTADO PACIENTES

      </div>

      <div class="card-body">

        <table class="table table-striped table-bordered shadow-lg mt-4" id="tblPacientes">

          <thead class="text-light bg-primary">
            <tr>
              <th scope="col">#</th>
              <th scope="col"></th>              
              <th scope="col">NOMBRE(S)</th>
              <th scope="col">A. PATERNO</th>
              <th scope="col">A. MATERNO</th>
              <th scope="col">DOCUMENTO(CI)</th> 
              <th scope="col">COD ASEGURADO</th>
              <th scope="col">COD BENEFICIARIO</th>
              <th scope="col">FECHA NACIM.</th>
              <th scope="col">EDAD</th>
              <th scope="col">ESTADO CIVIL</th>
              <th scope="col">SEXO</th>
              <th scope="col">DOMICILIO</th>
              <th scope="col">TELEFONO</th> 
              <th scope="col">N° PATRONAL</th>
              <th scope="col">EMPRESA</th>
              <th scope="col">CONSULTORIO</th>
              <th scope="col">ESTADO ASEGURADO</th>      
            </tr>
          </thead>

          <tbody>

          </tbody>

        </table>

      </div>

    </div>

  </div>

</main>

<!--=====================================
MODAL NUEVO PACIENTE
======================================-->
<div class="modal fade" id="modalNuevoPaciente" tabindex="-1" aria-labelledby="nuevoPaciente" aria-hidden="true">

  <div class="modal-dialog modal-dialog-scrollable modal-lg">

    <div class="modal-content">

      <div class="modal-header bg-modal">

        <h5 class="modal-title" id="nuevoPaciente">Nuevo Paciente</h5>
        
        <button type="button" class="btn btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <div class="modal-body">

        <div class="card mb-4">

          <div class="card-header">
            Todos los Campos con (<i class="fas fa-asterisk asterisk mr-1 mt-2"></i>) son Obligatorios
          </div>

          <div class="card-body">

            <div class="row">

              <div class="offset-md-2 col-md-8 offset-md-2 col-sm-12">

                <form class="form-group" method="post" id="frmOpcionPaciente">

                  <label class="font-weight-normal" for="selectOpcionPaciente">OPCIÓN DE BUSQUEDA DE PACIENTE</label>
                  <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>

                  <select class="form-select mb-3" id="selectOpcionPaciente" name="selectOpcionPaciente" required>
                    <option value="" disabled selected>SELECCIONE UNA OPCIÓN...</option>
                    <option value="1">DATOS SISTEMA SIAIS</option>
                    <!-- <option value="2">DATOS AFILIACIONES ERP</option> -->
                    <option value="3">INGRESO MANUAL DE DATOS</option>
                  </select>

                </form>

              </div>

            </div>

            <div class="row g-3 d-none" id="filtroSIAIS">

              <div class="col-md-12">

                <!--=============================================
                SECCION PARA EL BUSCADOR VINCULADO AL ERP
                =============================================-->

                <div class="right_col alert alert-info" role="main">

                  <form id="frmBuscarAfiliadoSIAIS">

                    <div class="row">

                      <div class="form-group col-xs-12 col-sm-12 col-md-12 col-lg-6">

                        <label>CODIGO AVC-04</label>
                        <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                        <div class="input-group">

                          <select class="form-control form-control-sm" id="buscarCodAsegurado" name="buscarCodAsegurado" data-bs-toggle="modal" data-bs-target="#modalCodAsegurado">
                            <option value=""></option>
                          </select>

                        </div>

                      </div>

                    </div>   

                  </form>

                </div>

                <!-- FIN BUSCADOR -->

              </div>

            </div>

            <div class="row g-3 d-none" id="filtroERP">

              <div class="col-md-12">

                <!--=============================================
                SECCION PARA EL BUSCADOR VINCULADO AL ERP
                =============================================-->

                <div class="right_col alert alert-info" role="main">

                  <form id="frmBuscarAfiliadoERP">

                    <div class="col-xs-12 col-sm-10 col-md-9 col-lg-9">

                      <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">

                          <div class="form-group">

                            <label for="fecha_nacimientoERP">Fecha Nacimiento</label>
                            <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                            <input type="date" class="form-control" name="fecha_nacimientoERP" id="fecha_nacimientoERP"> 

                          </div>

                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">

                          <label for="documentoERP">N° Documento - CI</label>
                          <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                          <div class="input-group">

                            <input type="number" class="form-control" name="documentoERP" id="documentoERP" placeholder="50333...">
                            <span class="input-group-btn ml-2">
                              <button class="btn btn-primary" type="button" id="btnSearch">
                                <i class="fas fa-search"></i> Buscar
                              </button>
                            </span>

                          </div>

                        </div>
                      </div>

                      <font id="mensaje" style="display: none; color: blue;">Buscando...Espere por favor!</font>
                      <font id="error" style="display: none; color: red">Ocurrió un Error. Por favor vuelva a intentar!</font>

                    </div>   

                  </form>

                </div>

                <!-- FIN BUSCADOR -->

              </div>

            </div>

          </div>

          <form method="post" id="frmNuevoPaciente">

            <div class="card">

              <div class="card-header">
                DATOS PERSONALES
              </div>

              <div class="card-body">

                <div class="row d-none" id="fechaNacimientoCIPaciente">

                  <div class="col-md-12 mb-2">

                    <div class="form-check-inline form-switch">
                      <input id="nuevoSinDocumento" type="checkbox" class="form-check-input" name="nuevoSinDocumento">
                      <label class="form-check-label" for="nuevoSinDocumento">SIN DOCUMENTO</label>
                    </div>

                  </div>

                  <div class="col-md-6 form-group">
                    <label for="nuevoDocumentoCiPaciente" class="form-label mayuscula">DOCUMENTO (CI)</label>
                    <input id="nuevoDocumentoCiPaciente" type="text" class="form-control" name="nuevoDocumentoCiPaciente">
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="nuevoFechaNacimientoPaciente" class="form-label">FECHA NACIMIENTO</label>
                    <input id="nuevoFechaNacimientoPaciente" type="date" class="form-control" name="nuevoFechaNacimientoPaciente">
                  </div>

                </div>

                <div class="row">

                  <div class="col-md-6 form-group">
                    <label for="nuevoPaternoPaciente" class="form-label">A. PATERNO</label>
                    <input id="nuevoPaternoPaciente" type="text" class="form-control mayuscula" name="nuevoPaternoPaciente" readonly>
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="nuevoMaternoPaciente" class="form-label">A. MATERNO</label>
                    <input id="nuevoMaternoPaciente" type="text" class="form-control mayuscula" name="nuevoMaternoPaciente" readonly>
                  </div>

                </div>

                <div class="row">

                  <div class="col-md-6 form-group">
                    <label for="nuevoNombrePaciente" class="form-label">NOMBRE(S)</label>
                    <input id="nuevoNombrePaciente" type="text" class="form-control mayuscula" name="nuevoNombrePaciente" readonly>
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="nuevoEdadPaciente" class="form-label">EDAD</label>
                    <input id="nuevoEdadPaciente" name="nuevoEdadPaciente" type="number" class="form-control" readonly>

                  </div>

                </div>

                <div class="row">       

                  <div class="col-md-6 form-group">
                    <label for="nuevoSexoPaciente" class="form-label">SEXO</label>
                    <select class="form-select" name="nuevoSexoPaciente" id="nuevoSexoPaciente" disabled>
                      <option value="" disabled selected>ELEGIR...</option>
                      <option value="MASCULINO">MASCULINO</option>
                      <option value="FEMENINO">FEMENINO</option>
                    </select>
                  </div>
                  
                  <div class="col-md-6 form-group ">
                    <label for="nuevoEstadoCivil" class="form-label">ESTADO CIVIL</label>
                    <select class="form-select" name="nuevoEstadoCivil" id="nuevoEstadoCivil" disabled> 
                      <option value="" disabled selected>ELEGIR...</option>
                      <option value="SOLTERO (A)">SOLTERO (A)</option>
                      <option value="CASADO (A)">CASADO (A)</option>
                      <option value="DIVORCIADO (A)">DIVORCIADO (A)</option>
                      <option value="VIUDO (A)">VIUDO (A)</option>
                    </select>
                  </div>

                </div>

                <div class="row">

                  <div class="col-md-6 form-group">
                    <label for="nuevoDomicilioPaciente" class="form-label">DOMICILIO</label>
                    <input id="nuevoDomicilioPaciente" type="text" class="form-control mayuscula" name="nuevoDomicilioPaciente" readonly>
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="nuevoTelefonoPaciente" class="form-label">TELF./CEL.</label>
                    <input id="nuevoTelefonoPaciente" type="text" class="form-control mayuscula" name="nuevoTelefonoPaciente" data-inputmask="'mask': '9{7,8}'" readonly>
                  </div>

                </div>

              </div>

              <div class="card-header">
                DATOS DE ASEGURADO
              </div>

              <div class="card-body">

                <div class="row">

                  <div class="col-md-12 mb-2">

                    <div class="form-check form-switch">
                      <input id="nuevoParticular" type="checkbox" class="form-check-input" name="nuevoParticular" disabled>
                      <label class="form-check-label" for="nuevoParticular">PARTICULAR</label>
                    </div>

                  </div>

                </div>

                <div class="row">

                  <div class="col-md-6 form-group">
                    <label for="nuevoEstadoAsegurado" class="form-label">ESTADO ASEGURADO</label>
                    <input id="nuevoEstadoAsegurado" type="text" class="form-control" name="nuevoEstadoAsegurado" readonly>
                  </div>

                </div>

                <div class="row">

                  <div class="col-md-6 form-group">
                    <label for="nuevoCodAsegurado" class="form-label">COD. ASEGURADO</label>
                    <input id="nuevoCodAsegurado" type="text" class="form-control mayuscula" name="nuevoCodAsegurado" readonly>
                  </div>

                  <div class="col-md-6 form-group">
                    <label for="nuevoCodBeneficiarioActual" class="form-label">COD. BENEFICIARIO</label>
                    <select class="form-select" name="nuevoCodBeneficiarioActual" id="nuevoCodBeneficiarioActual" disabled> 
                      <option value="" disabled selected>ELEGIR...</option>
                      <option value="ID">ID - TITULAR</option>
                      <option value="01">01 - ESPOSO</option>
                      <option value="01A">01 - CONCUVINO</option>
                      <option value="02">02 - PRIMER HIJO</option>
                      <option value="03">03 - SEGUNDO HIJO</option>
                      <option value="04">04 - TERCER HIJO</option>
                      <option value="05">05 - CUARTO HIJO</option>
                      <option value="06">06 - QUINTO HIJO</option>
                      <option value="07A">07A - SEPTIMO HIJO</option>
                      <option value="07B">07B - OCTAVO HIJO</option>
                      <option value="07C">07C - NOVENO HIJO</option>
                      <option value="07D">07D - DECIMO HIJO</option>
                      <option value="08">08 - PADRE</option>
                      <option value="09">09 - HERMANO</option>
                      <option value="50">50 - ESPOSA</option>
                      <option value="51">51 - CONCUVINA</option>
                      <option value="52">52 - PRIMERA HIJA</option>
                      <option value="53">53 - SEGUNDA HIJA</option>
                      <option value="54">54 - TERCERA HIJA</option>
                      <option value="55">55 - CUARTA HIJA</option>
                      <option value="56">56 - QUINTA HIJA</option>
                      <option value="57">57 - SEXTA HIJA</option>
                      <option value="57A">57A - SEPTIMA HIJA</option>
                      <option value="57B">57B - OCTAVA HIJA</option>
                      <option value="57C">57C - NOVENA HIJA</option>
                      <option value="57D">57D - DECIMA HIJA</option>
                      <option value="58">58 - MADRE</option>
                      <option value="59">59 - HERMANA</option>
                    </select>

                    <input type="hidden" id="nuevoCodBeneficiario" name="nuevoCodBeneficiario">
                    
                  </div>

                </div>

                <div class="row">

                  <div class="col-md-6 form-group">
                    <label for="nuevoNroEmpleador" class="form-label">NRO PATRONAL</label>
                    <input id="nuevoNroEmpleador" type="text" class="form-control" name="nuevoNroEmpleador" data-inputmask="'mask': '99-999-99999'" readonly>
                  </div>
                  
                  <div class="col-md-6 form-group">
                    <label for="nuevoNombreEmpleador" class="form-label">RAZON SOCIAL</label>
                    <input id="nuevoNombreEmpleador" type="text" class="form-control mayuscula" name="nuevoNombreEmpleador" readonly>
                  </div>

                </div> 

                <div class="row">

                  <div class="col-md-6 form-group">
                    <label for="nuevoZonaPaciente" class="form-label">ZONA PACIENTE</label>
            
                    <select  class="form-select" name="nuevoZonaPaciente" id="nuevoZonaPaciente" disabled>
                      <option value="" disabled selected>ELEGIR...</option>';
                      <?php

                      $item = "id_tipo_servicio";
                      $valor = 4;

                      $consultorios =  ControllerConsultorios::ctrMostrarConsultorios($item, $valor);

                      foreach($consultorios as  $key => $value) {

                        echo '<option value="'.$value["id"].'">'.$value["nombre_consultorio"].'</option>';

                      }
                      ?> 
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
                  Guardar Paciente

                </button>

              </div>

            </div>

          </form>    

        </div>       

      </div>

    </div>

  </div>

</div> 

<!--=====================================
MODAL EDITAR PACIENTE
======================================-->
<div class="modal fade" id="modalEditarPaciente" tabindex="-1" aria-labelledby="editarPaciente" aria-hidden="true">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header bg-modal">

        <h5 class="modal-title" id="editarPaciente">Editar Paciente</h5>
        
        <button type="button" class="btn btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>

      </div>

      <div class="modal-body">

        <form method="post" id="frmEditarPaciente">

          <div class="card mb-4">

            <div class="card-header">
              DATOS PERSONALES
            </div>

            <div class="card-body">

              <div class="row">

                <div class="col-md-6 form-group">
                  <label for="editarDocumentoCiPaciente" class="form-label">DOCUMENTO (CI)</label>
                  <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                  <input id="editarDocumentoCiPaciente"  type="text" class="form-control" name="editarDocumentoCiPaciente">
                </div>

                <div class="col-md-6 form-group">
                  <label for="editarFechaNacimientoPaciente" class="form-label">FECHA NACIMIENTO</label>
                  <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                  <input id="editarFechaNacimientoPaciente"  type="date" class="form-control" name="editarFechaNacimientoPaciente">
                </div>

              </div>

              <div class="row">

                <div class="col-md-6 form-group">
                  <label for="editarPaternoPaciente" class="form-label">A. PATERNO</label>
                  <input id="editarPaternoPaciente" type="text" class="form-control mayuscula" name="editarPaternoPaciente">
                </div>

                <div class="col-md-6 form-group">
                  <label for="editarMaternoPaciente" class="form-label">A. MATERNO</label>
                  <input id="editarMaternoPaciente"  type="text" class="form-control mayuscula"name="editarMaternoPaciente">
                </div>

              </div>

              <div class="row">

                <div class="col-md-6 form-group">
                  <label for="editarNombrePaciente" class="form-label">NOMBRE(S)</label>
                  <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                  <input id="editarNombrePaciente"  type="text" class="form-control mayuscula" name="editarNombrePaciente">
                </div>

                <div class="col-md-6 form-group">
                  <label for="editarEdadPaciente" class="form-label">EDAD</label>
                  <input id="editarEdadPaciente" name="editarEdadPaciente" type="number" class="form-control" readonly>
                </div>

              </div>

              <div class="row">       

                <div class="col-md-6 form-group">
                  <label for="editarSexoPaciente" class="form-label">SEXO</label>
                  <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                  <select class="form-select" name="editarSexoPaciente" id="editarSexoPaciente">
                    <option value="MASCULINO">MASCULINO</option>
                    <option value="FEMENINO">FEMENINO</option>
                  </select>
                </div>
                
                <div class="col-md-6 form-group ">
                  <label for="editarEstadoCivil" class="form-label">ESTADO CIVIL</label>
                  <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                  <select class="form-select" name="editarEstadoCivil" id="editarEstadoCivil"> 
                    <option value="SOLTERO (A)">SOLTERO (A)</option>
                    <option value="CASADO (A)">CASADO (A)</option>
                    <option value="DIVORCIADO (A)">DIVORCIADO (A)</option>
                    <option value="VIUDO (A)">VIUDO (A)</option>
                  </select>
                </div>

              </div>

              <div class="row">

                <div class="col-md-6 form-group">
                  <label for="editarDomicilioPaciente" class="form-label">DOMICILIO</label>
                  <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                  <input id="editarDomicilioPaciente" type="text" class="form-control mayuscula" name="editarDomicilioPaciente">
                </div>

                <div class="col-md-6 form-group">
                  <label for="editarTelefonoPaciente" class="form-label">TELF./CEL.</label>
                  <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                  <input id="editarTelefonoPaciente" type="text" class="form-control mayuscula" name="editarTelefonoPaciente" data-inputmask="'mask': '9{7,8}'">
                </div>

              </div>

            </div>

            <div class="card-header">
              DATOS DE ASEGURADO
            </div>

            <div class="card-body">

              <div class="row">

                <div class="col-md-12 mb-2">

                  <div class="form-check form-switch">
                    <input id="editarParticular" type="checkbox" class="form-check-input" name="editarParticular">
                    <label class="form-check-label" for="editarParticular">PARTICULAR</label>
                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-md-6 form-group">
                  <label for="editarEstadoAsegurado" class="form-label">ESTADO ASEGURADO</label>
                  <input id="editarEstadoAsegurado" type="text" class="form-control" name="editarEstadoAsegurado" readonly>
                </div>

              </div>

              <div class="row">

                <div class="col-md-6 form-group">
                  <label for="editarCodAsegurado" class="form-label">COD. ASEGURADO</label>
                  <label class="indicadorParticular">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                  <input id="editarCodAsegurado" type="text" class="form-control" name="editarCodAsegurado" required>
                </div>

                <div class="col-md-6 form-group">
                  <label for="editarCodBeneficiario" class="form-label">COD. BENEFICIARIO</label>
                  <label class="indicadorParticular">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                  <select class="form-select" name="editarCodBeneficiario" id="editarCodBeneficiario" required>
                    <option value="ID">ID - TITULAR</option>
                    <option value="01">01 - ESPOSO</option>
                    <option value="01A">01 - CONCUVINO</option>
                    <option value="02">02 - PRIMER HIJO</option>
                    <option value="03">03 - SEGUNDO HIJO</option>
                    <option value="04">04 - TERCER HIJO</option>
                    <option value="05">05 - CUARTO HIJO</option>
                    <option value="06">06 - QUINTO HIJO</option>
                    <option value="07A">07A - SEPTIMO HIJO</option>
                    <option value="07B">07B - OCTAVO HIJO</option>
                    <option value="07C">07C - NOVENO HIJO</option>
                    <option value="07D">07D - DECIMO HIJO</option>
                    <option value="08">08 - PADRE</option>
                    <option value="09">09 - HERMANO</option>
                    <option value="50">50 - ESPOSA</option>
                    <option value="51">51 - CONCUVINA</option>
                    <option value="52">52 - PRIMERA HIJA</option>
                    <option value="53">53 - SEGUNDA HIJA</option>
                    <option value="54">54 - TERCERA HIJA</option>
                    <option value="55">55 - CUARTA HIJA</option>
                    <option value="56">56 - QUINTA HIJA</option>
                    <option value="57">57 - SEXTA HIJA</option>
                    <option value="57A">57A - SEPTIMA HIJA</option>
                    <option value="57B">57B - OCTAVA HIJA</option>
                    <option value="57C">57C - NOVENA HIJA</option>
                    <option value="57D">57D - DECIMA HIJA</option>
                    <option value="58">58 - MADRE</option>
                    <option value="59">59 - HERMANA</option>
                  </select>
                </div>

              </div>

              <div class="row">

                <div class="col-md-6 form-group">
                  <label for="editarNroEmpleador" class="form-label">NRO PATRONAL</label>
                  <label class="indicadorParticular">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                  <input id="editarNroEmpleador" type="text" class="form-control"name="editarNroEmpleador" data-inputmask="'mask': '99-999-99999'" required>
                </div>
                
                <div class="col-md-6 form-group">
                  <label for="editarNombreEmpleador" class="form-label">RAZON SOCIAL</label>
                  <label class="indicadorParticular">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                  <input id="editarNombreEmpleador" type="text" class="form-control mayuscula"name="editarNombreEmpleador" required>
                </div>

              </div>

              <div class="row">

                <div class="col-md-6 form-group">
                  <label for="editarZonaPaciente" class="form-label">ZONA PACIENTE</label>
                  <label class="indicadorParticular">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                  <select  class="form-select" name="editarZonaPaciente" id="editarZonaPaciente" required>
                    <?php

                    $item = "id_tipo_servicio";
                    $valor = 4;

                    $consultorios =  ControllerConsultorios::ctrMostrarConsultorios($item, $valor);

                    foreach($consultorios as  $key => $value) {

                      echo '<option value="'.$value["id"].'">'.$value["nombre_consultorio"].'</option>';

                    }
                    ?> 
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

              <input type="hidden" id="editarId" name="editarId">

            </div>

          </div>

        </form>           

      </div>

      <div class="modal-footer">

      </div>

    </div>

  </div>

</div>

<!--=====================================
MODAL SELECCIONAR ASEGURADO
======================================-->
<div class="modal fade" id="modalCodAsegurado" tabindex="-1" aria-labelledby="buscarAsegurado" aria-hidden="true">

  <div class="modal-dialog modal-dialog-scrollable modal-xl">

    <div class="modal-content">

      <!--=====================================
      CABEZA DEL MODAL
      ======================================-->
      <div class="modal-header bg-modal">

        <h5 class="modal-title" id="buscarAsegurado">Buscar Asegurado</h5>
        
        <button type="button" class="btn btn-close btn-outline-danger" data-bs-toggle="modal" href="#modalNuevoPaciente"></button>

      </div>

      <!--=====================================
      CUERPO DEL MODAL
      ======================================-->
      <div class="modal-body">

         <div class="card mb-4">

            <div class="card-body">

              <div class="form-row">

                <div class="form-group-group col-sm-12 col-md-6 col-lg-5">

                  <label for="buscardorAfiliado">COD. ASEGURADO (EJ: 900822OPM)</label>

                  <div class="input-group">
                    <input type="text" class="form-control mr-2" id="buscardorAfiliado" name="buscardorAfiliado" placeholder="Ingrese Apellidos o Nombre(s) o Codigo Asegurado.">
                    <div class="input-group-append">
                      <button type="button" class="btn btn-primary px-2 btnBuscarAfiliado">
                        <i class="fas fa-search"></i> Buscar
                      </button>
                    </div>
                  </div>

                </div>     

              </div>

              <!--=====================================
              SE MUESTRA LA TABLA GENERADA
              ======================================-->            
              <div id="tblAfiliadosSIAIS" class="mt-4">   


              </div>

            </div>

            <div class="card-footer text-right">

              <button type="button" class="btn btn-danger" data-bs-toggle="modal" href="#modalNuevoPaciente" role="button">

                <i class="fas fa-times"></i>
                Cerrar

              </button>

            </div>

      </div>

    </div>

  </div>

</div>