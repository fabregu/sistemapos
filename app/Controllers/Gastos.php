<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GastosModel;

class Gastos extends BaseController
{
	protected $gastos;
	protected $reglas;

	public function __construct()
	{
		$this->gastos = new GastosModel();

		helper(['form']);

		$this->reglas = [
			'referencia' =>[
				'rules' => 'required',
				'errors' => [
					'required' => 'El campo {field} es obligatorio.'
				]
			],
			'monto' =>[
				'rules' => 'required',
				'errors' => [
					'required' => 'El campo {field} es obligatorio.'
				]
			],
			'creado_por' =>[
				'rules' => 'required',
				'errors' => [
					'required' => 'El campo {field} es obligatorio.'
				]
			]
		];

	}

	public function index($activo = 1)
	{
		$gastos = $this->gastos->where('activo', $activo)->findAll();
		$data = ['titulo' => 'Gastos', 'datos' => $gastos];
		echo view('header');
		echo view('/gastos/gastos', $data);
		echo view('footer');
	}

	public function eliminados($activo = 0)
	{
		$gastos = $this->gastos->where('activo', $activo)->findAll();
		$data = ['titulo' => 'Gastos Eliminados', 'datos' => $gastos];
		echo view('header');
		echo view('/gastos/eliminados', $data);
		echo view('footer');
	}

	public function nuevo()
	{
		
		$data = ['titulo' => 'Agregar gastos'];

		echo view('header');
		echo view('/gastos/nuevo', $data);
		echo view('footer');
	}

	public function insertar()
	{
		if($this->request->getMethod() == 'post' && $this->validate($this->reglas))
		{
			$this->gastos->save(['fecha' => $this->request->getPost('fecha'),
							 'referencia' => $this->request->getPost('referencia'),
							 'monto' => $this->request->getPost('monto'),
							 'nota' => $this->request->getPost('nota'),
							 'creado_por' => $this->request->getPost('creado_por'),
							 'adjunto' => $this->request->getPost('adjunto')]
								);
		return redirect()->to(base_url().'/gastos');
		}
		else
		{
			$gastos = $this->gastos->where('activo', 1)->findAll();
			$data = ['titulo' => 'Agregar gastos', 'validation' => $this->validator];
			echo view('header');
			echo view('/gastos/nuevo', $data);
			echo view('footer');
		}
		
	}

	public function editar($id, $valid = null)
	{
		$gastos = $this->gastos->where('id', $id)->first();
		
		if($valid != null)
		{
			$data = ['titulo' => 'Editar gastos', 'datos' => $gastos, 'validation' => $valid];
		}else
		{
			$data = ['titulo' => 'Editar gastos', 'datos' => $gastos];
		}
			echo view('header');
			echo view('/gastos/editar', $data);
			echo view('footer');
	}

	public function actualizar()
	{
		if($this->request->getMethod() == 'post' && $this->validate($this->reglas))
		{
			$this->gastos->update($this->request->getPost('id'),
							['fecha' => $this->request->getPost('fecha'),
							 'referencia' => $this->request->getPost('referencia'),
							 'monto' => $this->request->getPost('monto'),
							 'creado_por' => $this->request->getPost('creado_por'),
							 'adjunto' => $this->request->getPost('adjunto')]
								);
		return redirect()->to(base_url().'/gastos');
		}else
		{
			return $this->editar($this->request->getPost('id'), $this->validator);
		}
		
	}

	public function eliminar($id)
	{
		
		$this->gastos->update($id,['activo' => 0]);
		return redirect()->to(base_url().'/gastos');
	}

	public function reingresar($id)
	{
		
		$this->gastos->update($id,['activo' => 1]);
		return redirect()->to(base_url().'/gastos');
	}

}