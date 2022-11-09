/*=============================================
CARGAR LA TABLA DINÁMICA DE ESTABLECIMIENTO
=============================================*/

var tablaEstablecimiento = $('#tblEstablecimiento').DataTable({

	"ajax": {
		url: "ajax/datatable-establecimiento.ajax.php",
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
GUARDANDO DATOS DE NUEVA MATERNIDAD
=============================================*/
$("#frmNuevoEstablecimiento").on("click", ".btnGuardar", function() {

    // if ($("#frmNuevoPacientes").valid()) {

    	// console.log("VALIDADO Pacientes");

		var datos = new FormData($("#frmNuevoEstablecimiento")[0]);
		datos.append("nuevoEstablecimiento", 'nuevoEstablecimiento');
	
		$.ajax({

			url: "ajax/establecimiento.ajax.php",
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

	  						window.location = "establecimiento";

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

    // } else {

	// 	swal.fire({
				
	// 		title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
	// 		icon: "error",
	// 		allowOutsideClick: false,
	// 		confirmButtonText: "¡Cerrar!"

	// 	});
		
	// } 

});
/*=============================================
CARGANDO DATOS DE PERSONA AL FORMULARIO EDITAR ESTABLECIMIENTO
=============================================*/

$(document).on("click", ".btnEditarestablecimiento", function() {

	// console.log("CARGAR PERSONA");

	var idestablecimiento = $(this).attr("idestablecimiento");
	console.log("idestablecimiento", idestablecimiento);


	var datos = new FormData();
	datos.append("mostrarEstablecimiento", 'mostrarEstablecimiento');
	datos.append("idestablecimiento", idestablecimiento);

	$.ajax({

		url: "ajax/establecimiento.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {
			console.log("respuesta", respuesta);
			$('#editaridestablecimiento').val(respuesta["idestablecimiento"]);
			$('#editarnombre_establecimiento').val(respuesta["nombre_establecimiento"]);
			$('#editarabrev_establecimiento').val(respuesta["abrev_establecimiento"]);
			$('#editarubicacion_establecimiento').val(respuesta["ubicacion_establecimiento"]);;


		},
	    error: function(error){

	      console.log("No funciona");
	        
	    }

	});

});
/*=============================================
GUARDANDO DATOS DE EDITAR PERSONA
=============================================*/

$("#frmEditarEstablecimiento").on("click", ".btnGuardar", function() {

    // if ($("#frmEditarPacientes").valid()) {

    	var datos = new FormData($("#frmEditarEstablecimiento")[0]);
		console.log(datos);
		datos.append("editarEstablecimiento", 'editarEstablecimiento');

		$.ajax({	

			url: "ajax/establecimiento.ajax.php",
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

	  						 $('#ModaleditarEstablecimiento').modal('toggle');

							 $("#editaridestablecimiento").val("");  							 
							 $("#editarnombre_establecimiento").val("");	
							 $("#editarabrev_establecimiento").val("");
							 $("#editarubicacion_establecimiento").val("");		
		
							

	  						// Funcion que recarga y actuaiiza la tabla	

							  tablaEstablecimiento.ajax.reload( null, false );

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

    // // } else {

	// // 	swal.fire({
				
	// // 		title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
	// // 		icon: "error",
	// // 		allowOutsideClick: false,
	// // 		confirmButtonText: "¡Cerrar!"

	// // 	});
		
	// } 

});