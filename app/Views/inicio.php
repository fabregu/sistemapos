<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
                <br/>
            <div class="row">
                <div class="col-4">
                    <div class="card text-white bg-primary">
                        <div class="card-body">
                            <?php echo $total; ?> Total de Productos
                        </div>
                        <a class="card-footer text-white" href="<?php echo base_url(); ?>/productos">Ver producto</a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card text-white bg-success">
                        <div class="card-body">
                            S/. <?php echo $totalVentas['total']; ?> Ventas del Día
                        </div>
                        <a class="card-footer text-white" href="<?php echo base_url(); ?>/productos">Ver producto</a>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card text-white bg-danger">
                        <div class="card-body">
                            <?php echo $minimos; ?> Productos con Stock Minimo
                        </div>
                        <a class="card-footer text-white" href="<?php echo base_url(); ?>/productos/muestraMinimos">Ver producto</a>
                    </div>
                </div>
            </div>
            
        </div>
    </main>
