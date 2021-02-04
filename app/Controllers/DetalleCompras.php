<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ComprasModel;
use App\Models\TemporalComprasModel;
use App\Models\DetalleCompraModel;

class Compras extends BaseController
{
	protected $compras, $temporal_compras, $detalle_compra;
	protected $reglas;

	public function __construct()
	{
		$this->compras = new ComprasModel();

		helper(['form']);

	}

	public function index($activo = 1)
	{
		$productos = $this->productos->where('activo', $activo)->findAll();
		$data = ['titulo' => 'Productos', 'producto' => $productos];
		echo view('header');
		echo view('/productos/productos', $data);
		echo view('footer');
	}

	public function eliminados($activo = 0)
	{
		$productos = $this->productos->where('activo', $activo)->findAll();
		$data = ['titulo' => 'Productos Eliminados', 'producto' => $productos];
		echo view('header');
		echo view('/productos/eliminados', $data);
		echo view('footer');
	}

	public function nuevo()
	{

		echo view('header');
		echo view('/compras/nuevo');
		echo view('footer');
	}

	public function guardar()
	{
			$id_compra = $this->request->getPost('id_compra');
			$total = $this->request->getPost('total');
							 	
			$session = session();
			$session->id_usuario;

			$resultado = $this->compras->insertaCompra($id_compra, $total, $session->id_usuario);

			$this->temporal_compras = new TemporalComprasModel();

			if($resultado)
			{
				$resultadoCompra = $this->temporal_compras->porCompra($id_compra);
			}
	}
 
	

}