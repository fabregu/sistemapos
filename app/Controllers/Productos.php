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

			$id= $this->productos->insertID();	//Generamos el id del prod. para asi guardar cada imagen				
			$validacion = $this->validate([
				'img_producto' =>
					'uploaded[img_producto]',
					'mime_in[img_producto,image/jpg,image/jpeg]',
					'max_size[img_producto, 4096]'
			]);

			if($validacion)
			{
				$ruta_img = "images/productto/".$id.".jpg";
				if(file_exists($ruta_img))
				{
					unlink($ruta_img);	
				}
				$img = $this->request->getFile('img_producto');
				$img->move('./images/productos', $id. '.jpg');
			}else
			{
				echo 'Error en la validacion';
				exit;
			}					
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

	public function muestraCodigos()
	{
		echo view('header');
		echo view('/productos/ver_codigo');
		echo view('footer');
	}

	public function generaBarras()
	{
		$pdf = new \FPDF('P', 'mm', 'letter');
		$pdf->AddPage();
		$pdf->SetMargins(10,10,10);
		$pdf->SetTitle("Codigo de Barras");

		$productos = $this->productos->where('activo', 1)->findAll();
		foreach($productos as $producto)
		{
			$codigo = $producto['codigo'];

		
			$generabarcode = new \barcode_genera();
			$generabarcode->barcode("images/barcode/".$codigo.".png", $codigo, 20, "horizontal", "code39", true);
		
			$pdf->Image("images/barcode/".$codigo.".png");
			//unlink("images/barcode/".$codigo.".png"); borramos las imagenes que genera

		}
		$this->response->setHeader('Content-Type', 'application/pdf');
		$pdf->Output('Codigo.pdf', 'I');
	}

	
	public function muestraMinimos()
	{
		echo view('header');
		echo view('productos/ver_minimos');
		echo view('footer');
	}

	public function generaMinimosPdf()
	{
		$pdf = new \FPDF('P', 'mm', 'letter');
		$pdf->AddPage();
		$pdf->SetMargins(10,10,10);
		$pdf->SetTitle("Productos con Stock Minimo");

		$pdf->SetFont("Arial", "B", 10);
		$pdf->Image("images/logotipo.png", 10, 10, 20);

		$pdf->Cell(0, 5, utf8_decode("Reporte de Producto con stock mínimo"), 0, 1, 'C');
		$pdf->Ln(15);

		$pdf->Cell(40, 5, utf8_decode("Código"),1, 0, 'C');
		$pdf->Cell(90, 5, utf8_decode("Nombre"),1, 0, 'C');
		$pdf->Cell(30, 5, utf8_decode("Cantidad"),1, 0, 'C');
		$pdf->Cell(30, 5, utf8_decode("Stock Mínimo"),1, 1, 'C');

		$datosProducto =$this->productos->getStockMinimo();
		foreach($datosProducto as $producto)
		{
			$pdf->Cell(40, 5, $producto['codigo'],1, 0, 'C');
			$pdf->Cell(90, 5, utf8_decode($producto['nombre']),1, 0, 'C');
			$pdf->Cell(30, 5, $producto['cantidad'],1, 0, 'C');
			$pdf->Cell(30, 5, $producto['alerta_cantidad'],1, 1, 'C');	
		}

		$this->response->setHeader('Content-Type', 'application/pdf');
		$pdf->Output('ProductoMinimo.pdf', 'I');
	}
}