<?php
require '../fpdf/fpdf.php';
require_once '../modelo/conexion.php';

$conn = Conexion::conectar();

$query = "SELECT * FROM categoria";
$resultado = $conn->query($query);

$categorias = array();
if ($resultado) {
    while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
        $categorias[] = $fila;
    }
}

$pdf = new FPDF();
$pdf->AddPage();

$pdf->SetTitle('CASA DE LOS GRANOS');

$pdf->AliasNbPages();

$pdf->Image('../Vistas/header/logo.png', 10, 10, 50); 
$pdf->Ln(10);

$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10, 'Reporte de Categorias',0,1,'C');
$pdf->Ln(10);


$ancho_pagina = $pdf->GetPageWidth();
$ancho_celda = 20 + 90 + 1 + 1; 
$posicion_x = ($ancho_pagina - $ancho_celda) / 2;

$pdf->SetFont('Arial','B',12);
$pdf->SetX($posicion_x); 
$pdf->Cell(15,10,'ID',1,0,'C');
$pdf->Cell(90,10,'Nombre',1,1,'C');

$pdf->SetFont('Arial','',12);
foreach($categorias as $categoria) {
    $pdf->SetX($posicion_x); 
    $pdf->Cell(15,10,$categoria['idCategoria'],1,0,'C');
    $pdf->Cell(90,10,utf8_decode($categoria['nombreC']),1,1,'C');
}

function Footer() {
    global $pdf;
    if ($pdf->PageNo() > 1) {
        $pdf->SetY(-15);
        $pdf->SetFont('Arial', 'I', 8);
        $pdf->Cell(0, 10, 'Página ' . $pdf->PageNo(), 0, 0, 'C');
    }
}

$pdf->Output();
?>
