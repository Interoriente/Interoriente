<?php
//Llamar a la conexión
include_once '../../../../dao/conexion.php';
//Captura id
$id = $_GET['ideditar'];
$nombre = $_GET['nombre'];
$apellido = $_GET['apellido'];
$celular = $_GET['celular'];
//$ciudad = $_GET['ciudad'];
$correo = $_GET['correo'];
//Sentencia sql
$sql_actualizar = "UPDATE tblUsuario SET nombresUsuario=?,apellidoUsuario=?,telefonomovilUsuario=?,emailUsuario=? WHERE documentoIdentidad=?";
//Preparar la consulta
$consultar_actualizar = $pdo->prepare($sql_actualizar);
//Ejecutar
$consultar_actualizar->execute(array($nombre, $apellido, $celular,  $correo, $id));
//Redireccionar
echo "<script>alert('Datos actualizados correctamente');</script>";

echo "<script> document.location.href='../perfil.php';</script>";
