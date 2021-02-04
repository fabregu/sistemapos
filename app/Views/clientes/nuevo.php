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
                    <form method="POST" action="<?php echo base_url(); ?>/clientes/insertar" autocomplete="off">
                    <div class="form-group">
                        <div class="row">

                            <div class="col-12 col-sm-6">
                                <label>Nombre</label>
                                <input class="form-control" id="nombre" type="text" name="nombre" autofocus required />
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Celular</label>
                                <input class="form-control" id="celular" type="number" name="celular" required />
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Email</label>
                                <input class="form-control" id="email" type="email" name="email"  />
                            </div>

                        </div>

                         <a href="<?php echo base_url(); ?>/clientes" class="btn btn-primary">Regresar</a>

                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>                
                    </form>
                </div>
             </div>
        </div>
    </main>