<?php
include_once 'reporteGeneral.php';
$pdf = new PDF(); //Constructor -> Recibe tres parametros. P-Vertical, L-Horizontal
$pdf->AddPage(); //Añade nueva página
$pdf->AliasNbPages(); //Para que trabaje el Alias {nb}
$pdf->SetFont('Arial', 'B', 18); //Estilos del pdf
$pdf->Cell(120, 12, 'Reporte Productos', 0, 1, 'R', 0);

$pdf->SetFont('Arial', '', 12);
for ($i = 1; $i <= 80; $i++) {
    $pdf->Cell(120, 12, 'Hola mundo', 0, 1);
}
$pdf->Output(); //I->Mostrar en el navegador,D->Forzando a descargar, F->Guardar en fichero local, S->
