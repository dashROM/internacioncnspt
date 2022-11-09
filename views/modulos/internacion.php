<!--=====================================
MOSTRAR REGISTRO 
======================================-->
<main>
<div class="container-xl px-4">

		<h1 class="mt-4">Lisatados de Pacientes Internados</h1>

		<ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/inicio">Inicio</a></li>
	 		<li class="breadcrumb-item active">Listado Pacientes Internados</li>
		</ol>

      <div class="card mb-4">
        <div class="card-body">
          <!-- <button type="button" class="btn btn-success btninternacion" data-bs-toggle="modal" data-bs-target="#internacion-pdf"> <i class='fas fa-print'> Reporte de Internacion </i></button> -->
        <!--=============================================
        SECCION PARA EL BUSCADOR VINCULADO AL ERP
        =============================================-->

<div class="right_col alert alert-info" role="main">

      <form id="buscar">

        <div class="row">
          <div class="col-md-3">
            <div class="input-group form-group">
                  <label> DESDE </label>
                  <input class="form-control" type="date" name="min" id="min" min="2020-01-01" min="<?= date("Y-m-d") ?>">
            </div>       
        </div>   
        
        <div class="col-md-3">
            <div class="input-group">
                  <label>HASTA</label>
                  <input class="form-control" type="date" name="max" id="max" max="<?= date("Y-m-d") ?>">
            </div>       
        </div>  


        <div class="col-md-3">
            <div class="form-group">
            <button class="btn btn-primary px-2 btnbuscar" type="button"> <i class="fas fa-search"></i> Buscar</button>
           

            <button type="button" class="btn btn-danger px-2 btninternacion" id="daterange-btn2">
            
            <i class="fas fa-file-pdf"></i></i> Exportar PDF
          
          </button>     
          </div>     
        </div>  

        <!-- <font id="mensaje" style="display: none; color: blue;">Buscando...Espere por favor!</font> -->
        <font id="error" style="display: none; color: red">Ocurrió un Error. Por favor vuelva a intentar!</font>
        


      </form>

</div>

<!-- FIN BUSCADOR -->
        </div>
      </div>

      <div class="card mb-4">

          <div class="card-header">

            <i class="fas fa-table me-1"></i>Listado Pacientes

          </div>
            <div class="card-body" id="resultado"> 
              <table class="table table-striped table-bordered shadow-lg mt-4"  id="tblInternacion">
                      <thead class="text-light bg-primary">
                        <tr>
                              <th scope="col">Numero</th>
                              <th scope="col">fecha</th>
                              <th scope="col">Servicio</th>
                              <th scope="col">Nombre</th>
                              <th scope="col">Apellido</th>
                              <th scope="col">Sala</th>
                              <th scope="col">Cama</th>
                              <th scope="col">Doctor de turno</th>
                        </tr>
                      </thead>
              
                      <tbody>
                          
                      </tbody>
              </table>
            </div>
      </div>
  </div>
</main>
<div  id="internacion-pdf" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog" tabindex="-1" aria-labelledby="reporteInternacion" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="reporteInternacion">Mostrar Internacion de pacientes</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>                   
                            
      <div class="modal-body">
        <div id="ver1_pdf" style="height:550px"> 


        </div>  
      </div>  

      <div class="modal-footer">
        <button type="button" class="btn btn-danger btnCerrar float-left" data-bs-dismiss="modal">Cerrar</button>     
      </div>

    </div>
  </div>
</div>
