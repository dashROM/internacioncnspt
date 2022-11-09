<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">

            <div class="nav">

                <?php if($_SESSION["nivel_internacion"] == 1) { ?> 

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#configuracion" aria-expanded="false" aria-controls="configuracion">
                    <div class="sb-nav-link-icon"><i class="fas fa-cog"></i></div>
                        Configuracion
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="configuracion" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link menu" href="<?= BASEURL; ?>/usuarios" id="usuarios">Usuarios</a>
                    </nav>
                </div>

                <?php }

                if($_SESSION["nivel_internacion"] == 1 || $_SESSION["nivel_internacion"] ==  2 || $_SESSION["nivel_internacion"] ==  3) { ?> 

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#gestion_hospital" aria-expanded="false" aria-controls="gestion_hospital">
                    <div class="sb-nav-link-icon"><i class="fas fa-hospital-alt"></i></div>
                        Gestión Hospital
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>

                <?php }

                if($_SESSION["nivel_internacion"] == 1 || $_SESSION["nivel_internacion"] ==  2 || $_SESSION["nivel_internacion"] ==  3) { ?> 

                <div class="collapse" id="gestion_hospital" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link menu" href="<?= BASEURL; ?>/pacientes" id="pacientes">Pacientes</a>
                    </nav>
                </div>

                <?php }

                if($_SESSION["nivel_internacion"] == 1) { ?> 

                <div class="collapse" id="gestion_hospital" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link menu" href="<?= BASEURL; ?>/medicos" id="medicos">Medicos</a>
                    </nav>
                </div>

                <div class="collapse" id="gestion_hospital" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link menu" href="<?= BASEURL; ?>/establecimientos" id="establecimientos">Establecimientos</a>
                    </nav>
                </div>

                <div class="collapse" id="gestion_hospital" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link menu" href="<?= BASEURL; ?>/servicios" id="servicios">Servicios</a>
                    </nav>
                </div>

                <?php }

                if($_SESSION["nivel_internacion"] == 1 || $_SESSION["nivel_internacion"] ==  2 || $_SESSION["nivel_internacion"] ==  3) { ?> 

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#gestion_internacion" aria-expanded="false" aria-controls="gestion_internacion">
                    <div class="sb-nav-link-icon"><i class="fas fa-procedures"></i></div>
                        Gestión Internación
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>

                <div class="collapse" id="gestion_internacion" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link menu" href="<?= BASEURL; ?>/paciente-internados" id="paciente-internados">Pacientes Internados</a>
                    </nav>
                </div>

                <div class="collapse" id="gestion_internacion" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link menu" href="<?= BASEURL; ?>/paciente-egresos" id="paciente-egresos">Pacientes Alta</a>
                    </nav>
                </div>

                <div class="collapse" id="gestion_internacion" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link menu" href="<?= BASEURL; ?>/maternidades" id="maternidades">Maternidad</a>
                    </nav>
                </div>

                 <div class="collapse" id="gestion_internacion" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link menu" href="<?= BASEURL; ?>/neonatos" id="neonatos">Neonatos</a>
                    </nav>
                </div>

                <?php } ?> 
                
            </div>

        </div>

        <div class="sb-sidenav-footer">
            <div class="small">CNS</div>
        </div>

    </nav>
</div>