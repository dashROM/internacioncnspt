<?php 

include "config/config.php";

session_start();

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" href="<?= BASEURL; ?>/views/img/template/icono-color.png" type="image/ico" />

  <title>CNS Potosí | Internación</title>

  <!--=====================================
  PLUGINS CSS
  ======================================-->

  <!-- Bootstrap -->
  <link href="<?= BASEURL; ?>/views/plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome Icons -->
  <link href="<?= BASEURL; ?>/views/plugins/fontawesome-free/css/all.min.css" rel="stylesheet" >

  <!-- Font Awesome -->
  <link href="<?= BASEURL; ?>/views/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <!-- DataTables -->
  <link href="<?= BASEURL; ?>/views/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="<?= BASEURL; ?>/views/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" rel="stylesheet">
  <link href="<?= BASEURL; ?>/views/plugins/datatables-buttons/css/buttons.bootstrap4.min.css" rel="stylesheet">

  <!-- SweetAlert 2 -->
  <link href="<?= BASEURL; ?>/views/plugins/sweetalert2/themes/bootstrap-4.css" rel="stylesheet">

    <!-- Select2 -->
  <link href="<?= BASEURL; ?>/views/plugins/select2-4.0.13/dist/css/select2.min.css" rel="stylesheet">
  <link href="<?= BASEURL; ?>/views/plugins/select2-bootstrap-5-theme-1.3.0/select2-bootstrap-5-theme.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="<?= BASEURL; ?>/views/css/styles.css" rel="stylesheet">
  
  <link href="<?= BASEURL; ?>/views/css/estilos.css" rel="stylesheet">

</head>

<!--=====================================
CUERPO DOCUMENTO
======================================-->

<?php 

if (isset($_SESSION["iniciarSesion_internacion"]) && $_SESSION["iniciarSesion_internacion"] == "ok") {
    
  echo '
  <body class="sb-nav-fixed">';

    /*=====================================
    HEADER
    ======================================*/
    
    include "modulos/header.php";

    /*=====================================
    MENU
    ======================================*/

    echo '
    <div id="layoutSidenav">';

    include "modulos/menu.php";

    /*=====================================
    CONTENIDO
    ======================================*/

    echo '
    <div id="layoutSidenav_content">';

    $parametros = array(); 

    if (isset($_GET["ruta"])) {

      $parametros = explode("/", $_GET["ruta"]);
      
      if ($parametros[0] == "inicio" ||
          $parametros[0] == "usuarios" ||
          $parametros[0] == "pacientes" ||
          $parametros[0] == "establecimientos" ||
          $parametros[0] == "servicios" ||
          $parametros[0] == "detalle-servicio" ||
          $parametros[0] == "detalle-paciente" ||
          $parametros[0] == "medicos" || 
          $parametros[0] == "salas" || 
          $parametros[0] == "paciente-internados" ||
          $parametros[0] == "paciente-egresos" ||
          $parametros[0] == "maternidades" ||
          $parametros[0] == "neonatos" ||
          $parametros[0] == "libro-servicios" ||

          $parametros[0] == "cerrar-session")  {

        include "modulos/".$parametros[0].".php";

      } else {

        include "modulos/404.php";

      }

    } else {

      include "modulos/inicio.php";

    }

    /*=====================================
    FOOTER
    ======================================*/

    include "modulos/footer.php";

  echo '
    </div>
  </div>';


} else {

  echo '
  <body>

    <div id="particles-js">';

    /*=====================================
    HEADER
    ======================================*/
    
    include "modulos/header-login.php";

    /*=====================================
    CONTENIDO
    ======================================*/

    $parametros = array(); 

    if (isset($_GET["ruta"])) {

      $parametros = explode("/", $_GET["ruta"]);
      
      if ($parametros[0] == "login" ||
          $parametros[0] == "buscador-internacion" || 
          $parametros[0] == "marquesina-pacientes-internacion")  {

        include "modulos/".$parametros[0].".php";

      } else {

        include "modulos/login.php";

      }

    } else {

      include "modulos/login.php";

    }

  echo '
  </div>';

}

?>

  <!--=====================================
  PLUGINS JAVASCRIPT
  ======================================-->
  <!-- jQuery -->
  <script src="<?= BASEURL; ?>/views/plugins/jquery/dist/jquery.min.js"></script>

  <!-- jQuery Validation -->
  <script src="<?= BASEURL; ?>/views/plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="<?= BASEURL; ?>/views/plugins/jquery-validation/additional-methods.min.js"></script>
  <script src="<?= BASEURL; ?>/views/plugins/jquery-validation/localization/messages_es.js"></script>

  <!-- Bootstrap -->
  <script src="<?= BASEURL; ?>/views/plugins/bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= BASEURL; ?>/views/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

  <!-- DataTables -->
  <script src="<?= BASEURL; ?>/views/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= BASEURL; ?>/views/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= BASEURL; ?>/views/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= BASEURL; ?>/views/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= BASEURL; ?>/views/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= BASEURL; ?>/views/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= BASEURL; ?>/views/plugins/jszip/jszip.min.js"></script>  
  <script src="<?= BASEURL; ?>/views/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= BASEURL; ?>/views/plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= BASEURL; ?>/views/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <script src="<?= BASEURL; ?>/views/plugins/datatables-scroller/js/dataTables.scroller.min.js"></script>

  <!-- MomentJS --> 
  <script src="<?= BASEURL; ?>/views/plugins/moment/moment.min.js"></script>

  <!-- SweetAlert 2 -->
  <script src="<?= BASEURL; ?>/views/plugins/sweetalert2/sweetalert2.min.js"></script>

  <!-- Select2 -->
  <script src="<?= BASEURL; ?>/views/plugins/select2-4.0.13/dist/js/select2.full.min.js"></script>

  <!-- PDF Objetct --> 
  <script src="<?= BASEURL; ?>/views/plugins/pdf_object/pdfobject.js"></script>

  <!-- particle.js -->
  <script src="<?= BASEURL; ?>/views/plugins/particles.js/particles.min.js"></script>

  <!-- InputMask -->
  <script src="<?= BASEURL; ?>/views/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>

  <!-- Custom Scripts -->
  <script src="<?= BASEURL; ?>/views/js/template.js"></script>
  <script src="<?= BASEURL; ?>/views/js/usuarios.js"></script>
  <script src="<?= BASEURL; ?>/views/js/pacientes.js"></script>
  <script src="<?= BASEURL; ?>/views/js/establecimientos.js"></script>
  <script src="<?= BASEURL; ?>/views/js/servicios.js"></script>
  <script src="<?= BASEURL; ?>/views/js/medicos.js"></script>
  <script src="<?= BASEURL; ?>/views/js/salas.js"></script>
  <script src="<?= BASEURL; ?>/views/js/camas.js"></script>
  <script src="<?= BASEURL; ?>/views/js/paciente_ingresos.js"></script>
  <script src="<?= BASEURL; ?>/views/js/paciente_internados.js"></script>
  <script src="<?= BASEURL; ?>/views/js/paciente_egresos.js"></script>
  <script src="<?= BASEURL; ?>/views/js/transferencias.js"></script>
  <script src="<?= BASEURL; ?>/views/js/maternidades.js"></script> 
  <script src="<?= BASEURL; ?>/views/js/neonatos.js"></script>
  <script src="<?= BASEURL; ?>/views/js/referencias.js"></script>

  </body>
</html>