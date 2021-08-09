<?php
include_once '../../../facturas/reporteGeneral.php';
include_once '../../../dao/conexion.php';
//Consulta sql
$sql_mostrar_publi = "SELECT * FROM tblUsuario";
//Prepara sentencia
$consultar_mostrar_publi = $pdo->prepare($sql_mostrar_publi);
//Ejecutar consulta
$consultar_mostrar_publi->execute();

$pdf = new PDF('P', 'mm', 'letter',true); //Constructor -> Recibe tres parametros. P-Vertical, L-Horizontal
$pdf->AddPage('portrait','letter'); //Añade nueva página
//$pdf->SetMargins(10,30,20,20);
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(255,255,255);
$pdf->SetY(15);
$pdf->SetX(120);
$pdf->Write(5,utf8_decode('DETALLES DEL ENVÍO'));
$pdf->Ln();
$pdf->SetX(120);
$pdf->Write(5,'Fecha de la orden: '.date('Y-m-d'));//H:i:s -> Hora
$pdf->Ln();
$pdf->SetX(120);
$pdf->Write(5,utf8_decode('Fecha de envío: ').date('Y-m-d'));
$pdf->Ln();
$pdf->SetX(120);
$pdf->Write(5,utf8_decode('Dirección: Cra34'));
$pdf->Ln();
$pdf->SetX(120);
$pdf->Write(5,utf8_decode('Ciudad: Medellín'));

$pdf->SetTextColor(0,0,0);
$pdf->Image('../../../assets/img/favicon.png',20,55);

$pdf->SetFont('Arial','B');
$pdf->SetY(60);
$pdf->SetX(120);
$pdf->Write(10,'Montreal Peleteria');
$pdf->Ln();
$pdf->SetX(120);
$pdf->SetFont('Arial','');
$pdf->Write(10,utf8_decode('Octavio Vásquez'));
$pdf->Ln();
$pdf->SetX(120);
$pdf->SetFont('Arial','');
$pdf->Write(10,'octavio456@gmail.com');
$pdf->Ln();
$pdf->SetX(120);
$pdf->SetFont('Arial','');
$pdf->Write(10,'3206123421');  

$pdf->SetY(108);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(79,78,77);
$pdf->Cell(40,10,'Nombre',0,0,'C',1);
$pdf->Cell(40,10,'Apellido',0,0,'C',1);
$pdf->Cell(17,10,'Celular',0,0,'C',1);
$pdf->Cell(100,10,'Correo',0,1,'C',1);
//$pdf->AliasNbPages(); //Para que trabaje el Alias {nb}

/* //Encabezado de la tabla
$pdf->SetFillColor(232, 232, 230);//Defino un color
$pdf->SetFont('Times', 'B', 14);
$pdf->Cell(40, 12, 'Nombre', 1, 0, 'C', 1);//Último parametro, da color y recibe lo de linea 19
$pdf->Cell(40, 12, 'Apellido', 1, 0, 'C', 1);
$pdf->Cell(180, 12, 'Correo', 1, 1, 'C', 1); */

//Cuerpo de la tabla
/* $pdf->SetFont('Arial', '', 12); */
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(255,255,255);

while ($resultado_mostrar_publi = $consultar_mostrar_publi->fetch(PDO::FETCH_OBJ)) {
    $pdf->Cell(40, 10, utf8_decode($resultado_mostrar_publi->nombresUsuario), 'B', 0, 'C', 0); //Celda
    $pdf->Cell(40, 10, utf8_decode($resultado_mostrar_publi->apellidoUsuario), 'B', 0, 'C', 0); //Celda
    $pdf->Cell(17, 10, utf8_decode($resultado_mostrar_publi->telefonomovilUsuario), 'B', 0, 'C', 0); //Celda
    $pdf->Cell(100, 10, utf8_decode($resultado_mostrar_publi->emailUsuario), 'B', 1, 'C', 0); //Celda
}
$pdf->Output(); //I->Mostrar en el navegador,D->Forzando a descargar, F->Guardar en fichero local, S->
