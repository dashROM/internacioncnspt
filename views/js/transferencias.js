/*======================================
INICIALIZANDO LOS FORMULARIOS SELECT2 PARA MEDICOS
========================================*/
$(document).ready(function(){

  $('#nuevoMedicoSolicitanteTrans').select2({

    theme: "bootstrap-5",
    placeholder: "ELEGIR...",
    allowClear: true,
    dropdownParent: $("#modalNuevaTransferencia"),
    language: {
      noResults: function() {
        return "No hay resultado";   
      },
      searching: function() {
        return "Buscando...";
      },
      inputTooShort: function () {
        return "Debe introducir 3 o más caracteres";
      }
    },
  });

  $('#editarMedicoSolicitanteTrans').select2({

    theme: "bootstrap-5",
    placeholder: "ELEGIR...",
    allowClear: true,
    dropdownParent: $("#modalEditarTransferencia"),
    language: {
      noResults: function() {
        return "No hay resultado";   
      },
      searching: function() {
        return "Buscando...";
      },
      inputTooShort: function () {
        return "Debe introducir 3 o más caracteres";
      }
    },
  });

});

/*=============================================
PASAR PARAMETROS A VENTANA MODAL TRANFERENCIA PACIENTE
=============================================*/
$(document).on("click", ".btnNuevaTransferencia", function() {

  // tablaPacienteTransferencias.destroy(); 

  $("#nuevoServicioTrans").empty();
  $("#nuevoServicioTrans").append('<option value="">ELEGIR...</option>');

  $("#fechaIngresoTrans").empty();
  $("#horaIngresoTrans").empty();
  $("#diagnosticoIngresoTrans").empty();
  $("#diagnosticosEspecificosTrans").empty();
  $("#servicioIngresoTrans").empty();
  $("#salaIngresoTrans").empty();
  $("#camaIngresoTrans").empty();

  $("#transferenciasTrans").empty();

  $("#idPacienteIngresoTrans").val($(this).attr("idPacienteIngreso"));

  //pasar fecha de ingreso a formulario de transferencia de paciente para control
  $("#nuevoFechaTrans").attr("min", $(this).attr("fechaIngreso"));
  $("#ctrFechaIngresoTrans").val($(this).attr("fechaIngreso"));

  $("#idServicioAnt").val($(this).attr("idServicio"));
  $("#idEspecialidadAnt").val($(this).attr("idEspecialidad"));
  $("#idSalaAnt").val($(this).attr("idSala"));
  $("#idCamaAnt").val($(this).attr("idCama"));

  //para obtener los datos de servicio
  var datos = new FormData();

  datos.append("mostrarServicios", 'mostrarServicios');
  // datos.append("idServicio", $(this).attr("idServicio"));

  $.ajax({

    url: "../ajax/servicios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {

      $.each(respuesta, function(key,value){
        $("#nuevoServicioTrans").append('<option value="'+value.id+'">'+value.nombre_servicio+'</option>')
        
      });

    },
    error: function(error){

      console.log("No funciona");

    }

  });

  //para obtner los datos de paciente ingreso
  var datos2 = new FormData();
  datos2.append("mostrarPacienteIngreso", 'mostrarPacienteIngreso');
  datos2.append("id", $(this).attr("idPacienteIngreso"));

  $.ajax({

    url: "../ajax/paciente_ingresos.ajax.php",
    method: "POST",
    data: datos2,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {

      var date = new Date(respuesta['fecha_ingreso']);
      date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
      
      $("#fechaIngresoTrans").append(moment(date).format("DD/MM/YYYY"));
      $("#horaIngresoTrans").append(respuesta['hora_ingreso']);
      $("#diagnosticoIngresoTrans").append(respuesta['diagnostico']);
      $("#diagnosticosEspecificosTrans").append(respuesta['diagnostico_especifico1']+' - '+respuesta['diagnostico_especifico2']+' - '+respuesta['diagnostico_especifico3']);
      $("#servicioIngresoTrans").append(respuesta['nombre_servicio']+' - '+respuesta['nombre_especialidad']);
      $("#salaIngresoTrans").append(respuesta['nombre_sala']);
      $("#camaIngresoTrans").append(respuesta['nombre_cama']);

    },
    error: function(error) {

      console.log("No funciona");

    }

  });

  //para obtener los datos de transferencias
  var datos3 = new FormData();
  datos3.append("mostrarPacienteTransferencias", 'mostrarPacienteTransferencias');
  datos3.append("id", $(this).attr("idPacienteIngreso"));

  $.ajax({

    url: "../ajax/transferencias.ajax.php",
    method: "POST",
    data: datos3,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {
      console.log("respuesta", respuesta);

      var i = -1;

      $.each(respuesta, function(key,value) {

        i = i + 1;

      //   var date = new Date(value.fecha_transferencia);
      //   date.setMinutes(date.getMinutes() + date.getTimezoneOffset())

      //   $("#transferenciasTrans").append(

      //     '<tr>'+

      //       '<td><button  class="btn btn-outline-primary btn-sm btnEditarTransferencia" id='+value.id+' data-bs-toggle="modal" data-bs-target="#modalEditarTransferencia" data-toggle="tooltip" title="Editar Transferencia"><i class="fas fa-pencil-alt"></i></button></td>'+
      //       '<td>'+moment(date).format("DD/MM/YYYY")+'</td>'+
      //       '<td>'+value.servicio_ini+'</td>'+
      //       '<td>'+value.servicio_fin+'</td>'+ 
      //       '<td>'+value.diagnostico_transferencia+'</td>'+ 

      //     '</tr>'

      //   );
        
      });

      //pasar fecha de ultima transferencia a formulario de transferencia paciente para control
      $("#nuevoFechaTrans").attr("min", respuesta[i]["fecha_transferencia"]);

      //pasar ultimo ID transferencia a formulario de transferencia paciente para control
      $("#ultimoIDTransferencia").val(respuesta[i]["id"]);

    },
    error: function(error) {

      console.log("No funciona");

    }

  });

  tablaPacienteTransferencias = $('#tblPacienteTransferencias').DataTable({

    "ajax": {
      url: "../ajax/datatable-transferencias.ajax.php",
      data: { 'id' : $(this).attr("idPacienteIngreso"), 'mostrarPacienteTransferencias' : 'mostrarPacienteTransferencias' },
      type: "post"
    },

    "destroy": true,

    "deferRender": true,

    "retrieve" : true,

    "language": {

      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      },
      "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad de columnas"
      }

    },

    "responsive": false,

    "lengthChange": false,

    "searching": false,

    "paging": false,

    "info": false,

    "ordering": false

  });

});

/*=============================================
SI SE CAMBIA EL SERVICIO SE CARGAN LAS SALAS CORRESPONDIENTE AL SERVICIO
=============================================*/
$(document).on("change", "#nuevoServicioTrans", function() {

  var idServicio = $(this).val();
  console.log("idServicio", idServicio);
  var idEspecialidad = $("#idEspecialidadAnt").val();
  console.log("idEspecialidad", idEspecialidad);

  if(idServicio) {

    $("#nuevoEspecialidadTrans").prop("disabled", false);
    $("#nuevoEspecialidadTrans").empty();
    $("#nuevoEspecialidadTrans").append('<option value="">ELEGIR...</option>');

    $("#nuevoSalaTrans").prop("disabled", false);
    $("#nuevoSalaTrans").empty();
    $("#nuevoSalaTrans").append('<option value="">ELEGIR...</option>');

    $("#nuevoCamaTrans").prop("disabled", true);
    $("#nuevoCamaTrans").empty();
    $("#nuevoCamaTrans").append('<option value="">ELEGIR...</option>');

  }

  var datos = new FormData();

  datos.append("mostrarServicioEspecialidades", 'mostrarServicioEspecialidades');
  datos.append("idServicio", idServicio);
  datos.append("idEspecialidad", idEspecialidad);

  $.ajax({

    url: "../ajax/especialidades.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {

      $.each(respuesta, function(key,value){
        $("#nuevoEspecialidadTrans").append('<option value="'+value.id+'">'+value.nombre_especialidad+'</option>')
        
      });

    },
    error: function(error){

      console.log("No funciona");

    }

  });

  var datos2 = new FormData();

  datos2.append("mostrarServicioSalas", 'mostrarServicioSalas');
  datos2.append("idServicio", idServicio);

  $.ajax({

    url: "../ajax/salas.ajax.php",
    method: "POST",
    data: datos2,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {

      $.each(respuesta, function(key,value){
        $("#nuevoSalaTrans").append('<option value="'+value.id+'">'+value.nombre_sala+'</option>')
        
      });

    },
    error: function(error){

      console.log("No funciona");

    }

  });

});

/*=============================================
SI SE CAMBIA LA SALA SE CARGAN LAS CAMAS CORRESPONDIENTE A LA SALA SELECCIONADA
=============================================*/
$(document).on("change", "#nuevoSalaTrans", function() {

  var idSala = $(this).val(); 

  if(idSala) {

    $("#nuevoCamaTrans").prop("disabled", false);
    $("#nuevoCamaTrans").empty();
    $("#nuevoCamaTrans").append('<option value="">ELEGIR...</option>');

  }

  var datos = new FormData();

  datos.append("mostrarSalaCamas", 'mostrarSalaCamas');
  datos.append("idSala", idSala);

  $.ajax({

    url: "../ajax/camas.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {

      $.each(respuesta, function(key,value){
        $("#nuevoCamaTrans").append('<option value="'+value.id+'">'+value.nombre_cama+'</option>')
        
      });

    },
    error: function(error){

      console.log("No funciona");

    }

  });

});

/*=============================================
CONFIGURACION DE LAS REGLAS Y MENSAJES PARA VALIDACION (REGISTRAR TRANSFERENCIAS)
=============================================*/
$(document).ready(function(){
  $("#frmNuevaTrasferencia").validate({

    rules: {

      nuevoDiagnosticoTrans1 : { patron_numerosTexto : true },
      nuevoDiagnosticoTrans2 : { patron_numerosTexto : true },
      nuevoDiagnosticoTrans3 : { patron_numerosTexto : true },      

    },

    messages: {
      nuevoMedicoSolicitanteTrans : "Elija un Médico",
      nuevoServicioTrans : "Elija un Servicio",
      nuevoEspecialidadTrans : "Elija una Especialidad",
      nuevoSalaTrans : "Elija una Sala",
      nuevoCamaTrans : "Elija una Cama",
      nuevoFechaTrans: {
        required: "Ingrese una fecha de transferencia",
        min: function (p, element) {
            return "Debe ser una fecha mayor o igual a " + formatoFecha(p);
        }
      }
    },

  });

});

/*=============================================
GUARDANDO DATOS TRANSFERENCIA PACIENTE
=============================================*/
$("#frmNuevaTrasferencia").on("click", ".btnGuardar", function() {

  if ($("#frmNuevaTrasferencia").valid()) {

    var datos = new FormData($("#frmNuevaTrasferencia")[0]);
    datos.append("nuevoTransferencia", 'nuevoTransferencia');

    $.ajax({

      url: "../ajax/transferencias.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta) {

        console.log("respuesta", respuesta);

        if (respuesta == "ok") {

          swal.fire({

            icon: "success",
            title: "¡Los datos se guardaron correctamente!",
            showConfirmButton: true,
            allowOutsideClick: false,
            confirmButtonText: "Cerrar"

          }).then((result) => {

            if (result.value) {

              $('#modalNuevaTransferencia').modal('toggle'); 

              $("#nuevoFechaTrans").val("");

              $("#nuevoServicioTrans").val("");

              $("#nuevoEspecialidadTrans").val("");
              
              $("#nuevoSalaTrans").val("");

              $("#nuevoCamaTrans").val("");

              $("#nuevoDiagosticoTrans1").val("");

              $("#nuevoDiagosticoTrans2").val("");

              $("#nuevoDiagosticoTrans3").val("");

              $("#nuevoMedicoSolicitanteTrans").val("");            

              $("#nuevoIdPacienteIngreso").val(""); 

              $("#idIngresoPaciente").val("");                 

              // Funcion que recarga y actuaiiza la tabla
              tablaPacienteIngresos.ajax.reload( null, false );

            }

          });

        } else {

          swal.fire({

            title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales no da!",
            icon: "error",
            allowOutsideClick: false,
            confirmButtonText: "¡Cerrar!"

          });
          
        }

      },
      error: function(error) {

        console.log("No funciona");

      }

    });

  } else {

   swal.fire({

     title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
     icon: "error",
     allowOutsideClick: false,
     confirmButtonText: "¡Cerrar!"

   });

  } 

});

/*=============================================
CARGANDO DATOS DE TRANSFERENCIA AL FORMULARIO EDITAR TRANSFERENCIA
=============================================*/
$(document).on("click", ".btnEditarTransferencia", function() {

  var id = $(this).attr("id");
  console.log("id", id);

  var datos = new FormData();
  datos.append("mostrarTransferencia", 'mostrarTransferencia');
  datos.append("id", id);

  $.ajax({

    url: "../ajax/transferencias.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {

      console.log("respuesta", respuesta);

      // var date = new Date(respuesta["fecha_nacimiento"]);
      // date.setMinutes(date.getMinutes() + date.getTimezoneOffset())

      $('#idTransferencia').val(respuesta["id"]);
      $('#editarFechaTrans').val(respuesta["fecha_transferencia"]);

      var $newOption = $("<option selected='selected'></option>").val(respuesta["id_medico"]).text(respuesta["medico_tratante"])
      $("#editarMedicoSolicitanteTrans").append($newOption).trigger('change');

      $('#editarDiagnosticoTrans1').val(respuesta["diagnostico_trans1"]);
      $('#editarDiagnosticoTrans2').val(respuesta["diagnostico_trans2"]);
      $('#editarDiagnosticoTrans3').val(respuesta["diagnostico_trans3"]);
     
      $('#editarServicioTrans').val(respuesta["id_servicio_trans"]);

      $("#editarEspecialidadTrans").append('<option value="'+respuesta["id_especialidad_trans"]+'">'+respuesta["nombre_especialidad"]+'</option>');

      var datosEspecialidad = new FormData();
      datosEspecialidad.append("mostrarServicioEspecialidades", 'mostrarServicioEspecialidades');
      datosEspecialidad.append("idServicio", respuesta["id_servicio_trans"]);

      $.ajax({

        url: "../ajax/especialidades.ajax.php",
        method: "POST",
        data: datosEspecialidad,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta2) {
          console.log("respuesta2", respuesta2);

          $.each(respuesta2, function(index, val) {

            if (val.id != respuesta2["id_especialidad_trans"]) {

              $("#editarEspecialidadTrans").append('<option value="'+val.id+'">'+val.nombre_especialidad+'</option>');

            }

          });

        },
        error: function(error) {

          console.log("No funciona");
            
        }

      });
      
      $("#editarSalaTrans").append('<option value="'+respuesta["id_sala_trans"]+'">'+respuesta["nombre_sala"]+'</option>');

      var datosSala = new FormData();
      datosSala.append("mostrarServicioSalas", 'mostrarServicioSalas');
      datosSala.append("idServicio", respuesta["id_servicio_trans"]);

      $.ajax({

        url: "../ajax/salas.ajax.php",
        method: "POST",
        data: datosSala,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta3) {

          $.each(respuesta3, function(index, val) {

            if (val.id != respuesta3["id_sala_trans"]) {

              $("#editarSalaTrans").append('<option value="'+val.id+'">'+val.nombre_sala+'</option>');

            }

          });

        },
        error: function(error) {

          console.log("No funciona");
            
        }

      });

      $("#editarCamaTrans").append('<option value="'+respuesta["id_cama_trans"]+'">'+respuesta["nombre_cama"]+'</option>');
      $("#editarIDCamaAnt").val(respuesta["id_cama_trans"]);
      $("#editarIDPacienteIngresoTrans").val(respuesta["id_paciente_ingreso"]);

      var datosCama = new FormData();
      datosCama.append("mostrarSalaCamas", 'mostrarSalaCamas');
      datosCama.append("idSala", respuesta["id_sala_trans"]);

      $.ajax({

        url: "../ajax/camas.ajax.php",
        method: "POST",
        data: datosCama,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta4) {

          $.each(respuesta4, function(index, val) {

            if (val.id != respuesta4["id_cama_trans"]) {

              $("#editarCamaTrans").append('<option value="'+val.id+'">'+val.nombre_cama+'</option>');

            }

          });

        },
        error: function(error) {

          console.log("No funciona");
            
        }

      });

    },
    error: function(error) {

      console.log("No funciona");

    }

  });

});

/*=============================================
SI SE CAMBIA EL SERVICIO SE CARGAN LAS SALAS CORRESPONDIENTE AL SERVICIO (EDITAR TRANSFERENCIA)
=============================================*/
$(document).on("change", "#editarServicioTrans", function() {

  var idServicio = $(this).val();
  console.log("idServicio", idServicio);
  var idEspecialidad = $("#idEspecialidadAnt").val();
  console.log("idEspecialidad", idEspecialidad);

  if(idServicio) {

    $("#editarEspecialidadTrans").prop("disabled", false);
    $("#editarEspecialidadTrans").empty();
    $("#editarEspecialidadTrans").append('<option value="">ELEGIR...</option>');

    $("#editarSalaTrans").prop("disabled", false);
    $("#editarSalaTrans").empty();
    $("#editarSalaTrans").append('<option value="">ELEGIR...</option>');

    $("#editarCamaTrans").prop("disabled", true);
    $("#editarCamaTrans").empty();
    $("#editarCamaTrans").append('<option value="">ELEGIR...</option>');

  }

  var datos = new FormData();

  datos.append("mostrarServicioEspecialidades", 'mostrarServicioEspecialidades');
  datos.append("idServicio", idServicio);
  datos.append("idEspecialidad", idEspecialidad);

  $.ajax({

    url: "../ajax/especialidades.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {

      $.each(respuesta, function(key,value){
        $("#editarEspecialidadTrans").append('<option value="'+value.id+'">'+value.nombre_especialidad+'</option>')
        
      });

    },
    error: function(error){

      console.log("No funciona");

    }

  });

  var datos2 = new FormData();

  datos2.append("mostrarServicioSalas", 'mostrarServicioSalas');
  datos2.append("idServicio", idServicio);

  $.ajax({

    url: "../ajax/salas.ajax.php",
    method: "POST",
    data: datos2,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {

      $.each(respuesta, function(key,value){
        $("#editarSalaTrans").append('<option value="'+value.id+'">'+value.nombre_sala+'</option>')
        
      });

    },
    error: function(error){

      console.log("No funciona");

    }

  });

});

/*=============================================
SI SE CAMBIA LA SALA SE CARGAN LAS CAMAS CORRESPONDIENTE A LA SALA SELECCIONADA
=============================================*/
$(document).on("change", "#editarSalaTrans", function() {

  var idSala = $(this).val(); 

  if(idSala) {

    $("#editarCamaTrans").prop("disabled", false);
    $("#editarCamaTrans").empty();
    $("#editarCamaTrans").append('<option value="">ELEGIR...</option>');

  }

  var datos = new FormData();

  datos.append("mostrarSalaCamas", 'mostrarSalaCamas');
  datos.append("idSala", idSala);

  $.ajax({

    url: "../ajax/camas.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {

      $.each(respuesta, function(key,value){
        $("#editarCamaTrans").append('<option value="'+value.id+'">'+value.nombre_cama+'</option>')
        
      });

    },
    error: function(error){

      console.log("No funciona");

    }

  });

});

/*=============================================
CONFIGURACION DE LAS REGLAS Y MENSAJES PARA VALIDACION (REGISTRAR TRANSFERENCIAS)
=============================================*/
$(document).ready(function(){
  $("#frmEditarTrasferencia").validate({

    rules: {

      editarDiagnosticoTrans1 : { patron_numerosTexto : true },
      editarDiagnosticoTrans2 : { patron_numerosTexto : true },
      editarDiagnosticoTrans3 : { patron_numerosTexto : true },      

    },

    messages: {
      editarMedicoSolicitanteTrans : "Elija un Médico",
      editarServicioTrans : "Elija un Servicio",
      editarEspecialidadTrans : "Elija una Especialidad",
      editarSalaTrans : "Elija una Sala",
      editarCamaTrans : "Elija una Cama",
      editarFechaTrans: {
        required: "Ingrese una fecha de transferencia",
        min: function (p, element) {
            return "Debe ser una fecha mayor o igual a " + formatoFecha(p);
        }
      }
    },

  });

});

/*=============================================
GUARDANDO DATOS EDITAR TRANSFERENCIA DE PACIENTE
=============================================*/
$("#frmEditarTrasferencia").on("click", ".btnGuardar", function() {

  if ($("#frmEditarTrasferencia").valid()) {

    var datos = new FormData($("#frmEditarTrasferencia")[0]);
    datos.append("editarTransferencia", 'editarTransferencia');

    $.ajax({

      url: "../ajax/transferencias.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta) {

        console.log("respuesta", respuesta);

        if (respuesta == "ok") {

          swal.fire({

            icon: "success",
            title: "¡Los datos se guardaron correctamente!",
            showConfirmButton: true,
            allowOutsideClick: false,
            confirmButtonText: "Cerrar"

          }).then((result) => {

            if (result.value) {

              $("#editarFechaTrans").val(""); 

              $("#editarMedicoSolicitanteTrans").empty();
              $("#editarMedicoSolicitanteTrans").append('<option value="">ELEGIR...</option>'); 
              
              $("#editarDiagnosticoTrans1").val(""); 

              $("#editarDiagnosticoTrans2").val("");

              $("#editarDiagnosticoTrans3").val("");

              $("#editarServicioTrans").val("");

              $("#editarEspecialidadTrans").empty();

              $("#editarSalaTrans").empty();

              $("#editarCamaTrans").empty();

              $('#modalEditarTransferencia').modal('toggle');
              $('#modalNuevaTransferencia').modal('show');       

              tablaPacienteTransferencias.ajax.reload( null, false );

            }

          });

        } else {

          swal.fire({

            title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
            icon: "error",
            allowOutsideClick: false,
            confirmButtonText: "¡Cerrar!"

          });
          
        }

      },
      error: function(error) {

        console.log("No funciona");

      }

    });

  } else {

   swal.fire({

     title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
     icon: "error",
     allowOutsideClick: false,
     confirmButtonText: "¡Cerrar!"

   });

  } 

});