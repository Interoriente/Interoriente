<?php
session_start();
if (isset($_SESSION["emailUsuario"]) or isset($_SESSION["documentoIdentidad"])) {
  $id = $_SESSION["emailUsuario"];
  $sesionRol = $_SESSION['roles'];
  include_once '../../../dao/conexion.php';
  $sql_validacion = "SELECT*FROM tblUsuario WHERE emailUsuario ='$id' AND estadoUsuario= '1'";
  $consulta_resta_validacion = $pdo->prepare($sql_validacion);
  $consulta_resta_validacion->execute();
  $resultado_validacion = $consulta_resta_validacion->rowCount();
  $validacion = $consulta_resta_validacion->fetch(PDO::FETCH_OBJ);
  //Llamado tabla intermedia
  $documento = $_SESSION["documentoIdentidad"];
  $sqlSesionRol = "SELECT * FROM tblUsuarioRol WHERE docIdentidadUsuarioRol=? AND idUsuarioRol=?";
  $consultaSesionRol = $pdo->prepare($sqlSesionRol);
  $consultaSesionRol->execute(array($documento, $sesionRol));
  $resultadoSesionRol = $consultaSesionRol->rowCount();
  //Validacion de roles
  if ($resultado_validacion) {
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
        </head>

        <body>
          <?php
          require_once '../assets/sidebarDashboard.php';
          require_once '../assets/header.php';
          
          include_once '../../../dao/conexion.php';
          //Llamar a la conexion base de datos -> Muestro el contenido de tabla empresa
          //Mostrar los datos almacenados
          $sql_mostrar_empre = "SELECT * FROM tblEmpresa";
          //Prepara sentencia
          $consultar_mostrar_empre = $pdo->prepare($sql_mostrar_empre);
          //Ejecutar consulta
          $consultar_mostrar_empre->execute();
          $resultado_mostrar_empre = $consultar_mostrar_empre->fetchAll();
          ?>
          <!-- Header -->
          <div class="header bg-primary pb-6">
            <div class="container-fluid">
              <div class="header-body">
                <div class="row align-items-center py-4">
                  <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Tabla de empresas registradas</h6>

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
                  <!-- Tabla empresa -->
                  <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col" class="sort" data-sort="name">NIT</th>
                          <th scope="col" class="sort" data-sort="budget">Doc Representante</th>
                          <th scope="col" class="sort" data-sort="budget">Nombre</th>
                          <th scope="col" class="sort" data-sort="status">Descripción</th>
                          <th scope="col" class="sort" data-sort="status">Correo</th>
                          <th scope="col" class="sort" data-sort="status">Imagen</th>
                          <th scope="col" class="sort" data-sort="status">Dirección</th>
                          <th scope="col" class="sort" data-sort="status">Ciudad</th>
                          <th scope="col" class="sort" data-sort="status">Teléfono</th>
                          <th scope="col" class="sort" data-sort="status">Estado</th>
                          <th scope="col" class="sort" data-sort="status">Opciones</th>
                        </tr>
                      </thead>
                      <tbody class="list">
                        <?php
                        foreach ($resultado_mostrar_empre as $datosEmpre) {
                        ?>
                          <tr>
                            <th><?php echo $datosEmpre['nitEmpresa']; ?></th>
                            <th><?php echo $datosEmpre['documentoRepresentanteEmpresa']; ?></th>
                            <th><?php echo $datosEmpre['nombreEmpresa']; ?></th>
                            <th><?php echo $datosEmpre['descripcionEmpresa']; ?></th>
                            <th><?php echo $datosEmpre['correoEmpresa']; ?></th>
                            <th><?php echo $datosEmpre['imagenEmpresa']; ?></th>
                            <th><?php echo $datosEmpre['direccionEmpresa']; ?></th>
                            <th><?php echo $datosEmpre['ciudadEmpresa']; ?></th>
                            <th><?php echo $datosEmpre['telefonoEmpresa']; ?></th>
                            <?php /* Verificar que el estado esté activo */
                            if ($datosEmpre['estadoEmpresa'] == '1') { ?>
                              <th>Activo</th>
                              <th><a class="btn btn-info" href="crud/desactivarEmpresa.php?id=<?php echo $datosEmpre['nitEmpresa']; ?>">Desactivar</a></th>
                          </tr>
                        <?php
                            } else { ?>
                          <th>Inactivo</th>
                          <th><a class="btn btn-success" href="crud/activarEmpresa.php?id=<?php echo $datosEmpre['nitEmpresa']; ?>">Activar</a></th>
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