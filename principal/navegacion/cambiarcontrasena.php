<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/estiCambiarContra.css">
    <link rel="icon" href="../../assets/img/favicon.png" type="image/png" />
    <title>Cambiar Contraseña</title>
</head>

<body background="../../assets/img/fondocambiarcontrasena.jpg">
    <!-- Barra de navegación -->
    <?php
    include '../includes/superior.php';
    ?>
    <!-- ----- -->
    <div class="padre">
        <div class="header">
            <div class="menu1">
                <h1 class="tit-menu">CAMBIA TU CONTRASEÑA</h1>
                <div class="caja-formulario">
                    <p class="etiqueta"><strong>¿Cual será tu nueva Contraseña?</strong></p>
                    <input class="form-input" type="password" id="correo" required />
                    <p class="etiqueta"><strong>Repite tu Contraseña</strong></p>
                    <input class="form-input" type="password" id="correo" required />
                </div>
                <div class="conte-botonIniRe">
                    <a href="#"><button class="borecuperar"><strong>¡Listo!</strong></button></a>
                    <p class="text-RecorCon"><strong>¿Recordaste tu Contraseña?</strong><br>
                        <a class="boIniciaRecu" href="iniciarsesion.php"><strong> Inicia Sesión</strong></a>
                    </p>
                </div>
                <div class="contenedor-regresar">
                    <a href="index.php"><button class="BotonRegresar">Regresar</button></a>
                </div>
            </div>
            <!-- Sidebar -->
            <?php include '../includes/navInferior.php'; ?>
            <!-- ------- -->

            <!-- Barra de navegación para dispositivos móviles -->
            <?php
            include '../includes/navMovil.php';
            ?>
</body>

</html>