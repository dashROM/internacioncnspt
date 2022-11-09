<main>

	<div class="container-fluid px-4">

		<h1 class="mt-4">Establecimientos</h1>

    <ol class="breadcrumb mb-4">

      <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/inicio">Inicio</a></li>
      <li class="breadcrumb-item active">Establecimientos</li>

    </ol>

    <div class="card mb-4">
      <div class="card-body">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modalnuevoestablecimiento">Nuevo establecimiento</button>
      </div>
    </div>

    <div class="card mb-4">

      <div class="card-header">

        <i class="fas fa-table me-1"></i>Listado Establecimientos

      </div>

      <div class="card-body"> 
         
    		<table class="table table-striped table-bordered shadow-lg mt-4"id="tblEstablecimiento">
    			
    			<thead class="text-light bg-primary">
    		    <tr>
    		      <th scope="col">ID</th>
    		      <th scope="col">Nombre_Establecimeiento</th>
    		      <th scope="col">Abreviacion</th>
    		      <th scope="col">Ubicacion</th>
    		      <th scope="col">Acciones</th>
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
MODAL NUEVO ESTABLECIMIENTO
======================================-->

<div class="modal fade" id="Modalnuevoestablecimiento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header bg-primary">
     <h5 class="modal-title" id="exampleModalLabel">Nuevo Establecimeiento</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="frmNuevoEstablecimiento" action="">
          <div class="row g-3">
            <div class="col-md-6 form-group ">  
              <label for="" class="form-label">Nombre Establecimeiento</label>
              <input id="nombre_establecimiento" name="nombre_establecimiento" type="text" class="form-control">
            </div>
            <div class="col-md-6">
              <label for="" class="form-label">Abreviacion</label>
              <input id="abrev_establecimiento" name="abrev_establecimiento" type="text" class="form-control">
            </div>
            <div class="col-md-12">
              <label for="" class="form-label">Ubicacion del Establecimeiento</label>
              <input id="ubicacion_establecimiento" name="ubicacion_establecimiento" type="text" class="form-control">
            </div> 
        </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btnGuardar">guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!--=====================================
MODAL EDITAR ESTABLECIMIENTO
======================================-->

<div class="modal fade" id="ModaleditarEstablecimiento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header bg-primary">
     <h5 class="modal-title" id="exampleModalLabel">Nuevo Establecimeiento</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="frmEditarEstablecimiento" action="">
          <div class="row g-3">
            <div class="col-md-6 form-group ">  
              <label for="" class="form-label">Nombre Establecimeiento</label>
			  <input type="hidden" id="editaridestablecimiento" name="idestablecimiento">
              <input id="editarnombre_establecimiento" name="nombre_establecimiento" type="text" class="form-control">
            </div>
            <div class="col-md-6">
              <label for="" class="form-label">Abreviacion</label>
              <input id="editarabrev_establecimiento" name="abrev_establecimiento" type="text" class="form-control">
            </div>
            <div class="col-md-12">
              <label for="" class="form-label">Ubicacion del Establecimeiento</label>
              <input id="editarubicacion_establecimiento" name="ubicacion_establecimiento" type="text" class="form-control">
            </div> 
        </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btnGuardar">guardar</button>
        
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
