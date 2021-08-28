<?php
if (isset($_POST['subirDireccion'])) {
    include '../../../../dao/conexion.php';
    @$nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $usuario = $_POST['documento'];

    $sqlAgregarDir = "INSERT INTO tblDirecciones 
    (docIdentidadDireccion,nombreDireccion,descripcionDireccion,ciudadDireccion) 
    VALUES (?,?,?,?)";
    $consultaAgregarDir = $pdo->prepare($sqlAgregarDir);
    if ($consultaAgregarDir->execute(array($usuario,$nombre,$direccion,$ciudad))) {
        echo "<script>alert('Dirección almacenada con exito!');</script>";
        echo "<script>document.location.href='../perfil.php';</script>";
    } else {
        echo "<script>alert('Ocurrió un error!');</script>";
        echo "<script>document.location.href='../perfil.php';</script>";
    }
}
