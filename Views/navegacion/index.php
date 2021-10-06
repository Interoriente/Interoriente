<?php
require "../../Controllers/php/users/compras.php";
$publicacion = getPublicaciones();
?>
<!DOCTYPE html>
<html lang="esp">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Favicon -->
    <link rel="icon" href="../assets/img/favicon.png" type="image/png">
    <!-- General -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/general.css">
    <link rel="stylesheet" href="../assets/css/index.css">
    <!-- No eliminar este script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title> Inicio | Interoriente</title>
</head>

<body>

    <!-- Navegación -->
    <?php require '../includes/superior.php'; ?>
    <!-- Fin Navegación -->

    <section class="publicaciones">
        <!-- TODO Implementar sistema de filtrado js -->
        <!-- Sección de los botons de filtrado -->
        <h1 class="titulo-filtrado ">Aquí podrás encontrar el producto que deseas </h1>
        <section class="btns-filtrado ">
            <a href="#">

                <div id="productos" class="btn-productos btn-filtro">
                    Filtro
                </div>
            </a>
            <a href="#">
                <div class="btn-productos todos btn-filtro" onclick="filterSelection('todos')">
                    Filtro
                </div>
            </a>
            <a href="#">
                <div class=" btn-servicios btn-filtro">
                    Filtro
                </div>
            </a>
        </section>
        <!-- Sección de las tarjetas -->

        <!-- NOTA: títulos de máximo 100 caracteres ó 14 palabras -->

        <!-- Tarjeta Final -->
        <?php foreach ($publicacion as $x) : ?>
            <div class="tarjeta">
                <!-- Le coloqué un montón de cosas que pasen por URL para no cambiar el a por un formulario, y que no quede el id tan fácil visible agregando el base64 para encriptar -->
                <a href="publicacion.php?id=<?php echo base64_encode($x['idPublicacion']) . "&?nombre=" . $x['nombrePublicacion'] ?>">
                    <!-- <img id="img-s" src="../assets/img/publicaciones/1.jpg" alt="Imagen tarjeta publicación"> -->
                    <div class="img-tarjeta">
                        <img id="img-p" src="<?php echo $x['urlImagen']; ?>" alt="Imagen tarjeta publicación">
                    </div>
                    <div class="contenido-tarjeta">
                        <!-- number_format para agregar los puntos de mil -->
                        <h5> $<?php echo number_format($x['costoPublicacion'], 0, '', '.'); ?></h5>

                        <h3><?php echo $x['nombrePublicacion'] ?></h3>
                        <!-- substr para limitar el tamaño del estring en este caso a 50 caracteres -->
                        <p><?php echo substr($x['descripcionPublicacion'], 0, 50) . "...   "; ?><span class="mas-info">Más Información</span></p>
                    </div>
                </a>
                <div class="cta-btns">
                    <a href="../navegacion/checkout.php?id=<?php echo $x['idPublicacion'] ?>"><img src="../assets/img/iconos/compras.svg" alt="Bolsa de la compra"></a>
                    <img class="carrito-tarjeta " onclick="addCarrito(this.id)" id="<?php echo $x['idPublicacion'] ?>" src="../assets/img/iconos/carrito_2.svg" alt="Carro de la compra">
                </div>
            </div>
        <?php endforeach; ?>
        <!-- -- Fin tarjeta final--  -->

    </section>
    <!-- Fin sección Publicaciones -->
    </div>
    <!-- Importante: No hay etiquetas de cierrie porque ya se encuentran incluidas en NavInferior -->

    <!-- navegación -->
    <?php include '../includes/navInferior.php'; ?>
    <!-- ------- -->