<?php
$documento = $_SESSION["documentoIdentidad"];
$sesionRol = $_SESSION['roles'];
include_once '../../../dao/conexion.php';
$sqlValidacion = "SELECT*FROM tblUsuario WHERE documentoIdentidad =? AND estadoUsuario= '1'";
$consultaValidacion = $pdo->prepare($sqlValidacion);
$consultaValidacion->execute(array($documento));
$contadorValidacion = $consultaValidacion->rowCount();
//Llamado tabla intermedia
$sqlSesionRol = "SELECT * FROM tblUsuarioRol WHERE docIdentidadUsuarioRol=? AND idUsuarioRol=?";
$consultaSesionRol = $pdo->prepare($sqlSesionRol);
$consultaSesionRol->execute(array($documento, $sesionRol));
$resultadoSesionRol = $consultaSesionRol->rowCount();