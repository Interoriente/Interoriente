<?php
session_start();
?>
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
        $correo = strip_tags($_POST['correo']);
        $contrasena = strip_tags($_POST['contrasena']);
        $contrasena = sha1($_POST['contrasena']);
        $estado = '1';
        $sql_inicio = "SELECT*FROM tblUsuario WHERE emailUsuario ='$correo' OR documentoIdentidad='$correo'  AND contrasenaUsuario='$contrasena'AND estadoUsuario = '$estado'";
        $consulta_inicio = $pdo->prepare($sql_inicio);
        $consulta_inicio->execute(array($correo, $contrasena));
        $resultado_inicio = $consulta_inicio->rowCount();
        $prueba = $consulta_inicio->fetch(PDO::FETCH_OBJ);
        if ($resultado_inicio) {
            $_SESSION["emailUsuario"] = $prueba->emailUsuario;
            $_SESSION["documentoIdentidad"] = $prueba->documentoIdentidad;
            echo "<script> document.location.href='../../users/dashboard/examples/dashboard.php';</script>";
        } else {
            echo "<script>alert('Correo y/o contraseña incorrecto, o validación denegada');</script>";
            echo "<script> document.location.href='../../principal/iniciarsesion.php';</script>";
        }
    }
    ?>
    
</body>

</html><?php
session_start();
?>
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
        $correo = strip_tags($_POST['correo']);
        $contrasena = strip_tags($_POST['contrasena']);
        $contrasena = sha1($_POST['contrasena']);
        $estado = '1';
        $sql_inicio = "SELECT*FROM tblUsuario WHERE emailUsuario ='$correo' OR documentoIdentidad='$correo'  AND contrasenaUsuario='$contrasena'AND estadoUsuario = '$estado'";
        $consulta_inicio = $pdo->prepare($sql_inicio);
        $consulta_inicio->execute(array($correo, $contrasena));
        $resultado_inicio = $consulta_inicio->rowCount();
        $prueba = $consulta_inicio->fetch(PDO::FETCH_OBJ);
        if ($resultado_inicio) {
            $_SESSION["emailUsuario"] = $prueba->emailUsuario;
            $_SESSION["documentoIdentidad"] = $prueba->documentoIdentidad;
            echo "<script> document.location.href='../../users/dashboard/examples/dashboard.php';</script>";
        } else {
            echo "<script>alert('Correo y/o contraseña incorrecto, o validación denegada');</script>";
            echo "<script> document.location.href='../../principal/iniciarsesion.php';</script>";
        }
    }
    ?>
    
</body>

</html>