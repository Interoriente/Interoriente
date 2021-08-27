<?php
$id=$_GET['id'];
include '../../../../dao/conexion.php';
$sqlEliminarDir="DELETE FROM tblDirecciones WHERE idDireccion=?";
$consultaEliminarDir=$pdo->prepare($sqlEliminarDir);
$consultaEliminarDir->execute(array($id));
echo "<script>alert('Publicación eliminada correctamente');</script>";
echo "<script>document.location.href='../perfil.php';</script>";