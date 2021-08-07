<?php
session_start();
if (isset($_SESSION['documentoIdentidad'])) {
    //Llamada a la conexion
    include_once '../../../../dao/conexion.php';
    $id = $_GET['id'];
    $estado = '0';
    //sentencia sql para actualizar estado
    $sqlEditar = "UPDATE tblEmpresa SET estadoEmpresa = ? WHERE nitEmpresa=?";
    $consultaEditar = $pdo->prepare($sqlEditar);
    $consultaEditar->execute(array($estado, $id));

    //Mostrar tabla TblEmprea
    $sqlMostrarEmpre = "SELECT documentoRepresentanteEmpresa FROM tblEmpresa WHERE nitEmpresa=?";
    $consultaMostrarEmpre = $pdo->prepare($sqlMostrarEmpre);
    $consultaMostrarEmpre->execute(array($id));
    $resultadoMostrarEmpre = $consultaMostrarEmpre->fetch(); //Traer información de una tabla

    //Capturo Documento, y NIT, creo variables
    $documento = $resultadoMostrarEmpre['documentoRepresentanteEmpresa'];

    //Capturo cuando rol sea igual a 2
    $rol = '2';

    //Eliminando datos en tblUSuarioRol
    $sqlBorrarUsuarioRol = "DELETE FROM tblUsuarioRol WHERE docIdentidadUsuarioRol=? AND idUsuarioRol=?";
    $consultaBorrarUsuarioRol = $pdo->prepare($sqlBorrarUsuarioRol);
    $consultaBorrarUsuarioRol->execute(array($documento, $rol));

    //Alert
    echo "<script>alert('Estado actualizado correctamente');</script>";

    //Redireccionar
    echo "<script> document.location.href='../empresas.php';</script>";
} else {
    echo "<script>alert('Error!, no se ha iniciado sesión');</script>";
    echo "<script> document.location.href='../403.php';</script>";
}