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
  $sqlSesionRol = "SELECT * FROM tblUsuarioRol WHERE docIdentidad=? AND idRol=?";
  $consultaSesionRol = $pdo->prepare($sqlSesionRol);
  $consultaSesionRol->execute(array($documento, $sesionRol));
  $resultadoSesionRol = $consultaSesionRol->rowCount();
  //Validacion de roles
  if ($resultado_validacion) {
    if ($resultadoSesionRol) {
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
        <?php if ($_SESSION['roles'] == '1') {
          require_once '../assets/sidebarCom.php';
        } else if ($_SESSION['roles'] == '2') {
          require_once '../assets/sidebarEmpre.php';
        } else {
          require_once '../assets/sidebarAdmin.php';
        };
        require_once '../assets/header.php';
        include_once '../../../dao/conexion.php';
        //Llamar a la conexion base de datos -> Muestro el contenido de tabla usuario
        //Mostrar los datos almacenados
        $sql_mostrar_usu = "SELECT * FROM tblUsuario";
        //Prepara sentencia
        $consultar_mostrar_usu = $pdo->prepare($sql_mostrar_usu);
        //Ejecutar consulta
        $consultar_mostrar_usu->execute();
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
                <!-- Tabla usuarios -->
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th scope="col" class="sort" data-sort="name">Nombres</th>
                        <th scope="col" class="sort" data-sort="budget">Apellidos</th>
                        <th scope="col" class="sort" data-sort="status">Celular</th>
                        <th scope="col" class="sort" data-sort="status">Correo</th>
                        <th scope="col" class="sort" data-sort="status">Estado</th>
                        <th scope="col" class="sort" data-sort="status">Acciones</th>
                      </tr>
                    </thead>
                    <tbody class="list">
                      <?php
                      foreach ($resultado_mostrar_usu as $datos) {
                      ?>
                        <tr>
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
          <!-- Footer -->
          <?php require_once '../assets/footer.php' ?>
      </body>

      </html>
<?php
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