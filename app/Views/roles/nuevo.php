<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?php echo $titulo; ?></h1>

            <?php if(isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors(); ?>
                </div>
            <?php } ?>
                       
            <div class="card mb-4">
                            
                <div class="card-body">
                    <form method="POST" action="<?php echo base_url(); ?>/roles/insertar" autocomplete="off">
                    <div class="form-group"> 
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <label>Nombre</label>
                                <input class="form-control" id="nombre" type="text" name="nombre"  required value="<?php echo set_value('nombre'); ?>"/>
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