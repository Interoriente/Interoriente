<?php

use Google\Service\Directory\Alias;

require('fpdf.php');
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        /* // Logo
        $this->Image('logo.png', 10, 8, 33); */
        // Arial bold 15
        $this->SetFont('Arial', 'B', 18);
        // Movernos a la derecha
        $this->Cell(60);
        // Título
        $this->Cell(70, 10, 'Reporte de productos', 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);

        $this->Cell(90, 10, 'Nombre', 1, 0, 'C', 0);
        $this->Cell(30, 10, utf8_decode('Descripción'), 1, 0, 'C', 0);
        $this->Cell(30, 10, 'Costo', 1, 1, 'C', 0);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

include_once '../dao/conexion.php';
$sql_mostrar_publi = "SELECT * FROM tblPublicacion";
//Prepara sentencia
$consultar_mostrar_publi = $pdo->prepare($sql_mostrar_publi);
//Ejecutar consulta
$consultar_mostrar_publi->execute();

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 16);

while ($resultado_mostrar_publi = $consultar_mostrar_publi->fetch(PDO::FETCH_OBJ)) {
    $pdf->Cell(90, 10, $resultado_mostrar_publi->nombrePublicacion, 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $resultado_mostrar_publi->descripcionPublicacion, 1, 0, 'C', 0);
    $pdf->Cell(30, 10, $resultado_mostrar_publi->costoPublicacion, 1, 1, 'C', 0);
}
$pdf->Output();
