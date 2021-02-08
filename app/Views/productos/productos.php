<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?php echo $titulo; ?></h1>
                <ol class="breadcrumb mb-4">
                    <a class="btn btn-warning" href="<?php echo base_url();?>/productos/eliminados">Eliminados</a>
                </ol>          
            <div class="card mb-4">
            <div class="card-header">
              <i class="fas fa-table mr-1"></i>
               Utilice la tabla siguiente para navegar o filtrar los resultados.
            </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                    	<th>Imagen</th>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Impuesto</th>
                                        <th>Metodo</th> 
                                        <th>Costo</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th> 
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                         <th>ID</th>
                                    	<th>Imagen</th>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Impuesto</th>
                                        <th>Metodo</th> 
                                        <th>Costo</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Acciones</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                           
                                    <?php foreach($producto as $datos) { ?>
                                            		
                                        <tr>
                                            <td><?php echo $datos['id']; ?></td>
                                            <td><img src="<?php echo base_url().'/images/productos/'.$datos['id'].'.jpg'; ?>" class="img-responsive" width="70px" alt="<?php echo $datos['nombre']; ?>" /></td>
                                            <td><?php echo $datos['codigo']; ?></td>
                                            <td><?php echo $datos['nombre']; ?></td>
                                            <!--<td><?php //echo $dato['categoria']; ?></td>-->
                                            <td><?php echo $datos['precio']; ?></td>
                                            <td><?php echo $datos['impuesto']; ?></td>
                                            <td><?php echo $datos['impuesto_metodo']; ?></td>
                                            <td><?php echo $datos['costo']; ?></td>
                                            <td><?php echo $datos['precio']; ?></td>
                                            <td><?php echo $datos['cantidad']; ?></td>

                                            <td align="center">
                                                <a class="btn btn-warning" href="<?php echo base_url() .'/productos/editar/'. $datos['id']; ?>" ><i class="fas fa-pencil-alt"></i></a>
                                                <a href="#" class="btn btn-danger" data-href="<?php echo base_url().'/productos/eliminar/'. $datos['id']; ?>" data-toggle="modal" data-target="#modal-confirma" data-placement="top" title="Eliminar registro" ><i class="fas fa-trash"></i></a>
                                            </td>    
                                          
                                        </tr>
                                    <?php } ?>
                                               
                                           
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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