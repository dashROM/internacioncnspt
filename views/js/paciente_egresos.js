var tablaPacientesEgresos = $('#tblPacientesEgresos').DataTable({

  "ajax": {
    url: "ajax/datatable-paciente_egresos.ajax.php",
    data: { 'pacientesEgresados' : 'pacientesEgresados' },
    type: "post"
  },

  "destroy": true,

  "deferRender": true,

  "retrieve": true,

  "processing": true,

  "serverSide": true,

  "order": [[ 4, "desc" ]],

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
PASAR PARAMETROS A VENTANA MODAL DAR ALTA PACIENTE
=============================================*/
$(document).on("click", ".btnDarAltaPaciente", function() {

  $("#fechaIngreso").empty();
  $("#horaIngreso").empty();
  $("#diagnosticoIngreso").empty();
  $("#diagnosticosEspecificos").empty();
  $("#servicioIngreso").empty();
  $("#salaIngreso").empty();
  $("#camaIngreso").empty();

  $("#transferencias").empty();

	var idPacienteIngreso = $(this).attr("idPacienteIngreso");
	var fecha_ingreso = $(this).attr("fecha_ingreso");
  var idCama = $(this).attr("idCama");
  var modulo = $(this).attr("modulo");

  //pasar idPacienteIngreso a formulario de egreso paciente para control
	$("#nuevoIdPacienteIngreso").val(idPacienteIngreso);

	//pasar fecha de ingreso a formulario de egreso paciente para control
	$("#nuevoFechaEgreso").attr("min", fecha_ingreso);

  //pasar idCama a formulario de egreso paciente para actualizacion de Estado
  $("#nuevoIdCama").val(idCama);

  if (modulo == 'detalle-paciente') {
    dirPacienteIngresos = "../ajax/paciente_ingresos.ajax.php";
    dirTransferencias = "../ajax/transferencias.ajax.php";
    dirCie10 = "../ajax/cie10.ajax.php";
  } else if (modulo == 'paciente-ingresos') {
    dirPacienteIngresos = "ajax/paciente_ingresos.ajax.php";
    dirTransferencias = "ajax/transferencias.ajax.php";
    dirCie10 = "ajax/cie10.ajax.php";
  }

  // INICIALIZANDO LOS FORMULARIOS SELECT2 PARA DIAGNOSTICO EGRESO
  $("#nuevoDiagnosticoEgreso").select2({

    theme: "bootstrap-5",
    ajax: {

      url: dirCie10,
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
    dropdownParent: $("#modalDarAltaPaciente"),
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

  //para obtener los datos de paciente ingreso
  var datos = new FormData();
  datos.append("mostrarPacienteIngreso", 'mostrarPacienteIngreso');
  datos.append("id", idPacienteIngreso);

  $.ajax({

    url: dirPacienteIngresos,
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {

      var date = new Date(respuesta['fecha_ingreso']);
      date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
      
      $("#fechaIngreso").append(moment(date).format("DD/MM/YYYY"));
      $("#horaIngreso").append(respuesta['hora_ingreso']);
      $("#diagnosticoIngreso").append(respuesta['diagnostico']);
      $("#diagnosticosEspecificos").append(respuesta['diagnostico_especifico1']+' - '+respuesta['diagnostico_especifico2']+' - '+respuesta['diagnostico_especifico3']);
      $("#servicioIngreso").append(respuesta['nombre_servicio']+' - '+respuesta['nombre_especialidad']);
      $("#salaIngreso").append(respuesta['nombre_sala']);
      $("#camaIngreso").append(respuesta['nombre_cama']);

    },
    error: function(error) {

      console.log("No funciona");

    }

  });

  //para obtener los datos de transferencias
  var datos2 = new FormData();
  datos2.append("mostrarPacienteTransferencias", 'mostrarPacienteTransferencias');
  datos2.append("id", idPacienteIngreso);

  $.ajax({

    url: dirTransferencias,
    method: "POST",
    data: datos2,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {
      console.log("respuesta", respuesta);

      var i = -1;

      $.each(respuesta, function(key,value) {

        i = i + 1;

        var date = new Date(value.fecha_transferencia);
        date.setMinutes(date.getMinutes() + date.getTimezoneOffset())

        $("#transferencias").append(

          '<tr>'+

            '<td>'+moment(date).format("DD/MM/YYYY")+'</td>'+
            '<td>'+value.servicio_ini+'</td>'+
            '<td>'+value.servicio_fin+'</td>'+
            '<td>'+value.diagnostico_transferencia+'</td>'+  

          '</tr>'

        );
        
      });

      //pasar fecha de ingreso a formulario de egreso paciente para control
      $("#nuevoFechaEgreso").attr("min", respuesta[i]["fecha_transferencia"]);

    },
    error: function(error) {

      console.log("No funciona");

    }

  });

});

/*=============================================
PASAR PARAMETROS A VENTANA MODAL VER ALTA PACIENTE
=============================================*/
$(document).on("click", ".btnVerAltaPaciente", function() {

  $("#fechaIngresoA").empty();
  $("#horaIngresoA").empty();
  $("#diagnosticoIngresoA").empty();
  $("#diagnosticosEspecificosA").empty();
  $("#servicioIngresoA").empty();
  $("#salaIngresoA").empty();
  $("#camaIngresoA").empty();

  $("#transferenciasA").empty();

  var idPacienteIngreso = $(this).attr("idPacienteIngreso");
  var fecha_ingreso = $(this).attr("fecha_ingreso");
  var modulo = $(this).attr("modulo");

  $("#nuevoIdPacienteIngreso").val(idPacienteIngreso);
  // $("#nuevoFechaIngresoPaciente").val(fecha_ingreso);

  //pasar fecha de ingreso a formulario de egreso paciente para control
  $("#nuevoFechaEgreso").attr("min", fecha_ingreso);

    if (modulo == 'detalle-paciente') {
      dirPacienteIngresos = "../ajax/paciente_ingresos.ajax.php";
      dirTransferencias = "../ajax/transferencias.ajax.php";
      dirPacienteEgresos = "../ajax/paciente_egresos.ajax.php";
      dirTempPDF = "../temp/egreso-"+idPacienteIngreso+".pdf";
    } else if (modulo == 'paciente-egresos') {
      dirPacienteIngresos = "ajax/paciente_ingresos.ajax.php";
      dirTransferencias = "ajax/transferencias.ajax.php";
      dirPacienteEgresos = "ajax/paciente_egresos.ajax.php";
      dirTempPDF = "temp/egreso-"+idPacienteIngreso+".pdf";
    }

  //para obtner los datos de paciente ingreso
  var datos = new FormData();
  datos.append("mostrarPacienteIngreso", 'mostrarPacienteIngreso');
  datos.append("id", idPacienteIngreso);

  $.ajax({

    url: dirPacienteIngresos,
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {

      var date = new Date(respuesta['fecha_ingreso']);
      date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
      
      $("#fechaIngresoA").append(moment(date).format("DD/MM/YYYY"));
      $("#horaIngresoA").append(respuesta['hora_ingreso']);
      $("#diagnosticoIngresoA").append(respuesta['diagnostico']);
      $("#diagnosticosEspecificosA").append(respuesta['diagnostico_especifico1']+' - '+respuesta['diagnostico_especifico2']+' - '+respuesta['diagnostico_especifico3']);
      $("#servicioIngresoA").append(respuesta['nombre_servicio']+' - '+respuesta['nombre_especialidad']);
      $("#salaIngresoA").append(respuesta['nombre_sala']);
      $("#camaIngresoA").append(respuesta['nombre_cama']);

    },
    error: function(error) {

      console.log("No funciona");

    }

  });

  //para obtener los datos de transferencias
  var datos2 = new FormData();
  datos2.append("mostrarPacienteTransferencias", 'mostrarPacienteTransferencias');
  datos2.append("id", idPacienteIngreso);

  $.ajax({

    url: dirTransferencias,
    method: "POST",
    data: datos2,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {
      console.log("respuesta", respuesta);

      var i = -1;

      $.each(respuesta, function(key,value) {

        i = i + 1;

        var date = new Date(value.fecha_transferencia);
        date.setMinutes(date.getMinutes() + date.getTimezoneOffset())

        $("#transferenciasA").append(

          '<tr>'+

            '<td>'+moment(date).format("DD/MM/YYYY")+'</td>'+
            '<td>'+value.servicio_ini+'</td>'+
            '<td>'+value.servicio_fin+'</td>'+
            '<td>'+value.diagnostico_transferencia+'</td>'+  

          '</tr>'

        );
        
      });

      console.log("respuesta", respuesta[i]["fecha_transferencia"]);

      //pasar fecha de ingreso a formulario de egreso paciente para control
      $("#nuevoFechaEgreso").attr("min", respuesta[i]["fecha_transferencia"]);

    },
    error: function(error) {

      console.log("No funciona");

    }

  });

  $("#fechaEgresoA").empty();
  $("#horaEgresoA").empty();
  $("#diagnosticoEgresoA").empty();
  $("#diagnosticosEgresoA").empty();
  $("#causaEgresoA").empty();
  $("#condicionEgresoA").empty();

  //para obtner los datos de paciente egreso
  var datos3 = new FormData();
  datos3.append("mostrarPacienteEgreso", 'mostrarPacienteEgreso');
  datos3.append("idPacienteIngreso", idPacienteIngreso);

  $.ajax({

    url: dirPacienteEgresos,
    method: "POST",
    data: datos3,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {

      var date = new Date(respuesta['fecha_egreso']);
      date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
      
      $("#fechaEgresoA").append(moment(date).format("DD/MM/YYYY"));
      $("#horaEgresoA").append(respuesta['hora_egreso']);
      $("#diagnosticoEgresoA").append(respuesta['diagnostico']);
      $("#diagnosticosEgresoA").append(respuesta['diagnostico_egreso1']+' - '+respuesta['diagnostico_egreso2']+' - '+respuesta['diagnostico_egreso3']);
      $("#causaEgresoA").append(respuesta['causa_egreso']);
      $("#condicionEgresoA").append(respuesta['condicion_egreso']);

    },
    error: function(error) {

      console.log("No funciona");

    }

  });

  var datos4 = new FormData();
  datos4.append("reporteEgresoPaciente", 'reporteEgresoPaciente');
  datos4.append("idPacienteIngreso", idPacienteIngreso);

  $.ajax({

    url: dirPacienteEgresos,
    method: "POST",
    data: datos4,
    cache: false,
    contentType: false,
    processData: false,
    success : function(respuesta){

      // $('#ver-pdf').modal("show");

      PDFObject.embed(dirTempPDF, "#view_pdf");

    },
    error: function(error) {

      console.log("No funciona");
          
    }

  });

});

/*======================================
HABILITAR OPCIONES EN CASO DE MUERTE DE PACIENTE
========================================*/
$("#frmDarAltaPaciente").on("change",'#nuevoCausaEgreso', function(){

	$(".indicadorAltaPaciente").remove();

	var causaEgreso = $(this).val();
	console.log("causaEgreso", causaEgreso);
		
	if(causaEgreso == "MUERTE INSTITUCIONAL") {

		$('#nuevoCausaClinica').prop("readonly",false);
		$("#nuevoCausaClinica").before('<label class="indicadorAltaPaciente">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
		$("#nuevoCausaClinica").attr('required',true);
		$('#nuevoCausaAutopsia').prop("readonly",true);
    $("#nuevoCausaAutopsia").removeAttr('required');
		$('#nuevoCondicionEgreso').prop("disabled",true);
		$("#nuevoCondicionEgreso").removeAttr('required');

	} else if(causaEgreso=="MUERTE NO INSTITUCIONAL") {

		$('#nuevoCausaClinica').prop("readonly",true);
    $("#nuevoCausaClinica").removeAttr('required');
		$('#nuevoCausaAutopsia').prop("readonly",false);
		$("#nuevoCausaAutopsia").before('<label class="indicadorAltaPaciente">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
		$("#nuevoCausaAutopsia").attr('required',true);
		$('#nuevoCondicionEgreso').prop("disabled",true);
		$("#nuevoCondicionEgreso").removeAttr('required');

	} else {

		$('#nuevoCausaClinica').prop("readonly",true);
    $("#nuevoCausaClinica").removeAttr('required');
		$('#nuevoCausaAutopsia').prop("readonly",true);
    $("#nuevoCausaAutopsia").removeAttr('required');    
		$('#nuevoCondicionEgreso').prop("disabled",false);
		$("#nuevoCondicionEgreso").before('<label class="indicadorAltaPaciente">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
		$("#nuevoCondicionEgreso").attr('required',true);

	}

});

/*=============================================
CONFIGURACION DE LAS REGLAS Y MENSAJES PARA VALIDACION (PACIENTE EGRESO)
=============================================*/
$(document).ready(function(){
  $("#frmDarAltaPaciente").validate({

    rules: {
      nuevoDiagnosticoEgreso1 : { patron_numerosTexto : true },
      nuevoDiagnosticoEgreso2 : { patron_numerosTexto : true },
      nuevoDiagnosticoEgreso3 : { patron_numerosTexto : true },
      nuevoCausaClinica : { patron_textoEspecial : true },
      nuevoCausaAutopsia : { patron_textoEspecial : true }
    },

    messages: {
      nuevoDiagnosticoEgreso : "Elija un Diagnostico CIE-10",
      nuevoCausaEgreso : "Elija una Opción",
      nuevoCondicionEgreso : "Elija una Opción",
      nuevoFechaEgreso: {
        required: "Ingrese una fecha de egreso",
        min: function (p, element) {
            return "Debe ser una fecha mayor o igual a " + formatoFecha(p);
        }
      }
    },

  });

});

/*=============================================
GUARDANDO DATOS EGRESO PACIENTE (ALTA PACIENTE)
=============================================*/
$("#frmDarAltaPaciente").on("click", ".btnGuardar", function() {

  if ($("#frmDarAltaPaciente").valid()) {

    var modulo = $("#modulo").val();
    console.log("modulo", modulo);

    if (modulo == 'detalle-paciente') {
      dirPacienteEgresos = "../ajax/paciente_egresos.ajax.php";
    } else if (modulo == 'paciente-ingresos') {
      dirPacienteEgresos = "ajax/paciente_egresos.ajax.php";
    }

    var datos = new FormData($("#frmDarAltaPaciente")[0]);
    datos.append("nuevoPacienteEgreso", 'nuevoPacienteEgreso');

    $.ajax({

      url: dirPacienteEgresos,
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta) {

        if (respuesta == "ok") {

          swal.fire({

            icon: "success",
            title: "¡Los datos se guardaron correctamente!",
            showConfirmButton: true,
            allowOutsideClick: false,
            confirmButtonText: "Cerrar"

          }).then((result) => {

            if (result.value) {

              $('#modalDarAltaPaciente').modal('toggle'); 

              $("#nuevoFechaEgreso").val("");

              $("#nuevoHoraEgreso").val("");

              $("#nuevoDiagnosticoEgreso").empty();
              $("#nuevoDiagnosticoEgreso").append('<option value="">BUSCAR UN DIAGNOSTICO...</option>');

              $("#nuevoDiagnosticoEgreso1").val("");
              $("#nuevoDiagnosticoEgreso2").val("");
              $("#nuevoDiagnosticoEgreso3").val("");

              $("#nuevoCausaEgreso").val("");

  						$("#nuevoCondicionEgreso").val("");

  						$("#nuevoCausaClinica").val("");

  						$("#nuevoCausaAutopsia").val("");	

              $("#nuevoContrareferencia").prop("checked", false); 

  						$("#nuevoIdPacienteIngreso").val("");					       	

              if (modulo == 'detalle-paciente') {
                tablaPacienteIngresos.ajax.reload( null, false );
              } else if (modulo == 'paciente-ingresos') {
                tablaPacientesIngresos.ajax.reload( null, false );
              }

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
FILTRAR LISTADO DE PACIENTE INTERNADOS POR FECHA DE INGRESO
=============================================*/
$("#frmPacientesEgresados").on("click", "#btnBuscarPacientesEgresados", function() {

  var fechaIni = $("#fechaIniEgresados").val();
  var fechaFin = $("#fechaFinEgresados").val();

  tablaPacientesEgresos.destroy();
         
  tablaPacientesEgresos = $('#tblPacientesEgresos').DataTable({

    "ajax": {
      url: "ajax/datatable-paciente_egresos.ajax.php",
      data: { 'fechaIni' : fechaIni, 'fechaFin' : fechaFin, 'BuscarFechaEgresados' : 'BuscarFechaEgresados' },
      type: "post"
    },

    "deferRender": true,

    "retrieve" : true,

    "processing" : true,

    "serverSide": true,

    "order": [[ 4, "desc" ]],

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

});

/*=============================================
BOTON QUE PARA CERRAR LA VENTANA MODAL DEL REPORTE PDF Y ELIMINA EL ARCHIVO TEMPORAL
=============================================*/
$("#modalVerAltaPaciente").on("click", ".btnCerrarReporte", function() {

  var url = $(this).parent().parent().children(".modal-body").children().children().children().children().children().attr("src");
  // console.log("url", url);

  var modulo = $("#modulo").val();
  // console.log("modulo", modulo);

  if (modulo == 'detalle-paciente') {
    dirPacienteEgresos = "../ajax/paciente_egresos.ajax.php";
  } else if (modulo == 'paciente-egresos') {
    dirPacienteEgresos = "ajax/paciente_egresos.ajax.php";
    url = '../'+url;
  }

  var datos = new FormData();

  datos.append("eliminarPDF", "eliminarPDF");
  datos.append("url", url);

  $.ajax({

    url: dirPacienteEgresos,
    type: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function(respuesta) {
    
    }

  });

});