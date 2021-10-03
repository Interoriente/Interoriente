<?php
require "../../Controllers/php/users/publicaciones.php";
$respCategorias = MostrarCategorias();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="icon" href="../assets/img/favicon.png" type="image/png" />
    <title>Catalógo Producto | Interoriente</title>
</head>

<body>
    <?php
    include '../includes/superior.php';
    ?>
    <!-- CCS Local-->
    <link rel="stylesheet" href="../assets/css/general.css">
    <link rel="stylesheet" href="../assets/css/categorias.css">
    <!-- ----- -->
    <div class="padre">
        <div class="header">
            <!--Inicio Pestaña de resltados-->
            <div class="pestana">
                <div class="pestana-pest">
                    <a href="#" class="tit-hdos">
                        <h2>Catálogos</h2>
                    </a>
                    <i class="fas fa-chevron-right"></i>
                    <a href="#" class="tit-hdos">
                        <h2>Productos</h2>
                    </a>
                </div>
            </div>
            <!--Fin Pestaña de resultados-->
            <br>
            <br>
            <div class="titulo">
                <h1 class="titulo-tit">Escoge entre nuestras categorías de productos</h1>
            </div>
            <br>
            <br>
            <div class="categorias">
                <div class="caja-categorias">
            <?php foreach ($respCategorias as $categorias) {
            ?>
                        <div class=" caja-categorias-subuno">
                            <h2 class="tit-hdos1"><?php echo $categorias['nombreCategoria']; ?></h2>
                            <img src="../assets/img/catalogos/<?php echo $categorias['imagenCategoria'] ?>" alt="" class="img-categorias">
                        </div>
            <?php } ?>
            </div>
            </div>
        </div>
    </div>

    <?php include '../includes/navInferior.php'; ?>
    <!-- Barra de navegación para dispositivos móviles -->
    <?php
    include '../includes/navMovil.php';
    ?>
</body>
</html>