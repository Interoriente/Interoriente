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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
  <!--Link solución protocolo: https://www.bugsnag.com/blog/jquery-is-not-defined-cause-solution-->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <title>Publicación | Interoriente</title>
</head>

<body>
  <!-- Sidebar y Navbar -->
  <?php include "../includes/superior.php"; ?>
  <div id="contenedor-principal">

    <div class="descripcion-m">
      <h2>Monitor Samsung Ips De 24 Full Hd Freesync Hdmi Lf24t400fh</h2>
      <hr>
      <h3>$1.400.200</h3>
    </div>

    <div class="column carrusel">
      <img id=img-principal src="../assets/img/stock/8.jpg">

      <div id="slide-wrapper">
        <img id="slideLeft" class="flecha" src="../assets/img/navegacion/flechaIz.png">

        <div id="slider">
          <img class="thumbnail active" src="../assets/img/stock/1.jpg">
          <img class="thumbnail" src="../assets/img/stock/2.jpg">
          <img class="thumbnail" src="../assets/img/stock/3.jpg">
          <img class="thumbnail" src="../assets/img/stock/4.jpg">
          <img class="thumbnail" src="../assets/img/stock/5.jpg">
          <img class="thumbnail" src="../assets/img/stock/6.jpg">
          <img class="thumbnail" src="../assets/img/stock/7.jpg">
        </div>

        <img id="slideRight" class="flecha" src="../assets/img/navegacion/flechaDer.png">
      </div>
    </div>

    <div class="column">
      <div class="descripcion-d">
        <h2>Monitor Samsung Ips De 24 Full Hd Freesync Hdmi Lf24t400fh</h2>
        <hr>
        <h3>$1.400.200</h3>
      </div>
      <!-- Nota: Número máximo de caracteres: 245 - palabras: 43 - líneas: 2 -->
      <p class="descripcion">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

      <div class="seccion-cta">
        <div class="cantidad">
          <p>Cantidad</p>
          <!-- <input value="1" min="1" type="number"> -->
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
    <!-- TODO: Agregar condicional para mostrar "producto" o "servicio" segun tipo de publicación -->
    <h1>Detalles de la publicación</h1>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut architecto, voluptatibus repudiandae optio doloribus et voluptates recusandae nostrum beatae placeat quas aperiam neque distinctio expedita quidem sapiente corrupti hic quis. Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque eum harum blanditiis nemo natus officiis tempore aliquam maxime incidunt dolore, ullam numquam similique delectus explicabo qui odit in assumenda laboriosam.</p>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut architecto, voluptatibus repudiandae optio doloribus et voluptates recusandae nostrum beatae placeat quas aperiam neque distinctio expedita quidem sapiente corrupti hic quis. Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque eum harum blanditiis nemo natus officiis tempore aliquam maxime incidunt dolore, ullam numquam similique delectus explicabo qui odit in assumenda laboriosam.</p>
  </section>

  <!-- Sección Datos Proveedor -->

  <section class="info-proveedor">
    <div class="descripcion-proveedor">
      <h2>Coordinadora recoge y entrega contra reloj.</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda soluta nemo placeat sunt nobis odio dolorem fuga asperiores expedita quos earum error omnis, voluptas vitae velit repellat veritatis at ipsa?</p>
    </div>
    <div class="informacion-complementaria">
      <p>lorem</p>
      <p>lorem</p>
      <p>lorem</p>
    </div>
    <div class="perfil-proveedor">
      <div class="tarjeta-perfil">
        <img src="../assets/img/10.jpg" alt="Imagen de perfil del proveedor">
        <a href="">
          Interoriente SAS
        </a>
      </div>

    </div>

  </section>

  <!-- Comentarios Publicación -->

  <!-- js -->
  <script src="../../Views/js/publicacion.js"></script>
  <!-- Footer -->
  <?php include "../includes/navInferior.php"; ?>
</body>

</html>