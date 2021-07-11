<?php
//Llamada a la conexion
include_once '../../../../dao/conexion.php';
$id = $_GET['id'];
$estado = '1';
//sentencia sql para actualizar estado
$sqlEditar = "UPDATE tblEmpresa SET estadoEmpresa = '$estado' WHERE nitEmpresa=?";
$consultaEditar = $pdo->prepare($sqlEditar);
$consultaEditar->execute(array($id));
//Mostrar tabla TblEmprea
$sqlMostrarEmpre = "SELECT * FROM tblEmpresa WHERE nitEmpresa='$id'";
$consultaMostrarEmpre = $pdo->prepare($sqlMostrarEmpre);
$consultaMostrarEmpre->execute();
$resultadoMostrarEmpre = $consultaMostrarEmpre->fetch(); //Traer información de una tabla
//Capturo Documento, creo variables
$nit = $resultadoMostrarEmpre['nitEmpresa'];
//Actualizando campo estado en tabla usuario
$sqlActualizarEmpre = "UPDATE tblUsuario SET empresaUsuario =?";
$consultaActualizarEmpre = $pdo->prepare($sqlActualizarEmpre);
$consultaActualizarEmpre->execute(array($nit));
//alert
echo "<script>alert('Estado actualizado correctamente');</script>";
//redireccionar
echo "<script> document.location.href='../empresas.php';</script>";
