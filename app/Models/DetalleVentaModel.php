<?php namespace App\Models;

use CodeIgniter\Model;

class DetalleVentaModel extends Model
{
	protected $table      = 'detalle_venta';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_venta', 'id_producto', 'nombre', 'cantidad', 'precio'];

    protected $useTimestamps = true;
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function insertaVenta($id_venta, $total, $id_usuario)
    {
        $this->insert([
				'folio' => $id_venta,
				'total' => $total,
				'id_usuario' =>	$id_usuario
            ]);
            
        return $this->insertID();    
    }
}