<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Favicon -->
    <link rel="icon" href="../../assets/img/favicon.png" type="image/png">
    <!-- General -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/indexEstilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />

    <title>Interoriente | Inicio</title>
</head>

<body>
    <!-- Sidebar -->
    <?php
    include '../includes/navSuperior.php';
    ?>
    <!-- ----- -->

    <!-- Sección del carrusel -->
    <section class="hero">
        <div class="hero-principal">
            <div class="img-hero">
                <img src="../../assets/img/index/index.svg" alt="">
            </div>
        </div>
        <div class="carrusel-container">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../../assets/img/index_2/1.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <!--    <h5>First slide label</h5>
                            <p>Some representative placeholder content for the first slide.</p> -->
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../../assets/img/index_2/2.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <!-- <h5>Second slide label</h5>
                            <p>Some representative placeholder content for the second slide.</p> -->
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../../assets/img/index_2/3.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <!--  <h5>Third slide label</h5>
                            <p>Some representative placeholder content for the third slide.</p> -->
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>

    <!-- TODO Implementar sistema de filtrado js -->

    <!-- Sección de los botons de filtrado -->
    <h1 class="titulo-filtrado">Aquí podrás filtrar resultados </h1>
    <section class="btns-filtrado">
        <a href="">
            <div class="btn-productos btn-filtro">
                Productos
            </div>
        </a>
        <a href="">
            <div class="btn-productos todos btn-filtro" onclick="filterSelection('todos')">
                Todos
            </div>
        </a>
        <a href="">
            <div class=" btn-servicios btn-filtro">
                Servicios
            </div>
        </a>

    </section>

    <!-- TODO: 1. Botones "Comprar Ahora" y "Agregar al carrito" cuando tarjeta:hover
            2. Hipervínculo tarjeta con publicación
                3. Íconos sidebar
                    4. Definir estado de hover para tarjetas
                        5. Modificar navbar para dispositivos móviles
                            6. Maquetar footer
                                7. Detalles a sidebar
-->



    <!-- Sección de las tarjetas -->

    <!-- NOTA: títulos de máximo 100 caracteres ó 14 palabras -->
    <section class="publicaciones">

        <!-- Tarjeta Final -->
        <div class="tarjeta">
            <a href="">
                <div class="img-tarjeta">
                    <img src="../../assets/img/publicaciones/2.jpg" alt="">
                </div>
                <div class="contenido-tarjeta">
                    <h5> $1.400.200</h5>
                    <h3>Monitor Samsung Ips De 24 Full Hd Freesync Hdmi Lf24t400fh </h3>
                    <p>Resitente computadora excelente sesdfa excelente excelente... <span>más</span></p>
            </a>
        </div>
        <div class="cta-btns">
            <img src="../../assets/img/iconos/compras.svg" alt="Bolsa de la compra">
            <img src="../../assets/img/iconos/carrito_2.svg" alt="Bolsa de la compra">
        </div>
        </div>
        <!-- ----  -->

        <div class="tarjeta">
            <a href="">
                <div class="img-tarjeta">
                    <img src="../../assets/img/publicaciones/2.jpg" alt="">
                </div>
                <div class="contenido-tarjeta">
                    <h5> $1.400.200</h5>
                    <h3>Monitor Samsung Ips De 24 Full Hd Freesync Hdmi Lf24t400fh </h3>
                    <p>Resitente computadora excelente sesdfa excelente excelente... <span>más</span></p>
            </a>
        </div>
        <div class="cta-btns">
            <img src="../../assets/img/iconos/compras.svg" alt="Bolsa de la compra">
            <img src="../../assets/img/iconos/carrito_2.svg" alt="Bolsa de la compra">
        </div>
        </div>
        <div class="tarjeta">
            <a href="publicacion.php">
                <div class="img-tarjeta">
                    <img src="../../assets/img/publicaciones/2.jpg" alt="">
                </div>
                <div class="contenido-tarjeta">
                    <h5> $1.400.200</h5>
                    <h3>Monitor Samsung Ips De 24 Full Hd Freesync Hdmi Lf24t400fh </h3>
                    <p>Resitente computadora excelente sesdfa excelente excelente... <span>más</span></p>
            </a>
        </div>
        <div class="cta-btns">
            <img src="../../assets/img/iconos/compras.svg" alt="Bolsa de la compra">
            <img src="../../assets/img/iconos/carrito_2.svg" alt="Bolsa de la compra">
        </div>
        </div>
        <div class="tarjeta">
            <a href="">
                <div class="img-tarjeta">
                    <img src="../../assets/img/publicaciones/2.jpg" alt="">
                </div>
                <div class="contenido-tarjeta">
                    <h5> $1.400.200</h5>
                    <h3>Monitor Samsung Ips De 24 Full Hd Freesync Hdmi Lf24t400fh </h3>
                    <p>Resitente computadora excelente sesdfa excelente excelente... <span>más</span></p>
            </a>
        </div>
        <div class="cta-btns">
            <img src="../../assets/img/iconos/compras.svg" alt="Bolsa de la compra">
            <img src="../../assets/img/iconos/carrito_2.svg" alt="Bolsa de la compra">
        </div>
        </div>
        <div class="tarjeta">
            <a href="">
                <div class="img-tarjeta">
                    <img src="../../assets/img/publicaciones/2.jpg" alt="">
                </div>
                <div class="contenido-tarjeta">
                    <h5> $1.400.200</h5>
                    <h3>Monitor Samsung Ips De 24 Full Hd Freesync Hdmi Lf24t400fh </h3>
                    <p>Resitente computadora excelente sesdfa excelente excelente... <span>más</span></p>
            </a>
        </div>
        <div class="cta-btns">
            <img src="../../assets/img/iconos/compras.svg" alt="Bolsa de la compra">
            <img src="../../assets/img/iconos/carrito_2.svg" alt="Bolsa de la compra">
        </div>
        </div>
        <div class="tarjeta">
            <a href="">
                <div class="img-tarjeta">
                    <img src="../../assets/img/publicaciones/2.jpg" alt="">
                </div>
                <div class="contenido-tarjeta">
                    <h5> $1.400.200</h5>
                    <h3>Monitor Samsung Ips De 24 Full Hd Freesync Hdmi Lf24t400fh </h3>
                    <p>Resitente computadora excelente sesdfa excelente excelente... <span>más</span></p>
            </a>
        </div>
        <div class="cta-btns">
            <img src="../../assets/img/iconos/compras.svg" alt="Bolsa de la compra">
            <img src="../../assets/img/iconos/carrito_2.svg" alt="Bolsa de la compra">
        </div>
        </div>

        <div class="tarjeta">
            <a href="">
                <div class="img-tarjeta">
                    <img src="../../assets/img/publicaciones/3.jpg" alt="">
                </div>
                <div class="contenido-tarjeta">
                    <!-- Precio de la publicación -->
                    <h5> $1.400.200</h5>
                    <!-- Título de la publicación -->
                    <h3>Monitor Samsung Ips De 24 Full Hd Freesync Hdmi Lf24t400fh </h3>
                    <!-- Descripción de la publicación -->
                    <p>Resitente computadora excelente sesdfa excelente excelente... <span>más</span></p>
            </a>
        </div>
        <div class="cta-btns">
            <img src="../../assets/img/iconos/compras.svg" alt="Bolsa de la compra">
            <img src="../../assets/img/iconos/carrito_2.svg" alt="Bolsa de la compra">
        </div>
        </div>


    </section>
    <br>
    <br>
    <br>
    <br>

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