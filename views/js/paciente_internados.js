/*=============================================
CARGAR LA TABLA DINÁMICA DE PACIENTES INTERNADOS
=============================================*/
var tablaPacientesInternados = $('#tblPacientesInternados').DataTable({

  "ajax": {
    url: "ajax/datatable-paciente_internados.ajax.php",
    data: { 'pacientesInternados' : 'pacientesInternados'},
    type: "post"
  },

  "destroy": true,

  "deferRender": true,

  "retrieve" : true,

  "processing" : true,

  "serverSide": true,

  "order": [[ 3, "desc" ]],

  "stateSave": true,

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
FILTRAR LISTADO DE PACIENTE INTERNADOS POR FECHA DE INGRESO
=============================================*/
$("#frmPacientesInternados").on("click", "#btnBuscarPacientesInternados", function() {

  var fechaIni = $("#fechaIniInternados").val();
  var fechaFin = $("#fechaFinInternados").val(); 

  tablaPacientesInternados.destroy();         

  tablaPacientesInternados = $('#tblPacientesInternados').DataTable({

    "ajax": {
      url: "ajax/datatable-paciente_internados.ajax.php",
      data: { 'fechaIni' : fechaIni, 'fechaFin' : fechaFin, 'BuscarFechaInternados' : 'BuscarFechaInternados' },
      type: "post"
    },

    "destroy": true,

    "deferRender": true,

    "retrieve" : true,

    "processing" : true,

    "serverSide": true,

    "order": [[ 3, "desc" ]],

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
SE HABILITAN FORMULARIO DE BUSQUEDA DE PACIENTE DEPENDIENDO A LA OPCION SELECCIONADA
=============================================*/
$(document).on("change", "#selectOption", function() {

  $('#filtroMatricula').addClass('d-none');
  $('#buscarMatricula').removeAttr('required');

  $('#filtroCI').addClass('d-none');
  $('#buscarCI').removeAttr('required');

  $('#filtroNombre').addClass('d-none');
  $('#buscarNombre').removeAttr('required');

  $(".mostrarResultadoIntenacion").hide(100);

  var option = $(this).val();

  if (option == 1) {

    $('#filtroMatricula').removeClass('d-none');
    $('#buscarMatricula').attr('required', '');

  } else if(option == 2) {

    $('#filtroCI').removeClass('d-none');
    $('#filtroCI').attr('required', '');

  } else if (option == 3) {

    $('#filtroNombre').removeClass('d-none');
    $('#filtroNombre').attr('required', '');

  }

});

$(".mostrarResultadoIntenacion").hide(1000);

/*=============================================
VALIDANDO DATOS DE FORMULARIO DE BUSQUEDA
=============================================*/
$("#frmBuscarMatricula").validate({

  rules: {
    buscarMatricula: { required: true},
  },

  messages: {
    buscarMatricula: "Ingrese Nro de Matricula de Asegurado",
  },

});

$("#frmBuscarCI").validate({

  rules: {
    buscarCI: { required: true},
  },

  messages: {
    buscarCI: "Ingrese Nro de Cédula de Identidad",
  },

});

$("#frmBuscarNombre").validate({

  rules: {
    buscarNombre: { required: true},
  },

  messages: {
    buscarNombre: "Ingrese Nombre(s) o Apellido(s) del Paciente Internado",
  },

});

/*=============================================
BUSCANDO PACIENTE INTERNADO POR MATRICULA
=============================================*/
$("#frmBuscarMatricula").on("click", "#btnBuscarMatricula", function() {

  if ($("#frmBuscarMatricula").valid()) {

    $(".mostrarResultadoIntenacion").hide(100);

    var matricula = $("#buscarMatricula").val();

    $('.mensajeResultado').remove();

    var datos = new FormData();
    datos.append("matricula", matricula);
    datos.append("buscarMatricula", "buscarMatricula");

    $.ajax({

      url:"ajax/datatable-buscador_internacion.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta) {

        // console.log("respuesta", respuesta);

        if (respuesta == false) {

          $(".mostrarResultadoIntenacion").append(

            '<div class="card mensajeResultado">'+

            '<div class="card-body">'+

            '<div class="alert alert-info" role="alert">'+

            '<h5 class="card-title">No se encontraron resultados...</h5>'+

            '</div>'+

            '</div>'+

            '</div>'

            ).show(100); 

        } else {

            // console.log("respuesta", respuesta);

            $(".mostrarResultadoIntenacion").append(

            '<div class="card mensajeResultado">'+

              '<div class="card-header">'+

              '</div>'+

              '<div class="card-body">'+

                '<h5 class="card-title">PACIENTES INTERNADOS</h5>'+

                '<div class="form-row table-responsive">'+

                  '<table class="table table-bordered table-striped dt-responsive nowrap" id="tablaResultadoBusqueda" width="100%">'+

                    '<thead>'+

                      '<tr>'+
                        '<th>PACIENTE</th>'+
                        '<th>MATRICULA</th>'+
                        '<th>SALA</th>'+
                        '<th>CAMA</th>'+
                        '<th>SERVICIO</th>'+
                        '<th>ESPECIALIDAD</th>'+
                        '<th>MÉDICO</th>'+
                      '</tr>'+

                    '</thead>'+

                  '</table>'+ 

                '</div>'+

              '</div>'+

            '</div>' 

            ).show(100);                   

            var t = $('#tablaResultadoBusqueda').DataTable({

              "data": respuesta,

              "columns": [
              { data: "nombre_completo" },
              { data: "cod_asegurado" },
              { data: "nombre_sala" },
              { data: "nombre_cama" },
              { data: "nombre_servicio" },
              { data: "nombre_especialidad" },
              { data: "nombre_completo_medico" }
              ],

              "deferRender": true,

              "processing" : true,

              "lengthChange": false,

              "searching": false,

              "ordering": false, 

              "paginate": false,

              "info":     false 

            });

          }

        },
        error: function(error) {

          console.log("No funciona");

        }

      });

  } else {

    // swal.fire({

    //     title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
    //     icon: "error",
    //     allowOutsideClick: false,
    //     confirmButtonText: "¡Cerrar!"

    // });
    
  } 

});

/*=============================================
BUSCANDO PACIENTE INTERNADO POR CI
=============================================*/
$("#frmBuscarCI").on("click", "#btnBuscarCI", function() {

  if ($("#frmBuscarCI").valid()) {

    var ci = $("#buscarCI").val();
    console.log("ci", ci);

    $('.mensajeResultado').remove();

    var datos = new FormData();
    datos.append("ci", ci);
    datos.append("buscarCI", "buscarCI");

    $.ajax({

      url:"ajax/datatable-buscador_internacion.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta) {

      // console.log("respuesta", respuesta);

      if (respuesta == false) {

        $(".mostrarResultadoIntenacion").append(

          '<div class="card mensajeResultado">'+

          '<div class="card-body">'+

          '<div class="alert alert-info" role="alert">'+

          '<h5 class="card-title">No se encontraron resultados...</h5>'+

          '</div>'+

          '</div>'+

          '</div>'

          ).show(100); 

      } else {

          // console.log("respuesta", respuesta);

          $(".mostrarResultadoIntenacion").append(

            '<div class="card mensajeResultado">'+

            '<div class="card-header">'+

            '</div>'+

            '<div class="card-body">'+

            '<h5 class="card-title">PACIENTES INTERNADOS</h5>'+

            '<div class="form-row table-responsive">'+

            '<table class="table table-bordered table-striped dt-responsive nowrap" id="tablaResultadoBusqueda" width="100%">'+

            '<thead>'+

            '<tr>'+
            '<th>PACIENTE</th>'+
            '<th>MATRICULA</th>'+
            '<th>SALA</th>'+
            '<th>CAMA</th>'+
            '<th>SERVICIO</th>'+
            '<th>ESPECIALIDAD</th>'+
            '<th>MÉDICO</th>'+
            '</tr>'+

            '</thead>'+

            '</table>'+ 

            '</div>'+

            '</div>'+

            '</div>' 

            ).show(100);                   

          var t = $('#tablaResultadoBusqueda').DataTable({

            "data": respuesta,

            "columns": [
            { data: "nombre_completo" },
            { data: "cod_asegurado" },
            { data: "nombre_sala" },
            { data: "nombre_cama" },
            { data: "nombre_servicio" },
            { data: "nombre_especialidad" },
            { data: "nombre_completo_medico" }
            ],

            "deferRender": true,

            "processing" : true,

            "lengthChange": false,

            "searching": false,

            "ordering": false, 

            "paginate": false,

            "info":     false 

          });

        }

      },
      error: function(error) {

        console.log("No funciona");

      }

    });

  } else {

      // swal.fire({

      //     title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
      //     icon: "error",
      //     allowOutsideClick: false,
      //     confirmButtonText: "¡Cerrar!"

      // });
      
  } 

});

/*=============================================
BUSCANDO PACIENTE INTERNADO POR NOMBRE Y APELLIDO
=============================================*/
$("#frmBuscarNombre").on("click", "#btnBuscarNombre", function() {

  if ($("#frmBuscarNombre").valid()) {

    var nombre = $("#buscarNombre").val();
    console.log("nombre", nombre);

    $('.mensajeResultado').remove();

    var datos = new FormData();
    datos.append("nombre", nombre);
    datos.append("buscarNombre", "buscarNombre");

    $.ajax({

      url:"ajax/datatable-buscador_internacion.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta) {

        // console.log("respuesta", respuesta);

        if (respuesta == false) {

          $(".mostrarResultadoIntenacion").append(

            '<div class="card mensajeResultado">'+

            '<div class="card-body">'+

            '<div class="alert alert-info" role="alert">'+

            '<h5 class="card-title">No se encontraron resultados...</h5>'+

            '</div>'+

            '</div>'+

            '</div>'

            ).show(100); 

        } else {

            // console.log("respuesta", respuesta);

            $(".mostrarResultadoIntenacion").append(

              '<div class="card mensajeResultado">'+

              '<div class="card-header">'+

              '</div>'+

              '<div class="card-body">'+

              '<h5 class="card-title">PACIENTES INTERNADOS</h5>'+

              '<div class="form-row table-responsive">'+

              '<table class="table table-bordered table-striped dt-responsive nowrap" id="tablaResultadoBusqueda" width="100%">'+

              '<thead>'+

              '<tr>'+
              '<th>PACIENTE</th>'+
              '<th>MATRICULA</th>'+
              '<th>SALA</th>'+
              '<th>CAMA</th>'+
              '<th>SERVICIO</th>'+
              '<th>ESPECIALIDAD</th>'+
              '<th>MÉDICO</th>'+
              '</tr>'+

              '</thead>'+

              '</table>'+ 

              '</div>'+

              '</div>'+

              '</div>' 

              ).show(100);                   

            var t = $('#tablaResultadoBusqueda').DataTable({

              "data": respuesta,

              "columns": [
              { data: "nombre_completo" },
              { data: "cod_asegurado" },
              { data: "nombre_sala" },
              { data: "nombre_cama" },
              { data: "nombre_servicio" },
              { data: "nombre_especialidad" },
              { data: "nombre_completo_medico" }
              ],

              "deferRender": true,

              "processing" : true,

              "lengthChange": false,

              "searching": false,

              "ordering": false, 

              "paginate": false,

              "info":     false 

            });

          }

        },
        error: function(error) {

          console.log("No funciona");

        }

      });

  } else {

    // swal.fire({

    //     title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
    //     icon: "error",
    //     allowOutsideClick: false,
    //     confirmButtonText: "¡Cerrar!"

    // });
    
  } 

});

/*=============================================
CARGAR LA TABLA DINÁMICA DE PACIENTES INTERNADOS (MEDICINA INTERNA)
=============================================*/
var tablaMedicinaInterna = $('#tblMedicinaInterna').DataTable({

  "ajax": {
    url: "ajax/datatable-paciente_internados.ajax.php",
    data: { 'pacientesInternadosServicio' : 'pacientesInternadosServicio', 'id' : 4},
    type: "post"
  },

  "searching": false,

  "ordering": false,

  "paging": false,

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

});

/*=============================================
CARGAR LA TABLA DINÁMICA DE PACIENTES INTERNADOS (NEUMOLOGIA)
=============================================*/
var tablaNeumologia = $('#tblNeumologia').DataTable({

  "ajax": {
    url: "ajax/datatable-paciente_internados.ajax.php",
    data: { 'pacientesInternadosServicio' : 'pacientesInternadosServicio', 'id' : 6},
    type: "post"
  },

  "searching": false,

  "ordering": false,

  "paging": false,

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

});

/*=============================================
CARGAR LA TABLA DINÁMICA DE PACIENTES INTERNADOS (CIRUGIA)
=============================================*/
var tablaCirugia = $('#tblCirugia').DataTable({

  "ajax": {
    url: "ajax/datatable-paciente_internados.ajax.php",
    data: { 'pacientesInternadosServicio' : 'pacientesInternadosServicio', 'id' : 5},
    type: "post"
  },

  "searching": false,

  "ordering": false,

  "paging": false,

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

});

/*=============================================
CARGAR LA TABLA DINÁMICA DE PACIENTES INTERNADOS (UTI)
=============================================*/
var tablaTerapiaIntensiva = $('#tblTerapiaIntensiva').DataTable({

  "ajax": {
    url: "ajax/datatable-paciente_internados.ajax.php",
    data: { 'pacientesInternadosServicio' : 'pacientesInternadosServicio', 'id' : 7},
    type: "post"
  },

  "searching": false,

  "ordering": false,

  "paging": false,

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

});

/*=============================================
CARGAR LA TABLA DINÁMICA DE PACIENTES INTERNADOS (MATERNIDAD)
=============================================*/
var tablaMaternidad = $('#tblMaternidad').DataTable({

  "ajax": {
    url: "ajax/datatable-paciente_internados.ajax.php",
    data: { 'pacientesInternadosServicio' : 'pacientesInternadosServicio', 'id' : 22},
    type: "post"
  },

  "searching": false,

  "ordering": false,

  "paging": false,

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

});

/*=============================================
CARGAR LA TABLA DINÁMICA DE PACIENTES INTERNADOS (NEONATOLOGIA)
=============================================*/
var tablaNeonatologia = $('#tblNeonatologia').DataTable({

  "ajax": {
    url: "ajax/datatable-paciente_internados.ajax.php",
    data: { 'pacientesInternadosServicio' : 'pacientesInternadosServicio', 'id' : 3},
    type: "post"
  },

  "searching": false,

  "ordering": false,

  "paging": false,

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

});

/*=============================================
CARGAR LA TABLA DINÁMICA DE PACIENTES INTERNADOS (GINECOLOGIA)
=============================================*/
var tablaGinecologia = $('#tblGinecologia').DataTable({

  "ajax": {
    url: "ajax/datatable-paciente_internados.ajax.php",
    data: { 'pacientesInternadosServicio' : 'pacientesInternadosServicio', 'id' : 7},
    type: "post"
  },

  "searching": false,

  "ordering": false,

  "paging": false,

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

});
