<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="../assets/img/favicon.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validando información...</title>
</head>

<body>
    <?php
    //Verifico que coincidan las contraseñas
    $contrasena = $_POST['contrasena'];
    $reContrasena = $_POST['recontrasena'];
    if ($contrasena == $reContrasena) {
        if ($_POST) {
            //Llamar a la conexion base de datos
            include_once '../../dao/conexion.php';
            //Capturo información
            $nombres = strip_tags($_POST['nombres']);
            $apellidos = strip_tags($_POST['apellidos']);
            $documento = strip_tags($_POST['documento']);
            $correo = strip_tags($_POST['correo']);
            $contrasena = strip_tags($_POST['contrasena']);
            //Sha1 -> Método de encriptación
            $contrasena = sha1($_POST['contrasena']);
            $estado = '1';
            $perfil = "imagenes/NO_borrar.png";
            $rol = '1';
            //Verificación correo existente
            $sqlExistente = "SELECT*FROM tblUsuario WHERE emailUsuario=? or documentoIdentidad=?";
            $consultaExistente = $pdo->prepare($sqlExistente);
            $consultaExistente->execute(array($correo, $documento));
            $resultadoExistente = $consultaExistente->rowCount();

            if ($resultadoExistente) {
                //Impresión correo ingresado, ya existe en BD
                echo "<script>alert('El correo y/o documento ingresado ya existe!, por favor verificalo e intenta nuevamente');</script>";
                echo "<script> document.location.href='../../principal/navegacion/registro.php';</script>";
            } else {
                //Consulta correo ingresado no existe en BD
                //sentencia Sql
                $sqlRegistro = "INSERT INTO tblUsuario (documentoIdentidad,nombresUsuario, apellidoUsuario, emailUsuario,contrasenaUsuario,estadoUsuario,imagenUsuario)VALUES (?,?,?,?,?,?,?)";
                //Preparar consulta
                $consultaRegistro = $pdo->prepare($sqlRegistro);
                //Ejecutar la sentencia

                if ($consultaRegistro->execute(array($documento, $nombres, $apellidos, $correo, $contrasena,  $estado, $perfil))) {
                    //llamado a la tabla rol (intermedia) para almacenar el rol predeterminado
                    $sqlRegistroUR = "INSERT INTO tblUsuarioRol (idUsuarioRol,docIdentidadUsuarioRol)VALUES (?,?)";
                    //Preparar consulta
                    $consultaRegistroUR = $pdo->prepare($sqlRegistroUR);
                    //Ejecutar la sentencia
                    $consultaRegistroUR->execute(array($rol, $documento));
                    echo "<script>alert('Datos almacenados correctamente');</script>";
                    /* Almacenado documento de identidad en variable de sesión
                    Creación de la sesión
                    */
                    session_start();
                    $_SESSION['roles'] = '1';
                    $_SESSION["documentoIdentidad"] = $documento;
                    //Comprador/Proveedor
                    echo "<script> document.location.href='../../users/dashboard/principal/dashboard.php';</script>";
                }
            }
        }
    } else {
        echo "<script>alert('Error!, las contraseñas ingresadas no coinciden, verifca e intenta nuevamente');</script>";
        echo "<script> document.location.href='../../principal/navegacion/registro.php';</script>";
    }
    ?>
</body>


</html>