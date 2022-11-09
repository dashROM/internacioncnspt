/*=============================================
CARGAR LA TABLA DINÁMICA DE CAMAS
=============================================*/
var tablaCamas = $('#tblCamas').DataTable({

	"ajax": {
		url: "ajax/datatable-camas.ajax.php",
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
CARGANDO ID SALA AL MODAL REGISTRAR NUEVA CAMA
=============================================*/
$(document).on("click", ".btnNuevaCama", function() {

	var id = $(this).attr("idSala");
	console.log("id", id);

	$("#idSala").val(id); 

});

/*=============================================
GUARDANDO DATOS DE NUEVA CAMA
=============================================*/
$("#frmNuevaCama").on("click", ".btnGuardar", function() {

	var datos = new FormData($("#frmNuevaCama")[0]);
	datos.append("nuevaCama", 'nuevaCama');

	$.ajax({

		url: "../ajax/camas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(id_cama) {

			console.log("id_cama", id_cama);
		
			if (id_cama != "error") {

				swal.fire({
					
					icon: "success",
					title: "¡Los datos se guardaron correctamente!",
					showConfirmButton: true,
					allowOutsideClick: false,
					confirmButtonText: "Cerrar"

				}).then((result) => {
  					
					if (result.value) {

						var datos2 = new FormData();
						datos2.append("mostrarCama", 'mostrarCama');
						datos2.append("idCama", id_cama);

						$.ajax({

							url:"../ajax/camas.ajax.php",
							method: "POST",
							data: datos2,
							cache: false,
							contentType: false,
							processData: false,
							dataType: "json",
							success: function(respuesta) {
								console.log("respuesta", respuesta);
								
								$('#modalNuevaCama').modal('toggle');
								$("#nuevoNombreCama").val("");	
								$("#nuevoDescripcionCama").val("");	

								$("#tblCama"+respuesta["id_sala"]).append(

									'<tr>'+
		                '<td>'+
		                  '<button class="btn btn-outline-success btn-sm btnEditarCama" idCama="'+respuesta["id"]+'" data-bs-toggle="modal" data-bs-target="#ModalEditarServicio" data-toggle="tooltip" title="Editar">'+
		                  	'<i class="fas fa-pencil-alt"></i>'+
		                  '</button>'+
		                '</td>'+
		                '<td>'+respuesta["nombre_cama"]+'</td>'+
		                '<td>'+respuesta["descripcion_cama"]+'</td>'+
		              '</tr>'

								);

							},
							error: function(error) {

						    console.log("No funciona2");
						        
						  }

						});		

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
CARGANDO DATOS DE CAMA AL FORMULARIO EDITAR CAMA
=============================================*/
$(document).on("click", ".btnEditarCama", function() {

	$("#editarSalaDS").empty();

	var idCama = $(this).attr("idCama");
	var idServicio = $(this).attr("idServicio");
	var idSala = $(this).attr("idSala");

	var datos = new FormData();
	datos.append("mostrarCama", 'mostrarCama');
	datos.append("idCama", idCama);

	$.ajax({

		url: "../ajax/camas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {

			console.log("respuesta", respuesta);

			$('#editarIdCama').val(respuesta["id"]);
			$('#editarNombreCama').val(respuesta["nombre_cama"]);
			$('#editarDescripcionCama').val(respuesta["descripcion_cama"]);
			$('#editarServicioDS').val(idServicio);
			
		},
		error: function(error) {

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
    success: function(respuesta2) {

      $.each(respuesta2, function(key,value){
        $("#editarSalaDS").append('<option value="'+value.id+'">'+value.nombre_sala+'</option>')
        
      });

      $('#editarSalaDS').val(idSala);

    },
    error: function(error){

      console.log("No funciona");

    }

  });

});

/*=============================================
SI SE CAMBIA EL SERVICIO SE CARGAN LAS SALAS CORRESPONDIENTE AL SERVICIO (EDITAR)
=============================================*/
$(document).on("click", "#editarServicioDS", function() {

  var idServicio = $(this).val();
  console.log("idServicio", idServicio);  

  if(idServicio) {

    $("#editarSalaDS").prop("disabled", false);
    $("#editarSalaDS").empty();
    $("#editarSalaDS").append('<option value="">ELEGIR...</option>');

  }

  var datos = new FormData();

  datos.append("mostrarServicioSalas", 'mostrarServicioSalas');
  datos.append("idServicio", idServicio);

  $.ajax({

    url: "../ajax/salas.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {

      $.each(respuesta, function(key,value){
        $("#editarSalaDS").append('<option value="'+value.id+'">'+value.nombre_sala+'</option>')
        
      });

    },
    error: function(error){

      console.log("No funciona");

    }

  });

});

/*=============================================
GUARDANDO DATOS EDITAR CAMA SERVICIO
=============================================*/
$("#frmEditarCama").on("click", ".btnGuardar", function() {

  // if ($("#frmEditarCama").valid()) {

  var datos = new FormData($("#frmEditarCama")[0]);
  datos.append("editarCama", 'editarCama');

  var idServicio = $("#idServicio").val();
  console.log("idServicio", idServicio);

  $.ajax({

    url:"../ajax/camas.ajax.php",
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

            $("#editarNombreCama").val(""); 

            $("#editarDescripcionCama").val("");

            $("#editarServicioDS").empty();

            $("#editarSalaDS").empty();

            window.location = "../detalle-servicio/"+idServicio;

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

  //  swal.fire({

  //    title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
  //    icon: "error",
  //    allowOutsideClick: false,
  //    confirmButtonText: "¡Cerrar!"

  //  });

  // } 

});