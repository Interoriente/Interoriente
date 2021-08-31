<?php
if (isset($_GET['id'])) {

  $idPubli = $_GET['id'];
  include_once '../../dao/conexion.php';
  $sqlPubli="SELECT * FROM tblPublicacion INNER JOIN tblImagenes ON tblPublicacion.idPublicacion = tblImagenes.publicacionImagen WHERE idPublicacion=?";
  $consultaPubli=$pdo->prepare($sqlPubli);
  $consultaPubli->execute(array($idPubli));
  $resultadoPubli=$consultaPubli->fetchAll();
?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="../../assets/img/favicon.png" type="image/png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <link rel="stylesheet" href="../../assets/css/general.css">
    <link rel="stylesheet" href="../../assets/css/publicacion.css">
    <link rel="stylesheet" href="../../assets/css/estilosNavs.css">

    <!-- Nota: Debe aparecer el nombre de la publicación en el título -->
    <?php foreach ($resultadoPubli as $datos) {?>
    <title><?php echo $datos['nombrePublicacion']; ?></title>
    <?php } ?>
  </head>

  <body>
    <!-- Sidebar y Navbar -->
    <?php include "../includes/navSuperior.php"; ?>
    <!-- Idea: Cambio imagen en hover -->
    <!-- Sección imágene(s) título, precio, cantidad, color y botones  "Comprar ahora" y "Añadir al carrito" -->

    <!-- TODO: Sección "Cantidad" -> Estilos -->
    
    <div id="contenedor-principal">

      <div class="descripcion-m">
        <h2>Monitor Samsung Ips De 24 Full Hd Freesync Hdmi Lf24t400fh</h2>
        <hr>
        <h3>$1.400.200</h3>
      </div>

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
<?php foreach ($resultadoPubli as $datos) {?>
      <div class="column">
        <div class="descripcion-d">
          <h2><?php echo $datos['nombrePublicacion']; ?></h2>
          <hr>
          <h3>$<?php echo $datos['costoPublicacion']; ?></h3>
        </div>
        <!-- Nota: Número máximo de caracteres: 245 - palabras: 43 - líneas: 2 -->
        <p class="descripcion"><?php echo $datos['descripcionPublicacion']; ?></p>

        <div class="seccion-cta">
          <div class="cantidad">
            <p>Cantidad</p>
            <input value="1" min="1" type="number">
          </div>
          <div class="cta">
            <a class="btn btn-accion" href="#">Comprar Ahora</a>
            <a class="btn btn-accion" href="#">Agregar al carrito</a>
          </div>

        </div>
        <?php } ?>

      </div>

    </div>

    <script src="../../assets/js/publicacion.js"></script>


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

<<<<<<< HEAD
    </div>
    <div class="informacion-complementaria">
      <p>lorem</p>
      <p>lorem</p>
      <p>lorem</p>
    </div>
    <div class="perfil-proveedor">
      <div class="tarjeta-perfil">
        <img src="../../assets/img/10.jpg" alt="Imagen de perfil del proveedor">
        <a href="">
          Interoriente SAS
        </a>
      </div>
    </div>
  </section>
=======
      </div>
      <div class="perfil-proveedor">
        <div class="tarjeta-perfil">
          <img src="../../assets/img/10.jpg" alt="Imagen de perfil del proveedor">

          <a href="">
            Interoriente SAS
          </a>



        </div>

      </div>

    </section>
>>>>>>> b28a8e47855c049f11e7af525bc36ee62b114166

    <!-- Comentarios Publicación -->



    <!-- Footer -->
    <?php include "../includes/navInferior.php"; ?>


  </body>

  </html>
<?php
}else {
  echo "<script>alert('Por favor selecciona una publicación.');</script>";
  echo "<script> document.location.href='index.php';</script>";
}
?>