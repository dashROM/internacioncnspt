<main id="formulario">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">

                    <div class="card-header bg-secundary" >
                        <h2 class="text-center my-4" style="color: #188351;">INICIAR SESSION</h2>
                    </div>

                    <div class="card-body">
                        <form method="post" id="frmLogin">

                            <div class="form-floating mb-3">
                                <input class="form-control" id="usuario" name="usuario" type="text" placeholder="Ingrese Usuario" />
                                <label for="usuario"><i class="fas fa-user mr-2"></i>Usuario</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input class="form-control" id="clave" name="clave" type="password" placeholder="Ingrese Contraseña" />
                                <label for="clave"><i class="fas fa-key mr-2"></i>Contraseña</label>
                            </div>
                            
                             <div class="alert alert-danger text-center d-none" id="alerta" role="alert"></div>
                             
                            <div class=" form-group text-center mt-4 mb-0">
                                <button class= "btn btn-primary" type="submit"><i class="fas fa-sign-in-alt mr-2"></i></i>Ingresar</button>
                            </div>

                            <?php 

                                $login = new ControllerUsuarios();
                                $login -> ctrAutenticacionUsuario();

                            ?>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>