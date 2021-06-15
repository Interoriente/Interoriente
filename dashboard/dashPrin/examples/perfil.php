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
      <title>Mi perfil | Interoriente</title>
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
      //Sirve para mostrar el contenido de la tabla Ciudad, para mostrarlo en la lista desplegable
      include_once '../../../dao/conexion.php';
      //Mostrar los datos almacenados
      $sql_mostrar_ciudad = "SELECT * FROM tblCiudad";
      //Prepara sentencia
      $Consultar_mostrar_ciudad = $pdo->prepare($sql_mostrar_ciudad);
      //Ejecutar consulta
      $Consultar_mostrar_ciudad->execute();
      $resultado_ciudad = $Consultar_mostrar_ciudad->fetchAll();

      $id = $_SESSION["emailUsuario"];
      include_once '../../../dao/conexion.php';
      $sql_inicio = "SELECT*FROM tblUsuario WHERE emailUsuario ='$id' ";
      $consulta_resta = $pdo->prepare($sql_inicio);
      $consulta_resta->execute();
      $resultado = $consulta_resta->rowCount(array($id));
      $resultado2 = $consulta_resta->fetch(PDO::FETCH_OBJ);
      //Validacion de roles
      if ($resultado) {
        $Nombre = $resultado2->nombresUsuario . " " . $resultado2->apellidoUsuario;
      ?>
        <!-- Header -->
        <div class="header pb-6 d-flex align-items-center" style="min-height: 500px; background-image: url(../../../assets/img/fondoperfil.jpg); background-size: cover; background-position: center top;">
          <!-- Mask -->
          <span class="mask bg-gradient-default opacity-8"></span>
          <!-- Header container -->
          <div class="container-fluid d-flex align-items-center">
            <div class="row">
              <div class="col-lg-7 col-md-10">
                <h1 class="display-2 text-white">Hola! <?php echo $resultado2->nombresUsuario ?></h1>
                <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
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
                      <a data-toggle="modal" data-target="#fotoperfil">
                        <img src="<?php echo $prueba->imagenUsuario; ?>" class="rounded-circle">
                      </a>
                    </div>
                  </div>
                </div>
                <div class="card-header text-center border-0 pt-8 pt-md-8 pb-5 pb-md-0">
                  <div class="d-flex justify-content-between">
                    <a href="configfotoperfil.php" class="btn btn-sm btn-info  mr-4 ">Cambiar foto</a>
                  </div>
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col">
                      <div class="card-profile-stats d-flex justify-content-center">
                        <div>
                          <span class="heading">35</span>
                          <span class="description">Amigos</span>
                        </div>
                        <div>
                          <span class="heading">0</span>
                          <span class="description">Fotos</span>
                        </div>
                        <div>
                          <span class="heading">89</span>
                          <span class="description">Comentarios</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                    <h5 class="h3">
                      <?php echo $Nombre; ?><span class="font-weight-light">, 27</span>
                    </h5>
                    <div class="h5 font-weight-300">
                      <i class="ni location_pin mr-2"></i><?php echo $resultado2->ciudadUsuario;?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Modal -->
            <div class="modal" id="fotoperfil" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-body">
                    <img class=" card-img-top" src="<?php echo $prueba->imagenUsuario; ?>">
                  </div>
                </div>
              </div>
            </div>
            <!--/Modal -->
                  <div class="col-xl-8 order-xl-1">
                    <div class="card">
                      <div class="card-header">
                        <div class="row align-items-center">
                          <div class="col-8">
                            <h3 class="mb-0">Editar perfil </h3>
                          </div>
                        </div>
                      </div>
                      <div class="card-body">
                        <form action="crud/actualizarCuenta.php" method="GET">
                          <h6 class="heading-small text-muted mb-4">Información de usuario</h6>
                          <div class="pl-lg-4">
                            <div class="row">
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label class="form-control-label" for="input-username">Nombre</label>
                                  <input type="text" id="input-username" name="nombre" class="form-control" placeholder="Username" value="<?php echo $resultado2->nombresUsuario; ?>">
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label class="form-control-label" for="input-username">Apellido</label>
                                  <input type="text" id="input-username" name="apellido" class="form-control" placeholder="Username" value="<?php echo $resultado2->apellidoUsuario; ?>">
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label class="form-control-label" for="input-username">Celular</label>
                                  <input type="text" id="input-username" name="celular" class="form-control" placeholder="Celular" value="<?php echo $resultado2->telefonomovilUsuario; ?>">
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label class="form-control-label" for="input-username">Ciudad</label>
                                  <select name="ciudad" class="form-control" required>
                                    <option value="" disabled selected><?php echo $resultado2->ciudadUsuario; ?></option>
                                    <?php
                                    foreach ($resultado_ciudad as $datos_ciudad) { ?>
                                      <option value="<?php echo $datos_ciudad['codigoCiudad'] ?>"><?php echo $datos_ciudad['nombreCiudad'] ?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                              </div>
                              <p>Ten en cuenta que si modificas el correo deberás iniciar sesión nuevamente</p>
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label class="form-control-label" for="input-email">Correo</label>
                                  <input type="email" id="input-email" name="correo" class="form-control" value="<?php echo $resultado2->emailUsuario; ?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <input type="hidden" name="ideditar" value="<?php echo $resultado2->documentoIdentidad; ?>">
                              </div>
                            </div>
                            <button class="btn btn-primary btn-xs" type="submit" name="subir">Editar</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                </div>
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
    echo "<script> document.location.href='403.php';</script>";
  }
} else {
  echo "<script> document.location.href='403.php';</script>";
}
?>