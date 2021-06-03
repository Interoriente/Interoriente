<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
</head>

<body>
    <form action="../php/crud/registro.php" method="post">
        <label for="correo">Correo</label>
        <input type="text" name="correo" id=""><br><br>
        <label for="contrasena">Contraseña</label>
        <input type="password" name="contrasena" id=""><br><br>
        <button type="submit">Enviar</button>
    </form>
</body>

</html>