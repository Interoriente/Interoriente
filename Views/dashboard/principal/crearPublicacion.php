<?php
session_start();
$respUserData = null;
if (isset($_SESSION['documentoIdentidad'])) {
  $documento = $_SESSION["documentoIdentidad"];
  require "../../../Controllers/php/users/usuarios.php";
  require "../../../Controllers/php/users/publicaciones.php";
  $usuario = new Usuario($documento);
  $respUserData = $usuario->getUserData($usuario->id);
  $publicaciones = new Publicaciones($documento);
  $respGetCategorias = $publicaciones->getCategorias();
}
//Validacion de roles
if (isset($respUserData)) {
  $rol = $_SESSION['roles'];
  if ($rol == 1 || $rol == 3) {

    //Parte superior del HTML
    require "../includes/header.php";
    require_once '../includes/sidebarDashboard.php';
    require_once '../includes/navegacion.php';

?>
    <br><br><br><br>
    <!-- Publicacion producto -->
    <div class="container-fluid mt--6">
      <div class="cont-form-crearPubli">
        <div class="card">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Crear Publicación</h3>
              </div>
            </div>
          </div>
          <div class="card-body form-crearPubli">
            <form action="../../../Controllers/php/users/publicaciones.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="crearPublicacion">
              <h6 class="heading-small text-muted mb-4">¡Cuéntale a la gente lo que quieres ofrecer!</h6>
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="input-username">Título</label>
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
                      <label class="form-control-label" for="input-username">Costo</label>
                      <input type="number" id="input-username" name="costo" class="form-control" placeholder="Costo" max="999999999" value="" required>
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
      <!-- Footer -->
  <?php require_once '../includes/footer.php';
  } else {
    echo "<script>alert('No puedes acceder a esta página!');</script>";
    echo "<script> document.location.href='dashboard.php';</script>";
  }
} else {
  echo "<script>alert('No has iniciado sesión!');</script>";
  echo "<script> document.location.href='403.php';</script>";
}
  ?>