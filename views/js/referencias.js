/*=============================================
CONFIGURACION DE LAS REGLAS Y MENSAJES PARA VALIDACION (NUEVO NEONATO)
=============================================*/
$(document).ready(function(){
  $("#frmNuevoReferencia").validate({

    messages: {
      nuevoEstablecimientoRef : "Elija un Establecimiento de Referencia",
    },

  });

});

/*=============================================
PASAR PARAMETROS A VENTANA MODAL NUEVA REFERENCIA
=============================================*/
$(document).on("click", ".btnNuevoReferencia", function() {

  var idPacienteIngreso = $(this).attr("idPacienteIngreso");

  $("#idPacienteIngresoR").val(idPacienteIngreso);


});

/*=============================================
GUARDANDO DATOS DE REFERENCIA
=============================================*/
$("#frmNuevoReferencia").on("click", ".btnGuardar", function() {

  if ($("#frmNuevoReferencia").valid()) {

    var datos = new FormData($("#frmNuevoReferencia")[0]);
    datos.append("nuevoReferencia", 'nuevoReferencia');

    $.ajax({

      url:"../ajax/referencias.ajax.php",
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

                $('#modalNuevoReferencia').modal('toggle');

                $("#nuevoEstablecimientoRef").val("");
                $("#nuevoRefAdecuado").prop("checked",false);
                $("#nuevoRefJustificado").prop("checked",false);    
                $("#nuevoRefOportuno").prop("checked",false);

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
PASAR PARAMETROS A VENTANA MODAL EDITAR REFERENCIA
=============================================*/
$(document).on("click", ".btnEditarReferencia", function() {

  var idPacienteIngreso = $(this).attr("idPacienteIngreso");

  $("#idPacienteIngresoER").val(idPacienteIngreso);

  console.log("btnEditarReferencia", "btnEditarReferencia");

  //para obtener los datos de referencia
  var datos = new FormData();
  datos.append("mostrarReferencia", 'mostrarReferencia');
  datos.append("idPacienteIngreso", idPacienteIngreso);

  $.ajax({

    url: "../ajax/referencias.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {
      console.log("respuesta", respuesta);

      $("#editarEstablecimientoRef").val(respuesta['id_establecimiento']);
      if (respuesta['adecuado'] == 1) {
        $("#editarRefAdecuado").prop("checked",true);
      } else {
        $("#editarRefAdecuado").prop("checked",false);
      }
      if (respuesta['justificado'] == 1) {
        $("#editarRefJustificado").prop("checked",true);
      } else {
        $("#editarRefJustificado").prop("checked",false);
      }
      if (respuesta['oportuno'] == 1) {
        $("#editarRefOportuno").prop("checked",true);
      } else {
        $("#editarRefOportuno").prop("checked",false);
      }
      $("#idPacienteIngresoER").val(respuesta['id_paciente_ingreso']);
      $("#idReferencia").val(respuesta['id']);

    },
    error: function(error) {

      console.log("No funciona");

    }

  });

});

/*=============================================
CONFIGURACION DE LAS REGLAS Y MENSAJES PARA VALIDACION (EDITAR REFERNCIA)
=============================================*/
$(document).ready(function(){
  $("#frmEditarReferencia").validate({

    messages: {
      editarEstablecimientoRef : "Elija un Establecimiento de Referencia",
    },

  });

});

/*=============================================
GUARDANDO CAMBIOS DATOS DE REFERENCIA
=============================================*/
$("#frmEditarReferencia").on("click", ".btnGuardar", function() {

  if ($("#frmEditarReferencia").valid()) {

    var datos = new FormData($("#frmEditarReferencia")[0]);
    datos.append("editarReferencia", 'editarReferencia');

    $.ajax({

      url:"../ajax/referencias.ajax.php",
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

              $('#modalEditarReferencia').modal('toggle');

              $("#editarEstablecimientoRef").val("");
              $("#editarRefAdecuado").prop("checked",false);
              $("#editarRefJustificado").prop("checked",false);    
              $("#editarRefOportuno").prop("checked",false);

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