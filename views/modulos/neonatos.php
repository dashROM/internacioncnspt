<main>

	<div class="container-xl px-4">

		<h1 class="mt-4">NEONATOS</h1>

		<ol class="breadcrumb p-2 mb-4 shadow">

      <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/inicio">Inicio</a></li>
      <li class="breadcrumb-item active">Neonatos</li>

    </ol>

    <div class="card mb-4">

      <!--=============================================
      SECCION PARA EL FILTRADOR POR FECHAS
      =============================================-->
      <div class="card-body">

        <div class="right_col alert alert-info" role="main">

          <form id="frmNeonatos">

            <div class="row">

              <div class="form-group col-xs-10 col-sm-5 col-md-3 col-lg-3">

                <label for="fechaIniNeonatos">FECHA INICIAL</label>
                <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                <div class="input-group">
                  
                  <input type="date" class="form-control" name="fechaIniNeonatos" id="fechaIniNeonatos">

                </div>

              </div>

              <div class="form-group col-xs-10 col-sm-5 col-md-3 col-lg-3">

                <label for="fechaFinNeonatos">FECHA FINAL</label>
                <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                <div class="input-group">

                  <input type="date" class="form-control" name="fechaFinNeonatos" id="fechaFinNeonatos">

                </div>

              </div>

              <div class="form-group col-xs-2 col-sm-2 col-md-2 col-lg-2">

                <label></label>
                <div class="input-group-append mt-2">
                  <button type="button" class="btn btn-primary px-2" id="btnBuscarNeonatos">
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

        <i class="fas fa-table me-1"></i>LISTADO PACIENTES EN NEONATOLOGIA

      </div>

      <div class="card-body">

    		<table class="table table-striped table-bordered shadow-lg mt-4" id="tblNeonatos">
    			
    			<thead class="text-light bg-primary">
            <tr>
              <th scope="col">#</th>
              <th scope="col">FECHA</th>
              <th scope="col">HORA</th>
              <th scope="col">NOMBRE Y APELLIDO(S)</th>
              <th scope="col">CAMA</th>
              <th scope="col">SEXO</th>
              <th scope="col">PESO</th>
              <th scope="col">TALLA</th>
              <th scope="col">PC</th>
              <th scope="col">PT</th>
              <th scope="col">APGAR</th>
              <th scope="col">EDAD GEST.</th>
              <th scope="col">N° DE ASEGURADO</th>
              <th scope="col">N° PATRONAL</th>
              <th scope="col">TIPO DE PARTO</th>
              <th scope="col">DIAGNOSTICO(S) INGRESO</th>
              <th scope="col">DIAGNOSTICO(S) EGRESO</th>
              <th scope="col">ZONA</th>
              <th scope="col">FECHA EGRESO</th>
              <th scope="col">HORA EGRESO</th>
              <th scope="col">CAUSA ALTA</th>
              <th scope="col">OBSERVACIONES</th>
            </tr>
    			</thead>
    	   
    	    <tbody>
    	         
    	    </tbody>
    		
    		</table>

      </div>

    </div>

	</div>
	
</main>