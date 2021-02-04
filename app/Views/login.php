<?php $user_session = session();?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - POS IMPRESSIVE LINE</title>
         <link href="<?php echo base_url(); ?>/css/styles.css" rel="stylesheet" />
        <script src="<?php echo base_url(); ?>/js/all.min.js"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Iniciar Sesión</h3></div>
                                    <div class="card-body">
                                        <form method="POST" action="<?php echo base_url(); ?>/usuarios/valida">
                                            <div class="form-group">
                                                <label class="small mb-1" for="usuario">Usuario</label>
                                                <input class="form-control py-4" id="usuario" type="text" name="usuario" placeholder="Ingrese el usuario" autofocus required/>
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="password">Contraseña</label>
                                                <input class="form-control py-4" id="password" type="password" name="password" placeholder="Ingrese la contraseña" required/>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                               
                                                <button type="submit" class="btn btn-primary">Login</button>
                                            </div>

                                            <?php if(isset($validation)) { ?>
                                                <div class="alert alert-danger">
                                                    <?php echo $validation->listErrors(); ?>
                                                </div>
                                            <?php } ?>    

                                            <?php if(isset($error)) { ?>
                                                <div class="alert alert-danger">
                                                    <?php echo $error; ?>
                                                </div>
                                            <?php } ?>  

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Desarrollado por Freddy Abregú  <?php echo date('Y'); ?></div>
                        <div>
                        <a href="https://facebook.com/impressiveline" target="_blank">Facebook</a>
                                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                </div>
            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="<?php echo base_url(); ?>/js/jquery-3.5.1.slim.min.js" ></script>
        <script src="<?php echo base_url(); ?>/js/bootstrap.bundle.min.js" ></script>
        <script src="<?php echo base_url(); ?>/js/scripts.js"></script>
    </body>
</html>
