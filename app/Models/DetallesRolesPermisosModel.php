<?php namespace App\Models;

use CodeIgniter\Model;

class DetallesRolesPermisosModel extends Model
{
	protected $table      = 'detalle_roles_permisos';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [ 'id_rol',  'id_permiso'];

    protected $useTimestamps = true;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function verificaPermiso($idRol, $permiso)
    {
        $tiene_acceso = false;
        $this->select('*');
        $this->join('permisos', 'detalles_roles_permisos.idpermiso = permiso.id');
        $existe = $this->where(['id_rol' => $idRol, 'permiso.nombre' => $permiso])->first();

        //echo $this->getLastQuery();
        if($existe != null)
        {
            $tiene_acceso = true;
        }
        return $tiene_acceso;
    }
}