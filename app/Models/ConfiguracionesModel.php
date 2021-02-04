<?php namespace App\Models;

use CodeIgniter\Model;

class ConfiguracionesModel extends Model
{
	protected $table      = 'configuraciones';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;
    protected $useSoftCreates = false;
    protected $useSoftUpdates = false;

    protected $allowedFields = ['nombre', 'valor'];

    protected $useTimestamps = true;
    protected $createdField  = null;
    protected $updatedField  = null;
    protected $deletedField  = null;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}