/*=============================================
CARGAR LA TABLA DINÁMICA DE INGRESOS
=============================================*/
var id_paciente = $('#idPaciente').val();
var sexo = $('#sexoPaciente').val();

var tablaPacienteIngresos = $('#tblPacienteIngresos').DataTable({

  "ajax": {
    url: "../ajax/datatable-paciente_ingresos.ajax.php",
    data: { 'id_paciente' : id_paciente, 'sexo' : sexo },
    type: "post"
  },

  "destroy": true,

  "deferRender": true,

  "retrieve" : true,

  "processing" : true,

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

  "responsive": true,

  "lengthChange": false,

});


/*=============================================
VERIFICANDO QUE EL PACIENTE ESTE TODOS SUS INGRESOS CON ESTADO DE ALTA
=============================================*/
$(document).on("click", "#btnNuevoIngreso", function() {

  var id_paciente = $(this).attr("idPaciente");
  console.log("id_paciente", id_paciente);

  var datos = new FormData();
  datos.append("verificarPacienteIngresos", 'verificarPacienteIngresos');
  datos.append("id_paciente", id_paciente);

  $.ajax({

    url: "../ajax/paciente_ingresos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "html",
    success: function(respuesta) {

      console.log("respuesta", respuesta);

      if (respuesta == 'ok') {

        $('#modalNuevoPacienteIngreso').modal("show");

      } else {

        swal.fire({

          title: "¡No se puede registrar un nuevo Ingreso sin antes dar de Alta al Paciente!!!",
          icon: "error",
          allowOutsideClick: false,
          confirmButtonText: "¡Cerrar!"

        });

      }

    },
    error: function(error){

      console.log("No funciona");

    }

  });

});

/*=============================================
SI SE CAMBIA EL SERVICIO SE CARGAN LAS SALAS CORRESPONDIENTE AL SERVICO
=============================================*/
$(document).on("change", "#nuevoServicio", function() {

  var idServicio = $(this).val();
  console.log("idServicio", idServicio);  

  if(idServicio) {

    $("#nuevoEspecialidad").prop("disabled", false);
    $("#nuevoEspecialidad").empty();
    $("#nuevoEspecialidad").append('<option value="">ELEGIR...</option>');

    $("#nuevoSala").prop("disabled", false);
    $("#nuevoSala").empty();
    $("#nuevoSala").append('<option value="">ELEGIR...</option>');

    $("#nuevoCama").prop("disabled", true);
    $("#nuevoCama").empty();
    $("#nuevoCama").append('<option value="">ELEGIR...</option>');

  }

  var datos = new FormData();

  datos.append("mostrarServicioEspecialidades", 'mostrarServicioEspecialidades');
  datos.append("idServicio", idServicio);

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
        $("#nuevoEspecialidad").append('<option value="'+value.id+'">'+value.nombre_especialidad+'</option>')
        
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
        $("#nuevoSala").append('<option value="'+value.id+'">'+value.nombre_sala+'</option>')
        
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
$(document).on("change", "#nuevoSala", function() {

  var idSala = $(this).val(); 

  if(idSala) {

    $("#nuevoCama").prop("disabled", false);
    $("#nuevoCama").empty();
    $("#nuevoCama").append('<option value="">ELEGIR...</option>');

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
        $("#nuevoCama").append('<option value="'+value.id+'">'+value.nombre_cama+'</option>')
        
      });

    },
    error: function(error){

      console.log("No funciona");

    }

  });

});

/*======================================
INICIALIZANDO LOS FORMULARIOS SELECT2 PARA MEDICOS
========================================*/
$(document).ready(function(){

  $('#nuevoMedicoTratante').select2({

    theme: "bootstrap-5",
    placeholder: "ELEGIR...",
    allowClear: true,
    dropdownParent: $("#modalNuevoPacienteIngreso"),
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

  $('#editarMedicoTratante').select2({

    theme: "bootstrap-5",
    placeholder: "ELEGIR...",
    allowClear: true,
    dropdownParent: $("#modalEditarPacienteIngreso"),
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

/*======================================
INICIALIZANDO LOS FORMULARIOS SELECT2 PARA DIAGNOSTICO INGRESO
========================================*/
$(document).ready(function() {

  $("#nuevoDiagnosticoIngreso").select2({

    theme: "bootstrap-5",
    ajax: {
      // url: "https://api.github.com/search/repositories",
      url: "../ajax/cie10.ajax.php",
      // type: "post",
      dataType: 'json',
      delay: 250,
      data: function (params) {
        return {
          q: params.term, // search term
          page: params.page
        };
      },
      processResults: function (data, params) {
        // parse the results into the format expected by Select2
        // since we are using custom formatting functions we do not need to
        // alter the remote JSON data, except to indicate that infinite
        // scrolling can be used
        params.page = params.page || 1;

        return {
          results: data.items,
          pagination: {
            more: (params.page * 30) < data.total_count
          }
        };
      },
      cache: true
    },
    placeholder: 'BUSCAR UN DIAGNOSTICO...',
    allowClear: true,
    dropdownParent: $("#modalNuevoPacienteIngreso"),
    minimumInputLength: 3,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection,
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
    }
  });

  $("#editarDiagnosticoIngreso").select2({

    theme: "bootstrap-5",
    ajax: {
      // url: "https://api.github.com/search/repositories",
      url: "../ajax/cie10.ajax.php",
      dataType: 'json',
      delay: 250,
      data: function (params) {
        return {
          q: params.term, // search term
          page: params.page
        };
      },
      processResults: function (data, params) {
        // parse the results into the format expected by Select2
        // since we are using custom formatting functions we do not need to
        // alter the remote JSON data, except to indicate that infinite
        // scrolling can be used
        params.page = params.page || 1;

        return {
          results: data.items,
          pagination: {
            more: (params.page * 30) < data.total_count
          }
        };
      },
      cache: true
    },
    placeholder: 'BUSCAR UN DIAGNOSTICO...',
    allowClear: true,
    dropdownParent: $("#modalEditarPacienteIngreso"),
    minimumInputLength: 3,
    templateResult: formatRepo,
    templateSelection: formatRepoSelection,
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
    }
  });

  function formatRepo (repo) {
    if (repo.loading) {
      return repo.text;
    }

    var $container = $(
      "<div class='select2-result-repository clearfix'>" +
        "<div class='select2-result-repository__title'></div>" +
      "</div>"
      );

    $container.find(".select2-result-repository__title").text(repo.diagnostico);

    return $container;
  }

  function formatRepoSelection (repo) {
    return repo.diagnostico || repo.text;
  }

});

/*=============================================
CONFIGURACION DE LAS REGLAS Y MENSAJES PARA VALIDACION (NUEVO PACIENTE INGRESO)
=============================================*/
$(document).ready(function(){
  $("#frmNuevoPacienteIngreso").validate({

    rules: {

      nuevoDiagnostico1 : { patron_numerosTexto: true },
      nuevoDiagnostico2 : { patron_numerosTexto: true },
      nuevoDiagnostico3 : { patron_numerosTexto: true },

    },

    messages: {
      nuevoConsultorio : "Elija una Opción",
      nuevoMedicoTratante : "Elija un Médico",
      nuevoDiagnosticoIngreso : "Elija un Diagnostico CIE-10",
      nuevoEstablecimiento : "Elija un Establecimiento",
      nuevoServicio : "Elija un Servicio",
      nuevoEspecialidad : "Elija una Especialidad",
      nuevoSala : "Elija una Sala",
      nuevoCama : "Elija una Cama"
    },

  });

});

/*=============================================
GUARDANDO DATOS DE INGRESO DE PACIENTE
=============================================*/
$("#frmNuevoPacienteIngreso").on("click", ".btnGuardar", function() {

  if ($("#frmNuevoPacienteIngreso").valid()) {

    var datos = new FormData($("#frmNuevoPacienteIngreso")[0]);
    datos.append("nuevoPacienteIngreso", 'nuevoPacienteIngreso');

    $.ajax({

      url: "../ajax/paciente_ingresos.ajax.php",
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

              $('#modalNuevoPacienteIngreso').modal('toggle'); 
              
              $("#nuevoEstablecimiento").val(""); 

              $("#nuevoFechaIngreso").val("");

              $("#nuevoHoraIngreso").val("");

              $("#nuevoServicio").val("");

              $("#nuevoEspecialidad").prop("disabled", true);
              $("#nuevoEspecialidad").empty();
              $("#nuevoEspecialidad").append('<option value="">ELEGIR...</option>');

              $("#nuevoSala").prop("disabled", true);
              $("#nuevoSala").empty();
              $("#nuevoSala").append('<option value="">ELEGIR...</option>');

              $("#nuevoCama").prop("disabled", true);
              $("#nuevoCama").empty();
              $("#nuevoCama").append('<option value="">ELEGIR...</option>');

              $("#nuevoConsultorio").val("");

              $("#nuevoMedicoTratante").val("");

              $("#nuevoDiagnosticoIngreso").empty();
              $("#nuevoDiagnosticoIngreso").append('<option value="">BUSCAR UN DIAGNOSTICO...</option>');

              $("#nuevoDiagnostico1").val("");
              $("#nuevoDiagnostico2").val("");
              $("#nuevoDiagnostico3").val("");

              tablaPacienteIngresos.ajax.reload( null, false );

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

/*=============================================
CARGANDO DATOS DE PERSONA AL FORMULARIO EDITAR PACIENTE INGRESO
=============================================*/
$(document).on("click", ".btnEditarPacienteIngreso", function() {

  console.log("EDITAR INGRESO");

  $("#editarEspecialidad").empty();
  $("#editarSala").empty();
  $("#editarCama").empty();

  var id = $(this).attr("idPacienteIngreso");
  console.log("id", id);

  var datos = new FormData();
  datos.append("mostrarPacienteIngreso", 'mostrarPacienteIngreso');
  datos.append("id", id);

  $.ajax({

    url: "../ajax/paciente_ingresos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {
      console.log("respuesta", respuesta);

      $('#editarConsultorio').val(respuesta["id_consultorio"]);
      
      var $newOption = $("<option selected='selected'></option>").val(respuesta["id_medico"]).text(respuesta["medico_tratante"])
      $("#editarMedicoTratante").append($newOption).trigger('change');

      var $newOption = $("<option selected='selected'></option>").val(respuesta["id_cie10"]).text(respuesta["diagnostico"])
      $("#editarDiagnosticoIngreso").append($newOption).trigger('change');

      $('#editarDiagnostico1').val(respuesta["diagnostico_especifico1"]);
      $('#editarDiagnostico2').val(respuesta["diagnostico_especifico2"]);
      $('#editarDiagnostico3').val(respuesta["diagnostico_especifico3"]);
      
      $('#editarEstablecimiento').val(respuesta["id_establecimiento"]);
      $('#editarFechaIngreso').val(respuesta["fecha_ingreso"]);
      $('#editarHoraIngreso').val(respuesta["hora_ingreso"]);
      $('#editarServicio').val(respuesta["id_servicio"]);

      $("#editarEspecialidad").append('<option value="'+respuesta["id_especialidad"]+'">'+respuesta["nombre_especialidad"]+'</option>');

      $("#transferencia").val(respuesta["transferencia"]);

      var datosEspecialidad = new FormData();
      datosEspecialidad.append("mostrarServicioEspecialidades", 'mostrarServicioEspecialidades');
      datosEspecialidad.append("idServicio", respuesta["id_servicio"]);

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

            if (val.id != respuesta2["id_especialidad"]) {

              $("#editarEspecialidad").append('<option value="'+val.id+'">'+val.nombre_especialidad+'</option>');

            }

          });

        },
        error: function(error) {

          console.log("No funciona");
            
        }

      });
      
      $("#editarSala").append('<option value="'+respuesta["id_sala"]+'">'+respuesta["nombre_sala"]+'</option>');

      var datosSala = new FormData();
      datosSala.append("mostrarServicioSalas", 'mostrarServicioSalas');
      datosSala.append("idServicio", respuesta["id_servicio"]);

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

            if (val.id != respuesta3["id_sala"]) {

              $("#editarSala").append('<option value="'+val.id+'">'+val.nombre_sala+'</option>');

            }

          });

        },
        error: function(error) {

          console.log("No funciona");
            
        }

      });

      $("#editarCama").append('<option value="'+respuesta["id_cama"]+'">'+respuesta["nombre_cama"]+'</option>');

      var datosCama = new FormData();
      datosCama.append("mostrarSalaCamas", 'mostrarSalaCamas');
      datosCama.append("idSala", respuesta["id_sala"]);

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

            if (val.id != respuesta4["id_cama"]) {

              $("#editarCama").append('<option value="'+val.id+'">'+val.nombre_cama+'</option>');

            }

          });

        },
        error: function(error) {

          console.log("No funciona");
            
        }

      });

      $("#editarCamaAnt").val(respuesta["id_cama"]);

      $('#editarIdIngresoPaciente').val(respuesta["id"]);

    },
    error: function(error){

      console.log("No funciona");
        
    }

  });

});

/*=============================================
SI SE CAMBIA EL SERVICIO SE CARGAN LAS SALAS CORRESPONDIENTE AL SERVICIO (EDITAR)
=============================================*/
$(document).on("change", "#editarServicio", function() {

  var idServicio = $(this).val();
  console.log("idServicio", idServicio);  

  if(idServicio) {

    $("#editarEspecialidad").prop("disabled", false);
    $("#editarEspecialidad").empty();
    $("#editarEspecialidad").append('<option value="">ELEGIR...</option>');

    $("#editarSala").prop("disabled", false);
    $("#editarSala").empty();
    $("#editarSala").append('<option value="">ELEGIR...</option>');

    $("#editarCama").prop("disabled", true);
    $("#editarCama").empty();
    $("#editarCama").append('<option value="">ELEGIR...</option>');

  }

  var datos = new FormData();

  datos.append("mostrarServicioEspecialidades", 'mostrarServicioEspecialidades');
  datos.append("idServicio", idServicio);

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
        $("#editarEspecialidad").append('<option value="'+value.id+'">'+value.nombre_especialidad+'</option>')
        
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
        $("#editarSala").append('<option value="'+value.id+'">'+value.nombre_sala+'</option>')
        
      });

    },
    error: function(error){

      console.log("No funciona");

    }

  });

});

/*=============================================
SI SE CAMBIA LA SALA SE CARGAN LAS CAMAS CORRESPONDIENTE A LA SALA SELECCIONADA (EDITAR)
=============================================*/
$(document).on("change", "#editarSala", function() {

  var idSala = $(this).val(); 

  if(idSala) {

    $("#editarCama").prop("disabled", false);
    $("#editarCama").empty();
    $("#editarCama").append('<option value="">ELEGIR...</option>');

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
        $("#editarCama").append('<option value="'+value.id+'">'+value.nombre_cama+'</option>')
        
      });

    },
    error: function(error){

      console.log("No funciona");

    }

  });

});

/*=============================================
CONFIGURACION DE LAS REGLAS Y MENSAJES PARA VALIDACION (EDITAR PACIENTE INGRESO)
=============================================*/
$(document).ready(function(){
  $("#frmEditarPacienteIngreso").validate({

    rules: {

      editarDiagnostico1 : { patron_numerosTexto: true },
      editarDiagnostico2 : { patron_numerosTexto: true },
      editarDiagnostico3 : { patron_numerosTexto: true },

    },

    messages: {
      editarConsultorio : "Elija una Opción",
      editarMedicoTratante : "Elija un Médico",
      editarDiagnosticoIngreso : "Elija un Diagnostico CIE-10",
      editarEstablecimiento : "Elija un Establecimiento",
      editarServicio : "Elija un Servicio",
      editarEspecialidad : "Elija una Especialidad",
      editarSala : "Elija una Sala",
      editarCama : "Elija una Cama"
    },

  });

});

/*=============================================
GUARDANDO DATOS EDITAR INGRESO DE PACIENTE
=============================================*/
$("#frmEditarPacienteIngreso").on("click", ".btnGuardar", function() {

  if ($("#frmEditarPacienteIngreso").valid()) {

    var datos = new FormData($("#frmEditarPacienteIngreso")[0]);
    datos.append("editarPacienteIngreso", 'editarPacienteIngreso');

    $.ajax({

      url: "../ajax/paciente_ingresos.ajax.php",
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

              $("#editarConsultorio").val(""); 

              $("#editarMedicoTratante").empty();
              $("#editarMedicoTratante").append('<option value="">ELEGIR...</option>');

              $("#editarDiagnosticoIngreso").empty();
              $("#editarDiagnosticoIngreso").append('<option value="">BUSCAR UN DIAGNOSTICO...</option>');            

              $('#modalEditarPacienteIngreso').modal('toggle'); 
              
              $("#editarEstablecimiento").val(""); 

              $("#editarFechaIngreso").val("");

              $("#editarHoraIngreso").val("");

              $("#editarServicio").val("");

              $("#editarEspecialidad").prop("disabled", true);
              $("#editarEspecialidad").empty();
              $("#editarEspecialidad").append('<option value="">ELEGIR...</option>');

              $("#editarSala").prop("disabled", true);
              $("#editarSala").empty();
              $("#editarSala").append('<option value="">ELEGIR...</option>');

              $("#editarCama").prop("disabled", true);
              $("#editarCama").empty();
              $("#editarCama").append('<option value="">ELEGIR...</option>');

              $("#editarDiagnosticoIngreso").empty();
              $("#editarDiagnosticoIngreso").append('<option value="">BUSCAR UN DIAGNOSTICO...</option>');            

              tablaPacienteIngresos.ajax.reload( null, false );

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

/*=============================================
VENTANA MODAL PARA VER REPORTE FORMULARIO 204
=============================================*/
$(document).on("click", ".btnReporteForm204", function() {

  var idPaciente = $(this).attr("idPaciente");

  var idPacienteIngreso = $(this).attr("idPacienteIngreso");

  var modulo = $(this).attr("modulo");

  if (modulo == 'detalle-paciente') {
    dirPacienteIngresos = "../ajax/paciente_ingresos.ajax.php";
    dirTempPDF = "../temp/form204-"+idPacienteIngreso+".pdf";
  } else if (modulo == 'paciente-ingresos') {
    dirPacienteIngresos = "ajax/paciente_ingresos.ajax.php";
    dirTempPDF = "temp/form204-"+idPacienteIngreso+".pdf";
  }

  var datos = new FormData();
  datos.append("reporteForm204", 'reporteForm204');
  datos.append("idPaciente", idPaciente);
  datos.append("idPacienteIngreso", idPacienteIngreso);

  $.ajax({

    url: dirPacienteIngresos,
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success : function(respuesta){

      $('#ver-pdf').modal("show");
      PDFObject.embed(dirTempPDF, "#view_pdf_frm204");

    },
    error: function(error) {

      console.log("No funciona");
          
    }

  });

});

/*=============================================
BOTON QUE PARA CERRAR LA VENTANA MODAL DEL REPORTE PDF Y ELIMINA EL ARCHIVO TEMPORAL
=============================================*/
$("#ver-pdf").on("click", ".btnCerrarReporte", function() {

  var url = $(this).parent().parent().children(".modal-body").children().children().attr("src");
  // console.log("url", url);

  var modulo = $("#modulo").val();
  // console.log("modulo", modulo);

  if (modulo == 'detalle-paciente') {
    dirPacienteIngresos = "../ajax/paciente_ingresos.ajax.php";
  } else if (modulo == 'paciente-ingresos') {
    dirPacienteIngresos = "ajax/paciente_ingresos.ajax.php";
    url = '../'+url;
  }

  var datos = new FormData();

  datos.append("eliminarPDF", "eliminarPDF");
  datos.append("url", url);

  $.ajax({

    url: dirPacienteIngresos,
    type: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function(respuesta) {
    
    }

  });

});