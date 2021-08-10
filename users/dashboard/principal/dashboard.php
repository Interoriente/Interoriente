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

  //Mostrando roles almacenados
  $sqlRol = "SELECT * FROM tblUsuarioRol INNER JOIN tblRol ON tblUsuarioRol.idUsuarioRol = tblRol.idRol WHERE docIdentidadUsuarioRol=?";
  $consultaRol = $pdo->prepare($sqlRol);
  $consultaRol->execute(array($documento));
  $resultadoRol = $consultaRol->fetchAll();
  //Llamado tabla usuario
  $sqlMostrarConteo = "SELECT*FROM tblUsuario";
  $consultaMostrarConteo = $pdo->prepare($sqlMostrarConteo);
  $consultaMostrarConteo->execute();
  $resultadoMostrarConteo = $consultaMostrarConteo->rowCount();
  //Llamado tabla publicaciones
  $sqlMostrarConteoPubli = "SELECT*FROM tblPublicacion";
  $consultaMostrarConteoPubli = $pdo->prepare($sqlMostrarConteoPubli);
  $consultaMostrarConteoPubli->execute();
  $resultadoMostrarConteoPubli = $consultaMostrarConteoPubli->rowCount();
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
          <title>Dashboard | Interoriente</title>
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
          if (isset($_POST['rol'])) {
            if ($_POST['rol'] == '1') {
              $_SESSION['roles'] = 1;
            } else if ($_POST['rol'] == '2') {
              $_SESSION['roles'] = 2;
            } else {
              $_SESSION['roles'] = 3;
            }
          }
          require_once '../assets/sidebarDashboard.php';
          require_once '../assets/header.php';
          ?>
          <!-- Header -->
          <div class="header bg-primary pb-6">
            <div class="container-fluid">
              <div class="header-body">
                <div class="row align-items-center py-4">
                  <div class="col-lg-6 col-5 text-right">
                    <form action="dashboard.php" method="post">
                      <select name="rol" required>
                        <!-- onchange="location = this.value" Ayuda a redireccionar -->
                        <option value="" disabled selected>Seleccione un rol</option>
                        <?php
                        foreach ($resultadoRol as $datosRol) { ?>
                          <option value="<?php echo $datosRol['idRol']; ?>"><?php echo $datosRol['nombreRol']; ?></option>
                        <?php }
                        ?>
                      </select>
                      <button type="submit" class="btn btn-sm btn-neutral">Cambiar rol</button>

                    </form><?php if ($_SESSION['roles'] == '3') {
                            ?><br>
                      <a href="backupsbd.php"><button type="submit" class="btn btn-sm btn-neutral">Copia de seguridad BD</button></a>
                    <?php } ?>
                  </div>
                </div>
                <!-- Card stats -->
                <div class="row">
                  <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                      <!-- Card body -->
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Nuevas publicaciones</h5>
                            <span class="h2 font-weight-bold mb-0"><?php echo $resultadoMostrarConteoPubli; ?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                      <!-- Card body -->
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Nuevos usuarios</h5>
                            <span class="h2 font-weight-bold mb-0"><?php echo $resultadoMostrarConteo; ?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                      <!-- Card body -->
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Rol actual</h5>
                            <span class="h2 font-weight-bold mb-0">
                              <?php if ($_SESSION['roles'] == '1') { ?>
                                Comprador/Proveedor
                              <?php } else if ($_SESSION['roles'] == '2') { ?>
                                Admin-Empresa
                              <?php } else { ?>
                                Administrador
                              <?php } ?></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-md-6">
                    <div class="card card-stats">
                      <!-- Card body -->
                      <div class="card-body">
                        <div class="row">
                          <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">Contador de visitas</h5>
                            <span class="h2 font-weight-bold mb-0"><img style="border: 0px solid; display: inline;" alt="contador de visitas" src="http://www.websmultimedia.com/contador-de-visitas.php?id=300190"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
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