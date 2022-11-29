<main>

	<div class="container-xl px-4">

		<h1 class="mt-4">PACIENTES EGRESOS</h1>

		<ol class="breadcrumb p-2 mb-4 shadow">

      <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/inicio">Inicio</a></li>
      <li class="breadcrumb-item active">Pacientes Egresos</li>

    </ol>

    <div class="card mb-4">

      <!--=============================================
      SECCION PARA EL FILTRADOR POR FECHAS
      =============================================-->
      <div class="card-body">

        <div class="right_col alert alert-info" role="main">

          <form id="frmPacientesEgresados">

            <div class="row">

              <div class="form-group col-xs-10 col-sm-5 col-md-3 col-lg-3">

                <label for="fechaIniEgresados">FECHA INICIAL</label>
                <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                <div class="input-group">
                  
                  <input type="date" class="form-control" name="fechaIniEgresados" id="fechaIniEgresados">

                </div>

              </div>

              <div class="form-group col-xs-10 col-sm-5 col-md-3 col-lg-3">

                <label for="fechaFinEgresados">FECHA FINAL</label>
                <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                <div class="input-group">

                  <input type="date" class="form-control" name="fechaFinEgresados" id="fechaFinEgresados">

                </div>

              </div>

              <div class="form-group col-xs-2 col-sm-2 col-md-2 col-lg-2">

                <label></label>
                <div class="input-group-append mt-2">
                  <button type="button" class="btn btn-primary px-2" id="btnBuscarPacientesEgresados">
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

        <i class="fas fa-table me-1"></i>LISTADO DE PACIENTES DADOS DE ALTA

      </div>

      <div class="card-body">

    		<table class="table table-striped table-bordered shadow-lg mt-4" id="tblPacientesEgresos">

          <thead class="text-light bg-primary">
            <tr>
              <th scope="col">#</th>
              <th scope="col"></th>
              <th scope="col"></th>
              <th scope="col">NOMBRE(S) Y APELLIDO(S)</th>
              <th scope="col">FECHA EGRESO</th>
              <th scope="col">HORA EGRESO</th>              
              <th scope="col">CAUSA EGRESO</th>
              <th scope="col">CONDICION EGRESO</th> 
              <th scope="col">DIAGNOSTICO CIE10</th>
              <th scope="col">DIAGNOSTICO(S) ESPECIFICO</th>
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

                        <dt class="col-sm-4">SERVICIO ACTUAL:</dt>
                        <dd class="col-sm-6" id="servicioIngresoA"></dd>

                        <dt class="col-sm-3">SALA ACTUAL:</dt>
                        <dd class="col-sm-3" id="salaIngresoA"></dd>

                        <dt class="col-sm-3">CAMA ACTUAL:</dt>
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

                  <input type="hidden" id="modulo" name="modulo" value="paciente-egresos">

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
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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