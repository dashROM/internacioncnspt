<main>

<div class="container-fluid px-4">
  <h1 class="mt-4">Transferencias Internas</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active"> Transferencias Internas</li>
    </ol>
		
		<table class="table table-striped table-bordered shadow-lg mt-4"id="tblTransferencia">
			
			<thead class="table-dark">
		    <tr>
             <th scope="col">ID</th>
             <th scope="col">Fecha</th>
             <th scope="col">Servicios</th>
             <th scope="col">Sala</th>
             <th scope="col">Cama</th>
             <th scope="col">Medico</th>
             <th scope="col">Acciones</th>
		    </tr>
			</thead>
	   
	    <tbody>
	         
	    </tbody>
		
		</table>

	</div>
	
</main>
<!--=====================================
MODAL EDITAR PERSONA DE TRASFERENCIA 
======================================-->
<div class="modal fade" id="ModaleditarTrasferencia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
     <div class="modal-header bg-primary">
     <h5 class="modal-title" id="exampleModalLabel">Nuevo Transferencia Interna</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" id="frmEditarTrasferencia" action="">
          <div class="row g-3">
          <div class="mb-3">
            <label for="schedulde_date"> FECHA </label>
            <input type="hidden" id="editaridtransferencia" name="idtransferencia">
              <input type="date" class="form-control" name="fecha" id="editarfecha" required value="Fecha", date('d-m-y')> </input>
            </div>
          </div>
            <div class="mb-3"> 
               <label for="" class="form-label">Unidad sanitaria</label> 
                <select name="servicio" id="editarservicio" class="form-control">
                 <?php 
                    $especialidades =  ControllerEspecialidades::ctrBuscarEspecialidades();
                    foreach($especialidades as  $key => $value){
                    echo '<option value="'.$value["nombre_especialidad"].'">'.$value["nombre_especialidad"].'</option>';
                      }
                  ?> 
                </select>
             </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary btnGuardar">guardar</button>
        <input type="hidden" id="idpacientetransferencia" name="idpacientetransferencia">
        <input type="hidden" id="idingresopacientetransferencia" name="idingresopacientetransferencia">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>