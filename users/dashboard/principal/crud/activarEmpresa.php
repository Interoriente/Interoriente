<?php
//Llamada a la conexion
include_once '../../../../dao/conexion.php';
$id = $_GET['id'];
$estado = '1';
//sentencia sql para actualizar estado
$sqlEditar = "UPDATE tblEmpresa SET estadoEmpresa = '$estado' WHERE nitEmpresa=?";
$consultaEditar = $pdo->prepare($sqlEditar);
$consultaEditar->execute(array($id));
//alert
echo "<script>alert('Estado actualizado correctamente');</script>";
//redireccionar
echo "<script> document.location.href='../usuarios.php';</script>";