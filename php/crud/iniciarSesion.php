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
        $sqlInicio = "SELECT*FROM tblUsuario WHERE (documentoIdentidad=? OR emailUsuario=?)  AND contrasenaUsuario=? AND estadoUsuario = ?";
        $consultaInicio = $pdo->prepare($sqlInicio);
        if ($consultaInicio->execute(array($id, $id, $contrasena, $estado))) {
            $resultadoInicio = $consultaInicio->rowCount();
            if ($resultadoObjetoInicio = $consultaInicio->fetch(PDO::FETCH_OBJ)) {
                //Llamado al documento independiente si ingresa correo o documento
                $documento = $resultadoObjetoInicio->documentoIdentidad;
            }
        }

        //Llamado a tabla rol
        if ($resultadoInicio) { //Verifico que la informacion que se digitó en el formulario sea la que existe en BD, para llamar a tabla USuarioRol
            $sqlInicioUR = "SELECT idUsuarioRol FROM tblUsuarioRol WHERE docIdentidadUsuarioRol=?";
            $consultaInicioUR = $pdo->prepare($sqlInicioUR);
            $consultaInicioUR->execute(array($documento));
            $resultadoInicioUR = $consultaInicioUR->rowCount();
            $rol = $consultaInicioUR->fetch(PDO::FETCH_OBJ);
            if ($resultadoInicioUR) {
                $rol = $rol->idUsuarioRol;
            }
        }
        if ($resultadoInicio) {
            $_SESSION["documentoIdentidad"] = $resultadoObjetoInicio->documentoIdentidad;
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