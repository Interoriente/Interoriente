<?php
//Mostrar gráfica de ventas anuales
$labelVentas = "";
$datosVentas = "";
foreach ($respVentasAnual as $datos) {
    $labelVentas = $labelVentas . $datos['Mes'] . ",";
    $datosVentas = $datosVentas . $datos['Total'] . ",";
}
$labelVentas = rtrim($labelVentas, ",");
$datosVentas = rtrim($datosVentas, ",");
//Mostrar gráfica de ventas por semana
$labelVentasSemana = "";
$datosVentasSemana = "";
foreach ($respVentasDia as $datosSemana) {
    $labelVentasSemana = $labelVentasSemana . $datosSemana['Dia'] . ",";
    $datosVentasSemana = $datosVentasSemana . $datosSemana['Total'] . ",";
}
$labelVentasSemana = rtrim($labelVentasSemana, ",");
$datosVentasSemana = rtrim($datosVentasSemana, ",");
