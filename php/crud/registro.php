<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        $telefono = strip_tags($_POST['telefono']);
        $correo = strip_tags($_POST['correo']);
        $contrasena = strip_tags($_POST['contrasena']);
        //Sha1 -> Método de encriptación
        $contrasena = sha1($_POST['contrasena']);
        $estado='0';
        //Verificación correo existente
        $sql_correoexistente = "SELECT*FROM tblusuarios WHERE correo='$correo'";
        $consulta_correo = $pdo->prepare($sql_correoexistente);
        $consulta_correo->execute();
        $resultado_correo = $consulta_correo->rowCount();
        var_dump($resultado_correo);
        if ($resultado_correo) {
            //Impresión correo ingresado, ya existe en BD
            echo "<script>alert('El correo ingresado ya existe!, por favor verificalo e intenta nuevamente');</script>";
            echo "<script> document.location.href='../../principal/registro.php';</script>";
        } else {
            //Consulta correo ingresado no existe en BD
            //sentencia Sql
            $sql_insertar = "INSERT INTO tblusuarios (nombres, apellidos, telefono, correo,contrasena,estado)VALUES (?,?,?,?,?,?)";
            //Preparar consulta
            $consulta_insertar = $pdo->prepare($sql_insertar);
            //Ejecutar la sentencia
            $consulta_insertar->execute(array($nombres, $apellidos, $telefono, $correo, $contrasena,$estado ));
            echo "<script>alert('Datos almacenados correctamente');</script>";
            echo "<script> document.location.href='../../principal/iniciarsesion.php';</script>";
        }
    }
    ?>
</body>
<body background="assets/img/im5.jpg" style="background-repeat: no-repeat; background-position: center center;">


</html>