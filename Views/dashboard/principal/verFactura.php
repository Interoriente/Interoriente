<?php
session_start();
if (isset($_SESSION['documentoIdentidad'])) {
    @$numero = $_POST['numero'];
    if (isset($numero)) {
        $numeroFactura = $numero;
        $documento = $_SESSION['documentoIdentidad'];

        require "../../../Controllers/php/users/compras.php";
        $factura = new Factura($documento, $numeroFactura);
        $respEncabezadoFactura = $factura->EncabezadoFactura($factura->id, $factura->numero);
        $respCuerpoFactura = $factura->CuerpoFactura($factura->id, $factura->numero);

        /* Inicializando variables para luego utilizarlas en la factura */
        $subtotal = 0;
        $impuesto = 0;
        $totalSinIva = 0;
        $totalPagar = 0;
        $iva = 0.19;
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
                                <span class="h2"><?php echo strtoupper('Interoriente S.A.S'); ?></span>
                                <p>Ventas seguras por internet</p>
                                <p>NIT: 12345678-9</p>
                                <p>Soporte: 3231231213</p>
                                <p>Email: interoriente437@gmail.com</p>
                            </div>
                        </td>
                        <td class="info_factura">
                            <div class="round">
                                <span class="h3">Factura</span>
                                <p>No. Factura: <strong><?php echo $respEncabezadoFactura->numeroFactura; ?></strong></p>
                                <p>Fecha: <?php echo $respEncabezadoFactura->fecha; ?></p>
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
                                            <p><?php echo $respEncabezadoFactura->documentoIdentidad; ?></p>
                                        </td>
                                        <td><label>Tel??fono:</label>
                                            <p><?php echo $respEncabezadoFactura->telefonoMovilUsuario; ?></p>
                                        </td>
                                        <td><label>Municipio:</label>
                                            <p>Marinilla Ant</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label>Nombre:</label>
                                            <p><?php echo $respEncabezadoFactura->Cliente; ?></p>
                                        </td>
                                        <td><label>Direcci??n:</label>
                                            <p><?php echo $respEncabezadoFactura->direccionFactura; ?></p>
                                        </td>
                                        <td><label>Correo:</label>
                                            <p><?php echo $respEncabezadoFactura->emailFactura; ?></p>
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
                            <th class="textleft">Descripci??n</th>
                            <th class="textright" width="150px">Precio Unitario</th>
                            <th class="textright" width="150px">Precio Total</th>
                        </tr>
                    </thead>
                    <tbody id="detalle_productos">

                        <?php
                        foreach ($respCuerpoFactura as $datos) {
                        ?>
                            <tr>
                                <td class="textcenter"><?php echo number_format($datos['cantidadFacturaPublicacion']); ?></td>
                                <td><?php echo $datos['nombrePublicacion']; ?></td>
                                <td class="textright"><?php echo number_format($datos['costoPublicacion']); ?></td>
                                <td class="textright"><?php echo number_format($datos['cantidadFacturaPublicacion'] * $datos['costoPublicacion']); ?></td>
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
                            <td class="textright"><span>$<?php echo number_format($subtotal); ?></span></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="textright"><span>IVA (19%)</span></td>
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
                    <h4 class="label_gracias">??Gracias por su compra!</h4>
                </div>
            </div>
        </body>

        </html>
<?php
    } else {
        echo "<script>alert('??Error! No se ha seleccionado una factura.');</script>";
        echo "<script> document.location.href='dashboard.php';</script>";
    }
} else {
    echo "<script>alert('No has iniciado sesi??n');</script>";
    echo "<script> document.location.href='403.php';</script>";
}
