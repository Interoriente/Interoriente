<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

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
        $correo = strip_tags($_POST['correo']);
        $contrasena = strip_tags($_POST['contrasena']);
        $contrasena = sha1($_POST['contrasena']);
        $sql_inicio = "SELECT*FROM tblusuarios WHERE correo ='$correo' AND contrasena='$contrasena'";
        $consulta_inicio = $pdo->prepare($sql_inicio);
        $consulta_inicio->execute(array($correo, $contrasena));
        $resultado_inicio = $consulta_inicio->rowCount();
        $prueba = $consulta_resta->fetch(PDO::FETCH_OBJ);
        if ($resultado_inicio) {
            $_SESSION["correo"] = $prueba->correo;
            $_SESSION["idusuario"] = $prueba->idusuario;
            echo "<script> document.location.href='../../dashboard/dashPrin/index.php';</script>";
        } else {
            echo "<script>alert('Correo y/o contraseña incorrecto');</script>";
        }
    }
    ?>
</body>

</html>