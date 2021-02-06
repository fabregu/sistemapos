<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VentasModel;
use App\Models\TemporalComprasModel;
use App\Models\DetalleVentaModel;
use App\Models\ProductosModel;
use App\Models\ConfiguracionesModel;

class Ventas extends BaseController
{
	protected $ventas, $temporal_compras, $detalle_venta, $productos, $configuracion;

	public function __construct()
	{
		$this->ventas = new VentasModel();
		$this->detalle_venta = new DetalleVentaModel();
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

	public function pos()
	{

		echo view('header');
		echo view('/ventas/caja');
		echo view('footer');
	}

	public function guarda()
	{
			$id_venta = $this->request->getPost('id_venta');
			$total = preg_replace('/[\$,]/', '', $this->request->getPost('total'));
			$forma_pago = $this->request->getPost('forma_pago');
			$id_cliente = $this->request->getPost('id_cliente');

			$session = session();

			$resultadoId = $this->ventas->insertaVenta($id_venta, $total, $session->id_usuario, $session->id_caja, $id_cliente, $forma_pago);

			$this->temporal_compras = new TemporalComprasModel();

			if($resultadoId)
			{
				$resultadoCompra = $this->temporal_compras->porCompra($id_venta);

				foreach($resultadoCompra as $row)
				{
					$this->detalle_venta->save([
						'id_venta' => $resultadoId,
						'id_producto' =>$row['id_producto'],
						'nombre' =>$row['nombre'],
						'cantidad' =>$row['cantidad'],
						'precio' =>$row['precio']
					]);
					$this->productos = new ProductosModel();
					$this->productos->actualizaStock($row['id_producto'],$row['cantidad'], '-');
				}

				$this->temporal_compras->eliminarCompra($id_venta);
			}
			return redirect()->to(base_url(). "/ventas/muestraTicket/" . $resultadoId);
	}

	public function muestraTicket($id_venta)
	{
		$data['id_venta'] = $id_venta;
		echo view('header');
		echo view('/ventas/ver_ticket', $data);
		echo view('footer');
	}

	public function generaTicket($id_venta)
	{
		$datosVenta = $this->ventas->where('id', $id_venta)->first();
		
		$detalle_venta = $this->detalle_venta->select('*')->where('id_venta', $id_venta)->findAll();

		$nombreTienda = $this->configuracion->select('valor')->where('nombre', 'tienda_nombre')->get()->getRow()->valor;
		$direccionTienda = $this->configuracion->select('valor')->where('nombre', 'tienda_direccion')->get()->getRow()->valor;
		$ticketLeyenda = $this->configuracion->select('valor')->where('nombre', 'ticket_leyenda')->get()->getRow()->valor;

		$pdf = new \FPDF('P', 'mm', array(80, 200));
		$pdf->AddPage();
		$pdf->SetMargins(5, 5, 5);
		$pdf->SetTitle('Venta');
		$pdf->SetFont('Arial', 'B', 9);

		$pdf->image(base_url() . '/images/logo.png', 5, 0, 15, 15, 'PNG' );
		$pdf->Cell(70, 5, $nombreTienda, 0, 1, 'C');

		$pdf->Cell(20, 5, utf8_decode('Dirección: '), 0, 0, 'L');
		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(15, 5, $direccionTienda, 0, 1, 'L');

		$pdf->Cell(50, 5, 'Fecha y Hora: '. $datosVenta['fecha_alta'], 0, 1, 'L');

		$pdf->SetFont('Arial', '', 8);
		$pdf->Cell(20, 5, 'Ticket: ', 0, 0, 'L');
		$pdf->Cell(15, 5, $datosVenta['folio'], 0, 1, 'L');

		$pdf->Ln(); //hace un saltode linea en el documento pdf
		$pdf->SetFont('Arial', 'B', 7);

		$pdf->SetTextColor(0, 0, 0);
		$pdf->Cell(7, 5, "Cant,", 0, 0, 'L');
		$pdf->Cell(35, 5, "Nombre", 0, 0, 'L');
		$pdf->Cell(15, 5, "Precio", 0, 0, 'L');
		$pdf->Cell(15, 5, "Importe", 0, 1, 'L');

		$pdf->SetFont('Arial', '', 7);

		$contador = 1;

		foreach($detalle_venta as $row)
		{
			$pdf->Cell(7, 5, $row['cantidad'], 0, 0, 'L');
			$pdf->Cell(35, 5, $row['nombre'], 0, 0, 'L');
			$pdf->Cell(15, 5, $row['precio'], 0, 0, 'L');
			$importe = number_format($row['precio'] * $row['cantidad'],2, '.', ',');
			$pdf->Cell(15, 5, 'S/. ' . $importe, 0, 1, 'R');
			$contador ++;
		}
		$pdf->Ln();
		$pdf->SetFont('Arial', 'B', 9);
		$pdf->Cell(70, 5, 'Total: S/. ' . number_format($datosVenta['total'],0, '.', ','), 0, 1, 'R' );

		$pdf->Ln();
		$pdf->MultiCell(70, 4, $ticketLeyenda, 0, 'C', 0);

		$this->response->setHeader('Content-type', 'aplication.pdf');
		$pdf->Output('ticket.pdf', "I");
	}
	
}
