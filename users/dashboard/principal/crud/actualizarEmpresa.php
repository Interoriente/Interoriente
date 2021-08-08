<?php
session_start();
if (isset($_SESSION['documentoIdentidad'])) {
    //Llamar a la conexión
    include_once '../../../../dao/conexion.php';
    //Captura id
    $id = $_POST['ideditar'];
    $descripcion = $_POST['descripcion'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $ciudad = $_POST['ciudad'];
    //Sentencia sql
    $sql_actualizar = "UPDATE tblEmpresa SET descripcionEmpresa=?,correoEmpresa=?,direccionEmpresa=?,telefonoEmpresa=?,ciudadEmpresa=? WHERE nitEmpresa=?";
    //Preparar la consulta
    $consultar_actualizar = $pdo->prepare($sql_actualizar);
    //Ejecutar
    if ($consultar_actualizar->execute(array($descripcion, $correo,  $direccion, $telefono, $ciudad, $id))) {
        echo "<script>alert('Datos actualizados correctamente');</script>";
    } else {
        echo "<script>alert('Error!');</script>";
    }
    //Redireccionar


    echo "<script> document.location.href='../perfilEmpresa.php';</script>";
} else {
    echo "<script>alert('Error!, no se ha iniciado sesión');</script>";
    echo "<script> document.location.href='../403.php';</script>";
}