<?php
session_start();
if (isset($_SESSION['documentoIdentidad'])) {
    //Llamar a la conexion
    include_once '../../../../dao/conexion.php';
    //Captura id
    $id = $_POST['ideditar'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $costo = $_POST['costo'];
    $stock = $_POST['stock'];
    //Sentencia sql
    $sql_actualizar = "UPDATE tblPublicacion SET nombrePublicacion=?,descripcionPublicacion=?,costoPublicacion=?,stockPublicacion=? WHERE idPublicacion=?";
    //Preparar la consulta
    $consultar_actualizar = $pdo->prepare($sql_actualizar);
    //Ejecutar
    $consultar_actualizar->execute(array($nombre, $descripcion, $costo, $stock, $id));
    //Redireccionar
    echo "<script>alert('Datos actualizados correctamente');</script>";
    echo "<script> document.location.href='../crearPublicacion.php';</script>";
} else {
    echo "<script>alert('Error!, no se ha iniciado sesión');</script>";
    echo "<script> document.location.href='../403.php';</script>";
}