/*=============================================
TABLA DE MATERNIDAD
=============================================*/
var tablaMaternidades = $('#tblMaternidades').DataTable({

  "ajax": {
    url: "ajax/datatable-maternidades.ajax.php",
    data: { 'maternidades' : 'maternidades'},
    type: "post"
  },

  "destroy": true,

  "deferRender": true,

  "retrieve" : true,

  "processing" : true,

  "serverSide": true,

  "ordering": false,

  "pageLength": 20,

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
PASAR PARAMETROS A VENTANA MODAL NUEVA MATERNIDAD
=============================================*/
$(document).on("click", ".btnNuevaMaternidad", function() {

  $("#fechaIngresoM").empty();
  $("#horaIngresoM").empty();
  $("#diagnosticoIngresoM").empty();
  $("#diagnosticosEspecificosM").empty();
  $("#servicioIngresoM").empty();
  $("#salaIngresoM").empty();
  $("#camaIngresoM").empty();

  $("#transferencias").empty();

	var idPacienteIngreso = $(this).attr("idPacienteIngreso");
	var fecha_ingreso = $(this).attr("fechaIngreso");
  console.log("fecha_ingreso", fecha_ingreso);

	$("#idPacienteIngresoM").val(idPacienteIngreso);
	// $("#nuevoFechaIngresoPaciente").val(fecha_ingreso);

	//pasar fecha de ingreso a formulario de egreso paciente para control
	$("#nuevoFechaParto").attr("min", fecha_ingreso);

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
      
      $("#fechaIngresoM").append(moment(date).format("DD/MM/YYYY"));
      $("#horaIngresoM").append(respuesta['hora_ingreso']);
      $("#diagnosticoIngresoM").append(respuesta['diagnostico']);
      $("#diagnosticosEspecificosM").append(respuesta['diagnostico_especifico1']+' - '+respuesta['diagnostico_especifico2']+' - '+respuesta['diagnostico_especifico3']);
      $("#servicioIngresoM").append(respuesta['nombre_servicio']+' - '+respuesta['nombre_especialidad']);
      $("#salaIngresoM").append(respuesta['nombre_sala']);
      $("#camaIngresoM").append(respuesta['nombre_cama']);

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

        $("#transferenciasM").append(

          '<tr>'+

            '<td>'+moment(date).format("DD/MM/YYYY")+'</td>'+
            '<td>'+value.servicio_ini+'</td>'+
            '<td>'+value.servicio_fin+'</td>'+
            '<td>'+value.diagnostico_transferencia+'</td>'+  

          '</tr>'

        );
        
      });

      //pasar fecha de ingreso a formulario de egreso paciente para control
      $("#nuevoFechaParto").attr("min", respuesta[i]["fecha_transferencia"]);

    },
    error: function(error) {

      console.log("No funciona");

    }

  });

});

/*=============================================
SI SE CAMBIA EL TIPO DE PARTO
=============================================*/
$(document).on("change", "#nuevoTipoParto", function() {

  $(".indicadorCesarea").remove();

  var tipoParto = $(this).val(); 
  
  if (tipoParto == "EUTOCICO" || tipoParto == "DISTOCICO") {

  	// $("#nuevoTipoParto").removeAttr("disabled");
   //  $("#nuevoTipoParto").prop("required", true);
   //  $("#nuevoTipoParto").before('<label class="indicadorCesarea">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');

    // $("#nuevoLiquidoAmniotico").removeAttr("disabled");
    $("#nuevoLiquidoAmniotico").prop("required", true);
    $("#nuevoLiquidoAmniotico").before('<label class="indicadorCesarea">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');

    $("#nuevoAlumbramiento").removeAttr("disabled");
    $("#nuevoAlumbramiento").prop("required", true);
    $("#nuevoAlumbramiento").before('<label class="indicadorCesarea">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');

    $("#nuevoPerine").removeAttr("disabled");
    $("#nuevoPerine").prop("required", true);
    $("#nuevoPerine").before('<label class="indicadorCesarea">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');

    // $("#nuevoSangrado").removeAttr("disabled");
    $("#nuevoSangrado").prop("required", true);
    $("#nuevoSangrado").before('<label class="indicadorCesarea">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');

  } else if(tipoParto == "CESAREA") {

  	$(".indicadorCesarea").remove();

  	// $("#nuevoTipoParto").prop("disabled", true);
   //  $("#nuevoTipoParto").removeAttr('required');
   //  $("#nuevoTipoParto").val("");

    // $("#nuevoLiquidoAmniotico").prop("disabled", true);
    $("#nuevoLiquidoAmniotico").removeAttr('required');
    $("#nuevoLiquidoAmniotico").val("");

  	$("#nuevoAlumbramiento").prop("disabled", true);
    $("#nuevoAlumbramiento").removeAttr('required');
    $("#nuevoAlumbramiento").val("");

    $("#nuevoPerine").prop("disabled", true);
    $("#nuevoPerine").removeAttr('required');
    $("#nuevoPerine").val("");

    // $("#nuevoSangrado").prop("disabled", true);
    $("#nuevoSangrado").removeAttr('required');
    $("#nuevoSangrado").val("");
   
  }

});



/*=============================================
CONFIGURACION DE LAS REGLAS Y MENSAJES PARA VALIDACION (NUEVO MATERNIDAD)
=============================================*/
$(document).ready(function(){

  $("#frmNuevaMaternidad").validate({

    rules: {

      nuevoParidad : { patron_numeros: true },
      nuevoCursoEmbarazo : { patron_numerosTexto: true },
      nuevoPesoNacido : { patron_numerosTexto: true },

    },

    messages: {
      nuevoProcedencia : "Elija una Opción",
      nuevoTipoParto : "Elija un Tipo de Parto",
      nuevoLiquidoAmniotico : "Elija una Opción",
      // nuevoSexoNacido : "Elija una Opción",
      nuevoEstadoNacido : "Elija una Opción",
      nuevoAlumbramiento : "Elija una Opción",
      nuevoPerine : "Elija una Opción",
      nuevoSangrado : "Elija una Opción",
      nuevoEstadoMadre : "Elija una Opción",
      nuevoFechaParto: {
        required: "Ingrese una fecha de nacimiento",
        min: function (p, element) {
            return "Debe ser una fecha mayor o igual a " + formatoFecha(p);
        }
      }
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
GUARDANDO DATOS DE MATERNIDAD
=============================================*/
$("#frmNuevaMaternidad").on("click", ".btnGuardar", function() {

  $(".btnGuardar").prop("disabled", true);

  if ($("#frmNuevaMaternidad").valid()) {

    var datos = new FormData($("#frmNuevaMaternidad")[0]);
  	datos.append("nuevoMaternidad", 'nuevoMaternidad');

  	$.ajax({

  		url:"../ajax/maternidades.ajax.php",
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

    						 $('#modalNuevaMaternidad').modal('toggle');

  							 $("#nuevoProcedencia").val("");  							 
  							 $("#nuevoParidad").val("");
  							 $("#nuevoEdadGestacional").val("");
  							 $("#nuevoTipoParto").val("");		
  							 $("#nuevoLiquidoAmniotico").val("");
  							 $("#nuevoFechaParto").val("");
  							 $("#nuevoHoraParto").val("");
  							 $("#nuevoPesoNacimiento").val("");
  							 $("#nuevoSexoNacimiento").val("");
  							 $("#nuevoAlumbramiento").val("");
  							 $("#nuevoPerine").val("");
  							 $("#nuevoSangrado").val("");
  							 $("#nuevoEstadoMadre").val("");
  							 $("#nuevoNombreEsposo").val("");

                 $(".btnGuardar").prop("disabled", false);

  	  					// Funcion que recarga y actuaiiza la tabla
  							tablaPacienteIngresos.ajax.reload( null, false );

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
              
          title: "¡Error en al conexión a la Base de Datos!",
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
PASAR PARAMETROS A VENTANA MODAL EDITAR MATERNIDAD
=============================================*/
$(document).on("click", ".btnEditarMaternidad", function() {

  $("#fechaIngresoEM").empty();
  $("#horaIngresoEM").empty();
  $("#diagnosticoIngresoEM").empty();
  $("#diagnosticosEspecificosEM").empty();
  $("#servicioIngresoEM").empty();
  $("#salaIngresoEM").empty();
  $("#camaIngresoEM").empty();

  $("#transferencias").empty();

  var idPacienteIngreso = $(this).attr("idPacienteIngreso");
  var fecha_ingreso = $(this).attr("fecha_ingreso");

  $("#idPacienteIngresoEM").val(idPacienteIngreso);
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
      
      $("#fechaIngresoEM").append(moment(date).format("DD/MM/YYYY"));
      $("#horaIngresoEM").append(respuesta['hora_ingreso']);
      $("#diagnosticoIngresoEM").append(respuesta['diagnostico']);
      $("#diagnosticosEspecificosEM").append(respuesta['diagnostico_especifico1']+' - '+respuesta['diagnostico_especifico2']+' - '+respuesta['diagnostico_especifico3']);
      $("#servicioIngresoEM").append(respuesta['nombre_servicio']);
      $("#salaIngresoEM").append(respuesta['nombre_sala']);
      $("#camaIngresoEM").append(respuesta['nombre_cama']);

    },
    error: function(error) {

      swal.fire({
              
        title: "¡Error en al conexión a la Base de Datos!",
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

        $("#transferenciasEM").append(

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

      swal.fire({
              
        title: "¡Error en al conexión a la Base de Datos!",
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

  //para obtener los datos de maternidad
  var datos3 = new FormData();
  datos3.append("mostrarMaternidad", 'mostrarMaternidad');
  datos3.append("idPacienteIngreso", idPacienteIngreso);

  $.ajax({

    url: "../ajax/maternidades.ajax.php",
    method: "POST",
    data: datos3,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {
      console.log("respuesta", respuesta);

      $("#editarProcedencia").val(respuesta['procedencia']);
      $("#editarParidad").val(respuesta['paridad']);
      $("#editarEdadGestacional").val(respuesta['edad_gestacional']);
      $("#editarTipoParto").val(respuesta['tipo_parto']);
      $("#editarLiquidoAmniotico").val(respuesta['liquido_amniotico']);
      $("#editarFechaParto").val(respuesta['fecha_nacido']);
      $("#editarHoraParto").val(respuesta['hora_nacido']);
      $("#editarPesoNacido1").val(respuesta['peso_nacido1']);
      $("#editarSexoNacido1").val(respuesta['sexo_nacido1']);
      $("#editarPesoNacido2").val(respuesta['peso_nacido2']);
      $("#editarSexoNacido2").val(respuesta['sexo_nacido2']);
      $("#editarPesoNacido3").val(respuesta['peso_nacido3']);
      $("#editarSexoNacido3").val(respuesta['sexo_nacido3']);
      $("#editarEstadoNacido").val(respuesta['estado_nacido']);
      $("#editarAlumbramiento").val(respuesta['alumbramiento']);
      $("#editarPerine").val(respuesta['perine']);
      $("#editarSangrado").val(respuesta['sangrado']);
      $("#editarEstadoMadre").val(respuesta['estado_madre']);
      $("#editarNombreEsposo").val(respuesta['nombre_esposo']);
      $("#idPacienteIngresoEM").val(respuesta['id_paciente_ingreso']);
      $("#idMaternidad").val(respuesta['id']);

    },
    error: function(error) {

      swal.fire({
              
        title: "¡Error en al conexión a la Base de Datos!",
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

});

/*=============================================
SI SE CAMBIA EL TIPO DE PARTO (EDITAR)
=============================================*/
$(document).on("change", "#editarTipoParto", function() {

  $(".indicadorCesarea").remove();

  var tipoParto = $(this).val(); 
  
  if (tipoParto == "EUTOCICO" || tipoParto == "DISTOCICO") {

    // $("#editarTipoParto").removeAttr("disabled");
   //  $("#editarTipoParto").prop("required", true);
   //  $("#editarTipoParto").before('<label class="indicadorCesarea">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');

    // $("#editarLiquidoAmniotico").removeAttr("disabled");
    $("#editarLiquidoAmniotico").prop("required", true);
    $("#editarLiquidoAmniotico").before('<label class="indicadorCesarea">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');

    $("#editarAlumbramiento").removeAttr("disabled");
    $("#editarAlumbramiento").prop("required", true);
    $("#editarAlumbramiento").before('<label class="indicadorCesarea">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');

    $("#editarPerine").removeAttr("disabled");
    $("#editarPerine").prop("required", true);
    $("#editarPerine").before('<label class="indicadorCesarea">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');

    // $("#editarSangrado").removeAttr("disabled");
    $("#editarSangrado").prop("required", true);
    $("#editarSangrado").before('<label class="indicadorCesarea">(<i class="fas fa-asterisk asterisk mr-1"></i>)</label>');

  } else if(tipoParto == "CESAREA") {

    $(".indicadorCesarea").remove();

    // $("#editarTipoParto").prop("disabled", true);
   //  $("#editarTipoParto").removeAttr('required');
   //  $("#editarTipoParto").val("");

    // $("#editarLiquidoAmniotico").prop("disabled", true);
    $("#editarLiquidoAmniotico").removeAttr('required');
    $("#editarLiquidoAmniotico").val("");

    $("#editarAlumbramiento").prop("disabled", true);
    $("#editarAlumbramiento").removeAttr('required');
    $("#editarAlumbramiento").val("");

    $("#editarPerine").prop("disabled", true);
    $("#editarPerine").removeAttr('required');
    $("#editarPerine").val("");

    // $("#editarSangrado").prop("disabled", true);
    $("#editarSangrado").removeAttr('required');
    $("#editarSangrado").val("");
   
  }

});

/*=============================================
CONFIGURACION DE LAS REGLAS Y MENSAJES PARA VALIDACION (EDITAR MATERNIDAD)
=============================================*/
$(document).ready(function(){
  $("#frmEditarMaternidad").validate({

    rules: {

      editarParidad : { patron_numeros: true },
      editarCursoEmbarazo : { patron_numerosTexto: true },
      editarPesoNacido : { patron_numerosTexto: true },

    },

    messages: {
      editarProcedencia : "Elija una Opción",
      editarTipoParto : "Elija un Tipo de Parto",
      editarLiquidoAmniotico : "Elija una Opción",
      editarSexoNacido : "Elija una Opción",
      editarEstadoNacido : "Elija una Opción",
      editarAlumbramiento : "Elija una Opción",
      editarPerine : "Elija una Opción",
      editarSangrado : "Elija una Opción",
      editarEstadoMadre : "Elija una Opción",
      editarFechaParto: {
        required: "Ingrese una fecha de nacimiento",
        min: function (p, element) {
            return "Debe ser una fecha mayor o igual a " + formatoFecha(p);
        }
      }
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
GUARDANDO CAMBIOS DE MATERNIDAD
=============================================*/
$("#frmEditarMaternidad").on("click", ".btnGuardar", function() {

  $(".btnGuardar").prop("disabled", true);

  if ($("#frmEditarMaternidad").valid()) {

    var datos = new FormData($("#frmEditarMaternidad")[0]);
    datos.append("editarMaternidad", 'editarMaternidad');

    $.ajax({

      url:"../ajax/maternidades.ajax.php",
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

              $('#modalEditarMaternidad').modal('toggle');

              $("#editarProcedencia").val(""); 
              $("#editarParidad").val("");
              $("#editarEdadGestacional").val("");
              $("#editarTipoParto").val("");    
              $("#editarLiquidoAmniotico").val("");
              $("#editarFechaParto").val("");
              $("#editarHoraParto").val("");
              $("#editarPesoNacimiento").val("");
              $("#editarSexoNacimiento").val("");
              $("#editarAlumbramiento").val("");
              $("#editarPerine").val("");
              $("#editarSangrado").val("");
              $("#editarEstadoMadre").val("");
              $("#editarNombreEsposo").val("");

              $(".btnGuardar").prop("disabled", false);

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

          }).then((result) => {

            if (result.value) {
              $(".btnGuardar").prop("disabled", false);
            }

          });
          
        }

      },
      error: function(error) {

        swal.fire({
              
          title: "¡Error en al conexión a la Base de Datos!",
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
FILTRAR LISTADO DE MATERNIDADES POR FECHA DE INGRESO
=============================================*/
$("#frmMaternidades").on("click", "#btnBuscarMaternidades", function() {

  var fechaIni = $("#fechaIniMaternidades").val();
  var fechaFin = $("#fechaFinMaternidades").val(); 

  tablaMaternidades.destroy();         

  tablaMaternidades = $('#tblMaternidades').DataTable({

    "ajax": {
      url: "ajax/datatable-maternidades.ajax.php",
      data: { 'fechaIni' : fechaIni, 'fechaFin' : fechaFin, 'BuscarFechaMaternidades' : 'BuscarFechaMaternidades' },
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
        title:     'Reporte Maternidades '+fechaIni+'_'+fechaFin,
        text:      '<i class="fas fa-file-excel"></i> Generar EXCEL',
        titleAttr: 'Exportar a Excel',
        className: 'btn btn-success'
      } 
    ]    

  });

});

/*=============================================
PARA HABILITAR INPUT MASK EN FORMULARIO
=============================================*/
$(":input").inputmask();