<?php

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
$anulado="";

