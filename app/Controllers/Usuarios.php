<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuariosModel;
use App\Models\CajasModel;
use App\Models\RolesModel;

class Usuarios extends BaseController
{
	protected $usuarios, $cajas, $roles;
	protected $reglas, $reglasLogin, $reglasCambioPass;

	public function __construct()
	{
		$this->usuarios = new UsuariosModel();
		$this->cajas = new CajasModel();
		$this->roles = new RolesModel();

		helper(['form']);

		$this->reglas = [
			'usuario' => [
				'rules' => 'required|is_unique[usuarios.usuario ]',
				'errors' => [
					'required' => 'El campo {field} es obligatorio',
					'is_unique' => 'El {field} debe ya está siendo usado. Pruebe otro diferente.'
				]
			],
			'nombre' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'El campo {field} es obligatorio'
				]
			],
			'password' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'El campo {field} es obligatorio'
				]
			],		
			'repassword' => [
				'rules' => 'required|matches[password]',
				'errors' => [
					'required' => 'El campo {field} es obligatorio',
					'matches' => 'Las contraseñas no coindiden.'
				]
			],
			'id_cajas' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'El campo {field} es obligatorio'
				]
			],	
			'id_roles' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'El campo {field} es obligatorio'
				]
			],		
		];

		$this->reglasLogin = [
			'usuario' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Ingrese un usuario'
				]
			],	
			'password' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Ingrese la contraseña'
				]
			]
		];

		$this->reglasCambioPass = [
			'password' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Ingrese una contraseña'
				]
			],
			'repassword' => [
				'rules' => 'required|matches[password]',
					'errors' => [
						'required' => 'El campo {field} es obligatorio',
						'matches' => 'Las contraseñas no coindiden.'
				]
			],
		];
	}

	public function index($activo = 1)
	{
		$usuarios = $this->usuarios->where('activo', $activo)->findAll();
		$data = ['titulo' => 'Usuarios', 'datos' => $usuarios];
		echo view('header');
		echo view('/usuarios/usuarios', $data);
		echo view('footer');
	}

	public function eliminados($activo = 0)
	{
		$usuarios = $this->usuarios->where('activo', $activo)->findAll();
		$data = ['titulo' => 'Usuario Eliminados', 'datos' => $usuarios];
		echo view('header');
		echo view('/usuarios/eliminados', $data);
		echo view('footer');
	}

	public function nuevo()
	{
		$cajas = $this->cajas->where('activo', 1)->findAll();
		$roles = $this->roles->where('activo', 1)->findAll();

		$data = ['titulo' => 'Agregar Usuario', 'cajas' => $cajas, 'roles' => $roles];

		echo view('header');
		echo view('/usuarios/nuevo', $data);
		echo view('footer');
	}

	public function insertar()
	{
		if($this->request->getMethod() == 'post' && $this->validate($this->reglas))
		{
			$hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

			$this->usuarios->save(['usuario' => $this->request->getPost('usuario'),
								  'password' => $hash,
								  'nombre' => $this->request->getPost('nombre'),
								 'id_cajas' => $this->request->getPost('id_cajas'),
								 'id_roles' => $this->request->getPost('id_roles')]
								);
			return redirect()->to(base_url().'/usuarios');
		}else
		{
			$roles = $this->roles->where('activo', 1)->findAll();
			$cajas = $this->cajas->where('activo', 1)->findAll();
			$data = ['titulo' => 'Agregar Usuario', 'cajas' => $cajas, 'roles' => $roles, 'validation' => $this->validator];
			echo view('header');
			echo view('/usuarios/nuevo', $data);
			echo view('footer');
		}
	}

	public function editar($id, $valid = null)
	{
		$usuarios = $this->usuarios->where('id', $id)->first();
		$cajas = $this->cajas->where('activo', 1)->findAll();
		$roles = $this->roles->where('activo', 1)->findAll();


		if($valid != null)
		{
			$data = ['titulo' => 'Editar Usuario', 'datos' => $usuarios, 'cajas' => $cajas, 'roles' => $roles, 'validation' => $valid];

		}else
		{
			$data = ['titulo' => 'Editar Usuario', 'datos' => $usuarios, 'cajas' => $cajas, 'roles' => $roles];
		}
		echo view('header');
		echo view('/usuarios/editar', $data);
		echo view('footer');
	}

	public function actualizar()
	{
		if($this->request->getMethod() == 'post' && $this->validate($this->reglas))
		{
			$hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
			$this->usuarios->update($this->request->getPost('id'),
									['usuario' => $this->request->getPost('usuario'),
									'password' => $hash,
									'nombre' => $this->request->getPost('nombre'),
								    'id_cajas' => $this->request->getPost('id_cajas'),
								    'id_roles' => $this->request->getPost('id_roles')]
								);
			return redirect()->to(base_url().'/usuarios');
		}else
		{
			return $this->editar($this->request->getPost('id'), $this->validator);
		}
		
	}

	public function eliminar($id)
	{
		
		$this->usuarios->update($id,['activo' => 0]);
		return redirect()->to(base_url().'/usuarios');
	}

	public function reingresar($id)
	{
		
		$this->usuarios->update($id,['activo' => 1]);
		return redirect()->to(base_url().'/usuarios');
	}

	public function login()
	{
		echo view('login');
	}

	public function valida()
	{
		if($this->request->getMethod() == 'post' && $this->validate($this->reglasLogin))
		{
			$usuario =$this->request->getPost('usuario');
			$password = $this->request->getPost('password');
			$datosUsuario = $this->usuarios->where('usuario', $usuario)->first();
			
			if($datosUsuario != null)
			{
				 if(password_verify($password, $datosUsuario['password']))
				 {
					$datosSesion = [
						'id_usuario' => $datosUsuario['id'],
						'nombre' => $datosUsuario['nombre'],
						'id_caja' => $datosUsuario['id_cajas'],
						'id_rol' => $datosUsuario['id_roles']
					];

					$session = session();
					$session->set($datosSesion);
					return redirect()->to(base_url(). '/configuraciones');
				 }else
				 {
					$data['error'] = 'Usuario o contraseñas incorrectas';
					echo view('login', $data);
				 } 
			}
			else
			{
				$data['error'] = 'Usuario o contraseñas incorrectas';
				echo view('login', $data);
			}
		}else
		{
			$data = ['Mensaje' => '', 'validation' => $this->validator];
			echo view('login', $data);
		}
	}

	public function cambia_password()
	{
		$session = session();
		$usuario = $this->usuarios->where('id', $session->id_usuario)->first();
		$data = ['titulo' => 'Cambiar Contraseña', 'usuario' => $usuario];

		echo view('header');
		echo view('usuarios/cambia_password', $data);
		echo view('footer');
	}

	public function actualizar_password()
	{
		if($this->request->getMethod() == 'post' && $this->validate($this->reglasCambioPass))
		{
			$session = session();
			$idUsuario = $session->id_usuario;
			$hash = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);

			$this->usuarios->update($idUsuario, ['password' => $hash]);

			$usuario = $this->usuarios->where('id', $session->id_usuario)->first();

			$data = ['titulo' => 'Cambiar Contraseña', 'usuario' => $usuario, 'mensaje' => 'Contraseña actualizada'];
			echo view('header');
			echo view('/usuarios/cambia_password', $data);
			echo view('footer');
		}else
		{
			$session = session();
			$usuario = $this->usuarios->where('id', $session->id_usuario)->first();
			$data = ['titulo' => 'Cambiar Contraseña', 'usuario' => $usuario,  'validation' => $this->validator];

			echo view('header');
			echo view('usuarios/cambia_password', $data);
			echo view('footer');
			echo view('footer');
			}
	}

	public function logout()
	{
		$session = session();
		$session->destroy();
		return redirect()->to(base_url());
	}

	
}




