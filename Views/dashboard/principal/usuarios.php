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
?>
    <!DOCTYPE html>
    <html>

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Bienvenidos a Interoriente, podrás comprar, vender y mucho más.">
      <meta name="author" content="Inter-oriente">
      <title>Usuarios | Interoriente</title>
      <!-- Favicon -->
      <link rel="icon" href="../../assets/img/favicon.png" type="image/png">
      <!-- Fonts -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
      <!-- Icons -->
      <link rel="stylesheet" href="../assets/css/iconos.css" type="text/css">
      <link rel="stylesheet" href="../assets/css/iconosComplementos.css" type="text/css">
      <!-- Argon CSS -->
      <link rel="stylesheet" href="../assets/css/argon.min.css?v=1.2.0" type="text/css">
      <!-- Llamado a hoja de estilos para traer los iconos de asc y desc en las tablas -->
      <link rel="stylesheet" href="../assets/css/dataTables.bootstrap5.min.css">
    </head>

    <body>
      <?php
      require_once '../assets/sidebarDashboard.php';
      require_once '../assets/header.php';
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
                              <button class="btn btn-danger">Desactivar Usuarios</button>
                            </form>
                          </th>
                      </tr>
                    <?php
                        } else { ?>
                      <th>Inactivo</th>
                      <th>
                        <form action="../../../Controller/php/users/usuarios.php" method="POST">
                          <input type="hidden" name="activarUsuarios">
                          <input type="hidden" name="id" value="<?php echo $datos['documentoIdentidad']; ?>">
                          <button class="btn btn-info">Activar Usuarios</button>
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
      <?php require_once '../assets/footer.php';
      ?>
    </body>

    </html>
<?php
  } else {
    echo "<script>alert('No puedes acceder a esta página!');</script>";
    echo "<script> document.location.href='404.php';</script>";
  }
} else {
  echo "<script>alert('No has iniciado sesión!');</script>";
  echo "<script> document.location.href='403.php';</script>";
}

?>