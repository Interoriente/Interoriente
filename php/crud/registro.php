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
    if ($_POST) {
        //Llamar a la conexion base de datos
        include_once '../../dao/conexion.php';
        //Capturo información
        $nombres = strip_tags($_POST['nombres']);
        $apellidos = strip_tags($_POST['apellidos']);
        $documento = strip_tags($_POST['documento']);
        $telefono = strip_tags($_POST['telefono']);
        $celular = strip_tags($_POST['celular']);
        //$ciudad = strip_tags($_POST['ciudad']);
        $correo = strip_tags($_POST['correo']);
        $contrasena = strip_tags($_POST['contrasena']);
        //Sha1 -> Método de encriptación
        $contrasena = sha1($_POST['contrasena']);
        $estado = '1';
        $perfil = "imagenes/NO_borrar.png";
        $rol = '1';
        //Verificación correo existente
        $sql_correoexistente = "SELECT*FROM tblUsuario WHERE emailUsuario=? or documentoIdentidad=?";
        $consulta_correo = $pdo->prepare($sql_correoexistente);
        $consulta_correo->execute(array($correo, $documento));
        $resultado_correo = $consulta_correo->rowCount();
        //var_dump($resultado_correo);
        if ($resultado_correo) {
            //Impresión correo ingresado, ya existe en BD
            echo "<script>alert('El correo y/o documento ingresado ya existe!, por favor verificalo e intenta nuevamente');</script>";
            echo "<script> document.location.href='../../principal/navegacion/registro.php';</script>";
        } else {
            //Consulta correo ingresado no existe en BD
            //sentencia Sql
            $sql_insertar = "INSERT INTO tblUsuario (documentoIdentidad,nombresUsuario, apellidoUsuario, telefonofijoUsuario,telefonomovilUsuario, emailUsuario,contrasenaUsuario,estadoUsuario,imagenUsuario)VALUES (?,?,?,?,?,?,?,?,?)";
            //Preparar consulta
            $consulta_insertar = $pdo->prepare($sql_insertar);
            //Ejecutar la sentencia
            $consulta_insertar->execute(array($documento, $nombres, $apellidos, $telefono, $celular, $correo, $contrasena,  $estado, $perfil));

            //llamado a la tabla rol (intermedia) para almacenar el rol predeterminado
            $sql_insertar = "INSERT INTO tblUsuarioRol (idRol,docIdentidad)VALUES (?,?)";
            //Preparar consulta
            $consulta_insertar = $pdo->prepare($sql_insertar);
            //Ejecutar la sentencia
            $consulta_insertar->execute(array($rol, $documento));
            echo "<script>alert('Datos almacenados correctamente');</script>";
            echo "<script> document.location.href='../../principal/navegacion/iniciarsesion.php';</script>";
        }
    }
    ?>
</body>


</html>