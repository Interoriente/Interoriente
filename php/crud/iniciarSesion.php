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
        $id = strip_tags($_POST['id']);
        $contrasena = strip_tags($_POST['contrasena']);
        $contrasena = sha1($_POST['contrasena']);
        $estado = '1';
        $sql_inicio = "SELECT*FROM tblUsuario WHERE (documentoIdentidad=? OR emailUsuario=?)  AND contrasenaUsuario=? AND estadoUsuario = ?";
        $consulta_inicio = $pdo->prepare($sql_inicio);
        if ($consulta_inicio->execute(array($id, $id, $contrasena, $estado))) {
            $resultado_inicio = $consulta_inicio->rowCount();
            if ($prueba = $consulta_inicio->fetch(PDO::FETCH_OBJ)) {
                //Llamado al documento independiente si ingresa correo o documento
                $documento = $prueba->documentoIdentidad;
            }
        }

        //Llamado a tabla rol
        if ($resultado_inicio) { //Verifico que la informacion que se digitó en el formulario sea la que existe en BD, para llamar a tabla USuarioRol
            $sql_inicio1 = "SELECT idUsuarioRol FROM tblUsuarioRol WHERE docIdentidadUsuarioRol=?";
            $consulta_inicio1 = $pdo->prepare($sql_inicio1);
            $consulta_inicio1->execute(array($documento));
            $resultado_inicio1 = $consulta_inicio1->rowCount();
            $rol = $consulta_inicio1->fetch(PDO::FETCH_OBJ);
            if ($resultado_inicio1) {
                $rol = $rol->idUsuarioRol;
            }
        }
        if ($resultado_inicio) {
            $_SESSION["documentoIdentidad"] = $prueba->documentoIdentidad;
            //Siempre para iniciar se inicia como Comprador/Proveedor -> O por lo menos con el primer rol que se tenga
            $_SESSION['roles'] = $rol;
            //Comprador/Proveedor
            header("Location: ../../users/dashboard/principal/dashboard.php");
        } else {
            echo "<script>alert('Correo o documento y/o contraseña incorrecto, o validación denegada');</script>";
            echo "<script> document.location.href='../../principal/navegacion/iniciarsesion.php';</script>";
        }
    }
    ?>

</body>

</html>