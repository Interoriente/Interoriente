<?php
session_start();
if (isset($_SESSION['documentoIdentidad'])) {
    //Llamada a la conexion
    include_once '../../../../dao/conexion.php';
    $id = $_GET['id'];
    $estado = '1';

    //sentencia sql para actualizar estado
    $sqlEditar = "UPDATE tblEmpresa SET estadoEmpresa = ? WHERE nitEmpresa=?";
    $consultaEditar = $pdo->prepare($sqlEditar);
    $consultaEditar->execute(array($estado, $id));

    //Mostrar tabla TblEmpresa
    $sqlMostrarEmpre = "SELECT * FROM tblEmpresa WHERE nitEmpresa=?";
    $consultaMostrarEmpre = $pdo->prepare($sqlMostrarEmpre);
    $consultaMostrarEmpre->execute(array($id));
    $resultadoMostrarEmpre = $consultaMostrarEmpre->fetch(); //Traer información de una tabla

    //Capturo Documento, y NIT, creo variables
    $nit = $resultadoMostrarEmpre['nitEmpresa'];
    $documento = $resultadoMostrarEmpre['documentoRepresentanteEmpresa'];

    //Definido el valor del rol
    $rol = '2';

    //Guardando datos en tblUSuarioRol
    $sqlInsertarUsuarioRol = "INSERT INTO tblUsuarioRol (docIdentidadUsuarioRol,idUsuarioRol) VALUES (?,?)";
    $consultaInsertarUsuarioRol = $pdo->prepare($sqlInsertarUsuarioRol);
    $consultaInsertarUsuarioRol->execute(array($documento, $rol));

    //Alert
    echo "<script>alert('Estado actualizado correctamente');</script>";

    //Redireccionar
    echo "<script> document.location.href='../empresas.php';</script>";
} else {
    echo "<script>alert('Error!, no se ha iniciado sesión');</script>";
    echo "<script> document.location.href='../403.php';</script>";
}
