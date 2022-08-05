<?php
session_start();
if (isset($_SESSION['documentoIdentidad'])) {
    $numeroFactura = $_POST['numero'];
    if (isset($numeroFactura)) {
        require "../includes/variablesFactura.php";
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <title>Factura | Interoriente</title>
            <link rel="stylesheet" href="../assets/css/estilosFactura.css">
            <link rel="icon" href="../../assets/img/favicon.png" type="image/png">
        </head>

        <body>
            <div id="page_pdf">
                <table id="factura_head">
                    <tr>
                        <td class="logo_factura">
                            <div>
                                <img src="../assets/img/logoAcortado.png">
                            </div>
                        </td>
                        <td class="info_empresa">
                            <div>
                                <span class="h2"><?= strtoupper('Interoriente S.A.S'); ?></span>
                                <p>Ventas seguras por internet</p>
                                <p>NIT: 12345678-9</p>
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
                                <td class="textcenter"><?= number_format($datos['cantidadFacturaPublicacion']); ?></td>
                                <td><?= $datos['nombrePublicacion']; ?></td>
                                <td class="textright"><?= number_format($datos['costoPublicacion']); ?></td>
                                <td class="textright"><?= number_format($datos['cantidadFacturaPublicacion'] * $datos['costoPublicacion']); ?></td>
                            </tr>
                        <?php
                            $precioTotal = $datos['pagar'];
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
                            <td colspan="3" class="textright"><span>IVA (19%)</span></td>
                            <td class="textright"><span>$<?= number_format($impuesto); ?></span></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="textright"><span>TOTAL A PAGAR</span></td>
                            <td class="textright"><span>$<?= number_format($totalPagar); ?></span></td>
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
<?php
    } else {
        echo "<script>alert('¡Error! No se ha seleccionado una factura.');</script>";
        echo "<script> document.location.href='dashboard.php';</script>";
    }
} else {
    echo "<script>alert('No has iniciado sesión');</script>";
    echo "<script> document.location.href='403.php';</script>";
}
