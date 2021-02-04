<div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                          <h1 class="mt-4"><?php echo $titulo; ?></h1>
                        <ol class="breadcrumb mb-4">
                          <a class="btn btn-warning" href="<?php echo base_url();?>/categorias/eliminados"> Eliminados</a>
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
                                              <th>Folio</th>
                                              <th>Total</th>                             
                                              <th>Fecha de Alta</th>
                                              <th></th>
                                              
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                            <th>ID</th>
                                              <th>Folio</th>
                                              <th>Total</th>                             
                                              <th>Fecha de Alta</th>
                                              <th></th>
                                              
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        <?php foreach($compras as $compra) { ?>
                                            		
                                          <tr>
                                            <td><?php echo $compra['id']; ?></td>
                                            <td><?php echo $compra['folio']; ?></td>
                                            <td><?php echo $compra['total']; ?></td>
                                            <td><?php echo $compra['fecha_alta']; ?></td>
                                            <td align="center">
                                              <a href="<?php echo base_url() .'/compras/muestraCompraPdf/'. $compra['id']; ?>"  class="btn btn-primary"><i class="fas fa-file-alt"></i></a>
                                              
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