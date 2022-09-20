<?php //Desencriptar con base64_decode.
$idPublicacion = base64_decode($_GET['id']);
require "../../Controllers/php/users/publicaciones.php";
$publicacion = new Publicaciones($idPublicacion);
$respPublicacion = $publicacion->MostrarPublicacion($publicacion->id);

$respImgPublicacion = $publicacion->MostrarImgPublicacion($publicacion->id);

$validarImagen = substr($respPublicacion[0]['imagenUsuario'], 0, 5);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="../assets/img/favicon.png" type="image/png" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../assets/css/general.css">
  <link rel="stylesheet" href="../assets/css/publicacion.css">
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
  <title><?= $respPublicacion[0]['nombrePublicacion']; ?></title>
</head>

<body>
  <!-- Sidebar y Navbar -->
  <?php
  include "../includes/superior.php";
  ?>
  <div id="contenedor-principal">

    <div class="column carrusel">
      <img id=img-principal src="<?= $respImgPublicacion[0]['urlImagen'] ?>">
      <div id="slide-wrapper">
        <img id="slideLeft" class="flecha" src="../assets/img/navegacion/flechaIz.png">
        <div id="slider">
          <?php foreach ($respImgPublicacion as $imagen) {
          ?>
            <img class="thumbnail" src="<?= $imagen['urlImagen'] ?>">
          <?php } ?>
        </div>

        <img id="slideRight" class="flecha" src="../assets/img/navegacion/flechaDer.png">
      </div>
    </div>

    <div class="column">
      <div class="descripcion-d">
        <h2 class="titulo-publicacion"><?= $respPublicacion[0]['nombrePublicacion'];
                                        ?></h2>
        <hr>
        <h3>$<?= number_format($respPublicacion[0]['costoPublicacion'], 0, '', '.');
              ?></h3>
      </div>
      <!-- Nota: Número máximo de caracteres: 245 - palabras: 43 - líneas: 2 -->
      <p class="descripcion">
        <!-- Pensar qué colocar aquí porque la descripción está inmensa y queda mejor abajo-->
      </p>

      <div class="seccion-cta">
        <div class="cantidad">
          <p>Existencia</p>
          <h4><?= $respPublicacion[0]['cantidadPublicacion'] ?></h4>
        </div>
        <div class="cta">
          <a class="btn btn-accion" href="checkout.php">Comprar Ahora</a>
          <a class="btn btn-accion" onclick="addCarrito(this.id)" id="<?= $respPublicacion[0]['idPublicacion'] ?>">Agregar al carrito</a>
        </div>

      </div>
    </div>

  </div>



  <!-- Sección "Descripción" Publicación-->

  <section class="descripcionPublicacion">
    <h1 class="informacion-h1 ">Descripción de la publicación</h1>
    <p><?= $respPublicacion[0]['descripcionPublicacion']; ?></p>
  </section>

  <!-- Sección Datos Proveedor -->

  <h1 class="informacion-h1 info-p-h1">Sobre el proveedor</h1>
  <section class="info-proveedor">

    <div class="descripcion-proveedor">
      <h2><?= $respPublicacion[0]['nombresUsuario']; ?></h2>
      <p><?= $respPublicacion[0]['descripcionUsuario']; ?></p>
      <br>
      <a target="_blank" href="https://api.whatsapp.com/send?phone=57<?= $respPublicacion[0]['telefono']; ?>">
        <img class="whatsapp-icon" src="../assets/img/iconos/whatsapp.svg" alt="Contacto Whatsapp">
      </a>
    </div>
    <div class="informacion-complementaria">
    </div>
    <div class="perfil-proveedor">
      <div class="tarjeta-perfil">
        <?php
        if ($validarImagen == "https") { ?>
          <img src="<?= $respPublicacion[0]['imagenUsuario']; ?>" alt="Imagen de perfil del proveedor">
        <?php } else { ?>
          <img src="../dashboard/principal/<?= $respPublicacion[0]['imagenUsuario']; ?>" alt="Imagen de perfil del proveedor">
        <?php } ?>
        <a href="">
          <?= $respPublicacion[0]['nombresUsuario']; ?>
        </a>
      </div>

    </div>

  </section>

  <!-- Comentarios Publicación -->

  <!-- js -->
  <script src="../../Views/js/publicacion.js"></script>
  <!-- Footer -->
  <?php include "../includes/navInferior.php"; ?>