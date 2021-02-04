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
                    <form method="POST" action="<?php echo base_url(); ?>/usuarios/actualizar">
                    <div class="form-group">

                        <input type="hidden" value="<?php echo $datos['id'] ?>" name="id">
                        <div class="row">

                            <div class="col-12 col-sm-6">
                                <label>Usuario</label>
                                <input class="form-control" id="usuario" type="text" name="usuario" value="<?php echo $datos['usuario']; ?>" autofocus required />
                            </div>

                            <div class="col-12 col-sm-6">
                                <label>Nombre</label>
                                <input class="form-control" id="nombre" type="text" name="nombre" value="<?php echo $datos['nombre']; ?>" required />
                            </div>
                        </div>
                    </div>    
                    <div class="form-group">
                         <div class="row">
                            <div class="col-12 col-sm-6">
                                <label>Rol</label>
                                <select class="form-control" id="id_roles" name="id_roles" required>
                                    <option value="" selected="selected">Elegir...</option>
                                        <?php foreach ($roles as $rol ) { ?>
                                                <option value="<?php echo $rol['id']; ?>" ><?php echo $rol['nombre']; ?></option>
                                        <?php } ?>
                                    </select>                               
                            </div>    
                            <div class="col-12 col-sm-6">
                                <label>Caja</label>
                                <select class="form-control" id="id_cajas" name="id_cajas" required>
                                    <option value="" selected="selected">Elegir...</option>
                                    <?php foreach ($cajas as $caja ) { ?>
                                        <option value="<?php echo $caja['id']; ?>" ><?php echo $caja['nombre']; ?></option>
                                    <?php } ?>
                                </select>                               
                            </div>
                        </div>
                    </div>
                    <div class="form-group">   
                        <div class="row">                      
                            <div class="col-12 col-sm-6">
                                    <label>Contraseña</label>
                                    <input class="form-control" id="password" type="password" name="password"/>
                            </div>
                            <div class="col-12 col-sm-6">
                                <label>Confirme Contraseña</label>
                                <input class="form-control" id="repassword" type="password" name="repassword" />
                            </div>
                        </div>  
                    </div>

                         <a href="<?php echo base_url(); ?>/clientes" class="btn btn-primary">Regresar</a>

                        <button type="submit" class="btn btn-success">Guardar</button>
                                   
                    </form>
                </div>
             </div>
        </div>
    </main>