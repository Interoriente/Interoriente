<?php
session_start();
if (isset($_SESSION['documentoIdentidad'])) {
    //Llamada a la conexion
    include_once '../../../../dao/conexion.php';
    $id = $_GET['id']; #REVISAR SEGUIRDAD

    $sqlEliminar = "DELETE FROM tblImagenes WHERE publicacionImagen = ?";
    $consultaEliminar = $pdo->prepare($sqlEliminar);
    $consultaEliminar->execute(array($id));

    //sentencia sql para eliminar
    $sql_eliminar = "DELETE FROM tblPublicacion WHERE idPublicacion = ?";
    $consulta_eliminar = $pdo->prepare($sql_eliminar);
    $consulta_eliminar->execute(array($id));

    //redireccionar
    echo "<script>alert('La publicación se eliminó correctamente');</script>";

    echo "<script> document.location.href='../dashboard.php';</script>";
} else {
    echo "<script>alert('Error!, no se ha iniciado sesión');</script>";
    echo "<script> document.location.href='../403.php';</script>";
}