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
            <div class="titulo">
                <h1 class="titulo-tit">Escoge entre nuestras categorías de productos</h1>
            </div>
            <br>
            <br>
            <div class="categorias">
                <div class="caja-categorias">
                    <?php foreach ($respCategorias as $categorias) {
                    ?>
                        <a href="index.php?catalogo=<?= base64_encode($categorias['idCategoria']) ?> &nombre<?= $categorias['nombreCategoria']; ?>">
                            <div class="caja-categorias-subuno">
                                <img src="../assets/img/catalogos/<?= $categorias['imagenCategoria'] ?>" alt="" class="img-categorias">
                                <h2 class="tit-hdos1"><?= $categorias['nombreCategoria']; ?></h2>
                            </div>
                        </a>
                    <?php } ?>
                </div>
                <!-- Fin caja-categoria -->
            </div>
            <!-- Header -->
        </div>
        <!-- Fin contenedor principal -->
    </div>

    <?php include '../includes/navInferior.php';
    /* include '../includes/navMovil.php'; */
    ?>