<?php
require "../../Controllers/php/users/compras.php";
$publicacion = getPublicaciones();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Favicon -->
    <link rel="icon" href="../assets/img/favicon.png" type="image/png">
    <!-- General -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/general.css">
    <link rel="stylesheet" href="../assets/css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <!--Link solución protocolo: https://www.bugsnag.com/blog/jquery-is-not-defined-cause-solution-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title> Inicio | Interoriente</title>
</head>

<body>

    <!-- Navegación -->
    <?php require '../includes/superior.php'; ?>
    <!-- ----- -->

        <section class="publicaciones">
            <!-- TODO Implementar sistema de filtrado js -->
            <!-- Sección de los botons de filtrado -->
            <h1 class="titulo-filtrado ">Aquí podrás encontrar el producto que deseas </h1>
            <section class="btns-filtrado ">
                <a href="#">

                    <div id="productos" class="btn-productos btn-filtro">
                        Productos
                    </div>
                </a>
                <a href="#">
                    <div class="btn-productos todos btn-filtro" onclick="filterSelection('todos')">
                        Todos
                    </div>
                </a>
                <a href="#">
                    <div class=" btn-servicios btn-filtro">
                        Servicios
                    </div>
                </a>
            </section>
            <!-- Sección de las tarjetas -->

            <!-- NOTA: títulos de máximo 100 caracteres ó 14 palabras -->

            <!-- Tarjeta Final -->
            <?php foreach ($publicacion as $x) : ?>
                <div class="tarjeta">
                    <a href="publicacion.php?id=<?php echo $x['idPublicacion'] ?>">
                        <div class="img-tarjeta">
                            <img id="img-p" src="<?php echo $x['urlImagen']; ?>" alt="Imagen tarjeta publicación">
<!--                             <img id="img-s" src="../assets/img/publicaciones/1.jpg" alt="Imagen tarjeta publicación">
 -->                        </div>
                        <div class="contenido-tarjeta">
                            <!-- number_format para agregar los puntos de mil -->
                            <h5> $<?php echo number_format($x['costoPublicacion'], 0, '', '.'); ?></h5>

                            <h3><?php echo $x['nombrePublicacion'] ?></h3>
                            <!-- substr para limitar el tamaño del estring en este caso a 140 caracteres -->
                            <p><?php echo substr($x['descripcionPublicacion'], 0, 80) . "...   "; ?><span class="mas-info">Más Información</span></p>
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
    <!-- navegación -->
    <?php include '../includes/navInferior.php'; ?>
    <!-- ------- -->

    <!-- Barra de navegación para dispositivos móviles -->
    <?php
    include '../includes/navMovil.php';
    ?>

    <!-- Js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="../js/navegacion.js"></script>

</body>

</html>