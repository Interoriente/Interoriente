<?php
$subtotal 	= 0;
$impuesto 	= 0;
$tl_sniva   = 0;
$total 		= 0;
$codCliente = 1007382009;
$noFactura = 1;
$anulada = '';

include_once '../../dao/conexion.php';

$query_config   = "SELECT * FROM tblUsuario WHERE documentoIdentidad =?";
$preparar_config = $pdo->prepare($query_config);
$preparar_config->execute(array($codCliente));
$result_config  = $preparar_config->rowCount();
$configuracion = $preparar_config->fetch(PDO::FETCH_OBJ);


$query = "SELECT US.descripcionUsuario,FA.estadoFactura,FA.telefonoFactura,FA.numFactura,DATE_FORMAT(FA.fechaFactura, '%d/%m/%Y') as fecha, DATE_FORMAT(FA.fechaFactura,'%H:%i:%s') as  hora,US.documentoIdentidad,concat(US.nombresUsuario,'-',US.apellidoUsuario) as Cliente,FA.direccionFactura,US.telefonoMovilUsuario,PU.nombrePublicacion,PU.costoPublicacion,FP.cantidadFacturaPublicacion, FP.cantidadFacturaPublicacion*PU.costoPublicacion as pagar
				FROM tblFactura as FA
				INNER JOIN tblUsuario as US ON US.documentoIdentidad = FA.docIdentidadFactura
				INNER JOIN tblFacturaPublicacion as FP ON FP.numFacturaPublicacion = FA.numFactura
				INNER JOIN tblPublicacion as PU ON PU.idPublicacion=FP.idPublicacionFactura
				WHERE FA.numFactura =1 AND FA.docIdentidadFactura = '1007382009'  AND FA.estadoFactura != 2 ";
$prepara = $pdo->prepare($query);
$prepara->execute();
$factura = $prepara->fetch(PDO::FETCH_OBJ);
//Se debe consultar forma de optimizar estas líneas de código
$query = "SELECT US.descripcionUsuario,FA.estadoFactura,FA.telefonoFactura,FA.numFactura,DATE_FORMAT(FA.fechaFactura, '%d/%m/%Y') as fecha, DATE_FORMAT(FA.fechaFactura,'%H:%i:%s') as  hora,US.documentoIdentidad,concat(US.nombresUsuario,'-',US.apellidoUsuario) as Cliente,FA.direccionFactura,US.telefonoMovilUsuario,PU.nombrePublicacion,PU.costoPublicacion,FP.cantidadFacturaPublicacion, FP.cantidadFacturaPublicacion*PU.costoPublicacion as pagar
				FROM tblFactura as FA
				INNER JOIN tblUsuario as US ON US.documentoIdentidad = FA.docIdentidadFactura
				INNER JOIN tblFacturaPublicacion as FP ON FP.numFacturaPublicacion = FA.numFactura
				INNER JOIN tblPublicacion as PU ON PU.idPublicacion=FP.idPublicacionFactura
				WHERE FA.numFactura =1 AND FA.docIdentidadFactura = '1007382009'  AND FA.estadoFactura != 2 ";
$prepara = $pdo->prepare($query);
$prepara->execute();
$resultado = $prepara->fetchAll();


$no_factura = $factura->numFactura;
if ($factura->estadoFactura == 2) {
	$anulada = '<img class="anulada" src="img/anulado.png" alt="Anulada">';
}
//print_r($configuracion); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Factura</title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<?php echo $anulada; ?>
	<div id="page_pdf">
		<table id="factura_head">
			<tr>
				<td class="logo_factura">
					<div>
						<img src="img/LogoTerciario.svg">
					</div>
				</td>
				<td class="info_empresa">
					<?php
					if ($result_config > 0) {
						$iva = 0.19;
					?>
						<div>
							<span class="h2"><?php echo strtoupper('Interoriente S.A.S'); ?></span>
							<p><?php echo 'Ventas seguras por internet'; ?></p>
							<p>Soporte: <?php echo '3197183038'; ?></p>
							<p>Email: <?php echo 'interoriente437@gmail.com'; ?></p>
						</div>
					<?php
					}
					?>
				</td>
				<td class="info_factura">
					<div class="round">
						<span class="h3">Factura</span>
						<p>No. Factura: <strong><?php echo $no_factura; ?></strong></p>
						<p>Fecha: <?php echo $factura->fecha; ?></p>
						<p>Hora: <?php echo $factura->hora; ?></p>
						<p>Vendedor: <?php echo 'Pedrito Peréz'; ?></p>
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
									<p><?php echo $factura->documentoIdentidad; ?></p>
								</td>
								<td><label>Teléfono:</label>
									<p><?php echo $factura->telefonoFactura; ?></p>
								</td>
							</tr>
							<tr>
								<td><label>Nombre:</label>
									<p><?php echo $factura->Cliente; ?></p>
								</td>
								<td><label>Dirección:</label>
									<p><?php echo $factura->direccionFactura; ?></p>
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
					<th class="textright" width="150px">Precio Unitario.</th>
					<th class="textright" width="150px"> Precio Total</th>
				</tr>
			</thead>
			<tbody id="detalle_productos">

				<?php
				foreach ($resultado as $datos) {
				?>
					<tr>
						<td class="textcenter"><?php echo $datos['cantidadFacturaPublicacion']; ?></td>
						<td><?php echo $datos['nombrePublicacion']; ?></td>
						<td class="textright"><?php echo $datos['costoPublicacion']; ?></td>
						<td class="textright"><?php echo $datos['cantidadFacturaPublicacion'] * $datos['costoPublicacion']; ?></td>
					</tr>
				<?php
					$precio_total = $datos['pagar'];
					$subtotal = round($subtotal + $precio_total);
					$impuesto 	= round($subtotal * $iva, 2);
					$tl_sniva 	= round($subtotal - $impuesto, 2);
					$total 		= $tl_sniva + $impuesto;
				}
				?>
			</tbody>
			<tfoot id="detalle_totales">
				<tr>
					<td colspan="3" class="textright"><span>SUBTOTAL</span></td>
					<td class="textright"><span>$<?php echo $tl_sniva; ?></span></td>
				</tr>
				<tr>
					<td colspan="3" class="textright"><span>IVA (<?php echo $iva; ?> %)</span></td>
					<td class="textright"><span>$<?php echo $impuesto; ?></span></td>
				</tr>
				<tr>
					<td colspan="3" class="textright"><span>TOTAL A PAGAR</span></td>
					<td class="textright"><span>$<?php echo $total; ?></span></td>
				</tr>
			</tfoot>
		</table>
		<div>
			<p class="nota">Si usted tiene preguntas sobre esta factura, <br>pongase en contacto con nombre, teléfono y Email</p>
			<h4 class="label_gracias">¡Gracias por su compra!</h4>
		</div>

	</div>

</body>

</html>