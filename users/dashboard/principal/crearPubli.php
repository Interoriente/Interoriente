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
  $sqlSesionRol = "SELECT * FROM tblUsuarioRol WHERE documentoIdentidad=? AND idRol=?";
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
        <?php if ($_SESSION['roles'] == '1') {
          require_once '../assets/sidebarC.php';
        } else if ($_SESSION['roles'] == '2') {
          require_once '../assets/sidebarV.php';
        } else {
          require_once '../assets/sidebar.php';
        } ?>
        <?php require_once '../assets/header.php';


        include_once '../../../dao/conexion.php';
        //Llamar a la conexion base de datos -> Muestro el contenido de tabla publicación, pero muestro mis publicaciones
        $id = $_SESSION["documentoIdentidad"];
        //Mostrar los datos almacenados
        $sql_mostrar_publi = "SELECT * FROM tblPublicacion WHERE usuario ='$id'";
        //Prepara sentencia
        $consultar_mostrar_publi = $pdo->prepare($sql_mostrar_publi);
        //Ejecutar consulta
        $consultar_mostrar_publi->execute();
        $contadorPubli = $consultar_mostrar_publi->rowCount();
        $resultado_mostrar_publi = $consultar_mostrar_publi->fetchAll();

        //Sirve para mostrar el contenido de la tabla Estado, para mostrarlo en la lista desplegable
        //Mostrar los datos almacenados
        $sql_mostrar_estado = "SELECT * FROM tblEstadoArticulo";
        //Prepara sentencia
        $consultar_mostrar_estado = $pdo->prepare($sql_mostrar_estado);
        //Ejecutar consulta
        $consultar_mostrar_estado->execute();
        $resultado_estado = $consultar_mostrar_estado->fetchAll();
        //Imprimir var dump -> Arreglos u objetos

        //Sirve para mostrar el contenido de la tabla Categoria, para mostrarlo en la lista desplegable

        //Mostrar los datos almacenados
        $sql_mostrar_categoria = "SELECT * FROM tblCategoria";
        //Prepara sentencia
        $consultar_mostrar_categoria = $pdo->prepare($sql_mostrar_categoria);
        //Ejecutar consulta
        $consultar_mostrar_categoria->execute();
        $resultado_categoria = $consultar_mostrar_categoria->fetchAll();
        if ($_GET) {
          include_once '../../../dao/conexion.php';
          //Cargar los datos del id seleccionado
          $idpubli = $_GET["id"];
          //Mostrar los datos almacenados
          $sql_mostrar_publi1 = "SELECT * FROM tblPublicacion WHERE idPublicacion ='$idpubli'";
          //Prepara sentencia
          $consultar_mostrar_publi1 = $pdo->prepare($sql_mostrar_publi1);
          //Ejecutar consulta
          $consultar_mostrar_publi1->execute(array($idpubli));
          $resultado_mostrar_publi1 = $consultar_mostrar_publi1->fetch();
        }
        ?>
        <br><br><br><br>
        <!-- Publicacion producto -->
        <div class="container-fluid mt--6">
          <?php if (!$_GET) { ?>
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
                    <form action="crud/crearPublicacion.php" method="POST" enctype="multipart/form-data">
                      <h6 class="heading-small text-muted mb-4">Información del producto</h6>
                      <div class="pl-lg-4">
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-username">Nombre producto</label>
                              <input type="text" id="input-username" name="nombre" class="form-control" placeholder="Nombre producto" value="" required>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-username">Descripcion</label>
                              <input type="text" id="input-username" name="descripcion" class="form-control" placeholder="Descripcion" maxlength="5000" value="" required>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-username">Color</label>
                              <input type="color" id="input-username" name="color" class="form-control" placeholder="Color" value="" required>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-username">Costo</label>
                              <input type="number" id="input-username" name="costo" class="form-control" placeholder="Costo" max="999999999" value="" required>
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-email">Estado</label>
                              <select name="estado" class="form-control" required>
                                <option value="" disabled selected>Seleccione un estado del producto</option>
                                <?php
                                foreach ($resultado_estado as $datos_estado) { ?>
                                  <option value="<?php echo $datos_estado['idEstadoArticulo']; ?>"><?php echo $datos_estado['nombreEstado']; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                          </div>

                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-username">Stock Producto</label>
                              <input type="number" id="input-username" name="stock" class="form-control" placeholder="Stock (cantidad)" max="99999" value="">
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
                              <input type="file" id="input-username" name="file" class="form-control" placeholder="Imagen" value="">
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
            </div>
          <?php }
          if ($_GET) { ?>
            <!-- Edición Publicacion producto -->
            <div class="row">
              <div class="col-xl-8 order-xl-1">
                <div class="card">
                  <div class="card-header">
                    <div class="row align-items-center">
                      <div class="col-8">
                        <h3 class="mb-0">Editar Publicación</h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <form action="crud/actualizarPubli.php" method="GET">
                      <h6 class="heading-small text-muted mb-4">Información del producto</h6>
                      <div class="pl-lg-4">
                        <div class="row">
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-username">Nombre producto</label>
                              <input type="text" id="input-username" name="nombre" class="form-control" placeholder="Nombre producto" value="<?php echo $resultado_mostrar_publi1['nombrePublicacion']; ?>">
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-username">Descripcion</label>
                              <input type="text" id="input-username" name="descripcion" class="form-control" placeholder="Descripcion" value="<?php echo $resultado_mostrar_publi1['descripcionPublicacion']; ?>">
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-username">Costo</label>
                              <input type="number" id="input-username" name="costo" class="form-control" placeholder="Costo" max="9999999999" value="<?php echo $resultado_mostrar_publi1['costoPublicacion']; ?>">
                            </div>
                          </div>

                          <div class="col-lg-6">
                            <div class="form-group">
                              <label class="form-control-label" for="input-username">Stock Producto</label>
                              <input type="number" id="input-username" name="stock" class="form-control" placeholder="Stock (cantidad)" max="99999" value="<?php echo $resultado_mostrar_publi1['stockProducto']; ?>">
                            </div>
                          </div>
                          <div class="col-lg-6">
                            <div class="form-group">
                              <input type="hidden" id="input-username" name="ideditar" class="form-control" placeholder="Usuario" value="<?php echo $resultado_mostrar_publi1['idPublicacion']; ?>">
                            </div>
                          </div>
                        </div>
                        <button class="btn btn-primary btn-xs" type="submit" name="subir">Editar</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          <?php }
          if (!$_GET) { ?>
            <center>
              <h1>Mis publicaciones</h1>
            </center>

            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Nombre</th>
                  <th scope="col">Descripcion</th>
                  <th scope="col">Costo</th>
                  <th scope="col">Stock</th>
                  <th scope="col">Editar</th>
                  <th scope="col">Eliminar</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($contadorPubli == '0') { ?>
                  <th></th>
                  <td>Opps, por ahora no tenes publicaciones</td>
                <?php }
                foreach ($resultado_mostrar_publi as $datos_publi) {
                ?>
                  <tr>
                    <th><?php echo $datos_publi['nombrePublicacion'] ?></th>
                    <td><?php echo $datos_publi['descripcionPublicacion'] ?></td>
                    <td><?php echo $datos_publi['costoPublicacion'] ?></td>
                    <td><?php echo $datos_publi['stockProducto'] ?></td>
                    <td><a href="crearPubli.php?id=<?php echo $datos_publi['idPublicacion']; ?>"><i class="icono2 fas fa-pencil-alt"></i></a></td>
                    <td><a href="#" data-toggle="modal" data-target="#eliminarPubliModal"><i class="icono1 fas fa-trash"></i></a></td>
                  </tr>
              <?php }
              } ?>
              </tbody>
            </table>
            <!-- Logout Modal-->
            <div class="modal fade" id="eliminarPubliModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <a class="btn btn-primary" href="crud/eliminarPubli.php?id=<?php echo $datos_publi['idPublicacion']; ?>">Eliminar</a>
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