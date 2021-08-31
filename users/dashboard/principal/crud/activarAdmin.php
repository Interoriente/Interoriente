<?php
session_start();
if (isset($_SESSION['documentoIdentidad'])) {

    //Llamada a la conexion
    include_once '../../../../dao/conexion.php';
    $id = $_GET['id'];
    $estado = '1';
    //sentencia sql para actualizar estado
    $sqlEditar = "UPDATE tblUsuario SET estadoUsuario = '$estado'  WHERE documentoIdentidad=?";
    $consultaEditar = $pdo->prepare($sqlEditar);
    $consultaEditar->execute(array($id));
    //alert
    echo "<script>alert('Estado actualizado correctamente');</script>";
    //redireccionar
    echo "<script> document.location.href='../usuarios.php';</script>";
} else {
    echo "<script>alert('Error!, no se ha iniciado sesión');</script>";
    echo "<script> document.location.href='../403.php';</script>";
}
