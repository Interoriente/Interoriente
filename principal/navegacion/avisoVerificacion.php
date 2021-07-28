<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/estilosVerificacion.css">
    <link rel="stylesheet" href="../../assets/css/estilosNavs.css">
    <link rel="icon" href="../../assets/img/favicon.png" type="image/png" />
    <title>Verificacion</title>
</head>

<body>
    <!-- Barra de navegación -->
    <?php
    include '../includes/superior.php';
    ?>
    <!-- ----- -->

    <div class="contenedor-prin">
        <div class="contenedor-principal">
            <div class="">
                <a href="">Preguntas Frecuentes</a>
            </div>
            <div class="">
                <a href="">test 3</a>
            </div>
            <div class="">
                <a href="">test 2</a>
            </div>
            <div class="">
                <a href="">Test </a>
            </div>
            <div class="">
                <a href="">Ayuda</a>
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