<nav class="sb-topnav navbar navbar-expand navbar-dark" style="background-color: #188351;">

    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3">
        <img onmouseout="this.src='<?= BASEURL; ?>/views/img/template/icono-color.png';" onmouseover="this.src='<?= BASEURL; ?>/views/img/template/icono-blanco.png';" src="<?= BASEURL; ?>/views/img/template/icono-color.png" alt="Logo" class="brand-image elevation-3" style="opacity: .8; width: 30px">
    </a>

    <p>
        <a href="../">HOSPITAL OBRERO N° 5</a>
    </p>
    
    <div class="d-md-inline-block ms-auto">
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link" id="navbarDropdown" href="<?= BASEURL; ?>/login">Login</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" id="navbarDropdown" href="<?= BASEURL; ?>/buscador-internacion">Datos Intenación</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" id="navbarDropdown" href="<?= BASEURL; ?>/marquesina-pacientes-internacion">Listado Intenación</a>
            </li>
        </ul>
    </div>
</nav>