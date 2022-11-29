<main>

	<div class="container-xl px-4">

		<h1 class="mt-4">MATERNIDAD</h1>

		<ol class="breadcrumb p-2 mb-4 shadow">

      <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/inicio">Inicio</a></li>
      <li class="breadcrumb-item active">Maternidad</li>

    </ol>

    <div class="card mb-4">

       <!--=============================================
      SECCION PARA EL FILTRADOR POR FECHAS
      =============================================-->
      <div class="card-body">

        <div class="right_col alert alert-info" role="main">

          <form id="frmMaternidades">

            <div class="row">

              <div class="form-group col-xs-10 col-sm-5 col-md-3 col-lg-3">

                <label for="fechaIniMaternidades">FECHA INICIAL</label>
                <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                <div class="input-group">
                  
                  <input type="date" class="form-control" name="fechaIniMaternidades" id="fechaIniMaternidades">

                </div>

              </div>

              <div class="form-group col-xs-10 col-sm-5 col-md-3 col-lg-3">

                <label for="fechaFinMaternidades">FECHA FINAL</label>
                <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                <div class="input-group">

                  <input type="date" class="form-control" name="fechaFinMaternidades" id="fechaFinMaternidades">

                </div>

              </div>

              <div class="form-group col-xs-2 col-sm-2 col-md-2 col-lg-2">

                <label></label>
                <div class="input-group-append mt-2">
                  <button type="button" class="btn btn-primary px-2" id="btnBuscarMaternidades">
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

        <i class="fas fa-table me-1"></i>LISTADO PACIENTES EN MATERNIDAD

      </div>

      <div class="card-body">

    		<table class="table table-striped table-bordered shadow-lg mt-4" id="tblMaternidades">
    			
    			<thead class="text-light bg-primary">
            <tr>
              <th scope="col">#</th>
              <th scope="col">FECHA</th>
              <th scope="col">PROC.</th>
              <th scope="col">HORA</th>
              <th scope="col">NOMBRE Y APELLIDO</th>
              <th scope="col">EDAD</th>
              <th scope="col">N° DE ASEGURADO</th>
              <th scope="col">N° PATRONAL</th>
              <th scope="col">RAZON SOCIAL</th>
              <th scope="col">ESTADO CIVIL</th>
              <th scope="col">PROCEDENCIA</th>
              <th scope="col">PARIDAD</th>
              <th scope="col">EDAD GESTACIONAL</th>
              <th scope="col">TIPO DE PARTO</th>
              <th scope="col">LIQUIDO AMNIOTICO</th>
              <th scope="col">FECHA</th>
              <th scope="col">PESO R.N</th>
              <th scope="col">HORA DE NACIMIENTO</th>
              <th scope="col">SEXO</th>
              <th scope="col">ALUMBRAMIENTO</th>
              <th scope="col">PERINE</th>
              <th scope="col">SANGRADO</th>
              <th scope="col">ESTADO DE LA MADRE</th>
              <th scope="col">NOMBRE DEL ESPOSO</th>
              <th scope="col">SALA</th>
              <th scope="col">CAMA</th>
              <th scope="col">CAUSA ALTA</th>
            </tr>
    			</thead>
    	   
    	    <tbody>
    	         
    	    </tbody>
    		
    		</table>

      </div>

    </div>

	</div>
	
</main>