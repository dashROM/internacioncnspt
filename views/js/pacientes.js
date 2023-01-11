/*=============================================
CARGAR LA TABLA DINÁMICA DE PACIENTES
=============================================*/
var tablaPacientes = $('#tblPacientes').DataTable({

	"ajax": {
		url: "ajax/datatable-pacientes.ajax.php",
		// data: { 'perfilOculto' : perfilOculto, 'action' : action },
		type: "post"
	},

	"rowCallback": function(row, data, index) {
		if ( data[18] == "1" ) {
			$('td', row).addClass('table-danger');
			$('tr.child', row).addClass('table-danger');
		}
	},

	"processing": true,
	
	"serverSide": true,

	"order": [[ 0, "desc" ]],

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
FUNCIONES CON LOS DIFERENTES PATRONES CON EXPRESIONES REGULARES PARA LA VALIDACIÓN
=============================================*/
$.validator.addMethod("patron_letras", function (value, element) {

    var pattern = /^[a-zA-Z]+$/;
    return this.optional(element) || pattern.test(value);

}, "El campo debe contener letras (azAZ)");

$.validator.addMethod("patron_numeros", function (value, element) {

    var pattern = /^[0-9]+$/;
    return this.optional(element) || pattern.test(value);

}, "El campo debe tener un valor numérico (0-9)");
  
  $.validator.addMethod("patron_numerosLetras", function (value, element) {

    var pattern = /^[a-zA-Z0-9-]+$/;
    return this.optional(element) || pattern.test(value);

}, "El campo debe tener un valor Alfa Numérico (a-zA-Z0-9)");

$.validator.addMethod("patron_numerosTexto", function (value, element) {

    var pattern = /^[A-Za-z0-9ñÑáéíóúÁÉÍÓÚ .,-]+$/;
    return this.optional(element) || pattern.test(value);

}, "Caracteres Especiales No Admitidos");

$.validator.addMethod("patron_texto", function (value, element) {

    var pattern = /^[A-Za-zñÑáéíóúÁÉÍÓÚ .]+$/;
    return this.optional(element) || pattern.test(value);

}, "Caracteres Especiales No Admitidos");

$.validator.addMethod("patron_textoEspecial", function (value, element) {

    var pattern = /^[^'%${}]+$/;
    return this.optional(element) || pattern.test(value);

}, "Caracteres Especialistas No Admitidos");

/*=============================================
CONFIGURACION DE LAS REGLAS Y MENSAJES PARA VALIDACION
=============================================*/
$(document).ready(function(){
	$("#frmOpcionPaciente").validate({

		rules: {
			selectOpcionPaciente : { required: true },
		},

		messages: {
			selectOpcionPaciente : "Elija una Opción",
		},

	});

});

/*=============================================
CONFIGURACION DE LAS REGLAS Y MENSAJES PARA VALIDACION
=============================================*/
$(document).ready(function(){
  $("#frmNuevoPaciente").validate({

  	rules: {
  		nuevoPaternoPaciente : { patron_texto: true },
  		nuevoMaternoPaciente : { patron_texto: true },
			nuevoNombrePaciente : { patron_numerosTexto: true },
			nuevoDomicilioPaciente : { patron_textoEspecial: true },
			nuevoCodAsegurado : { patron_textoEspecial: true },
			nuevoNroEmpleador : { patron_textoEspecial: true },
			nuevoNombreEmpleador : { patron_textoEspecial: true },
		},

    messages: {
      nuevoSexoPaciente : "Elija una Opción",
      nuevoEstadoCivil : "Elija una Opción",
      nuevoZonaPaciente : "Elija una Zona",
    },

  });

});

/*=============================================
GUARDANDO DATOS DE NUEVO PACIENTE
=============================================*/
$("#frmNuevoPaciente").on("click", ".btnGuardar", function() {

	$(".btnGuardar").prop("disabled", true);

	if ($("#frmOpcionPaciente").valid()) {

		var option = $(selectOpcionPaciente).val();

		if (option == 1) {	

			if ($("#frmBuscarAfiliadoSIAIS").valid()) {		

				if ($("#frmNuevoPaciente").valid()) {
			 
					var datos = new FormData($("#frmNuevoPaciente")[0]);
					datos.append("nuevoPaciente", 'nuevoPaciente');

					$.ajax({

						url: "ajax/pacientes.ajax.php",
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

										window.location = "pacientes";

									}

								});

							} else {

								swal.fire({

									title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
									icon: "error",
									allowOutsideClick: false,
									confirmButtonText: "¡Cerrar!"

								}).then((result) => {

									if (result.value) {
										$(".btnGuardar").prop("disabled", false);
									}

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

			    }).then((result) => {

						if (result.value) {
							$(".btnGuardar").prop("disabled", false);
						}

					});
			    
			  }
			    
			} else {

		    swal.fire({
		        
		      title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
		      icon: "error",
		      allowOutsideClick: false,
		      confirmButtonText: "¡Cerrar!"

		    }).then((result) => {

					if (result.value) {
						$(".btnGuardar").prop("disabled", false);
					}

				});
			    
			}

		} else if (option == 2) {	

			if ($("#frmBuscarAfiliadoERP").valid()) {	

				if ($("#frmNuevoPaciente").valid()) {
			 
					var datos = new FormData($("#frmNuevoPaciente")[0]);
					datos.append("nuevoPaciente", 'nuevoPaciente');

					$.ajax({

						url: "ajax/pacientes.ajax.php",
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

										window.location = "pacientes";

									}

								});

							} else {

								swal.fire({

									title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
									icon: "error",
									allowOutsideClick: false,
									confirmButtonText: "¡Cerrar!"

								}).then((result) => {

									if (result.value) {
										$(".btnGuardar").prop("disabled", false);
									}

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

			    }).then((result) => {

						if (result.value) {
							$(".btnGuardar").prop("disabled", false);
						}

					});
			    
			  }

			} else {

		    swal.fire({
		        
		      title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
		      icon: "error",
		      allowOutsideClick: false,
		      confirmButtonText: "¡Cerrar!"

		    }).then((result) => {

					if (result.value) {
						$(".btnGuardar").prop("disabled", false);
					}

				});
			    
			}

		} else if (option == 3) {

			if ($("#frmNuevoPaciente").valid()) {
			 
				var datos = new FormData($("#frmNuevoPaciente")[0]);
				datos.append("nuevoPaciente", 'nuevoPaciente');

				$.ajax({

					url: "ajax/pacientes.ajax.php",
					method: "POST",
					data: datos,
					cache: false,
					contentType: false,
					processData: false,
					dataType: "json",
					success: function(respuesta) {

						$(".btnGuardar").prop("disabled", true);

						if (respuesta == "ok") {

							swal.fire({

								icon: "success",
								title: "¡Los datos se guardaron correctamente!",
								showConfirmButton: true,
								allowOutsideClick: false,
								confirmButtonText: "Cerrar"

							}).then((result) => {

								if (result.value) {

									window.location = "pacientes";

								}

							});

						} else {

							swal.fire({

								title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
								icon: "error",
								allowOutsideClick: false,
								confirmButtonText: "¡Cerrar!"

							}).then((result) => {

								if (result.value) {
									$(".btnGuardar").prop("disabled", false);
								}

							});

						}

					},
					error: function(error) {

						console.log("No funciona");
						
					}

				});

			} else {

				$(".btnGuardar").prop("disabled", true);

		    swal.fire({
		        
		      title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
		      icon: "error",
		      allowOutsideClick: false,
		      confirmButtonText: "¡Cerrar!"

		    }).then((result) => {

					if (result.value) {
						$(".btnGuardar").prop("disabled", false);
					}

				});
		    
		  }

		}

	} else {

    swal.fire({
        
      title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
      icon: "error",
      allowOutsideClick: false,
      confirmButtonText: "¡Cerrar!"

    }).then((result) => {

			if (result.value) {
				$(".btnGuardar").prop("disabled", false);
			}

		});
    
  }

});

/*=============================================
CARGANDO DATOS DE PERSONA AL FORMULARIO EDITAR PACIENTE
=============================================*/
$(document).on("click", ".btnEditarPaciente", function() {

	var id = $(this).attr("id");
	console.log("id", id);

	var datos = new FormData();
	datos.append("mostrarPaciente", 'mostrarPaciente');
	datos.append("id", id);

	$.ajax({

		url: "ajax/pacientes.ajax.php",
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

			$('#editarId').val(respuesta["id"]);
			$('#editarFechaNacimientoPaciente').val(respuesta["fecha_nacimiento"]);
			$('#editarDocumentoCiPaciente').val(respuesta["documento_ci"]);
			$('#editarNombrePaciente').val(respuesta["nombre_paciente"]);
			$('#editarPaternoPaciente').val(respuesta["paterno_paciente"]);
			$('#editarMaternoPaciente').val(respuesta["materno_paciente"]);
			$('#editarEdadPaciente').val(CalcularEdad(respuesta["fecha_nacimiento"]));
			$('#editarSexoPaciente').val(respuesta["sexo"]);
			$('#editarEstadoCivil').val(respuesta["estado_civil"]);
			$('#editarDomicilioPaciente').val(respuesta["domicilio"]);
			$('#editarTelefonoPaciente').val(respuesta["telefono"]);

			if (respuesta["particular"] == 0) {

				$("#editarParticular").prop('checked', false);

				$('#editarEstadoAsegurado').val(respuesta["estado_asegurado"]);
				$('#editarCodAsegurado').val(respuesta["cod_asegurado"]);
				$('#editarCodBeneficiario').val(respuesta["cod_beneficiario"]);
				$('#editarNroEmpleador').val(respuesta["nro_empleador"]);
				$('#editarNombreEmpleador').val(respuesta["nombre_empleador"]);
				$('#editarZonaPaciente').val(respuesta["id_consultorio"]);

			} else {

				$("#editarParticular").prop('checked', true);

				$(".indicadorParticular").remove();

				$('#editarEstadoAsegurado').prop("readonly",true);
				$("#editarEstadoAsegurado").val('INACTIVO');
				$("#editarEstadoAsegurado").removeAttr('required');

				$('#editarCodAsegurado').prop("readonly",true);
				$('#editarCodAsegurado').val("");
				$("#editarCodAsegurado").removeAttr('required');

				$('#editarCodBeneficiario').prop("disabled", true);
				$('#editarCodBeneficiario').val("");
				$("#editarCodBeneficiario").removeAttr('required');

				$('#editarNroEmpleador').prop("readonly",true);
				$('#editarNroEmpleador').val("");
				$("#editarNroEmpleador").removeAttr('required');

				$('#editarNombreEmpleador').prop("readonly",true);
				$('#editarNombreEmpleador').val("");
				$("#editarNombreEmpleador").removeAttr('required');

				$('#editarZonaPaciente').prop("disabled",true);
				$('#editarZonaPaciente').val("");
				$("#editarZonaPaciente").removeAttr('required');

				$('#buscarEmpleador').prop("disabled", true);

			}


		},
		error: function(error) {

			console.log("No funciona");

		}

	});

});

/*=============================================
CONFIGURACION DE LAS REGLAS Y MENSAJES PARA VALIDACION
=============================================*/
$(document).ready(function(){
  $("#frmEditarPaciente").validate({

  	rules: {
  		editarPaternoPaciente : { patron_texto: true },
  		editarMaternoPaciente : { patron_texto: true },
			editarNombrePaciente : { patron_numerosTexto: true },
			editarDomicilioPaciente : { patron_textoEspecial: true },
			editarCodAsegurado : { patron_textoEspecial: true },
			editarCodBeneficiario : { patron_textoEspecial: true },
			editarNroEmpleador : { patron_textoEspecial: true },
			editarNombreEmpleador : { patron_textoEspecial: true },
		},

    messages: {
      editarSexoPaciente : "Elija una Opción",
      editarEstadoCivil : "Elija una Opción",
      editarZonaPaciente : "Elija una Zona",
    },

  });

});

/*=============================================
GUARDANDO DATOS DE EDITAR PACIENTE
=============================================*/
$("#frmEditarPaciente").on("click", ".btnGuardar", function() {

	if ($("#frmEditarPaciente").valid()) {

		var datos = new FormData($("#frmEditarPaciente")[0]);
		datos.append("editarPaciente", 'editarPaciente');

		$.ajax({

			url:"ajax/pacientes.ajax.php",
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

							$('#modalEditarPaciente').modal('toggle');

							$("#editarFechaNacimientoPaciente").val(""); 
							$("#editarDocumentoCiPaciente").val("");	
							$("#editarPaternoPaciente").val("");
							$("#editarMaternoPaciente").val("");		
							$("#editarNombrePaciente").val("");
							$("#editarEdadPaciente").val("");
							$("#editarSexoPaciente").val("");
							$("#editarEstadoCivil").val("");
							$("#editarEstadoAsegurado").val("");
							$("#editarCodAsegurado").val("");
							$("#editarCodBeneficiario").val("");
							$("#editarNroEmpleador").val("");
							$("#editarNombreEmpleador").val("");
							$("#editarZonaPaciente").val("");
							$("#editarId").val("");

							$(".btnGuardar").prop("disabled", false);  

	  					// Funcion que recarga y actuaiiza la tabla	
	  					tablaPacientes.ajax.reload( null, false );

	  				}

	  			});

				} else {

					swal.fire({

						title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
						icon: "error",
						allowOutsideClick: false,
						confirmButtonText: "¡Cerrar!"

					}).then((result) => {

						if (result.value) {
							$(".btnGuardar").prop("disabled", false);
						}

					});
					
				}

			},
			error: function(error) {

				swal.fire({

					title: "¡Error de conexión a la Base de Datos!",
					icon: "error",
					allowOutsideClick: false,
					confirmButtonText: "¡Cerrar!"

				}).then((result) => {

					if (result.value) {
						$(".btnGuardar").prop("disabled", false);
					}

				});
			}

		});

	} else {

    swal.fire({
        
      title: "¡Los campos obligatorios no puede ir vacio o llevar caracteres especiales!",
      icon: "error",
      allowOutsideClick: false,
      confirmButtonText: "¡Cerrar!"

    }).then((result) => {

			if (result.value) {
				$(".btnGuardar").prop("disabled", false);
			}

		});
    
  }

}); 
/*=============================================
ABRIR VENTANA MAS DETALLE PACIENTE 
=============================================*/
$(document).on("click", ".btnDetallePaciente", function() {

	var id = $(this).attr("id");
	console.log("id", id);

	window.location = "detalle-paciente/"+id;	

});

/*=============================================
BUSCADOR DE DATOS DE AFILIADO ERP
=============================================*/
$("#frmBuscarAfiliadoERP").on("click", "#btnSearch", function() {

	var fecha_nacimiento = $('#fecha_nacimientoERP').val();
	var documento = $('#documentoERP').val();

	console.log("fecha_nacimiento", fecha_nacimiento);
	console.log("documento", documento);

	if(fecha_nacimiento === "" || documento === "") {
		alert("Por favor complete los campos requeridos");
		return;
	}

	$("#error").css("display", "none");
	$("#mensaje").css("display", "block");

	var datos = new FormData();
	datos.append("buscadorAfiliados", "buscadorAfiliados")
	datos.append("fecha_nacimiento", fecha_nacimiento);
	datos.append("documento", documento);

	$.ajax({

		url: "ajax/afiliadosERP.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta) {
			
			console.log("respuesta", respuesta);

			if (respuesta.status == "error") {

				$("#mensaje").css("display", "none");
				$("#error").css("display", "block");

			} else {

				$("#mensaje").css("display", "none");
				$("#error").css("display", "none");

				dato = JSON.parse(respuesta.response);

				console.log("dato", dato);

				var date = new Date(dato.fechaNacimiento);
      	date.setMinutes(date.getMinutes() + date.getTimezoneOffset())

				$("#nuevoDocumentoCiPaciente").val(dato.documentoIdentidad);
				$("#nuevoFechaNacimientoPaciente").val(moment(date).format("DD/MM/YYYY"));

				$("#nuevoPaternoPaciente").val(dato.primerApellido);
				$("#nuevoMaternoPaciente").val(dato.segundoApellido);
				$("#nuevoNombrePaciente").val(dato.nombres);
				$("#nuevoEdadPaciente").val(CalcularEdad(dato.fechaNacimiento));
				$("#nuevoSexoPaciente").val(dato.sexo);
				$("#nuevoSexoPacienteActual").val(dato.sexo);
				$("#nuevoEstadoCivil").val(dato.estadocivil);
				$("#nuevoEstadoCivilActual").val(dato.estadocivil);

				$("#nuevoEstadoAsegurado").val(dato.estadoAsegurado);
				$("#nuevoCodAsegurado").val(dato.matricula.slice(2));
				$("#nuevoCodBeneficiarioActual").val(dato.parentesco);
				$("#nuevoCodBeneficiario").val(dato.parentesco);
				$("#nuevoNroEmpleador").val(dato.nroPatronal);
				$("#nuevoNombreEmpleador").val(dato.razonSocial);

			}

		},
		error: function(error){

			console.log("No funciona");

		}

	});

});

/*=============================================
SELECCIONADOR DE OPCION DE BUSQUEDA DE PACIENTE
=============================================*/
$("#frmOpcionPaciente").on("change", "#selectOpcionPaciente", function() {

	$('#filtroSIAIS').addClass('d-none');

	$('#filtroERP').addClass('d-none');

	$(".indicador").remove();
	$(".indicadorParticular").remove();

	$("#fechaNacimientoCIPaciente").addClass('d-none');

	$("#buscarCodAsegurado").removeAttr('required');

	$("#fecha_nacimientoERP").removeAttr('required');

	$("#documentoERP").removeAttr('required');

	$("#nuevoPaternoPaciente").attr('readonly',true);

	$("#nuevoMaternoPaciente").attr('readonly',true);

	$("#nuevoNombrePaciente").attr('readonly',true);

	$("#selectOpcionPaciente").before('<label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
	
	$("#nuevoSexoPaciente").attr('disabled',true);

	$("#nuevoEstadoCivil").attr('disabled',true);

	$("#nuevoDomicilioPaciente").attr('readonly',true);

	$("#nuevoTelefonoPaciente").attr('readonly',true);

	$("#nuevoEstadoAsegurado").val('');

	$("#nuevoParticular").attr('disabled',true);
	$("#nuevoParticular").prop('checked', false);

	$("#nuevoCodAsegurado").attr('readonly',true);

	$("#nuevoCodBeneficiarioActual").attr('disabled',true);

	$("#nuevoNroEmpleador").attr('readonly',true);

	$("#nuevoNombreEmpleador").attr('readonly',true);

	$("#nuevoZonaPaciente").attr('disabled',true);

	var option = $(this).val();

	if (option == 1) {

		$("#buscarCodAsegurado").attr('required',true);

		$("#filtroSIAIS").removeClass('d-none');

		$("#fechaNacimientoCIPaciente").removeClass('d-none');

		$("#nuevoDocumentoCiPaciente").attr('required',true);
		$("#nuevoDocumentoCiPaciente").before('<label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');

		$("#nuevoFechaNacimientoPaciente").attr('readonly',true);

		$("#nuevoEstadoCivil").removeAttr('disabled');
		$("#nuevoEstadoCivil").attr('required',true);
		$("#nuevoEstadoCivil").before('<label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
		
		$("#nuevoSexoPaciente").removeAttr('disabled');
		$("#nuevoSexoPaciente").attr('required',true);
		$("#nuevoSexoPaciente").before('<label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');

		$("#nuevoDomicilioPaciente").removeAttr('readonly');
		$("#nuevoDomicilioPaciente").attr('required',true);
		$("#nuevoDomicilioPaciente").before('<label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');

		$("#nuevoTelefonoPaciente").removeAttr('readonly');		
		$("#nuevoTelefonoPaciente").attr('required',true);
		$("#nuevoTelefonoPaciente").before('<label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');

		$("#nuevoEstadoAsegurado").val('ACTIVO');

		$("#nuevoZonaPaciente").removeAttr('disabled');		
		$("#nuevoZonaPaciente").attr('required',true);
		$("#nuevoZonaPaciente").before('<label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');

	} else if(option == 2) {

		$("#fecha_nacimientoERP").attr('required',true);
		$("#documentoERP").attr('required',true);

		$("#filtroERP").removeClass('d-none');

		$("#nuevoFechaNacimientoPaciente").removeAttr('required');

		$("#nuevoNombrePaciente").removeAttr('required');

		$("#nuevoSexoPaciente").removeAttr('required');

		$("#nuevoEstadoCivil").removeAttr('required');

		$("#nuevoDomicilioPaciente").removeAttr('readonly');
		$("#nuevoDomicilioPaciente").attr('required',true);
		$("#nuevoDomicilioPaciente").before('<label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');

		$("#nuevoTelefonoPaciente").removeAttr('readonly');		
		$("#nuevoTelefonoPaciente").attr('required',true);
		$("#nuevoTelefonoPaciente").before('<label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');

		$("#nuevoCodAsegurado").removeAttr('required');

		$("#nuevoCodBeneficiarioActual").removeAttr('disabled');

		$("#nuevoNroEmpleador").removeAttr('required');

		$("#nuevoNombreEmpleador").removeAttr('required');

		$("#nuevoZonaPaciente").removeAttr('disabled');
		$("#nuevoZonaPaciente").attr('required',true);
		$("#nuevoZonaPaciente").before('<label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');

	} else if (option == 3) {

		$("#fechaNacimientoCIPaciente").removeClass('d-none');

		$("#nuevoFechaNacimientoPaciente").before('<label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
		$("#nuevoDocumentoCiPaciente").before('<label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');

		$("#nuevoDocumentoCiPaciente").attr('required',true);

		$("#nuevoFechaNacimientoPaciente").removeAttr('readonly');
		$("#nuevoFechaNacimientoPaciente").attr('required',true);

		$("#nuevoPaternoPaciente").removeAttr('readonly');

		$("#nuevoMaternoPaciente").removeAttr('readonly');

		$("#nuevoNombrePaciente").removeAttr('readonly');
		$("#nuevoNombrePaciente").before('<label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
		$("#nuevoNombrePaciente").attr('required',true);

		$("#nuevoSexoPaciente").removeAttr('disabled');		
		$("#nuevoSexoPaciente").before('<label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
		$("#nuevoSexoPaciente").attr('required',true);

		$("#nuevoEstadoCivil").removeAttr('disabled');
		$("#nuevoEstadoCivil").before('<label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
		$("#nuevoEstadoCivil").attr('required',true);

		$("#nuevoDomicilioPaciente").removeAttr('readonly');
		$("#nuevoDomicilioPaciente").before('<label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
		$("#nuevoDomicilioPaciente").attr('required',true);

		$("#nuevoTelefonoPaciente").removeAttr('readonly');
		$("#nuevoTelefonoPaciente").before('<label class="indicador">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
		$("#nuevoTelefonoPaciente").attr('required',true);

		$("#nuevoEstadoAsegurado").val('INACTIVO');

		$("#nuevoParticular").removeAttr('disabled');

		$("#nuevoCodAsegurado").removeAttr('readonly');
		$("#nuevoCodAsegurado").before('<label class="indicadorParticular">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
		$("#nuevoCodAsegurado").attr('required',true);

		$("#nuevoCodBeneficiarioActual").removeAttr('disabled');
		$("#nuevoCodBeneficiarioActual").before('<label class="indicadorParticular">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
		$("#nuevoCodBeneficiarioActual").attr('required',true);

		$("#nuevoNroEmpleador").removeAttr('readonly');
		$("#nuevoNroEmpleador").before('<label class="indicadorParticular">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');  	
		$("#nuevoNroEmpleador").attr('required',true);

		$("#nuevoNombreEmpleador").removeAttr('readonly');
		$("#nuevoNombreEmpleador").before('<label class="indicadorParticular">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
		$("#nuevoNombreEmpleador").attr('required',true);

		$("#nuevoZonaPaciente").removeAttr('disabled');
		$("#nuevoZonaPaciente").before('<label class="indicadorParticular">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
		$("#nuevoZonaPaciente").attr('required',true);
	}

});

/*=============================================
INHABILITAR REGISTRO DE DOCUMENTO CI (NUEVO PACIENTE)
=============================================*/
$("#frmNuevoPaciente").on("change", "#nuevoSinDocumento", function() {

	if ($(this).is(':checked')) {

    $("#nuevoDocumentoCiPaciente").attr('readonly',true);
    $("#nuevoDocumentoCiPaciente").val('SD');

  } else {
	
		$("#nuevoDocumentoCiPaciente").removeAttr('readonly');
		$("#nuevoDocumentoCiPaciente").val('');

  }

});

/*=============================================
HABILITAR REGISTRO DE PACIENTE PARTICULAR (NUEVO PACIENTE)
=============================================*/
$("#frmNuevoPaciente").on("change", "#nuevoParticular", function() {

	if ($(this).is(':checked')) {

		$(".indicadorParticular").remove();

    $("#nuevoCodAsegurado").attr('readonly',true);
    $("#nuevoCodAsegurado").removeAttr('required');
    $("#nuevoCodAsegurado").val('');

		$("#nuevoCodBeneficiarioActual").attr('disabled',true);
		$("#nuevoCodBeneficiarioActual").removeAttr('required');
		$("#nuevoCodBeneficiarioActual").val('');

		$("#nuevoNroEmpleador").attr('readonly',true);
		$("#nuevoNroEmpleador").removeAttr('required');
		$("#nuevoNroEmpleador").val('');

		$("#nuevoNombreEmpleador").attr('readonly',true);
		$("#nuevoNombreEmpleador").removeAttr('required');
		$("#nuevoNombreEmpleador").val('');

		$("#nuevoZonaPaciente").attr('disabled',true);
		$("#nuevoZonaPaciente").removeAttr('required');
		$("#nuevoZonaPaciente").val('');

		$("#nuevoEstadoAsegurado").val('INACTIVO');

  } else {
	
		$("#nuevoCodAsegurado").removeAttr('readonly');
		$("#nuevoCodAsegurado").before('<label class="indicadorParticular">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
		$("#nuevoCodAsegurado").attr('required',true);

		$("#nuevoCodBeneficiarioActual").removeAttr('disabled');
		$("#nuevoCodBeneficiarioActual").before('<label class="indicadorParticular">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
		$("#nuevoCodBeneficiarioActual").attr('required',true);

		$("#nuevoNroEmpleador").removeAttr('readonly');
		$("#nuevoNroEmpleador").before('<label class="indicadorParticular">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');  	
		$("#nuevoNroEmpleador").attr('required',true);

		$("#nuevoNombreEmpleador").removeAttr('readonly');
		$("#nuevoNombreEmpleador").before('<label class="indicadorParticular">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
		$("#nuevoNombreEmpleador").attr('required',true);

		$("#nuevoZonaPaciente").removeAttr('disabled');
		$("#nuevoZonaPaciente").before('<label class="indicadorParticular">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
		$("#nuevoZonaPaciente").attr('required',true);

  }

});

/*=============================================
HABILITAR REGISTRO DE PACIENTE PARTICULAR (EDITAR PACIENTE)
=============================================*/
$("#frmEditarPaciente").on("change", "#editarParticular", function() {

	if ($(this).is(':checked')) {

		$(".indicadorParticular").remove();

    $("#editarCodAsegurado").attr('readonly',true);
    $("#editarCodAsegurado").removeAttr('required');
    $("#editarCodAsegurado").val('');

		$("#editarCodBeneficiario").attr('disabled',true);
		$("#editarCodBeneficiario").removeAttr('required');
		$("#editarCodBeneficiario").val('');

		$("#editarNroEmpleador").attr('readonly',true);
		$("#editarNroEmpleador").removeAttr('required');
		$("#editarNroEmpleador").val('');

		$("#editarNombreEmpleador").attr('readonly',true);
		$("#editarNombreEmpleador").removeAttr('required');
		$("#editarNombreEmpleador").val('');

		$("#editarZonaPaciente").attr('disabled',true);
		$("#editarZonaPaciente").removeAttr('required');
		$("#editarZonaPaciente").val('');

		$("#buscarEmpleador").prop('disabled',true);

		$("#nuevoEstadoAsegurado").val('INACTIVO');

  } else {
	
		$("#editarCodAsegurado").removeAttr('readonly');
		$("#editarCodAsegurado").before('<label class="indicadorParticular">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
		$("#editarCodAsegurado").attr('required',true);

		$("#editarCodBeneficiario").removeAttr('disabled');
		$("#editarCodBeneficiario").before('<label class="indicadorParticular">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
		$("#editarCodBeneficiario").attr('required',true);

		$("#editarNroEmpleador").removeAttr('readonly');
		$("#editarNroEmpleador").before('<label class="indicadorParticular">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');  	
		$("#editarNroEmpleador").attr('required',true);

		$("#editarNombreEmpleador").removeAttr('readonly');
		$("#editarNombreEmpleador").before('<label class="indicadorParticular">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
		$("#editarNombreEmpleador").attr('required',true);

		$("#editarZonaPaciente").removeAttr('disabled');
		$("#editarZonaPaciente").before('<label class="indicadorParticular">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');
		$("#editarZonaPaciente").attr('required',true);

		$("#buscarEmpleador").prop('disabled',false);

  }

});

/*=============================================
REVISAR SI EL CI PERSONA YA ESTÁ REGISTRADO
=============================================*/
$("#nuevoDocumentoCiPaciente").change(function() {

	if ($(this).val() == "") {

		$(this).removeClass('is-valid');

	} else {

		$(".invalid-feedback").remove();
		
		$(this).removeClass('is-invalid');
		$(this).addClass('is-valid');
		
		var documentoCI = $(this).val();

		var datos = new FormData();
		datos.append("validarDocumentoPaciente", documentoCI);

		$.ajax({
			url: "ajax/pacientes.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta) {

				if (respuesta) {

					if (respuesta["documento_ci"] == "SD") {

					} else {

						$("#nuevoDocumentoCiPaciente").after('<div class="invalid-feedback" style="display: none;">Este nro ci ya existe en la base de datos</div>');				

						$("#nuevoDocumentoCiPaciente").addClass('is-invalid');
						
						$(".invalid-feedback").show('fast');

						$("#nuevoDocumentoCiPaciente").val('');

						$("#nuevoDocumentoCiPaciente").after().removeClass('mb-3');

					}

				} 

			}

		});

	}

});

/*=============================================
BUSQUEDA DE AFILIADO A PARTIR DEL NOMBRE O COD ASEGURADO POR EL BOTON BUSCAR
=============================================*/
$(document).on("click", ".btnBuscarAfiliado", function() {

	var afiliado = $("#buscardorAfiliado").val();
	console.log("afiliado", afiliado);

	if (afiliado != "") {

		var datos = new FormData();
		datos.append("afiliado", afiliado);
		datos.append("mostrarAfiliados", "mostrarAfiliados");

		//Para mostrar alerta personalizada de loading
		swal.fire({
			text: 'Procesando...',
			allowOutsideClick: false,
			allowEscapeKey: false,
			allowEnterKey: false,
			onOpen: () => {
				swal.showLoading()
			}
		});

		$.ajax({

			url: "ajax/datatable-afiliadosSIAIS.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success: function(respuesta) {	

				//Para cerrar la alerta personalizada de loading
				swal.close();					

				$('#tablaAfiliadosSIAIS').remove();
				$('#tablaAfiliadosSIAIS_wrapper').remove();

				$("#tblAfiliadosSIAIS").append(

				'<table class="table table-bordered table-hover dt-responsive" id="tablaAfiliadosSIAIS" width="100%">'+

					'<thead class="text-light bg-primary">'+

						'<tr>'+
							'<th>APELLIDOS Y NOMBRES</th>'+
							'<th>COD. ASEGURADO</th>'+
							'<th>COD. BENEFICIARIO</th>'+
							'<th>FECHA NACIMIENTO</th>'+
							'<th>COD. EMPLEADOR</th>'+
							'<th>NOMBRE EMPLEADOR</th>'+
						'</tr>'+

					'</thead>'+

				'</table>'  

				);       			

				var t = $('#tablaAfiliadosSIAIS').DataTable({

					"data": respuesta,

					"columns": [
					{ data: "nombre_completo" },
					{ data: "cod_asegurado" },
					{ data: "cod_beneficiario" },
					{ render: function (data, type, row) {
						var date = new Date(row.fecha_nacimiento);
						date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
						return (moment(date).format("DD-MM-YYYY"));
					}},
					{ data: "cod_empleador" },
					{ data: "nombre_empleador" },
					],

					"deferRender": true,

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
						"searchPlaceholder": "Escribe aquí para buscar...",
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
						}
						
					},

					"lengthChange": false,

					"searching": true,

					"ordering": true, 

					"info":     false 

				});

				$('#tablaAfiliadosSIAIS tbody').on('click', 'tr', function () {

					$(this).addClass("pe-auto");
					
					var data = t.row( this ).data();

					var idAfiliado = data.idafiliacion;
					console.log("idAfiliado", idAfiliado);

					var datos = new FormData();
					datos.append("mostrarAfiliado", "mostrarAfiliado");
					datos.append("idAfiliado", idAfiliado);

					//Para mostrar alerta personalizada de loading
					swal.fire({
						text: 'Procesando...',
						allowOutsideClick: false,
						allowEscapeKey: false,
						allowEnterKey: false,
						onOpen: () => {
							swal.showLoading()
						}
					});

					$.ajax({

						url:"ajax/afiliadosSIAIS.ajax.php",
						method: "POST",
						data: datos,
						cache: false,
						contentType: false,
						processData: false,
						dataType:"json",
						success:function(respuesta) {
							console.log("respuestaAfiliacion", respuesta);

							//Para cerrar la alerta personalizada de loading
							swal.close();

							var id = respuesta["idafiliacion"];
							var codAsegurado = respuesta["pac_numero_historia"];
							var codAfiliado = respuesta["pac_codigo"].slice(10);
							var nroEmpleador = respuesta["emp_nro_empleador"];
							var nombreEmpleador = respuesta["emp_nombre"];
							var paterno = respuesta["pac_primer_apellido"];
							var materno = respuesta["pac_segundo_apellido"];
							var nombre = respuesta["pac_nombre"];
							var fechaNacimiento = respuesta["pac_fecha_nac"];
							var sexo =  respuesta[""]
							var edad = CalcularEdad(fechaNacimiento);

							$('#buscarCodAsegurado').empty().prepend("<option value='"+codAsegurado+"' >"+codAsegurado+"</option>");
							$('#nuevoCodAsegurado').val(codAsegurado);
							$('#nuevoNroEmpleador').val(nroEmpleador);
							$('#nuevoCodBeneficiario').val(codAfiliado);
							$('#nuevoCodBeneficiarioActual').val(codAfiliado);
							$('#nuevoNombreEmpleador').val(nombreEmpleador);
							$('#nuevoEstadoAsegurado').val("ACTIVO");
							$('#nuevoPaternoPaciente').val(paterno);
							$('#nuevoMaternoPaciente').val(materno);
							$('#nuevoNombrePaciente').val(nombre);
							$('#nuevoFechaNacimientoPaciente').val(fechaNacimiento);
							$('#nuevoEdadPaciente').val(edad);
							
							$('#modalCodAsegurado').modal('toggle');
             	$('#modalNuevoPaciente').modal('show');

						},
						error: function(error) {

							console.log('¡Error! Falla en la consulta a BD, no se modificaron.')

						}

					});
				});

			},
			error: function(error){

				console.log("No funciona");

			}

		});

	} else {
		
		$('#tablaAfiliadosSIAIS').remove();
		$('#tablaAfiliadosSIAIS_wrapper').remove();

	}

});

/*=============================================
BUSQUEDA DE AFILIADO A PARTIR DEL NOMBRE O COD ASEGURADO POR LA TECLA ENTER
=============================================*/
$(document).on("keypress", "#buscardorAfiliado", function(e) {

	if (e.which == 13) {

		var afiliado = $("#buscardorAfiliado").val();

		if (afiliado != "") {

			var datos = new FormData();
			datos.append("afiliado", afiliado);
			datos.append("mostrarAfiliados", "mostrarAfiliados");

			//Para mostrar alerta personalizada de loading
			swal.fire({
				text: 'Procesando...',
				allowOutsideClick: false,
				allowEscapeKey: false,
				allowEnterKey: false,
				onOpen: () => {
					swal.showLoading()
				}
			});

			$.ajax({

				url: "ajax/datatable-afiliadosSIAIS.ajax.php",
				method: "POST",
				data: datos,
				cache: false,
				contentType: false,
				processData: false,
				dataType: "json",
				success: function(respuesta) {	

					//Para cerrar la alerta personalizada de loading
					swal.close();					

					$('#tablaAfiliadosSIAIS').remove();
					$('#tablaAfiliadosSIAIS_wrapper').remove();

					$("#tblAfiliadosSIAIS").append(

					'<table class="table table-bordered table-hover dt-responsive" id="tablaAfiliadosSIAIS" width="100%">'+

						'<thead class="text-light bg-primary">'+

							'<tr>'+
								'<th>APELLIDOS Y NOMBRES</th>'+
								'<th>COD. ASEGURADO</th>'+
								'<th>COD. BENEFICIARIO</th>'+
								'<th>FECHA NACIMIENTO</th>'+
								'<th>COD. EMPLEADOR</th>'+
								'<th>NOMBRE EMPLEADOR</th>'+
							'</tr>'+

						'</thead>'+

					'</table>'  

					);       			

					var t = $('#tablaAfiliadosSIAIS').DataTable({

						"data": respuesta,

						"columns": [
						{ data: "nombre_completo" },
						{ data: "cod_asegurado" },
						{ data: "cod_beneficiario" },
						{ render: function (data, type, row) {
							var date = new Date(row.fecha_nacimiento);
							date.setMinutes(date.getMinutes() + date.getTimezoneOffset())
							return (moment(date).format("DD-MM-YYYY"));
						}},
						{ data: "cod_empleador" },
						{ data: "nombre_empleador" },
						],

						"deferRender": true,

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
							"searchPlaceholder": "Escribe aquí para buscar...",
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
							}
							
						},

						"lengthChange": false,

						"searching": true,

						"ordering": true, 

						"info":     false 

					});

					$('#tablaAfiliadosSIAIS tbody').on('click', 'tr', function () {

						$(this).addClass("pe-auto");
						
						var data = t.row( this ).data();
						console.log("data", data);

						var idAfiliado = data.idafiliacion;
						console.log("idAfiliado", idAfiliado);

						var datos = new FormData();
						datos.append("mostrarAfiliado", "mostrarAfiliado");
						datos.append("idAfiliado", idAfiliado);

						//Para mostrar alerta personalizada de loading
						swal.fire({
							text: 'Procesando...',
							allowOutsideClick: false,
							allowEscapeKey: false,
							allowEnterKey: false,
							onOpen: () => {
								swal.showLoading()
							}
						});

						$.ajax({

							url:"ajax/afiliadosSIAIS.ajax.php",
							method: "POST",
							data: datos,
							cache: false,
							contentType: false,
							processData: false,
							dataType:"json",
							success:function(respuesta) {
								console.log("respuestaAfiliacion", respuesta);

								//Para cerrar la alerta personalizada de loading
								swal.close();

								var id = respuesta["idafiliacion"];
								var codAsegurado = respuesta["pac_numero_historia"];
								var codAfiliado = respuesta["pac_codigo"].slice(10);
								var nroEmpleador = respuesta["emp_nro_empleador"];
								var nombreEmpleador = respuesta["emp_nombre"];
								var paterno = respuesta["pac_primer_apellido"];
								var materno = respuesta["pac_segundo_apellido"];
								var nombre = respuesta["pac_nombre"];
								var fechaNacimiento = respuesta["pac_fecha_nac"];
								var sexo =  respuesta[""]
								var edad = CalcularEdad(fechaNacimiento);

								$('#buscarCodAsegurado').empty().prepend("<option value='"+codAsegurado+"' >"+codAsegurado+"</option>");
								$('#nuevoCodAsegurado').val(codAsegurado);
								$('#nuevoNroEmpleador').val(nroEmpleador);
								$('#nuevoCodBeneficiario').val(codAfiliado);
								$('#nuevoCodBeneficiarioActual').val(codAfiliado);
								$('#nuevoNombreEmpleador').val(nombreEmpleador);
								$('#nuevoEstadoAsegurado').val("ACTIVO");
								$('#nuevoPaternoPaciente').val(paterno);
								$('#nuevoMaternoPaciente').val(materno);
								$('#nuevoNombrePaciente').val(nombre);
								$('#nuevoFechaNacimientoPaciente').val(fechaNacimiento);
								$('#nuevoEdadPaciente').val(edad);
								
								$('#modalCodAsegurado').modal('toggle');
	             	$('#modalNuevoPaciente').modal('show');

							},
							error: function(error) {

								console.log('¡Error! Falla en la consulta a BD, no se modificaron.')

							}

						});
					});

				},
				error: function(error){

					console.log("No funciona");

				}

			});

		} else {
			
			$('#tablaAfiliadosSIAIS').remove();
			$('#tablaAfiliadosSIAIS_wrapper').remove();

		}

	}

});

/*=============================================
CALCULAR LA EDAD A PARTIR DE FECHA DE NACIMIENTO (NUEVO PACIENTE)
=============================================*/
$("#frmNuevoPaciente").on("change", "#nuevoFechaNacimientoPaciente", function() {

	var fecha_nacimiento = $(this).val();

	var edad = CalcularEdad(fecha_nacimiento);

	$('#nuevoEdadPaciente').val(edad);

});

/*=============================================
CALCULAR LA EDAD A PARTIR DE FECHA DE NACIMIENTO (EDITAR PACIENTE)
=============================================*/
$("#frmEditarPaciente").on("change", "#editarFechaNacimientoPaciente", function() {

	var fecha_nacimiento = $(this).val();

	var edad = CalcularEdad(fecha_nacimiento);

	$('#editarEdadPaciente').val(edad);

});

/*=============================================
FUNCION QUE CALCULA LA EDAD DE UNA FECHA DADA
=============================================*/
function CalcularEdad(edad){

	var fecha_selecionada = edad;
	var fechaNacimiento = new Date(fecha_selecionada);
	var fechaActual = new Date(); 
	edad = (parseInt((fechaActual - fechaNacimiento)/(1000*60*60*24*365)));
	return edad;
	
}

/*=============================================
PARA HABILITAR INPUT MASK EN FORMULARIO
=============================================*/
$(":input").inputmask();

/*=============================================
FUNCION QUE TRASPASA EL NRO PATRONAL Y RAZON SOCIAL AL FORMULARIO EDITAR PACIENTE
=============================================*/
$(document).ready(function() {

	$('#tblEmpleadoresSIAIS tbody').on('click', 'tr', function () {

		$(this).addClass("pe-auto");
		
		var data = tablaEmpleadoresSIAIS.row(this).data();

		var idEmpleador = data[3];

		var datos = new FormData();
		datos.append("mostrarEmpleador", "mostrarEmpleador");
		datos.append("idEmpleador", idEmpleador);

		//Para mostrar alerta personalizada de loading
		swal.fire({
			text: 'Procesando...',
			allowOutsideClick: false,
			allowEscapeKey: false,
			allowEnterKey: false,
			onOpen: () => {
				swal.showLoading()
			}
		});

		$.ajax({

			url:"ajax/empleadoresSIAIS.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType:"json",
			success:function(respuesta) {
				console.log("respuestaEmpleador", respuesta);

				//Para cerrar la alerta personalizada de loading
				swal.close();

				// var id = respuesta["idempleador"];
				var nroEmpleador = respuesta["emp_nro_empleador"];
				var nombreEmpleador = respuesta["emp_nombre"];

				$('#editarNroEmpleador').val(nroEmpleador);
				$('#editarNombreEmpleador').val(nombreEmpleador);
				
				$('#modalEmpleadorSIAIS').modal('toggle');
	     	$('#modalEditarPaciente').modal('show');

			},
			error: function(error) {

				console.log('¡Error! Falla en la consulta a BD, no se modificaron.')

			}

		});

	});

});

/*=============================================
CARGAR LA TABLA DINÁMICA DE PACIENTES
=============================================*/
var tablaEmpleadoresSIAIS = $('#tblEmpleadoresSIAIS').DataTable({

	"ajax": {
		url: "ajax/datatable-empleadoresSIAIS.ajax.php",
		type: "post"
	},

	// "processing": true,
	
	// "serverSide": true,

	// "order": [[ 0, "desc" ]],

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