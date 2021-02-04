<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoriasModel;

class Categorias extends BaseController
{
	protected $categorias;
	protected $reglas;

	public function __construct()
	{
		$this->categorias = new CategoriasModel();

		helper(['form']);

		$this->reglas = [
			'codigo' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'El campo {field} es obligatorio'
				]
			],
			'nombre' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'El campo {field} es obligatorio'
				]
			]		
				
		];
	}

	public function index($activo = 1)
	{
		$categorias = $this->categorias->where('activo', $activo)->findAll();
		$data = ['titulo' => 'Categorias', 'datos' => $categorias];
		echo view('header');
		echo view('/categorias/categorias', $data);
		echo view('footer');
	}

	public function eliminados($activo = 0)
	{
		$categorias = $this->categorias->where('activo', $activo)->findAll();
		$data = ['titulo' => 'Categorias Eliminadas', 'datos' => $categorias];
		echo view('header');
		echo view('/categorias/eliminados', $data);
		echo view('footer');
	}

	public function nuevo()
	{
		
		$data = ['titulo' => 'Agregar Categoria'];

		echo view('header');
		echo view('/categorias/nuevo', $data);
		echo view('footer');
	}

	public function insertar()
	{
		if($this->request->getMethod() == 'post' && $this->validate($this->reglas))
		{
		$this->categorias->save(['codigo' => $this->request->getPost('codigo'),
								'nombre' => $this->request->getPost('nombre')]
								//'imagen' => $this->request->getPost('imagen'),
								);
		return redirect()->to(base_url().'/categorias');
		}
		else
		{
			$data = ['titulo' => 'Agregar Categoria', 'validation' => $this->validator];

			echo view('header');
			echo view('/categorias/nuevo', $data);
			echo view('footer');
		}
		
		
	}

	public function editar($id, $valid = null)
	{
		$categoria = $this->categorias->where('id', $id)->first();

		if($valid != null)
		{
			$data = ['titulo' => 'Editar Categoria', 'datos' => $categoria, 'validation' => $valid];
		}else
		{
			$data = ['titulo' => 'Editar Categoria', 'datos' => $categoria];
		}
		
		echo view('header');
		echo view('/categorias/editar', $data);
		echo view('footer');
	}

	public function actualizar()
	{
		if($this->request->getMethod() == 'post' && $this->validate($this->reglas))
		{
		
			$this->categorias->update($this->request->getPost('id'),
									['codigo' => $this->request->getPost('codigo'),
								   	 'nombre' => $this->request->getPost('nombre')]
								//'imagen' => $this->request->getPost('imagen'),
								);
			return redirect()->to(base_url().'/categorias');
		}else
		{
			return $this->editar($this->request->getPost('id'), $this->validator);
		}
	}

	public function eliminar($id)
	{
		
		$this->categorias->update($id,['activo' => 0]);
		return redirect()->to(base_url().'/categorias');
	}

	public function reingresar($id)
	{
		
		$this->categorias->update($id,['activo' => 1]);
		return redirect()->to(base_url().'/categorias');
	}

}