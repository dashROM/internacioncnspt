<main>

	<div class="container-xl px-4">

		<h1 class="mt-4">PACIENTES INGRESOS</h1>

		<ol class="breadcrumb p-2 mb-4 shadow">

      <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/inicio">Inicio</a></li>
      <li class="breadcrumb-item active">Pacientes Ingresos</li>

    </ol>

    <div class="card mb-4">

      <!--=============================================
      SECCION PARA EL FILTRADOR POR FECHAS
      =============================================-->
      <div class="card-body">

        <div class="right_col alert alert-info" role="main">

          <form id="frmPacientesInternados">

            <div class="row">

              <div class="form-group col-xs-10 col-sm-5 col-md-3 col-lg-3">

                <label for="fechaIniInternados">FECHA INICIAL</label>
                <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                <div class="input-group">
                  
                  <input type="date" class="form-control" name="fechaIniInternados" id="fechaIniInternados">

                </div>

              </div>

              <div class="form-group col-xs-10 col-sm-5 col-md-3 col-lg-3">

                <label for="fechaFinInternados">FECHA FINAL</label>
                <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                <div class="input-group">

                  <input type="date" class="form-control" name="fechaFinInternados" id="fechaFinInternados">

                </div>

              </div>

              <div class="form-group col-xs-2 col-sm-2 col-md-2 col-lg-2">

                <label></label>
                <div class="input-group-append mt-2">
                  <button type="button" class="btn btn-primary px-2" id="btnBuscarPacientesInternados">
                    <i class="fas fa-search"></i> Buscar
                  </button>
                </div>

              </div>

            </div>   

          </form>

        </div>

      </div>
      <!-- FIN FILTRADOR -->

      <div class="card-header">

        <i class="fas fa-table me-1"></i>LISTADO DE PACIENTES REGISTRADOS EN INTERNACIÓN

      </div>

      <div class="card-body mostrarResultadoInternacion">

        <div class="resultado">

      		<table class="table table-striped table-bordered shadow-lg mt-4" id="tblPacientesInternados">

            <thead class="text-light bg-primary">
              <tr>
                <th scope="col">#</th>
                <th scope="col"></th>
                <th scope="col">LUGAR</th>
                <th scope="col">FECHA INGRESO</th>
                <th scope="col">HORA INGRESO</th>      
                <th scope="col">NOMBRE(S) Y APELLIDO(S)</th>
                <th scope="col">FECHA NAC.</th>
                <th scope="col">EDAD</th>
                <th scope="col">COD. ASEGURADO</th>
                <th scope="col">N° PATRONAL</th>
                <th scope="col">RAZÓN SOCIAL</th> 
                <th scope="col">DIAGNOSTICO</th>
                <th scope="col">SERVICIO</th> 
                <th scope="col">SALA</th> 
                <th scope="col">CAMA</th> 
              </tr>
            </thead>

            <tbody>

            </tbody>

          </table>

        </div>

      </div>

    </div>

	</div>
	
</main>

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

                      <dt class="col-sm-4">SERVICIO ACTUAL:</dt>
                      <dd class="col-sm-6" id="servicioIngreso"></dd>

                      <dt class="col-sm-3">SALA ACTUAL:</dt>
                      <dd class="col-sm-3" id="salaIngreso"></dd>

                      <dt class="col-sm-3">CAMA ACTUAL:</dt>
                      <dd class="col-sm-3" id="camaIngreso"></dd>

                    </dl>

                  </div>

                </div>

              </div>

              <div class="card-header">
                DATOS DE TRANSFERENCIA DE PACIENTE
              </div>

              <div class="card-body">

                <div class="row">

                  <div class="col-md-12">

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

                </div>

                <div class="card-header">
                  EN CASO DE MUERTE
                </div>

                <div class="card-body">

                  <div class="row">

                    <div class="col-md-6 form-group"> 
                      <label for="nuevoCausaClinica" class="form-label">CAUSA (CLINICA)</label>
                      <textarea class="form-control" name="nuevoCausaClinica" id="nuevoCausaClinica" readonly></textarea> 
                    </div>

                    <div class="col-md-6 form-group"> 
                      <label for="nuevoCausaAutopsia" class="form-label">CAUSA (AUTOPSIA)</label>
                      <textarea class="form-control" name="nuevoCausaAutopsia" id="nuevoCausaAutopsia" readonly></textarea> 
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
                  <input type="hidden" id="modulo" name="modulo" value="paciente-ingresos">

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