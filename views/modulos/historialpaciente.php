<div class="card-header">
            <h5><b>Historial De Paciente internado</b></h5>
           </div> <!--Cerramos el CARD HEADER-->
           <!--CARD BODY--> 
           <div class="card-body">
        <!------------------------------------------------------ DESDE AQUI CONTINUAN--------------------------------------->
    
            <div class="right_col alert alert-info" role="main">

            <form id="frmhistorialpaciente">

              <div class="col-xs-12 col-sm-10 col-md-9 col-lg-9">

                <div class="row">
                  
                  <!-- <div class="col-12 col-sm-6 col-md-6 col-lg-6">

                    <div class="form-group">

                      <label>Nombre</label> (*)
                      <input type="text" class="form-control" name="pac_nombre" id="pac_nombre" value=""> 

                    </div>

                  </div> -->

                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                    <label> Nro de Asegurado</label> (*)
                    <div class="input-group">

                      <input type="text" class="form-control" name="pac_numero_historia" id="pac_numero_historia" placeholder="50333...">
                      <span class="input-group-btn ml-2">
                        <button class="btn btn-primary" type="button" id="btnSearch">
                          <i class="fas fa-search"></i> Buscar
                        </button>
                      </span>

                    </div>

                  </div>
                </div>

                <font id="mensaje" style="display: none; color: blue;">Buscando...Espere por favor!</font>
                <font id="error" style="display: none; color: red">Ocurrió un Error. Por favor vuelva a intentar!</font>

              </div>   

            </form>
          </div> 
             

<div class="container">
    <form id="frmhistorialpaciente">
        <div class="row">
              <div class="col-md-3 form-group">
                <label for="pac_nombre" class="form-label"> Nombre  </label>
                <input id="pac_nombre"  type="text" class="form-control" name="pac_nombre" readonly>
              </div>
              
              <div class="col-md-3 form-group">
                <label for="pac_primer_apellido" class="form-label">ApellidoPaterno</label>
                <input id="pac_primer_apellido"  type="text" class="form-control" name="pac_primer_apellido" readonly>
              </div>

              <div class="col-md-3 form-group">
                <label for="pac_segundo_apellido" class="form-label">ApellidoMaterno</label>
                <input id="pac_segundo_apellido"  type="text" class="form-control"name="pac_segundo_apellido" readonly>
              </div>
        </div>  
        <div class="row">
              <div class="col-md-3 form-group">
                <label for="fecha" class="form-label"> Fecha </label>
                <input id="fecha"  type="text" class="form-control" name="fecha" readonly>
              </div>

              <div class="col-md-3 form-group">
                <label for="" class="form-label"> Hora </label>
                <input id="hora"  type="text" class="form-control" name="hora" readonly>
              </div>

              <div class="col-md-3 form-group">
                <label for="diagnostico" class="form-label"> Diagnostico </label>
                <input id="diagnosticoingreso"  type="text" class="form-control" name="diagnosticoingreso" readonly>
              </div>

  
        </div>
        <div class="row">

              <div class="col-md-6 form-group">
                <label for="servicio" class="form-label"> Servicio </label>
                <input id="nombre_especialidad"  type="text" class="form-control" name="nombre_especialidad" readonly>
              </div>

              <div class="col-md-6 form-group">
                <label for="clave" class="form-label"> Medico </label>
                <input id="per_nombre"  type="text" class="form-control" name="per_nombre" readonly>
              </div>

        </div>
        <div class="row">
              <div class="col-md-6 form-group">
                <label for="sala" class="form-label"> Sala </label>
                <input id="descripcion"  type="text" class="form-control" name="descripcion" readonly>
              </div>

              <div class="col-md-6 form-group">
                <label for="cama" class="form-label"> Cama </label>
                <input id="descripcioncama"  type="text" class="form-control" name="descripcioncama" readonly>
              </div>
        </div>      
              <h5><b>Transferencia Interna</b></h5>
        <div class="row">
              <div class="col-md-6 form-group">
                <label for="fecha" class="form-label"> Fecha de Transferencia</label>
                <input id="fechatransferencia"  type="text" class="form-control" name="fecha" readonly>
              </div>    
              
              <div class="col-md-6 form-group">
                <label for="servicio" class="form-label"> Servicio </label>
                <input id="servicio"  type="text" class="form-control" name="servicio" readonly>
              </div>
        </div>
        <div class="row">
              <div class="col-md-3 form-group">
                <label for="medico" class="form-label"> Medico </label>
                <input id="medico"  type="text" class="form-control" name="medico" readonly>
              </div>

              <div class="col-md-3 form-group">
                <label for="salat" class="form-label"> Sala </label>
                <input id="salat"  type="text" class="form-control" name="sala" readonly>
              </div>

              <div class="col-md-3 form-group">
                <label for="camat" class="form-label"> Cama </label>
                <input id="camat"  type="text" class="form-control" name="cama" readonly>
              </div>

        </div>
     </form>
</div>      