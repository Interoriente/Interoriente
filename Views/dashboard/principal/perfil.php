<?php
session_start();
if (!isset($_SESSION['documentoIdentidad'])) {
  echo "<script>alert('No has iniciado sesión!');</script>";
  echo "<script> document.location.href='403.php';</script>";
} else {
  $documento = $_SESSION["documentoIdentidad"];
  require "../../../Controllers/php/users/usuarios.php";
  require "../../../Controllers/php/users/publicaciones.php";
  $usuario = new Usuario($documento);
  $respUserData = $usuario->getUserData($usuario->id);
  $publicaciones = new Publicaciones($documento);
  $respMostrarPublicaciones = $publicaciones->MostrarPublicaciones($publicaciones->id);
  $contadorPublicaciones = count($respMostrarPublicaciones);
  $respGetCiudades = $usuario->getCiudades();
  $respGetDirecciones = $usuario->getDirecciones($usuario->id);
  /* Mostrar nombre completo del usuario logeado */
  $nombreUsuario = $respUserData->nombresUsuario . " " . $respUserData->apellidoUsuario;
  if (isset($respUserData)) {
    $rol = $_SESSION['roles'];
    //Validacion de roles
    if ($rol == 1 or $rol  == 3) {

      //Parte superior del HTML
      require "../includes/header.php";

      require_once '../includes/sidebarDashboard.php';
      require_once '../includes/navegacion.php';
?>
      <!-- Header -->
      <div class="header pb-6 d-flex align-items-center">
        <span class="mask" style="background-color: #004E64;"></span>
        <!-- Mask -->
        <!-- Header container -->
        <div class="container-fluid d-flex align-items-center">
          <div class="row">
            <div class="col-lg-12 col-md-10">
              <h1 class="display-2 text-white">¡Hola, <?php echo $nombreUsuario; ?>!</h1>
              <p class="text-white mt-0 mb-5">Este es tu perfil. Aquí podrás visualizar tu información y actualizarla en cualquier momento.</p>
            </div>
          </div>
        </div>
      </div>
      <!-- Page content -->
      <div class="container-fluid mt--6">
        <div class="row">
          <div class="col-xl-4 order-xl-2">
            <div class="card card-profile">
              <img src="../../assets/img/LogoCuaternario.svg" alt="Imagen fondo de pantalla">
              <div class="row justify-content-center">
                <div class="col-lg-3 order-lg-2">
                  <div class="card-profile-image">
                    <a data-toggle="modal" data-target="#fotoperfil">
                      <img src="<?php echo $respUserData->imagenUsuario; ?>" class="rounded-circle" alt="Imagen de perfil Usuario">
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-header text-center border-0 pt-8 pt-md-8 pb-5 pb-md-0">
                <!-- <div class="d-flex justify-content-between">
                  <a href="#!" class="btn btn-sm btn-info  mr-4 ">Ayuda</a>
                </div> -->
              </div>
              <div class="card-body pt-0">
                <div class="row">
                  <div class="col">
                    <div class="card-profile-stats d-flex justify-content-center">
                      <div>
                        <span class="heading"><?php echo $contadorPublicaciones; ?></span>
                        <span class="description">Publicaciones</span>
                      </div>
                      <!-- <div>
                        <span class="heading">0</span>
                        <span class="description">Fotos</span>
                      </div>
                      <div>
                        <span class="heading">89</span>
                        <span class="description">Comentarios</span>
                      </div> -->
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <h5 class="h3">
                    <?php echo $nombreUsuario; ?>
                  </h5>
                  <div class="h5 font-weight-300">
                    <i class="ni location_pin mr-2"></i>Oriente de Antioquia
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal -->
          <div class="modal" id="fotoperfil" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-body">
                  <img class=" card-img-top" src="<?php echo $respUserData->imagenUsuario; ?>">
                </div>
              </div>
            </div>
          </div>
          <!--/Modal -->

          <div class="col-xl-8 order-xl-1">
            <div class="card">
              <div class="card-header">
                <div class="row align-items-center">
                  <div class="col-8">
                    <h3 class="mb-0">Editar perfil </h3>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <form action="../../../Controllers/php/users/usuarios.php" method="POST" enctype="multipart/form-data">
                  <h6 class="heading-small text-muted mb-4">Información de usuario</h6>
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="docu">Documento</label>
                          <input type="text" id="docu" name="nombre" class="form-control" placeholder="Username" value="<?php echo $respUserData->documentoIdentidad; ?>" disabled required>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">Nombre</label>
                          <input type="text" id="input-username" name="nombre" class="form-control" placeholder="Nombre" value="<?php echo $respUserData->nombresUsuario; ?>" required disabled>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">Apellido</label>
                          <input type="text" id="input-username" name="apellido" class="form-control" placeholder="Apellido" value="<?php echo $respUserData->apellidoUsuario; ?>" required disabled>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-username">Celular</label>
                          <input type="number" id="input-username" name="celular" class="form-control" placeholder="Celular" max="9999999999" value="<?php echo $respUserData->telefonomovilUsuario; ?>" required>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-email">Correo</label>
                          <input type="email" id="input-email" name="correo" class="form-control" value="<?php echo $respUserData->emailUsuario; ?>" required>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="input-image">Foto de Perfil</label>
                          <input type="file" id="input-image" name="file" class="form-control-file">
                        </div>
                        Si no quieres cambiar la foto de perfil, puedes dejar este campo en blanco
                      </div>
                      <div class="form-group">
                        <input type="hidden" name="documentoUsuario" value="<?php echo $documento; ?>" required>
                        <input type="hidden" name="actualizarCuenta" value="<?php echo $documento; ?>" required>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-xs" type="submit" name="subir">Editar</button>
                  </div>
                </form>
              </div>
              <!-- Formulario para agregar direcciones -->
              <div class="card-body">
                <form action="../../../Controllers/php/users/usuarios.php" method="POST" enctype="multipart/form-data">
                  <h6 class="heading-small text-muted mb-4">Información de direcciones agregadas</h6>
                  <div class="pl-lg-4">
                    <div class="row">
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="nombre">Nombre (Opcional)</label>
                          <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Madre, Casa, Trabajo..." value="">
                          <input type="hidden" id="" name="agregarDirecciones" class="form-control" value="">
                          <input type="hidden" id="" name="documentoUsuario" class="form-control" value="<?php echo $documento; ?>">
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="direccion">Dirección</label>
                          <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ej: Cra 21 #12-12" value="" required>
                          <!-- Capturo el documento del usuario logueado -->
                          <input type="hidden" id="direccion" name="documento" class="form-control" value="<?php echo $respUserData->documentoIdentidad; ?>" required>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="form-group">
                          <label class="form-control-label" for="ciudad">Ciudad de la dirección</label>
                          <select name="ciudad" id="ciudad" class="form-control">
                            <option value="" disabled>Seleccione una ciudad</option>
                            <?php foreach ($respGetCiudades as $ciudad) {
                            ?>
                              <option value="<?php echo $ciudad['idCiudad'] ?>"><?php echo $ciudad['nombreCiudad'] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <button class="btn btn-primary btn-xs" type="submit" name="subirDireccion">Registrar</button>
                  </div>
                </form>
              </div>

              <h1 id="titulo-direccion">Mis Direcciones</h1>

              <div class="table-responsive">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                      <th scope="col">Nombre</th>
                      <th scope="col">Dirección</th>
                      <th scope="col">Ciudad</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <?php foreach ($respGetDirecciones as $direccion) : ?>
                    <tr>
                      <td><?php echo $direccion['nombreDireccion']; ?></td>
                      <td><?php echo $direccion['descripcionDireccion'] ?></td>
                      <td><?php echo $direccion['nombreCiudad'] ?></td>
                      <td>
                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Acciones
                        </button>
                        <div class="dropdown-menu">
                          <a class="btn btn-info" data-toggle="modal" data-target="#actualizarDirModal<?php echo $direccion['idDireccion'] ?>">Actualizar</a>
                          <a class="btn btn-danger" data-toggle="modal" data-target="#eliminarDirModal<?php echo $direccion['idDireccion'] ?>">Eliminar</a>
                        </div>
                      </td>

                      <!--Modal Eliminar y actualizar direccion -->
                      <?php require "../includes/modalesDireccion.php"; ?>
                    </tr>
                  <?php endforeach //Fin foreach 
                  ?>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
<?php require_once '../includes/footer.php';
    } else {
      echo "<script>alert('No puedes acceder a esta página!');</script>";
      echo "<script> document.location.href='403.php';</script>";
    }
  }
}
?>