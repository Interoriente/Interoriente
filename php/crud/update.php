<?php
//Llamar a la conexion
include_once '../../dao/conexion.php';
//Captura id
$id = $_GET['id_editar'];
$nombre = $_GET['nombre'];
$direccion = $_GET['direccion'];
$telefono = $_GET['telefono'];
$ciudad = $_GET['ciudad'];
$nit = $_GET['nit'];
//Sentencia sql
$sql_actualizar = "UPDATE tblusuarios SET nombre_resta=?,direccion_resta=?,telefono_resta=?,ciudad_resta=?,nit_resta=? WHERE idrestaurante=?";
//Preparar la consulta
$consultar_actualizar = $pdo->prepare($sql_actualizar);
//Ejecutar
$consultar_actualizar->execute(array($nombre, $direccion, $telefono, $ciudad, $nit,$id));
//Redireccionar
header('location:index.html'); 