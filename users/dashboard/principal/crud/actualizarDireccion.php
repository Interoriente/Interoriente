<?php
$id = $_REQUEST['id'];
$nombre = $_REQUEST['nombre'];
$direccion = $_REQUEST['direccion'];
$ciudad = $_REQUEST['ciudad'];

include '../../../../dao/conexion.php';
$sqlActualizarDir = "UPDATE tblDirecciones SET nombreDireccion=?,descripcionDireccion=?,ciudadDireccion=? WHERE idDireccion=?";
$consultaActualizarDir = $pdo->prepare($sqlActualizarDir);
if ($consultaActualizarDir->execute(array($nombre, $direccion, $ciudad, $id))) {
    echo "<script>alert('Dirección actualizada correctamente');</script>";
    echo "<script>document.location.href='../perfil.php';</script>";
} else {
    echo "<script>alert('Ocurrió un error')</script>";
    echo "<script>document.location.href='../perfil.php';</script>";
}
