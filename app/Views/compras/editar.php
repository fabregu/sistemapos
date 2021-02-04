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
                                <label>Codigo</label>
                                <input class="form-control" id="codigo" type="text" name="codigo" value="<?php echo $datos['codigo']; ?>" autofocus required />
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Nombre</label>
                                <input class="form-control" id="nombre" type="text" name="nombre" value="<?php echo $datos['nombre']; ?>" required />
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Imagen</label>
                                <input class="form-control" id="imagen" type="text" name="imagen"  />
                            </div>

                        </div>

                         <a href="<?php echo base_url(); ?>/categorias" class="btn btn-primary">Regresar</a>

                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>                
                    </form>
                </div>
             </div>
        </div>
    </main>