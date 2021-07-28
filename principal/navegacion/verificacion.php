<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/estiVerificacion.css">
    <link rel="icon" href="../../assets/img/favicon.png" type="image/png" />
    <title>Verificación</title>
</head>

<body background="../../assets/img/fondoverificacion.png">
    <!-- Barra de navegación -->
    <?php
    include '../includes/superior.php';
    ?>
    <!-- ----- -->



    <div class="padre">
        <div class="header">
            <div class="menu">
                <div class="caja-tit-menu">
                    <h1 class="tit-menu">Hecho, ¡Estás a un paso!
                        Ahora nuestro equipo está verificándote</h1>
                </div>
            </div>
            <div class="menu1">
                <a href="#"><button class="caja1"><strong>Preguntas Frecuentes</strong></button></a>
                <a href="#"><button class="caja2"><strong>Soporte</strong></button></a>
            </div>
            <div class="menu2">
                <a href="#"><button class="caja3"><strong>Contacto</strong></button></a>
                <a href="#"><button class="caja4"><strong>Anular Proceso</strong></button></a>
            </div>
            <div class="menu3">
                <a href="#"><button class="caja5">Regresar</button></a>
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
</body>

</html>