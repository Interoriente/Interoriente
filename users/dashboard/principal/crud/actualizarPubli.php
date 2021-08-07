<?php
session_start();
if (isset($_SESSION['documentoIdentidad'])) {
    //Llamar a la conexion
    include_once '../../../../dao/conexion.php';
    //Captura id
    $id = $_GET['ideditar'];
    $nombre = $_GET['nombre'];
    $descripcion = $_GET['descripcion'];
    $costo = $_GET['costo'];
    $stock = $_GET['stock'];
    //Sentencia sql
    $sql_actualizar = "UPDATE tblPublicacion SET nombrePublicacion=?,descripcionPublicacion=?,costoPublicacion=?,stockProducto=? WHERE idPublicacion=?";
    //Preparar la consulta
    $consultar_actualizar = $pdo->prepare($sql_actualizar);
    //Ejecutar
    $consultar_actualizar->execute(array($nombre, $descripcion, $costo, $stock, $id));
    //Redireccionar
    echo "<script>alert('Datos actualizados correctamente');</script>";
    echo "<script> document.location.href='../crearPubli.php';</script>";
} else {
    echo "<script>alert('Error!, no se ha iniciado sesión');</script>";
    echo "<script> document.location.href='../403.php';</script>";
}