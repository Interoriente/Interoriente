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
      <?php require_once '../assets/header.php' ?>
      <?php
      $id = $_SESSION["documentoIdentidad"];
      include_once '../../../dao/conexion.php';
      $sql_inicio = "SELECT*FROM tblPublicacion WHERE usuario ='$id' ";
      $consulta_resta = $pdo->prepare($sql_inicio);
      $consulta_resta->execute();
      $resultado = $consulta_resta->rowCount(array($id));
      $resultado2 = $consulta_resta->fetch(PDO::FETCH_OBJ);

      ?>
      <!-- Header -->
      <br><br><br><br>
      <!--Formulario-->
      <div class="container-fluid mt--12">
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
                          <input type="color" id="input-username" name="celular" class="form-control" placeholder="Color" value="">
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
                          <label class="form-control-label" for="input-email">Correo</label>
                          <input type="email" id="input-email" name="correo" class="form-control" value="">
                        </div>
                      </div>
                      <div class="form-group">
                        <input type="hidden" name="ideditar" value="">
                      </div>
                    </div>
                    <button class="btn btn-primary btn-xs" type="submit" name="subir">Editar</button>
                  </div>
                </form>
                <!-- Código para mostrar el contenido de la tabla publicación -->

                <!-- Tabla de mis publicaciones -->

                <center>
                  <h1>Mis publicaciones</h1>
                </center>
                <?php if ($resultado) { ?>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                      </tr>
                    </tbody>
                  </table>
              </div>
            </div>
          </div>
        <?php }
                if (isset($_POST['subir'])) {

                  //Captura de imagen
                  $directorio = "imagenes/";

                  $archivo = $directorio . basename($_FILES['file']['name']);

                  $tipo_archivo = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));

                  //Validar que es imagen
                  $checarsiimagen = getimagesize($_FILES['file']['tmp_name']);

                  //var_dump($size);

                  if ($checarsiimagen != false) {
                    $size = $_FILES['file']['size'];
                    //Validando tamano del archivo
                    if ($size > 70000000) {
                      echo "El archivo excede el limite, debe ser menor de 700kb";
                    } else {
                      if ($tipo_archivo == 'jpg' || $tipo_archivo == 'jpeg' || $tipo_archivo == 'png') {
                        //Se validó el archivo correctamente
                        if (move_uploaded_file($_FILES['file']['tmp_name'], $archivo)) {
                          include_once '../../../dao/conexion.php';
                          //var_dump($_FILES['file']);
                          $titulo = $_POST['titulo'];
                          $descripcion = $_POST['descripcion'];
                          $costo = $_POST['costo'];
                          //sentencia Sql
                          $sql_insertar = "INSERT INTO tblPublicacion (nombrePublicacion,descripcion,costo ,imagen )VALUES (?,?,?,?)";
                          //Preparar consulta
                          $consulta_insertar = $pdo->prepare($sql_insertar);
                          //Ejecutar la sentencia
                          $consulta_insertar->execute(array($titulo, $descripcion, $costo, $archivo));
                          echo "<script>alert('El registro se subió correctamente');</script>";
                          echo "<script> document.location.href='crearPubli.php';</script>";
                        } else {
                          echo "<script>alert('Ocurrió un error');</script>";
                        }
                      } else {
                        echo "<script>alert('Error: solo se admiten archivos jpg, png y jpegr');</script>";
                      }
                    }
                  } else {
                    echo "<script>alert('Error: el archivo no es una imagen');</script>";
                    echo "<script> document.location.href='crearPubli.php';</script>";
                  }
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