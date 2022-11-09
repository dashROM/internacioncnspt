/*=============================================
CARGAR LA TABLA DINÁMICA DE PACIENTES
=============================================*/

var tablaMedicos = $('#tblMedicos').DataTable({

	"ajax": {
		url: "ajax/datatable-medicos.ajax.php",
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
FUNCIONES CON LOS DIFERENTES PATRONES CON EXPRESIONES REGULARES PARA LA VALIDACIÓN
=============================================*/

// $.validator.addMethod("patron_letras", function (value, element) {

//     var pattern = /^[a-zA-Z]+$/;
//     return this.optional(element) || pattern.test(value);

// }, "El campo debe contener letras (azAZ)");

// $.validator.addMethod("patron_numeros", function (value, element) {

//     var pattern = /^[0-9]+$/;
//     return this.optional(element) || pattern.test(value);

// }, "El campo debe tener un valor numérico (0-9)");
  
//   $.validator.addMethod("patron_numerosLetras", function (value, element) {

//     var pattern = /^[a-zA-Z0-9-]+$/;
//     return this.optional(element) || pattern.test(value);

// }, "El campo debe tener un valor Alfa Numérico (a-zA-Z0-9)");

// $.validator.addMethod("patron_numerosTexto", function (value, element) {

//     var pattern = /^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ .-]+$/;
//     return this.optional(element) || pattern.test(value);

// }, "Caracteres Especiales No Admitidos");

// $.validator.addMethod("patron_texto", function (value, element) {

//     var pattern = /^[A-Za-zñÑáéíóúÁÉÍÓÚ .]+$/;
//     return this.optional(element) || pattern.test(value);

// }, "Caracteres Especiales No Admitidos");

// $.validator.addMethod("patron_textoEspecial", function (value, element) {

//     var pattern = /^[^"'&%${}]*$/;
//     return this.optional(element) || pattern.test(value);

// }, "Caracteres Especiales No Admitidos");

/*=============================================
CONFIGURACION DE LAS REGLAS Y MENSAJES PARA VALIDACION
=============================================*/
$(document).ready(function(){
  $("#frmNuevoMedico").validate({

    rules: {
    	nuevoPrefijo : { required: true},
      nuevoPaternoMedico : { patron_texto: true},
      nuevoMaternoMedico : { patron_texto: true},
      nuevoNombreMedico : { required: true, patron_texto: true},
      nuevoMatricula : { required: true, patron_numerosLetras: true},
      nuevoDireccion : { required: true}, 
      nuevoTelefono : { required: true, patron_numerosLetras: true},
    },

    messages: {
      nuevoPrefijo : "Elija un Prefijo de Médico",
    },

  });

});

/*=============================================
GUARDANDO DATOS DE NUEVA MEDICO
=============================================*/
$("#frmNuevoMedico").on("click", ".btnGuardar", function() {

  if ($("#frmNuevoMedico").valid()) {

		var datos = new FormData($("#frmNuevoMedico")[0]);
		datos.append("nuevoMedico", 'nuevoMedico');
	
		$.ajax({

			url: "ajax/medicos.ajax.php",
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

							window.location = "medicos";

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

})

/*=============================================
CONFIGURACION DE LAS REGLAS Y MENSAJES PARA VALIDACION
=============================================*/
$(document).ready(function(){
  $("#frmEditarMedico").validate({

    rules: {
    	editarPrefijo : { required: true},
      editarPaternoMedico : { patron_texto: true},
      editarMaternoMedico : { patron_texto: true},
      editarNombreMedico : { required: true, patron_texto: true},
      editarMatricula : { required: true, patron_numerosLetras: true},
      editarDireccion : { required: true}, 
      editarTelefono : { required: true, patron_numerosLetras: true},
    },

    messages: {
      editarPrefijo : "Elija un Prefijo de Médico",
    },

  });

});

/*=============================================
CARGANDO DATOS DE PERSONA AL FORMULARIO EDITAR MEDICO
=============================================*/
$(document).on("click", ".btnEditarMedico", function() {

	console.log("CARGAR MEDICO");

	var idMedico = $(this).attr("idMedico");
	console.log("idMedico", idMedico);


	var datos = new FormData();
	datos.append("mostrarMedico", 'mostrarMedico');
	datos.append("idMedico", idMedico);

	$.ajax({

		url: "ajax/medicos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {

			$('#editarIdMedico').val(idMedico);
			$('#editarPrefijo').val(respuesta["prefijo_medico"]);
			$('#editarPaternoMedico').val(respuesta["paterno_medico"]);
			$('#editarMaternoMedico').val(respuesta["materno_medico"]);
			$('#editarNombreMedico').val(respuesta["nombre_medico"]);
			$('#editarMatricula').val(respuesta["matricula_medico"]);
			$('#editarDireccion').val(respuesta["direccion_medico"]);
			$('#editarTelefono').val(respuesta["telefono_medico"]);

		},
    error: function(error){

      console.log("No funciona");
        
    }

	});

});

/*=============================================
GUARDANDO DATOS DE EDITAR PERSONA
=============================================*/
$("#frmEditarMedico").on("click", ".btnGuardar", function() {

    if ($("#frmEditarMedico").valid()) {

	    var datos = new FormData($("#frmEditarMedico")[0]);
			console.log(datos);
			datos.append("editarMedico", 'editarMedico');

			$.ajax({

				url:"ajax/medicos.ajax.php",
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

		  					$('#modalEditarMedico').modal('toggle');
								   
								$("#editarPrefijo").val("");	
								$("#editarPaternoMedico").val("");
								$("#editarMaternoMedico").val("");		
								$("#editarNombreMedico").val("");
								$("#editarMatricula").val("");
								$("#editarDireccion").val("");
								$("#editarTelefono").val("");
								
		  					// Funcion que recarga y actuaiiza la tabla	
								tablaMedicos.ajax.reload( null, false );

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