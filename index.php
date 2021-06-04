<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/bootstrap/css/estilos.css">
  <title>Bienvenidos a Interoriente</title>
</head>

<body>
  <!--Banner y logo-->
  <img id="banner" src="assets/img/banner_index.jpg" class="img-fluid" alt="...">
  <img id="logo" src="assets/img/Flor2.svg" class="rounded mx-auto d-block" alt="...">
  <!--Botones de navegación-->
  <div class="btn-group" role="group" aria-label="Basic example">
  <a href="principal/registro.php"> <button type="button" class="btn btn-primary">Registro</button></a>
  <a href="principal/iniciarsesion.php"> <button type="button" class="btn btn-primary">Iniciar Sesión</button></a>
  <a href="dashboard/dashPrin/examples/index.php"> <button type="button" class="btn btn-primary">Dashboard</button></a>
</div>

 <!--Carrusel-->
 <div class="container">
  
  <ul class="slider">
    <li id="slide1">
      <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3947459/car.jpg"/>
    </li>
    <li id="slide2">
      <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3947459/sunset.jpg"/>
    </li>
    <li id="slide3">
      <h1>Ejemplo con otros elementos</h1>
      <p>Esto es un párrafo de ejemplo para comprobar que podemos meter cualquier tipo de elementos en el slider</p>
      <a href="https://kikopalomares.com/">¡Corre a mi web para más contenido!</a>
    </li>
  </ul>
  
  <ul class="menu">
    <li>
      <a href="#slide1">1</a>
    </li>
    <li>
      <a href="#slide2">2</a>
    </li>
     <li>
      <a href="#slide3">3</a>
    </li>
  </ul>
  
</div>

  <!--Inicio Tarjetas-->
  <div class="tarjetasIndex">
    <div class="card" id="tarjetaUno" style="width: 18rem;">
      <img src="assets/img/1.jpg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>

    <div class="card" id="tarjetaDos" style="width: 18rem;">
      <img src="assets/img/2.jpeg" class="card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title">Card title</h5>
        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>


  <footer class="footer">
  </footer>


  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
  <div class="tituloindex">
    <h1 class="text">Inicia sesión o regístrate para poder disfrutar de todos los beneficios de tener una cuenta con nosotros. </h1>
  </div>



  <button type="button" class="btn btn-success">Success</button>



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>


</body>

</html>