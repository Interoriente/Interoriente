<?php
//Llamar a la conexión
include_once '../../../../dao/conexion.php';
//Captura id
$id = $_GET['ideditar'];
$nombre = $_GET['nombre'];
$apellido = $_GET['apellido'];
$correo = $_GET['correo'];
//Sentencia sql
$sql_actualizar = "UPDATE tblusuarios SET nombres=?,apellidos=?,correo=? WHERE idusuario=?";
//Preparar la consulta
$consultar_actualizar = $pdo->prepare($sql_actualizar);
//Ejecutar
$consultar_actualizar->execute(array($nombre, $apellido, $correo, $id));
//Redireccionar
echo "<script>alert('Datos actualizados correctamente');</script>";

echo "<script> document.location.href='../profile.php';</script>";