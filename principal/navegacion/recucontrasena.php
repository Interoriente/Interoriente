<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/estiRecuperarContraseña.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <link rel="icon" href="../../assets/img/favicon.png" type="image/png" />
    <title>Recuperar Contraseña | Interoriente</title>
</head>

<body background="../../assets/img/fondorecuperarcontrasena.jpg">
    <!-- Barra de navegación -->
    <?php
    include '../includes/superior.php';
    ?>
    <!-- ----- -->



    <div class="padre">
        <div class="header">
            <div class="menu1">
                <h1 class="tit-menu1">RECUPERA TU CONTRASEÑA</h1>
                <div class="caja-formulario">
                    <p class="etiqueta"><strong>¿Cual es tu correo?</strong></p>
                    <input class="form-input" type="email" id="correo" required />
                </div>
                <div class="conte-botonIniRe">
                    <a href="#"><button class="borecuperar"><strong>Recuperar mi Contraseña</strong></button></a>
                    <p class="text-RecorCon"><strong>¿Recordaste tu Contraseña?</strong><br>
                        <a class="boIniciaRecu" href="iniciarsesion.php"><strong> Inicia Sesión</strong></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- Sidebar -->
    <?php include '../includes/navInferior.php'; ?>
    <!-- ------- -->

    <!-- Barra de navegación para dispositivos móviles -->
    <?php
    include '../includes/navMovil.php';
    ?>
    <!-- Js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>