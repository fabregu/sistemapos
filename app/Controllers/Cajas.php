<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CajasModel;
use App\Models\ArqueoCajasModel;

class cajas extends BaseController
{
	protected $cajas, $arqueo_model;
	protected $reglas;

	public function __construct()
	{
		$this->cajas = new CajasModel();
		$this->arqueo = new ArqueoCajasModel();

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
		$cajas = $this->cajas->where('activo', $activo)->findAll();
		$data = ['titulo' => 'cajas', 'datos' => $cajas];
		echo view('header');
		echo view('/cajas/cajas', $data);
		echo view('footer');
	}

	public function eliminados($activo = 0)
	{
		$cajas = $this->cajas->where('activo', $activo)->findAll();
		$data = ['titulo' => 'cajas Eliminadas', 'datos' => $cajas];
		echo view('header');
		echo view('/cajas/eliminados', $data);
		echo view('footer');
	}

	public function nuevo()
	{
		
		$data = ['titulo' => 'Agregar Categoria'];

		echo view('header');
		echo view('/cajas/nuevo', $data);
		echo view('footer');
	}

	public function insertar()
	{
		if($this->request->getMethod() == 'post' && $this->validate($this->reglas))
		{
		$this->cajas->save(['codigo' => $this->request->getPost('codigo'),
								'nombre' => $this->request->getPost('nombre')]
								//'imagen' => $this->request->getPost('imagen'),
								);
		return redirect()->to(base_url().'/cajas');
		}
		else
		{
			$data = ['titulo' => 'Agregar Categoria', 'validation' => $this->validator];

			echo view('header');
			echo view('/cajas/nuevo', $data);
			echo view('footer');
		}
		
		
	}

	public function editar($id, $valid = null)
	{
		$categoria = $this->cajas->where('id', $id)->first();

		if($valid != null)
		{
			$data = ['titulo' => 'Editar Categoria', 'datos' => $categoria, 'validation' => $valid];
		}else
		{
			$data = ['titulo' => 'Editar Categoria', 'datos' => $categoria];
		}
		
		echo view('header');
		echo view('/cajas/editar', $data);
		echo view('footer');
	}

	public function actualizar()
	{
		if($this->request->getMethod() == 'post' && $this->validate($this->reglas))
		{
		
			$this->cajas->update($this->request->getPost('id'),
									['codigo' => $this->request->getPost('codigo'),
								   	 'nombre' => $this->request->getPost('nombre')]
								//'imagen' => $this->request->getPost('imagen'),
								);
			return redirect()->to(base_url().'/cajas');
		}else
		{
			return $this->editar($this->request->getPost('id'), $this->validator);
		}
	}

	public function eliminar($id)
	{
		
		$this->cajas->update($id,['activo' => 0]);
		return redirect()->to(base_url().'/cajas');
	}

	public function reingresar($id)
	{
		
		$this->cajas->update($id,['activo' => 1]);
		return redirect()->to(base_url().'/cajas');
	}

	public function arqueo($idCaja)
	{
		$arqueos = $this->arqueo_model->getDatos($idCaja);
		$data = ['titulo' => 'Cierres de Caja', $arqueos];
		echo view('header');
		echo view('cajas/arqueos', $data);
		echo view('footer');
	}
}
