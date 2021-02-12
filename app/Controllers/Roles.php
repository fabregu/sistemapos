<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RolesModel;
use App\Models\PermisosModel;
use App\Models\DetallesRolesPermisosModel;

class Roles extends BaseController
{
	protected $roles, $permisos, $detalleRoles;
	protected $reglas;

	public function __construct()
	{
		$this->roles = new RolesModel();
		$this->permisos = new PermisosModel();
		$this->detalleRoles = new DetallesRolesPermisosModel();

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
		$roles = $this->roles->where('activo', $activo)->findAll();
		$data = ['titulo' => 'Roles', 'datos' => $roles];
		echo view('header');
		echo view('/roles/roles', $data);
		echo view('footer');
	}

	public function eliminados($activo = 0)
	{
		$roles = $this->roles->where('activo', $activo)->findAll();
		$data = ['titulo' => 'roles Eliminadas', 'datos' => $roles];
		echo view('header');
		echo view('/roles/eliminados', $data);
		echo view('footer');
	}

	public function nuevo()
	{
		
		$data = ['titulo' => 'Agregar Roles'];

		echo view('header');
		echo view('/roles/nuevo', $data);
		echo view('footer');
	}

	public function insertar()
	{
		if($this->request->getMethod() == 'post' && $this->validate($this->reglas))
		{
		$this->roles->save(['codigo' => $this->request->getPost('codigo'),
								'nombre' => $this->request->getPost('nombre')]
								//'imagen' => $this->request->getPost('imagen'),
								);
		return redirect()->to(base_url().'/roles');
		}
		else
		{
			$data = ['titulo' => 'Agregar Categoria', 'validation' => $this->validator];

			echo view('header');
			echo view('/roles/nuevo', $data);
			echo view('footer');
		}
		
		
	}

	public function editar($id, $valid = null)
	{
		$rol = $this->roles->where('id', $id)->first();

		if($valid != null)
		{
			$data = ['titulo' => 'Editar Categoria', 'datos' => $rol, 'validation' => $valid];
		}else
		{
			$data = ['titulo' => 'Editar Categoria', 'datos' => $rol];
		}
		
		echo view('header');
		echo view('/roles/editar', $data);
		echo view('footer');
	}

	public function actualizar()
	{
		if($this->request->getMethod() == 'post' && $this->validate($this->reglas))
		{
		
			$this->roles->update($this->request->getPost('id'),
									['codigo' => $this->request->getPost('codigo'),
								   	 'nombre' => $this->request->getPost('nombre')]
								//'imagen' => $this->request->getPost('imagen'),
								);
			return redirect()->to(base_url().'/roles');
		}else
		{
			return $this->editar($this->request->getPost('id'), $this->validator);
		}
	}

	public function eliminar($id)
	{
		
		$this->roles->update($id,['activo' => 0]);
		return redirect()->to(base_url().'/roles');
	}

	public function reingresar($id)
	{
		
		$this->roles->update($id,['activo' => 1]);
		return redirect()->to(base_url().'/roles');
	}

	public function detalles($id_rol)
	{	
		$permisos = $this->permisos->findAll();
		$permisosAsignados = $this->detalleRoles->where('id_rol', $id_rol)->findAll();
		$datos = array();

		foreach($permisosAsignados as $permisoAsignado)
		{
			$datos[$permisoAsignado['id_permiso']] = true;
		}

		$data = ['titulo' => 'Asignar Permisos', 'permisos' => $permisos, 'id_rol' => $id_rol, 'asignado' => $datos];

		echo view('header');
		echo view('roles/detalles', $data);
		echo view('footer');
	}

	public function guardaPermisos()
	{
		if($this->request->getMethod('post'))
		{
			$id_rol = $this->request->getPost('id_rol');
			$permisos = $this->request->getPost('permisos');


			$this->detalleRoles->where('id_rol', $id_rol)->delete();

			foreach($permisos as $permiso)
			{
				$this->detalleRoles->save(['id_rol' => $id_rol, 'id_permiso' => $permiso]);
			}
		}
		return redirect()->to(base_url(). "/roles");
	}
}