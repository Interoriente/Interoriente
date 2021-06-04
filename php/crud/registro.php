<?php
if ($_POST) {
    //Llamar a la conexion base de datos
    include_once '../../dao/conexion.php';
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