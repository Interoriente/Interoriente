<?php
session_start();

if (isset($_SESSION["emailUsuario"]) or isset($_SESSION["documentoIdentidad"])) {
  $id = $_SESSION["emailUsuario"];
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
      <title>Crear publicación - Interoriente</title>
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
      <?php require_once '../assets/sidebar.php' ?>
      <?php require_once '../assets/header.php';

      //Sirve para mostrar el contenido de la tabla Estado, para mostrarlo en la lista desplegable
      include_once '../../../dao/conexion.php';
      //Mostrar los datos almacenados
      $sql_mostrar_estado = "SELECT * FROM tblEstado";
      //Prepara sentencia
      $Consultar_mostrar_estado = $pdo->prepare($sql_mostrar_estado);
      //Ejecutar consulta
      $Consultar_mostrar_estado->execute();
      $resultado_estado = $Consultar_mostrar_estado->fetchAll();
      //Imprimir var dump -> Arreglos u objetos

      //Sirve para mostrar el contenido de la tabla Categoria, para mostrarlo en la lista desplegable
      include_once '../../../dao/conexion.php';
      //Mostrar los datos almacenados
      $sql_mostrar_categoria = "SELECT * FROM tblCategoria";
      //Prepara sentencia
      $Consultar_mostrar_categoria = $pdo->prepare($sql_mostrar_categoria);
      //Ejecutar consulta
      $Consultar_mostrar_categoria->execute();
      $resultado_categoria = $Consultar_mostrar_categoria->fetchAll();

      $id = $_SESSION["documentoIdentidad"];
      include_once '../../../dao/conexion.php';
      $sql_inicio = "SELECT*FROM tblUsuario WHERE documentoIdentidad ='$id' ";
      $consulta_resta = $pdo->prepare($sql_inicio);
      $consulta_resta->execute();
      $resultado = $consulta_resta->rowCount(array($id));
      $resultado2 = $consulta_resta->fetch(PDO::FETCH_OBJ);
      //Validacion de roles
      if ($resultado) {
      ?>
        <br><br><br><br>
        <!-- Page content -->
        <div class="container-fluid mt--6">
          <div class="row">
            <div class="col-xl-8 order-xl-1">
              <div class="card">
                <div class="card-header">
                  <div class="row align-items-center">
                    <div class="col-8">
                      <h3 class="mb-0">Crear Publicación</h3>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <form action="crearPubli.php" method="POST" enctype="multipart/form-data">
                    <h6 class="heading-small text-muted mb-4">Información del producto</h6>
                    <div class="pl-lg-4">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">Nombre producto</label>
                            <input type="text" id="input-username" name="nombre" class="form-control" placeholder="Nombre producto" value="">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">Descripcion</label>
                            <input type="text" id="input-username" name="descripcion" class="form-control" placeholder="Descripcion" value="">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">Color</label>
                            <input type="color" id="input-username" name="color" class="form-control" placeholder="Color" value="">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">Costo</label>
                            <input type="text" id="input-username" name="costo" class="form-control" placeholder="Costo" value="">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-email">Estado</label>
                            <select name="estado" class="form-control" required>
                              <option value="" disabled selected>Seleccione un estado del producto</option>
                              <?php
                              foreach ($resultado_estado as $datos_estado) { ?>
                                <option value="<?php echo $datos_estado['idEstado']; ?>"><?php echo $datos_estado['nombreEstado']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>

                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">Stock Producto</label>
                            <input type="number" id="input-username" name="stock" class="form-control" placeholder="Stock (cantidad)" value="">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-email">Categoria</label>
                            <select name="categoria" class="form-control" required>
                              <option value="" disabled selected>Seleccione una categoria del producto</option>
                              <?php
                              foreach ($resultado_categoria as $datos_categoria) { ?>
                                <option value="<?php echo $datos_categoria['idCategoria']; ?>"><?php echo $datos_categoria['nombreCategoria']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label class="form-control-label" for="input-username">Imagen</label>
                            <input type="file" id="input-username" name="costo" class="form-control" placeholder="Imagen" value="">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <input type="hidden" id="input-username" name="usuario" class="form-control" placeholder="Usuario" value="<?php echo $id; ?>">
                          </div>
                        </div>
                      </div>
                      <button class="btn btn-primary btn-xs" type="submit" name="subir">Publicar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          <?php }
        if (isset($_POST['subir'])) {
          include_once '../../../dao/conexion.php';
          $nombre = $_POST['nombre'];
          $descripcion = $_POST['descripcion'];
          $color = $_POST['color'];
          $costo = $_POST['costo'];
          $estado = $_POST['estado'];
          $stock = $_POST['stock'];
          $categoria = $_POST['categoria'];
          $usuario = $_POST['usuario'];
          //sentencia Sql
          $sql_insertar = "INSERT INTO tblPublicacion (nombrePublicacion,usuario,descripcionPublicacion,colorPublicacion,costoPublicacion,estadoPublicacion,stockProducto ,categoria )VALUES (?,?,?,?,?,?,?,?)";
          //Preparar consulta
          $consulta_insertar = $pdo->prepare($sql_insertar);
          //Ejecutar la sentencia
          $consulta_insertar->execute(array($nombre, $usuario, $descripcion, $color, $costo, $estado, $stock, $categoria));
          echo "<script>alert('El registro se subió correctamente');</script>";
          echo "<script> document.location.href='crearPubli.php';</script>";
        }
          ?>
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