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
      if ($sesionRol == '1' or $sesionRol == '2') {
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
          <?php
          require_once '../assets/sidebarDashboard.php';
          require_once '../assets/header.php';

          include_once '../../../dao/conexion.php';
          //Llamar a la conexion base de datos -> Muestro el contenido de tabla publicación, pero muestro mis publicaciones
          //Mostrar los datos almacenados
          $sql_mostrar_publi = "SELECT * FROM tblPublicacion WHERE docIdentidadPublicacion =?";
          //Prepara sentencia
          $consultar_mostrar_publi = $pdo->prepare($sql_mostrar_publi);
          //Ejecutar consulta
          $consultar_mostrar_publi->execute(array($documento));
          $contadorPubli = $consultar_mostrar_publi->rowCount();
          $resultado_mostrar_publi = $consultar_mostrar_publi->fetchAll();

          //Sirve para mostrar el contenido de la tabla Estado, para mostrarlo en la lista desplegable
          //Mostrar los datos almacenados
          $sql_mostrar_estado = "SELECT * FROM tblEstadoArticulo ORDER BY nombreEstadoArticulo ASC";
          //Prepara sentencia
          $consultar_mostrar_estado = $pdo->prepare($sql_mostrar_estado);
          //Ejecutar consulta
          $consultar_mostrar_estado->execute();
          $resultado_estado = $consultar_mostrar_estado->fetchAll();
          //Imprimir var dump -> Arreglos u objetos

          //Sirve para mostrar el contenido de la tabla Categoria, para mostrarlo en la lista desplegable

          //Mostrar los datos almacenados
          $sql_mostrar_categoria = "SELECT * FROM tblCategoria ORDER BY nombreCategoria ASC";
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
            $sql_mostrar_publi1 = "SELECT * FROM tblPublicacion WHERE idPublicacion =?";
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
                          <h3 class="mb-0">Crear Publicación Proveedor</h3>
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
                                <label class="form-control-label" for="input-username">Descripción</label>
                                <input type="text" id="input-username" name="descripcion" class="form-control" placeholder="Descripción" maxlength="5000" value="" required>
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
                                    <option value="<?php echo $datos_estado['idEstadoArticulo']; ?>"><?php echo $datos_estado['nombreEstadoArticulo']; ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                            </div>

                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="form-control-label" for="input-username">Stock Producto</label>
                                <input type="number" id="input-username" name="stock" class="form-control" placeholder="Stock (cantidad)" max="99999" value="" required>
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
                                <label class="form-control-label" for="input-username">Imagenes</label>
                                <input type="file" id="input-username" name="imagen[]" id="file[]" class="form-control-file" multiple accept="image/x-png,image/jpeg" required>
                                <div class="description">
                                  <!-- <br>
                                  limite de 2048MB por imágenes -->
                                  <br>
                                  Tipos permitidos: jpeg, png, jpg
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <!-- <label class="form-control-label" for="usu">Usuario</label> -->
                                <input type="hidden" id="usu" name="usuario" class="form-control" placeholder="Usuario" value="<?php echo $documento; ?>">
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
            if (isset($_GET['id'])) { ?>
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
                      <form action="crud/actualizarPubli.php" method="POST">
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
                                <input type="text" id="input-username" name="descripcion" class="form-control" placeholder="Descripcion" value="<?php echo $resultado_mostrar_publi1['descripcionPublicacion']; ?>" required>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="form-control-label" for="input-username">Costo</label>
                                <input type="number" id="input-username" name="costo" class="form-control" placeholder="Costo" max="9999999999" value="<?php echo $resultado_mostrar_publi1['costoPublicacion']; ?>" required>
                              </div>
                            </div>

                            <div class="col-lg-6">
                              <div class="form-group">
                                <label class="form-control-label" for="input-username">Stock Producto</label>
                                <input type="number" id="input-username" name="stock" class="form-control" placeholder="Stock (cantidad)" max="99999" value="<?php echo $resultado_mostrar_publi1['stockPublicacion']; ?>" required>
                              </div>
                            </div>
                            <div class="col-lg-6">
                              <div class="form-group">
                                <input type="text" id="input-username" name="ideditar" class="form-control" value="<?php echo $_GET['id'] ?>" required>
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
            if (!$_GET) {
            ?>
              <center>
                <h1>Mis publicaciones</h1>
              </center>
              <div class="table-responsive">
                <input id="buscar" type="text" class="form-control" placeholder="Escriba algo para filtrar" /><br>
                <table id="tabla" class="table align-items-center table-flush">
                  <thead class="thead-light">
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
                  <tbody>
                    <tr>
                      <td colspan="8">
                        <div class="alert alert-danger" role="alert" style="text-align: center;">Opps, por ahora no hay publicaciones</div>
                      </td>
                    </tr>
                  </tbody>
                <?php }
                    foreach ($resultado_mostrar_publi as $datos_publi) {
                ?>
                  <tr>
                    <th><?php echo $datos_publi['nombrePublicacion'] ?></th>
                    <td><?php echo $datos_publi['descripcionPublicacion'] ?></td>
                    <td><?php echo $datos_publi['costoPublicacion'] ?></td>
                    <td><?php echo $datos_publi['stockPublicacion'] ?></td>
                    <td><a href="crearPubli.php?id=<?php echo $datos_publi['idPublicacion']; ?>"><i class="icono2 fas fa-pencil-alt"></i></a></td>
                    <td><a data-toggle="modal" data-target="#eliminarPubliModal<?php echo $datos_publi['idPublicacion'] ?>"><i class="icono1 fas fa-trash"></i></a></td>

                    <!--Modal Eliminar publicación -->
                    <div class="modal fade" id="eliminarPubliModal<?php echo $datos_publi['idPublicacion'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <a class="btn btn-danger" href="crud/eliminarPubli.php?id=<?php echo $datos_publi['idPublicacion'] ?>">Eliminar</a>
                          </div>
                        </div>
                      </div>
                    </div>
              </div>
              </tr>
          <?php }
                  } ?>
          </tbody>
          </table>
          <!-- Footer -->
          <?php require_once '../assets/footer.php' ?>
          </div>
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