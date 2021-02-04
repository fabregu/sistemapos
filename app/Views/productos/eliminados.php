<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?php echo $titulo; ?></h1>
                       
            <div class="card mb-4">

                <div>
                    <a class="btn btn-success" href="<?php echo base_url();?>/productos">Ver Productos </a>
                </div>
                            
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                    	<th>Imagen</th>
                                        <th>ID</th>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Impuesto</th>
                                        <th>Metodo</th> 
                                        <th>Costo</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th> 
                                        <th>Tipo</th>
                                        <th>Reingresar</th>       
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                    	<th>Imagen</th>
                                        <th>ID</th>
                                        <th>Codigo</th>
                                        <th>Nombre</th>
                                        <th>Precio</th>
                                        <th>Impuesto</th>
                                        <th>Metodo</th> 
                                        <th>Costo</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th> 
                                        <th>Tipo</th>
                                        <th>Reingresar</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                           
                                    <?php foreach($producto as $datos) { ?>
                                            		
                                        <tr>
                                           <td><?php echo $datos['imagen']; ?></td>
                                            <td><?php echo $datos['id']; ?></td>
                                            <td><?php echo $datos['codigo']; ?></td>
                                            <td><?php echo $datos['nombre']; ?></td>
                                            <!--<td><?php //echo $dato['categoria']; ?></td>-->
                                            <td><?php echo $datos['precio']; ?></td>
                                            <td><?php echo $datos['impuesto']; ?></td>
                                            <td><?php echo $datos['impuesto_metodo']; ?></td>
                                            <td><?php echo $datos['costo']; ?></td>
                                            <td><?php echo $datos['precio']; ?></td>
                                            <td><?php echo $datos['cantidad']; ?></td>
                                            <td><?php echo $datos['tipo']; ?></td>

                                            <td><a href="#"  data-href="<?php echo base_url().'/productos/reingresar/'. $datos['id']; ?>" data-toggle="modal" data-target="#modal-confirma" data-placement="top" title="Reingresar registro" ><i class="fas fa-arrow-alt-circle-left"></i></a>
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
        <h5 class="modal-title" id="exampleModalLabel">Reingresar registro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Desea reingresar el registro?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <a class="btn btn-danger btn-ok">Reingresar</a>
      </div>
    </div>
  </div>
</div>