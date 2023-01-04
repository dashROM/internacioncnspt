// Uso del localStorage para asignar la clase activa al modulo en que se encuentra
if (localStorage.getItem("actual") != null) {

  if (localStorage.getItem("principal") == ".menu#undefined") {
    
    $(localStorage.getItem("inicial")).removeClass("active");
    $(localStorage.getItem("actual")).addClass("active");   

  } else {

    $(localStorage.getItem("inicial")).removeClass("active");
    $(localStorage.getItem("actual")).addClass("active");
    $(localStorage.getItem("principal")).addClass("active");
    $(localStorage.getItem("principal")).parent().addClass("menu-open");

  } 

}

$(document).ready(function() {

  /*=============================================
  //Ubicador del menu de usuario
  =============================================*/

  // elementos de la lista
  var menu = $(".menu"); 

  // manejador de click sobre todos los elementos
  menu.click(function() {

    // eliminamos active de todos los elementos
    menu.removeClass("active");

    // activamos el elemento clicado.
    $(this).addClass("active");

    $(this).parent().parent().siblings().addClass("collapsed");

    var inicial = menu.attr('id');
    var actual = $(this).attr('id');
    var principal = $(this).parent().parent().siblings().attr('id');

    localStorage.setItem("inicial", ".menu#"+inicial);
    localStorage.setItem("actual", ".menu#"+actual);    
    localStorage.setItem("principal", ".menu#"+principal);

  });

});

/*=============================================
CARGAR LA TABLA DINÁMICA DE USUARIOS
=============================================*/
var tablaUsuarios = $('#tblUsuarios').DataTable({

	"ajax": {
		url: "ajax/datatable-usuarios.ajax.php",
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
PARA MOSTRAR PASSWORD VISIBLE EN FORMULARIO
=============================================*/
$(document).on("click", ".btnMostrarPassword", function() {

  var cambio = $(".txtPassword");
  
  if(cambio.attr("type") == "password") {
    
    cambio.attr("type", "text");
    $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
  } else {

    cambio.attr("type", "password");
    $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');

  }

});

/*=============================================
CONFIGURACION DE LAS REGLAS Y MENSAJES PARA VALIDACION
=============================================*/
$(document).ready(function() {
  $("#frmNuevoUsuario").validate({

    rules: {
      nuevoPaternoUsuario : { patron_texto: true},
      nuevoMaternoUsuario : { patron_texto: true},
      nuevoNombreUsuario : { required: true, patron_texto: true},
      nuevoNickUsuario : { required: true, patron_numerosLetras: true},
      nuevoClaveUsuario : { required: true}, 
      nuevoTipoUsuario : { required: true},
    },

    messages: {
      nuevoTipoUsuario : "Elija un Tipo de Usuario",
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
GUARDANDO DATOS DE NUEVO USUARIO
=============================================*/
$("#frmNuevoUsuario").on("click", ".btnGuardar", function() {

  if ($("#frmNuevoUsuario").valid()) {
  
    var datos = new FormData($("#frmNuevoUsuario")[0]);
    datos.append("nuevoUsuario", 'nuevoUsuario');

    $.ajax({

      url:"ajax/usuarios.ajax.php",
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

              window.location = "usuarios";

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
ACTIVAR USUARIO
=============================================*/
$(document).on("click", ".btnActivar", function() {
  
  var idUsuario = $(this).attr("idUsuario");
  var estadoUsuario = $(this).attr("estadoUsuario");

  var datos = new FormData();
  datos.append("id", idUsuario);
  datos.append("estado_usuario", estadoUsuario);
  datos.append("activarUsuario", "activarUsuario");

  $.ajax({

    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {
      
      if (respuesta == "ok") {

        console.log("respuesta", respuesta);

        swal.fire({
          
          title: "El usuario ha sido actualizado",
          icon: "success",
          allowOutsideClick: false,
          confirmButtonText: "¡Cerrar!"

        }).then(function(result) {

          if (result.value) {

            tablaUsuarios.ajax.reload(null, false);

          }

        });

      } else {

        console.log("respuesta", respuesta);

        swal.fire({
              
          title: "¡Error o problemas en la Base de Datos, no se realizo la operación!",
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

  if (estadoUsuario == 0) {

    $(this).removeClass('btn-success');
    $(this).addClass('btn-danger');
    $(this).html('INACTIVO');
    $(this).attr('estadoUsuario', 1);

  } else {

    $(this).addClass('btn-success');
    $(this).removeClass('btn-danger');
    $(this).html('ACTIVO');
    $(this).attr('estadoUsuario', 0);

  }

});

/*=============================================
CARGANDO DATOS DE USUARIO AL FORMULARIO EDITAR USUARIO
=============================================*/
$(document).on("click", ".btnEditarUsuario", function() {

  console.log("CARGAR USUARIO");

  var id = $(this).attr("id");
  console.log("id", id);

  var datos = new FormData();
  datos.append("mostrarUsuario", 'mostrarUsuario');
  datos.append("id", id);

  $.ajax({

    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {
      console.log("respuesta1", respuesta);

      $('#editarIdUsuario').val(respuesta["id"]);
      $('#editarPaternoUsuario').val(respuesta["paterno_usuario"]);
      $('#editarMaternoUsuario').val(respuesta["materno_usuario"]);
      $('#editarNombreUsuario').val(respuesta["nombre_usuario"]);
      $('#editarNickUsuario').val(respuesta["nick_usuario"]);
      
      // $("#editarTipoUsuario").val(respuesta["id_tipo_usuario"]).selectpicker('refresh');
      $("#editarTipoUsuario").val(respuesta["id_tipo_usuario"]);

      $("#claveActual").val(respuesta["clave_usuario"]);      

    },
      error: function(error){

        console.log("No funciona");
          
      }

  });

});

$(document).ready(function(){
  $("#frmEditarUsuario").validate({

    rules: {
      editarPaternoUsuario : { patron_texto: true},
      editarMaternoUsuario : { patron_texto: true},
      editarNombreUsuario : { required: true, patron_texto: true},
      editarNickUsuario : { required: true, patron_numerosLetras: true},
      editarTipoUsuario : { required: true},
    },

    messages: {
      editarTipoUsuario : "Elija un Tipo de Usuario",
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
GUARDANDO DATOS DE EDITAR USUARIO
=============================================*/
$("#frmEditarUsuario").on("click", ".btnGuardar", function() {

  if ($("#frmEditarUsuario").valid()) {

    var datos = new FormData($("#frmEditarUsuario")[0]);
    datos.append("editarUsuario", 'editarUsuario');

    $.ajax({

      url:"ajax/usuarios.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function(respuesta) {
        console.log("respuesta2", respuesta);
      
        if (respuesta == "ok") {

          swal.fire({
            
            icon: "success",
            title: "¡Los datos se guardaron correctamente!",
            showConfirmButton: true,
            allowOutsideClick: false,
            confirmButtonText: "Cerrar"

          }).then((result) => {
              
            if (result.value) {

              $('#modalEditarUsuario').modal('toggle');

              $("#editarIdUsuario").val("");
              $("#editarPaternoUsuario").val(""); 
              $("#editarMaternoUsuario").val("");
              $("#editarNombreUsuario").val("");  
              $("#editarNickUsuario").val("");
              $("#editarClaveUsuario").val(""); 
              $("#editarTipoUsuario").val("");

              // Funcion que recarga y actuaiiza la tabla 

              tablaUsuarios.ajax.reload( null, false );

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