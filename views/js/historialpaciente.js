
/*=============================================
BUSCADOR DE DATOS DE AFILIADO ERP
=============================================*/

$("#frmhistorialpaciente").on("click", "#btnSearch", function() {

    var pac_numero_historia = $('#pac_numero_historia').val();
    console.log("pac_numero_historia", pac_numero_historia);
    // var pac_nombre = $('#pac_nombre').val();
    // console.log("pac_nombre", pac_nombre);
    if(pac_numero_historia === "") {
        alert("Por favor complete los campos requeridos");
        return;
    }

    $("#error").css("display", "none");
    $("#mensaje").css("display", "block");

    var datos = new FormData();
    datos.append("Historial", "Historial")
    datos.append("pac_numero_historia", pac_numero_historia);
    // datos.append("pac_nombre", pac_nombre);

    $.ajax({

        url: "ajax/historialpaciente.ajax.php",
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

	            dato = respuesta;

	            console.log("dato", dato);
                $("#pac_nombre").val(dato.pac_nombre);
	            $("#pac_primer_apellido").val(dato.pac_primer_apellido);
	            $("#pac_segundo_apellido").val(dato.pac_segundo_apellido);	            
	            $("#fecha").val(dato["fecha"]);
                $("#hora").val(dato["hora"]);
                $("#nombre_especialidad").val(dato["nombre_especialidad"]);
                $("#diagnosticoingreso").val(dato["diagnosticoingreso"]);
                $("#per_nombre").val(dato["nombre_medico"]);
                $("#descripcion").val(dato["descripcion"]);
                $("#descripcioncama").val(dato["descripcioncama"]);
                
                
                $("#fecha").val(dato["fecha"]);
                $("#serviciot").val(dato["servicio"]);
                $("#medico").val(dato["medico"]);
                $("#salat").val(dato["sala"]);
                $("#camat").val(dato["cama"]);


        	}

        },
        error: function(error){

          console.log("No funciona");
            
        }

    });

});