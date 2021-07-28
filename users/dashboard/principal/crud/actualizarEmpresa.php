<?php
//Llamar a la conexión
include_once '../../../../dao/conexion.php';
//Captura id
$id = $_GET['ideditar'];
$descripcion = $_GET['descripcion'];
$correo = $_GET['correo'];
$direccion = $_GET['direccion'];
$telefono = $_GET['telefono'];
$ciudad = $_GET['ciudad'];
//Sentencia sql
$sql_actualizar = "UPDATE tblEmpresa SET descripcionEmpresa=?,correoEmpresa=?,direccionEmpresa=?,telefonoEmpresa=?,ciudadEmpresa=? WHERE nitEmpresa=?";
//Preparar la consulta
$consultar_actualizar = $pdo->prepare($sql_actualizar);
//Ejecutar
if ($consultar_actualizar->execute(array($descripcion, $correo,  $direccion, $telefono,$ciudad, $id))) {
    echo "<script>alert('Datos actualizados correctamente');</script>";
} else {
    echo "<script>alert('Error!');</script>";
}
//Redireccionar


echo "<script> document.location.href='../perfilEmpresa.php';</script>";
