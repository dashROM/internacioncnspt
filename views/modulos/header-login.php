<nav class="navbar navbar-expand-lg" style="background-color: #188351;">

    <div class="container-fluid">

        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3">
            <img onmouseout="this.src='<?= BASEURL; ?>/views/img/template/icono-color.png';" onmouseover="this.src='<?= BASEURL; ?>/views/img/template/icono-blanco.png';" src="<?= BASEURL; ?>/views/img/template/icono-color.png" alt="Logo" class="brand-image elevation-3" style="opacity: .8; width: 40px">
        </a>

        <span class="navbar-text">
            <a href="../">HOSPITAL OBRERO N° 5</a>
        </span>        

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon" style="color: white;"><i class="fas fa-list-ul"></i></span>
        </button>
        
        <div class="collapse navbar-collapse text-light" id="navbarText">
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
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

    </div>

</nav>