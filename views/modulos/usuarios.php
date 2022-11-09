<main>

	<div class="container-xl px-4">

		<h1 class="mt-4">USUARIOS</h1>

		<ol class="breadcrumb p-2 mb-4 shadow">

	 		<li class="breadcrumb-item"><a href="<?= BASEURL; ?>/inicio">Inicio</a></li>
      <li class="breadcrumb-item active">Usuarios</li>

		</ol>

		<div class="card mb-4 shadow">

      <div class="card-body">
				<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevoUsuario"><i class="fas fa-plus"></i> Nuevo Usuario</button>
      </div>

    </div>

    <div class="card mb-4">

      <div class="card-header">

        <i class="fas fa-table me-1"></i>LISTADO USUARIOS

      </div>

      <div class="card-body">				
    
				<table class="table table-striped table-bordered shadow-lg mt-4" id="tblUsuarios">
					
					<thead class="text-light bg-primary">
				    <tr>
				    	<th scope="col">#</th>
							<th scope="col"></th>
							<th scope="col">USUARIO</th>
							<th scope="col">NOMBRE(S)</th> 
							<th scope="col">APELLIDO PATERNO</th>
							<th scope="col">APELLIDO MATERNO</th>	  
							<th scope="col">TIPO USUARIO</th>  
							<th scope="col">FECHA CREACION</th>
							<th scope="col">ESTADO</th>
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
MODAL NUEVO USUARIO
======================================-->

<div class="modal fade" id="modalNuevoUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="nuevoUsuario" aria-hidden="true">

	<div class="modal-dialog modal-lg">

    <div class="modal-content">

    	<form id="frmNuevoUsuario" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="nuevoUsuario">Agregar Usuario</h5>        
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

							<div class="row">

		            <div class="col-md-6 col-sm-6 col-xs-12">

		              <!-- ENTRADA PARA EL APELLIDO PATERNO -->

		              <div class="form-group">

		                <label class="font-weight-normal" for="nuevoPaternoUsuario">A. PATERNO</label>
		                <input type="text" class="form-control mayuscula" id="nuevoPaternoUsuario" name="nuevoPaternoUsuario">

		              </div>

		              <!-- ENTRADA PARA EL APELLIDO MATERNO -->

		              <div class="form-group">

		                <label class="font-weight-normal" for="nuevoMaternoUsuario">A. MATERNO</label>
		                <input type="text" class="form-control mayuscula" id="nuevoMaternoUsuario" name="nuevoMaternoUsuario">

		              </div>

		              <!-- ENTRADA PARA EL NOMBRE -->

		              <div class="form-group">

		                <label class="font-weight-normal" for="nuevoNombreUsuario">NOMBRE(S)</label>
		                (<i class="fas fa-asterisk asterisk mr-1"></i>)
		                <input type="text" class="form-control mayuscula" id="nuevoNombreUsuario" name="nuevoNombreUsuario">

		              </div>

		            </div>

		            <div class="col-md-6 col-sm-6 col-xs-12">

		              <!-- ENTRADA PARA EL NICK USUARIO -->

		              <div class="form-group">

		                <label class="font-weight-normal" for="nuevoNickUsuario">NICK USUARIO</label>
		                (<i class="fas fa-asterisk asterisk mr-1"></i>)
		                <input type="text" class="form-control mayuscula" id="nuevoNickUsuario" name="nuevoNickUsuario">

		              </div>

		              <!-- ENTRADA PARA LA CONTRASEÑA -->

		              <div class="form-group">

		                <label class="font-weight-normal" for="nuevoClaveUsuario">CONTRASEÑA</label>
		                (<i class="fas fa-asterisk asterisk mr-1"></i>)
		                  
		                <div class="input-group">
		                  <input type="password" class="form-control txtPassword" id="nuevoClaveUsuario" name="nuevoClaveUsuario" data-error="#errNm1">
		                  <div class="input-group-append">
		                    <button class="btn btn-primary btnMostrarPassword show_password" type="button"> <span class="fa fa-eye-slash icon"></span> </button>
		                  </div>
		                </div>
		                <span id="errNm1"></span>

		              </div>             

		              <!-- ENTRADA PARA SELECCIONAR TIPO DE USUARIO -->
		              
		              <div class="form-group">

		                <label class="font-weight-normal" for="nuevoTipoUsuario">TIPO USUARIO</label>
		                (<i class="fas fa-asterisk asterisk mr-1"></i>)
		                <select class="custom-select" id="nuevoTipoUsuario" name="nuevoTipoUsuario">

		                	<option value="">ELEGIR...</option>
		                  <?php 

		                    $item = null;
		                    $valor = null;

		                    $tipo_Usuarios = ControllerTipoUsuarios::ctrMostrarTipoUsuarios($item, $valor);

		                    foreach ($tipo_Usuarios as $key => $value) {
		                      
		                      echo '<option value="'.$value["id"].'">'.$value["referencia"].'</option>';

		                    } 
		                  ?>
		                </select>

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
            Guardar Usuario

          </button>

        </div>

      </form>
 
    </div>
  </div>
</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div class="modal fade" id="modalEditarUsuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editarUsuario" aria-hidden="true">

	<div class="modal-dialog modal-lg">

    <div class="modal-content">

    	<form id="frmEditarUsuario" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="editarUsuario">Editar Usuario</h5>        
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

							<div class="row">

		            <div class="col-md-6 col-sm-6 col-xs-12">

		              <!-- ENTRADA PARA EL APELLIDO PATERNO -->

		              <div class="form-group">

		                <label class="font-weight-normal" for="editarPaternoUsuario">A. PATERNO</label>
		                <input type="text" class="form-control mayuscula" id="editarPaternoUsuario" name="editarPaternoUsuario">

		              </div>

		              <!-- ENTRADA PARA EL APELLIDO MATERNO -->

		              <div class="form-group">

		                <label class="font-weight-normal" for="editarMaternoUsuario">A. MATERNO</label>
		                <input type="text" class="form-control mayuscula" id="editarMaternoUsuario" name="editarMaternoUsuario">

		              </div>

		              <!-- ENTRADA PARA EL NOMBRE -->

		              <div class="form-group">

		                <label class="font-weight-normal" for="editarNombreUsuario">NOMBRE(S)</label>
		                (<i class="fas fa-asterisk asterisk mr-1"></i>)
		                <input type="text" class="form-control mayuscula" id="editarNombreUsuario" name="editarNombreUsuario">

		              </div>

		            </div>

		            <div class="col-md-6 col-sm-6 col-xs-12">

		              <!-- ENTRADA PARA EL NICK USUARIO -->

		              <div class="form-group">

		                <label class="font-weight-normal" for="editarNickUsuario">NICK USUARIO</label>
		                (<i class="fas fa-asterisk asterisk mr-1"></i>)
		                <input type="text" class="form-control mayuscula" id="editarNickUsuario" name="editarNickUsuario">

		              </div>

		              <!-- ENTRADA PARA LA CONTRASEÑA -->

		              <div class="form-group">

		                <label class="font-weight-normal" for="editarClaveUsuario">CONTRASEÑA</label>
		                  
		                <div class="input-group">
		                  <input type="password" class="form-control txtPassword" id="editarClaveUsuario" name="editarClaveUsuario" data-error="#errNm2" placeholder="INGRESE UNA NUEVA CONTRASEÑA">
		                  <div class="input-group-append">
		                    <button class="btn btn-primary btnMostrarPassword show_password" type="button"> <span class="fa fa-eye-slash icon"></span> </button>
		                  </div>
		                </div>
		                <span id="errNm2"></span>
		                <input type="hidden" id="claveActual" name="claveActual">

		              </div>             

		              <!-- ENTRADA PARA SELECCIONAR TIPO DE USUARIO -->
		              
		              <div class="form-group">

		                <label class="font-weight-normal" for="editarTipoUsuario">TIPO USUARIO</label>
		                (<i class="fas fa-asterisk asterisk mr-1"></i>)
		                <select class="custom-select" id="editarTipoUsuario" name="editarTipoUsuario">

		                	<option value="">ELEGIR...</option>
		                  <?php 

		                    $item = null;
		                    $valor = null;

		                    $tipo_Usuarios = ControllerTipoUsuarios::ctrMostrarTipoUsuarios($item, $valor);

		                    foreach ($tipo_Usuarios as $key => $value) {
		                      
		                      echo '<option value="'.$value["id"].'">'.$value["referencia"].'</option>';

		                    } 
		                  ?>
		                </select>

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

          <input type="hidden" id="editarIdUsuario" name="editarIdUsuario" value="">

        </div>

      </form>
 
    </div>
  </div>
</div>