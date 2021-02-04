<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ComprasModel;
use App\Models\TemporalComprasModel;
use App\Models\DetalleCompraModel;
use App\Models\ProductosModel;
use App\Models\ConfiguracionesModel;

class Compras extends BaseController
{
	protected $compras, $temporal_compras, $detalle_compra, $productos, $configuracion;
	protected $reglas;

	public function __construct()
	{
		$this->compras = new ComprasModel();
		$this->detalle_compra = new DetalleCompraModel();
		$this->productos = new ProductosModel();
		$this->configuracion = new ConfiguracionesModel();

		helper(['form']);

	}

	public function index($activo = 1)
	{
		$compras = $this->compras->where('activo', $activo)->findAll();
		$data = ['titulo' => 'Compras', 'compras' => $compras];
		echo view('header');
		echo view('/compras/compras', $data);
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
			$total = preg_replace('/[\$,]/', '', $this->request->getPost('total'));
							 	
			$session = session();

			$resultadoId = $this->compras->insertaCompra($id_compra, $total, $session->id_usuario);

			$this->temporal_compras = new TemporalComprasModel();

			if($resultadoId)
			{
				$resultadoCompra = $this->temporal_compras->porCompra($id_compra);

				foreach($resultadoCompra as $row)
				{
					$this->detalle_compra->save([
						'id_compra' => $resultadoId,
						'id_producto' =>$row['id_producto'],
						'nombre' =>$row['nombre'],
						'cantidad' =>$row['cantidad'],
						'precio' =>$row['precio']
					]);
					$this->productos = new ProductosModel();
					$this->productos->actualizaStock($row['id_producto'],$row['cantidad']);
				}

				$this->temporal_compras->eliminarCompra($id_compra);
			}
			return redirect()->to(base_url(). "/compras/muestraCompraPdf/" . $resultadoId);
	}

	public function muestraCompraPdf($id_compra)
	{
		$data['id_compra'] = $id_compra;
		echo view('header');
		echo view('/compras/ver_compra_pdf', $data);
		echo view('footer');
	}

	public function generaCompraPdf($id_compra)
	{
		$datosCompra = $this->compras->where('id', $id_compra)->first();
		//$this->detalle_compra->select('*');
		//$this->detalle_compra->where('id', $id_compra);
		//$this->detalle_compra->findAll();
		//Esta forma es igual a lo de arriba per o simplificada
		$detalle_compra = $this->detalle_compra->select('*')->where('id_compra', $id_compra)->findAll();

		$nombreTienda = $this->configuracion->select('valor')->where('nombre', 'tienda_nombre')->get()->getRow()->valor;
		$direccionTienda = $this->configuracion->select('valor')->where('nombre', 'tienda_direccion')->get()->getRow()->valor;

		$pdf = new \FPDF('P', 'mm', 'letter');
		$pdf->AddPage();
		$pdf->SetMargins(10, 10, 10);
		$pdf->SetTitle('Compra');
		$pdf->SetFont('Arial', 'B', 9);

		$pdf->image(base_url() . '/images/logo.png', 185, 10, 20, 20, 'PNG' );
		$pdf->Cell(195, 5, "Entrada de Productos", 0, 1, 'C');

		$pdf->Cell(50, 5, $nombreTienda, 0, 1, 'L');
		$pdf->Cell(20, 5, utf8_decode('Dirección: '), 0, 0, 'L');
		$pdf->SetFont('Arial', '', 9);
		$pdf->Cell(50, 5, $direccionTienda, 0, 1, 'L');

		$pdf->Cell(50, 5, 'Fecha y Hora: '. $datosCompra['fecha_alta'], 0, 1, 'L');

		$pdf->Ln(); //hace un saltode linea en el documento pdf
		$pdf->SetFont('Arial', 'B', 8);
		$pdf->SetFillColor(0, 0, 0);
		$pdf->SetTextColor(255, 255, 255);
		$pdf->Cell(196, 5, 'Detalle de Productos', 1, 1, 'C', 1);

		$pdf->SetTextColor(0, 0, 0);
		$pdf->Cell(14, 5, "Nro", 1, 0, 'L');
		$pdf->Cell(25, 5, "Codigo", 1, 0, 'L');
		$pdf->Cell(77, 5, "Nombre del Producto", 1, 0, 'L');
		$pdf->Cell(25, 5, "Precio", 1, 0, 'L');
		$pdf->Cell(25, 5, "Cantidad", 1, 0, 'L');
		$pdf->Cell(30, 5, "Importe", 1, 1, 'L');

		$pdf->SetFont('Arial', '', 8);

		$contador = 1;

		foreach($detalle_compra as $row)
		{
			$pdf->Cell(14, 5, $contador, 1, 0, 'L');
			$pdf->Cell(25, 5, $row['id_producto'], 1, 0, 'L');
			$pdf->Cell(77, 5, $row['nombre'], 1, 0, 'L');
			$pdf->Cell(25, 5, $row['precio'], 1, 0, 'L');
			$pdf->Cell(25, 5, $row['cantidad'], 1, 0, 'L');
			$importe = number_format($row['precio'] * $row['cantidad'],2, '.', ',');
			$pdf->Cell(30, 5, 'S/. ' . $importe, 1, 1, 'R');
			$contador ++;
		}
		$pdf->Ln();
		$pdf->SetFont('Arial', 'B', 9);
		$pdf->Cell(195, 5, 'Total: S/. ' . number_format($datosCompra['total'],2, '.', ','), 0, 1, 'R' );

		$this->response->setHeader('Content-type', 'aplication.pdf');
		$pdf->Output('compra_pdf.pdf', "I");
	}
	
}