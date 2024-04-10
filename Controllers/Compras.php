<?php

    class Compras extends Controller
    {
        public function __construct()
        {
            session_start();
            parent::__construct();
        }


        public function index()
        {
            $this->views->getView($this, "index");
        }

        public function buscarCodigo($cod)
        {
            //print_r ($cod);
            $data = $this->model->getProCod($cod);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            //print_r ($data);
            //exit;
        }

        
        public function ingresar()
            {
                //print_r($_POST);
                $id = $_POST['id'];
                $datos = $this->model->getProductos($id);
                //print_r($datos);exit;
                $id_producto = $datos['id'];
                $id_usuario = $_SESSION['id_usuario'];
                $precio = $datos['precio_venta'];
                $cantidad = $_POST['cantidad'];
                $sub_total = $precio*$cantidad;
                //$sub_total = $_POST['sub_total'];
                $comprobar = $this->model->consultarDetalle($id_producto, $id_usuario);
                //print_r($data);exit;
                if(empty($comprobar))
                {
                    $sub_total = $precio*$cantidad;
                    $data = $this->model->registrarDetalle($id_producto, $id_usuario, $precio, $cantidad, $sub_total);
                    if($data == "Ok")
                    {
                        $msg = array('msg' => 'Producto ingresado con exito', 'icono' => 'success');
                    }else{
                        $msg = array('msg' => 'Error al ingresar el producto', 'icono' => 'error');
                    }
                }else{
                    $total_cantidad = $comprobar['cantidad']+$cantidad;
                    $sub_total = $total_cantidad * $precio;
                    $data = $this->model->actualizarDetalle($precio, $total_cantidad, $sub_total, $id_producto, $id_usuario);
                    if($data == "modificado")
                    {
                        $msg = array('msg' => 'Cantidad modificada con exito', 'icono' => 'success');
                    }else{
                        $msg = array('msg' => 'Error al modificar la cantidad', 'icono' => 'error');
                    }
                }
                echo json_encode($msg, JSON_UNESCAPED_UNICODE);
                die();
            }

        public function listar()
        {
            
            $id_usuario = $_SESSION['id_usuario'];
            $data['detalle'] = $this->model->getDetalle($id_usuario);
            $data['sub_total'] = $this->model->calcularCompra($id_usuario);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }


        public function delete($id)
        {
            //print_r ($id);
            $data = $this->model->deleteDetalle($id);
            if($data == 'ok')
            {
                $msg = 'ok';
            }else{
                $msg = 'Error al eliminar el Producto';
            }
            echo json_encode($msg, JSON_UNESCAPED_UNICODE);
            die();
        }

        public function registrarCompra()
        {
            $id_usuario = $_SESSION['id_usuario'];
            $total = $this->model->calcularCompra($id_usuario);
            //$fecha_compra = date("Y-m-dH-i-s");
            //$fecha_compra = date("YmdHis");
            $data = $this->model->registrarCompras($total['total']);
            if($data == 'ok')
            {
                //Se obtienen datos de la tabla detalle enviando como parametro el id del usuario
                $detalle = $this->model->getDetalle($id_usuario);
                
                $id_compra = $this->model->id_compra();
                foreach ($detalle as $row)
                {
                    $cantidad = $row['cantidad'];
                    $precio = $row['precio'];
                    $sub_total = $cantidad*$precio;
                    $id_producto = $row['id_producto'];
                    $this->model->registrarDetalleCompra($id_compra['id'], $cantidad, $precio, $sub_total, $id_producto);
                    $stock_actual = $this->model->getProductos($id_producto);
                    $stock = $stock_actual['cantidad'] + $cantidad;
                    $this->model->actualizarStock($id_producto, $stock);
                }
                $vaciar = $this->model->vaciarDetalle($id_usuario);
                if ($vaciar == 'ok')
                {
                    $msg = array('msg'=>'ok', 'id_compra' => $id_compra['id']);
                }
                //$msg = "ok";
            }else{
                $msg = "error al realizar la compra";
            }
            echo json_encode($msg);
            die();
        }


        public function generarPdf($id_compra)
        {
            $empresa = $this->model->getEmpresa();
            $productos = $this->model->getProCompra($id_compra);
            //print_r($productos);exit();
            require('Libraries/fpdf/fpdf.php');
            $pdf = new FPDF('P', 'mm', array(80, 200));
            $pdf->AddPage();
            $pdf->setMargins(3,0,0);
            $pdf->setTitle('Factura de venta No. '.$id_compra);
            
            $pdf->SetFont('Arial','B',14);
            $pdf->Cell(65, 10, utf8_decode($empresa['nombre']), 0, 1, 'C');
            $pdf->Image(base_url.'Assets/empresa/logo.png', 60, 10, 20, 20);
            //NIT
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(20, 1, 'NIT: ', 0, 0, 'L');
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(20, 1,$empresa['nit'], 0, 1, 'L');
            //Telefono
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(20, 6, utf8_decode('TELÉFONO: '), 0, 0, 'L');
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(10, 6,$empresa['telefono'], 0, 1, 'L');
            //Direccion
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(20, 1, utf8_decode('DIRECCIÓN: '), 0, 0, 'L');
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(20, 1,$empresa['direccion'], 0, 1, 'L');
            //Mensaje
            //$pdf->SetFont('Arial','B',8);
            //$pdf->Cell(7, 1, 'NIT: ', 0, 0, 'L');
            //$pdf->SetFont('Arial','B',8);
            //$pdf->Cell(20, 6,$empresa['mensaje'], 0, 2, 'L');
            //Folio
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(20, 6, utf8_decode('FOLIO: '), 0, 0, 'L');
            $pdf->SetFont('Arial','',8);
            $pdf->Cell(20, 6,$id_compra, 0, 1, 'L');
            $pdf->Ln();
            //Encabezado
            $pdf->setFillColor(0,0,0);
            $pdf->setTextColor(255,255,255);
            $pdf->SetFont('Arial','B',8);
            $pdf->Cell(10, 5, 'CANT', 0, 0, 'L', true);
            $pdf->Cell(30, 5, utf8_decode('DESCRIPCIÓN'), 0, 0, 'L', true);
            $pdf->Cell(15, 5, 'PRECIO', 0, 0, 'L', true);
            $pdf->Cell(18, 5, 'SUB TOTAL', 0, 0, 'L', true);
            $pdf->Ln();
            $pdf->setTextColor(0,0,0);
            $total = 0.00;
            foreach ($productos as $row)
            {
                $total = $total+$row['sub_total'];
                $pdf->Cell(10, 5, $row['cantidad'], 0, 0, 'L');
                $pdf->Cell(30, 5, $row['descripcion'], 0, 0, 'L');
                $pdf->Cell(16, 5, $row['precio'], 0, 0, 'L');
                $pdf->Cell(10, 5, number_format($row['cantidad']*$row['precio'],0,',','.'), 0, 1, 'L');
            }
            $pdf->Ln();
            $pdf->Cell(50, 5, 'Total a pagar', 0, 0,'R');
            $pdf->Cell(20, 5, number_format($total, 0, ',', '.'), 0, 1, 'R');

            $pdf->Output();
        }

        public function historial()
        {
            $this->views->getView($this, 'historial');
        }

        public function listar_historial()
        {
            $data = $this->model->getHistorialCompras();
            for ($i=0;$i < count($data);$i++)
            {
                $data[$i]['acciones'] = '<div>
                <a class="btn btn-danger" href="'.base_url."Compras/generarPdf/".$data[$i]['id'].'" target="_blank"><i class="fas fa-file-pdf"></i></a>
                </div>';
            }
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
            die();
        }

    }

?>