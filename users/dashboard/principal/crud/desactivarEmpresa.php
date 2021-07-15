<?php
//Llamada a la conexion
include_once '../../../../dao/conexion.php';
$id = $_GET['id'];
$estado = '0';
//sentencia sql para actualizar estado
$sqlEditar = "UPDATE tblEmpresa SET estadoEmpresa = ? WHERE nitEmpresa=?";
$consultaEditar = $pdo->prepare($sqlEditar);
$consultaEditar->execute(array($estado,$id));

//Mostrar tabla TblEmprea
$sqlMostrarEmpre="SELECT documentoRepresentante FROM tblEmpresa WHERE nitEmpresa=?";
$consultaMostrarEmpre=$pdo->prepare($sqlMostrarEmpre);
$consultaMostrarEmpre->execute(array($id));
$resultadoMostrarEmpre=$consultaMostrarEmpre->fetch();//Traer información de una tabla

//Capturo Documento, y NIT, creo variables
$mensaje = NULL;
$documento =$resultadoMostrarEmpre['documentoRepresentante'];

//Actualizando campo estado en tabla usuario
$sqlActualizarEmpre = "UPDATE tblUsuario SET empresaUsuario =? WHERE documentoIdentidad=?";
$consultaActualizarEmpre = $pdo->prepare($sqlActualizarEmpre);
$consultaActualizarEmpre->execute(array($mensaje,$documento));

//Capturo cuando rol sea igual a 2
$rol='2';

//Eliminando datos en tblUSuarioRol
$sqlBorrarUsuarioRol="DELETE FROM tblUsuarioRol WHERE docIdentidad=? AND idRol=?";
$consultaBorrarUsuarioRol=$pdo->prepare($sqlBorrarUsuarioRol);
$consultaBorrarUsuarioRol->execute(array($documento,$rol));

//Alert
echo "<script>alert('Estado actualizado correctamente');</script>";

//Redireccionar
echo "<script> document.location.href='../empresas.php';</script>";