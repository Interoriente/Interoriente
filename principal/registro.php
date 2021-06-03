<?php
if ($_POST) {
    //Llamar a la conexion base de datos
    include_once '../dao/conexion.php';
    //Capturo información
    $correo = strip_tags($_POST['correo']);
    $contrasena = strip_tags($_POST['contrasena']);
    $contrasena = sha1($_POST['contrasena']);
    $sql_correoexistente = "SELECT*FROM tblusuarios WHERE correo='$correo'";
    $consulta_correo = $pdo->prepare($sql_correoexistente);
    $consulta_correo->execute();
    $resultado_correo = $consulta_correo->rowCount();
    var_dump($resultado_correo);
    if ($resultado_correo) {
        echo "<script>alert('El correo ingresado ya existe!, por favor verificalo e intenta nuevamente');</script>";
    } else {
        //sentencia Sql
        $sql_insertar = "INSERT INTO tblusuarios (correo,contrasena)VALUES (?,?)";
        //Preparar consulta
        $consulta_insertar = $pdo->prepare($sql_insertar);
        //Ejecutar la sentencia
        $consulta_insertar->execute(array($correo, $contrasena));
        echo "<script>alert('Datos almacenados correctamente');</script>";
        echo "<script> document.location.href='../usuario/iniciarsesion.php';</script>";
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
        <input type="text" name="correo" id="">
        <label for="contrasena">Contraseña</label>
        <input type="password" name="contrasena" id="">
        <button type="submit">Enviar</button>
    </form>
</body>

</html>