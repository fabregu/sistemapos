<?php namespace App\Models;

use CodeIgniter\Model;

class ArqueoCajasModel extends Model
{
	protected $table      = 'arqueo_caja';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_caja', 'id_usuario', 'fecha_inicio', 'fecha_fin', 'monto_inicial', 'monto_final', 'total_ventas', 'status'];

    protected $useTimestamps = true;
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getDatos($id_caja)
    {
        $this->select('arqueo_caja.*', 'cajas.nombre');
        $this->join('cajas', 'arqueo_caja.id_caja = cajas.id');
        $this->where('arque_caja.id_caja', $id_caja);
        $this->orderBy('arqueo_caja.id','DESC' );
        $datos->findAll();
        return $datos;
}