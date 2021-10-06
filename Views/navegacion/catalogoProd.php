<?php
require "../../Controllers/php/users/publicaciones.php";
$respCategorias = MostrarCategorias();
?>
<!DOCTYPE html>
<html lang="esp">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/general.css">
    <link rel="stylesheet" href="../assets/css/categorias.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="icon" href="../assets/img/favicon.png" type="image/png" />
    <!-- Es necesario para que abra el carrito y trabaje el buscar -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Catalógo Producto | Interoriente</title>
</head>

<body>
    <?php
    include '../includes/superior.php';
    ?>
    <!-- CCS Local-->

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
                        <a href="">
                            <div class=" caja-categorias-subuno">
                                <img src="../assets/img/catalogos/<?php echo $categorias['imagenCategoria'] ?>" alt="" class="img-categorias">
<!--                                 <div class="contenedor">
 -->                                <h2 class="tit-hdos1"><?php echo $categorias['nombreCategoria']; ?></h2>
                                <!-- </div> -->
                            </div>

                        </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <?php include '../includes/navInferior.php';
    /* include '../includes/navMovil.php'; */
    ?>