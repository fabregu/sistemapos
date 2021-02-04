<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientesModel;

class Clientes extends BaseController
{
	protected $clientes;
	protected $reglas;

	public function __construct()
	{
		$this->clientes = new ClientesModel();

		helper(['form']);

		$this->reglas = [
			'nombre' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'El campo {field} es obligatorio'
				]
			],
			'celular' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'El campo {field} es obligatorio'
				]
			]		
				
		];
	}

	public function index($activo = 1)
	{
		$clientes = $this->clientes->where('activo', $activo)->findAll();
		$data = ['titulo' => 'Clientes', 'datos' => $clientes];
		echo view('header');
		echo view('/clientes/clientes', $data);
		echo view('footer');
	}

	public function eliminados($activo = 0)
	{
		$clientes = $this->clientes->where('activo', $activo)->findAll();
		$data = ['titulo' => 'Clientes Eliminados', 'datos' => $clientes];
		echo view('header');
		echo view('/clientes/eliminados', $data);
		echo view('footer');
	}

	public function nuevo()
	{
		
		$data = ['titulo' => 'Agregar Clientes'];

		echo view('header');
		echo view('/clientes/nuevo', $data);
		echo view('footer');
	}

	public function insertar()
	{
		if($this->request->getMethod() == 'post' && $this->validate($this->reglas))
		{
			$this->clientes->save(['nombre' => $this->request->getPost('nombre'),
								'celular' => $this->request->getPost('celular'),
								'email' => $this->request->getPost('email')]
								);
			return redirect()->to(base_url().'/clientes');
		}else
		{
			$clientes = $this->clientes->where('activo', 1)->findAll();
			$data = ['titulo' => 'Agregar Cliente', 'validation' => $this->validator];
			echo view('header');
			echo view('/clientes/nuevo', $data);
			echo view('footer');
		}
	}

	public function editar($id, $valid = null)
	{
		$clientes = $this->clientes->where('id', $id)->first();

		if($valid != null)
		{
			$data = ['titulo' => 'Editar Clientes', 'datos' => $clientes, 'validation' => $valid];

		}else
		{
			$data = ['titulo' => 'Editar Cliente', 'datos' => $clientes];
		}
		echo view('header');
		echo view('/clientes/editar', $data);
		echo view('footer');
	}

	public function actualizar()
	{
		if($this->request->getMethod() == 'post' && $this->validate($this->reglas))
		{
			$this->clientes->update($this->request->getPost('id'),
									['nombre' => $this->request->getPost('nombre'),
								   	 'celular' => $this->request->getPost('celular'),
									 'email' => $this->request->getPost('email')]
								);
			return redirect()->to(base_url().'/clientes');
		}else
		{
			return $this->editar($this->request->getPost('id'), $this->validator);
		}
		
	}

	public function eliminar($id)
	{
		
		$this->clientes->update($id,['activo' => 0]);
		return redirect()->to(base_url().'/clientes');
	}

	public function reingresar($id)
	{
		
		$this->clientes->update($id,['activo' => 1]);
		return redirect()->to(base_url().'/clientes');
	}

}