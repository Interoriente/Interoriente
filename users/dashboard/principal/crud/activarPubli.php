<?php
//Llamada a la conexion
include_once '../../../../dao/conexion.php';
$id = $_GET['id'];
$estado = '1';
//sentencia sql para actualizar estado
$sqlEditar = "UPDATE tblPublicacion SET validacionPublicacion = '$estado'  WHERE idPublicacion=?";
$consultaEditar = $pdo->prepare($sqlEditar);
$consultaEditar->execute(array($id));
//alert
echo "<script>alert('Estado actualizado correctamente');</script>";
//redireccionar
echo "<script> document.location.href='../publicaciones.php';</script>";