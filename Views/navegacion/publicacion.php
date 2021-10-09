<?php //Desencriptar con base64_decode.
$idPublicacion = base64_decode($_GET['id']);
require "../../Controllers/php/users/publicaciones.php";
$publicacion = new Publicaciones($idPublicacion);
$respPublicacion = $publicacion->MostrarPublicacion($publicacion->id);
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <title><?php echo $respPublicacion[0]['nombrePublicacion']; ?></title>
</head>

<body>
  <!-- Sidebar y Navbar -->
  <?php
  include "../includes/superior.php";
  ?>
  <div id="contenedor-principal">

    <div class="descripcion-m">
      <h2>Monitor Samsung Ips De 24 Full Hd Freesync Hdmi Lf24t400fh</h2>
      <hr>
      <h3>$1.400.200</h3>
    </div>

    <div class="column carrusel">
      <img id=img-principal src="<?php echo $respPublicacion[0]['urlImagen'] ?>">
      <div id="slide-wrapper">
        <img id="slideLeft" class="flecha" src="../assets/img/navegacion/flechaIz.png">
        <div id="slider">
          <?php foreach ($respPublicacion as $imagen) {
          ?>
            <img class="thumbnail" src="<?php echo $imagen['urlImagen'] ?>">
          <?php } ?>
        </div>

        <img id="slideRight" class="flecha" src="../assets/img/navegacion/flechaDer.png">
      </div>
    </div>

    <div class="column">
      <div class="descripcion-d">
        <h2><?php echo $respPublicacion[0]['nombrePublicacion'];
            ?></h2>
        <hr>
        <h3>$<?php echo number_format($respPublicacion[0]['costoPublicacion'], 0, '', '.');
              ?></h3>
      </div>
      <!-- Nota: Número máximo de caracteres: 245 - palabras: 43 - líneas: 2 -->
      <p class="descripcion">
        <!-- Pensar qué colocar aquí porque la descripción está inmensa y queda mejor abajo-->
      </p>

      <div class="seccion-cta">
        <div class="cantidad">
          <p>Cantidad</p>
          <input value="1" min="1" type="number">
        </div>
        <div class="cta">
          <a class="btn btn-accion" href="checkout.php">Comprar Ahora</a>
          <a class="btn btn-accion" href="#">Agregar al carrito</a>
        </div>

      </div>
    </div>

  </div>



  <!-- Sección "Descripción" Publicación-->

  <section class="descripcionPublicacion">
    <h1>Descripción de la publicación</h1>
    <p><?php echo $respPublicacion[0]['descripcionPublicacion']; ?></p>
  </section>

  <!-- Sección Datos Proveedor -->

  <section class="info-proveedor">
    <div class="descripcion-proveedor">
      <h2><?php echo $respPublicacion[0]['nombresUsuario']; ?></h2>
      <p><?php echo $respPublicacion[0]['descripcionUsuario']; ?></p>
    </div>
    <div class="informacion-complementaria">
      <p>lorem</p>
      <p>lorem</p>
      <p>lorem</p>
    </div>
    <div class="perfil-proveedor">
      <div class="tarjeta-perfil">
        <img src="../dashboard/principal/<?php echo $respPublicacion[0]['imagenUsuario']; ?>" alt="Imagen de perfil del proveedor">
        <a href="">
          <?php echo $respPublicacion[0]['nombresUsuario']; ?> S.A.S.
        </a>
      </div>

    </div>

  </section>

  <!-- Comentarios Publicación -->

  <!-- js -->
  <script src="../../Views/js/publicacion.js"></script>
  <!-- Footer -->
  <?php include "../includes/navInferior.php"; ?>