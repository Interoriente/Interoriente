<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/favicon.png" type="image/png" />
    <link rel="stylesheet" href="../assets/css/general.css">
    <link rel="stylesheet" href="../assets/css/recuperarContrasena.css">
    <title>Recuperar Contraseña | Interoriente</title>
</head>

<body background="../../assets/img/fondorecuperarcontrasena.jpg">
    <!-- Barra de navegación -->
    <?php
    include '../includes/superior.php';
    ?>
    <!-- ----- -->
    <div class="padre">
        <form action="../../Controllers/email/mailRecuperaContrasena.php" method="post">
            <div class="header">
                <div class="menu1">
                    <h1 class="tit-menu1">RECUPERA TU CONTRASEÑA</h1>
                    <div class="caja-formulario">
                        <p class="etiqueta"><strong>¿Cual es tu correo?</strong></p>
                        <input class="form-input" type="email" id="correo" name="correo" required />
                    </div>
                    <div class="conte-botonIniRe">
                        <button class="borecuperar" type="submit"><strong>Recuperar mi Contraseña</strong></button>
                        <p class="text-RecorCon"><strong>¿Recordaste tu Contraseña?</strong><br>
                            <a class="boIniciaRecu" href="iniciarsesion.php"><strong> Inicia Sesión</strong></a>
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Sidebar -->
    <?php include '../includes/navInferior.php'; ?>
    <!-- ------- -->
    <!-- Barra de navegación para dispositivos móviles -->
</body>

</html>