<main>

	<div class="container-xl px-4">

		<h1 class="mt-4">SERVICIOS</h1>

		<ol class="breadcrumb p-2 mb-4 shadow">

	 		<li class="breadcrumb-item"><a href="<?= BASEURL; ?>/inicio">Inicio</a></li>
      <li class="breadcrumb-item active">Servicios</li>

		</ol>

    <div class="card mb-4 shadow">

      <div class="card-body">

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevoServicio"><i class="fas fa-plus"></i> Nuevo Servicio</button>
      </div>

    </div>

    <div class="card mb-4">

      <div class="card-header">

        <i class="fas fa-table me-1"></i>LISTADO SERVICIOS

      </div>

      <div class="card-body">

    		<table class="table table-striped table-bordered shadow-lg mt-4"id="tblServicios">
    			
    			<thead class="text-light bg-primary">
    		    <tr>
              <th scope="col">#</th>
              <th scope="col"></th>
    		      <th scope="col">NOMBRE DE SERVICIO</th>
              <th scope="col">ESTABLECIMIENTO</th>
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

<div class="modal fade" id="Modalnuevaespecialidad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header bg-primary">
     <h5 class="modal-title" id="exampleModalLabel">Nueva Especialidad</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="frmNuevaespecialidad" action="">
          <div class="row g-3">
            <div class="col-md-6 form-group ">  
              <label for="" class="form-label">Nueva Especialidad</label>
              <input  type="hidden" id="idespecialidad" name="especialidad">
              <input id="nombre_especialidad" name="nombre_especialidad" type="text" class="form-control">
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
</div>


<!--=====================================
MODAL PARA VER LA SALAS DE ESPECIALLIDAD
======================================-->


<div class="modal fade" id="modalver" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    
        <div class="modal-header bg-primary">
           <h5 class="modal-title" id="exampleModalLabel">Ver</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
     
      <div class="modal-body">
        <form method="post" id="frm">
          <div class="row g-3">
            <div class="col-md-6 form-group">  
               <label class="font-weight-bold mr-1">SALAS:</label> 
            </div>
         </div>


      <!--div class="accordion">
        <div class="accordion-item">
          <h2 class="accordion-header" id="panelsStayOpen-headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
               SALAS 
              </button>
          </h2>
        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
        <div class="accordion-body">
             <li>
               cama 
            </li> 
        </div>
      </div-->
      <div id='acordiones'></div>
      
     </div>
    </div>
        </form>
      </div>
   </div>
  </div>
</div>


<div  id="ver-pdf" class="modal fade" data-backdrop="static" data-keyboard="false" role="dialog" tabindex="-1" aria-labelledby="reportePaciente" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">

      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="reportePaciente">Mostrar especialidad</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>                   
                            
      <div class="modal-body">
        <div id="ver_pdf" style="height:550px"> 


        </div>  
      </div>  

      <div class="modal-footer">
        <button type="button" class="btn btn-danger btnCerrar float-left" data-bs-dismiss="modal">Cerrar</button>     
      </div>

    </div>
  </div>
</div>
