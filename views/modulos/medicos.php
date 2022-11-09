<main>

	<div class="container-xl px-4">

		<h1 class="mt-4">MÉDICOS</h1>

		<ol class="breadcrumb mb-4">

	 		<li class="breadcrumb-item"><a href="<?= BASEURL; ?>/inicio">Inicio</a></li>
      <li class="breadcrumb-item active">Médicos</li>

		</ol>

    <div class="card mb-4">
      <div class="card-body">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevoMedico"><i class="fas fa-plus"></i> Nuevo Médico</button>
      </div>
    </div>

    <div class="card mb-4">

      <div class="card-header">

        <i class="fas fa-table me-1"></i>LISTADO MEDICOS

      </div>

      <div class="card-body"> 

    		<table class="table table-striped table-bordered shadow-lg mt-4"id="tblMedicos">
    			
    			<thead class="text-light bg-primary">
    		    <tr>
              <th scope="col">#</th>
              <th scope="col"></th>
    		      <th scope="col">NOMBRE</th>
    		      <th scope="col">PATERNO</th>
    		      <th scope="col">MATERNO</th>
              <th scope="col">MATRICULA</th>
              <th scope="col">DIRECCION</th>
              <th scope="col">TELEFONO</th>
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
MODAL NUEVO MEDICO
======================================-->
<div class="modal fade" id="modalNuevoMedico" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="nuevoMedico" aria-hidden="true">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form id="frmNuevoMedico">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
     
        <div class="modal-header bg-modal">

           <h5 class="modal-title" id="nuevoMedico">Nuevo Médico</h5>
           <button type="button" class="btn btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="card mb-4">

            <div class="card-header">
              Todos los Campos con (<i class="fas fa-asterisk asterisk mr-1 mt-2"></i>) son Obligatorios
            </div>

            <div class="card-body">

              <div class="row mb-3">

                <div class="col-md-6 col-sm-6 col-xs-12">

                  <div class="form-inline">

                    <label class="form-label" for="nuevoPrefijo">PREFIJO MEDICO</label>
                    <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <select type="text" class="form-select" name="nuevoPrefijo" id="nuevoPrefijo" required>
                      <option value="">ELEGIR...</option>
                      <option value="DRA.">DRA.</option>
                      <option value="DR.">DR.</option>
                    </select>

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-md-6 col-sm-6 col-xs-12">

                  <!-- ENTRADA PARA EL APELLIDO PATERNO MEDICO -->

                  <div class="form-group">

                    <label class="form-label" for="nuevoPaternoMedico">A. PATERNO</label>
                    <input type="text" class="form-control mayuscula" name="nuevoPaternoMedico" id="nuevoPaternoMedico">

                  </div>

                  <!-- ENTRADA PARA EL APELLIDO MATERNO MEDICO -->

                  <div class="form-group"> 

                    <label class="form-label" for="nuevoMaternoMedico">A. MATERNO</label>
                    <input type="text" class="form-control mayuscula" name="nuevoMaternoMedico" id="nuevoMaternoMedico">

                  </div> 
          
                  <!-- ENTRADA PARA EL NOMBRE(S) MEDICO -->

                  <div class="form-group">

                    <label class="form-label" for="nuevoNombreMedico">NOMBRE</label>
                    <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <input type="text" class="form-control mayuscula" name="nuevoNombreMedico" id="nuevoNombreMedico" required>

                  </div>
    
                </div> 

                <div class="col-md-6 col-sm-6 col-xs-12">

                  <!-- ENTRADA PARA MATRICULA MEDICO -->
              
                  <div class="form-group"> 
      			  	    <label class="form-label" for="nuevoMatricula">MATRICULA</label>
                    <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <input type="text" class="form-control mayuscula" name="nuevoMatricula" id="nuevoMatricula" required>
                  </div> 

                  <!-- ENTRADA PARA LA DIRECCION MEDICO -->
                
                  <div class="form-group"> 
      			  	    <label class="form-label" for="nuevoDireccion">DIRECCION</label>
                    <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <input type="text" class="form-control mayuscula" name="nuevoDireccion" id="nuevoDireccion" required>
                  </div> 

                  <!-- ENTRADA PARA EL TELEFONO MEDICO -->

                  <div class="form-group"> 
                    <label class="form-label" for="nuevoTelefono">TELEFONO / CELULAR</label>
                    <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <input type="text" class="form-control" name="nuevoTelefono" id="nuevoTelefono" data-inputmask="'mask': '9{7,8}'" required>
                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-round btn-danger float-left" data-bs-dismiss="modal" aria-label="Close">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

          <button type="button" class="btn btn-round btn-primary btnGuardar">

            <i class="fas fa-save"></i>
            Guardar Médico

          </button>

        </div>

      </form>

    </div>
  </div>
</div>

<!--=====================================
MODAL EDITAR MEDICO
======================================-->
<div class="modal fade" id="modalEditarMedico" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editarMedico" aria-hidden="true">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form id="frmEditarMedico">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
     
        <div class="modal-header bg-modal">

           <h5 class="modal-title" id="editarMedico">Editar Médico</h5>
           <button type="button" class="btn btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="card mb-4">

            <div class="card-header">
              Todos los Campos con (<i class="fas fa-asterisk asterisk mr-1 mt-2"></i>) son Obligatorios
            </div>

            <div class="card-body">

              <div class="row mb-3">

                <div class="col-md-6 col-sm-6 col-xs-12">

                  <div class="form-inline">

                    <label class="form-label" for="editarPrefijo">PREFIJO MEDICO</label>
                    <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <select type="text" class="form-select" name="editarPrefijo" id="editarPrefijo" required>
                      <option value="">ELEGIR...</option>
                      <option value="DRA.">DRA.</option>
                      <option value="DR.">DR.</option>
                    </select>

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-md-6 col-sm-6 col-xs-12">

                  <!-- ENTRADA PARA EL APELLIDO PATERNO MEDICO -->

                  <div class="form-group">

                    <label class="form-label" for="editarPaternoMedico">A. PATERNO</label>
                    <input type="text" class="form-control mayuscula" name="editarPaternoMedico" id="editarPaternoMedico">

                  </div>

                  <!-- ENTRADA PARA EL APELLIDO MATERNO MEDICO -->

                  <div class="form-group"> 

                    <label class="form-label" for="editarMaternoMedico">A. MATERNO</label>
                    <input type="text" class="form-control mayuscula" name="editarMaternoMedico" id="editarMaternoMedico">

                  </div> 
          
                  <!-- ENTRADA PARA EL NOMBRE(S) MEDICO -->

                  <div class="form-group">

                    <label class="form-label" for="editarNombreMedico">NOMBRE</label>
                    <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <input type="text" class="form-control mayuscula" name="editarNombreMedico" id="editarNombreMedico" required>

                  </div>
    
                </div> 

                <div class="col-md-6 col-sm-6 col-xs-12">

                  <!-- ENTRADA PARA MATRICULA MEDICO -->
              
                  <div class="form-group"> 
                    <label class="form-label" for="editarMatricula">MATRICULA</label>
                    <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <input type="text" class="form-control mayuscula" name="editarMatricula" id="editarMatricula" required>
                  </div> 

                  <!-- ENTRADA PARA LA DIRECCION MEDICO -->
                
                  <div class="form-group"> 
                    <label class="form-label" for="editarDireccion">DIRECCION</label>
                    <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <input type="text" class="form-control mayuscula" name="editarDireccion" id="editarDireccion" required>
                  </div> 

                  <!-- ENTRADA PARA EL TELEFONO MEDICO -->

                  <div class="form-group"> 
                    <label class="form-label" for="editarTelefono">TELEFONO / CELULAR</label>
                    <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                    <input type="text" class="form-control" name="editarTelefono" id="editarTelefono" data-inputmask="'mask': '9{7,8}'" required>
                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-round btn-danger float-left" data-bs-dismiss="modal" aria-label="Close">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

          <button type="button" class="btn btn-round btn-primary btnGuardar">

            <i class="fas fa-save"></i>
            Guardar Cambios

          </button>

          <input type="hidden" name="editarIdMedico" id="editarIdMedico" required>

        </div>

      </form>

    </div>
  </div>
</div>