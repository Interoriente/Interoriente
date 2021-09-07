<?php
$nombre = strip_tags($_POST['nombres']);
$apellido = strip_tags($_POST['apellidos']);
$docIdentidad = strip_tags($_POST['documento']);
$email = strip_tags($_POST['correo']);
$pass = strip_tags($_POST['contrasena']);
$contrasenaRepetida = strip_tags($_POST['recontrasena']);
if ($contrasena==$contrasenaRepetida) {
    //Llamar a la conexion base de datos
    require '../../Models/dao/conexion.php';
    //Sha1 -> Método de encriptación
    $contrasena = sha1($pass);
    $estado = '1';
    $perfil = "../../Views/assets/img/UserDefault.png";
    $rol = '1';
    //sentencia Sql
    $sqlRegistro = "INSERT INTO tblUsuario 
    (documentoIdentidad,nombresUsuario, apellidoUsuario, 
    emailUsuario,contrasenaUsuario,estadoUsuario,imagenUsuario)
    VALUES (?,?,?,?,?,?,?)";
    //Preparar consulta
    $consultaRegistro = $pdo->prepare($sqlRegistro);
    //Ejecutar la sentencia
    $consultaRegistro->execute(array($docIdentidad, $nombre, $apellido, $email, $contrasena,  $estado, $perfil));
    //llamado a la tabla rol (intermedia) para almacenar el rol predeterminado
    $sqlRegistroUR = "INSERT INTO tblUsuarioRol 
    (idUsuarioRol,docIdentidadUsuarioRol)VALUES (?,?)";
    //Preparar consulta
    $consultaRegistroUR = $pdo->prepare($sqlRegistroUR);
    //Ejecutar la sentencia
    $consultaRegistroUR->execute(array($rol, $docIdentidad));
    /* Almacenado documento de identidad en variable de sesión
        Creación de la sesión */
    session_start();
    $_SESSION['roles'] = '1';
    $_SESSION["documentoIdentidad"] = $docId;
    //Comprador/Proveedor
    echo "<script> document.location.href='../../Views/dashboard/principal/dashboard.php';</script>";
}else {
    echo "<script>alert('Las contraseñas ingresadas no coinciden')</script>";
}
