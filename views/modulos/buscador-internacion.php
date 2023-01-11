<main id="formulario">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5" style="width: 800px;">
        <div class="card shadow-lg border-0 rounded-lg mt-5">

          <div class="card-header bg-secundary" >
            <h2 class="titulo_marquesina my-2">BUSCAR PACIENTES INTERNADOS</h2>
          </div>

          <div class="card-body">

            <div class="row">
              
              <div class="offset-md-2 col-md-8 offset-md-2 col-sm-12">

                <select class="form-select form-select-lg mb-3" id="selectOption">
                  <option value="" disabled selected>SELECCIONE UNA OPCIÓN...</option>
                  <option value="1">Buscar por Matricula</option>
                  <option value="2">Buscar por CI</option>
                  <option value="3">Buscar por Nombre(s) o Apellido(s)</option>
                </select>

              </div>

            </div>

            <div class="row d-none" id="filtroMatricula">

              <div class="offset-md-2 col-md-8 offset-md-2 col-sm-12">

                <form method="post" id="frmBuscarMatricula">

                  <label for="matricula">Matricula (Ej. 901510AHG)</label>

                  <div class="input-group mb-3">
                    
                    <input type="text" class="form-control mayuscula" id="buscarMatricula" placeholder="Ingrese Matricula Asegurado" name="buscarMatricula">

                    <span class="input-group-btn ml-2">

                      <button type="button" class="btn btn-primary" id="btnBuscarMatricula"><i class="fas fa-search mr-2"></i>Buscar</button>

                    </span>

                  </div>

                </form>

              </div>    

            </div>

            <div class="row d-none" id="filtroCI">
              
              <div class="offset-md-2 col-md-8 offset-md-2 col-sm-12">

                <form method="post" id="frmBuscarCI">

                  <label for="ci">Nro. CI (Ej. 4002015)</label>

                  <div class="input-group mb-3">
                    
                    <input type="text" class="form-control" id="buscarCI" placeholder="INGRESE NRO. CI" name="buscarCI">

                    <span class="input-group-btn ml-2">

                      <button type="button" class="btn btn-primary" id="btnBuscarCI"><i class="fas fa-search mr-2"></i>Buscar</button>

                    </span>

                  </div>

                </form>

              </div>

            </div>

            <div class="row d-none" id="filtroNombre">    

              <div class="offset-md-2 col-md-8 offset-md-2 col-sm-12">

                <form method="post" id="frmBuscarNombre">

                  <label for="ci">Nombre(s) o Apellido(s) (Ej. JUAN -o- Ej. LOPEZ)</label>

                  <div class="input-group mb-3">
                    
                    <input type="text" class="form-control mayuscula" id="buscarNombre" placeholder="INGRESE NOMBRE DE LA PERSONA" name="buscarNombre">

                    <span class="input-group-btn ml-2">

                      <button type="button" class="btn btn-primary" id="btnBuscarNombre"><i class="fas fa-search mr-2"></i>Buscar</button>

                    </span>

                  </div>

                </form>

              </div>

            </div>                         

          </div>

          <div class="card-footer">

            <div class="mostrarResultadoIntenacion">

             
            </div> 

          </div>
        </div>
      </div>
    </div>
  </div>
</main>