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
        $sql_inicio = "SELECT*FROM tblUsuario WHERE emailUsuario ='$id' OR documentoIdentidad='$id'  AND contrasenaUsuario='$contrasena'AND estadoUsuario = '$estado'";
        $consulta_inicio = $pdo->prepare($sql_inicio);
        $consulta_inicio->execute();
        $resultado_inicio = $consulta_inicio->rowCount();
        $prueba = $consulta_inicio->fetch(PDO::FETCH_OBJ);
        $_SESSION["rolUsuario"] = '1';

        //Llamado a tabla rol
        $sql_inicio1 = "SELECT idRol FROM tblUsuarioRol WHERE documentoIdentidad='$id'";
        $consulta_inicio1 = $pdo->prepare($sql_inicio1);
        $consulta_inicio1->execute();
        $resultado_inicio1 = $consulta_inicio1->rowCount();
        $rol = $consulta_inicio1->fetch(PDO::FETCH_OBJ);

        /* $stmt = $pdo->prepare("SELECT idRol FROM tblUsuarioRol WHERE documentoIdentidad = :id");
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $rol = $stmt->fetch(PDO::FETCH_ASSOC); */

        if ($resultado_inicio) {

            $_SESSION["emailUsuario"] = $prueba->emailUsuario;
            $_SESSION["documentoIdentidad"] = $prueba->documentoIdentidad;

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
            /*   if ($resultado_inicio) {
            $_SESSION["emailUsuario"] = $prueba->emailUsuario;
            $_SESSION["documentoIdentidad"] = $prueba->documentoIdentidad;
            $rol=$prueba1->idRol;
            
            if ($rol == '1') {
                echo "<script> document.location.href='../../users/dashboard/principal/dashboard.php';</script>";
            }else {
                echo "Esto es otra cosa";
            } */
            /*  $_SESSION["rolUsuario"] = '1';
            $_SESSION["nombreRol"]="Comprador"; 
            echo "<script> document.location.href='../../users/dashboard/principal/dashboard.php';</script>";*/
        } else {
            echo "<script>alert('Correo y/o contraseña incorrecto, o validación denegada');</script>";
            echo "<script> document.location.href='../../principal/navegacion/iniciarsesion.php';</script>";
        }
    }
    ?>

</body>

</html>