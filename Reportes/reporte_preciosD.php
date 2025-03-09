<?php
require '../fpdf/fpdf.php';
require_once '../modelo/conexion.php';
require_once '../modelo/claseDolar.php';

$dolar = new Dolar();

$precios = $dolar->obtenerTodosLosPrecios();

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetTitle('CASA DE LOS GRANOS');

$pdf->Image('../Vistas/header/logo.png', 10, 10, 50);
$pdf->Ln(10);

$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, utf8_decode('Reporte de Precios del Dólar'), 0, 1, 'C');
$pdf->Ln(10);

$ancho_pagina = $pdf->GetPageWidth();
$ancho_celda = 80 + 80 + 1 + 1; 
$posicion_x = ($ancho_pagina - $ancho_celda) / 2;

$pdf->SetFont('Arial', 'B', 12);
$pdf->SetX($posicion_x);
$pdf->Cell(80, 10, 'Precio (USD)', 1, 0, 'C');
$pdf->Cell(80, 10, utf8_decode('Fecha de Actualización'), 1, 1, 'C');

$pdf->SetFont('Arial', '', 12);
foreach ($precios as $precio) {
    $pdf->SetX($posicion_x); 
    $pdf->Cell(80, 10, $precio['precio'], 1, 0, 'C');
    $pdf->Cell(80, 10, $precio['fecha_actualizacion'], 1, 1, 'C');
}

$pdf->Output();
?>
