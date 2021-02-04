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
                    <form method="POST" action="<?php echo base_url(); ?>/productos/actualizar" autocomplete="off">
                    <div class="form-group">
                        <div class="row">
                            <input type="hidden" value="<?php echo $producto['id']; ?>" name="id">
                            <div class="col-12 col-sm-6">
                                <label>Codigo</label>
                                <input value="<?php echo $producto['codigo']; ?>" class="form-control" id="codigo" type="text" name="codigo" autofocus required />
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Nombre</label>
                                <input class="form-control" id="nombre" type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required />
                            </div>

                           <div class="col-12 col-sm-6">
                               <label>Categorias</label>
                               <select class="form-control" id="categoria_id" name="categoria_id" required >
                                    <option value="">Elegir...</option>
                                    <?php foreach ($categoria as $datos ) { ?>
                                         <option value="<?php echo $datos['id']; ?>" <?php if ($datos['id'] == $producto['categoria_id']) echo 'selected';  ?> ><?php echo $datos['nombre']; ?></option>
                                   <?php } ?>
                                   
                              </select>                               
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Imagen</label>
                                <input class="form-control" id="imagen" type="file" name="imagen"  />
                                <small id="fileHelp" class="form-text text-muted">Seleccione un archivo jpg/png</small>
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Costo</label>
                                <input class="form-control file" id="costo" type="text" name="costo" value="<?php echo $producto['costo']; ?>" />
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Precio</label>
                                <input class="form-control" id="precio" type="text" name="precio" value="<?php echo $producto['precio']; ?>" />
                                
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Impuesto</label>
                                <input class="form-control" id="impuesto" type="text" name="impuesto" value="<?php echo $producto['impuesto']; ?>" />                                 
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Metodo Impuesto</label>
                                <input class="form-control " id="impuesto_metodo" type="text" name="impuesto_metodo" value="<?php echo $producto['impuesto_metodo']; ?>"
                                  />                                 
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Cantidad</label>
                                <input class="form-control file" id="cantidad" type="text" name="cantidad" value="<?php echo $producto['cantidad']; ?>" />                                 
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Simbología Barcode</label>
                                <input class="form-control file" id="barcode_simbologia" type="text" name="barcode_simbologia" value="<?php echo $producto['barcode_simbologia']; ?>"/>                                 
                            </div>

                            <div class="col-12 col-sm-6">
                               <label>Tipo</label>
                               <select class="form-control" id="tipo" name="tipo">
                                    
                                    <option value="0" <?php if($producto['tipo'] == 0) { echo 'selected'; } ?> >Estandar</option>
                                     <option value="1" <?php if($producto['tipo'] == 1) { echo 'selected'; } ?> >Servicio</option>
                                     <option value="2" <?php if($producto['tipo'] == 2) { echo 'selected'; } ?> >Combo</option>
                              </select>                               
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Detalles</label>
                                <input class="form-control" id="detalles" type="text" name="detalles" value="<?php echo $producto['detalles']; ?>" />                                 
                            </div>

                             <div class="col-12 col-sm-6">
                                <label>Alerta Cantidad</label>
                                <input class="form-control" id="alerta_cantidad" type="text" name="alerta_cantidad" value="<?php echo $producto['alerta_cantidad']; ?>" />                                 
                            </div>

                        </div>

                         <a href="<?php echo base_url(); ?>/productos" class="btn btn-primary">Regresar</a>

                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>                
                    </form>
                </div>
             </div>
        </div>
    </main>