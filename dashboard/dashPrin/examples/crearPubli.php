<?php
session_start();

if (isset($_SESSION["correo"]) or isset($_SESSION["idusuario"])) {
  $id = $_SESSION["correo"];
  include_once '../../../dao/conexion.php';
  $sql_validacion = "SELECT*FROM tblusuarios WHERE correo ='$id' AND estado= '1'";
  $consulta_resta_validacion = $pdo->prepare($sql_validacion);
  $consulta_resta_validacion->execute();
  $resultado_validacion = $consulta_resta_validacion->rowCount();
  $validacion = $consulta_resta_validacion->fetch(PDO::FETCH_OBJ);
  //Validacion de roles
  if ($resultado_validacion) {
?>
    <!DOCTYPE html>
    <html>

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
      <meta name="author" content="Creative Tim">
      <title>Argon Dashboard - Free Dashboard for Bootstrap 4</title>
      <!-- Favicon -->
      <link rel="icon" href="../assets/img/brand/favicon.png" type="image/png">
      <!-- Fonts -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
      <!-- Icons -->
      <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
      <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
      <!-- Argon CSS -->
      <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
    </head>

    <body>
      <?php require_once '../assets/sidebar.php' ?>
      <?php require_once '../assets/header.php' ?>
      <!-- Header -->
      <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(../assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
          <div class="row">
            <div class="col-lg-7 col-md-10">
              <h1 class="display-2 text-white">Hello Jesse</h1>
              <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
              <a href="#!" class="btn btn-neutral">Edit profile</a>
            </div>
          </div>
        </div>
      </div>
      <!-- Page content -->
      <div class="container-fluid mt--6">
        <div class="row">
          <div class="col-xl-4 order-xl-2">
            <div class="card card-profile">
              <img src="../assets/img/theme/img-1-1000x600.jpg" alt="Image placeholder" class="card-img-top">
              <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                  <div class="card-profile-image">
                    <a href="#">
                      <img src="../assets/img/theme/team-4.jpg" class="rounded-circle">
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                <div class="d-flex justify-content-between">
                  <a href="#" class="btn btn-sm btn-info  mr-4 ">Connect</a>
                  <a href="#" class="btn btn-sm btn-default float-right">Message</a>
                </div>
              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col">
                    <div class="card-profile-stats d-flex justify-content-center">
                      <div>
                        <span class="heading">22</span>
                        <span class="description">Friends</span>
                      </div>
                      <div>
                        <span class="heading">10</span>
                        <span class="description">Photos</span>
                      </div>
                      <div>
                        <span class="heading">89</span>
                        <span class="description">Comments</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <h5 class="h3">
                    Jessica Jones<span class="font-weight-light">, 27</span>
                  </h5>
                  <div class="h5 font-weight-300">
                    <i class="ni location_pin mr-2"></i>Bucharest, Romania
                  </div>
                  <div class="h5 mt-4">
                    <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                  </div>
                  <div>
                    <i class="ni education_hat mr-2"></i>University of Computer Science
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-8 order-xl-1">
            <div class="card">
              <div class="card-header">
                <div class="row align-items-center">
                  <div class="col-8">
                    <h3 class="mb-0">Edit profile </h3>
                  </div>
                  <div class="col-4 text-right">
                    <a href="#!" class="btn btn-sm btn-primary">Settings</a>
                  </div>
                </div>
              </div>
              <!--Formulario-->
              <form action="crearPubli.php" method="POST" enctype="multipart/form-data">
                <h6 class="heading-small text-muted mb-4">Crear Publicación</h6>

                <label>Nombre producto</label>
                <input type="text" id="input-username" class="form-control" placeholder="Nombre" name="titulo" required autofocus>

                <label>Descripción producto</label>
                <input type="text" id="input-email" class="form-control" placeholder="Descripción" name="descripcion" required>

                <label>Costo</label>
                <input type="number" id="input-first-name" class="form-control" placeholder="Costo" name="costo" required>

                <label>Imagen</label>
                <input type="file" name="file" value="file" required>

                <button type="submit" name="subir">Enviar</button>
                <!-- Código para mostrar el contenido de la tabla publicación -->
                
                <!-- Tabla de mis publicaciones -->
                <center><h1>Mis publicaciones</h1></center>
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">First</th>
                      <th scope="col">Last</th>
                      <th scope="col">Handle</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">1</th>
                      <td>Mark</td>
                      <td>Otto</td>
                      <td>@mdo</td>
                    </tr>
                    <tr>
                      <th scope="row">2</th>
                      <td>Jacob</td>
                      <td>Thornton</td>
                      <td>@fat</td>
                    </tr>
                    <tr>
                      <th scope="row">3</th>
                      <td colspan="2">Larry the Bird</td>
                      <td>@twitter</td>
                    </tr>
                  </tbody>
                </table>
                <?php
                if (isset($_POST['subir'])) {

                  //Captura de imagen
                  $directorio = "imagenes/";

                  $archivo = $directorio . basename($_FILES['file']['name']);

                  $tipo_archivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

                  //Validar que es imagen
                  $checarsiimagen = getimagesize($_FILES['file']['tmp_name']);

                  //var_dump($size);

                  if ($checarsiimagen != false) {
                    $size = $_FILES['file']['size'];
                    //Validando tamano del archivo
                    if ($size > 70000000) {
                      echo "El archivo excede el limite, debe ser menor de 700kb";
                    } else {
                      if ($tipo_archivo == 'jpg' || $tipo_archivo == 'jpeg' || $tipo_archivo == 'png') {
                        //Se validó el archivo correctamente
                        if (move_uploaded_file($_FILES['file']['tmp_name'], $archivo)) {
                          include_once '../../../dao/conexion.php';
                          //var_dump($_FILES['file']);
                          $titulo = $_POST['titulo'];
                          $descripcion = $_POST['descripcion'];
                          $costo = $_POST['costo'];
                          //sentencia Sql
                          $sql_insertar = "INSERT INTO tblPublicacion (nombrePublicacion,descripcion,costo ,imagen )VALUES (?,?,?,?)";
                          //Preparar consulta
                          $consulta_insertar = $pdo->prepare($sql_insertar);
                          //Ejecutar la sentencia
                          $consulta_insertar->execute(array($titulo, $descripcion, $costo, $archivo));
                          echo "<script>alert('El registro se subió correctamente');</script>";
                          echo "<script> document.location.href='crearPubli.php';</script>";
                        } else {
                          echo "<script>alert('Ocurrió un error');</script>";
                        }
                      } else {
                        echo "<script>alert('Error: solo se admiten archivos jpg, png y jpegr');</script>";
                      }
                    }
                  } else {
                    echo "<script>alert('Error: el archivo no es una imagen');</script>";
                    echo "<script> document.location.href='crearPubli.php';</script>";
                  }
                }
                ?>
                <!-- Footer -->
                <?php require_once '../assets/footer.php' ?>
            </div>
            <!-- Argon Scripts -->
            <!-- Core -->
            <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
            <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
            <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
            <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
            <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
            <!-- Argon JS -->
            <script src="../assets/js/argon.js?v=1.2.0"></script>
    </body>

    </html>
<?php
  } else {
    echo "<script> document.location.href='404.php';</script>";
  }
} else {
  echo "<script> document.location.href='404.php';</script>";
}
?>