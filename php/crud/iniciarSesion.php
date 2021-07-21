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
        require '../../dao/conexion.php';
        //Capturo información
        $id = strip_tags($_POST['documento']);
        $contrasena = strip_tags($_POST['contrasena']);
        $contrasena = sha1($_POST['contrasena']);
        $estado = '1';
        $sql_inicio = "SELECT*FROM tblUsuario WHERE documentoIdentidad='$id'  AND contrasenaUsuario='$contrasena'AND estadoUsuario = '$estado'";
        $consulta_inicio = $pdo->prepare($sql_inicio);
        $consulta_inicio->execute();
        $resultado_inicio = $consulta_inicio->rowCount();
        $prueba = $consulta_inicio->fetch(PDO::FETCH_OBJ);


        //Llamado a tabla rol
        if ($resultado_inicio) { //Verifico que la informacion que se digitó en el formulario sea la que existe en BD, para llamar a tabla USuarioRol
            $sql_inicio1 = "SELECT idUsuarioRol FROM tblUsuarioRol WHERE docIdentidadUsuarioRol='$id'";
            $consulta_inicio1 = $pdo->prepare($sql_inicio1);
            $consulta_inicio1->execute();
            $resultado_inicio1 = $consulta_inicio1->rowCount();
            $rol = $consulta_inicio1->fetch(PDO::FETCH_OBJ);
            if ($resultado_inicio1) {
                $rol = $rol->idUsuarioRol;
            }
        }
        if ($resultado_inicio) {

            $_SESSION["emailUsuario"] = $prueba->emailUsuario;
            $_SESSION["documentoIdentidad"] = $prueba->documentoIdentidad;
            $_SESSION['roles'] = $rol;
            $_SESSION["rolUsuario"] = '1';
            echo $_SESSION['roles'];
            if ($rol == '1') {
                //Comprador/Proveedor
                header("Location: ../../users/dashboard/principal/dashboard.php");
                $_SESSION["rolUsuario"] = '1';
            } else if ($rol == '2') {
                //Empleado
                header("Location: ../../users/dashboard/principal/dashboard.php");
                $_SESSION["rolUsuario"] = '2';
            } else {
                //Administrador
                header("Location: ../../users/dashboard/principal/dashboard.php");
                $_SESSION["rolUsuario"] = '3';
            }
        } else {
            echo "<script>alert('Documento y/o contraseña incorrecto, o validación denegada');</script>";
            echo "<script> document.location.href='../../principal/navegacion/iniciarsesion.php';</script>";
        }
    }
    ?>

</body>

</html>