<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ConfiguracionesModel;

class Configuraciones extends BaseController
{
	protected $configuraciones;
	protected $reglas;

	public function __construct()
	{
		$this->configuraciones = new ConfiguracionesModel();

		helper(['form']);

		$this->reglas = [
			'tienda_nombre' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'El campo {field} es obligatorio'
				]
			],
			'tienda_email' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'El campo {field} es obligatorio'
				]
			]		
				
		];
	}

	public function index($activo = 1)
	{
		
		$nombre = $this->configuraciones->where('nombre', 'tienda_nombre')->first();
		$ruc = $this->configuraciones->where('nombre', 'tienda_ruc')->first();
		$telefono = $this->configuraciones->where('nombre', 'tienda_telefono')->first();
		$correo = $this->configuraciones->where('nombre', 'tienda_email')->first();
		$direccion = $this->configuraciones->where('nombre', 'tienda_direccion')->first();
		$leyenda = $this->configuraciones->where('nombre', 'ticket_leyenda')->first();

		$data = ['titulo' => 'Configuraciones', 'nombre' =>  $nombre,
											    'ruc' =>  $ruc,
											    'telefono' =>  $telefono,
											    'correo' =>  $correo,
											    'direccion' =>  $direccion,
											    'leyenda' =>  $leyenda];

		echo view('header');
		echo view('/configuraciones/configuraciones', $data);
		echo view('footer');
	}

	public function actualizar()
	{
		if($this->request->getMethod() == 'post' && $this->validate($this->reglas))
		{
		
			$this->configuraciones->whereIn('nombre', ['tienda_nombre'])->set(['valor' => $this->request->getPost('tienda_nombre')])->update();
			$this->configuraciones->whereIn('nombre', ['tienda_ruc'])->set(['valor' => $this->request->getPost('tienda_ruc')])->update();
			$this->configuraciones->whereIn('nombre', ['tienda_telefono'])->set(['valor' => $this->request->getPost('tienda_telefono')])->update();
			$this->configuraciones->whereIn('nombre', ['tienda_email'])->set(['valor' => $this->request->getPost('tienda_email')])->update();
			$this->configuraciones->whereIn('nombre', ['tienda_direccion'])->set(['valor' => $this->request->getPost('tienda_direccion')])->update();
			$this->configuraciones->whereIn('nombre', ['ticket_leyenda'])->set(['valor' => $this->request->getPost('ticket_leyenda')])->update();
			
			$validacion = $this->validate([
				'tienda_logo' =>
					'uploaded[tienda_logo]',
					'mime_in[tienda_logo,image/png]',
					'max_size[tienda_logo, 4096]'
			]);

			if($validacion)
			{
				$ruta_logo = "images/logotipo.png";
				if(file_exists($ruta_logo))
				{
					unlink($ruta_logo);	
				}
				$img = $this->request->getFile('tienda_logo');
				$img->move('./images', 'logotipo.png');
			}else
			{
				echo 'Error en la validacion';
				exit;
			}
			//$img->move(WRITEPATH. '/uploads'); guarda en la ruta writable por defecto
			return redirect()->to(base_url().'/configuraciones');
		}else
		{
			//return $this->index($this->request->getPost('id'), $this->validator);
		}
	}

	

}