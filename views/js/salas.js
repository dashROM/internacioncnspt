/*=============================================
CARGAR LA TABLA DINÁMICA DE ESTABLECIMIENTO
=============================================*/

var tablaSalas = $('#tblSalas').DataTable({

	"ajax": {
		url: "../ajax/datatable-salas.ajax.php",
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
GUARDANDO DATOS DE NUEVA SALA
=============================================*/
$("#frmNuevaSala").on("click", ".btnGuardar", function() {

	var datos = new FormData($("#frmNuevaSala")[0]);
	datos.append("nuevaSala", 'nuevaSala');

	$.ajax({

		url: "../ajax/salas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(id_sala) {
			
			console.log("id_sala", id_sala);
		
			if (id_sala != "error") {

				swal.fire({
					
					icon: "success",
					title: "¡Los datos se guardaron correctamente!",
					showConfirmButton: true,
					allowOutsideClick: false,
					confirmButtonText: "Cerrar"

				}).then((result) => {
  					
  				if (result.value) {

  					window.location = datos.get('idServicio');

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