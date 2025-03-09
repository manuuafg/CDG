<?php
require '../fpdf/fpdf.php';
require_once '../modelo/conexion.php';
require_once '../modelo/claseProducto.php';
require_once '../Controlador/controlDolar.php'; 

// Recuperar el parámetro de categoría de la URL
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : null;

$conn = Conexion::conectar();
$productoModel = new Producto($conn);

// Filtrar productos por categoría si se proporciona
if ($categoria !== null) {
    $productos = $productoModel->listar($categoria); // Filtrar por categoría
} else {
    $productos = $productoModel->listar(); // Obtener todos los productos
}

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetTitle('CASA DE LOS GRANOS');

$pdf->Image('../Vistas/header/logo.png', 10, 10, 50); 
$pdf->Ln(10);
$pdf->SetFont('Arial','B',16);

$pdf->Cell(0,10, 'Reporte de Productos',0,1,'C');
$pdf->Ln(10);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,10,'ID',1,0,'C');
$pdf->Cell(40,10,'Nombre',1,0,'C');
$pdf->Cell(40,10,'Proveedor',1,0,'C');
$pdf->Cell(30,10,utf8_decode('Categoría'),1,0,'C');
$pdf->Cell(20,10,'Costo',1,0,'C');
$pdf->Cell(20,10,'PVP',1,0,'C');
$pdf->Cell(30,10,'Bs.',1,1,'C');

$pdf->SetFont('Arial','',5.9);
foreach($productos as $producto) {
    $pdf->Cell(10,6.5,$producto->idProducto,1,0,'C');
    $pdf->Cell(40,6.5,utf8_decode($producto->nombre),1,0,'C');
    $pdf->Cell(40,6.5,utf8_decode($producto->nombreP),1,0,'C');
    $pdf->Cell(30,6.5,utf8_decode($producto->nombreC),1,0,'C');
    $pdf->Cell(20,6.5,'$'.$producto->costo,1,0,'C');
    $pdf->Cell(20,6.5,'$'.$producto->pvp,1,0,'C');

    $controlDolar = new ControlDolar(); 
    $ultimoPrecioDolar = $controlDolar->obtenerUltimoPrecioDolar();
    if ($ultimoPrecioDolar !== false) {
        $precioEnBolivares = $producto->pvp * $ultimoPrecioDolar['precio'];
        $precioFormateado = number_format($precioEnBolivares, 2, '.', '');
        $pdf->Cell(30,6.5,'Bs.S'.$precioFormateado,1,1,'C');
    } else {
        $pdf->Cell(30,6.5,'No se pudo obtener el precio del dólar',1,1,'C');
    }
}
$pdf->Output();
?>