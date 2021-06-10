<?php
session_start();

if (isset($_SESSION["emailUsuario"]) or isset($_SESSION["documentoIdentidad"])) {
  $id = $_SESSION["emailUsuario"];
  include_once '../../../dao/conexion.php';
  $sql_validacion = "SELECT*FROM tblUsuario WHERE emailUsuario ='$id' AND estadoUsuario= '1'";
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
      <title>Mi perfil - Interoriente</title>
      <!-- Favicon -->
      <link rel="icon" href="../../../assets/img/favicon.png" type="image/png">
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
      <?php
      $id = $_SESSION["emailUsuario"];
      include_once '../../../dao/conexion.php';
      $sql_inicio = "SELECT*FROM tblUsuario WHERE emailUsuario ='$id' ";
      $consulta_resta = $pdo->prepare($sql_inicio);
      $consulta_resta->execute();
      $resultado = $consulta_resta->rowCount(array($id));
      $resultado2 = $consulta_resta->fetch(PDO::FETCH_OBJ);
      //Validacion de roles
      if ($resultado) {
      ?>
        <!-- Header -->
        <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(../assets/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
          <!-- Mask -->
          <span class="mask bg-gradient-default opacity-8"></span>
          <!-- Header container -->
          <div class="container-fluid d-flex align-items-center">
            <div class="row">
              <div class="col-lg-7 col-md-10">
                <h1 class="display-2 text-white">Hola! <?php echo $resultado2->nombresUsuario; ?></h1>
                <a href="configperfil.php" class="btn btn-neutral">Editar perfil</a>
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
          <?php } ?>
          <!-- Footer -->
        </div>
          <?php require_once '../assets/footer.php' ?>
          
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
    echo "<script> document.location.href='403.php';</script>";
  }
} else {
  echo "<script> document.location.href='403.php';</script>";
}
?>