<?php
//Llamada a la conexion
include_once '../../../../dao/conexion.php';
$id = $_GET['id'];
echo $id;
$estado = '1';
//sentencia sql para actualizar estado
$sqlEditar = "UPDATE tblEmpresa SET estadoEmpresa = '$estado' WHERE nitEmpresa=?";
$consultaEditar = $pdo->prepare($sqlEditar);
$consultaEditar->execute(array($id));
//Mostrar tabla TblEmprea
$sqlMostrarEmpre="SELECT documentoIdentidad FROM tblEmpresa WHERE nitEmpresa='$id'";
$consultaMostrarEmpre=$pdo->prepare($sqlMostrarEmpre);
$consultaMostrarEmpre->execute();
$resultadoMostrarEmpre=$consultaMostrarEmpre->fetch();//Traer información de una tabla
//Capturo Documento, creo variables
$documento=$resultadoMostrarEmpre['documentoIdentidad'];
$rol='2';
//Guardando datos en tblUSuarioRol
$sqlInsertarUsuarioRol="INSERT INTO tblUsuarioRol (documentoIdentidad,idRol) VALUES (?,?)";
$consultaInsertarUsuarioRol=$pdo->prepare($sqlInsertarUsuarioRol);
$consultaInsertarUsuarioRol->execute(array($documento,$rol));

//alert
echo "<script>alert('Estado actualizado correctamente');</script>";
//redireccionar
echo "<script> document.location.href='../empresas.php';</script>";