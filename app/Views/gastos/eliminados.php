<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?php echo $titulo; ?></h1>
                       
            <div class="card mb-4">

                <div>
                    <a class="btn btn-warning" href="<?php echo base_url();?>/gastos">Gastos</a>
                </div>
                            
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                    	<th>ID</th>
                                        <th>Fecha</th>
                                        <th>Referencia</th>
                                        <th>Monto</th>
                                        <th>Nota</th> 
                                        <th>Creado por</th>  
                                        <th>Adjunto</th>                          
                                        <th>Fecha de Alta</th>
                                        <th>Acciones</th>    
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                    	<th>ID</th>
                                        <th>Fecha</th>
                                        <th>Referencia</th>
                                        <th>Monto</th>
                                        <th>Nota</th> 
                                        <th>Creado por</th>  
                                        <th>Adjunto</th>                          
                                        <th>Fecha de Alta</th>
                                        <th>Acciones</th> 
                                    </tr>
                                </tfoot>
                                <tbody>
                                           
                                    <?php foreach($datos as $dato) { ?>
                                            		
                                        <tr>
                                            <td><?php echo $dato['id']; ?></td>
                                            <td><?php echo $dato['fecha']; ?></td>
                                            <td><?php echo $dato['referencia']; ?></td>
                                            <td><?php echo $dato['monto']; ?></td>
                                            <td><?php echo $dato['nota']; ?></td>
                                            <td><?php echo $dato['creado_por']; ?></td>
                                            <td><?php echo $dato['adjunto']; ?></td>
                                            <td><?php echo $dato['fecha_alta']; ?></td>
                                            
                                            <td><a href="#"  data-href="<?php echo base_url().'/gastos/reingresar/'. $dato['id']; ?>" data-toggle="modal" data-target="#modal-confirma" data-placement="top" title="Reingresar registro" ><i class="fas fa-arrow-alt-circle-left"></i></a>
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