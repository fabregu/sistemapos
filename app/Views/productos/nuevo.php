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
                    <form method="POST" enctype="multipart/form-data" action="<?php echo base_url(); ?>/productos/insertar" autocomplete="off">
                    <div class="form-group">
                        <div class="row">

                            <div class="col-12 col-sm-6">
                                <label>Codigo</label>
                                <input class="form-control" id="codigo" type="text" name="codigo" autofocus required />
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Nombre</label>
                                <input class="form-control" id="nombre" type="text" name="nombre"  required />
                            </div>

                           <div class="col-12 col-sm-6">
                               <label>Categorias</label>
                               <select class="form-control" id="categoria_id" name="categoria_id" required>
                                    <option value="" selected="selected">Elegir...</option>
                                    <?php foreach ($categorias as $categoria ) { ?>
                                         <option value="<?php echo $categoria['id']; ?>" ><?php echo $categoria['nombre']; ?></option>
                                   <?php } ?>
                                   
                              </select>                               
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Costo</label>
                                <input class="form-control file" id="costo" type="text" name="costo"  required/>
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Precio</label>
                                <input class="form-control" id="precio" type="text" name="precio"  required/>
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Impuesto</label>
                                <input class="form-control file" id="impuesto" type="text" name="impuesto"  />                                 
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Metodo Impuesto</label>
                                <input class="form-control " id="impuesto_metodo" type="text" name="impuesto_metodo"  />                                 
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Cantidad</label>
                                <input class="form-control file" id="cantidad" type="text" name="cantidad"  required/>                                 
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Simbología Barcode</label>
                                <input class="form-control file" id="barcode" type="text" name="barcode"  />                                 
                            </div>

                            <div class="col-12 col-sm-6">
                               <label>Tipo</label>
                               <select class="form-control" id="tipo" name="tipo">
                                    <option >Elegir...</option>
                                    <option value="Estandar" selected>Estandar</option>
                                    <option value="Servicio">Servicio</option>
                                    <option value="Combo">Combo</option>
                              </select>                               
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Detalles</label>
                                <input class="form-control" id="detalles" type="text" name="detalles"  />                                 
                            </div>

                             <div class="col-12 col-sm-6">
                                <label>Alerta Cantidad</label>
                                <input class="form-control" id="alerta_cantidad" type="text" name="alerta_cantidad"  />                                 
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <label for="">Imagen</label><br>
                                        <input type="file" id="img_producto" name="img_producto" accept="image/*"/>
                                        <small class="form-text text-muted">Seleccione un archivo jpg 150x150 px</small>
                                    </div>
                                </div>
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