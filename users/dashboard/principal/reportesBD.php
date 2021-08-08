<?php
include_once '../../../facturas/reporteGeneral.php';
include_once '../../../dao/conexion.php';
//Consulta sql
$sql_mostrar_publi = "SELECT * FROM tblUsuario";
//Prepara sentencia
$consultar_mostrar_publi = $pdo->prepare($sql_mostrar_publi);
//Ejecutar consulta
$consultar_mostrar_publi->execute();

$pdf = new PDF('L', 'mm', 'letter'); //Constructor -> Recibe tres parametros. P-Vertical, L-Horizontal
$pdf->AddPage(); //Añade nueva página
$pdf->AliasNbPages(); //Para que trabaje el Alias {nb}
$pdf->SetFont('Arial', 'B', 18); //Estilos para el titulo
$pdf->Cell(120, 12, 'Lista de Usuarios', 0, 1, 'C');
$pdf->Ln(10);

//Encabezado de la tabla
$pdf->SetFillColor(232, 232, 230);//Defino un color
$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(40, 12, 'Nombre', 1, 0, 'C', 1);//Último parametro, da color y recibe lo de linea 19
$pdf->Cell(40, 12, 'Apellido', 1, 0, 'C', 1);
$pdf->Cell(180, 12, 'Correo', 1, 1, 'C', 1);

//Cuerpo de la tabla
$pdf->SetFont('Arial', '', 12);



while ($resultado_mostrar_publi = $consultar_mostrar_publi->fetch(PDO::FETCH_OBJ)) {
    $pdf->Cell(40, 12, utf8_decode($resultado_mostrar_publi->nombresUsuario), 1, 0, 'C', 0); //Celda
    $pdf->Cell(40, 12, utf8_decode($resultado_mostrar_publi->apellidoUsuario), 1, 0, 'C', 0); //Celda
    $pdf->Cell(180, 12, utf8_decode($resultado_mostrar_publi->emailUsuario), 1, 1, 'C', 0); //Celda
}
$pdf->Output(); //I->Mostrar en el navegador,D->Forzando a descargar, F->Guardar en fichero local, S->
