<?php
session_start();

if (isset($_SESSION["documentoIdentidad"])) {
  $documento = $_SESSION["documentoIdentidad"];
  $sesionRol = $_SESSION['roles'];
  include_once '../../../dao/conexion.php';
  $sql_validacion = "SELECT*FROM tblUsuario WHERE documentoIdentidad =? AND estadoUsuario= '1'";
  $consulta_resta_validacion = $pdo->prepare($sql_validacion);
  $consulta_resta_validacion->execute(array($documento));
  $resultado_validacion = $consulta_resta_validacion->rowCount();
  $validacion = $consulta_resta_validacion->fetch(PDO::FETCH_OBJ);
  //Llamado tabla intermedia
  $sqlSesionRol = "SELECT * FROM tblUsuarioRol WHERE docIdentidadUsuarioRol=? AND idUsuarioRol=?";
  $consultaSesionRol = $pdo->prepare($sqlSesionRol);
  $consultaSesionRol->execute(array($documento, $sesionRol));
  $resultadoSesionRol = $consultaSesionRol->rowCount();
  //Llamado tabla publicación
  $sqlSesionPubli = "SELECT * FROM tblPublicacion WHERE docIdentidadPublicacion=?";
  $consultaSesionPubli = $pdo->prepare($sqlSesionPubli);
  $consultaSesionPubli->execute(array($documento));
  $resultadoSesionPubli = $consultaSesionPubli->rowCount();
  //Validacion de roles
  if ($resultado_validacion) {
    if ($resultadoSesionRol) {
      if ($sesionRol == '1' or $sesionRol == '2' or $sesionRol == '3') {
?>
        <!DOCTYPE html>
        <html>

        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="description" content="Bienvenidos a Interoriente, podrás comprar, vender y mucho más.">
          <meta name="author" content="Inter-oriente">
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
          <?php
          require_once '../assets/sidebarDashboard.php';
          require_once '../assets/header.php';

          //Sirve para mostrar el contenido de la tabla Ciudad, para mostrarlo en la lista desplegable
          include_once '../../../dao/conexion.php';
          //Mostrar los datos almacenados
          $sql_mostrar_ciudad = "SELECT * FROM tblCiudad";
          //Prepara sentencia
          $consultar_mostrar_ciudad = $pdo->prepare($sql_mostrar_ciudad);
          //Ejecutar consulta
          $consultar_mostrar_ciudad->execute();
          $resultado_ciudad = $consultar_mostrar_ciudad->fetchAll();
          //Mostrar la información del usuario logueado
          $sql_inicio = "SELECT*FROM tblUsuario WHERE documentoIdentidad =? ";
          $consulta_resta = $pdo->prepare($sql_inicio);
          $consulta_resta->execute(array($documento));
          $resultado = $consulta_resta->rowCount();
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
                    <p class="text-white mt-0 mb-5">Esta es tu página de perfil. Podrás visualizar tu información y actualizarla en cualquier momento.</p>
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
                            <img src="crud/<?php echo $objetoLlamado->imagenUsuario; ?>" class="rounded-circle">
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
                              <span class="heading"><?php echo $resultadoSesionPubli; ?></span>
                              <span class="description">Publicaciones</span>
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
                          <i class="ni location_pin mr-2"></i>Oriente de Antioquia
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
                        <img class=" card-img-top" src="crud/<?php echo $objetoLlamado->imagenUsuario; ?>">
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
                      <form action="crud/actualizarCuenta.php" method="POST" enctype="multipart/form-data">
                        <h6 class="heading-small text-muted mb-4">Información de usuario</h6>
                        <div class="pl-lg-4">
                          <div class="row">
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="form-control-label" for="docu">Documento</label>
                                <input type="text" id="docu" name="nombre" class="form-control" placeholder="Username" value="<?php echo $resultado2->documentoIdentidad; ?>" disabled required>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="form-control-label" for="input-username">Nombre</label>
                                <input type="text" id="input-username" name="nombre" class="form-control" placeholder="Nombre" value="<?php echo $resultado2->nombresUsuario; ?>" required disabled>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="form-control-label" for="input-username">Apellido</label>
                                <input type="text" id="input-username" name="apellido" class="form-control" placeholder="Apellido" value="<?php echo $resultado2->apellidoUsuario; ?>" required disabled>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="form-control-label" for="input-username">Celular</label>
                                <input type="text" id="input-username" name="celular" class="form-control" placeholder="Celular" max="9999999999" value="<?php echo $resultado2->telefonomovilUsuario; ?>" required>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="form-control-label" for="input-email">Correo</label>
                                <input type="email" id="input-email" name="correo" class="form-control" value="<?php echo $resultado2->emailUsuario; ?>" required>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="form-control-label" for="input-image">Foto de Perfil</label>
                                <input type="file" id="input-image" name="file" class="form-control-file">
                              </div>
                              Si no quieres cambiar la foto de perfil, puedes dejar este campo en blanco
                            </div>
                            <div class="form-group">
                              <input type="hidden" name="ideditar" value="<?php echo $resultado2->documentoIdentidad; ?>" required>
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
            </div>
            <!-- Footer -->
            <?php require_once '../assets/footer.php' ?>

        </body>

        </html>
<?php
      } else {
        echo "<script>alert('No puedes acceder a esta página con el rol que tienes');</script>";
        echo "<script> document.location.href='dashboard.php';</script>";
      }
    } else {
      echo "<script>alert('Has perdido acceso a este rol');</script>";
      echo "<script> document.location.href='403.php';</script>";
    }
  } else {
    echo "<script> document.location.href='403.php';</script>";
  }
} else {
  echo "<script> document.location.href='403.php';</script>";
}
?>