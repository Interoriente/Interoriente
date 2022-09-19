<!DOCTYPE html>
<html lang="en">
<!-- Necesario pasar los estilos quemados para que se carguen en el pdf -->
<style>
	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}

	p,
	label,
	span,
	table {
		font-family: "BrixSansRegular";
		font-size: 9pt;
	}

	.h2 {
		font-family: "BrixSansBlack";
		font-size: 16pt;
	}

	.h3 {
		font-family: "BrixSansBlack";
		font-size: 12pt;
		display: block;
		background: #0a4661;
		color: #FFF;
		text-align: center;
		padding: 3px;
		margin-bottom: 5px;
	}

	#page_pdf {
		width: 95%;
		margin: 15px auto 10px auto;
	}

	#factura_head,
	#factura_cliente,
	#factura_detalle {
		width: 100%;
		margin-bottom: 10px;
	}

	.logo_factura {
		width: 25%;
	}

	.info_empresa {
		width: 50%;
		text-align: center;
	}

	.info_factura {
		width: 25%;
	}

	.info_cliente {
		width: 100%;
	}

	.datos_cliente {
		width: 100%;
	}

	.datos_cliente tr td {
		width: 40%;
	}

	.datos_cliente {
		padding: 10px 10px 0 10px;
	}

	.datos_cliente label {
		width: 75px;
		display: inline-block;
	}

	.datos_cliente p {
		display: inline-block;
	}

	.textright {
		text-align: right;
	}

	.textleft {
		text-align: left;
	}

	.textcenter {
		text-align: center;
	}

	.round {
		border-radius: 10px;
		border: 1px solid #0a4661;
		overflow: hidden;
		padding-bottom: 15px;
	}

	.round p {
		padding: 0 15px;
	}

	#factura_detalle {
		border-collapse: collapse;
	}

	#factura_detalle thead th {
		background: #058167;
		color: #FFF;
		padding: 5px;
	}

	#detalle_productos tr:nth-child(even) {
		background: #ededed;
	}

	#detalle_totales span {
		font-family: "BrixSansBlack";
	}

	.nota {
		font-size: 8pt;
	}

	.label_gracias {
		font-family: verdana;
		font-weight: bold;
		font-style: italic;
		text-align: center;
		margin-top: 20px;
	}

	.anulada {
		position: absolute;
		left: 50%;
		top: 50%;
		transform: translateX(-50%) translateY(-50%);
	}
</style>

<head>
	<meta charset="UTF-8">
	<title>Factura</title>
</head>

<body>
	<?php
	/* if ($respEncabezadoFactura->estadoFactura == 0) { ?>
		<img class="anulada" src="../assets/img/anulado.png" />
	<?php } */ ?>
	<div id="page_pdf">
		<table id="factura_head">
			<tr>
				<td class="logo_factura">
					<div>
						<img src="../../../Views/dashboard/assets/img/logoAcortado.png">
					</div>
				</td>
				<td class="info_empresa">
					<div>
						<span class="h2"><?= strtoupper("Interoriente S.A.S"); ?></span>
						<p>Ventas seguras por internet</p>
						<p>Soporte: 3231231213</p>
						<p>Email: interoriente437@gmail.com</p>
					</div>
				</td>
				<td class="info_factura">
					<div class="round">
						<span class="h3">Factura</span>
						<p>No. Factura: <strong><?= $respEncabezadoFactura->numeroFactura; ?></strong></p>
						<p>Fecha: <?= $respEncabezadoFactura->fecha; ?></p>
						<p>Hora: <?= $respEncabezadoFactura->hora; ?></p>
						<p>Factura de venta</p>
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
								<td><label>Documento:</label>
									<p><?= $respEncabezadoFactura->documentoIdentidad; ?></p>
								</td>
								<td><label>Teléfono:</label>
									<p><?= $respEncabezadoFactura->telefonoMovilUsuario; ?></p>
								</td>
								<td><label>Municipio:</label>
									<p>Marinilla Ant</p>
								</td>
							</tr>
							<tr>
								<td><label>Nombre:</label>
									<p><?= $respEncabezadoFactura->Cliente; ?></p>
								</td>
								<td><label>Dirección:</label>
									<p><?= $respEncabezadoFactura->direccionFactura; ?></p>
								</td>
								<td><label>Correo:</label>
									<p><?= $respEncabezadoFactura->emailFactura; ?></p>
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
				foreach ($respCuerpoFactura as $datos) {
				?>
					<tr>
						<td class="textcenter"><?= number_format($datos["cantidadFacturaPublicacion"]); ?></td>
						<td><?= $datos["nombrePublicacion"]; ?></td>
						<td class="textright"><?= number_format($datos["costoPublicacion"]); ?></td>
						<td class="textright"><?= number_format($datos["cantidadFacturaPublicacion"] * $datos["costoPublicacion"]); ?></td>
					</tr>
				<?php
					$precioTotal = $datos["pagar"];
					$subtotal += $precioTotal;
					//Round()->Redondeo
					$impuesto = round($subtotal * $iva, 2);
					$totalPagar = round($subtotal + $impuesto, 2);
				}
				?>
			</tbody>
			<tfoot id="detalle_totales">
				<tr>
					<td colspan="3" class="textright"><span>SUBTOTAL</span></td>
					<td class="textright"><span>$<?= number_format($subtotal); ?></span></td>
				</tr>
				<tr>
					<td colspan="3" class="textright"><span>IVA (<?= $iva; ?> %)</span></td>
					<td class="textright"><span>$<?= number_format($impuesto); ?></span></td>
				</tr>
				<tr>
					<td colspan="3" class="textright"><span>TOTAL A PAGAR</span></td>
					<td class="textright"><span>$<?php echo number_format($totalPagar); ?></span></td>
				</tr>
			</tfoot>
		</table>
		<div>
			<p class="nota">Si usted tiene preguntas sobre esta factura, <br>pongase en contacto con Interoriente, 3231231213 y interoriente437@gmail.com</p>
			<h4 class="label_gracias">¡Gracias por su compra!</h4>
		</div>

	</div>

</body>

</html>