<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?php echo $titulo; ?></h1>

            <form id="form-permisos" name="form-permisos" method="POST" action="<?php echo base_url().'/roles/guardaPermisos'; ?>">

            <input type="hidden" name="id_rol" value="<?php echo $id_rol; ?>">

            <?php foreach($permisos as $permiso)  { ?>
               <div class="form-check">
                <input class="form-check-input" type="checkbox" value="<?php $permiso['id']; ?>" name="permisos[]" <?php if(isset($asignado[$permiso['id']])){ echo 'checked'; } ?>/> <label class="form check-input"><?php echo $permiso['nombre']; ?> </label>
              </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
            
        </div>
    </main>
    