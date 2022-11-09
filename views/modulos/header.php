<nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #188351;">

    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="<?= BASEURL; ?>/inicio">
        <img onmouseout="this.src='<?= BASEURL; ?>/views/img/template/icono-color.png';" onmouseover="this.src='<?= BASEURL; ?>/views/img/template/icono-blanco.png';" src="<?= BASEURL; ?>/views/img/template/icono-color.png" alt="Logo" class="brand-image elevation-3" style="opacity: .8; width: 30px">
        CNS Internación
    </a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    
    <div class="d-md-inline-block ms-auto">
        <!-- Navbar-->

        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i><?= $_SESSION["nombre_internacion"] ?></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Opciones</a></li>
                    <li><a class="dropdown-item" href="#!">Bitácora</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a href="<?= BASEURL; ?>/cerrar-session" class="dropdown-item">Cerrar Session</a></li>
                </ul>
            </li>
        </ul>

    </div>

</nav>