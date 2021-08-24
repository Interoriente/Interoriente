<?php
session_start();
if (isset($_SESSION["documentoIdentidad"])) {
  include_once 'crud/consultas.php';

  //Validacion de roles
  if ($contadorValidacion) {
    if ($resultadoSesionRol) {
      if ($sesionRol == '3') {
?>
        <!DOCTYPE html>
        <html>

        <head>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <meta name="description" content="Bienvenidos a Interoriente, podrás comprar, vender y mucho más.">
          <meta name="author" content="Inter-oriente">
          <title>Usuarios - Interoriente</title>
          <!-- Favicon -->
          <link rel="icon" href="../../../assets/img/favicon.png" type="image/png">
          <!-- Fonts -->
          <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
          <!-- Icons -->
          <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
          <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">
          <!-- Argon CSS -->
          <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">
          <!-- Llamado a hoja de estilos para traer los iconos de asc y desc en las tablas -->
          <link rel="stylesheet" href="../assets/css/dataTables.bootstrap5.min.css">
        </head>

        <body>
          <?php
          require_once '../assets/sidebarDashboard.php';
          require_once '../assets/header.php';

          include_once '../../../dao/conexion.php';
          //Llamar a la conexion base de datos -> Muestro el contenido de tabla usuario
          //Mostrar los datos almacenados
          $sql_mostrar_usu = "SELECT * FROM tblUsuario WHERE documentoIdentidad <> ?";
          //Prepara sentencia
          $consultar_mostrar_usu = $pdo->prepare($sql_mostrar_usu);
          //Ejecutar consulta
          $consultar_mostrar_usu->execute(array($documento));
          $resultado_mostrar_usu = $consultar_mostrar_usu->fetchAll();
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
                        foreach ($resultado_mostrar_usu as $datos) {
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
                              <th><a class="btn btn-info" href="crud/desactivarAdmin.php?id=<?php echo $datos['documentoIdentidad']; ?>">Desactivar</a></th>
                          </tr>
                        <?php
                            } else { ?>
                          <th>Inactivo</th>
                          <th><a class="btn btn-success" href="crud/activarAdmin.php?id=<?php echo $datos['documentoIdentidad']; ?>">Activar</a></th>
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