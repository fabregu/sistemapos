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
                    <form method="POST" action="<?php echo base_url(); ?>/categorias/actualizar">
                    <div class="form-group">

                        <input type="hidden" value="<?php echo $datos['id'] ?>" name="id">
                        <div class="row">

                            <div class="col-12 col-sm-6">
                                <label>Nombre</label>
                                <input class="form-control" id="nombre" type="text" name="nombre" value="<?php echo $datos['nombre']; ?>" required />
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Fecha Alta</label>
                                <input class="form-control" id="fecha_alta" type="text" name="fecha_alta" value="<?php echo $datos['fecha_alta']; ?>" />
                            </div>

                        </div>

                         <a href="<?php echo base_url(); ?>/roles" class="btn btn-primary">Regresar</a>

                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>                
                    </form>
                </div>
             </div>
        </div>
    </main>