/*=============================================
CARGAR LA TABLA DINÁMICA DE SERVICIOS
=============================================*/
var tablaServicios = $('#tblServicios').DataTable({

	"ajax": {
		url: "ajax/datatable-servicios.ajax.php",
		// data: { 'perfilOculto' : perfilOculto, 'action' : action },
		type: "post"
	},

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
GUARDANDO DATOS DE NUEVO SERVICIO
=============================================*/
$("#frmNuevoServicio").on("click", ".btnGuardar", function() {

	var datos = new FormData($("#frmNuevaespecialidad")[0]);
	datos.append("nuevoEspecialidad", 'nuevoEspecialidad');

	$.ajax({

		url: "ajax/especialidades.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "html",
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

  						window.location = "especialidades";

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

});

/*=============================================
ABRIR VENTANA MAS DETALLE SERVICIO 
=============================================*/
$(document).on("click", ".btnDetalleServicio" , function() { 

	var id = $(this).attr("idServicio");
	console.log("id", id);
	window.location = "detalle-servicio/"+id;	

});

/*=============================================
TABLA DE LIBRO SERVICIOS
=============================================*/
var tablaLibroServicios = $('#tblLibroServicios').DataTable({

  "destroy": true,

  "paging": false,

  "searching": false,

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

}); 

/*=============================================
FILTRAR LISTADO DE PACIENTES POR SERVICIOS Y FECHA DE EGRESO
=============================================*/
$("#frmLibroServicios").on("click", "#btnBuscarLibroServicios", function() {

  var servicio = $("#servicio").val();
  var nombre_servicio = $("#servicio").find('option:selected').text();
  var fechaIni = $("#fechaIniLibroServicio").val();
  var fechaFin = $("#fechaFinLibroServicio").val(); 

  $("#nombre_servicio").text(nombre_servicio);

  tablaLibroServicios.destroy();         

  tablaLibroServicios = $('#tblLibroServicios').DataTable({

    "ajax": {
      url: "ajax/datatable-libro_servicios.ajax.php",
      data: { 'servicio' : servicio, 'fechaIni' : fechaIni, 'fechaFin' : fechaFin, 'BuscarFechaLibroServicios' : 'BuscarFechaLibroServicios' },
      type: "post"
    },

    "destroy": true,

    "deferRender": true,

    "retrieve" : true,

    "processing" : true,

    "serverSide": true,

    "ordering": false,

    "stateSave": true,

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

    "responsive": true,

    "lengthChange": false,

    //para usar los botones
    "dom": 'Bfrtilp',       
    
    "buttons":[
      {
        extend:    'excelHtml5',
        title:     'Reporte '+nombre_servicio+' '+fechaIni+'_'+fechaFin,
        text:      '<i class="fas fa-file-excel"></i> Generar EXCEL',
        titleAttr: 'Exportar a Excel',
        className: 'btn btn-success'
      } 
    ]       

  });

});