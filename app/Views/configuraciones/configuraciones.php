<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?php echo $titulo; ?></h1>
                       
            <div class="card mb-4">
             <form method="POST" action="<?php echo base_url(); ?>/configuraciones/actualizar" autocomplete="off">
                    <div class="form-group"> 
                        <div class="row">

                            <div class="col-12 col-sm-6">
                                <label>Nombre de la Tienda</label>
                                <input class="form-control" id="tienda_nombre" type="text" name="tienda_nombre" value="<?php echo $nombre['valor']; ?>" autofocus required />
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>RUC</label>
                                <input class="form-control" id="tienda_ruc" type="text" name="tienda_ruc"  required value="<?php echo $ruc['valor']; ?>"/>
                            </div>
                           
                        </div>
                        
                    </div>    
                     <div class="form-group"> 
                        <div class="row">

                            <div class="col-12 col-sm-6">
                                <label>Teléfono de la Tienda</label>
                                <input class="form-control" id="tienda_telefono" type="text" name="tienda_telefono" autofocus required value="<?php echo $telefono['valor']; ?>" />
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Correo de la Tienda</label>
                                <input class="form-control" id="tienda_email" type="text" name="tienda_email"  required value="<?php echo $correo['valor']; ?>" />
                            </div>
                           
                        </div>
                        
                    </div>   
                    <div class="form-group"> 
                        <div class="row">

                            <div class="col-12 col-sm-6">
                                <label>Dirección de la Tienda</label>
                                <textarea class="form-control" id="tienda_direccion" name="tienda_direccion" required> <?php echo $direccion['valor']; ?>
                                </textarea>
                                
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Leyenda del Ticket</label>
                                <textarea class="form-control" id="ticket_leyenda" name="ticket_leyenda"  required><?php echo $leyenda['valor']; ?>
                                </textarea>
                            </div>
                           
                        </div>
                        
                    </div>   
                            <a href="<?php echo base_url(); ?>/categorias" class="btn btn-primary">Regresar</a>

                        <button type="submit" class="btn btn-success">Guardar</button>     
            </form>
                 <div class="card-body">
                       
                </div>
        </div>
    </main>


<!-- Modal -->
<div class="modal fade" id="modal-confirma" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Desea eliminar el registro?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-danger btn-ok">Eliminar</a>
      </div>
    </div>
  </div>
</div>