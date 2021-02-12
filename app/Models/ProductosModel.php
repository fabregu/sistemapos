<?php namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model
{
	protected $table      = 'productos';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['codigo', 'nombre', 'categoria_id', 'precio', 'imagen', 'costo', 'impuesto metodo','cantidad', 'barcode_simbologia','tipo', 'detalles', 'alerta_cantidad', 'activo'];

    protected $useTimestamps = true;
    protected $createdField  = 'fecha_alta';
    protected $updatedField  = '';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function actualizaStock($id_producto, $cantidad, $operador = '+')
    {   
        $this->set('cantidad', "cantidad $operador $cantidad", FALSE);
        $this->where('id', $id_producto);
        $this->update();
    }

    public function totalProductos()
    {
       return $this->where('activo', 1)->countAllResults();
    }

    public function stockMinimo()
    {
        $where = "alerta_cantidad >= cantidad AND activo = 1";
        $this->where($where);
        $sql = $this->countAllResults();
        return $sql;
    }

    public function getStockMinimo()
    {
        $where = "alerta_cantidad >= cantidad AND activo = 1";
        return  $this->where($where)->findAll();
    }
}
