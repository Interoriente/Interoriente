<?php
//Llamada a la conexion
include_once '../../../../dao/conexion.php';
$id = $_GET['id']; #REVISAR SEGUIRDAD

//sentencia sql para eliminar
$sql_eliminar = "DELETE FROM tblPublicacion WHERE idPublicacion = ?";
$consulta_eliminar = $pdo->prepare($sql_eliminar);
$consulta_eliminar->execute(array($id));

//redireccionar
echo "<script>alert('La publicación se eliminó correctamente');</script>";
echo "<script> document.location.href='../crearPubli.php';</script>";
