<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?php echo $titulo; ?></h1>
                       
            <div class="card mb-4">
                
            <?php if(isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?> 
                            
                <div class="card-body">
                    <form method="POST" action="<?php echo base_url(); ?>/usuarios/actualizar_password">
                    <div class="form-group">

                        <div class="row">

                            <div class="col-12 col-sm-6">
                                <label for="usuario" class="small mb-1">Usuario</label>
                                <input class="form-control" id="usuario" type="text" name="usuario" value="<?php echo $usuario['usuario']; ?>" disabled />
                            </div>
                            <div class="col-12 col-sm-6">
                                <label class="small mb-1">Nombre</label>
                                <input class="form-control" id="nombre" type="text" name="nombre" value="<?php echo $usuario['nombre']; ?>" disabled />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label class="small mb-1">Contraseña</label>
                                <input class="form-control" id="password" type="password" name="password" required />
                            </div>
                            <div class="col-12 col-sm-6">
                                <label class="small mb-1">Confirma Contraseña</label>
                                <input class="form-control" id="repassword" type="password" name="repassword" required />
                            </div>
                        </div>
                    </div>   
                        <a href="<?php echo base_url(); ?>/usuarios" class="btn btn-primary">Regresar</a>

                        <button type="submit" class="btn btn-success">Guardar</button>     
                        <?php if(isset($mensaje)) { ?>
                            <div class="alert alert-success">
                                <?php echo $mensaje; ?>
                            </div>
                        <?php } ?>        
                    </form>
                </div>
             </div>
        </div>
    </main>