<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="../../assets/img/favicon.png" type="image/png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
  <link rel="stylesheet" href="../../assets/css/general.css">
  <link rel="stylesheet" href="../../assets/css/estilosPublicacion.css">
  <link rel="stylesheet" href="../../assets/css/estilosNavs.css">

  <!-- Nota: Debe aparecer el nombre de la publicación en el título -->
  <title>Interoriente | Publicación</title>
</head>

<body>
  <!-- Sidebar y Navbar -->
  <?php include "../includes/navegacion.php"; ?>

  <!-- Sección imágene(s) título, precio, cantidad, color y botones  "Comprar ahora" y "Añadir al carrito" -->

  <!-- TODO: Sección "Cantidad" -> Estilos -->
  <div id="contenedor-principal">


    <div class="column carrusel">
      <img id=img-principal src="../../assets/img/stock/8.jpg">

      <div id="slide-wrapper">
        <img id="slideLeft" class="flecha" src="../../assets/img/navegacion/flechaIz.png">

        <div id="slider">
          <img class="thumbnail active" src="../../assets/img/stock/1.jpg">
          <img class="thumbnail" src="../../assets/img/stock/2.jpg">
          <img class="thumbnail" src="../../assets/img/stock/3.jpg">

          <img class="thumbnail" src="../../assets/img/stock/4.jpg">
          <img class="thumbnail" src="../../assets/img/stock/5.jpg">
          <img class="thumbnail" src="../../assets/img/stock/6.jpg">
          <img class="thumbnail" src="../../assets/img/stock/7.jpg">
        </div>

        <img id="slideRight" class="flecha" src="../../assets/img/navegacion/flechaDer.png">
      </div>
    </div>

    <div class="column">
      <h2>Monitor Samsung Ips De 24 Full Hd Freesync Hdmi Lf24t400fh</h2>
      <hr>
      <h3>$1.400.200</h3>

      <!-- Nota: Número máximo de caracteres: 245 - palabras: 43 - líneas: 2 -->
      <p class="descripcion">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

      <div class="seccion-cta">
        <div class="cantidad">
          <p>Cantidad</p>
          <input value=1 type="number">
        </div>
        <div class="cta">
          <a class="btn btn-accion" href="#">Comprar Ahora</a>
          <a class="btn btn-accion" href="#">Agregar al carrito</a>
        </div>

      </div>


    </div>

  </div>

  <script src="../../assets/js/publicacion.js"></script>


  <!-- Sección "Descripción" -->
  <?php include "../includes/navegacionDos.php"; ?>

  <!-- <section class="principal">
    <div class="imagen">

    </div>
    <div class="informacion">
      <div class="contenido-principal">

      </div>
      <div class="botones-cta">

      </div>
    </div>
  </section> -->
</body>

</html>