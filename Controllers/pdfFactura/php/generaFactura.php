<?php

use Dompdf\Dompdf;

session_start();
if (isset($_SESSION['documentoIdentidad'])) {
	$numeroFactura = $_POST['numero'];
	if (isset($numeroFactura)) {
		require "../../../Views/dashboard/includes/variablesFactura.php";
		require '../dompdf/vendor/autoload.php';
		ob_start();
		include(dirname('__FILE__') . '/../../../Views/dashboard/principal/plantillaFactura.php');
		$html = ob_get_clean();

		// instantiate and use the dompdf class
		$dompdf = new Dompdf();

		// $dompdf->setOptions($options);
		$dompdf->loadHtml($html);
		$dompdf->setPaper('letter', 'portrait');
		$dompdf->render();
		/**
		 * "Attachment" => 0 -> Para vista previa
		 * "Attachment" => 1 -> Para descargar el archivo
		 */
		$dompdf->stream("Factura_$numeroFactura" . "_cliente_$respEncabezadoFactura->documentoIdentidad", array("Attachment" => 0));
	} else {
		echo "<script>alert('¡Error! No se ha seleccionado una factura.');</script>";
		echo "<script> document.location.href='dashboard.php';</script>";
	}
} else {
	echo "<script>alert('No has iniciado sesión');</script>";
	echo "<script> document.location.href='403.php';</script>";
}
