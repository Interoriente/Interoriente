<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Favicon -->
    <link rel="icon" href="../../assets/img/favicon.png" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/indexEstilos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <title>Interoriente | Explora</title>
</head>

<body>
    <?php include '../includes/navegacion.php'; ?>
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
                            <h5>First slide label</h5>
                            <p>Some representative placeholder content for the first slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../../assets/img/index_2/2.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Second slide label</h5>
                            <p>Some representative placeholder content for the second slide.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="../../assets/img/index_2/3.jpg" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Third slide label</h5>
                            <p>Some representative placeholder content for the third slide.</p>
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
    <h1 class="titulo-filtrado">Aquí podrás filtrar resultados </h1>
    <section class="btns-filtrado" id="myBtnContainer">
        <div class="btn-productos">
            <a href="" onclick="filterSelection('Productos')">Productos</a>
        </div>
        <div class="btn-productos todos" onclick="filterSelection('todos')">
            <a href="">Todos</a>
        </div>
        <div class=" btn-servicios">
            <a href="" onclick="filterSelection('servicios')">Servicios</a>
        </div>

    </section>

    <section class="publicaciones">

        <div class="tarjeta">
            <div class="img-tarjeta">
                <img src="../../assets/img/publicaciones/1.jpg" alt="">
            </div>
            <div class="contenido-tarjeta">
                <h3>Computador XW23 Windows 11</h3>
                <h5> $1.400.200</h5>
            </div>
        </div>
        <div class="tarjeta">
            <div class="img-tarjeta">
                <img src="../../assets/img/publicaciones/1.jpg" alt="">
            </div>
            <div class="contenido-tarjeta">
                <h3>Computador XW23 Windows 11</h3>
                <h5> $1.400.200</h5>
            </div>
        </div>
        <div class="tarjeta">
            <div class="img-tarjeta">
                <img src="../../assets/img/publicaciones/1.jpg" alt="">
            </div>
            <div class="contenido-tarjeta">
                <h3>Computador XW23 Windows 11</h3>
                <h5> $1.400.200</h5>
            </div>
        </div>
        <div class="tarjeta">
            <div class="img-tarjeta">
                <img src="../../assets/img/publicaciones/1.jpg" alt="">
            </div>
            <div class="contenido-tarjeta">
                <h3>Computador XW23 Windows 11</h3>
                <h5> $1.400.200</h5>
            </div>
        </div>
        <div class="tarjeta">
            <div class="img-tarjeta">
                <img src="../../assets/img/publicaciones/1.jpg" alt="">
            </div>
            <div class="contenido-tarjeta">
                <h3>Computador XW23 Windows 11</h3>
                <h5> $1.400.200</h5>
            </div>
        </div>

    </section>




    <?php include '../includes/navegacionDos.php'; ?>
    <div class="contenedor-nav">
        <div class="navbar">
            <a href="#home" class="active">Mi cuenta</a>
            <a href="#news">Ofertas</a>
            <a href="#contact">Catálogos</a>
            <a href="#home">Mi carrito</a>
            <a href="#news">Mis compras</a>
            <a href="#contact">Catálogos</a>
            <a href="#contact">Ayuda</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>