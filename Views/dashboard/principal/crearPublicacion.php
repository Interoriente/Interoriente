<?php
session_start();
$documento = $_SESSION["documentoIdentidad"];
require "../../../Controller/php/view/usuarios.php";
require "../../../Controller/php/view/publicaciones.php";
$usuario = new Usuario($documento);
$respUserData = $usuario->getUserData($usuario->id);
$publicaciones = new Publicaciones($documento);
$respMostrarPublicaciones = $publicaciones->MostrarPublicaciones($publicaciones->id); 
$respGetEstados = $publicaciones->getEstados(); 
$respGetCategorias = $publicaciones->getCategorias(); 
//Validacion de roles
if (isset($respUserData)) {
  $rol = $_SESSION['roles'];
  if ($rol == 1) {
?>
    <!DOCTYPE html>
    <html>

    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Bienvenidos a Interoriente, podrás comprar, vender y mucho más.">
      <meta name="author" content="Inter-oriente">
      <title>Crear publicación | Interoriente</title>
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
                  <form action="../../../Controller/php/view/publicaciones.php" method="POST" enctype="multipart/form-data">
                  <input type="hidden" name = "crearPublicacion">
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
                              foreach ($respGetEstados as $datosEstado) { ?>
                                <option value="<?php echo $datosEstado['idEstadoArticulo']; ?>"><?php echo $datosEstado['nombreEstadoArticulo']; ?></option>
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
                              foreach ($respGetCategorias as $datosCategoria) { ?>
                                <option value="<?php echo $datosCategoria['idCategoria']; ?>"><?php echo $datosCategoria['nombreCategoria']; ?></option>
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
        if (!$_GET) {
        ?>
          <center>
            <h1>Mis publicaciones</h1>
          </center>
          <div class="table-responsive">
            <table id="tabla" class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Imagen</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Descripcion</th>
                  <th scope="col">Costo</th>
                  <th scope="col">Stock</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                <?php if (!$respMostrarPublicaciones) { ?>
                  <tr>
                    <td colspan="8">
                      <div class="alert alert-danger" role="alert" style="text-align: center;">Opps, por ahora no hay publicaciones</div>
                    </td>
                  </tr>
              </tbody>

              <tr>
              <?php }
                foreach ($respMostrarPublicaciones as $datosPubli) {
              ?>
                <th><img src="../../../view/assets/img/publicaciones/<?php echo $datosPubli['urlImagen'];  ?>" alt=".." width="130px"></th>
                <td><?php echo $datosPubli['nombrePublicacion']; ?></td>
                <td><?php echo substr($datosPubli['descripcionPublicacion'], 0, 30); ?></td>
                <td><?php echo $datosPubli['costoPublicacion']; ?></td>
                <td><?php echo $datosPubli['stockPublicacion']; ?></td>
                <td>
                  <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Acciones
                  </button>
                  <div class="dropdown-menu">
                    <a class="btn btn-info" data-toggle="modal" data-target="#actualizarPubliModal<?php echo $datosPubli['idPublicacion']; ?>">Actualizar</a>
                    <a class="btn btn-danger" data-toggle="modal" data-target="#eliminarPubliModal<?php echo $datosPubli['idPublicacion']; ?>">Eliminar</a>
                  </div>
                </td>

                <!--Modal Eliminar publicación -->
                <?php require "../assets/modalesPublicacion.php"; ?>
              </tr>
          <?php }
              } ?>
            </table>
          </div>
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
?>