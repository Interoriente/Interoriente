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
    //Verificación correo existente
    $sql_correoexistente = "SELECT*FROM tblusuarios WHERE correo='$correo'";
    $consulta_correo = $pdo->prepare($sql_correoexistente);
    $consulta_correo->execute();
    $resultado_correo = $consulta_correo->rowCount();
    var_dump($resultado_correo);
    if ($resultado_correo) {
        //Impresión correo ingresado, ya existe en BD
        echo "<script>alert('El correo ingresado ya existe!, por favor verificalo e intenta nuevamente');</script>";
    } else {
        //Consulta correo ingresado no existe en BD
        //sentencia Sql
        $sql_insertar = "INSERT INTO tblusuarios (nombres, apellidos, telefono, correo,contrasena)VALUES (?,?,?,?,?)";
        //Preparar consulta
        $consulta_insertar = $pdo->prepare($sql_insertar);
        //Ejecutar la sentencia
        $consulta_insertar->execute(array($nombres, $apellidos, $telefono, $correo, $contrasena));
        echo "<script>alert('Datos almacenados correctamente');</script>";
        echo "<script> document.location.href='../../principal/iniciarsesion.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
</head>

<body>
    <form action="" method="post">
        <label for="correo">Correo</label>
        <input type="text" name="correo" id="" required autofocus>
        <label for="contrasena">Contraseña</label>
        <input type="password" name="contrasena" id="" required>
        <button type="submit">Enviar</button>
    </form>
</body>

</html>