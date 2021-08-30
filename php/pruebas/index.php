<?php
if ($_POST) {
  $idUsuario = $_POST['id'];
  $contrasena = $_POST['contrasena'];
  include "../users/acceso.php";
  $iniciar = new InicioSesion();
  $iniciar->iniciarSesion($idUsuario, $contrasena);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Pruebas</title>
</head>

<body>
  <form action="" method="Post">
    <label for="">Nombre de Usuario</label>
    <input type="text" name="id" />
    <label for="">Contrasena</label>
    <input type="text" name="contrasena"/>
    <input type="submit" value="Enviar" />
  </form>
</body>

</html>