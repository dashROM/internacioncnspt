/*=============================================
TABLA DE NEONATOS
=============================================*/
var tablaNeonatos = $('#tblNeonatos').DataTable({

  "ajax": {
    url: "ajax/datatable-neonatos.ajax.php",
    data: { 'neonatos' : 'neonatos' },
    type: "post"
  },

  "destroy": true,

  "deferRender": true,

  "retrieve" : true,

  "processing" : true,

  "serverSide": true,

  "order": [[ 1, "desc" ]],

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
PASAR PARAMETROS A VENTANA MODAL NUEVA NEONATO
=============================================*/
$(document).on("click", ".btnNuevoNeonato", function() {

  $("#fechaIngresoN").empty();
  $("#horaIngresoN").empty();
  $("#diagnosticoIngresoN").empty();
  $("#diagnosticosEspecificosN").empty();
  $("#servicioIngresoN").empty();
  $("#salaIngresoN").empty();
  $("#camaIngresoN").empty();

  $("#transferencias").empty();

	var idPacienteIngreso = $(this).attr("idPacienteIngreso");
	var fecha_ingreso = $(this).attr("fecha_ingreso");

	$("#idPacienteIngresoN").val(idPacienteIngreso);
	// $("#nuevoFechaIngresoPaciente").val(fecha_ingreso);

	//pasar fecha de ingreso a formulario de egreso paciente para control
	$("#nuevoFechaEgreso").attr("min", fecha_ingreso);

  //para obtner los datos de paciente ingreso
  var datos = new FormData();
  datos.append("mostrarPacienteIngreso", 'mostrarPacienteIngreso');
  datos.append("id", idPacienteIngreso);

  $.ajax({

    url: "../ajax/paciente_ingresos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {

      var date = new Date(respuesta['fecha_ingreso']);
      date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
      
      $("#fechaIngresoN").append(moment(date).format("DD/MM/YYYY"));
      $("#horaIngresoN").append(respuesta['hora_ingreso']);
      $("#diagnosticoIngresoN").append(respuesta['diagnostico']);
      $("#diagnosticosEspecificosN").append(respuesta['diagnostico_especifico1']+' - '+respuesta['diagnostico_especifico2']+' - '+respuesta['diagnostico_especifico3']);
      $("#servicioIngresoN").append(respuesta['nombre_servicio']+' - '+respuesta['nombre_especialidad']);
      $("#salaIngresoN").append(respuesta['nombre_sala']);
      $("#camaIngresoN").append(respuesta['nombre_cama']);

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

    url: "../ajax/transferencias.ajax.php",
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

        $("#transferenciasN").append(

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
CONFIGURACION DE LAS REGLAS Y MENSAJES PARA VALIDACION (NUEVO NEONATO)
=============================================*/
$(document).ready(function(){
  $("#frmNuevoNeonato").validate({

    messages: {
      nuevoTipoPartoNeonato : "Elija un Tipo de Parto",
    },

    errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    }

  });

});

/*=============================================
GUARDANDO DATOS DE NEONATO
=============================================*/
$("#frmNuevoNeonato").on("click", ".btnGuardar", function() {

  if ($("#frmNuevoNeonato").valid()) {

    var datos = new FormData($("#frmNuevoNeonato")[0]);
    datos.append("nuevoNeonato", 'nuevoNeonato');

    $.ajax({

      url:"../ajax/neonatos.ajax.php",
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

                $('#modalNuevoNeonato').modal('toggle');

                $("#nuevoPesoNeonato").val("");
                $("#nuevoTallaNeonato").val("");
                $("#nuevoPCNeonato").val("");    
                $("#nuevoPTNeonato").val("");
                $("#nuevoAPGAR").val("");
                $("#nuevoEdadGestacional").val("");
                $("#nuevoTipoPartoNeonato").val("");
                $("#nuevoDescripcionParto").val("");

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
PASAR PARAMETROS A VENTANA MODAL EDITAR NEONATO
=============================================*/
$(document).on("click", ".btnEditarNeonato", function() {

  $("#fechaIngresoEN").empty();
  $("#horaIngresoEN").empty();
  $("#diagnosticoIngresoEN").empty();
  $("#diagnosticosEspecificosEN").empty();
  $("#servicioIngresoEN").empty();
  $("#salaIngresoEN").empty();
  $("#camaIngresoEN").empty();

  $("#transferencias").empty();

  var idPacienteIngreso = $(this).attr("idPacienteIngreso");
  var fecha_ingreso = $(this).attr("fecha_ingreso");

  $("#idPacienteIngresoEN").val(idPacienteIngreso);
  // $("#nuevoFechaIngresoPaciente").val(fecha_ingreso);

  //pasar fecha de ingreso a formulario de egreso paciente para control
  $("#editarFechaEgreso").attr("min", fecha_ingreso);

  //para obtner los datos de paciente ingreso
  var datos = new FormData();
  datos.append("mostrarPacienteIngreso", 'mostrarPacienteIngreso');
  datos.append("id", idPacienteIngreso);

  $.ajax({

    url: "../ajax/paciente_ingresos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {

      var date = new Date(respuesta['fecha_ingreso']);
      date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
      
      $("#fechaIngresoEN").append(moment(date).format("DD/MM/YYYY"));
      $("#horaIngresoEN").append(respuesta['hora_ingreso']);
      $("#diagnosticoIngresoEN").append(respuesta['diagnostico']);
      $("#diagnosticosEspecificosEN").append(respuesta['diagnostico_especifico1']+' - '+respuesta['diagnostico_especifico2']+' - '+respuesta['diagnostico_especifico3']);
      $("#servicioIngresoEN").append(respuesta['nombre_servicio']);
      $("#salaIngresoEN").append(respuesta['nombre_sala']);
      $("#camaIngresoEN").append(respuesta['nombre_cama']);

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

    url: "../ajax/transferencias.ajax.php",
    method: "POST",
    data: datos2,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {

      var i = -1;

      $.each(respuesta, function(key,value) {

        i = i + 1;

        var date = new Date(value.fecha_transferencia);
        date.setMinutes(date.getMinutes() + date.getTimezoneOffset())

        $("#transferenciasEN").append(

          '<tr>'+

            '<td>'+moment(date).format("DD/MM/YYYY")+'</td>'+
            '<td>'+value.servicio_ini+'</td>'+
            '<td>'+value.servicio_fin+'</td>'+
            '<td>'+value.diagnostico_transferencia+'</td>'+  

          '</tr>'

        );
        
      });

      //pasar fecha de ingreso a formulario de egreso paciente para control
      $("#editarFechaEgreso").attr("min", respuesta[i]["fecha_transferencia"]);

    },
    error: function(error) {

      console.log("No funciona");

    }

  });

  //para obtener los datos de maternidad
  var datos3 = new FormData();
  datos3.append("mostrarNeonato", 'mostrarNeonato');
  datos3.append("idPacienteIngreso", idPacienteIngreso);

  $.ajax({

    url: "../ajax/neonatos.ajax.php",
    method: "POST",
    data: datos3,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {
      console.log("respuesta", respuesta);

      $("#editarPesoNeonato").val(respuesta['peso_neonato']);
      $("#editarTallaNeonato").val(respuesta['talla_neonato']);
      $("#editarPCNeonato").val(respuesta['pc_neonato']);
      $("#editarPTNeonato").val(respuesta['pt_neonato']);
      $("#editarAPGAR").val(respuesta['apgar']);
      $("#editarEdadGestacional").val(respuesta['edad_gestacional_neonato']);
      $("#editarTipoPartoNeonato").val(respuesta['tipo_parto_neonato']);
      $("#editarDescripcionParto").val(respuesta['descripcion_parto']);
      $("#idPacienteIngresoEN").val(respuesta['id_paciente_ingreso']);
      $("#idNeonato").val(respuesta['id']);

    },
    error: function(error) {

      console.log("No funciona");


    }

  });

});

/*=============================================
CONFIGURACION DE LAS REGLAS Y MENSAJES PARA VALIDACION (EDITAR NEONATO)
=============================================*/
$(document).ready(function(){
  $("#frmNEditarNeonato").validate({

    messages: {
      editarTipoPartoNeonato : "Elija un Tipo de Parto",
    },

    errorPlacement: function(error, element) {
      var placement = $(element).data('error');
      if (placement) {
        $(placement).append(error)
      } else {
        error.insertAfter(element);
      }
    }

  });

});

/*=============================================
GUARDANDO CAMBIOS DATOS DE NEONATO
=============================================*/
$("#frmEditarNeonato").on("click", ".btnGuardar", function() {

  if ($("#frmEditarNeonato").valid()) {

    var datos = new FormData($("#frmEditarNeonato")[0]);
    datos.append("editarNeonato", 'editarNeonato');

    $.ajax({

      url:"../ajax/neonatos.ajax.php",
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

              $('#modalEditarNeonato').modal('toggle');

              $("#editarPesoNeonato").val(""); 
              $("#editarTallaNeonato").val("");
              $("#editarPCNeonato").val("");
              $("#editarPTNeonato").val("");                
              $("#editarAPGAR").val("");
              $("#editarEdadGestacional").val("");
              $("#editarTipoPartoNeonato").val("");    
              $("#editarDescripcionParto").val("");
              $("#idPacienteIngresoEN").val("");

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
FILTRAR LISTADO DE NEONATOS POR FECHA DE INGRESO
=============================================*/
$("#frmNeonatos").on("click", "#btnBuscarNeonatos", function() {

  var fechaIni = $("#fechaIniNeonatos").val();
  var fechaFin = $("#fechaFinNeonatos").val(); 

  tablaNeonatos.destroy();         

  tablaNeonatos = $('#tblNeonatos').DataTable({

    "ajax": {
      url: "ajax/datatable-neonatos.ajax.php",
      data: { 'fechaIni' : fechaIni, 'fechaFin' : fechaFin, 'BuscarFechaNeonatos' : 'BuscarFechaNeonatos' },
      type: "post"
    },

    "destroy": true,

    "deferRender": true,

    "retrieve" : true,

    "processing" : true,

    "serverSide": true,

    "order": [[ 0, "desc" ]],

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
PARA HABILITAR INPUT MASK EN FORMULARIO
=============================================*/
$(":input").inputmask();