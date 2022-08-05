<?php

use Dompdf\Dompdf;

session_start();
if (isset($_SESSION['documentoIdentidad'])) {
	$numeroFactura = $_POST['numero'];
	if (isset($numeroFactura)) {
		require "../../../Views/dashboard/includes/variablesFactura.php";
		if ($respEncabezadoFactura->estadoFactura == 0) {
			$anulado = "<img class='anulada' src='../../../Views/assets/img/factura/anulado.png'";
		}
		require '../dompdf/vendor/autoload.php';
		ob_start();
		include('../../../Views/dashboard/principal/plantillaFactura.php');
		$html = ob_get_clean();

		// instantiate and use the dompdf class
		$dompdf = new Dompdf();

		$options = $dompdf->getOptions();
		$options->set(array('isRemoteEnabled' => true,));
		$dompdf->setOptions($options);
		$dompdf->loadHtml($html);
		$dompdf->setPaper('letter', 'portrait');
		$dompdf->render();
		header("Content-type: application/pdf");
		header("Content-Disposition: inline; filename=documento.pdf");
		/**
		 * "Attachment" => 0 -> Para vista previa
		 * "Attachment" => 1 -> Para descargar el archivo
		 */
		$dompdf->stream("Factura_$numeroFactura" . "_cliente_$respEncabezadoFactura->documentoIdentidad", array("Attachment" => 1));
	} else {
		echo "<script>alert('¡Error! No se ha seleccionado una factura.');</script>";
		echo "<script> document.location.href='dashboard.php';</script>";
	}
} else {
	echo "<script>alert('No has iniciado sesión');</script>";
	echo "<script> document.location.href='403.php';</script>";
}
