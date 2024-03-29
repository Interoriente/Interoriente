<?php
@$catalogo = base64_decode($_GET['catalogo']);
if ($catalogo) {
    require "../../Controllers/php/users/publicaciones.php";
    $publicacionResp = new Publicaciones($catalogo);
    $publicacion = $publicacionResp->FiltroPublicacion($publicacionResp->id);
} else {
    require "../../Controllers/php/users/compras.php";
    $publicacion = getPublicaciones(); //Nota: Ciudado con el llamado de campos innecesarios
}
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
    <!-- Sweetalert 2 -->
    <link rel="stylesheet" href="../assets/css/sweetalert2.min.css">
    <!-- No eliminar este script -->
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <title> Inicio | Interoriente</title>
</head>

<body>

    <!-- Navegación -->
    <?php require '../includes/superior.php'; ?>
    <!-- Fin Navegación -->

    <section class="publicaciones">
        <!-- TODO Implementar sistema de filtrado js -->
        <!-- Sección de los botons de filtrado -->

        <h1>Aquí podrás encontrar el producto que deseas </h1>

        <!-- Tarjeta Final -->
        <?php
        foreach ($publicacion as $x) :
        ?>
            <div class="tarjeta">
                <!-- Le coloqué un montón de cosas que pasen por URL para no cambiar el a por un formulario, y que no quede el id tan fácil visible agregando el base64 para encriptar -->
                <a href="publicacion.php?id=<?= base64_encode($x['idPublicacion']) . "&?nombre=" . $x['nombrePublicacion'] ?>">
                    <!-- <img id="img-s" src="../assets/img/publicaciones/1.jpg" alt="Imagen tarjeta publicación"> -->
                    <div class="img-tarjeta">
                        <img id="img-p" src="<?= $x['urlImagen']; ?>" alt="Imagen tarjeta publicación">
                    </div>
                    <div class="contenido-tarjeta">
                        <!-- number_format para agregar los puntos de mil -->
                        <h5> $<?= number_format($x['costoPublicacion'], 0, '', '.'); ?></h5>

                        <h2><?= $x['nombrePublicacion'] ?></h2>
                        <!-- substr para limitar el tamaño del estring en este caso a 50 caracteres -->
                        <div class="descripcion">
                            <p><?= substr($x['descripcionPublicacion'], 0, 50) . "...   "; ?><span class="mas-info">Más Información</span></p>
                        </div>
                    </div>
                </a>
                <div class="cta-btns">
                    <img src="../assets/img/iconos/compras.svg" onclick="comprarAhora(this.id)" id="<?= $x['idPublicacion'] ?>" alt="Bolsa de la compra">
                    <img class="carrito-tarjeta" onclick="addCarrito(this.id)" id="<?= $x['idPublicacion'] ?>" src="../assets/img/iconos/carrito_2.svg" alt="Carro de la compra">
                </div>
            </div>
        <?php endforeach; ?>
        <!-- -- Fin tarjeta final--  -->

    </section>
    <!-- Fin sección Publicaciones -->
    </div>
    <!-- Importante: No hay etiquetas de cierrie porque ya se encuentran incluidas en NavInferior -->

    <!-- navegación -->
    <script src="../js/sweetalert2.min.js"></script>
    <?php include '../includes/navInferior.php'; ?>
    <!-- ------- -->