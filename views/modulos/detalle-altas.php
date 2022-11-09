<main>

<div class="container-fluid px-4">
  <h1 class="mt-4">Altas</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/inicio">Inicio</a></li>
      <li class="breadcrumb-item active"> Paciente Egresado </li>
    </ol>
		
		<table class="table table-striped table-bordered shadow-lg mt-4"id="tblAltas">
			
			<thead class="table-dark">
		    <tr>
          <th scope="col">ID</th>
          <th scope="col">Nombre</th>
          <th scope="col">Apellido</th>
          <th scope="col">fecha</th>
          <th scope="col">hora</th>
          <th scope="col">DiagnosticoEgreso</th>
          <th scope="col">CondicionEgreso</th>
          <th scope="col">CausaEgreso</th>
          <th scope="col">Medico</th>
          <th scope="col">Causa Clinica</th>
          <th scope="col">Causa Autopsia</th>
          <th scope="col">Acciones</th>
		    </tr>
			</thead>
	   
	    <tbody>
	         
	    </tbody>
		
		</table>

	</div>
	
</main>



<!--=====================================
MODAL EDITAR ALTA
======================================-->
<div class="modal fade" id="ModaleditarAltas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
     <div class="modal-content">
      <div class="modal-header bg-primary">
      <h5 class="modal-title" id="exampleModalLabel">Paciente dado de alta </h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form method="post" id="frmEditarAltas" action="">
        <div class="row g-3">
          <div class="col-md-6">  
            <label for="schedulde_date"> FECHA </label>
            <input type="date" class="form-control" name="fecha" id="editarfecha" required value="Fecha", date('d-m-y')> </input>
        </div>

        <div class="col-md-6">
            <label for="schedulde_time"> HORA </label>
            <input type="time" class="form-control" name="hora" id="editarhora" required value="Hora", date('h:i')> </input>
        </div>   

          <div class="col-md-6"> 
                      <label for="" class="form-label">Diagnostico al Ingreso</label> 
                        <select name="diagnosticoegreso" id="editardiagnosticoegreso" class="form-control">
                          <?php 
                              $diagnostico =  ControllerDiagnosticos::ctrBuscarDiagnosticos();
                              foreach($diagnostico as  $key => $value){
                              echo '<option value="'.$value["nombre_diagnostico"].'"> '.$value["codigo"].''.$value["nombre_diagnostico"].' </option>';
                                }
                            ?> 
                        </select>
          </div> 

          <div class="row g-3"> 
            <div class="col-md-6">
              <label  class="form-label">Causa Egreso</label>
              <select name="causaegreso" id="editarcausaegreso"class="from-control">
                <option value="Alta Medica"> Alta Medica </option>
                <option value="Trasferencia Externa"> Trasferencia Externa </option>
                <option value="Abandono"> Abandono </option>
                <option value="Muerte Institucional"> Muerte Institucional</option>
                <option value="Muerte No Institucional"> Muerte No Institucional</option>
                <option value="Alta solicitada"> Alta solicitada</option>
                <option value="Indiciplina"> Indiciplina</option>
                <option value="Otros"> Otros</option>
            </select>  
          </div> 

          <div class="col-md-6">
            <label  class="form-label">Condicion al  Egreso</label>
            <select name="condicionegreso" id="editarcondicionegreso"class="from-control">
                <option value="Curado"> Curado </option>
                <option value="Mejorado"> Mejorado </option>
                <option value="Mismo estado">Mismo estado </option>
                <option value="Incurable"> Incurable </option>
                <option value="No tratado"> No tratado</option>
            </select>  
          </div>

          <div class="col-md-12">
            <label for="causamuerte" class="form-label"> En caso de muerte </label>
            <input id="editarcausamuerte" name="causamuerte" type="text" class="form-control" placeholder="Causa de Muerte" >
          </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary btnGuardar">guardar</button>
          <input type="hidden" id="idpacientealta" name="idpacientealta">
          <input type="hidden" id="idingresopaciente" name="idingresopaciente">
          <input type="hidden" id="editaridaltas" name="idaltas">
        </div> 
          </form>
    </div>
   </div>
  </div>
 </div> 
 </div>
</div>

        