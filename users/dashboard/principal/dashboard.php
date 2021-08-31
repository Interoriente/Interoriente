<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
$documento = $_SESSION["documentoIdentidad"];
require "../../../php/users/usuarios.php";
$usuario = new Usuario($documento);
$respUserData = $usuario->getUserData($usuario->id);
$respGetRoles = $usuario->getRoles($usuario->id);
/* Probando git  */
if (isset($respUserData)) {

  //Validacion de roles
  if ($respUserData->idUsuarioRol == 1 or $resultado->idUsuarioRol == 3) {
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
                    <!-- Lista desplegable de cambio de roles -->
                    <?php
                    foreach ($respGetRoles as $datosRol) : ?>
                      <option value="<?php echo $datosRol['idUsuarioRol']; ?>"><?php echo $datosRol['nombreRol']; ?></option>
                    <?php endforeach;?>
                  </select>
                  <button type="submit" class="btn btn-sm btn-neutral">Cambiar rol</button>
                </form>
                <!-- FIN Lista desplegable de cambio de roles -->

                <!-- Copia de seguridad DB -->
                <?php if ($_SESSION['roles'] == '3') : ?><br>
                  <a href="../../../php/app/backupDB.php"><button type="submit" class="btn btn-sm btn-neutral">Copia de seguridad BD</button></a>
                  <?php endif; ?>
                  <!-- FIN Copia de seguridad DB -->
                  
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
                        <span class="h2 font-weight-bold mb-0">23</span>
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
                        <span class="h2 font-weight-bold mb-0">5</span>
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
                          <!-- Opciones Lista desplegable -->
                          <?php if ($_SESSION['roles'] == '1') { ?>
                            Comprador/Proveedor
                          <?php } else { ?>
                            Administrador
                          <?php } ?></span>
                          <!-- FIN lista desplegable -->
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
                        <span class="h2 font-weight-bold mb-0">450</span>
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
    echo "<script> document.location.href='../../';</script>";
  }
} else {
  echo "<script>alert('Has perdido acceso a este rol');</script>";
  echo "<script> document.location.href='403.php';</script>";
}

?>