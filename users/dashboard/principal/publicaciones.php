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
          <title>Publicaciones - Interoriente</title>
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
          //Llamar a la conexion base de datos -> Muestro el contenido de tabla usuario
          //Mostrar los datos almacenados
          $sql_mostrar_publi = "SELECT * FROM tblPublicacion"; //Prepara sentencia
          $consultar_mostrar_publi = $pdo->prepare($sql_mostrar_publi);
          //Ejecutar consulta
          $consultar_mostrar_publi->execute();
          $resultado_mostrar_publi = $consultar_mostrar_publi->fetchAll();
          //Contador de registros totales en tabla
          $contador = $consultar_mostrar_publi->rowCount();
          ?>
          <!-- Header -->
          <div class="header bg-primary pb-6">
            <div class="container-fluid">
              <div class="header-body">
                <div class="row align-items-center py-4">
                  <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Tabla de publicaciones</h6><br>
                    <h6 class="h2 text-white d-inline-block mb-0">Total: <?php echo $contador; ?></h6>
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
                    <table class="table align-items-center table-flush">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col" class="sort" data-sort="name">Nombre</th>
                          <th scope="col" class="sort" data-sort="budget">Descripción</th>
                          <th scope="col" class="sort" data-sort="status">Costo</th>
                          <th scope="col" class="sort" data-sort="status">Stock</th>
                          <th scope="col" class="sort" data-sort="status">Estado</th>
                          <th scope="col" class="sort" data-sort="status">Actualizar</th>
                          <th scope="col" class="sort" data-sort="status">Eliminar</th>
                        </tr>
                      </thead>
                      <tbody class="list">
                        <?php
                        foreach ($resultado_mostrar_publi as $datos) { ?>
                          <tr>
                            <th><?php echo $datos['nombrePublicacion']; ?></th>
                            <th><?php echo $datos['descripcionPublicacion']; ?></th>
                            <th><?php echo $datos['costoPublicacion']; ?></th>
                            <th><?php echo $datos['stockPublicacion']; ?></th>
                            <?php if ($datos['validacionPublicacion'] == '1') { ?>
                              <th>Validada</th>
                              <th><a class="btn btn-danger" href="crud/desactivarPubli.php?id=<?php echo $datos['idPublicacion']; ?>">Desactivar</a></th>
                              <th><a class="btn btn-info" data-toggle="modal" data-target="#eliminarPubliModal<?php echo $datos['idPublicacion'] ?>">Eliminar</a></th>
                            <?php } else { ?>
                              <th>En revisión</th>
                              <th><a class="btn btn-success" href="crud/activarPubli.php?id=<?php echo $datos['idPublicacion']; ?>">Validar</a></th>
                              <th><a class="btn btn-info" data-toggle="modal" data-target="#eliminarPubliModal<?php echo $datos['idPublicacion'] ?>">Eliminar</a></th>
                              <!-- Cierre else -->
                            <?php } ?>
                            <!--Modal Eliminar publicación -->
                            <div class="modal fade" id="eliminarPubliModal<?php echo $datos['idPublicacion'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">¿Seguro quieres eliminar esta publicación?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">×</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">Seleccione "Eliminar" para eliminar la publicación, esta acción no se podrá deshacer.</div>
                                  <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                    <a class="btn btn-danger" href="crud/eliminarPubli.php?id=<?php echo $datos['idPublicacion'] ?>">Eliminar</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </tr>
                        <?php

                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                  <!-- Card footer -->
                  <div class="card-footer py-4">
                    <nav aria-label="...">
                      <ul class="pagination justify-content-end mb-0">
                        <li class="page-item disabled">
                          <a class="page-link" href="#" tabindex="-1">
                            <i class="fas fa-angle-left"></i>
                            <span class="sr-only">Previous</span>
                          </a>
                        </li>
                        <li class="page-item active">
                          <a class="page-link" href="#">1</a>
                        </li>
                        <li class="page-item">
                          <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                          <a class="page-link" href="#">
                            <i class="fas fa-angle-right"></i>
                            <span class="sr-only">Next</span>
                          </a>
                        </li>
                      </ul>
                    </nav>
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