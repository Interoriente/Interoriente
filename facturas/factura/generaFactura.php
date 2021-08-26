<?php

//print_r($_REQUEST);
//exit;
//echo base64_encode('2');
//exit;
session_start();
if (empty($_SESSION['active'])) {
	header('location: ../');
}

include "../../dao/conexion.php";
require_once '../pdf/vendor/autoload.php';

use Dompdf\Dompdf;

if (empty($_REQUEST['cl']) || empty($_REQUEST['f'])) {
	echo "No es posible generar la factura.";
} else {
	$codCliente = $_REQUEST['cl'];
	$noFactura = $_REQUEST['f'];
	$anulada = '';

	$query_config   = "SELECT * FROM tblUsuario";
	$preparar_config = $pdo->prepare($query_config);
	$preparar_config->execute($query_config);
	$result_config  = $preparar_config->rowCount();
	if ($result_config) {
		$configuracion = $preparar_config->fetch(PDO::FETCH_OBJ);
	}


	$query = "SELECT *, DATE_FORMAT(CO.fechaCompra, '%d/%m/%Y') as fecha, DATE_FORMAT(CO.fechaCompra,'%H:%i:%s') as  hora, US.documentoIdentidad, CO.estadoCompra
				FROM tblCompra as CO
				INNER JOIN tblUsuario as US ON US.documentoIdentidad = CO.docIdentidadCompra
				INNER JOIN tblPublicacion as PU ON PU.docIdentidadPublicacion = US.documentoIdentidad
				WHERE CO.idCompra =1 AND US.docIdentidadCompra = '10072382009'  AND CO.estadoCompra != 2 ";
    $prepara=$pdo->prepare($query);
	$prepara->execute();
	$result = $prepara->rowCount();
	if ($result) {

		$factura = $prepara->fetch(PDO::FETCH_OBJ);
		$no_factura = $factura['idCompra'];

		if ($factura['estadoCompra'] == 2) {
			$anulada = '<img class="anulada" src="img/anulado.png" alt="Anulada">';
		}

		/* $query_productos = mysqli_query($conection, "SELECT p.descripcion,dt.cantidad,dt.precio_venta,(dt.cantidad * dt.precio_venta) as precio_total
														FROM factura f
														INNER JOIN detallefactura dt
														ON f.nofactura = dt.nofactura
														INNER JOIN producto p
														ON dt.codproducto = p.codproducto
														WHERE f.nofactura = $no_factura ");
		$result_detalle = mysqli_num_rows($query_productos);
 */
		ob_start();
		include(dirname('__FILE__') . '/factura.php');
		$html = ob_get_clean();

		// instantiate and use the dompdf class
		$dompdf = new Dompdf();

		$dompdf->loadHtml($html);
		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('letter', 'portrait');
		// Render the HTML as PDF
		$dompdf->render();
		// Output the generated PDF to Browser
		$dompdf->stream('factura_' . $noFactura . '.pdf', array('Attachment' => 0));
		exit;
	}
}
