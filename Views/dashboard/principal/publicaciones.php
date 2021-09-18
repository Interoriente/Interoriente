<?php

/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

// Iniciar variables de sesion, obtener DocId y Rol ACTUAL del usuario
session_start();
$respUserData = null;
if (isset($_SESSION['documentoIdentidad'])) {
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
}
//Validar si existe sesión
if (isset($respUserData)) {
  if ($rol == 3) {
    //Parte superior del HTML
    require "../assets/header.php";

    require_once '../assets/sidebarDashboard.php';
    require_once '../assets/navegacion.php';
?>
    <!-- Header -->
    <div class="header bg-primary pb-6">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
              <h6 class="h2 text-white d-inline-block mb-0">Tabla de publicaciones</h6><br>
              <h6 class="h2 text-white d-inline-block mb-0">Total: <?php echo $contadorPublicaciones; ?></h6>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="#" class="btn btn-sm btn-neutral">New</a>
              <a href="#" class="btn btn-sm btn-neutral">Filters</a>
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
              <table id="tabla" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Imagen</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Costo</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody class="list">
                  <?php
                  foreach ($respTodasPublicaciones as $datosPubli) { ?>
                    <tr>
                      <th><img src="../../assets/img/publicaciones/<?php echo $datosPubli['urlImagen'];  ?>" alt=".." width="130px"></th>
                      <th><?php echo $datosPubli['nombrePublicacion']; ?></th>
                      <th><?php echo substr($datosPubli['descripcionPublicacion'], 0, 30); ?>...</th>
                      <th><?php echo $datosPubli['costoPublicacion']; ?></th>
                      <th><?php echo $datosPubli['stockPublicacion']; ?></th>
                      <?php if ($datosPubli['validacionPublicacion'] == '1') { ?>
                        <th>Validada</th>
                        <div class="btn-group">
                          <th>
                            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Acciones
                            </button>
                            <div class="dropdown-menu">
                              <form action="../../../Controllers/php/users/publicaciones.php" method="POST">
                                <input type="hidden" name="desactivarPublicacion">
                                <input type="hidden" name="id" value="<?php echo $datosPubli['idPublicacion']; ?>">
                                <button type="submit" class="btn btn-info">Desactivar</button>
                              </form>
                              <br>
                              <!-- Botón eliminar publicación -->
                              <a class="btn btn-danger" data-toggle="modal" data-target="#eliminarPubliModal<?php echo $datosPubli['idPublicacion'] ?>">Eliminar</a>
                            </div>
                          </th>
                        <?php } else { ?>
                          <th>En revisión</th>
                          <th>
                            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Acciones
                            </button>
                            <div class="dropdown-menu">
                              <form action="../../../Controller/php/view/publicaciones.php" method="POST">
                                <input type="hidden" name="activarPublicacion">

                                <input type="hidden" name="id" value="<?php echo $datosPubli['idPublicacion']; ?>">
                                <button type="submit" class="btn btn-info">Activar</button>
                              </form>
                              <br>
                              <!-- Botón eliminar publicación -->
                              <a class="btn btn-danger" data-toggle="modal" data-target="#eliminarPubliModal<?php echo $datosPubli['idPublicacion'] ?>">Eliminar</a>
                            </div>
                          </th>
                          <!-- Cierre else -->
                        <?php } ?>
                        <!--Modal Eliminar publicación -->
                        <?php require "../assets/modalesPublicacion.php"; ?>
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
      <!-- Footer -->
  <?php require_once '../assets/footer.php';
  } else {
    echo "<script>alert('No puedes acceder a esta página');</script>";
    echo "<script> document.location.href='dashboard.php';</script>";
  }
} else {
  echo "<script>alert('No has iniciado sesión');</script>";
  echo "<script> document.location.href='403.php';</script>";
}
  ?>