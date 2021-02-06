<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductosModel;
use App\Models\CategoriasModel;

class Productos extends BaseController
{
	protected $productos;
	protected $reglas;

	public function __construct()
	{
		$this->productos = new ProductosModel();
		$this->categorias = new CategoriasModel();

		helper(['form']);

		$this->reglas = [
			'codigo' => [
				'rules' => 'required|is_unique[productos.codigo]',
				'errors' => [
					'required' => 'El campo {field} es obligatorio',
					'is_unique' => 'El campo {field} debe ser único'
				]
			],
			'nombre' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'El campo {field} es obligatorio'
				]
			],
			'precio' =>[
				'rules' => 'required',
				'errors' => [
					'required' => 'El campo {field} es obligatorio'
				]
			],
			'costo' =>[
				'rules' => 'required',
				'error' => [
					'required' => 'El campo {field} es obligatorio'	
				]
			],	
			'cantidad' =>[
				'rules' => 'required',
				'error' => [
					'required' => 'El campo {field} es obligatorio'	
				]
			]
		];
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

		$categorias = $this->categorias->where('activo', 1)->findAll();
		$data = ['titulo' => 'Agregar Productos', 'categorias' => $categorias];

		echo view('header');
		echo view('/productos/nuevo', $data);
		echo view('footer');
	}

	public function insertar()
	{
		if($this->request->getMethod() == 'post' && $this->validate($this->reglas))
		{
			$this->productos->save(['codigo' => $this->request->getPost('codigo'),
							 	'nombre' => $this->request->getPost('nombre'),
							 	'categoria_id' => $this->request->getPost('categoria_id'),
								'precio' => $this->request->getPost('precio'),
							 	//'imagen' => $this->request->getPost('imagen'),
							 	'costo' => $this->request->getPost('costo'),
							 	'impuesto' => $this->request->getPost('impuesto'),
							    'impuesto_metodo' => $this->request->getPost('impuesto_metodo'),
								'costo' => $this->request->getPost('costo'),
								'cantidad' => $this->request->getPost('cantidad'),
								//'barcode_simbologia' => $this->request->getPost('barcode_simbologia'),	
								'tipo' => $this->request->getPost('tipo'),
								'detalles' => $this->request->getPost('detalles'),
								'alerta_cantidad' => $this->request->getPost('alerta_cantidad')
								]);
		return redirect()->to(base_url().'/productos');
		}else
		{
			$categorias = $this->categorias->where('activo', 1)->findAll();
			$data = ['titulo' => 'Agregar Producto', 'categorias' => $categorias, 'validation' => $this->validator];
			echo view('header');
			echo view('/productos/nuevo', $data);
			echo view('footer');
		}
		
	}
 
	public function editar($id, $valid = null)
	{

		$categorias = $this->categorias->where('activo', 1)->findAll();
		$productos = $this->productos->where('id', $id)->first();

		if($valid != null)
		{
			$data = ['titulo' => 'Editar Productos','categoria' => $categorias, 'producto' => $productos, 'validation' => $valid];
		}else
		{
			$data = ['titulo' => 'Editar Productos','categoria' => $categorias, 'producto' => $productos];
		}
		
		echo view('header');
		echo view('/productos/editar', $data);
		echo view('footer');
	}

	public function actualizar()
	{
		if($this->request->getMethod() == 'post' && $this->validate($this->reglas))
		{
			$this->productos->update($this->request->getPost('id'),
							   ['codigo' => $this->request->getPost('codigo'),
							 	'nombre' => $this->request->getPost('nombre'),
							 	'categoria_id' => $this->request->getPost('categoria_id'),
								'precio' => $this->request->getPost('precio'),
							 	//'imagen' => $this->request->getPost('imagen'),
							 	'costo' => $this->request->getPost('costo'),
							 	'impuesto' => $this->request->getPost('impuesto'),
							    'impuesto_metodo' => $this->request->getPost('impuesto_metodo'),
								'costo' => $this->request->getPost('costo'),
								'cantidad' => $this->request->getPost('cantidad'),
								//'barcode_simbologia' => $this->request->getPost('barcode_simbologia'),	
								'tipo' => $this->request->getPost('tipo'),
								'detalles' => $this->request->getPost('detalles'),
								'alerta_cantidad' => $this->request->getPost('alerta_cantidad')
								]	
								);
		return redirect()->to(base_url().'/productos');
		}else
		{
			return $this->editar($this->request->getPost('id'), $this->validator);
		}
		
	}

	public function eliminar($id)
	{
		
		$this->productos->update($id,['activo' => 0]);
		return redirect()->to(base_url().'/productos');
	}

	public function reingresar($id)
	{
		
		$this->productos->update($id,['activo' => 1]);
		return redirect()->to(base_url().'/productos');
	}

	public function buscarPorCodigo($codigo)
	{
		$this->productos->select('*');
		$this->productos->where('codigo', $codigo);
		$this->productos->where('activo', 1);
		$datos = $this->productos->get()->getRow();

		$res ['existe'] = false;
		$res ['datos'] = '';
		$res ['error'] = '';
		
		if($datos)
		{
			$res['datos'] = $datos;
			$res['existe'] = true;
		}else
		{
			$res['error'] = 'No existe el producto';
			$res['existe'] = false;
		}

		echo json_encode($res);
	}

	public function autocompleteData()
	{	
		$returnData = array();
		$valor = $this->request->getGet('term');

		$productos= $this->productos->like('codigo', $valor)->where('activo', 1)->findAll();

		if(!empty($productos))
		{
			foreach($productos as $row)
			{
				$data['id'] = $row['id'];
				$data['value'] = $row['codigo'];
				$data['value'] = $row['codigo']. ' - '. $row['nombre'];
				array_push(	$returnData, $data);
			}
		}
		echo json_encode($returnData);
	}
}