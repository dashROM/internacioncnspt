<main id="formulario">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-5" style="width: 100%;">
        <div class="card shadow-lg border-0 rounded-lg mt-5">

          <div class="card-header bg-secundary" >
            <marquee>
            <h2 class="my-2" style="color: #188351;">PACIENTES INTERNADOS (POTOSÍ <?= date("d")."/".date("m")."/".date("Y"); ?>)</h2>
            </marquee>
          </div>

          <div class="card-body">

            <div class="row">
              
              <div class="col-md-6 col-sm-12 col-xs-12">

                <marquee style="height:65vh;" behavior=”scroll” scrollamount="1" direction="up">

                  <h4 class="my-2" style="color: #188351;">SERVICIO: MEDICINA INTERNA</h4>

                  <div class="mb-4">

                    <table class="table table-bordered table-striped dt-responsive" id="tblMedicinaInterna" width="100%">

                      <thead class="text-light bg-success">

                        <tr>
                          <th scope="col">FECHA INGRESO</th>
                          <th scope="col">PACIENTE</th>
                          <th scope="col">SALA</th>
                          <th scope="col">CAMA</th>
                        </tr>

                      </thead>

                    </table>

                  </div>

                  <h4 class="my-2" style="color: #188351;">SERVICIO: NEUMOLOGIA</h4>

                  <div class="mb-4">

                    <table class="table table-bordered table-striped dt-responsive" id="tblNeumologia" width="100%">

                      <thead class="text-light bg-success">

                        <tr>
                          <th scope="col">FECHA INGRESO</th>
                          <th scope="col">PACIENTE</th>
                          <th scope="col">SALA</th>
                          <th scope="col">CAMA</th>
                        </tr>

                      </thead>

                    </table>

                  </div>

                  <h4 class="my-2" style="color: #188351;">SERVICIO: UTI</h4>

                  <div class="mb-4">

                    <table class="table table-bordered table-striped dt-responsive" id="tblTerapiaIntensiva" width="100%">

                      <thead class="text-light bg-success">

                        <tr>
                          <th scope="col">FECHA INGRESO</th>
                          <th scope="col">PACIENTE</th>
                          <th scope="col">SALA</th>
                          <th scope="col">CAMA</th>
                        </tr>

                      </thead>

                    </table>

                  </div>

                </marquee>

              </div>

              <div class="col-md-6 col-sm-12 col-xs-12">

                <marquee style="height:65vh;" behavior=”scroll” scrollamount="1" direction="up">

                  <h4 class="my-2" style="color: #188351;">SERVICIO: CIRUGIA</h4>

                  <div class="mb-4">

                    <table class="table table-bordered table-striped dt-responsive" id="tblCirugia" width="100%">

                      <thead class="text-light bg-success">

                        <tr>
                          <th scope="col">FECHA INGRESO</th>
                          <th scope="col">PACIENTE</th>
                          <th scope="col">SALA</th>
                          <th scope="col">CAMA</th>
                        </tr>

                      </thead>

                    </table> 

                  </div> 

                  <h4 class="my-2" style="color: #188351;">SERVICIO: MATERNIDAD</h4>

                  <div class="mb-4">

                    <table class="table table-bordered table-striped dt-responsive" id="tblMaternidad" width="100%">

                      <thead class="text-light bg-success">

                        <tr>
                          <th scope="col">FECHA INGRESO</th>
                          <th scope="col">PACIENTE</th>
                          <th scope="col">SALA</th>
                          <th scope="col">CAMA</th>
                        </tr>

                      </thead>

                    </table>  

                  </div>              

                  <h4 class="my-2" style="color: #188351;">SERVICIO: NEONATOLOGIA</h4>

                  <div class="mb-4">

                    <table class="table table-bordered table-striped dt-responsive" id="tblNeonatologia" width="100%">

                      <thead class="text-light bg-success">

                        <tr>
                          <th scope="col">FECHA INGRESO</th>
                          <th scope="col">PACIENTE</th>
                          <th scope="col">SALA</th>
                          <th scope="col">CAMA</th>
                        </tr>

                      </thead>

                    </table>

                  </div>

                  <h4 class="my-2" style="color: #188351;">SERVICIO: GINECOLOGIA</h4>

                  <div class="mb-4">

                    <table class="table table-bordered table-striped dt-responsive" id="tblGinecologia" width="100%">

                      <thead class="text-light bg-success">

                        <tr>
                          <th scope="col">FECHA INGRESO</th>
                          <th scope="col">PACIENTE</th>
                          <th scope="col">SALA</th>
                          <th scope="col">CAMA</th>
                        </tr>

                      </thead>

                    </table>

                  </div>

                </marquee>

              </div>

            </div>

          </div>

          <div class="card-footer">

          </div>

        </div>
      </div>
    </div>
  </div>
</main>