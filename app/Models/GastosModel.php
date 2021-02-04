<?php namespace App\Models;

use CodeIgniter\Model;

class GastosModel extends Model
{
	protected $table      = 'gastos';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['fecha', 'referencia', 'monto', 'nota', 'creado_por', 'adjunto', 'activo'];

    protected $useTimestamps = true;
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = 'fecha_mod';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}