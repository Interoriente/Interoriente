<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="shortcut icon"
      href="assets/img/favicon.png"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="assets/css/estilos.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"
      crossorigin="anonymous"
    />
    <title>Interoriente | ¡Bienvenidos!</title>
  </head>
  <body>
    <!--Banner y Logo-->

    <div class="bannerLogo">
      <div class="banner">
        <img
        id="banner"
        class="img-fluid"
        src="assets/img/banner_index.jpg"
        alt="Banner Interoriente"
      />
      </div>
      <div class="text-center logo">
        <a href="index.php"
          ><img
            src="assets/img/Flor2.svg"
            class="rounded"
            id="logo"
            alt="Logo Interoriente"
        /></a>
      </div>
    </div>
    <!--Sección Central-->
     <!--Imagen Teléfono-->
     <div class="contenedor-telefono">
      <div class="telefono-cta">
        <img src="assets/img/index/shopping.svg" alt="Ilustración ecomerce">
      </div>
     </div>
   
    <section>
      <!--Carrusel-->
      <div class="contenedor-principal">
        <div class="centro flex">
          <div class="carrusel flex">
            <div
              id="carouselExampleIndicators"
              class="carousel slide w-100 p-3"
              data-bs-ride="carousel"
            >
              <div class="carousel-indicators">
                <button
                  type="button"
                  data-bs-target="#carouselExampleIndicators"
                  data-bs-slide-to="0"
                  class="active"
                  aria-current="true"
                  aria-label="Slide 1"
                ></button>
                <button
                  type="button"
                  data-bs-target="#carouselExampleIndicators"
                  data-bs-slide-to="1"
                  aria-label="Slide 2"
                ></button>
                <button
                  type="button"
                  data-bs-target="#carouselExampleIndicators"
                  data-bs-slide-to="2"
                  aria-label="Slide 3"
                ></button>
              </div>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="assets/img/index/1.jpg" class="d-block w-100" alt="..." />
                </div>
                <div class="carousel-item">
                  <img src="assets/img/index/1.jpg" class="d-block w-100" alt="..." />
                </div>
                <div class="carousel-item">
                  <img src="assets/img/index/1.jpg" class="d-block w-100" alt="..." />
                </div>
              </div>
              <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev"
              >
                <span
                  class="carousel-control-prev-icon"
                  aria-hidden="true"
                ></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next"
              >
                <span
                  class="carousel-control-next-icon"
                  aria-hidden="true"
                ></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
          <div class="tituloBoton">
            <p class="titulo">
              Lorem ipsum dolor sit amet consectetur, adipisicing elit.
              Similique nam inventore eveniet veritatis fuga cupiditate sit aut,
              saepe nobis voluptas. Laudantium similique neque ullam quae quos.
              Eum iure porro reprehenderit.
            </p>
            <a href="principal/navegacion/iniciarsesion.php">¡Vamos!</a>
          </div>
        </div>
      </div>
    </section>
    <!-- Tarjetas -->
    <section class="cards">
      <div class="contenedor-tarjetas flex">
        <div class="tarjeta flex">
          <div class="card" style="width: 18rem;">
            <img src="assets/img/index/bird1.jpg" class="card-img-top" alt="...">
            <div class="card-body ">
              <h5 class="card-title">Título</h5>
              <p class="card-text infoTarjeta">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore quasi dolorem magni error, blanditiis, impedit consequatur, quo velit quam.</p>
              <a href="#" class="btn btn-primary botonTarjeta ">Más Información</a>
            </div>
          </div>
        </div>
        <div class="tarjeta flex">
          <div class="card" style="width: 18rem;">
            <img src="assets/img/index/bird3.jpg" class="card-img-top " alt="...">
            <div class="card-body">
              <h5 class="card-title">Título</h5>
              <p class="card-text infoTarjeta">Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore quasi dolorem magni error, blanditiis, impedit consequatur, quo velit quam.</p>
              <a href="#" class="btn btn-primary botonTarjeta " >Más Información</a>
            </div>
          </div>
        </div>
        <div class="tarjeta flex">
          <div class="card" style="width: 18rem;">
            <img src="assets/img/index/bird1.jpg" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title ">Título</h5>
              <p class="card-text infoTarjeta" >Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore quasi dolorem magni error, blanditiis, impedit consequatur, quo velit quam.</p>
              <a href="#" class="btn btn-primary botonTarjeta" >Más Información</a>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!--JS-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
      crossorigin="anonymous"
    ></script>
    <div class="logo"></div>
  </body>
</html>
