<?php
// Iniciar variables de sesion, obtener DocId y Rol ACTUAL del usuario
session_start();
if (!isset($_SESSION['documentoIdentidad'])) {
  echo "<script>alert('No has iniciado sesión');</script>";
  echo "<script> document.location.href='403.php';</script>";
} else {
  $documento = $_SESSION["documentoIdentidad"];
  $rol = $_SESSION['roles'];
  // Pedir clases Usuarios y Publicaciones (Iniciarlas en variables PHP)
  require "../../../Controllers/php/users/usuarios.php";
  require "../../../Controllers/php/users/publicaciones.php";
  $usuario = new Usuario($documento);
  $respUserData = $usuario->getUserData($usuario->id);

  $publicaciones = new Publicaciones($documento);
  $respTodasPublicaciones = $publicaciones->MostrarTodasPublicaciones();
  $contadorPublicaciones = count($respTodasPublicaciones);

  if (isset($respUserData)) {
    if ($rol == 3) {
      //Parte superior del HTML
      require "../includes/header.php";

      require_once '../includes/sidebarDashboard.php';
      require_once '../includes/navegacion.php';
?>
      <!-- Header -->
      <div class="header bg-primary pb-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
              <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Tabla de publicaciones sin validar</h6><br>
                <h6 class="h2 text-white d-inline-block mb-0">Total: <?php echo $contadorPublicaciones; ?></h6>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Page content -->
      <div class="container-fluid mt--6">
        <div class="row">
          <div class="col">
            <div class="card">
              <!-- Card header -->
              <div class="card-header border-0">
                <h3 class="mb-0"> </h3>
              </div>
              <!-- Light table -->
              <div class="table-responsive">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <!-- <th scope="col">Imagen</th> -->
                      <th scope="col">Nombre</th>
                      <th scope="col">Costo</th>
                      <th scope="col">Cantidad</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody class="list">
                    <?php
                    foreach ($respTodasPublicaciones as $datosPubli) { ?>
                      <tr>
                        <!-- Comentado de forma temporal -->
                        <!-- <th><img src="<?php //echo $datosPubli['urlImagen'];  
                                            ?>" alt=".." width="130px"></th> -->
                        <th><?php echo $datosPubli['nombrePublicacion']; ?></th>
                        <th><?php echo $datosPubli['costoPublicacion']; ?></th>
                        <th><?php echo $datosPubli['cantidadPublicacion']; ?></th>
                        <th>
                          <form action="../../../Controllers/php/users/publicaciones.php" method="POST">
                            <input type="hidden" name="activarPublicacion">
                            <button type="submit" class="btn btn-info">Activar</button>
                            <input type="hidden" name="id" value="<?php echo $datosPubli['idPublicacion']; ?>">
                          </form>
                        </th>
                        <!-- Cierre else -->
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
<?php require_once '../includes/footer.php';
    } else {
      echo "<script>alert('No puedes acceder a esta página');</script>";
      echo "<script> document.location.href='dashboard.php';</script>";
    }
  }
}
?>