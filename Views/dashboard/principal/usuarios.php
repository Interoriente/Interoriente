<?php
session_start();
$respUserData = null;
if (isset($_SESSION['documentoIdentidad'])) {
  $documento = $_SESSION["documentoIdentidad"];
  $rol = $_SESSION["roles"];
  require "../../../Controllers/php/users/usuarios.php";
  $usuario = new Usuario($documento);
  $respGetUsuarios = $usuario->getUsuarios($usuario->id);
  $respUserData = $usuario->getUserData($usuario->id);
}
//Validacion de roles
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
              <h6 class="h2 text-white d-inline-block mb-0">Tabla de usuarios registrados</h6>
            </div>
            <div class="col-lg-6 col-5 text-right">
              <a href="reportesBD.php" class="btn btn-sm btn-neutral">Descargar reporte</a>
              <!-- <a href="#" class="btn btn-sm btn-neutral">Filters</a> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <!-- Etiqueta de cierre en el footer -->
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
                    <th scope="col">Documento</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                  </tr>
                </thead>
                <tbody class="list">
                  <?php
                  foreach ($respGetUsuarios as $datos) {
                  ?>
                    <tr>
                      <th><?php echo $datos['documentoIdentidad']; ?></th>
                      <th><?php echo $datos['nombresUsuario']; ?></th>
                      <th><?php echo $datos['apellidoUsuario']; ?></th>
                      <th><?php echo $datos['telefonomovilUsuario']; ?></th>
                      <th><?php echo $datos['emailUsuario']; ?></th>
                      <?php /* Verificar que el estado esté activo */
                      if ($datos['estadoUsuario'] == 1) { ?>
                        <th>Activo</th>
                        <th>
                          <form action="../../../Controllers/php/users/usuarios.php" method="POST">
                            <input type="hidden" name="desactivarUsuarios">
                            <input type="hidden" name="id" value="<?php echo $datos['documentoIdentidad']; ?>">
                            <button class="btn btn-danger">Desactivar</button>
                          </form>
                        </th>
                    </tr>
                  <?php
                      } else { ?>
                    <th>Inactivo</th>
                    <th>
                      <form action="../../../Controllers/php/users/usuarios.php" method="POST">
                        <input type="hidden" name="activarUsuarios">
                        <input type="hidden" name="id" value="<?php echo $datos['documentoIdentidad']; ?>">
                        <button class="btn btn-info">Activar</button>
                      </form>
                    </th>
                <?php
                      }
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
<?php  require_once '../includes/footer.php';
  } else {
    echo "<script>alert('No puedes acceder a esta página!');</script>";
    echo "<script> document.location.href='404.php';</script>";
  }
} else {
  echo "<script>alert('No has iniciado sesión!');</script>";
  echo "<script> document.location.href='403.php';</script>";
}

?>