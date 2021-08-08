<?php

require('fpdf.php');
class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->AddLink();
        $this->Image('../../../facturas/img/LogoTerciario.png', 10, 10, 55, 0, '', 'www.interoriente.com.co');
        // Arial bold 15
        $this->SetFont('Arial', 'B', 18);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30, 10, 'Inter-Oriente', 0, 1, 'C');
        //Slogan 
        $this->SetFont('Arial', 'B', 14);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30, 10, utf8_decode('E-Commerce, Oriente Antioqueño'), 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);

        /*  $this->Cell(50, 10, 'Nombre', 1, 0, 'C', 0);
        $this->Cell(120, 10, utf8_decode('Descripción'), 1, 0, 'C', 0);
        $this->Cell(30, 10, 'Costo', 1, 1, 'C', 0); */
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 12);
        $this->AddLink();
        // Número de página
        $this->Cell(5, 10, 'www.interoriente.com.co', 0, 0, 'L');
        $this->SetFont('Arial', 'I', 10);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . ' / {nb}', 0, 0, 'C');
    }
}
