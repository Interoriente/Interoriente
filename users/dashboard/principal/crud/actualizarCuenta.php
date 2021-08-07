<?php
session_start();
if (isset($_SESSION['documentoIdentidad'])) {
    //Llamar a la conexión
    include_once '../../../../dao/conexion.php';
    //Captura id
    $id = $_GET['ideditar'];
    $celular = $_GET['celular'];
    //$ciudad = $_GET['ciudad'];
    $correo = $_GET['correo'];
    //Sentencia sql
    $sql_actualizar = "UPDATE tblUsuario SET telefonomovilUsuario=?,emailUsuario=? WHERE documentoIdentidad=?";
    //Preparar la consulta
    $consultar_actualizar = $pdo->prepare($sql_actualizar);
    //Ejecutar

    //Redireccionar
    if ($consultar_actualizar->execute(array($celular,  $correo, $id))) {
        echo "<script>alert('Datos actualizados correctamente');</script>";

        echo "<script> document.location.href='../perfil.php';</script>";
    } else {
        echo "<script>alert('Error!, verifica e intenta nuevamente');</script>";

        echo "<script> document.location.href='../perfil.php';</script>";
    }
} else {
    echo "<script>alert('Error!, no se ha iniciado sesión');</script>";
    echo "<script> document.location.href='../403.php';</script>";
}
