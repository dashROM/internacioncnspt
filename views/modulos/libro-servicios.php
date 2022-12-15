<main>

	<div class="container-xl px-4">

		<h1 class="mt-4">LIBROS SERVICIOS</h1>

		<ol class="breadcrumb p-2 mb-4 shadow">

      <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/inicio">Inicio</a></li>
      <li class="breadcrumb-item active">Libro Servicios</li>

    </ol>

    <div class="card mb-4">

      <!--=============================================
      SECCION PARA EL FILTRADOR POR FECHAS
      =============================================-->
      <div class="card-body">

        <div class="right_col alert alert-info" role="main">

          <form id="frmLibroServicios">

            <div class="row">

              <div class="form-group col-xs-10 col-sm-5 col-md-3 col-lg-3">

                <label for="fechaIniPediatria">SERVICIO</label>
                <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                <div class="input-group">
                  
                  <select class="form-select" name="servicio" id="servicio" required>
                    <option value="" disabled selected>ELEGIR...</option>
                    <option value="1">PEDIATRIA</option>
                    <option value="21">GINECOLOGIA</option>
                    <option value="4">MEDICINA INTERNA</option>
                    <option value="5">CIRUGIA</option>
                    <option value="6">NEUMOLOGIA</option>
                    <option value="7">UTI</option>                 
                  </select>

                </div>

              </div>

              <div class="form-group col-xs-10 col-sm-5 col-md-3 col-lg-3">

                <label for="fechaIniLibroServicio">FECHA INICIAL</label>
                <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                <div class="input-group">
                  
                  <input type="date" class="form-control" name="fechaIniLibroServicio" id="fechaIniLibroServicio" required>

                </div>

              </div>

              <div class="form-group col-xs-10 col-sm-5 col-md-3 col-lg-3">

                <label for="fechaFinLibroServicio">FECHA FINAL</label>
                <label>(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                <div class="input-group">

                  <input type="date" class="form-control" name="fechaFinLibroServicio" id="fechaFinLibroServicio" required>

                </div>

              </div>

              <div class="form-group col-xs-2 col-sm-2 col-md-2 col-lg-2">

                <label></label>
                <div class="input-group-append mt-2">
                  <button type="button" class="btn btn-primary px-2" id="btnBuscarLibroServicios">
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

        <i class="fas fa-table me-1"></i>LISTADO PACIENTES EN <span id="nombre_servicio"></span>

      </div>

      <div class="card-body">

    		<table class="table table-striped table-bordered shadow-lg mt-4" id="tblLibroServicios">
    			
    			<thead class="text-light bg-primary">
            <tr>
              <th scope="col">#</th>
              <th scope="col">DIA</th>
              <th scope="col">MES</th>
              <th scope="col">AÑO</th>
              <th scope="col">HORA</th>
              <th scope="col">APELLIDO PATERNO</th>
              <th scope="col">APELLIDO MATERNO</th>
              <th scope="col">NOMBRE(S)</th>
              <th scope="col">PROCEDENCIA</th>
              <th scope="col">EDAD</th>
              <th scope="col">SEXO</th>
              <th scope="col">COD.</th>
              <th scope="col">ESTADO CIVIL</th>
              <th scope="col">ZONA</th>
              <th scope="col">CAMA</th>
              <th scope="col">AVC NUMEROS</th>
              <th scope="col">AVC LETRAS</th>
              <th scope="col">NRO. PATRONAL</th>
              <th scope="col">CIE 10 INGRESO</th>
              <th scope="col">DIAGNOSTICO INGRESO</th>
              <th scope="col">SERVICIO</th>
              <th scope="col">CIE 10 EGRESO</th>
              <th scope="col">DIAGNOSTICO EGRESO</th>
              <th scope="col">DIA</th>
              <th scope="col">MES</th>
              <th scope="col">AÑO</th>
              <th scope="col">HORA</th>
              <th scope="col">TIPO ALTA</th>
            </tr>
    			</thead>
    	   
    	    <tbody>
    	         
    	    </tbody>
    		
    		</table>

      </div>

    </div>

	</div>
	
</main>