<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../assets/img/favicon.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <title>Opciones Envío | Interoriente</title>
</head>

<body background="../assets/img/fondocatalogo.jpg">
<!-- CSS Local -->
<link rel="stylesheet" href="../assets/css/general.css" />
<link rel="stylesheet" href="../assets/css/opcionesEnvio.css">
<!-- ----- -->
<!-- Barra de navegación -->
    <?php
    include '../includes/superior.php';
    ?>
    <!-- ----- -->
    <div class="padre">
        <div class="header">
            <div class="contenedor-menuuno">
                <h1 class="tit-menudos">¿Cómo deseas recibir tu producto?</h1>
            </div>
            <div class="contenedor-menudos">
                <div class="menuuno"><a href="#">
                        <h1 class="tit-menuuno">Quiero retirarlo en la tienda</h1>
                    </a>
                </div>

                <div class="menuuno"><a href="#">
                        <h1 class="tit-menuuno">Quiero retirarlo a domicilio</h1>
                    </a>
                </div>
            </div>
            <div class="contenedor-regresar">
                <a href="javascript: history.go(-1)"><button class="BotonRegresar">Regresar</button></a>
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