<?php

  $item = "id";
  $valor = $parametros[1];

  $servicio = ControllerServicios::ctrMostrarServicios($item, $valor);

?>

<main>

  <div class="container-xl px-4">

    <h1 class="mt-4">DATOS DEL SERVICIO</h1>

    <ol class="breadcrumb p-2 mb-4 shadow">

      <li class="breadcrumb-item"><a href="<?= BASEURL; ?>/inicio">Inicio</a></li>
      <li class="breadcrumb-item active"><a href="<?= BASEURL; ?>/servicios">Servicios</a></li>
      <li class="breadcrumb-item active">Detalle Servicio</li>

    </ol>

    <div class="card mb-4">

      <div class="card-header">

        <i class="fas fa-table me-1"></i><label class="font-weight-bold mr-1">SERVICIO:</label><label class="font-weight-normal"><?= $servicio['nombre_servicio'] ?></label>

      </div>  

      <div class="card-body">
      
        <div class="row">
          <div class="col-4">

            <div class="card mb-4 shadow">
              <div class="card-body">
                <h4>SALAS</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevaSala"><i class="fas fa-plus"></i>  Nueva Sala</button>
              </div>
            </div>

            <div class="list-group shadow" id="list-salas" role="tablist">

              <?php

              $item = "id_servicio";

              $salas = ControllerSalas::ctrMostrarSalas($item, $valor);

              if($salas != null) {

              ?>

              <a class="list-group-item list-group-item-action active" id="sala<?= $salas[0]['id'] ?>-list" data-bs-toggle="list" href="#sala<?= $salas[0]['id'] ?>" role="tab" aria-controls="sala<?= $salas[0]['id'] ?>"><?= $salas[0]['nombre_sala'] ?></a>

              <?php }

              for ($i = 1; $i < count($salas); $i++) { ?>

              <a class="list-group-item list-group-item-action" id="sala<?= $salas[$i]['id'] ?>-list" data-bs-toggle="list" href="#sala<?= $salas[$i]['id'] ?>" role="tab" aria-controls="sala<?= $salas[$i]['id'] ?>"><?= $salas[$i]['nombre_sala'] ?></a>

              <?php } ?>

            </div>
          </div>
          <div class="col-8">

            <div class="tab-content" id="nav-tabContent">

              <?php if($salas != null) { ?>

              <div class="tab-pane fade show active" id="sala<?= $salas[0]['id'] ?>" role="tabpanel" aria-labelledby="sala<?= $salas[0]['id'] ?>-list">

                <div class="card mb-4 shadow">
                  <div class="card-body">
                    <h4>CAMAS</h4>
                    <button type="button" class="btn btn-success btnNuevaCama" data-bs-toggle="modal" data-bs-target="#modalNuevaCama" idSala="<?= $salas[0]['id'] ?>"><i class="fas fa-plus"></i>  Nueva Cama</button>
                  </div>
                </div>

                <table class="table table-striped table-bordered shadow-lg mt-4" id="tblCama<?= $salas[0]['id'] ?>">
          
                  <thead class="text-light bg-success">
                    <tr>
                      <th scope="col"></th>
                      <th scope="col">CAMA</th>
                      <th scope="col">DESCRIPCION</th> 
                      <th scope="col">ESTADO CAMA</th>
                    </tr>
                  </thead>

                  <?php

                  $item = "id_sala";
                  $valor = $salas[0]['id'];

                  $camas = ControllerCamas::ctrMostrarCamas($item, $valor);
                
                  ?>
                 
                  <tbody>

                  <?php for ($i = 0; $i < count($camas); $i++) { 

                    if ($camas[$i]['estado_cama'] == 0) {
                      $estado_cama = "LIBRE";
                    } else {
                      $estado_cama = "OCUPADO";
                    }

                  ?>

                    <tr>
                      <td>
                        <button class='btn btn-outline-success btn-sm btnEditarCama' idServicio='<?= $parametros[1] ?>' idSala='<?= $camas [$i]["id_sala"] ?>' idCama='<?= $camas [$i]["id"] ?>' data-bs-toggle='modal' data-bs-target='#modalEditarCama' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button>
                      </td>
                      <td><?= $camas[$i]['nombre_cama'] ?></td>
                      <td><?= $camas[$i]['descripcion_cama'] ?></td>
                      <td><?= $estado_cama ?></td> 
                    </tr>

                  <?php } ?>
                       
                  </tbody>
                
                </table>

              </div>

              <?php } 

              for ($i = 1; $i < count($salas); $i++) { ?>

              <div class="tab-pane fade show" id="sala<?= $salas[$i]['id'] ?>" role="tabpanel" aria-labelledby="sala<?= $salas[$i]['id'] ?>-list">

                <div class="card mb-4">
                  <div class="card-body">
                    <h4>CAMAS</h4>
                    <button type="button" class="btn btn-success btnNuevaCama" data-bs-toggle="modal" data-bs-target="#modalNuevaCama" idSala="<?= $salas[$i]['id'] ?>"><i class="fas fa-plus"></i>  Nueva Cama</button>
                  </div>
                </div>
                
                <table class="table table-striped table-bordered shadow-lg mt-4" id="tblCama<?= $salas[$i]['id'] ?>">
          
                  <thead class="text-light bg-success">
                    <tr>
                      <th scope="col"></th>
                      <th scope="col">CAMA</th>
                      <th scope="col">DESCRIPCION</th>
                      <th scope="col">ESTADO CAMA</th>
                    </tr>
                  </thead>

                  <?php

                  $item = "id_sala";
                  $valor = $salas[$i]['id'];

                  $camas = ControllerCamas::ctrMostrarCamas($item, $valor);

                  ?>
                 
                  <tbody>

                  <?php for ($j = 0; $j < count($camas); $j++) { 
                    if ($camas[$j]['estado_cama'] == 0) {
                      $estado_cama = "LIBRE";
                    } else {
                      $estado_cama = "OCUPADO";
                    }
                  ?>

                    <tr>
                      <td>
                        <button class='btn btn-outline-success btn-sm btnEditarCama' idServicio='<?= $parametros[1] ?>' idSala='<?= $camas [$j]["id_sala"] ?>' idCama='<?= $camas [$j]["id"] ?>' data-bs-toggle='modal' data-bs-target='#modalEditarCama' data-toggle='tooltip' title='Editar'><i class='fas fa-pencil-alt'></i></button>
                      </td>
                      <td><?= $camas[$j]['nombre_cama'] ?></td>
                      <td><?= $camas[$j]['descripcion_cama'] ?></td>
                      <td><?= $estado_cama ?></td>
                    </tr>

                  <?php } ?>
                       
                  </tbody>
                
                </table>

              </div>

              <?php } ?>

            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

</main> 

<!--=====================================
MODAL NUEVA SALA 
======================================-->
<div class="modal fade" id="modalNuevaSala" tabindex="-1" aria-labelledby="nuevaSala" aria-hidden="true">

  <div class="modal-dialog modal-sm">

    <div class="modal-content">

      <form method="post" id="frmNuevaSala">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="nuevaSala">Agregar Sala</h5>
          <button type="button" class="btn btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          
          <div class="row">

            <div class="col-12">

              <!-- ENTRADA PARA EL NOMBRE DE LA SALA -->

              <div class="form-group">
                <label for="nuevoNombreSala" class="form-label">NOMBRE SALA</label>  
                <input type="text" class="form-control mayuscula" id="nuevoNombreSala" name="nuevoNombreSala">
              </div>

              <!-- ENTRADA PARA LA DESCRIPCION DE LA SALA -->
              <div class="form-group">
                <label for="nuevoDescripcionSala" class="form-label">DESCRIPCION SALA</label>  
                <input type="text" class="form-control mayuscula" id="nuevoDescripcionSala" name="nuevoDescripcionSala">
              </div>
              
            </div>

          </div>  

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">

          <button type="button" class="btn btn-round btn-danger float-left" data-bs-dismiss="modal" aria-label="Close">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

          <button type="button" class="btn btn-round btn-primary btnGuardar">

            <i class="fas fa-save"></i>
            Guardar Sala

          </button>

          <input type="hidden" id="idServicio" name="idServicio" value="<?= $parametros[1] ?>">

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL NUEVA CAMA
======================================-->
<div class="modal fade" id="modalNuevaCama" tabindex="-1" aria-labelledby="nuevaCama" aria-hidden="true">

  <div class="modal-dialog modal-sm">

    <div class="modal-content">

      <form method="post" id="frmNuevaCama">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="nuevaCama">Agregar Cama</h5>
          <button type="button" class="btn btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          
          <div class="row">

            <div class="col-12">

              <!-- ENTRADA PARA EL NOMBRE DE LA CAMA -->
              <div class="form-group">
                <label for="nuevoNombreCama" class="form-label">NOMBRE CAMA</label>  
                <input type="text" class="form-control mayuscula" id="nuevoNombreCama" name="nuevoNombreCama">
              </div>

              <!-- ENTRADA PARA LA DESCRIPCION DE LA CAMA -->
              <div class="form-group">
                <label for="nuevoDescripcionCama" class="form-label">DESCRIPCION CAMA</label>  
                <input type="text" class="form-control mayuscula" id="nuevoDescripcionCama" name="nuevoDescripcionCama">
              </div>
              
            </div>

          </div>  

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">

          <button type="button" class="btn btn-round btn-danger float-left" data-bs-dismiss="modal" aria-label="Close">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

          <button type="button" class="btn btn-round btn-primary btnGuardar">

            <i class="fas fa-save"></i>
            Guardar Cama

          </button>

          <input type="hidden" id="idSala" name="idSala" value="<?= $salas[0]['id'] ?>">

        </div>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR CAMA
======================================-->
<div class="modal fade" id="modalEditarCama" tabindex="-1" aria-labelledby="editarCamaDS" aria-hidden="true">

  <div class="modal-dialog modal-sm">

    <div class="modal-content">

      <form method="post" id="frmEditarCama">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->
        <div class="modal-header bg-modal">

          <h5 class="modal-title" id="editarCamaDS">Editar Cama</h5>
          <button type="button" class="btn btn-close btn-outline-danger" data-bs-dismiss="modal" aria-label="Close"></button>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <div class="modal-body">
          
          <div class="row">

            <div class="col-12">

              <!-- ENTRADA PARA EL NOMBRE DE LA CAMA -->
              <div class="form-group">
                <label for="editarNombreCama" class="form-label">NOMBRE CAMA</label>  
                <input type="text" class="form-control mayuscula" id="editarNombreCama" name="editarNombreCama">
              </div>

              <!-- ENTRADA PARA LA DESCRIPCION DE LA CAMA -->
              <div class="form-group">
                <label for="editarDescripcionCama" class="form-label">DESCRIPCION CAMA</label>  
                <input type="text" class="form-control mayuscula" id="editarDescripcionCama" name="editarDescripcionCama">
              </div>

              <!-- ENTRADA PARA SELECCIONAR SERVICIO -->
              <div class="form-group"> 

                <label for="editarServicioDS" class="form-label">SERVICIO</label> 
                <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                <select class="form-select" name="editarServicioDS" id="editarServicioDS" required>
                  <?php

                  $item = null;
                  $valor = null;

                  $servicios =  ControllerServicios::ctrMostrarServicios($item, $valor);

                  foreach($servicios as  $key => $value) {

                    echo '<option value="'.$value["id"].'">'.$value["nombre_servicio"].'</option>';

                  }
                  ?> 
                </select>
              </div> 

              <!-- ENTRADA PARA SELECCIONAR SALA -->
              <div class="form-group">

                <label for="editarSalaDS" class="form-label">SALA</label>
                <label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>
                <select class="form-select" name="editarSalaDS" id="editarSalaDS" required>
                  <option value="" disabled selected>ELEGIR...</option>
                </select>

              </div> 
              
            </div>

          </div>  

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        <div class="modal-footer">

          <button type="button" class="btn btn-round btn-danger float-left" data-bs-dismiss="modal" aria-label="Close">

            <i class="fas fa-times"></i>
            Cerrar

          </button>

          <button type="button" class="btn btn-round btn-primary btnGuardar">

            <i class="fas fa-save"></i>
            Guardar Cambios

          </button>

          <input type="hidden" id="idServicio" name="idServicio" value="<?= $parametros[1]; ?>">
          <input type="hidden" id="idSala" name="idSala" value="<?= $salas[0]['id'] ?>">
          <input type="hidden" id="editarIdCama" name="editarIdCama">

        </div>

      </form>

    </div>

  </div>

</div>
