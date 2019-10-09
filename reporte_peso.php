<?php
	require('fpdf/fpdf.php');


class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('images/10.jpg',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(50,10,'Reporte de peso',0,0,'C');
    // Salto de línea
    $this->Ln(20);
    $this->Cell(70, 10, 'fecha', 1, 0,'C',0);
    $this->Cell(70, 10, 'peso', 1, 0,'C',0);
    $this->Cell(45, 10, 'unidad medida', 1, 1,'C',0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Pagina ').$this->PageNo().'/{nb}',0,0,'C');
}
}

require 'api/config.php';
$consulta = "SELECT *FROM peso";
$resultado = $mysqli->query($consulta);

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

while ($row = $resultado->fetch_assoc()) {
	$pdf->Cell(70, 10, $row['fecha'], 1, 0,'C',0);
	$pdf->Cell(70, 10, $row['peso'], 1, 0,'C',0);
    $pdf->Cell(45, 10, $row['uni_medida'], 1, 0,'C',0);

}

$pdf->Output();
?>