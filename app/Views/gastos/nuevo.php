<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?php echo $titulo; ?></h1>
                       
            <div class="card mb-4">
            <?php if(isset($validation)) { ?>
                <div class="alert alert-danger">
                    <?php echo $validation->listErrors();?>
                </div>
            <?php } ?>    
                            
                <div class="card-body">
                    <form method="POST" action="<?php echo base_url(); ?>/gastos/insertar" autocomplete="off">
                    <div class="form-group">
                        <div class="row">

                            <div class="col-12 col-sm-6">
                                <label>Fecha</label>
                                <input class="form-control" id="fecha" type="date" name="fecha" autofocus required />
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Referencia</label>
                                <input class="form-control" id="referencia" type="text" name="referencia"  required />
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Monto</label>
                                <input class="form-control" id="monto" type="text" name="monto"  />
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Nota</label>
                                <input class="form-control" id="nota" type="text" name="nota"  />
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Creado por</label>
                                <input class="form-control" id="creado_por" type="text" name="creado_por"  />
                            </div>


                            <div class="col-12 col-sm-6">
                                <label>Adjunto</label>
                                <input class="form-control file" id="adjunto" type="file" name="adjunto"  />
                                 <small id="fileHelp" class="form-text text-muted">Seleccione un archivo jpg/png</small>
                            </div>

                        </div>

                         <a href="<?php echo base_url(); ?>/gastos" class="btn btn-primary">Regresar</a>

                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>                
                    </form>
                </div>
             </div>
        </div>
    </main>