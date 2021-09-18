<?php
session_start();
if (isset($_SESSION['documentoIdentidad'])) {

	/* Inicializando variables para luego utilizarlas en la factura */
	$subtotal = 0;
	$impuesto = 0;
	$totalSinIva = 0;
	$totalPagar = 0;
	$codCliente = $_SESSION['documentoIdentidad'];
	$anulada = '';
	$iva = 0.19;

	include_once '../../../Models/dao/conexion.php';

	/* LLamado al encabezado */
	$sqlCliente   = "SELECT US.descripcionUsuario,FA.direccionFactura,FA.numeroFactura,DATE_FORMAT(FA.fechaFactura, '%d/%m/%Y') as fecha, DATE_FORMAT(FA.fechaFactura,'%H:%i:%s') as  hora,US.documentoIdentidad,concat(US.nombresUsuario,' ',US.apellidoUsuario) as Cliente 
	FROM tblUsuario AS US
	INNER JOIN tblFactura AS FA ON FA.docIdentidadFactura=US.documentoIdentidad
	WHERE US.documentoIdentidad =? AND FA.numeroFactura=1";
	$prepararCliente = $pdo->prepare($sqlCliente);
	$prepararCliente->execute(array($codCliente));
	$resultadoContarCliente  = $prepararCliente->rowCount();
	$resultadoCliente = $prepararCliente->fetch(PDO::FETCH_OBJ);

	/* Llamado al cuerpo de la factura */
	$sqlProductos = "SELECT PU.nombrePublicacion,PU.costoPublicacion,FP.cantidadFacturaPublicacion, FP.cantidadFacturaPublicacion*PU.costoPublicacion as pagar
	FROM tblFactura as FA
	INNER JOIN tblFacturaPublicacion as FP ON FP.numFacturaPublicacion = FA.numeroFactura
	INNER JOIN tblPublicacion as PU ON PU.idPublicacion=FP.idPublicacionFactura
	WHERE FA.numeroFactura =1 AND FA.docIdentidadFactura = '1007382009'
	ORDER BY PU.nombrePublicacion ASC";
	$prepararProductos = $pdo->prepare($sqlProductos);
	$prepararProductos->execute();
	$resultadoProductos = $prepararProductos->fetchAll();


	$no_factura = $resultadoCliente->numeroFactura;
	/* if ($resultadoCliente->numeroFactura == 1) {
		$anulada = '<img class="anulada" src="img/anulado.png" alt="Anulada">';
	} */
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<title>Factura</title>
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<?php echo $anulada; ?>
		<div id="page_pdf">
			<table id="factura_head">
				<tr>
					<td class="logo_factura">
						<div>
							<img src="img/logoAcortado.png">
						</div>
					</td>
					<td class="info_empresa">
						<div>
							<span class="h2"><?php echo strtoupper('Interoriente S.A.S'); ?></span>
							<p>Ventas seguras por internet</p>
							<p>Soporte: 3197183038</p>
							<p>Email: interoriente437@gmail.com</p>
						</div>
					</td>
					<td class="info_factura">
						<div class="round">
							<span class="h3">Factura</span>
							<p>No. Factura: <strong><?php echo $no_factura; ?></strong></p>
							<p>Fecha: <?php echo $resultadoCliente->fecha; ?></p>
							<p>Hora: <?php echo $resultadoCliente->hora; ?></p>
							<p>Factura Electrónica</p>
						</div>
					</td>
				</tr>
			</table>
			<table id="factura_cliente">
				<tr>
					<td class="info_cliente">
						<div class="round">
							<span class="h3">Cliente</span>
							<table class="datos_cliente">
								<tr>
									<td><label>Nit:</label>
										<p><?php echo $resultadoCliente->documentoIdentidad; ?></p>
									</td>
									<td><label>Teléfono:</label>
										<p><?php echo $resultadoCliente->documentoIdentidad; ?></p>
									</td>
									<td><label>Municipio:</label>
										<p>Marinilla Ant</p>
									</td>
								</tr>
								<tr>
									<td><label>Nombre:</label>
										<p><?php echo $resultadoCliente->Cliente; ?></p>
									</td>
									<td><label>Dirección:</label>
										<p><?php echo $resultadoCliente->direccionFactura; ?></p>
									</td>
								</tr>
							</table>
						</div>
					</td>

				</tr>
			</table>

			<table id="factura_detalle">
				<thead>
					<tr>
						<th width="50px">Cant.</th>
						<th class="textleft">Descripción</th>
						<th class="textright" width="150px">Precio Unitario</th>
						<th class="textright" width="150px">Precio Total</th>
					</tr>
				</thead>
				<tbody id="detalle_productos">

					<?php
					foreach ($resultadoProductos as $datos) {
					?>
						<tr>
							<td class="textcenter"><?php echo number_format($datos['cantidadFacturaPublicacion']); ?></td>
							<td><?php echo $datos['nombrePublicacion']; ?></td>
							<td class="textright"><?php echo number_format($datos['costoPublicacion']); ?></td>
							<td class="textright"><?php echo number_format($datos['cantidadFacturaPublicacion'] * $datos['costoPublicacion']); ?></td>
						</tr>
					<?php
						$precioTotal = $datos['pagar'];
						//Round()->Redondeo
						$subtotal = round($subtotal + $precioTotal);
						$impuesto = round($subtotal * $iva, 2);
						$totalSinIva = round($subtotal - $impuesto, 2);
						$totalPagar = round($totalSinIva + $impuesto, 2);
					}
					?>
				</tbody>
				<tfoot id="detalle_totales">
					<tr>
						<td colspan="3" class="textright"><span>SUBTOTAL</span></td>
						<td class="textright"><span>$<?php echo number_format($totalSinIva); ?></span></td>
					</tr>
					<tr>
						<td colspan="3" class="textright"><span>IVA (<?php echo $iva; ?> %)</span></td>
						<td class="textright"><span>$<?php echo number_format($impuesto); ?></span></td>
					</tr>
					<tr>
						<td colspan="3" class="textright"><span>TOTAL A PAGAR</span></td>
						<td class="textright"><span>$<?php echo number_format($totalPagar); ?></span></td>
					</tr>
				</tfoot>
			</table>
			<div>
				<p class="nota">Si usted tiene preguntas sobre esta factura, <br>pongase en contacto con Interoriente, 3197183038 y interoriente437@gmail.com</p>
				<h4 class="label_gracias">¡Gracias por su compra!</h4>
			</div>

		</div>

	</body>

	</html>
<?php } else {
	echo "Error no se tiene la sesión iniciada";
	
}