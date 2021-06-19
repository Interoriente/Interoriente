<?php
session_start();

if (isset($_SESSION["emailUsuario"]) or isset($_SESSION["documentoIdentidad"])) {
  $id = $_SESSION["emailUsuario"];
  $iddocumento = $_SESSION["documentoIdentidad"];
  include_once '../../../dao/conexion.php';
  $sql_validacion = "SELECT*FROM tblUsuario WHERE emailUsuario ='$id' AND estadoUsuario= '1'";
  $consulta_resta_validacion = $pdo->prepare($sql_validacion);
  $consulta_resta_validacion->execute();
  $resultado_validacion = $consulta_resta_validacion->rowCount();
  $validacion = $consulta_resta_validacion->fetch(PDO::FETCH_OBJ);
  //Validacion de roles
  if ($resultado_validacion) {
?>
    <!DOCTYPE html>
    <html>

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
      <meta name="author" content="Creative Tim">
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
      <?php require_once '../assets/sidebar.php';
      require_once '../assets/header.php';
      include_once '../../../dao/conexion.php';
      //Llamar a la conexion base de datos -> Muestro el contenido de tabla usuario
      //Mostrar los datos almacenados
      $sql_mostrar_publi = "SELECT * FROM tblPublicacion"; //Prepara sentencia
      $consultar_mostrar_publi = $pdo->prepare($sql_mostrar_publi);
      //Ejecutar consulta
      $consultar_mostrar_publi->execute();
      /* $resultado_mostrar_publi = $consultar_mostrar_publi->fetchAll(); */
      //Mostrando estado del producto
      $sqlmostrarEstado = "SELECT nombreEstado FROM tblPublicacion INNER JOIN tblestadoarticulo ON tblPublicacion.estadoArticulo = tblestadoarticulo.idEstadoArticulo WHERE idPublicacion";
      $consultaMostrarEstado = $pdo->prepare($sqlmostrarEstado);
      $consultaMostrarEstado->execute();
      /* $resultadoEstado  = $consultaMostrarEstado->fetchAll(); */
      ?>
      <!-- Header -->
      <div class="header bg-primary pb-6">
        <div class="container-fluid">
          <div class="header-body">
            <div class="row align-items-center py-4">
              <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">Tabla de publicaciones</h6>

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
                      <th scope="col" class="sort" data-sort="status">Acciones</th>
                    </tr>
                  </thead>
                  <tbody class="list">
                    <?php
                    //Pruebas para imprimir el contenido de las dos tablas de la BD en una. Pero no sirve.
                    /* foreach ($resultado_mostrar_publi as $datos) {
                      foreach ($resultadoEstado as $datos1) {  */
                    //Sirve para especificar que solo se imprima si se cumple la condición, y lo necesito por el motivo de que estoy llamando a tblPublicacion y a tblEstado, entonces necesito imprimir a los dos en una misma tabla.
                    while ($resultado_mostrar_publi = $consultar_mostrar_publi->fetch(PDO::FETCH_OBJ) AND $resultadoEstado  = $consultaMostrarEstado->fetch(PDO::FETCH_OBJ)) {
                    ?>
                      <tr>
                        <th><?php echo $resultado_mostrar_publi->nombrePublicacion; ?></th>
                        <th><?php echo $resultado_mostrar_publi->descripcionPublicacion; ?></th>
                        <th><?php echo $resultado_mostrar_publi->costoPublicacion; ?></th>
                        <th><?php echo $resultado_mostrar_publi->stockProducto; ?></th>
                        <th><?php echo $resultadoEstado->nombreEstado; ?></th>
                      </tr>
                    <?php
                      /*   }
                    } */ }
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
      </div>
      <!-- Argon Scripts -->
      <!-- Core -->
      <script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
      <script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <script src="../assets/vendor/js-cookie/js.cookie.js"></script>
      <script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
      <script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
      <!-- Argon JS -->
      <script src="../assets/js/argon.js?v=1.2.0"></script>
    </body>

    </html>
<?php
  } else {
    echo "<script> document.location.href='403.php';</script>";
  }
} else {
  echo "<script> document.location.href='403.php';</script>";
}
?>