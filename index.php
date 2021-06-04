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
  <a href="principal/tarjetas/index.html"> <button type="button" class="btn btn-primary">Tarjetas</button></a>
  <a href="principal/publicacion/index.html"> <button type="button" class="btn btn-primary">Publicación</button></a>
</div>

<a class="boton_personalizado" href="https://vinkula.com">Soy un botón</a>
 
 <!--Carrusel-->
 <div class="container mt-100">
    <div class="row">
        <div class="col-md-8 mr-auto ml-auto">
            <div class="card card-raised card-carousel">
                <div id="carouselindicators" class="carousel slide" data-ride="carousel" data-interval="3000">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselindicators" data-slide-to="0" class=""></li>
                        <li data-target="#carouselindicators" data-slide-to="1" class="active"></li>
                        <li data-target="#carouselindicators" data-slide-to="2" class=""></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active carousel-item-left"> <img class="d-block w-100" src="https://i.imgur.com/kjR96mD.jpg" alt="First slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h4> <i class="fa fa-map-marker"></i> Dharamshala,Himachal Pradesh, India </h4>
                            </div>
                        </div>
                        <div class="carousel-item carousel-item-next carousel-item-left"> <img class="d-block w-100" src="https://i.imgur.com/l3iUv92.jpg" alt="Second slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h4> <i class="fa fa-map-marker"></i> Manali,Himachal Pradesh, India </h4>
                            </div>
                        </div>
                        <div class="carousel-item"> <img class="d-block w-100" src="https://i.imgur.com/rHCSTM1.jpg" alt="Third slide">
                            <div class="carousel-caption d-none d-md-block">
                                <h4> <i class="fa fa-map-marker"></i> Kerala,Kerala, India </h4>
                            </div>
                        </div>
                    </div> <a class="carousel-control-prev" href="#carouselindicators" role="button" data-slide="prev" data-abc="true"> <i class="fa fa-chevron-left"></i> <span class="sr-only">Previous</span> </a> <a class="carousel-control-next" href="#carouselindicators" role="button" data-slide="next" data-abc="true"> <i class="fa fa-chevron-right"></i> <span class="sr-only">Next</span> </a>
                </div>
            </div>
        </div>
    </div>
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